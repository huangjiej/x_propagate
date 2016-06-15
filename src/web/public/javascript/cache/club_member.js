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
        'get-club-member': {
            url: ApiHost + '/api/index/clubmember'
        }
    });

    p._$$ClubmemberCache = k._$klass();
    pro = p._$$ClubmemberCache._$extend(t._$$CacheListAbstract);

    pro.__doLoadList = function (options) {
        this.__doSendRequest('get-club-member',options);
    }
});