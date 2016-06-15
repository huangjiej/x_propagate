<div class="dare">
    <div class="dare-1">
        <div class="dare-title table">
            <div class="table-cell dart-title-img"><img src="/images/减重达人.png" alt=""></div>
            <div class="table-cell-left"><p>减重达人</p></div>
        </div>

        <div class="dare-cnt">
            <div class="dare-data table">
                <div class="table-cell">
                    <p class="dare-num"><?= $self_number['weight_position'] ?></p>
                    <p class="dare-info">我的名次</p>
                </div>
                <div class="table-cell">
                    <p class="dare-num"><?= $self_number['minus_weight'] ?><span style="font-size: .26rem">%</span></p>
                    <p class="dare-info">减重比例</p>
                </div>
            </div>

            <a href="/member/list?tab=0" class="dare-no1 table">
                <div class="dare-no1-img table-cell"><img src="<?= $fat_number_one['headimgurl'] ?>" alt=""></div>
                <div class="dare-no1-name table-cell"><?= $fat_number_one['nickname'] ?></div>
                <div class="dare-no1-info table-cell">夺得<?= $dare_time['dare_date'] ?>排行榜冠军</div>
                <div class="table-cell"><div class="dare-no1-more "></div></div>
            </a>
        </div>
    </div>
    <div class="split"></div>
    <div class="dare-2">
        <div class="dare-title table">
            <div class="table-cell dart-title-img"><img src="/images/减脂达人.png" alt=""></div>
            <div class="table-cell-left"><p>减脂达人</p></div>
        </div>

        <div class="dare-cnt">
            <div class="dare-data table">
                <div class="table-cell">
                    <p class="dare-num"><?= $self_number['fat_position'] ?></p>
                    <p class="dare-info">我的名次</p>
                </div>
                <div class="table-cell">
                    <p class="dare-num"><?= $self_number['minus_fat'] ?><span style="font-size: .26rem">%</span></p>
                    <p class="dare-info">减重比例</p>
                </div>
            </div>

            <a href="/member/list?tab=1" class="dare-no1 table">
                <div class="dare-no1-img table-cell"><img src="<?= $fat_number_one['headimgurl'] ?>" alt=""></div>
                <div class="dare-no1-name table-cell"><?= $fat_number_one['nickname'] ?></div>
                <div class="dare-no1-info table-cell">夺得<?= $dare_time['dare_date'] ?>排行榜冠军</div>
                <div class="table-cell"><div class="dare-no1-more "></div></div>
            </a>
        </div>
    </div>
</div>