<?php
/**
 * xbw-swoole-yaf
 *
 * @author xuebing<46964108@qq.com>
 */

namespace Core;

use Yaf\Registry;
use Yaf\Dispatcher;
use Yaf\Controller_Abstract;

/**
 * Class ServiceApi
 *
 * 导出API的controller基类
 *
 * @package Core
 */
class Api extends Controller_Abstract
{
    /**
     * 接口请求数据
     * @var Array
     */
    protected $request_data;

    /**
     * yaf配置参数
     * @var Object
     */
    protected $config;

    protected $user;

    protected $wechat;

    protected $wechat_setting;

    /**
     * 业务成功
     * @var int
     */
    const ERR_CODE_SUCCESS    = 0;
    /**
     * 业务失败
     * @var int
     */
    const ERR_CODE_FAILD      = 10000;

    /**
     * ServiceApi初始化
     */
    public function init(){

        Dispatcher::getInstance()->returnResponse(true);
        Dispatcher::getInstance()->disableView();

        $this->config   = Registry::get('config');
        $this->user     = session('user_auth');
        $this->wechat_setting = M('t_wechat_setting')->get('*',['id'=>1]);
        //var_dump($this->wechat_setting);
        $this->wechat   = new \Wechat($this->wechat_setting);

        $this->_initRequestData();
    }

    /**
     * 子类实现
     */
    protected function _initRequestData(){
        //通过swoole启动接口服务
        if(class_exists('\HttpServer',false)){

            $this->request_data = json_to_array(\HttpServer::$raw_data);
        }else{

            $this->request_data = json_to_array(file_get_contents('php://input'));
        }
    }

    /**
     * 标准响应输出
     * @param array $out
     * @param int $errcode
     */
    protected function sendOutPut(Array $out=array(),$errcode=self::ERR_CODE_SUCCESS){

        if(!isset($out['errcode'])){
            $out['errcode'] = $errcode;
        }

        $this->getResponse()->setBody(json_encode($out,JSON_UNESCAPED_UNICODE));
    }

    /**
     * 成功的响应输出
     * @param string $msg
     */
    protected function sendSuccess($msg){

        $this->sendOutPut(array('errmsg'=>$msg));
    }

    /**
     * 失败的响应输出
     * @param $content
     * @param int $code
     * @throws \Exception
     */
    protected function sendError($content,$code=self::ERR_CODE_FAILD){

        throw new \Exception($content, $code);
    }

    /**
     * @param $message
     * @param int $status
     * @param array $data
     */
    protected function returnData($message,$status=self::ERR_CODE_SUCCESS,$data =[])
    {
        $data['msg'] = $message;
        $data['status'] = $status;
        $this->ajaxReturn($data);
    }

    /**
     * @return string
     */
    protected function getMCA(){
        return $this->getModule().$this->getController().$this->getAction();
    }

    /**
     * 操作错误跳转的快捷方法
     * @access protected
     * @param string $message 错误信息
     * @param string $jumpUrl 页面跳转地址
     * @param mixed $ajax 是否为Ajax方式 当数字时指定跳转时间
     * @return void
     */
    protected function error($message='',$jumpUrl='',$ajax=false) {
        $this->dispatchJump($message,self::ERR_CODE_FAILD,$jumpUrl,$ajax);
    }

    /**
     * 操作成功跳转的快捷方法
     * @access protected
     * @param string $message 提示信息
     * @param string $jumpUrl 页面跳转地址
     * @param mixed $ajax 是否为Ajax方式 当数字时指定跳转时间
     * @return void
     */
    protected function success($message='',$jumpUrl='',$ajax=false) {
        $this->dispatchJump($message,self::ERR_CODE_SUCCESS,$jumpUrl,$ajax);
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
    protected function dispatchJump($message,$status=self::ERR_CODE_FAILD,$jumpUrl='',$ajax=false) {
        $data           =   is_array($ajax)?$ajax:[];
        $data['msg']    =   $message;
        $data['status'] =   $status;
        $data['url']    =   $jumpUrl;
        $this->ajaxReturn($data);
    }

    /**
     * Ajax方式返回数据到客户端
     * @access protected
     * @param mixed $data 要返回的数据
     * @param String $type AJAX返回数据格式
     * @param int $json_option 传递给json_encode的option参数
     * @return void
     */
    protected function ajaxReturn($data,$type='',$json_option=0) {
        header('Cache-Control: no-store, no-cache, must-revalidate');
        if(empty($type)) $type  =   $this->config->ajax->return;
        switch (strtoupper($type)){
            case 'JSON' :
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Disposition: inline; filename="resp.json"');
                // Prevent Internet Explorer from MIME-sniffing the content-type:
                header('X-Content-Type-Options: nosniff');
                if (strpos(@$_SERVER['HTTP_ACCEPT'], 'application/json') !== false) {
                    header('Content-Type:application/json; charset=utf-8');
                } else {
                    header('Content-type: text/plain; charset=utf-8');
                }

                exit(json_encode($data,$json_option));
            case 'XML'  :
                // 返回xml格式数据
                header('Content-Type:text/xml; charset=utf-8');
                exit(xml_encode($data));
            case 'JSONP':
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:application/json; charset=utf-8');
                $handler  = $this->config->ajax->jsonp->handler;
                exit($handler.'('.json_encode($data,$json_option).');');
            case 'EVAL' :
                // 返回可执行的js脚本
                header('Content-Type:text/html; charset=utf-8');
                exit($data);
        }
    }

    /**
     * 返回当前模块名
     *
     * @access protected
     * @return string
     */
    protected function getModule() {
        return $this->getRequest()->module;
    }

    /**
     * 返回当前控制器名
     *
     * @access protected
     * @return string
     */
    protected function getController() {
        return $this->getRequest()->controller;
    }

    /**
     * 返回当前动作名
     *
     * @access protected
     * @return string
     */
    protected function getAction() {
        return $this->getRequest()->action;
    }
}