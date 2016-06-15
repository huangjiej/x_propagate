<extend name="Public/base"/>

<block name="body">
    <div class="table-responsive">
        <div class="dataTables_wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="search-form">
                        <label>用户昵称或者手机号码
                            <input type="text" class="search-input" name="search" value="{:I('search')}" placeholder="请输入用户昵称或者手机号码">
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search" url="{:U('User/userReturn')}">
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
                    <th class="">姓名</th>
                    <th class="">手机号</th>
                    <th class="">职位</th>
                    <th class="">公司</th>
                    <th class="">签约时间</th>
                    <th class="">签约类型</th>
                    <th class="">回访人</th>
                    <th class="">回访详情</th>
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
                            <td><a href="{:U('uedit',array('id'=>$vo['id']))}">{$vo.chairman_name}</a></td>
                            <td>{$vo.mobile}</td>
                            <td>{$vo.position}</td>
                            <td>{$vo.company_name}</td>
                            <td><span>{$vo.insert_time}</span></td>
                            <td><span>{$vo.title}</span></td>
                            <td>
                                <span>{$vo.huifangren}</span>
                            </td>
                            <td>
                                <a title="授权" href="{:U('User/returnShow?id='.$vo['urv_id'])}" class="">
                                    回访详情
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
                        <a class="btn btn-white" href="{:U('addReturn')}">
                            新增
                        </a>
                    </label>
                    <label>
                        <button type="button" class="btn btn-white ajax-post" target-form="ids" url="{:U('changeStatus?method=deleteUser')}">
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
    <script src="__STATIC__/thinkbox/jquery.thinkbox.js"></script>

    <script type="text/javascript">
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
                console.info($("#search"));
                $("#search").click();
                return false;
            }
        });
        //导航高亮
        highlight_subnav('{:U('User/userReturn')}');
    </script>
</block>