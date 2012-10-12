{config_load file='index.conf' section="{$menu}"}
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PHP London - {#title#} - The UK's number one PHP User group</title>
	<meta name="google-site-verification" content="zvPGcBQCeX7sZRJqccKJ1oPWdPx7mtQDs2lJywSngoU" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
	{literal}
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
	{/literal}
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="./favicon.ico">
  </head>

  <body>
	 <div id="fb-root"></div>
	<script>
	{literal}
	(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	{/literal}
	</script>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="./">{#name#}</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li 
				{if $menu eq 'home'}
					class="active"
				{/if}
			  ><a href="./">Home</a></li>
              <li
				{if $menu eq 'about'}
					class="active"
				{/if}
			  ><a href="./about">About</a></li>
              <li
			  	{if $menu eq 'contact'}
					class="active"
				{/if}
			  ><a href="./contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>