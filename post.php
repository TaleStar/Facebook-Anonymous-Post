<?php
error_reporting(0);
include("./vendor/autoload.php");//Include Facebook Graph API
#Infromation BEGIN
$appId="983061351796761";
$appSecret="99dd0f51bacab580bd28d6d7106aff61";
$pageToken="EAANZBFs6qkBkBAIRCxW7igS6wG1gQHG8jpz8TICSNl2b4KNxkJYZAg23Ib5lZB990PB8sL7ixcJZB9sAdZBGvrYruyQQP0q6i5CtcjYtoZCGbgZA9ZC8xNbvdwp2O1nqKZBfSoZBGIA7U5vMiuKIMrSugrYzw4BszdWC3sSXZBvLP1BEwZDZD";
#Infromation END

#Create Graph API Begin
$fb = new Facebook\Facebook([
  'app_id' => $appId,
  'app_secret' => $appSecret,
  'default_graph_version' => 'v2.9',
]);
#Create Graph API End

#Upload Image Begin
if ($_FILES["file"]["name"]==""){
	//No Image Upload
	$data = [
		'message' => $_POST["content"],
	];//Just Text Message
}else{
	if ($_FILES["file"]["type"]=="image/png" || $_FILES["file"]["type"]=="image/jpeg"){
		$target_path = "uploads/";//Target directory to upload
		$target_path .= date("YmdHis").".jpg"/*$_FILES['file']['name']*/;//Name of the target image
		if(move_uploaded_file($_FILES['file']['tmp_name'],iconv("UTF-8", "big5//TRANSLIT//IGNORE", $target_path ))) {
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
if ($_FILES["file"]["name"]==""){
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