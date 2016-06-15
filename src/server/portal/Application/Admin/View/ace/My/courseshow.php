<extend name="Public/base" />

<block name="body">
    <!-- 表单 -->
    <style>
        td{width:50%;}
        img{max-width:400px;}
    </style>
    <div class="widget-box" style="opacity: 1; z-index: 0;margin-bottom:1em;">
        <div class="widget-header widget-header-small header-l-blue">
            <h5 class="smaller">课程详情页</h5>
        </div>
        <table class="table table-striped table-bordered table-hover item-table" style="margin-bottom:0px;">
            <tbody>
            <tr>
                <td><span style="color:#999;padding-right:8px;">课程标题:</span>{$item.title}</td>
            </tr>
            <tr>
                <td><span style="color:#999;padding-right:8px;">课程封面:</span>
                    <span class="preview">
                        <img src="<?=imageView2($item['logo'],120,120)?>" width="120"/>
                    </span>
                </td>
            </tr>
            <tr>
                <td><span style="color:#999;padding-right:8px;">课程附件:</span><a href="<?= get_qiniu_file_durl($item['att_url']) ?>">下载</a></td>
            </tr>
            <tr>
                <td><span style="color:#999;padding-right:8px;">课程描述:</span>{$item.description}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="widget-box transparent">
        <div class="widget-header widget-header-small">
            <h4 class="blue smaller">
                <i class="icon-comments orange"></i>
                老师点评
            </h4>
        </div>

        <div class="widget-body">
            <div class="widget-main padding-8">
                <volist name="_list" id="vo">
                    <div id="profile-feed-1" class="profile-feed">
                        <div class="profile-activity clearfix">
                            <div>
                                <a class="user" href="#"> {$vo.username} </a>
                                {$vo.content}
                                <div class="time">
                                    <i class="icon-time bigger-110"></i>
                                    {$vo.insert_time}
                                </div>
                            </div>
                        </div>
                    </div>
                </volist>
            </div>
        </div>
    </div>

    <form action="<?=U('')?>" class="form-horizontal">
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">发表评论</label>
            <div class="col-xs-12 col-sm-7">
                <textarea style="width: 100%;height: 100px;" name="content"></textarea>
            </div>
        </div>

        <div class="clearfix form-actions">

            <div class="col-xs-12">
                <input type="hidden" name="cid" value="{$item.id}"/>
                <button type="submit" target-form="form-horizontal" class="btn btn-sm btn-success no-border ajax-post no-refresh" id="sub-btn">
                    发表评论
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
        highlight_subnav('{:U('my/courses')}');
    </script>
</block>