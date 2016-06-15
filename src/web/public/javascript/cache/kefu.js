/*
 * 客服相关缓存管理实现文件
 *
 * Auto build by NEI Builder
 */
NEJ.define([
    'base/klass',
    'base/util',
    './cache.js'
],function(k,u,t,p,pro){
    // config request
    t._$config({
        'kefu-list':{
            method:'GET',
            url:'/api/kefu/list',
            format:function(json, options){
                if(typeof(json.message) === 'object'){
                    var count = json.message.count
                }else{
                    var count = JSON.parse(json.message).count
                }
                options.ext = {count:count};
                json.result = {
                    total:json.total,
                    list:json.result
                };
            }
        },
        'kefu-add':{
            url:'/api/kefu/add'
        },
        'kefu-delete':{
            url:'/api/kefu/delete',
            format: function(json, options){
                json.result = options.data;
            }
        },
        'kefu-update':{
            url:'/api/kefu/update'
        },
        'kefu-password':{
            url:'/api/kefu/password',
            onload:'onpswdupdate',
            onerror:'onpswdupdate'
        },
        'kefu-status':{
            url:'/api/kefu/status',
            onload:'onstatusupdate',
            onerror:function(result,options){
                this._$dispatchEvent(
                    'onstatusupdate',-1
                );
            }
        },
        'kefu-disable':{
            url:'/api/kefu/disable',
            onload:'onitemdisable',
        }
    });
    /**
     * 客服缓存实现文件
     *
     * @class   _$$Cache
     * @extends pro/cache/sesstion._$$Cache
     * @param  {Object} options - 模块输入参数
     */
    p._$$Cache = k._$klass();
    pro = p._$$Cache._$extend(t._$$Cache);
    /**
     * 从服务器端载入列表
     *
     * @abstract
     * @method   module:pro/cache/user._$$CacheUser#__doLoadList
     * @param    {Object}   arg0   - 请求信息
     * @property {String}   key    - 列表标识
     * @property {Number}   offset - 偏移量
     * @property {Number}   limit  - 数量
     * @property {String}   data   - 请求相关数据
     * @property {Function} onload - 列表项载入回调
     * @return   {Void}
     */
    pro.__doLoadList = function(options){
        var arr = (options.key||'').split('-');
        this.__doSendRequest(arr[0]+'-'+arr[1],options);
    };
    /**
     * 添加列表项至服务器，子类实现具体逻辑
     *
     * @abstract
     * @method   module:util/cache/abstract._$$CacheListAbstract#__doAddItem
     * @param    {Object}   arg0   - 请求信息
     * @property {String}   key    - 列表标识
     * @property {Number}   id     - 列表项标识
     * @property {String}   data   - 请求相关数据
     * @property {Function} onload - 列表项载入回调
     * @return   {Void}
     */
    pro.__doAddItem = function(options){
        this.__doSendRequest('kefu-add',options);
    };
    /**
     * 从服务器上删除列表项，子类实现具体逻辑
     *
     * @abstract
     * @method    module:util/cache/abstract._$$CacheListAbstract#__doDeleteItem
     * @param     {Object}   event  - 请求信息
     * @property  {String}   key    - 列表标识
     * @property  {Number}   id     - 列表项标识
     * @property  {String}   data   - 请求相关数据
     * @property  {Function} onload - 列表项载入回调
     * @return    {Void}
     */
    pro.__doDeleteItem = function(options){
        this.__doSendRequest('kefu-delete',options);
    };
    /**
     * 更新列表项至服务器，子类实现具体逻辑
     *
     * @abstract
     * @method module:util/cache/abstract._$$CacheListAbstract#__doUpdateItem
     * @param    {Object}   event  - 请求信息
     * @property {String}   key    - 列表标识
     * @property {Number}   id     - 列表项标识
     * @property {String}   data   - 请求相关数据
     * @property {Function} onload - 列表项载入回调
     * @return   {Void}
     */
    pro.__doUpdateItem = function(options){
        this.__doSendRequest('kefu-update',options);
    };
    /**
     * 更新密码
     * @param data
     * @private
     */
    pro._$updatePassword = function(data){
        this.__doSendRequest('kefu-password',{
            data:data
        });
    };
    /**
     * 更新状态
     * @param status
     * @private
     */
    pro._$updateStatus = function(status){
        this.__doSendRequest('kefu-status',{
            data:{
                status:status
            }
        });
    };

    /**
     * 客服停用和启用
     */
    pro._$disableItem = function(data){
        this.__doSendRequest('kefu-disable', {
            data:data
        })
    }

    
    /**
     * do cache sync method
     * @param func
     * @private
     */
    p._$do = t._$do._$bind(
        null, p._$$Cache
    );
});