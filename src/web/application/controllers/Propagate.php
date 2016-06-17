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
class PropagateController extends Mall {

    public function indexAction() {
        $articleid=I('articleid',1);
        $model = new ArticlePropagateModel();
        $tree = $model->getTree(0,['userid','name','parent_id'],$articleid);
        $this->assign('tree', json_encode($tree));
    }

    public function type2Action() {

    }

}