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
        'teacher-twitter-list': {
            url: '/api/index/teachertwitter',
        },
        'teacherdetail': {
            url: '/api/index/teacherdetail'
        }
    });
    p._$$TeacherTwitterCache = k._$klass();
    pro = p._$$TeacherTwitterCache._$extend(t._$$CacheListAbstract);

    pro.__doLoadItem = function (options) {
        this.__doSendRequest('teacherdetail',options);
    };

    pro.__doLoadList = function (options) {
        this.__doSendRequest('teacher-twitter-list',options);
    };
});