<extend name="Public/base" />

<block name="body">
    <!-- 表单 -->
    <style>
        td{width:50%;}
        img{max-width:400px;}
    </style>
    <div class="widget-box" style="opacity: 1; z-index: 0;margin-bottom:1em;">
        <div class="widget-header widget-header-small header-l-blue">
            <h5 class="smaller">会员回访详细信息</h5>
        </div>
        <table class="table table-striped table-bordered table-hover item-table" style="margin-bottom:0px;">
            <tbody>
            <tr>
                <td><span style="color:#999;padding-right:8px;">姓名:</span>{$item.chairman_name}</td>
            </tr>
            <tr>
                <td><span style="color:#999;padding-right:8px;">手机号码:</span>{$item.telephone}</td>
            </tr>
            <tr>
                <td><span style="color:#999;padding-right:8px;">签约类型:</span>{$item.title}</td>
            </tr>
            <tr>
                <td><span style="color:#999;padding-right:8px;">职位:</span>{$item.position}</td>
            </tr>
            <tr>
                <td><span style="color:#999;padding-right:8px;">公司名称:</span>{$item.company_name}</td>
            </tr>
            <tr>
                <td><span style="color:#999;padding-right:8px;">签约时间:</span>{$item.time}</td>
            </tr>
            <tr>
                <td><span style="color:#999;padding-right:8px;">回访人:</span>{$item.huifangren}</td>
            </tr>
            <tr>
                <td><span style="color:#999;padding-right:8px;">回访时间:</span>{$item.insert_time}</td>
            </tr>
            </tbody>
        </table>

    </div>

    <form action="" class="form-horizontal">
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">回访记录</label>
            <div class="col-xs-12 col-sm-7">
                <textarea  name="content">{$item.content}</textarea>
                {:hook('adminArticleEdit', array('name'=>'content','value'=>$item.content))}
            </div>
        </div>
        
        <div class="clearfix form-actions">
            <div class="col-xs-12">
                <input type="hidden" name="id" value="{$item.id}"/>
                <button type="submit" target-form="form-horizontal" class="btn btn-sm btn-success no-border ajax-post no-refresh" id="sub-btn">
                    修改
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
        highlight_subnav('{:U('User/userReturn')}');
    </script>
</block>