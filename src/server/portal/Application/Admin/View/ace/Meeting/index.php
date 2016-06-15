<extend name="Public/base"/>

<block name="body">
    <div class="table-responsive">
        <div class="dataTables_wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="search-form">
                        <label>会议标题或ID
                            <input type="text" class="search-input" name="search" value="{:I('search')}" placeholder="会议标题或ID">
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search" url="{:U('Meeting/index')}">
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
                    <th class="">标题</th>
                    <th class="">副标题</th>
                    <th class="">联系人</th>
                    <th class="">联系电话</th>
                    <th class="">联系邮箱</th>
                    <th class="">创建时间</th>
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
                            <td><a href="{:U('edit',array('id'=>$vo['id']))}">{$vo.title}</a></td>
                            <td>{$vo.subheading}</td>
                            <td>{$vo.contacts}</td>
                            <td>{$vo.contact_phone}</td>
                            <td>{$vo.contact_email}</td>
                            <td><span>{$vo.insert_time}</span></td>
                            <td>
                                <a title="签到列表" href="<?= U('Meeting/enroll', ['id'=>$vo['id'], 'is_affirm'=>'YES', 'is_sign'=>'YES']) ?>" class="">
                                    签到列表
                                </a>
                                <a target="_blank" title="报名链接" href="<?= C('WECHAT_ADDR') . 'public/enroll?meeting_id=' . $vo['id'] ?>" class="">
                                    报名链接
                                </a>
                                <a title="删除" href="{:U('meetingDelete?id='.$vo['id'])}" class="confirm ajax-get">
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
                        <a class="btn btn-white" href="{:U('add')}">
                            新增
                        </a>
                    </label>
                    <label>
                        <button type="button" class="btn btn-white ajax-post" target-form="ids" url="{:U('meetingDelete')}">
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
        highlight_subnav('{:U('Meeting/index')}');
    </script>
</block>