<html lang="ja">
    <head>
        <meta charset="UTF-8" />
        <title>iPad投稿</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
        <meta name="format-detection" content="telephone=no">
        <meta name="author" content="" />
        <!--link rel="shortcut icon" href="" /-->
        <!--link rel="apple-touch-icon-precomposed" sizes="144x144" href="" /-->
        <link rel="stylesheet" href="css/main2.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/print.css" type="text/css" media="print" />
        <script src="jquery-1.8.2.min.js"></script>
        <script>
        window.onload = function(){
            javascript:cont_loadImage('/pitadmin/image/orig/<?php echo substr($_GET["id"],1,5); ?>.jpg');
        }
        window.onbeforeprint = function(){
          //alert("window.onbeforeprint");
        }
        function cont_loadImage( imageSrc ){
            var img = $( new Image() );
            img.bind('load', function(){
                $("#cont_image img").css("width","100%");
                $('#cont_image').html('').append(this);
            } );
            img.attr('src',imageSrc);
        }
        </script>
    </head>
    <body>
        <div class="print" id="cont_image"></div>
        <div class="web" style="position:absolute; left:0; top:0"><img src="img/comp_title.png" width="100%"></div>
        <div class="web" style="position:absolute; left:0; top:140; color:#ffffff; font-size:50px; line-height: 36px;">
        投稿IDは<span style="color:#ff8000"><a href="http://live.pitcom.jp/post.php#indi/<?php echo $_GET["id"]; ?>/">No.<?php echo $_GET["id"]; ?></a></span>です。<br />
        <br />
        </div>
        
        <div class="web" style="position:absolute; width:100%; bottom:150; text-align:center">
        <br />
        <a href="index.php" onclick="document.images['btn'].src='img/comp_button_on.png';"><img name="btn" src="img/comp_button_off.png" width="400px"></a>
        </div>
    </body>
</html>


