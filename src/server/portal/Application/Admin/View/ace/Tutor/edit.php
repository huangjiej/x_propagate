<extend name="Public/base" />

<block name="body">
    <!-- 表单 -->
    <style>
        td{width:50%;}
        img{max-width:400px;}
        .my-tips{float: left;font-size: 14px;margin-left: 10px;height: 32px;
            line-height: 14px;padding-top: 4px;}
    </style>
    <div class="table-responsive">
        <div class="dataTables_wrapper">
                <div class="widget-box" style="opacity: 1; z-index: 0;margin-bottom:1em;">
                    <form action="<?= U('') ?>" method="post" class="form-horizontal">
                        <div class="tab-content">
                            <div id="info2" class="tab-pane active">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                        会员公司名称
                                    </label>
                                    <div class="col-xs-12 col-sm-7">
                                        <input name="company_name" class="form-control" value="{$item.company_name}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                        公司法人名称
                                    </label>
                                    <div class="col-xs-12 col-sm-7">
                                        <input name="title" class="form-control" value="{$item.corporation_name}">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                        辅导主题
                                    </label>
                                    <div class="col-xs-12 col-sm-7">
                                        <input name="title" class="form-control" value="{$item.title}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                        辅导负责人
                                    </label>
                                    <div class="col-xs-12 col-sm-7">
                                        <input name="person" class="form-control" value="{$item.person}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                        辅导时间
                                    </label>
                                    <div class="col-xs-12 col-sm-6">
                                        <input name="insert_time" class="form-control insert_time" value="{$item.work_time}" type="text" data-date-format="dd-mm-yyyy">
                                    </div>
                                </div>

                               

                                <script id="tpl" type="text/regular">
                                    <div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                参会人
                                            </label>
                                            <span on-click="{this.add($event)}" class="btn btn-info check-tips my-tips">添加</span>
                                            {#if nums.length > 0}
                                                 <span on-click="{this.remove($event)}" class="btn btn-info check-tips my-tips">删除</span>
                                            {/if}
                                        </div>

                                        {#list nums as num}
                                            <div class="form-group">
                                                <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                </label>
                                                <span class="check-tips my-tips">姓名：</span>
                                                <div class="col-xs-12 col-sm-2">
                                                    <div class="clearfix">
                                                        <input type="text" name="names[]" class="width-100"
                                                               value="{num.name}">
                                                    </div>
                                                </div>
                                                <span class="check-tips my-tips">职务：</span>
                                                <div class="col-xs-12 col-sm-2">
                                                    <div class="clearfix">
                                                        <input type="text" name="jobs[]" class="width-100"
                                                               value="{num.job}">
                                                    </div>
                                                </div>
                                            </div>
                                        {/list}
                                    </div>
                                </script>

                                <div id="tplapp">
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                        主持人
                                    </label>
                                    <div class="col-xs-12 col-sm-7">
                                        <input name="emcee" class="form-control" value="{$item.emcee}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                        地址
                                    </label>
                                    <div class="col-xs-12 col-sm-7">
                                        <input name="address" class="form-control" value="{$item.address}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                        记录人
                                    </label>
                                    <div class="col-xs-12 col-sm-7">
                                        <input name="record" class="form-control" value="{$item.record}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">内容</label>
                                    <div class="col-xs-12 col-sm-7">
                                        <textarea style="height: 100px;width: 100%"  name="content"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">辅导重点</label>
                                    <div class="col-xs-12 col-sm-7">
                                        <textarea style="height: 100px;width: 100%"  name="emphasis"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">我们的分析</label>
                                    <div class="col-xs-12 col-sm-7">
                                        <textarea style="height: 100px;width: 100%"  name="analysis"></textarea>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                        客户完成功课时间
                                    </label>
                                    <div class="col-xs-12 col-sm-6">
                                        <input name="work_time" class="form-control work_time" value="{$item.work_time}" type="text" data-date-format="dd-mm-yyyy">
                                    </div>
                                </div>

                            </div>


                            <div class="clearfix form-actions">
                                <input type="hidden" name="uid" value="{$item.uid}">
                                <input type="hidden" name="id" value="{$item.id}">
                                <div class="col-xs-12">
                                    <button id="sub-btn" class="btn btn-sm btn-success no-border ajax-post no-refresh" target-form="form-horizontal" type="submit">
                                        确认保存
                                    </button>
                                    <a href="javascript:;" class="btn btn-white" onclick="history.go(-1)">
                                        返回
                                    </a>	</div>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</block>

<block name="script">
    <script src="__STATIC__/thinkbox/jquery.thinkbox.js"></script>
    <link href="__STATIC__/datetimepicker/css/datetimepicker.css" rel="stylesheet" type="text/css">
    <php>if(C('COLOR_STYLE')=='blue_color') echo '<link href="__STATIC__/datetimepicker/css/datetimepicker_blue.css" rel="stylesheet" type="text/css">';</php>
    <link href="__STATIC__/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="__STATIC__/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="__STATIC__/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
    <script src="__ACE__/js/query.validate.min.js"></script>
    <script src="__ACE__/js/regular.js"></script>

    <script type="text/javascript">
        var App = Regular.extend({
            template: '#tpl',
            init: function () {
            },
            add: function (e) {
                this.data.nums.push(1);
            },
            remove: function (e) {
                this.data.nums.pop();
            }
        });
        var app = new App({
            data: {
                nums: JSON.parse('<?= $item['parter'] ?>')
            }
        }).$inject('#tplapp');
        //搜索功能
        $('.work_time').datetimepicker({
            format: 'yyyy-mm-dd hh:ii:ss',
            language:"zh-CN",
            minView:2,
            autoclose:true
        });
        $('.insert_time').datetimepicker({
            format: 'yyyy-mm-dd hh:ii:ss',
            language:"zh-CN",
            minView:2,
            autoclose:true
        });
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
        highlight_subnav('{:U('tutor/index')}');
    </script>
</block>