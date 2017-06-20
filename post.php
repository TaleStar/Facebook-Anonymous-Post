<?php
error_reporting(0);
include("./vendor/autoload.php");//Include Facebook Graph API
#Infromation BEGIN
$appId="{AppID}";
$appSecret="{AppSecret}";
$pageToken="{AccessToken}";
#Infromation END

#Create Graph API Begin
$fb = new Facebook\Facebook([
  'app_id' => $appId,
  'app_secret' => $appSecret,
  'default_graph_version' => 'v2.9',
]);
#Create Graph API End

#Upload Image Begin
if ($_FILES["img"]["name"]==""){
	//No Image Upload
	$data = [
		'message' => $_POST["content"],
	];//Just Text Message
}else{
	if ($_FILES["img"]["type"]=="image/png" || $_FILES["img"]["type"]=="image/jpeg"){
		$target_path = "uploads/";//Target directory to upload
		$target_path .= date("YmdHis").".jpg";//Name of the target image
		if(move_uploaded_file($_FILES['img']['tmp_name'],iconv("UTF-8", "big5//TRANSLIT//IGNORE", $target_path ))) {
			//upload success
			$data = [
				'message' => $_POST["content"],
				'source' => $fb->fileToUpload($target_path),
			];//Image with Text Message
		} else{
			//can't upload
			header("Location ./index.php?err=ul");
			exit;
		}
	}else{
		//File isn't a image
		header("Location: ./index.php?err=ftp");
		exit;
	}
}
#Upload Image End



#Call Graph to POST Begin
if ($_FILES["img"]["name"]==""){
	try {
		$response = $fb->post('/me/feed', $data, $pageToken);
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		header("Location: ./index.php?err=gerr&detail=".$e->getMessage());
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		header("Location: ./index.php?err=serr&detail=".$e->getMessage());
		exit;
	}
}else{
	try {
		$response = $fb->post('/me/photos', $data, $pageToken);
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		header("Location: ./index.php?err=gerr&detail=".$e->getMessage());
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		header("Location: ./index.php?err=serr&detail=".$e->getMessage());
		exit;
	}
}
$graphNode = $response->getGraphNode();
#Call Graph to POST End

#Finish!
header("Location: ./index.php?success=yes&detail=".$graphNode['id']);
