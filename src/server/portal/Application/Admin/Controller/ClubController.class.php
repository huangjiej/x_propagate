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

class ClubController extends AdminController {
    // 俱乐部审核
    public function index() {
        $search       =   I('search');
        $map = [];
        if(is_numeric($search)){
            $map['c.mobile']=['like', '%' . intval($search) . '%'];//   array(intval($search),array('like','%'.$search.'%'),'_multi'=>true);
        }elseif(!empty($search)){
            $map['c.club_name|wu.nickname']  = array('like', '%'.(string)$search.'%');
        }
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'club c')
            ->join($prefix.'wx_user wu on c.wx_id = wu.wx_id', 'left');
        $list  = $this->lists($model, $map,'','c.*, wu.nickname');
        $this->assign('_list', $list);
        $this->meta_title = '俱乐部审核';
        $this->display();
    }

    //俱乐部编辑审核
    public function edit() {
        $id = I('id');
        if (empty($id)) $this->error('参数错误');

        $prefix = C('DB_PREFIX');
        if (IS_POST) {
            $data = I('post.');
            $club = M()->table($prefix.'club');
            $data['update_time'] = time_format();
            if ($club->create($data) &&
                $club->where(['id'=>$id])->save() !== false) {
                $this->success('保存成功', U('index'));
            } else {
                $this->error('保存失败');
            }
        }

        $model = M()->table($prefix.'club c')
            ->join($prefix.'wx_user wu on c.wx_id = wu.wx_id', 'left')
            ->where(['id'=>$id])
            ->find();
        $this->assign('item', $model);
        $this->meta_title = '俱乐部审核';
        $this->display();
    }

    //TODO:俱乐部删除
    public function delete() {

    }

    //俱乐部动态管理
    public function news() {
        $search       =   I('search');
        $map['cn.status']  = ['gt',0];
        if(!empty($search)){
            $map['c.club_name|wu.nickname']  = array('like', '%'.(string)$search.'%');
        }
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'club_news cn')
            ->join($prefix.'club c on cn.cid = c.id', 'left')
            ->join($prefix.'wx_user wu on c.wx_id = wu.wx_id', 'left');
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
            ->join($prefix.'wx_user wu on c.wx_id = wu.wx_id', 'left')
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
        if(!empty($search)){
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