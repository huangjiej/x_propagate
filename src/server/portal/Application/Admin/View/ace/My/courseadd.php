<extend name="Public/base"/>

<block name="body">
    <div class="tabbable">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#person">
                    上传课件
                </a>
            </li>
        </ul>
        <form action="<?= U('') ?>" method="post" class="form-horizontal">
            <div class="tab-content">
                <div id="info2" class="tab-pane active">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                            课件标题
                        </label>
                        <div class="col-xs-12 col-sm-7">
                            <input name="title" class="form-control" value="{$item.title}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">上传功课（PPT）</label>
                        <div class="col-xs-12 col-sm-6">
                            <div class="upload-wrap">
                                <a href="javascript:" class="btn btn-sm btn-success file-upload"
                                   name="att_url" val="{$item['att_url']}" >
                                    <i class="icon-cloud-upload "></i>上传附件
                                </a>
                                <notempty name="item['att_url']">
                                    <div class="upload-pre-file">
                                        <span class="upload_icon_all"></span>
                                        <span class="file-name">{$item['att_url']}</span>
                                    </div>
                                </notempty>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">上传PPT封面</label>
                        <div class="col-xs-12 col-sm-6">
                            <div class="upload-wrap">
                                <a href="javascript:" class="btn btn-sm btn-success pic-upload" name="logo" val="{$item['logo']|default=''}" >
                                    <i class="icon-cloud-upload "></i>上传图片
                                </a>
                                <notempty name="item['logo']">
                                    <div class="preview"><img src="<?=imageView2($item['logo'],120,120)?>" width="120"/></div>
                                </notempty>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                            PPT简介
                        </label>
                        <div class="col-xs-12 col-sm-7">
                            <textarea name="description" class="form-control">{$item.description}</textarea>
                        </div>
                    </div>
                </div>


                <div class="clearfix form-actions">
                    <if condition="!empty($item)">
                        <input type="hidden" name="id" value="{$item.id}">
                        <input type="hidden" name="cid" value="{$item.cid}">
                    </if>
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
</block>

<block name="script">

    <include file="Public/upload.js"/>
    <include file="Public/upload.file"/>
    <include file="Public/upload.pic"/>
    <script type="text/javascript">

        highlight_subnav('{:U('my/courses')}');

    </script>
</block>
