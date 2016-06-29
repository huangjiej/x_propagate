<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title><?= isset($meta_title) ? $meta_title.' - ' : ''?>猫儿文章</title>
    <link rel="stylesheet" href="/style/reset.css">
    <link rel="stylesheet" href="/style/main.css">
    <link rel="stylesheet" href="/style/weui.css">
    <block name="style"></block>
</head>

<body ontouchstart>

<block name="header">
    <?php if(isset($title)):?>
        <header class="header">
            <a href="<?=(isset($back_url) ? $back_url : 'javascript:back();')?>" class="back"><i class="ico i-back"></i></a>
            <div class="txt"><?=$title?></div>
        </header>
    <?php endif;?>
</block>

<?php echo $content?>

<block name="script">
</block>
</body>
</html>
