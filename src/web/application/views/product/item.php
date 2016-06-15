<article>
    <section class="pad10">
        <div class="teacher_list">
            <ul>
                <li style="background: #fff;">
                    <a style="width: 100%;" href="javascript:;">
                        <div class="name" style="padding:  0;">
                            <p style="font-size: .3rem;border-bottom: 1px solid #e5e5e5;line-height: .8rem;height: .8rem">
                                <?= $product['name'] ?>
                            </p>
                            <p class="date"><?= $product['insert_time'] ?></p>
                        </div>
                        <div class="info">
                            <p class="txt1">
                                <?= $product['description'] ?>
                            </p>
                        </div>
                    </a>
                </li>
            </ul>
            <div style="height: .5rem;"></div>
        </div>
    </section>
</article>

<div style="    border-top: 1px solid #e5e5e5;
    padding: .1rem;
    position: fixed;
    bottom: 0;
    width: 100%;
    line-height: .8rem;
    background: #fff;">
    <div style="float: left;" class="price">
        <p style="    font-size: .3rem;">
            价格：<span style="font-size: .3rem;
    color: #EF4F4F;">￥<?= $product['cur_price'] ?></span>
        </p>
    </div>
    <a style="float: right" id="buy_product" href="javascript:;" class="weui_btn weui_btn_warn">立即购买</a>
</div>
<input type="hidden" value="<?= $product['id'] ?>" id="pid">
<script type="text/javascript" src="/javascript/lib/nej/define.js?p=wk|td-1&pro=/javascript/"></script>
<script>
    define([
        'base/element',
        'base/event',
        'util/ajax/xdr',
        'pro/vendor/zepto',
        'pro/vendor/layer'
    ], function (elem,event, ajax) {
        event._$addEvent('buy_product', 'click', function () {
            elem._$attr('buy_product', 'disabled', true);
            ajax._$request(
                    '/api/order/balance?' + Math.random(), {
                        type: 'json',
                        method: 'POST',
                        data: {payment: 'wxpay', pid: elem._$get('pid').value},
                        timeout: 60000,
                        onload: function (data) {
                            if (data.status == 0) {
                                //{status: 0, msg: "订单创建成功!", order_sn: "SD001604265610251527"}
                                window.location.href = "/order/dopay/sn/" + data.order_sn;// + e i.before_wxpay(e.order_sn)
                            } else {
                                layer.alert(data.msg);
                            }
                        },
                        onerror: function (_error) {
                            layer.alert('通讯失败!');
                        }
                    }
            );
        });
    })
</script>