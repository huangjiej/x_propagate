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
        'get-user': {
            url: ApiHost + '/api/index/user',
            onload: 'onuserload'
        }
    });

    p._$$UserCache = k._$klass();
    pro = p._$$UserCache._$extend(t._$$CacheListAbstract);

    pro._$getUser = function (options) {
        this.__doSendRequest('get-user',options)
    }

    // pro.__doLoadItem = function (options) {
    //     this.__doSendRequest('get-club',options);
    // }
    //
    // pro.__doLoadList = function (options) {
    //     this.__doSendRequest('get-club-news-list',options);
    // }
    //
    // pro.__doDeleteItem = function (options) {
    //     this.__doSendRequest('club-news-delete', options);
    // }
});