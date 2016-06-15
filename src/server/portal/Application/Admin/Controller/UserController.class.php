<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Admin\Controller;
use Admin\Service\ApiService;
use User\Api\UserApi;
/**
 * 后台用户控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class UserController extends AdminController {

    public function setpwd(){
        if(!session('user-hasno-pwd')){
            $this->error('您已经设置了密码！');
        }
        if(IS_POST){
            $password = I('password');
            if(empty($password)){
                $this->error('新密码不能为空！');
            }
            if(strlen($password) < 6){
                $this->error('密码不能小于6位！');
            }
            $repassword = I('repassword');
            if($password != $repassword){
                $this->error('两次密码输入不一致！');
            }

            $Api    =   new UserApi();
            $res    =   $Api->updateInfo(UID, '', ['password'=>$password]);
            if($res['status']){
                session('user-hasno-pwd',null);
                $this->success('设置密码成功！',U('index/index'));
            }else{
                $this->error($res['info']);
            }

        }

        $this->display();
    }
    /**
     * 用户管理首页
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function index(){
        $nickname       =   I('nickname');
        $map['m.status']  =   array('egt',0);
        if(is_numeric($nickname)){
            $map['uid|nickname']=   array(intval($nickname),array('like','%'.$nickname.'%'),'_multi'=>true);
        }elseif(!empty($nickname)){
            $map['m.nickname']    =   array('like', '%'.(string)$nickname.'%');
        }
        //$map['aga.group_id'] = ['not in', '5,6'];
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'ucenter_member um')
                    ->join($prefix.'member m on m.uid = um.id','left')
                    ->join($prefix.'auth_group_access aga on aga.uid=um.id', 'left');
        $list   = $this->lists($model, $map,'','m.*,um.username,um.id');
        $this->assign('_list', $list);
        $this->meta_title = '用户信息';
        $this->display();
    }

    /**
     * 修改昵称初始化
     * @author huajie <banhuajie@163.com>
     */
    public function updateNickname(){
        $nickname = M('Member')->getFieldByUid(UID, 'nickname');
        $this->assign('nickname', $nickname);
        $this->meta_title = '修改昵称';
        $this->display('updatenickname');
    }

    /**
     * 修改昵称提交
     * @author huajie <banhuajie@163.com>
     */
    public function submitNickname(){
        //获取参数
        $nickname = I('post.nickname');
        empty($nickname) && $this->error('请输入昵称');

        $Member =   D('Member');
        $data   =   $Member->create();
        if(!$data){
            $this->error($Member->getError());
        }

        $res = $Member->where(array('uid'=>UID))->save($data);

        if($res){
            $user               =   session('user_auth');
            $user['username']   =   $data['nickname'];
            session('user_auth', $user);
            session('user_auth_sign', data_auth_sign($user));
            $this->success('修改昵称成功！',U('index/index'));
        }else{
            $this->error('修改昵称失败！');
        }
    }

    /**
     * 修改密码初始化
     * @author huajie <banhuajie@163.com>
     */
    public function updatePassword(){
        $this->meta_title = '修改密码';
        $this->display('updatepassword');
    }

    /**
     * 修改密码提交
     * @author huajie <banhuajie@163.com>
     */
    public function submitPassword(){
        //获取参数
        $password   =   I('post.old');
        empty($password) && $this->error('请输入原密码');
        $data['password'] = I('post.password');
        empty($data['password']) && $this->error('请输入新密码');
        $repassword = I('post.repassword');
        empty($repassword) && $this->error('请输入确认密码');

        if($data['password'] !== $repassword){
            $this->error('您输入的新密码与确认密码不一致');
        }

        $Api    =   new UserApi();
        $res    =   $Api->updateInfo(UID, $password, $data);
        if($res['status']){
            $this->success('修改密码成功！',U('index/index'));
        }else{
            $this->error($res['info']);
        }
    }

    /**
     * 用户行为列表
     * @author huajie <banhuajie@163.com>
     */
    public function action(){
        //获取列表数据
        $Action =   M('Action')->where(array('status'=>array('gt',-1)));
        $list   =   $this->lists($Action);
        int_to_string($list);
        // 记录当前列表页的cookie
        Cookie('__forward__',$_SERVER['REQUEST_URI']);

        $this->assign('_list', $list);
        $this->meta_title = '用户行为';
        $this->display();
    }

    /**
     * 新增行为
     * @author huajie <banhuajie@163.com>
     */
    public function addAction(){
        $this->meta_title = '新增行为';
        $this->assign('data',null);
        $this->display('editaction');
    }

    /**
     * 编辑行为
     * @author huajie <banhuajie@163.com>
     */
    public function editAction(){
        $id = I('get.id');
        empty($id) && $this->error('参数不能为空！');
        $data = M('Action')->field(true)->find($id);

        $this->assign('data',$data);
        $this->meta_title = '编辑行为';
        $this->display('editaction');
    }

    /**
     * 更新行为
     * @author huajie <banhuajie@163.com>
     */
    public function saveAction(){
        $res = D('Action')->update();
        if(!$res){
            $this->error(D('Action')->getError());
        }else{
            $this->success($res['id']?'更新成功！':'新增成功！', Cookie('__forward__'));
        }
    }

    /**
     * 会员状态修改
     * @author 朱亚杰 <zhuyajie@topthink.net>
     */
    public function changeStatus($method=null){
        $id = array_unique((array)I('id',0));
        if( in_array(C('USER_ADMINISTRATOR'), $id)){
            $this->error("不允许对超级管理员执行该操作!");
        }
        $id = is_array($id) ? implode(',',$id) : $id;
        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }
        $map['uid'] =   array('in',$id);
        switch ( strtolower($method) ){
            case 'forbiduser':
                $this->forbid('Member', $map );
                break;
            case 'resumeuser':
                $this->resume('Member', $map );
                break;
            case 'deleteuser':
                $this->delete('Member', $map );
                break;
            default:
                $this->error('参数非法');
        }
    }

    /**
     * 编辑用户
     * @author huajie <banhuajie@163.com>
     */
    public function uedit(){
        $id = I('get.id');
        empty($id) && $this->error('参数不能为空！');
        
        if(IS_POST){
            
            $nickname = I('post.nickname');
            $email = I('post.email');
            $u_m_model = M('ucenter_member');
            
            if($u_m_model->where(array('email'=>$email,'id'=>array('NEQ',NULL)))->find()){
                
                $this->error('邮箱被占用！'.$u_m_model->_sql());
            }
            
            if(! $u_m_model->where(array('id'=>$id))->save(array('email'=>$email,'update_time'=>NOW_TIME))){
                $this->error('修改失败！');
            }
            
            $model = M('member');
            
            if(!$model->where(array('uid'=>$id))->save(array('nickname'=>$nickname,'update_time'=>NOW_TIME))){
                $this->error('修改失败！');
            }
            
            $this->success('保存成功！',U('user/index'));
            
        }
        
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'member m')
        ->join($prefix.'ucenter_member um on m.uid = um.id');
        
        $data = $model->field(array('m.nickname','um.email'))->where(array('um.id'=>$id))->find();
    
        $this->assign('data',$data);
        $this->meta_title = '编辑用户';
        $this->display();
    }
    
    public function add($username = '', $password = '', $repassword = '', $email = ''){
        if(IS_POST){
            /* 检测密码 */
            if($password != $repassword){
                $this->error('密码和重复密码不一致！');
            }

            /* 调用注册接口注册用户 */
            $User   =   new UserApi;
            $uid    =   $User->register($username, $password, $email,$username);
            if(0 < $uid){ //注册成功
                $user = array('uid' => $uid, 'nickname' => I('nickname'), 'status' => 1);
                if(!M('Member')->add($user)){
                    $this->error('用户添加失败！');
                } else {
                    $this->success('用户添加成功！',U('index'));
                }
            } else { //注册失败，显示错误信息
                $this->error($this->showRegError($uid));
            }
        } else {
            $this->meta_title = '新增用户';
            $this->display();
        }
    }

    /**
     * 获取用户注册错误信息
     * @param  integer $code 错误编码
     * @return string        错误信息
     */
    private function showRegError($code = 0){
        switch ($code) {
            case -1:  $error = '用户名长度必须在16个字符以内！'; break;
            case -2:  $error = '用户名被禁止注册！'; break;
            case -3:  $error = '用户名被占用！'; break;
            case -4:  $error = '密码长度必须在6-30个字符之间！'; break;
            case -5:  $error = '邮箱格式不正确！'; break;
            case -6:  $error = '邮箱长度必须在1-32个字符之间！'; break;
            case -7:  $error = '邮箱被禁止注册！'; break;
            case -8:  $error = '邮箱被占用！'; break;
            case -9:  $error = '手机格式不正确！'; break;
            case -10: $error = '手机被禁止注册！'; break;
            case -11: $error = '手机号被占用！'; break;
            default:  $error = '未知错误';
        }
        return $error;
    }

    //回访列表
    public function userReturn() {
        $search       =   I('search');
        //$map['um.status']  =   array('egt',0);
        $map = [];
        if(is_numeric($search)){
            $map['c.mobile']=['like', '%' . intval($search) . '%'];//   array(intval($search),array('like','%'.$search.'%'),'_multi'=>true);
        }elseif(!empty($search)){
            $map['c.chairman_name|c.chairman_nickname']    =   array('like', '%'.(string)$search.'%');
        }

        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'user_return_visit urv')
            ->join($prefix.'company com on com.uid = urv.uid','left')
            ->join($prefix.'company_reg c on c.uid = urv.uid','left')
            ->join($prefix.'auth_group_access aga on aga.uid=urv.uid', 'left')
            ->join($prefix.'auth_group ag on ag.id=aga.group_id', 'left')
            ->join($prefix.'ucenter_member um on um.id=urv.add_user','left');

        $list   = $this->lists($model, $map,'urv.update_time desc','c.*, ag.title, um.username as huifangren, urv.id as urv_id');

        $this->assign('_list', $list);
        $this->meta_title = '会员回访列表';
        $this->display();
    }

    //回访详细页面
    public function returnShow() {
        $id = I('get.id');
        empty($id) && $this->error('参数不能为空！');
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'user_return_visit urv');

        if (IS_POST) {
            $content = I('content');
            if(!$model->where(array('id'=>$id))
                ->save(array(
                    'content'=>$content,
                    'update_time'=>time_format()))
            ){
                $this->error('修改失败！');
            }

            $this->success('保存成功！',U('user/userReturn'));
        }


        $model = $model
            ->join($prefix.'company_reg c on c.uid = urv.uid','left')
            ->join($prefix.'auth_group_access aga on aga.uid=urv.uid', 'left')
            ->join($prefix.'auth_group ag on ag.id=aga.group_id', 'left')
            ->join($prefix.'ucenter_member um on um.id=urv.add_user','left');
        $data = $model->field(array('c.*','urv.*','ag.title', 'c.insert_time as time', 'um.username as huifangren'))
            ->where(array('urv.id'=>$id))->find();
        if (empty($data)) {
            $this->error('该回访不存在!');
        }
        $this->assign('item',$data);
        $this->meta_title = '会员回访详细信息';
        $this->display();
    }


    //添加回访信息
    public function addReturn() {
        $prefix = C('DB_PREFIX');
        if (IS_POST) {
            $return = M()->table($prefix.'user_return_visit');
            $_POST['insert_time'] = date("Y-m-d H:m:s", time());
            $_POST['update_time'] = date("Y-m-d H:m:s", time());
            if ($return->create()) {
                $result = $return->add();
                if ($result > 0) {
                    $this->success('保存成功！',U('user/userReturn'));
                } else {
                    $this->error('保存失败！');
                }
            } else {
                $this->error('保存失败！');
            }
        }

        $search  =  I('search');
        $data = [];
        $map = [];

        if (!empty($search)) {
            if(is_numeric($search)){
                $map['cr.mobile']=['like', '%' . intval($search) . '%'];
            }elseif(!empty($search)){
                $map['cr.chairman_name|cr.chairman_nickname']    =   array('like', '%'.(string)$search.'%');
            }

            $model = M()->table($prefix.'company c')
                ->join($prefix.'company_reg cr on cr.uid = c.uid','left')
                ->join($prefix.'ucenter_member um on um.id=cr.uid','left')
                ->join($prefix.'auth_group_access aga on aga.uid=cr.uid', 'left')
                ->join($prefix.'auth_group ag on ag.id=aga.group_id', 'left');
            $data = $model->field(array('cr.*' ,'ag.title', 'cr.insert_time as time'))->where($map)->find();

            if (empty($data)) {
                $this->error('找不到该用户，请重新输入姓名或手机号码查询');
            }


        }
        $this->assign('item', $data);
        $this->assign('search', $search);
        $this->meta_title = '添加回访';
        $this->display();
    }

}
