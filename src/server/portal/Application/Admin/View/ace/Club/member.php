<extend name="Public/base" xmlns="http://www.w3.org/1999/html"/>

<block name="body">
    <div class="table-responsive">
        <div class="dataTables_wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="search-form">
                        <label>俱乐部名称或者用户微信昵称
                            <input type="text" class="search-input" name="search" value="{:I('search')}" placeholder="俱乐部名称">
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search" url="{:U('club/member')}">
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

                    <th class="">俱乐部名称</th>
                    <th class="">俱乐部联系方式</th>
                    <th class="">微信昵称</th>
                    <th class="">微信头像</th>
                    <th class="">加入时间</th>
                </tr>
                </thead>
                <tbody>
                <notempty name="_list">
                    <volist name="_list" id="vo">
                        <tr>
                            <td>{$vo.club_name}</td>
                            <td>{$vo.mobile}</td>
                            <td>{$vo.nickname}</td>
                            <td><img width="50" height="50" src="<?= imageView2($vo['headimgurl'], 120, 120) ?>" alt=""></td>
                            <td>{$vo.wu_insert_time}</td>
                        </tr>
                    </volist>
                    <else/>
                    <td colspan="9" class="text-center"> aOh! 暂时还没有内容! </td>
                </notempty>
                </tbody>
            </table>

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
        highlight_subnav('{:U("club/member")}');
    </script>
</block>