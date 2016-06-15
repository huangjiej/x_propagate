<extend name="Public/base" />

<block name="body">
    <!-- 表单 -->
    <style>
        td{width:50%;}
        img{max-width:400px;}
    </style>
    <form action="<?= empty($item) ?  U('Meeting/add') : U('Meeting/edit')  ?>" class="form-horizontal">
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">标题</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="title"
                       value="<?= empty($item) ? "" : $item['title'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">副标题</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="subheading"
                       value="<?= empty($item) ? "" : $item['subheading'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">会议主题图片</label>
            <div class="col-xs-12 col-sm-6">
                <div class="upload-wrap">
                    <a href="javascript:" class="btn btn-sm btn-success pic-upload" name="pic_url" val="{$item['pic_url']|default=''}" >
                        <i class="icon-cloud-upload "></i>上传图片
                    </a>
                    <notempty name="item['pic_url']">
                        <div class="preview"><img src="<?=imageView2($item['pic_url'],340,150)?>" /></div>
                    </notempty>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">会议描述</label>
            <div class="col-xs-12 col-sm-7">
                <textarea  style="width: 100%;height: 100px;" name="description">{$item.description}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">会议流程</label>
            <div class="col-xs-12 col-sm-7">
                <textarea style="width: 100%;height: 100px;" name="process">{$item.process}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">联系人</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="contacts"
                       value="<?= empty($item) ? "" : $item['contacts'] ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">联系电话</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="contact_phone"
                       value="<?= empty($item) ? "" : $item['contact_phone'] ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">会议时间</label>
            <div class="col-xs-12 col-sm-7">
                <input name="agenda_date" class="form-control date-picker" value="{$item.agenda_date}" type="text" data-date-format="dd-mm-yyyy">
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">会议地址</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="address"
                       value="<?= empty($item) ? "" : $item['address'] ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">联系邮箱</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="contact_email"
                       value="<?= empty($item) ? "" : $item['contact_email'] ?>">
            </div>
        </div>
        <hr>

        <div class="clearfix form-actions">
            <div class="col-xs-12">
                <if condition="!empty($item)">
                    <input type="hidden" name="id" value="{$item.id}" />
                </if>
                <button type="submit" target-form="form-horizontal" class="btn btn-sm btn-success no-border ajax-post no-refresh" id="sub-btn">
                    确认
                </button>
                <a class="btn btn-white" href="javascript:history.go(-1)">
                    返回
                </a>
            </div>
        </div>
    </form>
</block>

<block name="script">
    <include file="Public/upload.js"/>
    <include file="Public/upload.pic"/>
    <script src="__STATIC__/thinkbox/jquery.thinkbox.js"></script>
    <link href="__STATIC__/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
    <link href="__STATIC__/datetimepicker/css/datetimepicker.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="__STATIC__/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="__STATIC__/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
    <script src="__ACE__/js/bootstrap-colorpicker.min.js"></script>
    <script type="text/javascript">
        jQuery(function ($) {


            var background = $('#simple-colorpicker-1').data('id');
            if (!!background) $('#simple-colorpicker-1').val(background);

            var font_color = $('#simple-colorpicker-2').data('id');
            if (!!font_color) $('#simple-colorpicker-2').val(font_color);

            $('#simple-colorpicker-1').ace_colorpicker();
            $('#simple-colorpicker-2').ace_colorpicker();
        });
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
        $('.date-picker').datetimepicker({
            format: 'yyyy-mm-dd hh:ii:ss',
            language:"zh-CN",
            minView:2,
            autoclose:true
        });
        //导航高亮
        highlight_subnav('{:U('Meeting/index')}');
    </script>
</block>