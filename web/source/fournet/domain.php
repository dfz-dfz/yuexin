<?php
defined('IN_IA') or exit('Access Denied');
if (defined('IN_API')) {
    return;
}

$config['setting']['domain']['load'] = '1';
$host = $_SERVER['HTTP_HOST'];
$domain = $config['setting']['domain'];
$temp = false;
$i = $_GET['i'];
$file = IA_ROOT . '/data/domain/' . $i . '.php';
if (!file_exists($file)) {
	$file = IA_ROOT . '/data/domain/' . str_replace('.', '_', $host) . '.php';
}
if (!file_exists($file)) {
    $sub = explode('.', $host);
    if (count($sub) > 2) {
        $file = IA_ROOT . '/data/domain/' . implode('_', array_slice($sub, 1)) . '.php';
        $temp = true;
    }

    unset($sub);
}
if (file_exists($file)) {
    include $file;
}
if (!empty($set)) {
    $forward = $host;
    if (defined('IN_SYS') && (substr($_SERVER['PHP_SELF'], -13) == 'web/index.php')) {
        if ((!empty($domain['txt']) || !empty($set['virtual_txt'])) && preg_match('|^MP_verify_([^.]*)\.txt$|', $_SERVER['QUERY_STRING'], $temp)) {
            header('Content-Type:text/plain;charset=utf-8');
            echo str_replace('-', '/', $temp[1]);
            die;
        }
        if (!empty($set['short']) && isset($_GET['_s']) && (substr($_GET['_s'], 0, 2) == 's_') && (!empty($set['short_w']))) {
            $short = $set['short_w'];
            $temp = substr($_GET['_s'], 2);
            if (is_array($short[$temp])) {
                unset($_GET['_s']);
                $short= $short[$temp];
                if(empty($short['t'])) {
                    $_GET = array_merge($_GET, $short['a']);
                }else{
                    $url=$short['a'];
                }
            }
            if (isset($_GET['_s']) && is_array($short['_preg_'])) {
                foreach ($short['_preg_'] as $r) {
                    if (@preg_match($r['r'], $temp, $m)) {
                        if(empty($r['t'])){
                            $_GET = array_merge($_GET, $r['a']);
                            if (isset($r['p1'])) {
                                $_GET[$r['p1']] = $m[1];
                            }
                        }else if($r['t']==1){
                            $url=str_replace('\1',$m[1],$r['a']);
                        }
                        unset($_GET['_s']);
                        break;
                    }
                }
                unset($m);
            }
            unset($short);
        }
        if (empty($url)) {
            $check = $set['web'];
            if (!empty($check['jump'])) {
                if (!empty($check['domains'])) {
                    $temp = count($check['domains']);
                    $i = ($temp > 1) ? rand(0, $temp - 1) : 0;
                    if (isset($check['domains'][$i])) {
                        $forward = $check['domains'][$i];
                    }
                }
                if ($forward != $host) {
                    $url = 'http://' . $forward . $_SERVER['REQUEST_URI'];
                }
            }
            if ($domain['protect_web'] && ($host != $domain['host'])) {
                if (empty($check['enable'])) {
                    $tip = $domain['tip'];
                } else if (!empty($set) && !empty($set['uniacid'])) {
                    $_COOKIE[$config['cookie']['pre'] . '__uniacid'] = $set['uniacid'];
                }
            }
            if (!empty($check['login']) && !empty($_GET['c']) && ($_GET['c'] == 'user') && ($_GET['a'] == 'login')) {
                $url = $check['login_url'];
            }else if (!empty($check['welcome']) && !empty($_GET['c']) && ($_GET['c'] == 'home') && ($_GET['a'] == 'welcome')) {
                if (!empty($_GET['do']) && !empty($check['wc_urls'][$_GET['do']])) {
                    $url = $check['wc_urls'][$_GET['do']];
                }
            }
        }
				print('111');
		exit;
    } else if (defined('IN_MOBILE') && (substr($_SERVER['PHP_SELF'], -13) == 'app/index.php')) {
        $config['cookie']['domain'] = $host;
        if (!empty($set['auth']) && !empty($_GET['_wx']) && (!empty($_GET['code']))) {
            $temp = $_GET['_wx'];
            if (!empty($set['auth_a'][$temp])) {
                unset($_GET['_wx']);
                $url = 'http://' . $set['auth_a'][$temp] . '/app/index.php?' . http_build_query($_GET);
            }
        }
        if (empty($url) && !empty($set['short']) && !empty($_GET['_s']) && (substr($_GET['_s'], 0, 2) == 's_') && (!empty($set['short_a']))) {
            $temp = substr($_GET['_s'], 2);
            $short = $set['short_a'];
            if (is_array($short[$temp])) {
                unset($_GET['_s']);
                $short= $short[$temp];
                if(empty($short['t'])) {
                    $_GET = array_merge($_GET, $short['a']);
                }else{
                    $url=$short['a'];
                }
            }
            if (isset($_GET['_s']) && is_array($short['_preg_'])) {
                foreach ($short['_preg_'] as $r) {
                    if (@preg_match($r['r'], $temp, $m)) {
                        if(empty($r['t'])){
                            $_GET = array_merge($_GET, $r['a']);
                            if (isset($r['p1'])) {
                                $_GET[$r['p1']] = $m[1];
                            }
                        }else if($r['t']==1){
                            $url=str_replace('\1',$m[1],$r['a']);
                        }
                        unset($_GET['_s']);
                        break;
                    }
                }
                unset($m);
            }
            unset($short);
        }
        if (empty($url)) {
            $check = $set['app'];
            if ((!empty($check['jump']) && empty($_GET['_jump_']))) {
                $redirect = true;
                if (!empty($check['jump_acid']) && !empty($check['jump_ids'])) {
                    $redirect = empty($_GET['i']) ? false : in_array($_GET['i'], $check['jump_ids']);
                }
                if ($redirect && !empty($check['modules'])) {
                    $redirect = empty($_GET['m']) ? false : in_array($_GET['m'], $check['modules']);
                }
                if ($redirect) {
                    $redirect = !($host == $domain['host'] && $_GET['c'] == 'auth');
                }
                if ($redirect && !empty($check['fans'])) {
                    $_GET = array_merge($_GET, $check['fans_url']);
                    $_SERVER['SOURCE'] = $_SERVER['REQUEST_URI'];
                    $_SERVER['DomainSet'] = $check;
                    $redirect = false;
                }
                if ($redirect) {
                    $notice = false;
                    if (!empty($check['domains'])) {
                        $temp = count($check['domains']);
                        $i = ($temp > 1) ? rand(0, $temp - 1) : 0;
                        if (isset($check['domains'][$i])) {
                            $forward = $check['domains'][$i];
                        }
                    }
                    if (!empty($check['randsub'])) {
                        $forward = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'), 0, 5) . '.' . $forward;
                    }
                    if ($forward != $host) {
                        $url = 'http://' . $forward . $_SERVER['REQUEST_URI'];
                    }
                }
            }
            if (!empty($check['limit']) && !empty($_GET['i']) && !in_array($_GET['i'], $check['uniacids'])) {
                $tip = "公众号[{$_REQUEST['i']}]禁止访问{$host}!";
            }
            if (empty($url) && empty($tip) && !empty($check['p_jump'])) {
                $redirect = true;
                foreach ($check['p_para'] as $k => $v) {
                    if (!isset($_GET[$k]) || $_GET[$k] != $v) {
                        $redirect = false;
                        break;
                    }
                }
                unset($k, $v);
                if ($redirect && ($forward != $check['p_host'])) {
                    if(preg_match('|\*\.|',$check['p_host'])){
                        $check['p_host']=str_replace('*',substr(str_shuffle('abcdefghijklmnopqrstuvwxyz12356789'), 0, 6),$check['p_host']);
                    }
                    $url = 'http://' . $check['p_host'] . $_SERVER['REQUEST_URI'];
                }
            }
        }
    } else {
        if (empty($_SERVER['PHP_SELF']) || (trim($_SERVER['PHP_SELF'], '/') == 'index.php') && empty($_GET['c'])) {
            if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'micromessenger')) {
                if (!empty($set['app']['redirect'])) {
                    $url = $set['app']['url'];
                }
            } elseif ($set['web']['redirect']) {
                $url = $set['web']['url'];
            }
            if (!empty($url)) {
                $url = str_replace(trim($set['domain']) . '/', $host . '/', $url);
            }
        }
    }
    unset($i, $redirect);
    $GLOBALS['DomainSet'] = $set;
} else {
    if ($host != $domain['host']) {
        if (($domain['protect_app'] && defined('IN_MOBILE')) || ($domain['protect_web'] && defined('IN_SYS'))) {
            $tip = $domain['tip'];
        }
    }
}
if (empty($url) && ($set['domain'] != $_SERVER['HTTP_HOST']) && $set['domain'] && $_GET['from']!='wxapp' && $_GET['a']!='wxapp' && $_GET['c']!='site') {
	$url = 'http://' . trim($set['domain']) . $_SERVER['REQUEST_URI'];
}
if (!empty($url)) {
    if ((empty($domain['https']) || in_array($forward, $domain['https'])) && substr($url, 0, 5) == 'http:') {
        $_W['ishttps'] = !empty($_W['config']['setting']['https']) ? true : (strtolower(($_SERVER['SERVER_PORT'] == 443 || (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off') ? true : false)));
        if ($_W['ishttps']) {
            $url = str_replace('http://', 'https://', $url);
        }
    }
    exit(header("Location: " . $url));
}
if (!empty($tip)) {
    include dirname(__FILE__) . '/template/404.htm';
    exit;
}
unset($file, $check, $temp, $url, $tip, $set, $forward, $domain, $host);