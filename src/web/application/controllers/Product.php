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
class ProductController extends Mall {
    public function indexAction() {
        $list = M('t_product(p)')->select(['p.*'],['and'=>['status'=>1,'type'=>3]]);
        foreach ($list as &$v) {
            $v['cur_price'] = price_format($v['cur_price']);
            $v['old_price'] = price_format($v['old_price']);
            $v['main_pic'] = imageView2($v['main_pic'],360,160);
        }
        $this->assign('list', $list);

        $this->layout->meta_title = '培训课程';
    }
    
    public function itemAction() {
        $id = I('id');
        if (empty($id)) {
            $this->error('参数为空');
        }
        $product = M('t_product(p)')->get(['p.*'], ['id' => $id]);
        if ($product) {
            $product['cur_price'] = price_format($product['cur_price']);
        }
        $this->assign('product', $product);

        $this->layout->meta_title = '培训课程详情';
    }
}