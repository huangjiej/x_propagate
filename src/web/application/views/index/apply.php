<article class="apply">
    <section class="pad10">
        <div class="box j-flag">
            <div class="apply_info clear">
                <img src="<?= $product['main_pic'] ?>" class="pic">
                <div class="auto">
                    <div class="name"><?= $product['name'] ?></div>
                    <div  class="price1">原价 ¥ <?= $product['cur_price'] ?></div>
                    <div class="price2 red">¥<span><?= $product['old_price'] ?></span></div>
                </div>
            </div>
            <div class="apply_txt">
                <p><?= $product['description'] ?>
                </p>
            </div>
            <div class="clear apply_count">
                <div class="left">
                    <i class="radio on"></i>
                    我已阅读并同意<a href="http://hp.fengniao.info/index/protocol" class="red">《俱乐部申请协议》</a>
                </div>
                <div class="right">价格：<span class="red">¥ <span class="fz30"><?= $product['cur_price'] ?></span></span></div>
            </div>
        </div>
        <input type="hidden" id="price" value="2999">
        <a href="javascript:;" id="J_payBtn" class="btn_pay mart40">立即支付</a>
    </section>
</article>

<script type="text/javascript" src="/javascript/lib/nej/define.js?p=wk|td-1&pro=/javascript/"></script>
<script>
    define([
        'base/element',
        'base/event',
        'util/ajax/xdr',
        'pro/vendor/zepto',
        'pro/vendor/layer'
    ], function (elem,event, ajax) {
        event._$addEvent('J_payBtn', 'click', function () {
            elem._$attr('J_payBtn', 'disabled', true);
            ajax._$request(
                    '/api/order/balance?' + Math.random(), {
                        type: 'json',
                        method: 'POST',
                        data: {payment: 'wxpay', pid: 1},
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