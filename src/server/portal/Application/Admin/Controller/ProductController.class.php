<?php
/**
 * Created by PhpStorm.
 * User: sks
 * Date: 2016/3/30
 * Time: 20:54
 */

namespace Admin\Controller;
use Admin\Service\ApiService;
use Think\Model;
use User\Api\UserApi;

class ProductController extends AdminController {
    // 产品管理
    public function index() {
        $search       =   I('search');
        $map = [];
        if(!empty($search)){
            $map['p.name']  = array('like', '%'.(string)$search.'%');
        }
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'product p');
        $list  = $this->lists($model, $map,'','p.*');
        $this->assign('_list', $list);
        $this->meta_title = '产品管理';
        $this->display();
    }
    
    //添加产品
    public function add() {
        if (IS_POST) {
            $data = I('post.');
            $prefix = C('DB_PREFIX');
            $product = M()->table($prefix.'product');

            foreach ($data as $k => $v) {
                if (empty($v)) unset($data[$k]);
            }

            $data['cur_price'] = price_dispose_fen($data['cur_price']);
            $data['old_price'] = price_dispose_fen($data['old_price']);
            $data['insert_time'] = time_format();
            $data['update_time'] = time_format();
            if ($product->create($data)) {
                if ($product->add() > 0) {
                    $this->success('添加成功', U('index'));
                } else {
                    $this->error('添加失败');
                }
            }
        }
        
        
        $this->meta_title = '添加产品';
        $this->display();
    }

    //产品编辑
    public function edit() {
        $id = I('id');
        if (empty($id)) $this->error('参数错误');

        $prefix = C('DB_PREFIX');
        if (IS_POST) {
            $data = I('post.');
            $club = M()->table($prefix.'product');
            $data['update_time'] = time_format();
            if (strpos($data['cur_price'], ',') === false && strpos($data['old_price'], ',') === false) {
                $data['cur_price'] = price_dispose_fen($data['cur_price']);
                $data['old_price'] = price_dispose_fen($data['old_price']);
            } else {
                $data['cur_price'] = intval(price_dispose_fen(str_replace(',','',$data['cur_price'])));
                $data['old_price'] = intval(price_dispose_fen(str_replace(',','',$data['old_price'])));
            }
            if ($club->create($data) &&
                $club->where(['id'=>$id])->save() !== false) {
                $this->success('保存成功', U('index'));
            } else {
                $this->error('保存失败');
            }
        }

        $model = M()->table($prefix.'product')
            ->where(['id'=>$id])
            ->find();
        $this->assign('item', $model);
        $this->meta_title = '产品编辑';
        $this->display('add');
    }

    //TODO:俱乐部删除
    public function delete() {

    }

    //俱乐部动态管理
    public function news() {
        $search       =   I('search');
        $map['cn.status']  = ['gt',0];
        if(is_numeric($search)){
            $map['cn.mobile']=['like', '%' . intval($search) . '%'];//   array(intval($search),array('like','%'.$search.'%'),'_multi'=>true);
        }elseif(!empty($search)){
            $map['cn.club_name|wu.nickname']  = array('like', '%'.(string)$search.'%');
        }
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'club_news cn')
            ->join($prefix.'club c on cn.cid = c.id', 'left')
            ->join($prefix.'wx_user wu on c.uid = wu.wx_id', 'left');
        $list  = $this->lists($model, $map,'','cn.*, wu.nickname, c.club_name,c.mobile');
        $this->assign('_list', $list);
        $this->meta_title = '俱乐部动态管理';
        $this->display();
    }

    //查看动态详情
    public function newsshow() {
        $id = I('id');
        if (empty($id)) $this->error('参数错误');

        $prefix = C('DB_PREFIX');
        $new = M()->table($prefix.'club_news cn')
            ->join($prefix.'club c on cn.cid = c.id', 'left')
            ->join($prefix.'wx_user wu on c.uid = wu.wx_id', 'left')
            ->where(['cn.id'=>$id])
            ->field('cn.*, wu.nickname, c.club_name,c.mobile')
            ->find();

        //dump($new);
        $this->assign('item', $new);
        $this->meta_title = '俱乐部动态管理';
        $this->display();
    }

    public function newsdelete() {
        //如存在id字段，则加入该条件
        $id    = array_unique((array)I('id',0));
        $id    = is_array($id) ? implode(',',$id) : $id;
        if(empty($id))$this->error('参数错误！');
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'club_news');
        $result = $model->where('id in ('. $id . ')')->save(['status'=>-1]);
        if($result !== false){
            $this->success('修改成功！',U('news'));
        }else{
            $this->error('修改失败！');
        }
    }

    public function member() {
        $search       =   I('search');
        if(is_numeric($search)){
            $map['c.mobile']=['like', '%' . intval($search) . '%'];//   array(intval($search),array('like','%'.$search.'%'),'_multi'=>true);
        }elseif(!empty($search)){
            $map['c.club_name|wu.nickname']  = array('like', '%'.(string)$search.'%');
        }
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'club_member cm')
            ->join($prefix.'club c on cm.cid = c.id', 'left')
            ->join($prefix.'wx_user wu on cm.wx_id = wu.wx_id', 'left');
        $list  = $this->lists($model, $map,'','cm.*, c.club_name , c.mobile, wu.nickname, wu.headimgurl, wu.insert_time as wu_insert_time');
        $this->assign('_list', $list);
        $this->meta_title = '俱乐部会员管理';
        $this->display();
    }
}