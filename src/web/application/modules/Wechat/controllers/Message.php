<?php
/**
 * Class MessageController
 * @author xuebingwang
 * @desc Message控制器
 */
class MessageController extends Core\Wechat  {

    function sendmessageAction(){
        SeasLog::debug('发送通知!');
        $msg = $this->request_data['body'];
        $result = $this->wechat->sendTemplateMessage($msg);
        SeasLog::debug('发送结果'.$result);
        $this->sendSuccess('处理成功！');
    }
    function creatmenuAction(){
        $msg = [
            'button'=>[[
                'type'=>'view',
                'name'=>'历史消息',
                'url'=>'http://paas.fengniao.info/info/history',
            ],[
                'type'=>'view',
                'name'=>'绑定账号',
                'url'=>'http://paas.fengniao.info/bind/bind',
            ]]
        ];
        $result = $this->wechat->createMenu($msg);

        $this->sendSuccess('处理成功！');
    }
}
