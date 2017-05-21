<?php
	session_start();
	/**
	 * 轻应用授权
	 *
	 */


	/**
	 * 包含SDK
	 */
	require("classes/yb-globals.inc.php");

	//配置文件
	include('config.php');

	/**
	 * 站内应用需要使用AppID、AppSecret和应用入口地址初始化
	 *
	 */
	$api = YBOpenApi::getInstance()->init($cfg['appID'], $cfg['appSecret'], $cfg['callback']);
	$iapp  = $api->getIApp();
	if (empty($_SESSION['token'])) {
		if (!isset($_REQUEST['verify_request']) || empty($_REQUEST['verify_request'])) {
			header('location: ' . $cfg['callback']);
		} else {
			try
			{
				/**
				* 调用perform()验证授权，若未授权会自动重定向到授权页面
				* 授权成功返回的数组中包含用户基本信息及访问令牌信息
				*/
				$info = $iapp->perform();

				$_SESSION['token']	= $info['visit_oauth']['access_token'];

				$api->bind($token);
				$me = $api->request('user/me');
				$real_me = $api->request('user/real_me');
				$_SESSION['yibanID'] = $me['info']['yb_userid'];
				$_SESSION['yibanName'] = $me['info']['yb_usernick'];
				$_SESSION['name'] = $real_me['info']['yb_realname'];
				$_SESSION['school_id'] = $real_me['info']['yb_studentid'];
				$_SESSION['type'] = $real_me['info']['yb_identity'];
				$_SESSION['type'] = 'student';

				if (!empty($_SESSION['token'])) {
					header('location: ' . $cfg['display']);
				} else {
					print_r("跳转中。。。");
				}
			}
			catch (YBException $ex) {
				print_r("登陆失败");
			}
		}
	} else {
		echo "您已登陆";
		$api->bind($_SESSION['token']);
		$me = $api->request('user/me');
		$real_me = $api->request('user/real_me');
		$_SESSION['yibanID'] = $me['info']['yb_userid'];
		$_SESSION['yibanName'] = $me['info']['yb_usernick'];
		$_SESSION['name'] = $real_me['info']['yb_realname'];
		$_SESSION['school_id'] = $real_me['info']['yb_studentid'];
		$_SESSION['type'] = $real_me['info']['yb_identity'];
		$_SESSION['type'] = 'student';
		//echo $_SESSION['school_id'];
		header('location: ' . $cfg['display']);
	}
?>
