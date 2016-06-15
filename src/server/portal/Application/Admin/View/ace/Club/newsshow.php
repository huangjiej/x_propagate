<extend name="Public/base" xmlns="http://www.w3.org/1999/html"/>
<block name="body">
    <div class="detail-content">
        <div class="page-header">
            <h1>
                动态详情
            </h1>
        </div>
        <div class="widget-header widget-header-small header-color-blue">
            <h6 class="smaller">
                俱乐部动态详情
            </h6>
        </div>
        <table class="table table-striped table-bordered table-hover">
            <tbody>
            <tr>
                <th width="50%">俱乐部名称</th>
                <td>
                    <?=$item['club_name']?>
                </td>
            </tr>
            <tr>
                <th width="50%">发布人</th>
                <td>
                    <?=$item['nickname']?>
                </td>
            </tr>
            <tr>
                <th width="50%">联系方式</th>
                <td>
                    <?=$item['mobile']?>
                </td>
            </tr>
            <tr>
                <th width="50%">标题</th>
                <td>
                    <?=$item['title']?>
                </td>
            </tr>
            <tr>
                <th width="50%">封面</th>
                <td>
                    <img src="<?=imageView2($item['cover_id'],120,120)?>" alt="">
                </td>
            </tr>
            <tr>
                <th width="50%">内容</th>
                <td>
                    <?=$item['content']?>
                </td>
            </tr>
            <tr>
                <th width="50%">发布时间</th>
                <td>
                    <?=$item['insert_time']?>
                </td>
            </tr>
            </tbody>
        </table>


        <div class="clearfix form-actions">
            <div class="col-xs-12">
                <a onclick="history.go(-1)" class="btn btn-white" href="javascript:;">
                    <i class="icon-reply"></i>返回上一页
                </a>
            </div>
        </div>
    </div>
</block>

<block name="script">
    <script>
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
                $("#search-btn").click();
                return false;
            }
        });

        //导航高亮
        highlight_subnav('{:U("club/news")}');
    </script>
</block>