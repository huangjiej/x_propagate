<?php
/**
 * Created by PhpStorm.
 * User: xiongxin
 * Date: 2016/4/11
 * Time: 14:19
 */

class ArticleController extends Core\Wechat  {


    /**
     * 上传图片素材接口
     */
    function uploadImageAction() {

        $file = $this->request_data['body'];

        if(empty($file) || !isset($file['tmp_name']) || !isset($file['name'])){
            $this->sendError('图片为空！');
        }


        $this->sendOutPut($this->_upload_image_media($file));
    }

    /**
     * 上传图片素材
     * @param $file
     * @return array
     */
    private function _upload_image_media($file){
        $md5 =  md5_file($file['tmp_name']);
        $item = M('t_picture')->get('*',['md5'=>$md5]);

        if(!empty($item)){
            return ['media_id'=>$item['path'],'url'=>$item['url']];
        }

        $result = $this->wechat->uploadForeverMedia(
            [
                'media'=>new CURLFile(
                    $file['tmp_name'],
                    'image/png',
                    $md5.'.'.pathinfo($file['name'], PATHINFO_EXTENSION)
                )
            ],
            'image'
        );//将封面上传至微信服务器

        if(is_array($result) && isset($result['media_id'])){
            M('t_picture')->insert(['path'=>$result['media_id'],'url'=>$result['url'],'md5'=>$md5,'status'=>1,'create_time'=>time()]);
        }

        return $result;
    }

    /**
     * 上传图片至微信
     * @param $file
     * @return array
     */
    private function _upload_image($file){
        return$this->wechat->uploadImg(
            [
                'media'=>new CURLFile(
                    $file['tmp_name'],
                    'image/png',
                    md5_file($file['tmp_name']).'.'.pathinfo($file['name'], PATHINFO_EXTENSION)
                )
            ]
        );//将图片上传至微信服务器
    }

    /**
     * 异步更新文章
     */
    public function asyncAction(){

        if(empty($this->request_data['body']['id'])){
            $this->sendError('参错错误，文章ID不能为空！');
        }

        $this->sendSuccess('收到请求！');

        $task_data = array(
            'wechat',
            'article',
            'syncOne',
            array('request_data'=>$this->request_data)
        );
        //发送异步任务
        HttpServer::$http->task($task_data);
    }

    public function syncListAction(){

        $offset = 0;
        $count = 20;
        $resp = $this->wechat->getForeverList('news',$offset,$count);

        $document_model = M('t_document');
        $article_model = M('t_document_article');
        SeasLog::debug('开始同步微信图文素材!');

        $config = $this->config->qiniu;
        $config = array_merge($config->toArray(),$config->picture->toArray());
        $qiniu = new Upload\Driver\Qiniu($config);

        while(isset($resp['item']) && $resp['item']){

            foreach($resp['item'] as $item){
                foreach($item['content']['news_item'] as $one){
                    $id = $document_model->get('id',['AND'=>['media_id'=>$item['media_id'],'wx_url'=>$one['url']]]);

                    if(!$qiniu->save($one['thumb_url'])){
                        SeasLog::error('图片保存至7牛云失败！');
                    }

                    if(empty($id)){

                        $did = $document_model->insert([
                            'title'=>$one['title'],
                            'category_id'=>49,//新添加的分类归属为59
                            'description'=>$one['digest'],
                            'model_id'=>2,//
                            'link_id'=>$one['content_source_url'],
                            'cover_id'=>$one['thumb_url'],
                            'create_time'=>$item['content']['create_time'],
                            'update_time'=>$item['content']['update_time'],
                            'status'=>1,
                            'media_id'=>$item['media_id'],
                            'wx_url'=>$one['url'],
                            'show_cover_pic'=>$one['show_cover_pic'],
                        ]);
                        $fa = $article_model->insert([
                            'id'=>$did,
                            'content'=>$one['content'],
                            'author'=>$one['author'],
                        ],true);

                        SeasLog::debug('插入一篇新图文素材，DID：'.$did.' FA：'.$fa);
                    }else{
                        $fd = $document_model->update([
                            'title'=>$one['title'],
                            'description'=>$one['digest'],
                            'link_id'=>$one['content_source_url'],
                            'cover_id'=>$one['thumb_url'],
                            'create_time'=>$item['content']['create_time'],
                            'update_time'=>$item['content']['update_time'],
                            'show_cover_pic'=>$one['show_cover_pic'],
                        ],['id'=>$id]);
                        $fa = $article_model->update([
                            'content'=>$one['content'],
                            'author'=>$one['author'],
                        ],['id'=>$id]);

                        SeasLog::debug('更新一篇新图文素材，ID：'.$id.'，更新结果：FD:'.$fd.',FA:'.$fa);
                    }
                }
            }
            $offset += 20;
            $count += 20;
            $resp = $this->wechat->getForeverList('news',$offset,$count);
        }
        SeasLog::debug('同步微信图文素材结束!');

    }

