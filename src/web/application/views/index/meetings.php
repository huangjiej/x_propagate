<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>会议列表</title>
    <link href="/style/weui.css" rel="stylesheet" type="text/css" />
    <style>
        .hd {background-color: #E3AA1F;color: #ffffff}
        .hd .subheading {text-align: center;}
        .weui_article {margin-top: 1.5em;background-color: #ffffff}
        .weui_article .title {font-size: 1.2em;font-weight: bold;}
        .weui_article .content img {width: 100%;height: 14em;}
        .weui_article .content p {margin-top: 0.5em}
        .weui_article .content .weui_cells_access {margin-top: .5em;}
        .weui_article .content .weui_cell {border-top: 1px solid #F5F5F5;}
    </style>
</head>
<body>
<div class="container" id="container">
    <div class="article" style="background-color: #F5F5F5;">
        <div class="hd">
            <h1 class="page_title">会议列表</h1>
        </div>
        <div class="bd">
            <?php foreach ($list as $item) { ?>
                <article class="weui_article">
                <section>
                    <h2 class="title"><?= $item['title'] ?></h2>
                    <section class="content">
                        <img src="<?= imageView2($item['pic_url']) ?>" alt="">
                        <p class="desc"><?= $item['description'] ?></p>
                        <div class="weui_cells_access">
                            <a class="weui_cell" href="<?= U('public/enroll?meeting_id=' . $item['id']) ?>">
                                <div class="weui_cell_bd weui_cell_primary">
                                    <p>查看详情</p>
                                </div>
                                <div class="weui_cell_ft">
                                </div>
                            </a>
                        </div>
                    </section>
                </section>
               </article>
                 <?php } ?>
        </div>
    </div></div>
</body>
</html>