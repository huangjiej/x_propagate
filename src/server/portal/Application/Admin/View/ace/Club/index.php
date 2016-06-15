<extend name="Public/base" xmlns="http://www.w3.org/1999/html"/>

<block name="body">
    <div class="table-responsive">
        <div class="dataTables_wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="search-form">
                        <label>俱乐部名称
                            <input type="text" class="search-input" name="search" value="{:I('search')}" placeholder="俱乐部名称">
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search" url="{:U('club/index')}">
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
                    <th class="">创始人</th>
                    <th class="">描述</th>
                    <th class="">联系电话</th>
                    <th class="">创建时间</th>
                    <th class="">审核状态</th>
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
                            <td>{$vo.club_name}</td>
                            <td>{$vo.nickname}</td>
                            <td>{$vo.description}</td>
                            <td>{$vo.mobile}</td>
                            <td>{$vo.insert_time}</td>
                            <td>{$vo.status|get_check_status}</td>
                            <td>
                                <if condition="$vo.status eq 'WAT'">
                                    <a title="点评" href="{:U('club/edit?id='.$vo['id'])}" class="">
                                        审核
                                    </a>
                                <else/>
                                    <a title="点评" href="{:U('club/edit?id='.$vo['id'])}" class="">
                                        编辑
                                    </a>
                                </if>

                                <a title="删除报名信息" href="{:U('')}" class="confirm ajax-get">
                                    删除
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
                        <button type="button" class="btn btn-white ajax-post" target-form="ids" url="{:U('')}">
                            删除
                        </button>
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