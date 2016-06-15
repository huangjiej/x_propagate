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
        'orders': {
            url: ApiHost + '/api/index/orders'
        },
        'order': {
            url: ApiHost + '/api/index/order'
        }
    });
    p._$$OrdersCache = k._$klass();
    pro = p._$$OrdersCache._$extend(t._$$CacheListAbstract);

    pro.__doLoadItem = function (options) {
        this.__doSendRequest('order',options);
    };

    pro.__doLoadList = function (options) {
        this.__doSendRequest('orders',options);
    };

    pro.__doUpdateItem = function(options){
        this.__doSendRequest('order',options);
    };
});