<article class="club-twitter-detail">
    <section class="pad10">
        <div class="teacher_list j-flag">
            <ul>
                <li>
                    <a href="javascript:;">
                        <div class="name">
                            <p><?= $item['title'] ?></p>
                            <p class="date"><?= $item['insert_time'] ?></p>
                        </div>
                        <div class="info">
                                <p class="txt1">
                                    <?= $item['content'] ?>
                                </p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </section>
</article>
<style>
    .club-twitter-detail .name {border-bottom: 1px solid #E5E5E5;position: relative}
    .club-twitter-detail .name .date {    position: absolute;
        right: 0;
        top: 8px;}
    .club-twitter-detail li a{width: 100%;}
    .club-twitter-detail li .info{border: none;}
</style>