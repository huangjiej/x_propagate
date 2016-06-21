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
                'name'=>'文章列表',
                'url'=>'http://xp.fengniao.info/article/list',
            ],[
                'type'=>'view',
                'name'=>'传播图',
                'url'=>'http://xp.fengniao.info/propagate/type3',
            ],[
                'type'=>'view',
                'name'=>'用户画像',
                'url'=>'http://xp.fengniao.info/user/tag',
            ]]
        ];
        $result = $this->wechat->createMenu($msg);

        $this->sendSuccess('处理成功！');
    }
}