    /**
     * 同步图文素材接口
     * @return mixed
     */
    function syncOneAction() {
        $this->request_data = $this->getRequest()->getParam('request_data');

        $article_id = $this->request_data['body']['id'];

        $item = M('t_document(a)')->get(
            [
                '[>]t_document_article(b)'=>['a.id'=>'id'],
            ],
            [
                'a.title',
                'a.cover_id',
                'b.content',
                'a.description',
                'a.media_id',
                'a.show_cover_pic',
                'a.link_id',
                'b.author'
            ],
            [
                'AND'=>[
                    'a.id' => $article_id
                ]
            ]);
        SeasLog::debug("开始添加到微信");
        SeasLog::debug(M()->last_query());
        $file_part  = pathinfo($item['cover_id']);
        $extendname = $file_part["extension"];
        $filename = '/tmp/tmp.' . $extendname;
        $fc = curlRequest(imageView2($item['cover_id'])); //读取七牛图片内容
        file_put_contents($filename, $fc); //写入到临时图片文件
        //上传封面
        $result = $this->_upload_image_media(['tmp_name'=>$filename,'name'=>'tmp.'.$extendname]);

        if(is_array($result) && isset($result['media_id'])){
            $pattern= '/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/';
            preg_match_all($pattern,$item['content'],$match);

            //处理内容里面的图片，将图片上传至微信素材
            if(isset($match[1])){
                $new_src = [];
                foreach($match[1] as $key=>$src){
                    $ext = pathinfo($src, PATHINFO_EXTENSION);
                    file_put_contents('/tmp/tmp.'.$ext,curlRequest($src));
                    $resp = $this->_upload_image(['tmp_name'=>'/tmp/tmp.'.$ext,'name'=>'tmp.'.$ext]);
                    if(isset($resp['url'])){
                        $new_src[] = $resp['url'];
                    }else{
                        $new_src[] = $src;
                    }
                }
                $item['content'] = str_replace($match[1],$new_src,$item['content']);
            }

            $data = [
                'title'=> $item['title'],
                'thumb_media_id' => $result['media_id'],
                'digest' => $item['description'],
                'show_cover_pic' => $item['show_cover_pic'],
                'content' => $item['content'],
                'author' => $item['author'],
                'content_source_url' => $item['link_id']
            ];

            if(empty($item['media_id'])){
                //添加素材
                $result = $this->wechat->uploadForeverArticles(['articles'=>[$data]]);
                if (is_array($result) && isset($result['media_id'])) {
                    $material = $this->wechat->getForeverMedia($result['media_id']);

                    M('t_document')->update(['media_id'=>$result['media_id'],'wx_url'=>isset($material['news_item'][0]['url']) ? $material['news_item'][0]['url'] : ''],
                        ['id'=>$article_id]); //更新数据库
                }
            }else{
                //更新素材
                $this->wechat->updateForeverArticles($item['media_id'], ['articles'=>$data]);
            }
        }
    }

    /**
     * 删除素材接口
     */
    function deleteAction() {
        $this->request_data = $this->getRequest()->getParam('request_data');

        $media_id = $this->request_data['body']['media_id'];
        if (empty($media_id)) {
            SeasLog::error('参数错误，media_id为空！');
            return false;
        }
        $this->wechat->delForeverMedia($media_id);
    }

    /**
     * ?
     */
    function materialAction() {
        $media_id = $this->request_data['body']['media_id'];
        if (empty($media_id)) {
            $this->sendError('该素材不存在');
        }

        $material = $this->wechat->getForeverMedia($media_id);

        if ($material) {
            $this->sendOutPut($material);
        } else {
            $this->sendError('获取失败');
        }
    }
}
