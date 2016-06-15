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
class InfoController extends Mall {

    //用户绑定
    public function historyAction() {
        $wxHistory = new WxHistoryModel();
        $list =$wxHistory->getMessageList($this->user['openid']);
        $this->assign('list',$list);
    }

    public function apitestAction() {

    }
}