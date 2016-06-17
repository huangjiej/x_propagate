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
    public $list;
    public function getByUserid($userid,$articleid){
        return $this->get('*',['and'=>['userid'=>$userid,'article_id'=>$articleid]]);
    }

    public function getTree($id = 0, $field = true,$articleid){
        /* 获取当前分类信息 */
        if($id){
            $info = $this->info($id);
            $id   = $info['id'];
        }

        /* 获取所有分类 */
//        $map  = array('status' => 'OK#');

        $map = [];
        $this->list = $this->select($field,['article_id'=>$articleid]);
        //var_dump($this->last_query());
        $tree = $this->list_to_tree($this->list, $pk = 'userid', $pid = 'parent_id', $child = 'children');

        /* 获取返回数据 */
        if(isset($info)){ //指定分类则返回当前分类极其子分类
            $info['_'] = $tree;
        } else { //否则返回所有分类
            $info = $tree;
        }

        return $info;
    }

    function list_to_tree($list, $pk='userid', $pid = 'parent_id', $child = '_child') {
        // 创建Tree
        $tree = array();
        if(is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] =& $list[$key];
            }

            foreach($list as $key => $data){
                //判断是否为父级
                $parentId =  $data[$pid];
                if (empty( $parentId)||$parentId==0) {
                    $tree[] =& $list[$key];
                }else{
                    if (isset($refer[$parentId])) {
                        $parent =& $refer[$parentId];
                        $parent[$child][] =& $list[$key];
                    }
                }
            }
        }
        return $tree;
    }



}
