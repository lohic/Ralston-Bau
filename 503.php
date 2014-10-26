<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, maximum-scale=1.0">
	<title><?php bloginfo('name') ?> | <?php bloginfo('description') ?></title>
    
	<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.ico" />

	<script type="text/javascript" src="//use.typekit.net/tpv1jpp.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>

    <style>
	
		html,body{
			width:100%;
			height: 100%;
			font-size: 17px;
			margin: 0;
			font-family: "freight-big-pro",Georgia;
			font-variant-ligatures : normal;
			font-weight: 400;
			background: #F2F2F2;
			letter-spacing: 0.06em;
		}

		#update{
			width: 300px;
			background: #FFF;
			padding: 20px;
			height: 110px;
			position: absolute;
			top:50%;
			margin-top: -75px;
			left: 50%;
			margin-left: -170px;
		}

		h1{
			line-height:0.6em;
			margin: 0;
		}

		p{
			margin-top: 0.9em;
		}

		h1 img{
			width:300px;
			height: auto;
		}
	
    </style>
</head>

<body>

	<div id="update">
		<h1><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>"><br>is updating !</h1>
		<p>Come back soon</p>
	</div>

</body>
</html>