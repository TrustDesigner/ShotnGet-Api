<?php

/*
 * account.php
 */

require_once('shotngetapi/shotnget_api.php');

$rand = $_GET['_rand'];
$apiPath = './shotngetapi/';

$apiParameters = new ApiParameters($apiPath);
$response = new CResponse($apiParameters, $rand);

if($response->parse()){ //parse the shotnget response
  $authCmd = $response->getCmdByValue(CCmd::CMD_AUTH);
  
  //get the file (contains identification info).
  $file = $authCmd->getFile();
  
  //get the username returned by certphone
  $username = $file->getParamByType(CParam::TYPE_ID_UID)->getValue();
  $password = $file->getParamByType(CParam::TYPE_PWD)->getValue();

  echo 'Login with : '.$username.'<br />';

} else {
  echo 'Failed to parse Shotnget response: '.$response->getError().'<br />';
}

?>
