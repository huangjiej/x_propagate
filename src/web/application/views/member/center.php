<article class="person">
    <section class="">
        <div class="box2 form mart20 j-flag">
            <ul>
                <li>
                    <a href="javascript:;">
                        <div class="lab">我的头像</div>
                        <div class="value"><img src="<?= $club['headimgurl'] ?>" class="avtar"></div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <div class="lab">我的昵称</div>
                        <div class="value"><?= $club['nickname'] ?></div>
                    </a>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="javascript:;">
                        <div class="lab">我的俱乐部</div>
                        <div class="value"><?= $club['club_name'] ?></div>
                    </a>
                </li>
                <li>
                    <a href="/order/orders">
                        <div class="lab">我的订单</div>
                        <div class="value"><i class="i-right"></i></div>
                    </a>
                </li>
            </ul>
        </div>
    </section>
</article>
