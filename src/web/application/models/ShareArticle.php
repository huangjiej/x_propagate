<?php
/**
 * Created by PhpStorm.
 * User: xuebin<406964108@qq.com>
 * Date: 2014/12/24
 * Time: 17:13
 * @copyright Copyright (c) 2014
 */

class ShareArticleModel extends Model{

    public $table = 't_article';

    public function save(Array $data){

        $where = ['unionid'=>$data['unionid']];
        $uid = $this->get('userid',$where);

        //如果找不到用户数据, 执行注册流程
        if(empty($uid)){
            //插入至微信用户表
            return $this->reg($data);
        }

        //这两项不允许修改, 也不存在修改的可能
        unset($data['openid']);
        unset($data['unionid']);

        $data['update_time'] = time_format();
        return $this->update($data,['userid'=>$uid]);
    }



}
