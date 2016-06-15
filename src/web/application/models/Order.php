<?php
class OrderModel extends Model{

    public $table = 't_orders';
    /**
     * 已删除
     * @var string
     */
    const STATUS_DELETED    = 'DEL';

    /**
     * 已取消
     * @var string
     */
    const STATUS_CANCELLED  = 'YQX';

    /**
     * 待付款
     * @var string
     */
    const STATUS_WATI_PAY   = 'CRT';

    /**
     * 已完成
     * @var string
     */
    const STATUS_COMPLETED  = 'OK#';

    /**
     * 未付款
     * @var int
     */
    const PAY_STATUS_NO_PAY = 0;

    /**
     * 已付款
     * @var int
     */
    const PAY_STATUS_PAYD   = 1;

    public static $status_text = array(
        'YQX'=>'已关闭',
        'CRT'=>'等待付款',
        'OK#'=>'已完成',
        'DEL'=>'已删除',
    );

    public static $pay_status_text = array(
        '',
        '未付款',
        '已付款',
    );
}