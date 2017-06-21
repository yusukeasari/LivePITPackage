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
        <script src="jquery-1.8.2.min.js"></script>
        <script src="megapix-image.js?c"></script>
        <script>
        function changeToConfirm(){
            document.getElementById("input").style.visibility = 'hidden';
            document.getElementById("conf").style.visibility = 'visible';
//            $('#input').hide();
//            $('#conf').show();
        }


        var imgFile;
        var image = new Image();
        var reader = new FileReader();
        var file;

        var maxHeight;
        var maxWidth;
        isiPhone=false;

        window.addEventListener("load", function(){
            $('#nowSending').hide();
            //iPhone
            var fileInput = document.getElementById('imageFile');
            fileInput.onchange = function() {            
                $('#imageFile').hide();
                document.getElementById('nowSending').style.visibility = 'visible';
                var file = fileInput.files[0];
                var mpImg = new MegaPixImage(file);

                var canvas = document.getElementById('resultImage');
                canvas.onload = function(){
                    imgFile=canvas.src;
                    $('#input').hide();
                    //$('#conf').show();
                    document.getElementById('conf').style.visibility = 'visible';
//                    fileUpload();
                }

                mpImg.render(document.getElementById('resultImage'), { maxWidth: 1200, maxHeight: 1200, orientation: 6 });
            }
        }, true);
        
        function fileUpload(){
            var fd = new FormData();
            fd.append("file", imgFile);
            $('#submitBtn').hide();
            $('#reTake').hide();
            
            $.ajax({
                url: "preview2.php",
                type: "POST",
                data: fd,
                processData: false,	// dataをそのまま送信させる
                contentType: false,
                success: function(ret){
                    if(ret.length == 6){
                        $('#imageFile').show();
                        $('#nowSending').hide();
                        location.href = 'comp2.php?id=' + ret;
                    }else{
                        alert("送信に失敗しました。\nもう一度撮影してください。(1)")+ret;
                        location.reload();
                    }
                },
                error:function(XHR,textStatus,errorThrown){
                    $('#submitBtn').show();
                    $('#reTake').show();
                    alert("送信に失敗しました。\nもう一度撮影してください。(2):"+textStatus);
                    location.reload();
                }
            });
        }
        
        function Sleep( T ){ 
           var d1 = new Date().getTime(); 
           var d2 = new Date().getTime(); 
           while( d2 < d1+1000*T ){    //T秒待つ 
               d2=new Date().getTime(); 
           } 
           return; 
        }
        
        $().ready(function(){
            $('#shot').click(function(){
                $('input[name=photo]').trigger('click');
            });
        });
        </script>
    </head>
    <body>
        <div id="input">
            <div style="position:absolute; top:100; width:100%; text-align:center"><img src="img/photo_text2.png" width="400px"></div>
            <form>
                <div style="position:absolute; top:500; width:100%; text-align:center; color:#ffffff">
                    <a href="javascript:void(0);"><img id="shot" src="img/photo_button_off.png" width="200px"></a><br />
                    <input name="photo" type="file" accept="image/*" id="imageFile" style="visibility:hidden; height: 0;" /><br />
                </div>
                <div id="nowSending" style="position:absolute; top:500; width:100%; text-align:center; color:#ffffff; line-height: 1.5; color:#ffffff; visibility:hidden"><img src="loadinfo.net.gif" align="baseline" /> 送信中です</div>
            </form>
            <canvas id="canvas" width="1" height="1"></canvas>
        </div>
        <div id="conf" style="visibility:hidden">
            <div style="position:absolute; top:30; width:100%; text-align:center"><img id="resultImage" /></div>
            <div style="position:absolute; top:400; width:100%; text-align:center"><img src="img/photoconf_text.png" width="500px"></div>
            <div style="position:absolute; width:100%; top:500; text-align:center">
                <table style=" margin-left: auto; margin-right: auto;">
                <tr>
                <td>
                <a href="javascript:void(0);" onClick="document.images['btn'].src='img/photoconf_next_on.png';fileUpload();" id="submitBtn"><img name="btn" src="img/photoconf_next_off.png" width="200px"></a>
                </td>
                <td>　　</td>
                <td>
                <a href="index.php" onClick="document.images['btn'].src='img/photoconf_back_on.png';"><img name="btn" src="img/photoconf_back_off.png" width="200px" id="reTake"></a>
                </td>
                </tr>
                </table>
            </div>
        </div>
    </body>
</html>


