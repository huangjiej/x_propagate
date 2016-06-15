/*
 * ------------------------------------------
 * 项目缓存基类
 * @version  1.0
 * @author   genify(caijf@corp.netease.com)
 * ------------------------------------------
 */
NEJ.define([
    'base/klass',
    'util/cache/abstract'
],function(_k,_d,_p,_pro){
    /**
     * 项目缓存基类
     */
    _p._$$Cache = _k._$klass();
    _pro = _p._$$Cache._$extend(_d._$$CacheListAbstract);


    _pro.__cbListLoad = function(_key,_callback,_offset, _limit,_json){
        var _list = null;
        var _result = _json;
        _result.total = _json.length;
        _result.list = _json.slice(_offset,_offset+_limit);
        if (_result.total>_result.list.length)
            this._$setTotal(_key,_result.total);
        _list = _result.list;
        _callback(_list);
    };
});
