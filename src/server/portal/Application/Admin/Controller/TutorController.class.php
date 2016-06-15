<?php
/**
 * Created by PhpStorm.
 * User: sks
 * Date: 2016/4/6
 * Time: 15:43
 */
namespace Admin\Controller;
use Admin\Service\ApiService;
use Think\Model;
use User\Api\UserApi;

class TutorController extends AdminController {
    public function index(){
        $nickname       =   I('nickname');
        $map['t.status']  =   array('egt',0);
        if(is_numeric($nickname)){
            $map['t.id']=   ['like', '%' . intval($nickname) . '%'];
        }elseif(!empty($nickname)){
            $map['t.title']    =   array('like', '%'.(string)$nickname.'%');
        }


        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'tutor t');
        $list   = $this->lists($model, $map,'','t.*');
        $this->assign('_list', $list);
        $this->meta_title = '用户信息';
        $this->display();
    }
    
    public function add(){
        $prefix = C('DB_PREFIX');
        if (IS_POST) {
            $data = I('post.');
            $return = M()->table($prefix.'tutor');
            $data['insert_time'] = time_format();
            $data['update_time'] = time_format();
            $data['work_time'] = time_format();
            foreach ($data['names'] as $k => $v) {
                $parter[] = ['name'=>$data['names'][$k], 'job'=>$data['jobs'][$k]];
            }
            $data['parter'] = json_encode($parter);
            if ($return->create($data)) {
                $result = $return->add();
                if ($result > 0) {
                    $this->success('保存成功！',U('index'));
                } else {
                    $this->error('保存失败！');
                }
            } else {
                $this->error('保存失败！');
            }
        }

        $search  =  I('search');
        $data = [];
        $map = [];

        if (!empty($search)) {
            $map['c.company_name|c.corporation_name']    =   array('like', '%'.(string)$search.'%');

            $model = M()->table($prefix.'company c')
                ->join($prefix.'company_reg cr on cr.uid = c.uid','left')
                ->join($prefix.'ucenter_member um on um.id=cr.uid','left')
                ->join($prefix.'auth_group_access aga on aga.uid=cr.uid', 'left')
                ->join($prefix.'auth_group ag on ag.id=aga.group_id', 'left');
            $data = $model->field(array('cr.*','c.*', 'cr.insert_time as time'))->where($map)->find();

            if (empty($data)) {
                $this->error('找不到该企业，请重新输入企业名称或法人名称查询');
            }
        }
        $this->assign('item', $data);
        $this->assign('search', $search);
        $this->meta_title = '添加回访';
        $this->display();
    }
    
    public function edit() {
        $id = I('id');
        $prefix = C('DB_PREFIX');
        if (IS_POST) {
            $data = I('post.');
            $return = M()->table($prefix.'tutor');
            $data['update_time'] = time_format();
            foreach ($data['names'] as $k => $v) {
                $parter[] = ['name'=>$data['names'][$k], 'job'=>$data['jobs'][$k]];
            }
            $data['parter'] = json_encode($parter);

            if ($return->create($data) &&
                $return->where(['id'=>I('id')])->save() !== false) {
                $this->success('保存成功！',U('index'));
            } else {
                $this->error('保存失败！');
            }
        }
        if (empty($id)) $this->error('该辅导记录不存在');
        $data =  M()->table($prefix.'tutor t')
            ->join($prefix.('company c on t.uid=c.uid'))
            ->field('t.*, c.corporation_name')
            ->where(['t.id'=>$id])
            ->find();
        $this->assign('item', $data);
        $this->meta_title = '添加回访';
        $this->display();
        
    }
    
    public function delete() {
        if (IS_AJAX) {
            $id = I('id');
            if (empty($id)) $this->error('参数错误!');
            $prefix = C('DB_PREFIX');
            if (M()->table($prefix.'tutor')->where(['id'=>$id])->save(['status'=> -1]) !== false) {
                $this->success('删除成功', U('index'));
            } else {
                $this->error('删除失败');
            }
        }
    }
}