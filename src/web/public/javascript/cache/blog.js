/*
 * ------------------------------------------
 * 日志缓存对象
 * @version  1.0
 * @author   genify(caijf@corp.netease.com)
 * ------------------------------------------
 */
NEJ.define([
    'base/klass',
    'base/util',
    'util/ajax/xdr',
    './cache.js'
],function(_k,_u,_j,_d,_p,_pro){

    _p._$$CacheBlog = _k._$klass();
    _pro = _p._$$CacheBlog._$extend(_d._$$Cache);

    _pro.__doLoadList = function (_options) {
        var _key = _options.key,  //唯一标识符，用于加载不同的数据
            _callback = _options.onload;
        var page = (_options.offset / _options.limit) + 1;
        _options.data['page'] = page;
        _j._$request('https://cnodejs.org/api/v1/topics', {
            method: 'get',
            type: 'json',
            data:_options.data,
            onload:this.__myload._$bind(this,_key,_callback),
            onerror:this.__cbListLoad._$bind(this,_key,_callback,{})
        })

    };

    _pro.__myload = function (_key,_callback,_data) {
        if (_data.success) {
            _data.total = 500;
            if (_data.total>_data.data.length)
                this._$setTotal(_key,_data.total);
            _callback(_data.data);
        }
    };

    /**
     * 从缓存中取日志分类列表
     * @return {Array} 日志分类列表
     */
    _pro._$getClassListInCache = function(){
        // for test
        var _arr = [],
            _nmb = 0,
            _seed = +new Date;
        for(var i=0;i<10;i++){
            _seed++;
            _arr.push({id:_seed,name:'class-'+_seed,count:_nmb++});
        }
        return _arr;
    };

    /**
     * 从缓存中取日志标签列表
     * @return {Array} 日志标签列表
     */
    _pro._$getTagListInCache = function(){
        // for test
        var _arr = [],
            _nmb = 0,
            _seed = +new Date;
        for(var i=0;i<20;i++){
            _seed++;
            _arr.push({id:_seed,name:'tag-'+_seed,count:_nmb++});
        }
        return _arr;
    };
});