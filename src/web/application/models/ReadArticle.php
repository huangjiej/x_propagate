<?php
/**
 * Created by PhpStorm.
 * User: xuebin<406964108@qq.com>
 * Date: 2014/12/24
 * Time: 17:13
 * @copyright Copyright (c) 2014
 */

class ReadArticleModel extends Model{

    public $table = 't_read_article';

    public function save(Array $data){
        $data['insert_time'] = time_format();
        return $this->insert($data);
    }



}
