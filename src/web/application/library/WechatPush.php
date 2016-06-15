
<?php
use Yaf\Dispatcher;
/**
 * Created by PhpStorm.
 * User: xuebingwang
 * Date: 2015/9/29
 * Time: 22:48
 */
class WechatPush extends Yaf\Controller_Abstract{
    protected $config;
    protected $wechat;
    protected $raw_data;
    public function init(){
//         Dispatcher::getInstance()->returnResponse(true);
        Dispatcher::getInstance()->disableView();
        $this->config = Yaf\Registry::get('config');
        $this->wechat = new Wechat($this->config->wechat->toArray());
        $this->raw_data = json_to_array($this->getRequest()->getParam('raw_data'));
        if(!isset($this->raw_data['body']) || empty($this->raw_data['body'])){
            throw new \Exception('{"errcode":10000,"errmsg":"body节点不能为空"}',10000);
        }
    }
    public function templateAction(){
        $result = $this->wechat->sendTemplateMessage($this->raw_data['body']);
        if(empty($result)){
            echo json_encode(['errcode'=>$this->wechat->errCode,'errmsg'=>$this->wechat->errMsg]);
        }else{
            echo json_encode($result);
        }
    }
    public function customAction(){
        $result = $this->wechat->sendCustomMessage($this->raw_data['body']);
        if(empty($result)){
            echo json_encode(['errcode'=>$this->wechat->errCode,'errmsg'=>$this->wechat->errMsg]);
        }else{
            echo json_encode($result);
        }
    }
}