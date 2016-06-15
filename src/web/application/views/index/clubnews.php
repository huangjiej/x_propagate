<article class="news padb80">
    <section class="pad10">
        <div class="news_list j-flag">
            <ul id="news_list">
                <?php foreach($list as $item) { ?>
                <li id="${x.id}">
                    <img src="<?= $item['cover_id'] ?>"  class="pic left">
                    <div class="auto">
                        <div class="name"><?= $item['title'] ?></div>
                        <p class="info"><?= $item['content'] ?></p>
                        <div class="clear bar">
                            <div class="left"><?= $item['insert_time'] ?></div>
                            <a  style="margin-left: .5rem;" data-id="<?= $item['id'] ?>" class="right delete">删除</a>
                            <a   href="/index/clubnewsitem?id=<?= $item['id'] ?>" class="right">查看</a>
                        </div>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
        <a href="/index/club" class="fixbot"><img src="/images/fbdt.png" alt=""></a>
    </section>
</article>
<script type="text/javascript" src="/javascript/lib/nej/define.js?p=wk|td-1&pro=/javascript/"></script>
<script>
    NEJ.define([
        'base/element',
        'pro/cache/club_news',
        'base/event',
        'base/util',
        'pro/vendor/zepto',
        'pro/vendor/layer'
    ], function (elem, cn, v, u ,_p, _pro) {
        var cache = cn._$$ClubNewsCache._$allocate({
                    id:'get-club-news-list',
                    onitemdelete: function (data) {
                        if (data.status > 1000) {
                            layer.msg('删除失败！');
                        } else {
                            layer.msg('成功删除！');
                            window.location.reload();
                        }
                    }
                }
        );
        var delete_list = elem._$getByClassName(elem._$get('news_list'),'delete');
        u._$forEach(delete_list, function (itm) {
            console.log(itm)
            v._$addEvent(itm, 'click', function () {
                layer.confirm(
                        '确认删除？',
                        true,
                        function(index){
                            cache._$deleteItem({id: elem._$dataset(itm, 'id'),key:'club-news',data:{id: elem._$dataset(itm, 'id')}})
                            layer.close(index)
                        },
                        function (index) {
                            layer.close(index);
                        }
                );
            })
        })

        
    });
</script>