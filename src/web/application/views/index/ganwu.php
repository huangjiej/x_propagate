<article class="news">
    <section class="pad10">
        <div class="product_list ">
            <ul class="j-flag" id="teacher-twitter-box">
            </ul>
            <a href="javascript:;" style="display: none;" id="teacher-twitter-more-btn" class="weui_btn weui_btn_primary">加载更多...</a>
        </div>
    </section>
</article>

<div id="template-box" style="display:none;">
      <textarea name="jst" id="teacher-twitter-tpl">
            {list beg..end as y}
            {var x=xlist[y]}
            <li style="padding-top: 0; padding-bottom: 0;background: #fff;">
                <a style="width: 100%;" href="${x.wx_url}">
                        <div class="auto">
                            <div class="name">${x.title}</div>
                            <img src="${x.cover_id}" style="height: 2.6rem;width: 100%;">
                            <p style="margin: .1rem 0;">${x.description}</p>
                            <div class="price">
                                <div class="more"><p>阅读全文</p></div>
                            </div>
                        </div>
                </a>
            </li>
            {/list}
       </textarea>
</div>


<script type="text/javascript" src="/javascript/lib/nej/define.js?p=wk|td-1&pro=/javascript/"></script>
<script>
    NEJ.define([
        'util/template/tpl',
        'pro/cache/teacher_twitter',
        'pro/cache/mywaterfall'
    ], function (tpl, tt, wf) {
        tpl._$parseTemplate('template-box');
        wf.MyWF._$allocate({
            limit:10,
            parent:'teacher-twitter-box',
            item:'teacher-twitter-tpl',
            cache:{lkey:'tt-list',klass:tt._$$TeacherTwitterCache},
            more: 'teacher-twitter-more-btn'
        });
    });
</script>