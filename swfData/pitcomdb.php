<?php
// jsonデータ取得

require_once("/home/pituser/public_html/pitadmin/current.php");
require_once(BASE_URI."/common/common.php");
require_once(BASE_URI."/common/common_db.php");
require_once(BASE_URI."/lib/PPM/DB.php");
require_once(BASE_URI."/lib/PPM/Exec.php");
require_once(BASE_URI."/lib/PPM/Api.php");

$ppmExec = new PPM_Exec;

// データベースに接続
$newDb = new DB;
$db = $newDb->conn();
$db->beginTransaction();

$getMid = $_GET["id"];
$entMid = substr($getMid, -5);
$directFlag = 1;

$getNum = (int) $_GET["num"];
$livepitFlag = 1; // livepitの時は1
$scFlag = 2; // 取得するjsonデータの昇降順(データ更新順) 1:昇順(古いものから)、2：降順(最新から)

$strJsonData = $ppmExec->createXmlData($db, $livepitFlag, $entMid, $directFlag, $getNum, $scFlag);

echo $strJsonData;
