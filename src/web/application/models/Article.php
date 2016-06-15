<?php
/**
 * Created by PhpStorm.
 * User: xuebin<406964108@qq.com>
 * Date: 2014/12/24
 * Time: 17:13
 * @copyright Copyright (c) 2014
 */

class ArticleModel extends Model{

    public $table = 't_article';

    public function getDetail($articleid){

        return $this->get('*',['id'=>$articleid]);
    }



}
