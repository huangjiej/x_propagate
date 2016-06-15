/*
 * 客服相关缓存管理实现文件
 *
 * Auto build by NEI Builder
 */
NEJ.define([
    'base/klass',
    'base/util',
    'util/cache/abstract'
],function(k,u,t,p,pro){
    t._$config({
        'get-club-news': {
            method: 'GET',
            type: 'json',
            url: '/api/index/clubdetail'
        },
        'get-club-news-list': {
            method:'get',
            type:'json',
            url: '/api/index/myclubtwitter'
        },
        'club-news-delete':{
            url: '/api/index/deletetwitter',
            method: 'get',
            type: 'json',
            format: function(json, options){
            }
        },
        'club-news-add':{
            url: '/api/index/addclubtwitter'
        }
    });
    
    p._$$ClubNewsCache = k._$klass();
    pro = p._$$ClubNewsCache._$extend(t._$$CacheListAbstract);

    pro.__doLoadItem = function (options) {
        this.__doSendRequest('get-club-news',options);
    }

    pro.__doLoadList = function (options) {
        this.__doSendRequest('get-club-news-list',options);
    }
    
    pro.__doDeleteItem = function (options) {
        this.__doSendRequest('club-news-delete', options);
    };

    pro.__doAddItem = function (options) {
        this.__doSendRequest('club-news-add', options);
    }

    /**
     * 删除列表项回调
     *
     * @protected
     * @method module:util/cache/list._$$CacheList#__deleteItem
     * @param  {Object}  arg0 - 请求信息
     * @param  {Boolean} arg1 - 是否删除成功
     * @return {Void}
     */
    pro.__deleteItem = function(_options,_isok){
        var _item,
            _key = _options.key;
        // sync memory
        if (!!_isok){
            var _id = _options.id;
            _item = this._$getItemInCache(_id)||null;
            this.__doRemoveItemFromList(_key,_id);

            //清空首页列表缓存
            this._$clearListInCache('common-club-news')
        }
        // callback
        var _event = {
            key:_key,
            data:_item,
            action:'delete',
            ext:_options.ext,
            isok:_isok
        };
        this._$dispatchEvent('onitemdelete',_event);
        return _event;
    };


    /**
     * 添加列表项回调
     *
     * @protected
     * @method module:util/cache/list._$$CacheList#__addItem}
     * @param  {Object} arg0 - 请求信息
     * @param  {Object} arg1 - 服务器返回数据
     * @return {Void}
     */
    pro.__addItem = function(_options,data){
        var _key = _options.key;
        
        if (data.status === 1) {
            _item = this.__doSaveItemToCache(data.itm,_key);
            // add to list
            var _flag = 0,
                _list = this._$getListInCache(_key);
            if (!_options.push){
                _flag = -1;
                var _offset = _options.offset||0;
                _list.splice(_offset,0,_item);
            }else if(_list.loaded){
                _flag = 1;
                _list.push(_item);
            }else{
                // add total
                _list.length++;
            }
        } 
        // callback
        var _event = {
            key:_key,
            flag:_flag,
            data:data,
            action:'add',
            ext:_options.ext
        };
        this._$dispatchEvent('onitemadd',_event);

        return _event;
    };

    return p;
});