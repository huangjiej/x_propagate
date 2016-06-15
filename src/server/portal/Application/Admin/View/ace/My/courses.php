<extend name="Public/base"/>

<block name="body">
    <div class="table-responsive">
        <div class="dataTables_wrapper">
            <if condition="$company['check_status'] eq 'OK#'">
            <div class="row">
                <div class="col-sm-12">
                    <div class="search-form">
                        <label>课程标题或ID
                            <input type="text" class="search-input" name="search" value="{:I('search')}" placeholder="课程标题或ID">
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search" url="{:U('My/courses')}">
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
                        <th class="">ID</th>
                        <th class="">PPT名称</th>
                        <th class="">创建时间</th>
                        <th class="">老师点评</th>
                        <th class="">编辑</th>
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
                                <td>{$vo.id}</td>
                                <td><a href="{:U('courseShow',array('id'=>$vo['id']))}">{$vo.title}</a></td>
                                <td>{$vo.insert_time}</td>
                                <td><a title="点击查看" href="{:U('courseShow?id='.$vo['id'])}" class="">
                                        点击查看
                                    </a></td>
                                <td>
                                    <a title="编辑" href="{:U('courseEdit?id='.$vo['id'])}" class="">
                                        编辑
                                    </a>
                                    <a title="删除" href="{:U('courseDelete?id='.$vo['id'])}" class="confirm ajax-get">
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
                            <a class="btn btn-white" href="{:U('courseAdd')}">
                                上传功课
                            </a>
                        </label>
                        <label>
                            <button type="button" class="btn btn-white ajax-post" target-form="ids" url="{:U('courseDelete')}">
                                删除
                            </button>
                        </label>
                    </div>
                    <div class="col-sm-8">
                        <include file="Public/page"/>
                    </div>
                </div>
            <else/>
                <div lass="row">
                    <div class="col-sm-12">
                        <p class="text-warning bigger-110 orange">
                                <if condition="$company['check_status'] eq 'WAT'">
                                    <div class="alert alert-danger">
                                        您的档案正在审核中，请耐心等待，通过审核即可上传课件！
                                        <br>
                                    </div>
                                <else/>
                                    <div class="alert alert-danger">
                                        请先完善 <a href="{:U('My/company')}">我的档案</a>，通过审核之后即可上传课件！
                                        <br>
                                    </div>
                                </if>
                        </p>
                    </div>
                </div>
            </if>
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
        highlight_subnav('{:U('My/company')}');
    </script>
</block>