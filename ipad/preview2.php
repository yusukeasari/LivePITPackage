<?php
error_reporting(E_ALL);
ini_set( 'display_errors', 1 ); 
// 投稿登録
// カレントの言語を設定する
mb_language("uni");
// 内部文字エンコードを設定する
mb_internal_encoding("UTF-8");
mb_detect_order("ASCII,JIS,EUC-JP,SJIS,UTF-8");

require_once("HOMEDIR/public_html/pitadmin/current.php");
// 以下4ファイルは必ずrequireする。
require_once(BASE_URI."/common/common.php");
require_once(BASE_URI."/common/common_db.php");
require_once(BASE_URI."/lib/PPM/DB.php");
require_once(BASE_URI."/lib/PPM/ImagePost.php");
require_once(BASE_URI."/lib/PPM/Exec.php");
require_once(BASE_URI."/lib/PPM/Api.php");
require_once("XML/Serializer.php"); 
require_once("XML/Unserializer.php"); 

//$title = $_POST["name"];
//$comment = strtoupper(preg_replace("/\s|　/", "", trim($title)));

$imPost = new PPM_ImagePost; // PPM_ImagePostクラスを利用するためにnewする。
$ppmExec = new PPM_Exec;

// データベースに接続
$newDb = new DB;
$db = $newDb->conn();
$db->beginTransaction();

//echo "2"."<br />\n";
define("REALTIME_FLAG", 1);
if(REALTIME_FLAG){
define("STATUS", IMAGE_PUBLIC);

}else{

define("STATUS", UNCHECKED);

}


	$newId = $imPost->getNewId($db);
	$mid = sprintf("%05d", $newId);

	$fileName = "{$mid}.jpg";

	if(REALTIME_FLAG){
		$fp = @fopen(LOCK_FILE_PATH, "a+");
		if(flock($fp, LOCK_EX)){
			$nowDate = date("Y-m-d H:i:s");
			fputs($fp, "start {$nowDate} {$mid} => {$status}\n");
		}
	}
list($head, $image) = explode('base64,', $_POST['file']);
// print_r($_POST['file']);
$fname=md5($image); 
$fp = fopen("data/".$fname.".jpg", 'w');
//echo $fname;
fwrite($fp, base64_decode($image));
fclose($fp);

//echo "3"."<br />\n";

sleep(3);
	// @todo 画像をアップロードした場所からorigフォルダ、resizeフォルダへコピー
	$testPath = "HOMEDIR/public_html/ipad_demo/data/".$fname.".jpg";
	$toPath = ORIG_DIR_PATH."/{$fileName}";
	copy($testPath, $toPath);
	chmod($toPath, 0666);

	$toPath = RESIZE_DIR_PATH."/{$fileName}";
	$im = new Imagick();
	$im->readImage($testPath);
	$geo = $im->getImageGeometry(); //幅と高さを取得
	$sizeX = $geo['width'];
	$sizeY = $geo['height'];
	if($sizeX >= $sizeY){
		$lenX = 0;
		$lenY = IMG_HEIGHT;
	}
	else{
		$lenX = IMG_WIDTH;
		$lenY = 0;
	}
	$im->resizeImage($lenX, $lenY, Imagick::FILTER_LANCZOS, 1); // リサイズ
	$im->writeImage($toPath);
	$im->clear();
	$im->destroy();
	chmod($toPath, 0666);

	// 基本データ登録用に配列に入れる
	$arrPostData = array(
		"id" => $newId,
		"client_id" => CLIENT_ID,
		"mid" => $mid,
		"status" => STATUS,
		"mail_from" => $EMAIL,
		"title" => $title,
		"body" => $comment,
		"img_name" => "{$mid}.jpg",
	);

//echo "4"."<br />\n";
// DBに基本データを登録
// 基本的にtbl_dataテーブルは固定でカスタマイズしない。
// 登録できる内容は$arrPostDataにあるとおり。
// id, clientid, mid, statusは必須。
// 画像が存在しない場合は、img_nameを空白にしてstatusをNOIMAGEにする。
// statusの各値はcommon.phpのステータスを参照
$imPost->setTblData($db, $arrPostData); 


if(REALTIME_FLAG){
	$options = array(
		XML_UNSERIALIZER_OPTION_ATTRIBUTES_PARSE => 'parseAttributes'
	);

	$unserializer = new XML_Unserializer($options);
	// 登録
	$ppmExec->execPublicImage($db, $mid, $fileName, $unserializer);

	flock($fp, LOCK_UN); // ロックの破棄
	fclose($fp);
}else{
// Flash用XML作成
}
$ppmExec->createXmlData($db,0,$mid);

$db->commit();



$returnId = "0{$mid}";
echo $returnId;

