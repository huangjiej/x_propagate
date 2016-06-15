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
        'products': {
            url: '/api/index/products'
        },
        'product': {
            url: '/api/index/product'
        }
    });
    p._$$ProductsCache = k._$klass();
    pro = p._$$ProductsCache._$extend(t._$$CacheListAbstract);

    pro.__doLoadItem = function (options) {
        this.__doSendRequest('product',options);
    };

    pro.__doLoadList = function (options) {
        this.__doSendRequest('products',options);
    };
});