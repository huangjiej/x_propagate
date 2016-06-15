<?php
/**
 * Created by PhpStorm.
 * User: sks
 * Date: 2016/4/28
 * Time: 20:08
 */
use Core\Mall;
/**
 * @name IndexController
 * @author xuebingwang
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
class BindController extends Mall {

    //用户绑定
    public function bindAction() {
        $member = new UserModel();
        if($member->is_bind($this->user['openid'])){
            $this->error('微信账号已与手机号绑定！');
        }
        if (IS_POST) {
            $refer = session('refer'); //添加成功返回连接
            $data['mobile'] = I('mobile');
            $data['password'] = I('password');

            //判断用户是否存在,存在的话，将该用户wx_id添加到t_user表中

            if ($member->is_user(intval($data['mobile']))) {
                //判断密码是否正确
                $loginPassword  = md5($data['password']);
                $user=$member->is_password(intval($data['mobile']),$loginPassword);

                if(empty($user)){
                    $this->error('账户或密码不正确！');
                }else{
                    if ($member->bind($this->user['openid'], $data['mobile'])) {
                        $this->success('绑定成功!', U('success',['mobile'=>$data['mobile']]));
                    } else {
                        $this->error('绑定失败，请重新绑定！');
                    }
                }

            } else {
                $this->error('该手机号码尚未注册土筑虎平台！');
            }
        }
        if(isset($_SERVER['HTTP_REFERER'])){
            session('refer', $_SERVER['HTTP_REFERER']);
        }
        if(isset($this->user['mobile_num'])){
            $this->error('该微信账户已被绑定！');
        }

        $this->display('bind');
        die();
    }

    function successAction(){
        $mobilenum=I('mobile');
        $mobile=substr_replace($mobilenum,'*****',3,5);
        $this->assign('mobile',$mobile);
    }

}