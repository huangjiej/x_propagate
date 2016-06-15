<?php
use Yaf\Dispatcher;
/**
  关闭
  php cli.php "request_uri=/swoolehttp/stop"
  重启
  php cli.php "request_uri=/swoolehttp/stop"
  php cli.php "request_uri=/swoolehttp/start"

  强制杀死
  php cli.php "request_uri=/swoolehttp/kill"
 * */
class SwoolehttpController extends Yaf\Controller_Abstract {
    
    public function init(){

        Dispatcher::getInstance()->returnResponse(true);
        Dispatcher::getInstance()->disableView();
    }
    
    public function reloadAction() {
        $http_master_pid = file_get_contents(LOG_PATH.'club-swoole-master.pid');
        exec("kill -USR1  $http_master_pid");
        echo "SwooleHttp Process Reload" . PHP_EOL;
    }

    public function stopAction() {
        $http_master_pid = file_get_contents(LOG_PATH . 'club-swoole-manager.pid');
        echo "Kill -15 $http_master_pid".PHP_EOL;
        exec("kill -15  $http_master_pid");

        echo "ps aux |grep baby_swoole |wc -l".PHP_EOL;
        exec("ps aux |grep baby_swoole |wc -l", $output, $exitval);
        echo " SwooleHttp Process Num:" . $output[0] . PHP_EOL;

        if ($output[0] > 2) {
            echo "SwooleHttp is already running!!!" . PHP_EOL;
        }
    }

    public function killAction() {
        $http_master_pid = file_get_contents(LOG_PATH.'club-swoole-master.pid');

        echo "Kill -15 $http_master_pid".PHP_EOL;
        exec("kill -15  $http_master_pid");

        echo "ps aux |grep baby_swoole |wc -l".PHP_EOL;
        exec("ps aux |grep baby_swoole |wc -l", $output, $exitval);
        echo "Swoole Process Num:" . $output[0] . PHP_EOL;

        if ($output[0] > 2) {
            exec("ps aux |grep baby_swoole | awk '/baby_swoole/{print $2}' | xargs kill -9", $output1, $exitval1);
            echo "Swoole Process Killed:" . $output1[0] . PHP_EOL;
        }
    }

}
