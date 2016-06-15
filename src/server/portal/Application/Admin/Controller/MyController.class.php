<?php
/**
 * Created by PhpStorm.
 * User: sks
 * Date: 2016/3/29
 * Time: 16:51
 */

namespace Admin\Controller;
use Admin\Service\ApiService;
use Think\Model;
use User\Api\UserApi;

class MyController extends AdminController {
    //我的注册信息
    public function reg() {
        //TODO:需要修改834为$uid
        $prefix = C('DB_PREFIX');

        $uid = session('user_auth.uid');
        $company = M()->table($prefix.'company_reg');
        if (IS_POST) {
            $data = I('post.');
            $data['update_time'] = time_format();
            if (strlen($data['birthday']) == 0) unset($data['birthday']);
            if (strlen($data['founding_time']) == 0) unset($data['founding_time']);
            if( $company->create($data) && $company->where(array('uid'=>$uid))
                    ->save($data) !== false){
                $this->success('保存成功！');
            }
            $this->error('修改失败！');
        }

        $item = $company->where(['uid'=>$uid])->find();
        if (empty($company)){}
        $this->assign('item', $item);
        $this->meta_title = '我的注册信息';
        $this->display();
    }

    public function company() {
        //判断是否已经通过创建档案
        $prefix = C('DB_PREFIX');
        $uid = session('user_auth.uid');
        $company = M()->table($prefix.'company');
        if ($company->where(['uid'=>$uid])->find()) {
            $this->redirect('companyedit');
        } else {
            $this->redirect('companyadd');
        }
    }
    
    public function companyadd() {
        if (IS_POST) {
            $prefix = C('DB_PREFIX');
            $company = M()->table($prefix.'company');

            $data = I('post.');

            //处理没有填或是 0，'' ""
            foreach ($data as $key => $value) {
                if (empty($value)) unset($data[$key]);
            }
            $data = $this->getNum($data); //处理金额去掉逗号
            if (!empty(I('registered_capital'))) {
                $data['registered_capital'] =price_dispose(I('registered_capital'));
            }
            $data['insert_time'] = time_format();
            $data['update_time'] = time_format();
            $data['uid'] = session('user_auth.uid');

            if($company->create($data)) {
                if($company->add() > 0) {
                    $this->success('添加成功');
                } else {
                    $this->error('添加失败');
                }
            }
        }
        
        $this->meta_title = '我的注册信息';
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

    public function companyedit() {
        $prefix = C('DB_PREFIX');
        $uid = session('user_auth.uid');
        $company = M()->table($prefix.'company');
        if (IS_POST) {
            $data = I('post.');
            //处理没有填或是 0，'' ""
            foreach ($data as $key => $value) {
                if (empty($value)) unset($data[$key]);
            }
            $data['update_time'] = time_format();
            $data = $this->getNum($data); //处理金额去掉逗号
            if (!empty(I('registered_capital'))) {
                $data['registered_capital'] =price_dispose(I('registered_capital'));
            }
            if($company->create($data) && $company->where(['uid'=>$uid])->save() !== false) {
                $this->success('保存成功');
            } else {
                $this->error('保存失败');
            }

        }

        $data = $company->where(['uid'=>$uid])->find();
        if (empty($data)) $this->error('参数错误!');

        $this->assign('item', $data);
        $this->meta_title = '我的注册信息';
        $this->display();
    }


    public function courses() {
        $prefix = C('DB_PREFIX');
        $uid = session('user_auth.uid');
        $company = M()->table($prefix.'company c')->where(['uid'=>$uid])->find();

        $courses = M()->table($prefix.'user_courseware');
        $map['uid'] =$uid;
        $map['status'] = 'OK#';
        $list   = $this->lists($courses, $map,'','');

        $this->assign('company', $company);
        $this->assign('_list', $list);
        $this->meta_title = '我的课程记录';
        $this->display();
    }

    public function courseShow() {
        $id = I('id');
        $prefix = C('DB_PREFIX');

        if (IS_POST) {
            $data = I('post.');
            $data['insert_time'] = time_format();
            $data['uid']= session('user_auth.uid');
            //$data['check_user'] = session('')
            $comment = M()->table($prefix.'user_courseware_comment');
            if ($comment->create($data) && $comment->add()) {
                $this->success('评论成功', U('courseshow?id='.$data['cid']));
            } else {
                $this->error('评论失败 ');
            }
        }

        if(empty($id)) $this->error('参数错误');
        $course = M()->table($prefix.'user_courseware uc');
        $map['uc.id'] = $id;
        $map['uc.status'] = 'OK#';
        $data = $course->join($prefix.'user_courseware_att uca on uc.id=uca.cid','left')
            ->field(['uc.*, uca.att_url, uca.cid'])
            ->where($map)->find();

        $comments = M()->table($prefix.'user_courseware_comment ucc')
            ->join($prefix.'ucenter_member um on ucc.uid=um.id');
        $list   = $this->lists($comments, ['ucc.cid'=>$id],'','ucc.*, um.username');

        $this->assign('_list', $list);
        $this->assign('item', $data);
        $this->meta_title = '编辑课程';
        $this->display();
    }

    public function courseEdit(){
        $id = I('id');
        if(empty($id)) $this->error('参数错误');
        $prefix = C('DB_PREFIX');
        $course = M()->table($prefix.'user_courseware uc');
        if (IS_POST) {
            $data = I('post.');
            $data['update_time'] = time_format();
            if ($course->create($data)
                 && $course->where(['id'=>$data['id']])->save() !== false) {
                $course_att = M()->table($prefix.'user_courseware_att');
                if ($course_att->create($data)
                    && $course_att->where(['cid'=>$data['cid']])->save() !==false) {
                    $this->success('修改成功');
                } else {
                    $this->error('修改失败');
                }
            } else {
                $this->error('修改失败');
            }
        }
        $map['uc.id'] = $id;
        $map['uc.status'] = 'OK#';
        $data = $course->join($prefix.'user_courseware_att uca on uc.id=uca.cid','left')
            ->field(['uc.*, uca.att_url, uca.cid'])
            ->where($map)->find();
        $this->assign('item', $data);
        $this->meta_title = '编辑课程';
        $this->display('courseadd');
    }

    public function courseAdd(){
        if (IS_POST) {
            $prefix = C('DB_PREFIX');
            $courseware = M()->table($prefix.'user_courseware');
            $data = I('post.');
            $data['insert_time'] = time_format();
            $data['update_time'] = time_format();
            $data['uid'] = session('user_auth.uid');
            if($courseware->create($data)) {
                if(($cid = $courseware->add()) > 0) {
                    $courseware_att = M()->table($prefix.'user_courseware_att');
                    $data['cid'] = $cid;
                    if ($courseware_att->create($data) && $courseware_att->add() > 0) {
                        $this->success('创建成功', U('courses'));
                    }
                } else {
                    $this->error('添加失败');
                }
            }
        }

        $this->meta_title = '添加课程';
        $this->display();
    }


    public function courseDelete(){
        //如存在id字段，则加入该条件
        $id    = array_unique((array)I('id',0));
        $id    = is_array($id) ? implode(',',$id) : $id;
        if(empty($id))$this->error('参数错误！');
        $prefix = C('DB_PREFIX');
        $model = M()->table($prefix.'user_courseware');
        $result = $model->where('id in ('. $id . ')')->save(['status'=>'DEL']);
        if($result !== false){
            $this->success('删除成功！');
        }else{
            $this->error('删除失败！');
        }
    }

}
