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
        'get-club': {
            url: ApiHost + '/api/index/club',
            onload:'ongetclub',
            onerror:'ongetcluberror'
        }
    });

    p._$$ClubCache = k._$klass();
    pro = p._$$ClubCache._$extend(t._$$CacheListAbstract);

    pro._$getClub = function (options) {
        this.__doSendRequest('get-club',options)
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