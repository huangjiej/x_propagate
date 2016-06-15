<extend name="Public/base" xmlns="http://www.w3.org/1999/html"/>

<block name="body">
    <div class="table-responsive">
        <div class="dataTables_wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="search-form">
                        <label>产品名称
                            <input type="text" class="search-input" name="search" value="{:I('search')}" placeholder="产品名称">
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search" url="{:U('product/index')}">
                                <i class="icon-search"></i>搜索
                            </button>
                        </label>
                    </div>
                </div>
            </div>

            <!-- 数据列表 -->
            <table class="table table-striped table-bordered table-hover dataTable">
                <thead>
                <tr>
                    <th class="row-selected center">
                        <label>
                            <input class="ace check-all" type="checkbox"/>
                            <span class="lbl"></span>
                        </label>
                    </th>
                    <th class="">名称</th>
                    <th class="">类型</th>
                    <th class="">当前价格</th>
                    <th class="">原价</th>
                    <th class="">最后修改时间</th>
                    <th class="">状态</th>
                    <th class="">操作</th>
                </tr>
                </thead>
                <tbody>
                <notempty name="_list">
                    <volist name="_list" id="vo">
                        <tr>
                            <td class="center">
                                <label>
                                    <input class="ace ids" type="checkbox" name="id[]" value="{$vo.id}" />
                                    <span class="lbl"></span>
                                </label>
                            </td>
                            <td>{$vo.name}</td>
                            <td>{$vo.type|get_product}</td>
                            <td>￥：{$vo.cur_price|price_format}元</td>
                            <td>￥：{$vo.old_price|price_format}元</td>
                            <td>{$vo.update_time}</td>
                            <td>{$vo.status|get_product_status}</td>
                            <td>
                                <a title="编辑" href="{:U('product/edit?id='.$vo['id'])}" class="">
                                    编辑
                                </a>
                            </td>
                        </tr>
                    </volist>
                    <else/>
                    <td colspan="9" class="text-center"> aOh! 暂时还没有内容! </td>
                </notempty>
                </tbody>
            </table>
            <div class="row">
                <div class="col-sm-4">
                    <label>
                        <a href="{:U('add')}" type="button" class="btn btn-white">
                            新增
                        </a>
                    </label>
                </div>
                <div class="col-sm-8">
                    <include file="Public/page"/>
                </div>
            </div>

        </div>
    </div>
</block>

<block name="script">
    <script>
        //搜索功能
        $("#search").click(function(){
            var url = $(this).attr('url');
            var query  = $('.search-form').find('input').serialize();
            query = query.replace(/(&|^)(\w*?\d*?\-*?_*?)*?=?((?=&)|(?=$))/g,'');
            query = query.replace(/^&/g,'');
            if( url.indexOf('?')>0 ){
                url += '&' + query;
            }else{
                url += '?' + query;
            }

            window.location.href = url;
        });
        //回车搜索
        $(".search-input").keyup(function(e){
            if(e.keyCode === 13){
                $("#search-btn").click();
                return false;
            }
        });

        //导航高亮
        highlight_subnav('{:U("club/index")}');
    </script>
</block>