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
</html>
