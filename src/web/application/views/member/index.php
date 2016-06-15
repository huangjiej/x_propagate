<article id="lazy" class="index">
    <section class="">
        <div class="j-flag">
            <div class="ui-slider">
                <ul class="ui-slider-content" style="width: 300%">
                    <?php foreach($banner as $item){ ?>
                        <li class="current">
                        <span style="background-image:url(<?= $item['pic'] ?>)">
                            <a style="width: 100%;height: 100%" href="<?= $item['link'] ?>"> </a>
                        </span>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="nav j-flag">
            <a href="/member/health">
                <img src="/images/wdjh.png" class="ico">
                <p>我的健康</p>
            </a>
            <a href="/index/amazing">
                <img src="/images/hyjc.png" class="ico">
                <p>会员精彩</p>
            </a>
            <a href="/index/news">
                <img src="/images/jlbhd.png" class="ico">
                <p>俱乐部活动</p>
            </a>

            <a href="/member/dare">
                <img src="/images/jktzs.png" class="ico">
                <p>健康挑战赛</p>
            </a>
        </div>
        <div class="split"></div>
        <div class="j-flag-thank">
            <a style="width: 100%" href="/thank/index">
                <div style="position: relative;" class="thank-wall">
                    <img style="height: 100%;" src="<?= $thank['banner'] ?>" alt="">
                    <img style="position: absolute;top: -3px;left: 0;height: .6rem" src="/images/ganen.jpg?sdds" alt="">
                </div>
                <div class="thank-info" style="display: table;width: 100%;">
                    <div style="font-size: .25rem;display: table-cell;line-height: .6rem;">共有
                        <span style="color: #f25234;font-size: 18px;font-weight: bold;"><?= $thank['p_nums'] ?></span>
                        人给教练们送出了
                        <span style="color: #f25234;font-size: 18px;font-weight: bold;"><?= $thank['g_nums'] ?></span>
                        件礼物
                    </div>
                    <div style="display: table-cell;">
                        <img src="/images/wyge.jpg?22222" style="height: .6rem" alt="">
                    </div>
                </div>
            </a>
        </div>
        <div class="split"></div>
        <div class="list">
            <div class="tit">俱乐部活动
                <div class="more"><a class="" href="/index/news">查看更多</a></div>
            </div>
            <div class="j-flag">
                <ul>
                    <?php if (empty($club)) { ?>
                        <section class="ui-placehold-wrap">
                            <div class="ui-placehold">暂时没有数据！</div>
                        </section>
                    <?php } else { ?>
                        <?php foreach($club as $item){ ?>
                            <li>
                                <a href="<?= $item['wx_url'] ?>">
                                    <img src="<?= $item['cover_id'] ?>" class="pic left">
                                    <div class="auto">
                                        <div class="name clear"><strong class="left"><?= $item['title'] ?></strong>
                                            <span class="right"><?= $item['insert_time'] ?></span></div>
                                        <p class="ovh">
                                            <?= $item['content'] ?>
                                        </p>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <div class="split"></div>
        <div  class="list">
            <div class="tit">会员精彩
                <div class="more"><a class="" href="/index/amazing">查看更多</a></div>
            </div>
            <div class="j-flag">
                <ul>
                    <?php foreach($amazing as $item){ ?>
                        <li>
                            <a href="<?= $item['wx_url'] ?>">
                                <img src="<?= $item['cover_id'] ?>" class="pic left">
                                <div class="auto">
                                    <div class="name clear"><strong class="left"><?= $item['title'] ?></strong>
                                        <span class="right"><?= $item['insert_time'] ?></span></div>
                                    <p class="ovh">
                                        <?= $item['description'] ?>
                                    </p>
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        
        <div class="split"></div>
        <div class="list">
            <div class="tit">俱乐部动态
                <div class="more"><a class="" href="/index/ganwu">查看更多</a></div>
            </div>
            <div class="j-flag">
                <ul>
                    <?php foreach($club_news as $item){ ?>
                        <li>
                            <a href="<?= $item['wx_url'] ?>">
                                <img src="<?= $item['cover_id'] ?>" class="pic left">
                                <div class="auto">
                                    <div class="name clear"><strong class="left"><?= $item['title'] ?></strong>
                                        <span class="right"><?= $item['insert_time'] ?></span></div>
                                    <p class="ovh">
                                        <?= $item['description'] ?>
                                    </p>
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </section>
</article>

<script src="/javascript/vendor/zepto.js"></script>
<script src="/javascript/vendor/frozen.js"></script>
<script>
    new fz.Scroll('.ui-slider', {
        role: 'slider',
        indicator: true,
        autoplay: true,
        interval: 3000
    });
</script>