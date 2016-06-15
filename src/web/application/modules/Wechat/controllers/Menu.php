<?php
/**
 * 自定义菜单管理
 *
 * @author 保灵
 */

class MenuController extends Core\Wechat{

    public function getMenuAction(){
        $this->sendOutPut(['data'=>$this->wechat->getMenu(),'errmsg'=>'成功！']);
    }
    
    public function createMenuAction(){
        $menus = $this->request_data['body'];
/*
        foreach ($menus as $key => $menu)
        {
            if(isset($menu['url'])){
                $menus[$key]['url'] = $this->wechat->getOauthRedirect($menu['url'],'index');
            }
            if(isset($menu['sub_button']) && is_array($menu['sub_button'])){
                foreach ($menu['sub_button'] as $k => $v)
                {
                    if(isset($v['url']) && preg_match("#^http:\/\/(lily)\.(mi360)\.(me)(.*?)#", $menu['url'])){
                        $menus[$key]['sub_button'][$k]['url'] = $this->wechat->getOauthRedirect($v['url'], 'index');
                    }
                }
            }
        }
*/
        SeasLog::debug("发送创建菜单的数据");
        SeasLog::debug(var_export($menus,true));
        if($this->wechat->createMenu(['button' => $menus])){
            $this->sendSuccess('成功');
        }else{
            $this->sendError('失败！');
        }
    }
    
}
