<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>报名表-<?=$item['title']?></title>
    <link href="/style/weui.css" rel="stylesheet" type="text/css" />
    <style>
        .hd {background-color: #E3AA1F;color: #ffffff}
        .hd .subheading {text-align: center;}
        .weui_article {margin-bottom: 1.5em;background-color: #ffffff}
        .weui_article:last-of-type {margin-bottom: 0;}
    </style>
</head>
<body>
<div class="container" id="container">
    <div class="article" style="background-color: #F5F5F5;">
        <div class="hd">
            <h1 class="page_title"><?=$item['title']?></h1>
            <p class="subheading"><?=$item['subheading']?></p>
        </div>
        <div class="bd">
            <article class="weui_article">
                <section>
                    <img style="display:inline-block;height: 14em;width: 100%;" src="<?=imageView2($item['pic_url'])?>" alt="">
                    <div style="padding:10px;"><p><?=$item['description']?></p></div>
                </section>
            </article>
            <article class="weui_article">
                <section>
                    <h2 class="title">会议流程</h2>
                    <section>
                        <p><?=$item['process']?></p>
                    </section>
                </section>
            </article>

            <article class="weui_article">
                <section>
                    <h2 class="title">会议流程</h2>
                    <section>
                        <p>
                            会议时间：<?=$item['agenda_date']?>
                        </p>
                        <p >
                            会议地点：<?=$item['address']?>
                        </p>
                    </section>
                </section>
            </article>

          <article class="weui_article" >
                <section>
                    <h2 class="title">欢迎报名</h2>
                    <section>
                        <p>
                            会议结束有神秘礼物相送哦!
                        </p>
                    </section>
                    <section>
                            <a href="<?= U('sign?meeting_id='.$item['id']) ?>" style="background-color: #EBBD45;margin-top: 2em;font-size: 20px;font-weight: bold;"  class="weui_btn weui_btn_primary">立即报名</a>
                    </section>
                </section>
            </article>
        </div>
    </div></div>
</body>
</html>
