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
        //查询文章详情
        $articleid=I('articleId');
        $article = new ArticleModel();
        $item =$article->getDetail($articleid);
        $this->assign('item',$item);
        //保存阅读记录
        $user = new WxCustomerModel();
        $readartilce=new ReadArticleModel();
        $oriuserid=I('userid',$item['userid']);
        $wxuser = $user->getUser($this->user['openid']);
        if(empty($wxuser)){
            $user->save(['openid'=>$this->user['openid']]);
            $wxuser = $user->getUser($this->user['openid']);
        }
        $this->assign('user',json_encode($wxuser));
        $this->assign('userinfo',$wxuser);
        /*$data=[
            'article_id'=>$articleid,
            'userid'=>$wxuser['userid'],
            'original_userid'=>$oriuserid,
            'original_url'=>DOMAIN.$_SERVER['REQUEST_URI']
        ];
        $readartilce->save($data);

        //保存传播路径
        $propagate=new ArticlePropagateModel();
        //查询是否已经保存过
        if($propagate->getByUserid($wxuser['userid'],$articleid)){
            //保存过
        }else{
            //未保存过，保存传播节点
            //查询上级节点信息
            $oripropa=$propagate->getByUserid($oriuserid,$articleid);
            if(empty($oripropa)){
                SeasLog::debug('上级用户节点信息[articleid:'.$articleid.',userid:'.$oriuserid.']查询失败,传播节点保存失败!');
            }else{
                $prodata=[
                    'article_id'=>$articleid,
                    'article_name'=>$item['title'],
                    'userid'=>$wxuser['userid'],
                    'parent_id'=>$oriuserid,
                    'tree_no'=>$oripropa['tree_no'].'&'.$wxuser['userid'],
                    'insert_time'=>time_format(),
                    ];
                $propagate->insert($prodata);
            }
        }*/

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
        //记录分享
        $articleid=I('articleid');
        $article = new ArticleModel();
        $item =$article->getDetail($articleid);
        $user = new WxCustomerModel();
        $shareartilce=new ShareArticleModel();
        $oriuserid=I('userid',$item['userid']);
        $wxuser = $user->getUser($this->user['openid']);
        if(empty($wxuser)){
            $wxuser=$user->save(['openid'=>$this->user['openid']]);
        }
        $data=[
            'article_id'=>$articleid,
            'userid'=>$wxuser['userid'],
            'original_userid'=>$oriuserid,
            'original_url'=>DOMAIN.$_SERVER['REQUEST_URI']
        ];
        $shareartilce->save($data);
        //记录到传播图

        $propagate=new ArticlePropagateModel();
        //查询是否已经保存过
        if($propagate->getByUserid($wxuser['userid'],$articleid)){
            //保存过
        }else{
            //未保存过，保存传播节点
            //查询上级节点信息
            $oripropa=$propagate->getByUserid($oriuserid,$articleid);
            if(empty($oripropa)){
                SeasLog::debug('上级用户节点信息[articleid:'.$articleid.',userid:'.$wxuser['userid'].']查询失败,传播节点保存失败!');
            }else{
                $prodata=[
                    'article_id'=>$articleid,
                    'article_name'=>$item['title'],
                    'userid'=>$wxuser['userid'],
                    'parent_id'=>$oriuserid,
                    'tree_no'=>$oripropa['tree_no'].'&'.$wxuser['userid'],
                    'insert_time'=>time_format(),
                ];
                $propagate->insert($prodata);
            }
        }
    }

}