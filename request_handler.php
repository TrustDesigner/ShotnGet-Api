<?php

/*
 * request_handler.php
 * 
 */

class MyRequestManager extends CRequestManager {
  public function __construct() {
  }
  
  public function onInitRequest($initCmd, $requestParameters, &$request) {
    $file = new CFile(CFile::TYPE_WEBACCOUNT);
    $param = new CParam(CParam::TYPE_ID_UID);

    $opt = CParam::OPT_NEEDED.CParam::OPT_WRITABLE.CParam::OPT_UNIQUE;
    $param->addOpt($opt);

    $file->addParam($param);

    $param = new CParam(CParam::TYPE_PWD);
    $param->addOpt($opt);
    $file->addParam($param);

    $param = new CParam(CParam::TYPE_ID_MAIL);
    $param->addOpt($opt);
    $file->addParam($param);

    $cmd = new CCmdAuth(CCmdAuth::TYPEPWD_ALPHANUMERIC, 12, $file);
    $cmd->setLabel('WebAccount');
    $request->addCmd($cmd);
  }

  public function onResponseReceived($response, $requestParameters, &$request) {
    $cmdResp = new CCmdResp();
    $cmdResp->setResult(CErrors::RESULT_NO_ERROR);
    $request->addCmd($cmdResp);
  }
}