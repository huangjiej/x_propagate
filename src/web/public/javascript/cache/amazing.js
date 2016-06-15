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
        'club-amazing': {
            url: '/api/index/amazing',
        },
        'teacherdetail': {
            url: '/api/index/teacherdetail'
        }
    });
    p.Amazing = k._$klass();
    pro = p.Amazing._$extend(t._$$CacheListAbstract);

    pro.__doLoadItem = function (options) {
        this.__doSendRequest('teacherdetail',options);
    };

    pro.__doLoadList = function (options) {
        this.__doSendRequest('club-amazing',options);
    };
});