<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title><?= isset($meta_title) ? $meta_title.' - ' : ''?>土筑虎</title>
    <link rel="stylesheet" href="/css/main.css">
    <style>
        input:disabled{
            border: 1px solid #DDD;
            background-color: #eb6b00;
            color:#ACA899;
        }
    </style>
</head>

<body ontouchstart>
<!--main-->
<section class="main">
    <div style="font-size: 18px;text-align: center;background-color: #1257F9">文章列表</div>

    <div class="class-list">
        <ul>
            <?php if(isset($list)){ foreach($list as $item){ ?>
                <li>

                    <div class="lesson-pic table clear">
                        <div class="message cell">
                            <a href="<?=U('show',['articleid'=>$item['id']])?>"><p class="nickname"><?=$item['title']?></p></a>
                        </div>
                    </div>
                    <div class="class-list-tit clear"></div>
                </li>
            <?php }}else{?>
                <div style="text-align: center;margin-top: 0.3rem;font-size: 16px">暂无消息！</div>';
            <?php }?>


        </ul>
    </div>

</section>

<!--脚本加载-->
<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/swiper.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript">

    $(function() {
        var swiper = new Swiper('.ban2', {
            pagination: '.swiper-pagination',
            paginationClickable: true,
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',
            spaceBetween: 30,
            loop: true
        });

    })
</script>
</body>
</html>