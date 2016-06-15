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

class CourseController extends AdminController {
    public function index() {
        $search       =   I('search');
        if(is_numeric($search)){
            $map['n.mobile']=['like', '%' . intval($search) . '%'];//   array(intval($search),array('like','%'.$search.'%'),'_multi'=>true);
        }elseif(!empty($search)){
            $map['n.name']  = array('like', '%'.(string)$search.'%');
        }
        $prefix = C('DB_PREFIX');
        $map['uc.status'] = 'OK#';
        $model = M()->table($prefix.'user_courseware uc')
            ->join($prefix.'user_courseware_att uca on uca.cid=uc.id','left')
            ->join($prefix.'company_reg cr on uc.uid=cr.uid', 'left');
        $list  = $this->lists($model, $map,'','uc.*, cr.company_name,cr.chairman_name,cr.mobile, uca.att_url');
        $this->assign('_list', $list);
        $this->meta_title = '报名管理';
        $this->display();
    }
}