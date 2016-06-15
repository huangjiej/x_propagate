<div class="gift-box" id="gift">
    <div class="j-flag">
        <div class="g-x">
            <img src="<?= $gift['main_pic'] ?>" width="100%"/>
        </div>
        <div class="g-y"><?= $gift['name'] ?><span>x</span>
            <?= $gift['nums'] ?></div>

        <div class="g-z">
            <textarea  placeholder="感谢教练一直以来的陪伴！" name="" class="bigtext gift-remake"></textarea>
        </div>
        <div class="g-price">¥<?= $gift['amount'] ?></div>
        <div class="lj-zs" id="dopay">
            <img width="100%" src="/images/ljzs.png" class="dopay" alt="">
        </div>
    </div>

    <input type="hidden" id="pid" value="<?= $gift['id'] ?>">
    <input type="hidden" id="nums" value="<?= $gift['nums'] ?>">
</div>


<script type="text/javascript" src="/javascript/lib/nej/define.js?p=wk|td-1&pro=/javascript/"></script>
<script>
    define([
        'base/klass',
        'base/element',
        'util/template/tpl',
        'util/template/jst',
        'util/ajax/xdr',
        'base/event'
    ], function (_k, _e, _l, _j,ajax, event) {
        event._$addEvent('dopay', 'click', function () {
            var remark = _e._$getByClassName('gift', 'gift-remake')[0].value;
            if (remark.length <= 0) {
                remark = '感谢教练一直以来的陪伴！';
            }
            _e._$attr('now-dopay', 'disabled', true);
            ajax._$request(
                     '/api/order/balance?' + Math.random(), {
                        type: 'json',
                        method: 'POST',
                        data: {
                            payment: 'wxpay',
                            pid:  _e._$get('pid').value,
                            count: _e._$get('nums').value,
                            remark: remark
                        },
                        timeout: 60000,
                        onload: function (data) {
                            if (data.status == 0) {
                                //{status: 0, msg: "订单创建成功!", order_sn: "SD001604265610251527"}
                                window.location.href = "/order/dopay/sn/" + data.order_sn;// + e i.before_wxpay(e.order_sn)
                            } else {
                                layer.alert(data.msg);
                            }
                        },
                        onerror: function () {
                            layer.alert('通讯失败!');
                        }
                    }
            );
        })
    })
</script>