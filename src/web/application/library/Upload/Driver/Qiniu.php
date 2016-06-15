<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yangweijie <yangweijiester@gmail.com> <http://www.code-tech.diandian.com>
// +----------------------------------------------------------------------

namespace Upload\Driver;
use Upload\Driver\Qiniu\QiniuStorage;

class Qiniu{
    /**
     * 上传文件根目录
     * @var string
     */
    private $rootPath;

    /**
     * 上传错误信息
     * @var string
     */
    private $error = '';

    private $config = array(
        'secrectKey'     => '', //七牛服务器
        'accessKey'      => '', //七牛用户
        'domain'         => '', //七牛密码
        'bucket'         => '', //空间名称
        'timeout'        => 300, //超时时间
    );

    /**
     * 构造函数，用于设置上传根路径
     * @param array  $config FTP配置
     */
    public function __construct($config){
        $this->config = array_merge($this->config, $config);
        /* 设置根目录 */
        $this->qiniu = new QiniuStorage($config);
    }

    /**
     * 检测上传根目录(七牛上传时支持自动创建目录，直接返回)
     * @param string $rootpath   根目录
     * @return boolean true-检测通过，false-检测失败
     */
    public function checkRootPath($rootpath){
        $this->rootPath = trim($rootpath, './') . '/';
        return true;
    }

    /**
     * 检测上传目录(七牛上传时支持自动创建目录，直接返回)
     * @param  string $savepath 上传目录
     * @return boolean          检测结果，true-通过，false-失败
     */
    public function checkSavePath($savepath){
        return true;
    }

    /**
     * 创建文件夹 (七牛上传时支持自动创建目录，直接返回)
     * @param  string $savepath 目录名称
     * @return boolean          true-创建成功，false-创建失败
     */
    public function mkdir($savepath){
        return true;
    }

    /**
     * 保存指定文件
     * @param  array   $url    保存的文件url
     * @param  boolean $replace 同名文件是否覆盖
     * @return boolean          保存状态，true-成功，false-失败
     */
    public function save(&$url,$replace=true) {
        $upfile = array(
            'name'=>'file',
            'fileBody'=>curlRequest($url)
        );
        $exts = [
            IMAGETYPE_GIF=>'.gif',
            IMAGETYPE_JPEG=>'.jpg',
            IMAGETYPE_PNG=>'.png',
            IMAGETYPE_BMP=>'.bmp'
        ];
        $img_type = intval(exif_imagetype($url));
        if(!isset($exts[$img_type])){
            $this->qiniu->errorStr = '图片类型不正确！';
            return false;
        }

        $upfile['fileName'] = md5($upfile['fileBody']).$exts[$img_type];

        $config = array();
        $result = $this->qiniu->upload($config, $upfile);
        $url = $this->qiniu->downlink($upfile['fileName']);

        return false ===$result ? false : true;
    }

    /**
     * 保存指定文件
     * @param  array   $url    保存的文件url
     * @param  boolean $replace 同名文件是否覆盖
     * @return boolean          保存状态，true-成功，false-失败
     */
    public function save2(&$url,$replace=true) {
        $upfile = array(
            'name'=>'file',
            'fileBody'=>file_get_contents($url) // 替代curlRequest读取文件内容
        );
        $exts = [
            IMAGETYPE_GIF=>'.gif',
            IMAGETYPE_JPEG=>'.jpg',
            IMAGETYPE_PNG=>'.png',
            IMAGETYPE_BMP=>'.bmp'
        ];
        $img_type = intval(exif_imagetype($url));
        if(!isset($exts[$img_type])){
            $this->qiniu->errorStr = '图片类型不正确！';
            return false;
        }

        $upfile['fileName'] = md5($upfile['fileBody']).$exts[$img_type];

        $config = array();
        $result = $this->qiniu->upload($config, $upfile);
        $url = $this->qiniu->downlink($upfile['fileName']);

        return false ===$result ? false : true;
    }

    /**
     * 获取最后一次上传错误信息
     * @return string 错误信息
     */
    public function getError(){
        return $this->qiniu->errorStr;
    }
}
