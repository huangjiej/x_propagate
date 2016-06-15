<?php
/**
 * Created by PhpStorm.
 * User: xuebin<406964108@qq.com>
 * Date: 2014/12/24
 * Time: 17:13
 * @copyright Copyright (c) 2014
 */

class UserTagModel extends Model{

    public $table = 't_user_tag';

    public function save(Array $data){

        $where = ['openid'=>$data['openid']];
	    $usertag = $this->get('*',$where);

        //如果找不到用户数据, 执行注册流程
        if(empty($usertag)){
            //插入至用户画像表
            return $this->reg($data);

        }

        $data['update_time'] = time_format();
        return $this->update($data,['id'=>$usertag['id']]);
    }

    public function reg(Array $data){


        $data['insert_time'] = time_format();
        $data['update_time'] = time_format();
        return $this->insert($data);
    }

    public function getUser($openid){
        $field = [
            'openid',
            'userid',
            'nickname',
            'headimgurl',
            'unionid',
            'subscribe',
            'b.mobile_num'
        ];
        return $this->get(
            [
                '[>]t_user(b)'=>['openid'=>'union_id'],
            ],
            $field,
            ['AND'=>['openid'=>$openid]]
        );
    }
}
