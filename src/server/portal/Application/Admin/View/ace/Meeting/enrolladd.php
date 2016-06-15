<extend name="Public/base" />

<block name="body">
    <!-- 表单 -->
    <style>
        td{width:50%;}
        img{max-width:400px;}
    </style>
    <form action="<?= empty($item) ?  U('Meeting/enrollAdd') : U('Meeting/enrollEdit')  ?>" class="form-horizontal">
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">会议场次</label>
            <div class="col-xs-12 col-sm-7">
                <select id="meeting_id" name="meeting_id" data-id="<?= empty($item) ? "" : $item['meeting_id'] ?>">
                    <option value="0">选择会议场次</option>
                    <volist name="meetings" id="vo">
                        <option value="{$vo.id}">{$vo.title}</option>
                    </volist>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">姓名</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="name"
                       value="<?= empty($item) ? "" : $item['name'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">手机号码</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="mobile"
                       value="<?= empty($item) ? "" : $item['mobile'] ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">年龄</label>
            <div class="col-xs-12 col-sm-7">
                <select id="age" data-id="<?= empty($item) ? "" : $item['age'] ?>" name="age" class="insideSelect fs_content fs_input">
                    <option value=""> 请选择 </option>
                    <option value="1"> 30-40岁 </option>
                    <option value="2"> 40-50岁 </option>
                    <option value="3"> 50岁以上 </option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">职位</label>
            <div class="col-xs-12 col-sm-7">
                <select id="position" name="position" data-id="<?= empty($item) ? "" : $item['position'] ?>" class="insideSelect fs_content fs_input">
                    <option value=""> 请选择 </option>
                    <option value="1"> 董事长 </option>
                    <option value="2"> 总裁 </option>
                    <option value="3"> 总经理 </option>
                    <option value="4"> 其他 </option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">公司名称</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="company_name"
                       value="<?= empty($item) ? "" : $item['company_name'] ?>" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">推荐人名称</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="referee">
            </div>
        </div>

        <div class="clearfix form-actions">
            <if condition="!empty($item)">
                <input type="hidden" name="id" value="{$item.id}">
            </if>

            <div class="col-xs-12">
                <button type="submit" target-form="form-horizontal" class="btn btn-sm btn-success no-border ajax-post no-refresh" id="sub-btn">
                    保存
                </button>
                <a class="btn btn-white" href="javascript:history.go(-1)">
                    返回
                </a>
            </div>
        </div>
    </form>
</block>

<block name="script">
    <script src="__STATIC__/thinkbox/jquery.thinkbox.js"></script>

    <script type="text/javascript">
        (function ($) {
            //选择企业分类
            var meeting_id = $('#meeting_id');
            var id = meeting_id.data('id');
            meeting_id.val(id);

            //企业性质
            var age = $('#age');
            var eid = age.data('id');
            age.val(eid);

            //管理经验
            var position = $('#position');
            var pd = position.data('id');
            position.val(eid);

        })(jQuery);
        highlight_subnav('{:U('Meeting/enroll')}');
    </script>
</block>
