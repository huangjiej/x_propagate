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
class ArticleController extends Mall {

    public function listAction(){
        $article = new ArticleModel();
        $list =$article->getList();
        $this->assign('list',$list);
    }

    public function showAction() {
        $articleid=I('articleid');
        $article = new ArticleModel();
        $item =$article->getDetail($articleid);
        $this->assign('item',$item);
    }

    function editAction(){
        $mobilenum=I('mobile');
        $mobile=substr_replace($mobilenum,'*****',3,5);
        $this->assign('mobile',$mobile);
    }

    /**
     * 分享接口，
     * 保存分享信息 t_share_article,
     * 更新用户画像t_user_tag，
     * 更新该文章的传播路径t_article_propagation_path
     */
    function shareAction(){

    }

}