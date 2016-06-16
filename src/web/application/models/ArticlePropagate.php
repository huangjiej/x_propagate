<?php
/**
 * Created by PhpStorm.
 * User: xuebin<406964108@qq.com>
 * Date: 2014/12/24
 * Time: 17:13
 * @copyright Copyright (c) 2014
 */

class ArticlePropagateModel extends Model{

    public $table = 't_article_propagate';

    public function getByUserid($userid,$articleid){
        return $this->select('*',['userid'=>$userid,'article_id'=>$articleid]);
    }


}
