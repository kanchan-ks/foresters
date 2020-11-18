<!DOCTYPE html>
<?php
$idiom = get_session('language');
$method = $this->router->fetch_method();
$module = $this->router->fetch_class();
?>
<html lang="<?=$idiom?>" <?php  if($this->session->userdata('ULG') == null) {?> id="extr-page"<?php }?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="<?=AUTHOR?>">
    <meta name="robots" content="noindex,nofollow">
	<link rel="apple-touch-icon" href="<?=base_url('../assets/images/brand/favicon.png')?>" />

	<meta name="msapplication-TileColor" content="#ffffff" />
	<meta name="theme-color" content="#ffffff" />
    <title><?=$page_title?></title>
    <?php echo $html_head; ?>
    <!--[if IE]>
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/all-ie-only.css')?>" />
    <![endif]-->

	<link rel="shortcut icon" href="<?=base_url('/assets/images/brand/favicon.png')?>" />

    <!-- HTML5 elements and media queries Support for IE8 : HTML5 shim and Respond.js -->
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
  <![endif]-->
    <script>
        var base_url = "<?=base_url()?>";
		var current_url = "<?=base_url()?>";
    </script>
</head>
<body class="app <?=$module.'_'.$method?>" id="<?=$module.'_'.$method?>">
<div class="body">
	<?php $data = array(); 
			$this->load->view('common/header', $data);?>
    <?php echo $content; ?>
    <?php //$this->load->view('common/footer');?>
    <?php echo $js_foot ?>
</div>    
</body>
</html>
