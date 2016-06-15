<?php
namespace Core;
use \Yaf\Dispatcher;
use \Yaf\Registry;
/**
 * Created by PhpStorm.
 * User: xuebingwang
 * Date: 2015/9/29
 * Time: 22:48
 */

class Wechat extends Api{

    public function templateAction(){

        if(!isset($this->request_data['body']) || empty($this->request_data['body'])){
            throw new \Exception('{"errcode":10000,"errmsg":"body节点不能为空"}',10000);
        }

        $result = $this->wechat->sendTemplateMessage($this->request_data['body']);
        if(empty($result)){

            $this->sendError($this->wechat->errMsg,$this->wechat->errCode);
        }else{
            $this->sendSuccess($result);
        }
    }

    public function customAction(){

        if(!isset($this->request_data['body']) || empty($this->request_data['body'])){
            throw new \Exception('{"errcode":10000,"errmsg":"body节点不能为空"}',10000);
        }

        $result = $this->wechat->sendCustomMessage($this->request_data['body']);
        if(empty($result)){

            $this->sendError($this->wechat->errMsg,$this->wechat->errCode);
        }else{
            $this->sendSuccess($result);
        }
    }
}
