<extend name="Public/base" />

<block name="body">
    <!-- 表单 -->
    <style>
        td{width:50%;}
        img{max-width:400px;}
    </style>
    <form action="{:U('')}" method="post" class="form-horizontal">
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">动态标题</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="title"
                       value="{$item.title}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">动态内容</label>
            <div class="col-xs-12 col-sm-7">
                <textarea style="width: 100%;height: 100px;" name="content">{$item.content}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">封面</label>
            <div class="col-xs-12 col-sm-6">
                <div class="upload-wrap">
                    <a href="javascript:" class="btn btn-sm btn-success pic-upload" name="cover_id" val="{$item['cover_id']|default=''}" >
                        <i class="icon-cloud-upload "></i>上传图片
                    </a>
                    <notempty name="item['cover_id']">
                        <div class="preview"><img width="240" height="240" src="<?=imageView2($item['cover_id'],240,240)?>" /></div>
                    </notempty>
                </div>
            </div>
        </div>

        <if condition="!empty($item)">
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 control-label no-padding-right">状态</label>
                <div class="col-xs-12 col-sm-7">
                    <label><input type="radio" <?= $item['status'] == 1 ? 'checked' : '' ?> class="ace" name="status" value="1"><span class="lbl">上架&nbsp;</span></label>
                    <label><input type="radio" <?= $item['status'] == -1 ? 'checked' : '' ?> class="ace" name="status" value="-1"><span class="lbl">下架&nbsp;</span></label>
                </div>
            </div>
        </if>

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
    <script>

        //导航高亮
        highlight_subnav('{:U("twitter/index")}');
    </script>
</block>