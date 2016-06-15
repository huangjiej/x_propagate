/**
 * 瀑布式列表数据加载，这里仅修改了加载更多，没有数据的显示样式
 * Created by sks on 2016/4/27.
 */

NEJ.define([
    'base/klass',
    'base/element',
    'base/util',
    'util/list/waterfall'
], function (k, _e, _u, w, p, pro) {
    p.MyWF = k._$klass();
    pro = p.MyWF._$extend(w._$$ListModuleWF);
/*    
<section class="ui-placehold-wrap">
    <div class="ui-placehold">正在加载中...</div>
</section>
*/
    pro.__doRenderMessage = function(_message,_pos){
        if (_u._$isString(_message)){
            if (!this.__ntip)
                this.__ntip = _e._$create('section');
            _e._$addClassName(this.__ntip, 'ui-placehold-wrap');
            this.__ntip.innerHTML = ('<div class="ui-placehold">' + _message + '</div>') ;
        }else{
            this.__ntip = _message;
        }
        this.__lbox.insertAdjacentElement(
            _pos||'beforeEnd',this.__ntip
        );
    };
});
