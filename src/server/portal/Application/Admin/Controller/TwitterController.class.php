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

class TwitterController extends AdminController {
    // 房老师动态
    public function index() {
        $search       =   I('search');
        $map = [];
        if(!empty($search)){
            $map['t.title']  = array('like', '%'.(string)$search.'%');
        }
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'teacher_news t');
        $list  = $this->lists($model, $map,'','t.*');
        $this->assign('_list', $list);
        $this->meta_title = '房老师动态管理';
        $this->display();
    }
    
    // 添加动态
    public function add() {
        if (IS_POST) {
            $data = I('post.');
            $prefix = C('DB_PREFIX');
            $product = M()->table($prefix.'teacher_news');
            $data['insert_time'] = time_format();
            if ($product->data($data)) {
                if ($product->add() > 0) {
                    $this->success('添加成功', U('index'));
                } else {
                    $this->error('添加失败');
                }
            }
        }
        
        
        $this->meta_title = '添加动态';
        $this->display();
    }

    //产品编辑
    public function edit() {
        $id = I('id');
        if (empty($id)) $this->error('参数错误');

        $prefix = C('DB_PREFIX');
        if (IS_POST) {
            $data = I('post.');
            $club = M()->table($prefix.'teacher_news');
            $data['update_time'] = time_format();
            if ($club->create($data) &&
                $club->where(['id'=>$id])->save() !== false) {
                $this->success('保存成功', U('index'));
            } else {
                $this->error('保存失败');
            }
        }

        $model = M()->table($prefix.'teacher_news')
            ->where(['id'=>$id])
            ->find();
        $this->assign('item', $model);
        $this->meta_title = '产品编辑';
        $this->display('add');
    }

    //TODO:俱乐部删除
    public function delete() {

    }


}