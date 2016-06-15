<extend name="Public/base" />

<block name="body">
    <!-- 表单 -->
    <div class="table-responsive">
        <div class="dataTables_wrapper">
            <div class="widget-box" style="opacity: 1; z-index: 0;margin-bottom:1em;">
                <div class="widget-header widget-header-small header-l-blue">
                    <h5 class="smaller">会员回访详细信息</h5>
                </div>
                <table class="table table-striped table-bordered table-hover item-table" style="margin-bottom:0px;">
                    <tbody>
                    <tr>
                        <td><span style="color:#999;padding-right:8px;">姓名:</span><a href="{:U('Meeting/companyedit',array('eid'=>$item['eid']))}">{$item.chairman_name}</a></td>
                    </tr>
                    <tr>
                        <td><span style="color:#999;padding-right:8px;">手机号码:</span>{$item.mobile}</td>
                    </tr>
                    <tr>
                        <td><span style="color:#999;padding-right:8px;">职位:</span>{$item.position}</td>
                    </tr>
                    <tr>
                        <td><span style="color:#999;padding-right:8px;">公司名称:</span>{$item.company_name}</td>
                    </tr>
                    <tr>
                        <td><span style="color:#999;padding-right:8px;">公司描述:</span>{$item.description}</td>
                    </tr>
                    </tbody>
                </table>

            </div>
            <form action="{:U()}" class="form-horizontal" method="post">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">添加类型</label>
                    <div class="col-xs-12 col-sm-7">
                        <label><input type="radio" <?= $item['group_id']==6 ? 'checked' : '' ?> class="ace" name="group_id" value="6"><span class="lbl">金种子&nbsp;</span></label>
                        <label><input type="radio" <?= $item['group_id']==5 ? 'checked' : '' ?> class="ace" name="group_id" value="5"><span class="lbl">银种子&nbsp;</span></label>
                    </div>
                </div>

                <div class="clearfix form-actions">
                    <div class="col-xs-12">
                        <input type="hidden" name="uid" value="{$item.uid}"/>
                        <button type="submit" target-form="form-horizontal"
                                class="btn btn-sm btn-success no-border ajax-post no-refresh" id="sub-btn">
                            保存
                        </button>
                        <a class="btn btn-white" href="javascript:history.go(-1)">
                            返回
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</block>

<block name="script">
    <script type="text/javascript">

        (function($){
            var meeting_id = $('#meeting_id');
            var id = parseInt(meeting_id.data('id'));
            //console.log(meeting_id.val())
            meeting_id.val(id);
        })(jQuery);
        //导航高亮
        highlight_subnav('{:U('member/index')}');
    </script>
</block>
