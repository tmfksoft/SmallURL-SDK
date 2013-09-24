<?php
class SmallURL {
	private $key = false;
	private $init = false;

	public function init($given) {
		$result = $this->validate_key($given,true);
		if ($result['res']) {
			$this->init = true;
			$this->key = $given;
		}
		else {
			die('Unable to Init SmallURL! The provided key was rejected with the message: '.$result['msg']);
		}
	}
	public function shorten($url,$custom = false) {
		// Shortens our URL
		if ($custom != false) {
			$result = $this->push_request(array('url'=>$url,'custom'=>$custom));
		}
		else {
			$result = $this->push_request(array('url'=>$url));
		}
		if ($result['res']) {
			// It worked.
			$res = array();
			$res['result'] = true;
			$res['short'] = $result['short'];
			$res['full'] = "http://smallurl.in/".$result['short'];
			$res['url'] = $url;
			return $res;
		}
		else {
			die($result['msg']);
		}
	}
	public function inspect($smallurl) {
		// Inspects a SmallURL
		$result = $this->push_request(array('action'=>'inspect','short'=>$smallurl));
		if ($result['res'] == true) {
			$res = array();
			$res['result'] = true;
			$res['long'] = "http://smallurl.in/".$result['short'];
			$res = array_merge($res,$result);
			unset($res['res']);
			return $res;
		}
		else {
			die($result['msg']);
		}
	}
	private function push_request($data = array('action'=>'shorten')) {
		// This simply pushes data to the API and retrieves it.
		$key = $this->key;
		if ($key != false) {
			// Key is preset, otherwise we override it with a validation.
			$data['key'] = $key;
		}
		$data['type'] = 'php';
		$query = array();
		foreach ($data as $key => $val) {
			$query[] = "{$key}=".urlencode(htmlentities($val));
		}
		$query = implode("&",$query);
		$reply = file_get_contents("http://api.smallurl.in/?".$query);
		return unserialize($reply);
	}
	private function validate_key($given,$sup = false) {
		// This simply checks if SmallURL likes us, Editing this code wont do anything.
		$result = $this->push_request(array('action'=>'check','key'=>$given));
		if ($result['res']) {
			// The keys right.
			return $result;
		}
		else {
			if (!$sup) {
				die('The API Key was refused by SmallURLs API with message: '.$result['msg']);
			}
			else {
				return $result;
			}
		}
	}
}
$SmallURL = new SmallURL();

// SmallURL SDK Proceedure.
$SmallURL->init('e718c8545d6ad03e70ba4bb553b69ce3'); // Tell the SDK we need it, lets start using it.
$surl = $SmallURL->shorten('http://php.net/manual/en/language.oop5.overloading.php','php oop overloading');
// The result for the shortened URL is a simple array of:
// Result (True or False), Short (Just the ID), Full (Full URL), URL (The original url.) and MSG (Error Message)
if ($surl['result'] == true) {
	echo "We shortened the URL {$surl['url']} to {$surl['full']}!<p>\n";
}
else {
	echo "SmallURL refused to shorten {$surl['url']}!<p>\n";
}
// Lets inspect it.
$inspection = $SmallURL->inspect($surl['short']);
echo "Info about '{$surl['short']}':";
foreach ($inspection as $key => $data) {
	echo "<br><strong>{$key}</strong> = {$data}";
}
?>