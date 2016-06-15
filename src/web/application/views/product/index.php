<article class="news">
    <section class="pad10">
        <div class="product_list">
            <ul class="j-flag">
                <?php foreach($list as $item) { ?>
                <li style="padding-top: 0; padding-bottom: 0;background: #fff;">
                    <a style="width: 100%;" href="/product/item?id=<?= $item['id'] ?>">
                        <div class="auto">
                            <div class="name"><?= $item['name'] ?></div>
                            <img src="<?= $item['main_pic'] ?>" style="height: 2.6rem;width: 100%;">
                            <p class="info"><?= $item['info'] ?></p>
                            <div class="price">
                                <span class="red">¥ <span class="fz30"><?= $item['cur_price'] ?></span></span>
                                <span class="del">原价¥<?= $item['old_price'] ?></span>
                                <div class="more"><p>查看更多</p></div>
                            </div>
                        </div>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </section>
</article>