<?php

namespace Admin\Controller;
use Admin\Service\ApiService;
use Think\Model;
use User\Api\UserApi;

class MeetingController extends AdminController {
    public function index(){
        $search       =   I('search');
        $map['status'] = ['gt',0];
        if(!empty($search)){
            $map['m.title']  = array('like', '%'.(string)$search.'%');
        }
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'meeting m');
        $list   = $this->lists($model, $map,'','m.*');

        $this->assign('_list', $list);
        $this->meta_title = '用户信息';
        $this->display();
    }

    public function add() {
        if (IS_POST) {
            $data = I('post.');
            unset($data['parse']);
            $prefix = C('DB_PREFIX');
            $return = M()->table($prefix.'meeting');
            $data['insert_time'] = time_format();
            $data['update_time'] = time_format();
            $data['process'] = str_replace(chr(13),'<br>',$data['process']);
            if ($return->create($data)) {
                $result = $return->add();
                if ($result > 0) {
                    $this->success('创建成功！',U('Meeting/index'));
                } else {
                    $this->error('创建失败！');
                }
            } else {
                $this->error('创建失败！');
            }
        }

        $this->meta_title = '添加会议';
        $this->display('edit');
    }

    public function edit() {
        $id = I('id');
        if (empty($id)) $this->error('参数错误');

        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'meeting m');

        if (IS_POST) {
            $data = I('post.');
            unset($data['parse']);
            $data['update_time'] = time_format();
            $data['process'] = str_replace(chr(13),'<br>',$data['process']);
            if(!$model->where(array('id'=>$id))
                ->save($data)){
                $this->error('修改失败！');
            }

            $this->success('保存成功！',U('Meeting/index'));
        }


        $data = $model->field(array('m.*'))
            ->where(['id'=>$id])->find();
        if (empty($data)) {
            $this->error('该回访不存在!');
        }
        $data['process'] = str_replace('<br>',chr(13),$data['process']);
        $this->assign('item',$data);
        $this->meta_title = '会员回访详细信息';
        $this->display();
    }

    public function meetingDelete(){
        //如存在id字段，则加入该条件
        $id    = array_unique((array)I('id',0));
        $id    = is_array($id) ? implode(',',$id) : $id;
        if(empty($id))$this->error('参数错误！');
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'meeting');
        $result = $model->where('id in ('. $id . ')')->save(['status'=>-1]);
        if($result !== false){
            $this->success('修改成功！',U('index'));
        }else{
            $this->error('修改失败！');
        }
    }

    //查看所有报名表
    public function enroll() {

        $data = I('get.');
        foreach ($data as $key => $value) {
            if (empty($value)) unset($data[$key]);
        }
        $search       =   $data['search'];
        //$map['um.status']  =   array('egt',0);
        $map['n.status'] = ['egt', 0];
        if(is_numeric($search)){
            $map['n.mobile']=['like', '%' . intval($search) . '%'];//   array(intval($search),array('like','%'.$search.'%'),'_multi'=>true);
        }elseif(!empty($search)){
            $map['n.name|m.title']  = array('like', '%'.(string)$search.'%');
        }

        if (!empty($data['meeting'])) $map['m.id'] = $data['meeting'];
        if (!empty($data['is_sign'])) $map['n.is_sign'] = $data['is_sign'];
        if (!empty($data['is_affirm'])) $map['n.is_affirm'] = $data['is_affirm'];

        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'enroll n')
            ->join($prefix.'meeting m on n.meeting_id=m.id', 'left');
        $list  = $this->lists($model, $map,'','n.*, m.title, m.id as m_id');


        $meetings = M()->table($prefix.'meeting')->where(['status'=>['egt', 0]])->select();
        $this->assign('meetings', $meetings);
        $this->assign('_list', $list);
        $this->meta_title = '报名管理';
        $this->display();
    }
    
    //添加企业信息
    public function companyAdd($eid) {
        if (empty($eid)) $this->error('报名信息不存在!');
        $prefix = C('DB_PREFIX');
        if (IS_POST) {
            $data = I('post.');
            $data['eid'] = $eid;
            $data['insert_time']=time_format();
            $data['update_time'] = time_format();
            foreach ($data as $key=>$value) {
                if (empty($value)) unset($data[$key]);
            }
            $msg = '';
            if(!empty($data['notify'])){

                $return = $this->_enroll_notify($eid);
                if(!$return[0]){
                    $msg = '发送短信失败！';
                }
                if(isset($return[1]) && !$return[1]){
                    $msg .= '发送微信通知失败！';
                }
            }
            $model = M()->table($prefix.'company_reg');
            $data['insert_time'] = time_format();
            $data['update_time'] = time_format();
            if ($model->create($data)) {
                $result = $model->add();
                if ($result > 0) {
                    if(!empty($msg)){
                        $this->error('信息保存成功，但'.$msg);
                    }
                    $this->success('保存成功！',U('enroll'));
                } else {
                    $this->error('保存失败！');
                }
            } else {
                $this->error('创建失败！');
            }
        }
    
        $enroll = M()->table($prefix.'enroll e')
            ->field(['e.*'])
            ->where(['id'=>$eid])->find();
        
        $this->assign('enroll', $enroll);
        $this->meta_title = '公司注册信息';
        $this->display();
    }

    private function _enroll_notify($eid){
        $prefix = C('DB_PREFIX');

        $item = M()->table($prefix.'enroll e')
            ->join($prefix.'wx_user b on e.wx_id = b.wx_id','LEFT')
            ->join($prefix.'meeting c on e.meeting_id = c.id')
            ->field('e.id,e.name,e.mobile,b.openid,b.subscribe,c.title,c.agenda_date,c.address')
            ->where(['e.id'=>$eid])
            ->find();

        if(empty($item)){
            $this->error('报名信息不存在！');
        }

        //修改报道确认状态
        M('enroll')->where(['id'=>$eid])->save(['is_affirm'=>'YES']);

        $return = [];
        //发送短信通知
        $content = sprintf(C('SMS_TPL1'),$item['name'],$item['title'],$item['agenda_date'],$item['address']);
        $return[] = send_sms($item['mobile'],$content);
//        $return[] = false;
//        $return[] = false;

        if(!empty($item['openid']) && intval($item['subscribe']) > 0){

            $api = new ApiService();
            $resp = $api->setData(['enroll'=>$item])
                ->send('/wechat/message/enrollAffirm');
            $return[] = check_resp($resp);
        }

        return $return;
    }

    //编辑注册信息
    public function companyEdit($eid) {
        if (empty($eid)) $this->error('参数错误，报名ID不能为空!');
        $prefix = C('DB_PREFIX');
        if (IS_POST) {
            $data = I('post.');
            $id = $data['id'];unset($data['id']);
            $data['eid'] = $eid;
            $data['update_time'] = time_format();
            foreach ($data as $key=>$value) {
                if (empty($value)) unset($data[$key]);
            }
            $msg = '';
            if(!empty($data['notify'])){

                $return = $this->_enroll_notify($eid);
                if(!$return[0]){
                    $msg = '发送短信失败！';
                }
                if(isset($return[1]) && !$return[1]){
                    $msg .= '发送微信通知失败！';
                }
            }
            $modle = M('company_reg');
            if($modle->where(array('id'=>$id))->save($data)){
                if(!empty($msg)){
                    $this->error('信息保存成功，但'.$msg);
                }
                $this->success('保存成功！', U('enroll'));
            }
            $this->error('保存失败！');
        }

        $enroll = M()->table($prefix.'enroll e')
            ->field(['e.*'])
            ->where(['id'=>$eid])->find();

        $company = M()->table($prefix.'company_reg')->where(['eid'=>$eid])->find();

        $this->assign('item', $company);
        $this->assign('enroll', $enroll);
        $this->meta_title = '公司注册信息';
        $this->display('companyadd');
    }

    //编辑报名信息
    public function enrollEdit($id) {
        if(empty($id)) $this->error('参数错误');
        $prefix = C('DB_PREFIX');
        if (IS_POST) {
            $data = I('post.');
            unset($data['parse']);
            $data['update_time'] = time_format();
            $data['referee'] = intval($data['referee']);
            if(M()->table($prefix.'enroll')->where(array('id'=>$id))
                ->save($data) === false){
                $this->error('修改失败！');
            }
            $this->success('保存成功！',U('Meeting/enroll'));
        }
        $meetings = M()->table($prefix.'meeting')->where(['status'=>1])->select();
        $enroll = M()->table($prefix.'enroll')->where(['id'=>$id])->find();
        if (empty($enroll)) $this->error('没有找到该报名表');
        $this->assign('item', $enroll);
        $this->assign('meetings', $meetings);
        $this->meta_title = '编辑报名信息';
        $this->display('enrolladd');
    }

    //新建报名
    public function enrollAdd() {
        $prefix = C('DB_PREFIX');
        if (IS_POST) {
            $model = M()->table($prefix.'enroll');
            $_POST['insert_time'] = time_format();
            $_POST['update_time'] = time_format();
            $_POST['referee'] = intval($_POST['referee']);
            if ($model->create()) {
                $result = $model->add();
                if ($result > 0) {
                    $this->success('创建成功！',U('Meeting/enroll'));
                } else {
                    $this->error('创建失败！');
                }
            } else {
                $this->error('创建失败！');
            }
        }
        $meetings = M()->table($prefix.'meeting m')->where(['status'=>1])->select();
        
        $this->assign('meetings', $meetings);
        $this->meta_title = '添加报名信息';
        $this->display();
    }

    //删除报名
    public function enrollDelete(){
        //如存在id字段，则加入该条件
        $id    = array_unique((array)I('id',0));
        $id    = is_array($id) ? implode(',',$id) : $id;
        if(empty($id))$this->error('参数错误！');
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'enroll');
        $result = $model->where('id in ('. $id . ')')->save(['status'=>-1]);
        if($result !== false){
            $this->success('删除成功！',U('enroll'));
        }else{
            $this->error('删除失败！');
        }
    }
}