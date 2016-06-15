<?php
/**
 * Created by PhpStorm.
 * User: xuebingwang
 * Date: 2016/3/30
 * Time: 15:22
 */
use \Yaf\Controller_Abstract;

class ShowController extends Controller_Abstract{

    public function picAction(){
        $pic = urldecode(I('pic'));
        if(empty($pic)){
            $this->error('图片地址为空！');
        }
        $this->redirect(imageView2($pic));
        die;
    }
}