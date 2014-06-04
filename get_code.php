<?php

/*
 * get_code.php
 * 
 * create temp file that contains the users data
 * call the Shotnget API for generate the QRCode
 * 
 */

$apiPath = './shotngetapi/';
require ($apiPath.'shotnget_api.php');
$apiParameters = new ApiParameters($apiPath);
$apiManager = new ApiManager($apiParameters);
$responseUrl = Config::$RESPONSE_URL;
$requestParameters = $apiManager->generateNewRequest($responseUrl);
if ($requestParameters != null) {
  $imgPath = $requestParameters->getImgPath();
  $listeningFunction = $requestParameters->getListeningFunction();
  echo '<img id="shotnget_code" src="' . $imgPath . '" onload="' .
      $listeningFunction . '" /><br />';
}
else {
  echo $apiManager->getErrors();
}

?>
