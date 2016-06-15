<?php
/**
 * Created by PhpStorm.
 * User: xuebingwang
 * Date: 2016/5/7
 * Time: 17:47
 */

class AsyncController  extends Core\Wechat  {

    /**
     * 异步更新文章
     */
    public function runAction(){

        if(empty($this->request_data['body']['path'])){
            $this->sendError('参错错误，异步地址不能为空！');
        }

        $path = explode('/',$this->request_data['body']['path']);
        if(sizeof($path) != 3){
            $this->sendError('参数错误，异步地址不正确！');
        }
        $this->sendSuccess('收到请求！');

        $task_data = array(
            $path[0],
            $path[1],
            $path[2],
            array('request_data'=>$this->request_data)
        );
        //发送异步任务
        HttpServer::$http->task($task_data);
    }
}