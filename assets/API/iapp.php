<?php
	/**
	 * 轻应用授权
	 *
	 */


	/**
	 * 包含SDK
	 */
	require("classes/yb-globals.inc.php");

	//配置文件
	require_once 'config.php';

	//初始化
	$api = YBOpenApi::getInstance()->init($config['AppID'], $config['AppSecret'], $config['CallBack']);
	$iapp  = $api->getIApp();

	try {
	   //轻应用获取access_token，未授权则跳转至授权页面
	   $info = $iapp->perform();
	} catch (YBException $ex) {
	   echo $ex->getMessage();
	}


	$token = $info['visit_oauth']['access_token'];//轻应用获取的token
	$api->bind($token);
	var_dump($api->request('user/me'));

		$info = $api->getFrameUtil()->perform();
		# print_r($info);	// 可以输出info数组查看
							// 访问令牌[visit_oauth][access_token]

		$_SESSION['token']	= $info['visit_oauth']['access_token'];
		$_SESSION['yibanID']	= $info['visit_user']['userid'];
		$_SESSION['yibanName']	= $info['visit_user']['username'];

		$api = YBOpenApi::getInstance()->bind($_SESSION['token']);
		$user = $api->getUser();
		$info = $user->realme();
		$_SESSION['name'] = $info['info']['yb_realname'];
		$_SESSION['school_id'] = $info['info']['yb_studentid'];
		$_SESSION['type'] = $info['info']['yb_identity'];

?>
