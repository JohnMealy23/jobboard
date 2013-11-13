
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>Busted Tees Job Board</title>
		<meta name="description" content="The front-end portion of Busted help-wanted.">
		<meta name="author" content="John Mealy">

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="/favicon.ico">
		
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet/less" type="text/css" href="css/styles.less" />
        
        <?php 
			if(substr( $_SERVER['HTTP_HOST'], 0, 4 ) == 'dev.') { ?>
				<script type="text/javascript" src="js/jquery-1.10.2.min.js" charset="utf-8"></script>
			<?php } else { ?>
				<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
			<? }
		?>
        <script src="js/modernizr-2.6.2.min.js"></script>
        <script> /* Provisory for dev environment: */ localStorage.clear(); </script>
        <script type="text/javascript">var less=less||{};less.env='development';</script>
        <script>less = {}; less.env = 'development';</script>
        <script src="js/less-1.5.0.min.js?ts=<?=time()?>" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
	</head>
	<body>
		<header>
			<h1>Busted Tees Job Board</h1>
			
			<nav>
				<div class="row">
					
					<div class="col-md-2 col-md-offset-2">
						<a href="/">Enter Job</a>
					</div>
					<div class="col-md-2">
						<a href="/contact">Job Index</a>
					</div>
					<div class="col-md-2">
						<a href="/contact">Job Posts</a>
					</div>
					<div class="col-md-2">
						<a href="/contact">Job Postings</a>
					</div>
				</div>
			</nav>
		</header>
		<div class="container">
		<? if($notification) { ?> 
			<div class='notification'><h3><? echo $notification; ?></h3></div>
		<? }; ?>