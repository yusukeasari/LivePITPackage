<?php

$jsonPath = 'pitcomdb.json';
$json = file($jsonPath);
$line=json_decode($json[0],true);

// shuffle($line);
// $json = json_encode($line);
// file_put_contents("pitcomdb_new.json",$json);


$FOUND=false;
$item="";

if(!empty($_GET['id'])){
	//ID検索
	foreach($line as $k=>$v){
		//if($v["id"] == $_GET['id']){
		if($v["id"] == $_GET['id'] && strlen($_GET['id'])==6){
			$data = "[{\"result\":\"FOUND\",\"type\":\"singleResult\",\"pitcomdb\":\"{$item}\"},{\"num\":\"".$v["num"]."\"}]";
			$FOUND = true;
			break;
		}
	}
	if(!$FOUND){
		$data = "[{\"result\":\"NOTFOUND\",\"type\":\"singleResult\",\"pitcomdb\":\"{$item}\"}]";
	}
	echo $data;
}else if(!empty($_GET['random'])){
	$rand_keys = array_rand($line);
	if(count($line) != 0){
		echo "[";
		echo "{\"result\":\"".$line[$rand_keys]["num"]."\"}";
		echo "]";
	}else{
			echo "[";
			echo "{\"result\":\"NOTFOUND\"}";
			echo "]";
	}

}else if(!empty($_GET['b1b2'])){
	//ニックネーム&メッセージ検索
	$searchStr = $_GET['b1b2'];
	$search_b1b2 = preg_quote($searchStr);
	$resultJson = searchJson($line,$searchStr,"b1b2");
	echo $resultJson;

}else if(!empty($_GET['b3'])){
	//曲名検索
	$searchStr = $_GET['b3'];
	$resultJson = searchJson($line,$searchStr,"b3");
	echo $resultJson;
}

function searchJson($json,$search,$item){
	$max = 300;
	$cnt = 0;
	$cnt2 = 0;
	$FOUND=false;
	$data = "[{\"result\":\"FOUND\",\"type\":\"multiResult\",\"pitcomdb\":\"{$item}\",\"searchStr\":\"{$search}\"},";
	
	if($item == "b1b2"){
		$search = preg_quote($search);
	}else{
		$search = str_replace(array(" ","　"), '', $search);
	}
	$search = preg_quote($search);
	$pattern = "{".$search."}";
	// $search_2=0;

	// ニックネーム(b1)検索のみ@girlscout案件
	foreach($json as $k=>$v){
		if($item == "b1b2"){
			$subject_b1 = $v['b1'];
			// $subject_b2 = $v['b2'];
			$search_1 = preg_match($pattern,$subject_b1);
			// $search_2 = preg_match($pattern,$subject_b2);
		}else{
			$subject = str_replace(array(" ","　"), '', $v[$item]);
			$search_1 = ($search == $subject);

		}
		// if(($search_1 == 1 || $search_2 == 1 ) && $search != "" && $v['flg']=="1"){
		if(($search_1 == 1 ) && $search != "" && $v['flg']=="1"){
			$cnt++;

			if($cnt <= $max){
				$cnt2++;
				$FOUND = true;
				$data .= "{\"num\":\"".$v["num"]."\"},";
			}else{
			}
		}
	}
	$data .= "{\"num\":\"\",\"count\":\"{$cnt}\",\"count2\":\"{$cnt2}\"}]";
	if(!$FOUND){
		$data = "[{\"result\":\"NOTFOUND\",\"type\":\"multiResult\",\"pitcomdb\":\"{$item}\",\"searchStr\":\"{$search}\"}]";
	}
	return $data;
}