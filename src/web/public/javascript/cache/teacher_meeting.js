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
        'teacher-ganwu-list': {
            url: '/api/index/ganwu',
        }
    });
    p._$$TeacherGanwuCache = k._$klass();
    pro = p._$$TeacherGanwuCache._$extend(t._$$CacheListAbstract);

    pro.__doLoadList = function (options) {
        this.__doSendRequest('teacher-ganwu-list',options);
    };
});