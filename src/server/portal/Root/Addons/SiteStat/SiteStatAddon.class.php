<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: yangweijie <yangweijiester@gmail.com> <code-tech.diandian.com>
// +----------------------------------------------------------------------
namespace Addons\SiteStat;
use Common\Controller\Addon;

/**
 * 系统环境信息插件
 * @author thinkphp
 */
class SiteStatAddon extends Addon{

    public $info = array(
        'name'=>'SiteStat',
        'title'=>'站点统计信息',
        'description'=>'统计站点的基础信息',
        'status'=>1,
        'author'=>'thinkphp',
        'version'=>'0.1'
    );

    public function install(){
        return true;
    }

    public function uninstall(){
        return true;
    }

    //实现的AdminIndex钩子方法
    public function AdminIndex($param){
        $uid = is_login();
        $item = M('auth_group_access')->where(['uid'=>$uid,'group_id'=>['in','5,6']])->find();

        if(empty($item)){

            $config = $this->getConfig();

            $this->assign('addons_config', $config);
            if($config['display']){
                $info['user']		=	M('Member')->count();
                $info['action']		=	M('ActionLog')->count();
                $info['document']	=	M('Document')->count();
                $info['category']	=	M('Category')->count();
                $info['model']		=	M('Model')->count();
                $this->assign('info',$info);
            }
        }else{
            $company_info = M('company')->where(['uid'=>$uid])->field('company_name,check_status')->find();
            if(empty($company_info)){
                redirect(U('my/companyadd'));
            }
            $this->assign('company_info',$company_info);
            $this->assign('is_member',true);
        }

        $this->display('info');
    }
}