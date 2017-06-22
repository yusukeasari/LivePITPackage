<?php

if(!empty($_GET['f'])){
	$collageBaseImage = "collage/base{$_GET['f']}.png";
}else{
	$collageBaseImage = "collage/base".rand (1,3).".png";
}

$requestImageDir = 'swfData/blockimg/';
$resultDir = 'collage/result/';

if(!file_exists($collageBaseImage)) error_log("{$_SERVER['PHP_SELF']} ERROR:base image not found.");



if(!empty($_GET['id'])){
	$id = substr($_GET['id'], 1, 5);
	if(file_exists("{$requestImageDir}{$id}.jpg")){
		$newImage		= new Imagick();
		$newImage->newImage(290,348,new ImagickPixel('transparent'));
		$newImage->setImageFormat('png');

		$baseSrc		= new Imagick($collageBaseImage);
		$idImageSrc		= new Imagick("{$requestImageDir}{$id}.jpg");

		$newImage->compositeImage($idImageSrc,$idImageSrc->getImageCompose(),17,27);
		$newImage->compositeImage($baseSrc,$baseSrc->getImageCompose(),0,0);
		$newImage->writeImage("{$resultDir}{$id}.png");

		print "{\"isOk\":true}";
	}else{
		error_log("{$_SERVER['PHP_SELF']} ERROR:id or image not found.");
	}
}
