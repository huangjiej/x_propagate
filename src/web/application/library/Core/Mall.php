<?php
namespace Core;

use \Yaf\Registry;

/**
 * Class Mall
 * @name MallController
 * @author xuebingwang
 * @desc 商城基类控制器
 * @package Core
 */
class Mall extends Api {

    protected $layout;

    public function init(){

        $this->user     = session('user_auth');
        $this->wechat_setting = M('t_wechat_setting')->get('*',['id'=>1]);
        $this->wechat   = new \Wechat($this->wechat_setting);
        if(!is_not_wx() && empty($this->user)){
//            if(!isset($_GET['hash'])){
//                $this->display(APP_PATH.'views/public/hash');
//                die;
//            }
            //如果当前浏览器是微信浏览器,并且当前为未登录状态
            //重定向至微信,采用网页授权获取用户基本信息接口获取code
            $forward = urlencode(DOMAIN.$_SERVER['REQUEST_URI']);
            $url = DOMAIN.'/callback/spread.html?forward='.$forward;

            $this->redirect($this->wechat->getOauthRedirect($url,'','snsapi_base'));
        }


        if(!is_not_wx()){
            $js_ticket = $this->wechat->getJsTicket();
            if (!$js_ticket) {
                echo "获取js_ticket失败！<br>";
                echo '错误码：'.$this->wechat->errCode;
                echo ' 错误原因：'.\ErrCode::getErrText($this->wechat->errCode);
                exit;
            }

            $url = DOMAIN.$_SERVER['REQUEST_URI'];
            $js_sign = $this->wechat->getJsSign($url);
            $this->assign('js_sign',$js_sign);
        }
        
        

        $this->config = Registry::get('config');
        $this->layout = Registry::get('layout');
        if(!empty($this->layout)){
            $this->layout->user = $this->user;
        }
    }



    /**
     * 页面重定向方法
     * @param string $url
     * @param string $alert_msg
     */
    public function redirect($url,$alert_msg=''){
        if(!empty($alert_msg)){
            session('alert_msg',$alert_msg);
        }
        parent::redirect($url);
        die;
    }

    /**
     * @param $name
     * @param null $value
     */
    protected function assign($name,$value=null){
        $this->getView()->assign($name,$value);
    }


    /**
     * 默认跳转操作 支持错误导向和正确跳转
     * 调用模板显示 默认为public目录下面的success页面
     * 提示页面为可配置 支持模板标签
     * @param string $message 提示信息
     * @param int $status 状态
     * @param string $jumpUrl 页面跳转地址
     * @param mixed $ajax 是否为Ajax方式 当数字时指定跳转时间
     * @access private
     * @return void
     */
    protected function dispatchJump($message,$status=1,$jumpUrl='',$ajax=false) {
        if(IS_AJAX || true === $ajax) {// AJAX提交
            $data           =   is_array($ajax)?$ajax:[];
            $data['msg']    =   $message;
            $data['status'] =   $status;
            $data['url']    =   $jumpUrl;
            $this->ajaxReturn($data);
        }

        $this->assign('jumpUrl',$jumpUrl);
        //如果设置了关闭窗口，则提示完毕后自动关闭窗口
        $this->assign('status',$status);   // 状态
        $this->assign('message',$message);// 提示信息
        $this->assign('data',is_array($ajax)?$ajax:[]);

        if($status) { //发送成功信息
            //发生错误时候默认停留3秒
            $this->assign('waitSecond',3);
            $body = $this->getView()->render(APP_PATH.'views/error.php');
        }else{
            //默认停留1秒
            $this->assign('waitSecond',3);
            $body = $this->getView()->render(APP_PATH.'views/success.php');
        }

        $this->getResponse()->setBody($body);
        $this->layout->postDispatch($this->getRequest(),$this->getResponse());
        $this->getResponse()->response();
        // 中止执行  避免出错后继续执行
        die;
    }

}
