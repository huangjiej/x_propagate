<?php
/**
 * Created by PhpStorm.
 * User: sks
 * Date: 2016/3/28
 * Time: 18:46
 */
namespace Admin\Controller;
use Admin\Service\ApiService;
use Think\Model;
use User\Api\UserApi;

class MemberController extends AdminController {
    /**
     * 用户管理首页
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function index(){
        $nickname       =   I('nickname');
        $map['m.status']  =   array('egt',0);
        if(is_numeric($nickname)){
            $map['c.uid|cr.mobile']=   ['like', '%' . intval($nickname) . '%'];
        }elseif(!empty($nickname)){
            $map['m.nickname']    =   array('like', '%'.(string)$nickname.'%');
        }

        $map['aga.group_id'] = ['in', [5,6]];
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'ucenter_member um')
            ->join($prefix.'member m on m.uid = um.id','left')
            ->join($prefix.'auth_group_access aga on aga.uid = um.id', 'left')
            ->join($prefix.'company_reg cr on cr.uid = um.id','left')
            ->join($prefix.'company c on c.uid=um.id','left');
        $list   = $this->lists($model, $map,'','m.*,um.username,um.id,aga.group_id,cr.eid,
                        cr.position ,cr.company_name, cr.chairman_name, cr.insert_time as reg_time, cr.id as cr_id, c.id as c_id');
        $this->assign('_list', $list);
        $this->meta_title = '用户信息';
        $this->display();
    }

    private function _enroll_notify($mobile, $name, $group){
        //发送短信通知
        $content = sprintf(C('SMS_TPL2'),$name,$group);
        return send_sms($mobile,$content);
    }

    //添加会员
    public function add() {
        $prefix = C('DB_PREFIX');
        if (IS_POST) {
            if(empty(I('group_id'))) $this->error('请选择客户类型!');
            //创建ucenter_member
            $userData['username'] = I('mobile');
            $userData['email'] = I('email');
            $userData['password'] = '';
            $userData['status'] = 2;
            $user = M()->table($prefix.'ucenter_member');
            //判断手机号码是否注册
            if ($user->where(['username'=>$userData['username']])->find()) {
                $this->error('该用户手机号码已经被注册!');
            }

            if (M()->table($prefix.'ucenter_member')->create($userData)) {
                $user_id = $user->add();
                if ($user_id > 0) {
                    //创建member
                    $memberData['uid'] = $user_id;
                    $memberData['nickname'] = I('chairman_nickname');
                    $memberData['status'] = 1;
                    $member = M()->table($prefix.'member');
                    if ($member->create($memberData)) {
                        $memberResult = $member->add();
                        if ($memberResult > 0) {
                            //设置用户级别
                            $group = M()->table($prefix.'auth_group_access');
                            if ($group->create(['uid'=>$user_id,'group_id'=>I('group_id')])){
                                $groupResult = $group->add();
                                if ($groupResult> 0) {
                                    //将company_reg关联到会员
                                    $company_reg = M()->table($prefix.'company_reg');
                                    if ($company_reg->where(['id'=>I('id')])->save(['uid'=>$user_id]) === false) {
                                        $this->error('操作失败');
                                    }else {
                                        $company = M()->table($prefix.'company');
                                        $company_data = I('post.');
                                        $company_data['uid'] = $user_id;
                                        if ($company->create($company_data) &&
                                            $company->add() > 0) {
                                            //发送短信
                                            $group_name = $this->get_group_name(intval(I('group_id')));//I('mobile');I('chairman_nickname');
                                            if ($this->_enroll_notify(I('mobile'), I('chairman_nickname'),$group_name)){
                                                $this->success('操作成功！',U('index'));
                                            } else {
                                                $this->error('数据保存成功，短信发送失败');
                                            }
                                        }
                                    }
                                }else {
                                    $this->error('设置权限失败！');
                                }
                            }
                        } else {
                            $this->error('创建Member失败！');
                        }
                    }
                } else {
                    $this->error('创建用户失败！');
                }
            }
        }

        $search  =  I('search');
        $meeting_id = I('meeting_id');
        $data = [];
        $map = [];

        if (!empty($search)) {
            if (intval($meeting_id) <= 0) {
                $this->error('搜索条件不对，请先选择场次，再输入要搜索的名称或手机号码');
            }
            if(is_numeric($search)){
                $map['cr.mobile']=['like', '%' . intval($search) . '%'];
            }elseif(!empty($search)){
                $map['cr.chairman_name|cr.chairman_nickname']    =   array('like', '%'.(string)$search.'%');
            }
            $map['e.meeting_id'] = intval($meeting_id);
            $map['cr.uid'] = ['EXP', 'is null'];
            //$map['e.is_affirm'] = 'YES';
            //$map['e.is_sign'] = 'YES';
            $model = M()->table($prefix.'company_reg cr')
                ->join($prefix.'enroll e on e.id=cr.eid','left');

            $data = $model->field(array('cr.*'))->where($map)->select();
        }

        $meetings = M()->table($prefix.'meeting')->where(['status'=>1])->select();

        $this->assign('meetings', $meetings);
        $this->assign('_list', $data);
        $this->assign('search', $search);
        $this->meta_title = '注册会员类型';
        $this->display();
    }
    private function get_group_name($id){
        switch ($id){
            case 5:
                return '银种子';
            case 6:
                return '金种子';
            default:
                return $this->error('提交失败');
        }
    }
    //编辑会员
    public function edit() {
        $prefix = C('DB_PREFIX');
        $uid = I('uid');
        if (empty($uid)) $this->error('参数错误');
        if (IS_POST) {
            $group = M()->table($prefix.'auth_group_access');
            if($group->where(['uid'=>$uid])->save(['group_id'=>I('group_id')])  === false) {
                $this->error('修改失败!');
            } else {
                $this->success('修改成功!',U('index'));
            }
        }

        $company = M()->table($prefix.'company_reg cr')
            ->join($prefix.'auth_group_access aga on aga.uid = cr.uid', 'left')
            ->where(['cr.uid' => $uid])
            ->find();


        $this->assign('item', $company);
        $this->meta_title = '修改会员类型';
        $this->display();
    }

    //会员建档审核首页
    public function companyIndex() {
        $search       =   I('search');
        //$map['um.status']  =   array('egt',0);
        $map = [];
        if(is_numeric($search)){
            $map['c.mobile']=['like', '%' . intval($search) . '%'];
        }elseif(!empty($search)){
            $map['c.chairman_name|c.chairman_nickname']    =   array('like', '%'.(string)$search.'%');
        }

        //$map['aga.group_id'] = ['in', [5,6]];
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'company c')
            ->join($prefix.'company_reg cr on cr.uid = c.uid', 'left')
            ->join($prefix.'auth_group_access aga on aga.uid=c.uid', 'left')
            ->join($prefix.'auth_group ag on ag.id=aga.group_id', 'left');
        $map['c.check_status']='WAT';
        $list   = $this->lists($model, $map,'','cr.*, aga.group_id, c.check_user as c_check_user,
                            c.check_status as c_check_status, ag.title, c.id as c_id');
        $this->assign('_list', $list);
        $this->meta_title = '用户信息';
        $this->display();
    }
    private function getNum($data) {
        if (!empty(I('registered_capital'))) {
            $data['registered_capital'] =price_dispose(I('registered_capital'));
        } if (!empty(I('turnover_year1'))) {
            $data['turnover_year1'] =price_dispose(I('turnover_year1'));
        } if (!empty(I('net_margin_year1'))) {
            $data['net_margin_year1'] =price_dispose(I('net_margin_year1'));
        }if (!empty(I('turnover_year2'))) {
            $data['turnover_year2'] =price_dispose(I('turnover_year2'));
        } if (!empty(I('net_margin_year2'))) {
            $data['net_margin_year2'] =price_dispose(I('net_margin_year2'));
        }if (!empty(I('turnover_year3'))) {
            $data['turnover_year3'] =price_dispose(I('turnover_year3'));
        } if (!empty(I('net_margin_year3'))) {
            $data['net_margin_year3'] =price_dispose(I('net_margin_year3'));
        }if (!empty(I('turnover_year4'))) {
            $data['turnover_year4'] =price_dispose(I('turnover_year4'));
        } if (!empty(I('net_margin_year4'))) {
            $data['net_margin_year4'] =price_dispose(I('net_margin_year4'));
        }

        return $data;
    }
    public function companyShow() {
        $id = I('id');
        if (empty($id)) $this->error('用户尚未填写档案，请及时通知该用户填写档案！');
        $prefix = C('DB_PREFIX');
        if (IS_POST) {
            $data = I('post.');
            $company = M()->table($prefix.'company');
            $data['update_time'] = time_format();
            $data = $this->getNum($data); //处理金额去掉逗号
            $data['check_status'] = 'OK#';
            $data['check_user'] = session('user_auth.username');
            $group_id = $data['group_id'];
            unset($data['group_id']);
            if(($company->where(['id'=>$id])->save($data) !== false)) {
                    $group = M()->table($prefix.'auth_group_access');
                    if ($group->where(['uid'=>$data['uid']])->save(['group_id'=>$group_id]) !== false) {
                        $this->success('保存成功',U('Member/index'));
                    }
            } else {
                $this->error('保存失败!!!!!');
            }
        }

        $company = M()->table($prefix.'company c');
        $data = $company->join($prefix.'auth_group_access aga on aga.uid=c.uid', 'left')
            ->field('c.*, aga.group_id')
            ->where(['id'=>$id])->find();
        if (empty($data)) $this->error('参数错误!');

        $this->assign('item', $data);
        $this->meta_title = '建档信息详情';
        $this->display();
    }

    //会员注册审核首页
    public function companyRegIndex() {
        $search       =   I('search');
        //$map['um.status']  =   array('egt',0);
        $map = [];
        if(is_numeric($search)){
            $map['cr.mobile']=['like', '%' . intval($search) . '%'];
        }elseif(!empty($search)){
            $map['cr.chairman_name|cr.chairman_nickname']    =   array('like', '%'.(string)$search.'%');
        }

        $map['cr.check_status'] = ['neq', ''];
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'company_reg cr')
            ->join($prefix.'auth_group_access aga on aga.uid=cr.uid', 'left')
            ->join($prefix.'auth_group ag on ag.id=aga.group_id', 'left');
        $map['cr.check_status']='WAT';
        $list   = $this->lists($model, $map,'','cr.*, aga.group_id, ag.title');
        $this->assign('_list', $list);
        $this->meta_title = '用户信息';
        $this->display();
    }

    public function companyRegShow() {
        $id = I('id');
        if (empty($id)) $this->error('参数错误!');
        $prefix = C('DB_PREFIX');
        $company = M()->table($prefix.'company_reg');
        if (IS_POST) {
            $data = I('post.');
            //处理没有填或是 0，'' ""
            foreach ($data as $key => $value) {
                if (empty($value)) unset($data[$key]);
            }
            $data['update_time'] = time_format();
            if (!empty($data['check_status'])) $data['check_user'] = session('user_auth.username');
            if($company->create($data)
                && $company->where(['id'=>$id])->save() !== false) {
                $this->success('保存成功',U('companyRegIndex'));
            } else {
                $this->error('保存失败');
            }
        }
        $data = $company->where(['id'=>$id])->find();
        if (empty($data)) $this->error('没有找到该数据!');
        $this->assign('item', $data);
        $this->meta_title = '注册信息详情';
        $this->display();
    }
}