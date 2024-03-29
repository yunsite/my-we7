<?php
error_reporting(0);
define('IN_MOBILE', true);
$get = $_GET;
$_POST['weid'] = $get['attach'];
require '../../source/bootstrap.inc.php';

if(is_array($_W['account']['payment'])) {
	$wechat = $_W['account']['payment']['wechat'];
	if(!empty($wechat)) {
		ksort($get);
		$string1 = '';
		foreach($get as $k => $v) {
			if($v != '' && $k != 'sign') {
				$string1 .= "{$k}={$v}&";
			}
		}
		$sign = strtoupper(md5($string1 . "key={$wechat['key']}"));
		
		if($sign == $get['sign']) {
			$plid = $get['out_trade_no'];
			$sql = 'SELECT * FROM ' . tablename('paylog') . ' WHERE `plid`=:plid';
			$params = array();
			$params[':plid'] = $plid;
			$log = pdo_fetch($sql, $params);
			if(!empty($log) && $log['status'] == '0') {
				$record = array();
				$record['status'] = '1';
				$tag = array();
				$tag['transaction_id'] = $get['transaction_id'];
				$record['tag'] = iserializer($tag);
				pdo_update('paylog', $record, array('plid' => $log['plid']));

				$site = WeUtility::createModuleSite($log['module']);
				if(!is_error($site)) {
					$site->module = $_W['account']['modules'][$log['module']];
					$site->weid = $_W['weid'];
					$site->inMobile = true;
					$method = 'payResult';
					if (method_exists($site, $method)) {
						$ret = array();
						$ret['weid'] = $log['weid'];
						$ret['result'] = 'success';
						$ret['type'] = $log['type'];
						$ret['from'] = 'notify';
						$ret['tid'] = $log['tid'];
						$ret['user'] = $log['openid'];
						$ret['fee'] = $log['fee'];
						$ret['tag'] = $tag;
						$site->$method($ret);
						exit('success');
					}
				}
			}
		}
	}
}
exit('fail');
