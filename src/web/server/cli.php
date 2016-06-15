<?php
/**
 * Yaf.app Framework
 *
 * 程序入口（普通请求、API请求）
 *
 * @author 王雪兵<406964108@qq.com>
 * @copyright Copyright (c) 2014
 */
date_default_timezone_set('PRC');
define ('DS', DIRECTORY_SEPARATOR);
define ('ROOT_PATH', realpath(dirname(__FILE__) . '/../'));
define ('APP_PATH', ROOT_PATH.DS.'application'.DS);
define ('LOG_PATH','/var/log/swoole/');
SeasLog::setLogger('api/health');

$config = json_decode(Qconf::getConf("/health/application.json"),true);
$config['application']['directory'] = APP_PATH;

$app = new Yaf\Application ($config);
$app->bootstrap()->getDispatcher()->dispatch(new Yaf\Request\Simple());
