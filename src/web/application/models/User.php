<?php
/**
 * Created by PhpStorm.
 * User: xuebin<406964108@qq.com>
 * Date: 2014/12/24
 * Time: 17:13
 * @copyright Copyright (c) 2014
 */

class UserModel extends Model{

    public $table = 't_user';

    /**
     * 传入openid，判断用户是否绑定过
     * @param integer
     * @return bool
     * */
    public function is_bind($openid) {
        return $this->get('*', ['union_id' => $openid]);
    }

    /**
     * 传入手机号码，判断用户是否存在
     * @param integer
     * @return bool
     * */
    public function is_user($mobile) {
        return $this->get('*', ['mobile_num' => $mobile]);
    }

    /**
     * 传入手机号码,密码，判断用户密码是否正确
     * @param integer
     * @return bool
     * */
    public function is_password($mobile,$paasword) {

        return $this->get(
            [
                '[>]t_user_password(b)'=>['id'=>'user_id'],
            ],
            '*',
            ['AND'=>['mobile_num'=>$mobile,'b.password'=>$paasword]]
        );
    }

    /**
     * 绑定已经存在的用户，添加用户的wx_id
     * @param string
     * @param string
     * @return integer
     */
    public function bind($openid, $mobile) {
       return $this->update(['union_id'=> $openid], ['mobile_num' => $mobile]);
    }

    /**
     * 传入用户数据信息数组，添加到数据库中
     * @param array $data
     * @return integer
     */
    public function add(Array $data) {
        $data['add_time'] = time_format();
        $data['update_time'] = time_format();
        return $this->insert($data);
    }


    /**
     * @param string $search
     * @return array
     */
    public function search($search) {
        return $this->select(
            [
                
            ],
            [],
            []
        );
    }

    /**
     * 查询用户信息以及最新的健康状况
     * @return array
     */
    public function list_with_body_info() {

    }

}
