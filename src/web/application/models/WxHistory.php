<?php
/**
 * Created by PhpStorm.
 * User: xuebin<406964108@qq.com>
 * Date: 2014/12/24
 * Time: 17:13
 * @copyright Copyright (c) 2014
 */

class WxHistoryModel extends Model{

    public $table = 't_wx_history';

    public function getMessageList($openid){

        return $this->select('*',['openid'=>$openid]);
    }



}
