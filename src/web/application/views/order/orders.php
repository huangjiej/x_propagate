<style>
    .order {border: 1px solid #E5E5E5;margin-bottom: .1rem;background: #fff;border-radius: .1rem;}
    .order img {margin: 0.17rem;width: 1.17rem;height: 1.17rem;float: left;}
    .order div.name {font-size: 0.29rem;}
    .order div.price {font-size: 0.29rem;margin-left:0.17rem;margin-right: 0.17rem;}
    .order div.price p {font-size: 0.29rem;}
    .order .order-cnt {margin-top: 0.17rem;}
    .order .order-cnt .del {color: #e5e5e5;text-decoration: line-through;}
    .order .order-cnt .num {color: #e5e5e5;}
    .order .order-info {display: table;padding: 0.25rem 0.17rem;width: 100%;border-top: 1px solid #e5e5e5;}
    .order .order-info .order-cell-right, .order .order-info .order-cell-left {font-size: 0.29rem;}
    .order .order-info .order-cell-left {display: table-cell;text-align: left}
    .order .order-info .order-cell-right {display: table-cell;text-align: right}
</style>
<article class="news">
    <section class="pad10">
        <div class="orders" >
            <ul id="orders">
                <?php if (empty($orders)) { ?>
                    <section class="ui-placehold-wrap">
                        <div class="ui-placehold">暂时没有数据...</div>
                    </section>
                <?php } else { ?>
                    <?php foreach ($orders as $order) { ?>
                        <li class="order fn-clear">
                            <div class="order-cnt">
                                <img src="<?= $order['main_pic'] ?>">
                                <div class="name"><?= $order['name'] ?></div>
                                <div class="price">
                                    <p>¥<?= $order['cur_price'] ?></p>
                                    <p class="del">¥<?= $order['old_price'] ?></p>
                                    <p class="num">×<?= $order['product_num'] ?></p>
                                </div>
                            </div>

                            <div class="order-info">
                                <?php if ($order['pay_status'] == 1) { ?>
                                    <div class="order-cell-left">
                                        交易成功
                                    </div>
                                    <div class="order-cell-right">
                                        实付款：￥<?= $order['amount'] ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="order-cell-left">
                                        未付款
                                    </div>
                                    <div class="order-cell-right">
                                        总计: <span style="font-size: .29rem" class="red">￥<?= $order['amount'] ?></span>
                                        <button style="float: right;" href="javascript:;" data-id="<?= $order['sn'] ?>"
                                                data-action="update" class="pay weui_btn weui_btn_mini weui_btn_warn">
                                            立即付款
                                        </button>
                                    </div>
                                <?php } ?>
                            </div>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
    </section>

</article>

<script type="text/javascript" src="/javascript/lib/nej/define.js?p=wk|td-1&pro=/javascript/"></script>
<script>
    NEJ.define([
        'base/element',
        'base/event',
        'base/util'
    ], function (elem, v, u, _p, _pro) {
        var pay_list = elem._$getByClassName(elem._$get('orders'), 'pay');
        u._$forEach(pay_list, function (itm) {
            v._$addEvent(itm, 'click', function () {
                window.location.href = "/order/dopay/sn/" + elem._$dataset(itm, 'id');
            })
        })
    });
</script>