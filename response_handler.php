<?php

/*
 * response_handler.php
 */

$apiPath = './shotngetapi/';

require($apiPath.'shotnget_api.php');

require('./request_handler.php');

$apiParameters = new ApiParameters($apiPath);

$myHandler = new MyRequestManager();

echo CRequest::handleResponse($apiParameters, $myHandler);

?>