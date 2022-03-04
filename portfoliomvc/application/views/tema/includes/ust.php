<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$ayarlar->title?></title>
    <meta name="description" content="<?=$ayarlar->seo_description?>">
    <meta name="keywords" content="<?=$ayarlar->seo_keyword?>">
    <meta name="twitter:url" content="<?=$ayarlar->link?>">
    <meta name="twitter:title" content="<?=$ayarlar->title?>">
    <meta name="twitter:description" content="<?=$ayarlar->seo_description?>">
    <meta name="twitter:image" content="<?=base_url("upload/settings/$ayarlar->logo");?>">
    <meta property="og:url" content="<?=$ayarlar->link?>">
    <meta property="og:title" content="<?=$ayarlar->title?>">
    <meta property="og:image" content="<?=base_url("upload/settings/$ayarlar->logo");?>">
    <meta property="og:description" content="<?=$ayarlar->seo_description?>">
    <meta property="og:site_name" content="<?=$ayarlar->title?>">
    <meta itemprop="name" content="<?=$ayarlar->title?>">
    <meta itemprop="description" content="<?=$ayarlar->seo_description?>">
    <meta itemprop="image" content="<?=base_url("upload/settings/$ayarlar->logo");?>">
    <link rel="shortcut icon" href="<?=base_url("/favicon.ico")?>" type="image/x-icon">
    <meta name="copyright" content="<?=$ayarlar->copyright?>" />
    <meta name="author" content="#">
    <meta name="distribution" content="Global" />
    <meta name="robots" content="index, follow" />
    <base href="<?=$ayarlar->link?>">
    <!-- Stylesheets -->
	<link rel="stylesheet" href="<?=base_url("assets/tema/css/bootstrap.min.css")?>">
	<link rel="stylesheet" href="<?=base_url("assets/tema/css/plugin.min.css")?>">
	<link rel="stylesheet" href="<?=base_url("assets/tema/css/style.cs")?>s">
	<link rel="stylesheet" href="<?=base_url("assets/tema/css/owl.carousel.min.css")?>s">
	<link rel="stylesheet" href="<?=base_url("assets/tema/css/owl.theme.default.min.css")?>s">
	<link rel="stylesheet" href="<?=base_url("assets/tema/css/owl.theme.green.min.css")?>s">
</head>
