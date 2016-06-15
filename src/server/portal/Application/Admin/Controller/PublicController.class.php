<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Admin\Controller;
use User\Api\UserApi;
use User\Model\UcenterMemberModel;

/**
 * 后台首页控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class PublicController extends \Think\Controller {

    /**
     * 短信+验证码登录
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function login2($username = null, $password = null, $verify = null){

        if(IS_POST){
            //载入配置文件
            require_cache(CUSTOM_CONF_PATH . 'User/config.php');

            //以短信验证码登录
            $check_result = check_sms_verify($username,$verify);
            if($check_result > 0){

                $map = array();
                $map['username'] = $username;
                $model = new UcenterMemberModel();
                /* 获取用户数据 */
                $user = $model->where($map)->find();
                if(empty($user)) {

                    $this->error('用户不存在或被禁用');
                }
                //如果用户未设置密码，会话保存
                if(empty($user['password'])){
                    session('user-hasno-pwd',true);
                }

                $model->updateLogin($user['id']); //更新用户登录信息
                /* 登录用户 */
                $Member = D('Member');
                if($Member->login($user['id'])){ //登录用户
                    //TODO:跳转到登录前页面
                    $this->success('登录成功！', U('Index/index'));
                } else {
                    $this->error($Member->getError());
                }
            }else{

                switch($check_result) {
                    case -2: $error = '短信验证码错误！'; break;
                    case -3: $error = '短信验证码已过期！'; break;
                    default: $error = '未知错误！'; break; // 0-接口参数错误（调试阶段使用）
                }
                $this->error($error);
            }
        } else {
            if(is_login()){
                $this->redirect('Index/index');
            }else{
                /* 读取数据库中的配置 */
                $config	=	S('DB_CONFIG_DATA');
                if(!$config){
                    $config	=	D('Config')->lists();
                    S('DB_CONFIG_DATA',$config);
                }
                C($config); //添加配置
                $this->assign('meta_title','欢迎您登录');
                $this->assign('sms_login',true);
                $this->display('login');
            }
        }
    }

    /**
     * 后台用户登录
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function login($username = null, $password = null, $verify = null){
        if(IS_POST){
            /* 检测验证码 TODO: */
            if(!check_verify($verify)){
                $this->error('验证码输入错误！');
            }

            /* 调用UC登录接口登录 */
            $User = new UserApi;
            $uid = $User->login($username, $password);
            if(0 < $uid){ //UC登录成功
                /* 登录用户 */
                $Member = D('Member');
                if($Member->login($uid)){ //登录用户
                    //TODO:跳转到登录前页面
                    $this->success('登录成功！', U('Index/index'));
                } else {
                    $this->error($Member->getError());
                }

            } else { //登录失败
                switch($uid) {
                    case -1: $error = '用户不存在或被禁用！'; break; //系统级别禁用
                    case -2: $error = '密码错误！'; break;
                    default: $error = '未知错误！'; break; // 0-接口参数错误（调试阶段使用）
                }
                $this->error($error);
            }
        } else {
            if(is_login()){
                $this->redirect('Index/index');
            }else{
                /* 读取数据库中的配置 */
                $config	=	S('DB_CONFIG_DATA');
                if(!$config){
                    $config	=	D('Config')->lists();
                    S('DB_CONFIG_DATA',$config);
                }
                C($config); //添加配置

                $teacher_metting = M('meeting')
                    ->where('status=1')
                    ->order('insert_time DESC')
                    ->limit(5)
                    ->select();
                
                $teacher_twitter = M('document a')
                    ->join('t_document_article b on a.id=b.id','left')
                    ->where([
                        'a.category_id'=> ['in', '46,47,48'],
                        'a.status' => ['gt', 0]
                    ])
                    ->order('a.create_time DESC')
                    ->limit(5)
                    ->select();

                foreach ($teacher_metting as &$itm) {
                    $itm['insert_time'] = substr($itm['insert_time'], 0, 10);
                }

                foreach ($teacher_twitter as &$itm) {
                    $itm['create_time'] = time_format($itm['create_time'],'Y-m-d');//substr(, 0, 10);
                }

                $this->assign('meetings', $teacher_metting);
                $this->assign('twitters', $teacher_twitter);
                
                $this->display();
            }
        }
    }

    /* 退出登录 */
    public function logout(){
        if(is_login()){
            D('Member')->logout();
            session('[destroy]');
            $this->success('退出成功！', U('login'));
        } else {
            $this->redirect('login');
        }
    }

    public function verify(){
        $verify = new \Think\Verify(['length'=>4]);
        $verify->entry(1);
	    exit;
    }

    /**
     * 获取验证码
     */
    public function getAuthCode(){
        $mobileNum = I('post.mobile');
        if(!preg_match("/^1[0-9]{10}$/",$mobileNum)) {
            $this->error('请输入正确的手机号码');
        }

        if(!M('ucenter_member')->where(['username'=>$mobileNum])->getField('id')){
            $this->error('用户不存在！');
        }
        $config	=	S('DB_CONFIG_DATA');
        if(!$config){
            $config	=	D('Config')->lists();
            S('DB_CONFIG_DATA',$config);
        }
        C($config); //添加配置

        $code   = mt_rand(1000,9999);
        //将短信验证码、手机、创建时间保存至会话中
        session('sms-autu-info',array('code'=>$code,'mobile'=>$mobileNum,'time'=>time()));
        $data['mobileNum']  = $mobileNum;
        $content    = sprintf(C('SMS_CODE_TPL'),$code);

        if(send_sms($mobileNum,$content)){
            $this->success('发送验证码成功！');
        }else{
            $this->error('短信验证码发送失败，请重新再试或联系管理员！');
        }
    }

}
