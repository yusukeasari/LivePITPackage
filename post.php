<html>
<head></head>
	<?php require_once 'viewport.php'; ?>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/johoo_iphone.css" media="all">
<body>
	<div id="Johoo">
		<div id="Shadow"></div>
		<div id="SearchPanel">
		<div id="SearchPanelInnerContents">
			<input name="id" id="id" maxlength="6" class="deli" type="tel" placeholder="IDを検索(6ケタ)" /><br />
			<span id="idErrorMessage"></span><br />
			<!--<input type="radio" value="1" name="radio" id="motif1" checked="checked">
			<input type="radio" value="2" name="radio" id="motif2">
			<input type="radio" value="2" name="radio" id="motif3"><br />-->
			<input value="検索" id="searchSubmitButton" name="" type="button">
			</div>
			<br /><img id="loadImage"><br /><span id="snsButtons"><img src="img/snsLineIcon.png" id="snsLineButton"><img src="img/snsTwitterIcon.png" id="snsTwitterButton"><img src="img/snsFacebookIcon.png" id="snsFacebookButton"><img id="qrImage" width="80" height="80"></span>
		</div>
	</div>
</body>
<script type="text/javascript" src="lib/package.js"></script>
<script type="text/javascript" src="js/post.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-99823352-1', 'auto');
  ga('send', 'pageview');

</script>
</html>
