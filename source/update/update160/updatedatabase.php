<?php
@set_time_limit(3600);
header('Content-type:text/html;charset=gb2312');
if($_GET['confirm'] != 1){
	echo '<font color="red">ע�⣺</font><br>�������������ݿ�ĸ��£��ʺϴ�JIEQI CMS 1.5x ������ 1.60 �档���ݿ�����֮ǰ�����ñ��ݣ�������������޷��ָ���<br><br><a href="'.basename($_SERVER['PHP_SELF']).'?confirm=1">������￪ʼ�������ݿ�</a><br><br>';
	exit;
}
include_once '../../configs/define.php';
echo '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ';
echo '<font color="blue">���ݿ����ʱ������ݴ�С�йأ�����ǰ�����ñ��ݣ�����ʱ�������ĵȴ�����Ҫ�ر��������</font><br><br>';
echo '�����������ݿ�...';
ob_flush();
flush();
$conn=mysql_connect(JIEQI_DB_HOST, JIEQI_DB_USER, JIEQI_DB_PASS);
if(!$conn){
	echo '<font color="red">����ʧ�ܣ�<br>'.mysql_error().'</font><br>';
	exit;
}
//��������ԭ����ʲô����ʲô
$mysql_charset='';
if(defined('JIEQI_DB_CHARSET') && JIEQI_DB_CHARSET != 'default') $mysql_charset=JIEQI_DB_CHARSET;
if(empty($mysql_charset)){
	$result = mysql_query("SHOW TABLE STATUS FROM ".JIEQI_DB_NAME." LIKE 'jieqi_system_users'");
	if($result){
		$myrow = mysql_fetch_array($result);
		if(isset($myrow['Collation'])){
			$tmpary = explode('_', $myrow['Collation']);
			$tmpcharset=strtolower($tmpary[0]);
			if(in_array($tmpcharset, array('gbk', 'gb2312', 'big5', 'utf8', 'latin1'))) $mysql_charset = $tmpcharset;
		}
	}
}
if(empty($mysql_charset)) $mysql_charset='gbk';

$mysql_version = mysql_get_server_info();
if($mysql_version > '4.1' && !empty($mysql_charset)){
	@mysql_query("SET character_set_connection=".$mysql_charset.", character_set_results=".$mysql_charset.", character_set_client=binary");
}
if($mysql_version > '5.0') @mysql_query("SET sql_mode=''");

if(!mysql_select_db(JIEQI_DB_NAME)) {
	echo '<font color="red">���ݿ� '.JIEQI_DB_NAME.' �����ڻ��޷���Ȩ�ޣ��������ݿ��ʺţ�<br>'.mysql_error().'</font><br><br>';
	exit;
}
echo '<font color="blue">���ӳɹ���</font><br>';
ob_flush();
flush();

@ignore_user_abort(true); //�����û�ȡ��


//���ڸ���ϵͳ���ݿ�
echo '���ڸ���ϵͳ���ݿ�...';
ob_flush();
flush();
$sql=file_get_contents('mod_system.sql');
if(!empty($mysql_charset)){
	if($mysql_version > '5.0'){
		$sql=str_replace(array('TYPE=MyISAM', 'TYPE=HEAP'), array('ENGINE=MyISAM DEFAULT CHARSET='.$mysql_charset, 'ENGINE=MEMORY DEFAULT CHARSET='.$mysql_charset), $sql);
	}elseif($mysql_version > '4.1'){
		$sql=str_replace(array('TYPE=MyISAM', 'TYPE=HEAP'), array('ENGINE=MyISAM DEFAULT CHARSET='.$mysql_charset, 'ENGINE=HEAP DEFAULT CHARSET='.$mysql_charset), $sql);
	}
}
$sqlary=array();
jieqi_splitsqlfile($sqlary, $sql);
foreach($sqlary as $v){
	$v=trim($v);
	if(!empty($v) and strlen($v)>5){
		$retflag=mysql_query($v);
	}
}
echo '<font color="blue">�������</font><br>';
ob_flush();
flush();

//���ϵͳ����Щģ��
$modary=array();
$dirname='../../modules';
if(is_dir($dirname)){
	$handle = @opendir($dirname);
	while ($file = @readdir($handle)) {
		if($file[0] != '.'){
			$modary[]=$file;
		}
	}
	@closedir($handle);
}

//Ĭ��ģ������
$modnames=array('system'=>'ϵͳ����', 'article'=>'С˵����', 'obook'=>'���ߵ�����', 'forum'=>'��̳', 'cartoon'=>'��������', 'info'=>'������Ϣ', 'news'=>'���ŷ���', 'vote'=>'ͶƱ����', 'product'=>'��Ʒ����', 'pay'=>'����֧��', 'wapbook'=>'WAPС˵', 'quiz'=>'�ʴ�', 'group'=>'Ȧ�ӽ���', 'blog'=>'����', 'space'=>'���˿ռ�');

//���ģ������
$jieqiModules=array();
if(is_file('../../configs/modules.php')) include_once('../../configs/modules.php');
if(!isset($jieqiModules['system'])){
		$jieqiModules['system'] = array('caption'=>'ϵͳ����', 'dir'=>'', 'path'=>'', 'url'=>'', 'theme'=>'', 'publish'=>'1');
}
foreach($modary as $v){
	if(!isset($jieqiModules[$v])){
		$mname = isset($modnames[$v]) ? $modnames[$v] : $v;
		$jieqiModules[$v] = array('caption'=>$mname, 'dir'=>'', 'path'=>'', 'url'=>'', 'theme'=>'', 'publish'=>'1');
	}
}

//����ÿ��ģ��
$modconfig='';
foreach($jieqiModules as $k => $c){
	$modconfig .= '$jieqiModules[\''.jieqi_setslashes($k,'"').'\'] = array(\'caption\'=>\''.jieqi_setslashes($jieqiModules[$k]['caption'],'"').'\', \'dir\'=>\''.jieqi_setslashes($jieqiModules[$k]['dir'],'"').'\', \'path\'=>\''.jieqi_setslashes($jieqiModules[$k]['path'],'"').'\', \'url\'=>\''.jieqi_setslashes($jieqiModules[$k]['url'],'"').'\', \'theme\'=>\''.jieqi_setslashes($jieqiModules[$k]['theme'],'"').'\', \'publish\'=>\''.jieqi_setslashes($jieqiModules[$k]['publish'],'"').'\');'."\r\n\r\n";

	$sqlfile='mod_'.$k.'.sql';
	if(is_file($sqlfile)){
		echo '���ڸ��¡�'.$jieqiModules[$k]['caption'].'�����ݿ�...';
		ob_flush();
		flush();
		$sql=file_get_contents($sqlfile);
		if(!empty($mysql_charset)){
			if($mysql_version > '5.0'){
				$sql=str_replace(array('TYPE=MyISAM', 'TYPE=HEAP'), array('ENGINE=MyISAM DEFAULT CHARSET='.$mysql_charset, 'ENGINE=MEMORY DEFAULT CHARSET='.$mysql_charset), $sql);
			}elseif($mysql_version > '4.1'){
				$sql=str_replace(array('TYPE=MyISAM', 'TYPE=HEAP'), array('ENGINE=MyISAM DEFAULT CHARSET='.$mysql_charset, 'ENGINE=HEAP DEFAULT CHARSET='.$mysql_charset), $sql);
			}
		}
		$sqlary=array();
		jieqi_splitsqlfile($sqlary, $sql);
		foreach($sqlary as $v){
			$v=trim($v);
			if(!empty($v) and strlen($v)>5){
				$retflag=mysql_query($v);
			}
		}
		echo '<font color="blue">�������</font><br>';
		ob_flush();
		flush();
	}
}

//дģ�������ļ�
$modconfig='<?php'."\r\n".$modconfig.'?>';
jieqi_writefile('../../configs/modules.php', $modconfig);


//���ڸ���С˵ģ�����ݿ�
echo '����������Ϣ...';
ob_flush();
flush();
$sql="
UPDATE `jieqi_system_modules` SET version=160 WHERE name='article';
UPDATE `jieqi_system_modules` SET version=160 WHERE name='forum';
UPDATE `jieqi_system_modules` SET version=140 WHERE name='obook';
UPDATE `jieqi_system_modules` SET version=130 WHERE name='cartoon';
UPDATE `jieqi_system_modules` SET version=140 WHERE name='pay';
UPDATE `jieqi_system_modules` SET version=110 WHERE name='badge';
";
$sqlary=array();
jieqi_splitsqlfile($sqlary, $sql);
foreach($sqlary as $v){
	$v=trim($v);
	if(!empty($v) and strlen($v)>5){
		$retflag=mysql_query($v);
	}
}
//����С˵α��̬����
include_once '../../configs/article/configs.php';
if(is_numeric($jieqiConfigs['article']['fakeinfo'])){
	if(!empty($jieqiConfigs['article']['fakeinfo'])){
		if(!empty($jieqiConfigs['article']['fakeprefix'])) $jieqiConfigs['article']['fakeinfo']='/'.$jieqiConfigs['article']['fakeprefix'].'info<{$id|subdirectory}>/<{$id}>'.$jieqiConfigs['article']['fakefile'];
		else $jieqiConfigs['article']['fakeinfo']='/files/article/info<{$id|subdirectory}>/<{$id}>'.$jieqiConfigs['article']['fakefile'];
	}else{
		$jieqiConfigs['article']['fakeinfo']='';
	}
	$sql='UPDATE `jieqi_system_configs` SET ctype = 1, options=\'\', cvalue=\''.addslashes($jieqiConfigs['article']['fakeinfo']).'\', ctitle=\'������Ϣҳ��α��̬����\', `cdescription`=\'\r\nα��̬�����Ǵ����滻��ǵ�·�������ձ�ʾ��ʹ��α��̬��\r\n����ʹ�õ��滻����� <{$id}> ����ID ,<{$id|subdirectory}> ��������ID���ɵ���Ŀ¼��\r\n�磺/files/article/info<{$id|subdirectory}>/<{$id}>.htm\' WHERE modname=\'article\' AND cname=\'fakeinfo\';';
	mysql_query($sql);
}

if(is_numeric($jieqiConfigs['article']['fakesort'])){
	if(!empty($jieqiConfigs['article']['fakesort'])){
		if(!empty($jieqiConfigs['article']['fakeprefix'])) $jieqiConfigs['article']['fakesort']='/'.$jieqiConfigs['article']['fakeprefix'].'sort<{$class}><{$page|subdirectory}>/<{$page}>'.$jieqiConfigs['article']['fakefile'];
		else $jieqiConfigs['article']['fakesort']='/files/article/sort<{$class}><{$page|subdirectory}>/<{$page}>'.$jieqiConfigs['article']['fakefile'];
	}else{
		$jieqiConfigs['article']['fakesort']='';
	}
	$sql='UPDATE `jieqi_system_configs` SET ctype = 1, options=\'\', cvalue=\''.addslashes($jieqiConfigs['article']['fakesort']).'\', ctitle=\'���·���ҳ��α��̬����\', `cdescription`=\'\r\nα��̬�����Ǵ����滻��ǵ�·�������ձ�ʾ��ʹ��α��̬��\r\n����ʹ�õ��滻����� <{$class}> ����ID ,<{$page}> ҳ�룬<{$page|subdirectory}> ����ҳ�����ɵ���Ŀ¼��\r\n�磺/files/article/sort<{$class}><{$page|subdirectory}>/<{$page}>.htm\' WHERE modname=\'article\' AND cname=\'fakesort\';';
	mysql_query($sql);
}

if(is_numeric($jieqiConfigs['article']['fakeinitial'])){
	if(!empty($jieqiConfigs['article']['fakeinitial'])){
		if(!empty($jieqiConfigs['article']['fakeprefix'])) $jieqiConfigs['article']['fakeinitial']='/'.$jieqiConfigs['article']['fakeprefix'].'initial<{$initial}><{$page|subdirectory}>/<{$page}>'.$jieqiConfigs['article']['fakefile'];
		else $jieqiConfigs['article']['fakeinitial']='/files/article/initial<{$initial}><{$page|subdirectory}>/<{$page}>'.$jieqiConfigs['article']['fakefile'];
	}else{
		$jieqiConfigs['article']['fakeinitial']='';
	}
	$sql='UPDATE `jieqi_system_configs` SET ctype = 1, options=\'\', cvalue=\''.addslashes($jieqiConfigs['article']['fakeinitial']).'\', ctitle=\'����ĸ����ҳ��α��̬����\', `cdescription`=\'\r\nα��̬�����Ǵ����滻��ǵ�·�������ձ�ʾ��ʹ��α��̬��\r\n����ʹ�õ��滻����� <{$initial}> ����ĸ ,<{$page}> ҳ�룬<{$page|subdirectory}> ����ҳ�����ɵ���Ŀ¼��\r\n�磺/files/article/initial<{$initial}><{$page|subdirectory}>/<{$page}>.htm\' WHERE modname=\'article\' AND cname=\'fakeinitial\';';
	mysql_query($sql);
}

if(is_numeric($jieqiConfigs['article']['faketoplist'])){
	if(!empty($jieqiConfigs['article']['faketoplist'])){
		if(!empty($jieqiConfigs['article']['fakeprefix'])) $jieqiConfigs['article']['faketoplist']='/'.$jieqiConfigs['article']['fakeprefix'].'top<{$sort}><{$page|subdirectory}>/<{$page}>'.$jieqiConfigs['article']['fakefile'];
		else $jieqiConfigs['article']['faketoplist']='/files/article/top<{$sort}><{$page|subdirectory}>/<{$page}>'.$jieqiConfigs['article']['fakefile'];
	}else{
		$jieqiConfigs['article']['faketoplist']='';
	}
	$sql='UPDATE `jieqi_system_configs` SET ctype = 1, options=\'\', cvalue=\''.addslashes($jieqiConfigs['article']['faketoplist']).'\', ctitle=\'���а�ҳ��α��̬����\', `cdescription`=\'\r\nα��̬�����Ǵ����滻��ǵ�·�������ձ�ʾ��ʹ��α��̬��\r\n����ʹ�õ��滻����� <{$sort}> �����б� ,<{$page}> ҳ�룬<{$page|subdirectory}> ����ҳ�����ɵ���Ŀ¼��\r\n�磺/files/article/top<{$sort}><{$page|subdirectory}>/<{$page}>.htm\' WHERE modname=\'article\' AND cname=\'faketoplist\';';
	mysql_query($sql);
}

mysql_query("DELETE FROM `jieqi_system_configs`  WHERE modname='article' AND cname='fakefile';");
mysql_query("DELETE FROM `jieqi_system_configs`  WHERE modname='article' AND cname='fakeprefix';");

echo '<font color="blue">�������</font><br>';
ob_flush();
flush();

echo '<br><font color="blue">��ϲ�������ݿ�������ɣ�</font><br>';
ob_flush();
flush();

//���ַ�������з�б�ߵ� $str=�ַ��� $submit=�Ƿ��û��ύ������ $filter=���ӷ�б�ߵ��ַ�
function jieqi_setslashes($str, $filter=''){
	if($filter == '"') return str_replace(array('\\', '\''), array('\\\\', '\\\''), $str);
	elseif($filter == '\'') return str_replace(array('\\', '"'), array('\\\\', '\\"'), $str);
	else return addslashes($str);
}


//д�ļ�
function jieqi_writefile($file_name, &$data, $method = "wb"){
	$filenum = @fopen($file_name, $method);
	if(!$filenum) return false;
	@flock($filenum, LOCK_EX);
	$ret = @fwrite($filenum, $data);
	@flock($filenum, LOCK_UN);
	@fclose($filenum);
	@chmod($file_name, 0777);
	return $ret;
}

//���ݱ���ǰ׺
function jieqi_dbprefix($tbname){
	return 'jieqi_'.$tbname;
}

//�ֽ�sql���
function jieqi_splitsqlfile(&$ret, $sql, $release=32270){
	$sql          = trim($sql);
	$sql_len      = strlen($sql);
	$char         = '';
	$string_start = '';
	$in_string    = FALSE;
	$time0        = time();

	for ($i = 0; $i < $sql_len; ++$i) {
		$char = $sql[$i];

		// We are in a string, check for not escaped end of strings except for
		// backquotes that can't be escaped
		if ($in_string) {
			for (;;) {
				$i         = strpos($sql, $string_start, $i);
				// No end of string found -> add the current substring to the
				// returned array
				if (!$i) {
					$ret[] = $sql;
					return TRUE;
				}
				// Backquotes or no backslashes before quotes: it's indeed the
				// end of the string -> exit the loop
				else if ($string_start == '`' || $sql[$i-1] != '\\') {
					$string_start      = '';
					$in_string         = FALSE;
					break;
				}
				// one or more Backslashes before the presumed end of string...
				else {
					// ... first checks for escaped backslashes
					$j                     = 2;
					$escaped_backslash     = FALSE;
					while ($i-$j > 0 && $sql[$i-$j] == '\\') {
						$escaped_backslash = !$escaped_backslash;
						$j++;
					}
					// ... if escaped backslashes: it's really the end of the
					// string -> exit the loop
					if ($escaped_backslash) {
						$string_start  = '';
						$in_string     = FALSE;
						break;
					}
					// ... else loop
					else {
						$i++;
					}
				} // end if...elseif...else
			} // end for
		} // end if (in string)

		// We are not in a string, first check for delimiter...
		else if ($char == ';') {
			// if delimiter found, add the parsed part to the returned array
			$ret[]      = substr($sql, 0, $i);
			$sql        = ltrim(substr($sql, min($i + 1, $sql_len)));
			$sql_len    = strlen($sql);
			if ($sql_len) {
				$i      = -1;
			} else {
				// The submited statement(s) end(s) here
				return TRUE;
			}
		} // end else if (is delimiter)

		// ... then check for start of a string,...
		else if (($char == '"') || ($char == '\'') || ($char == '`')) {
			$in_string    = TRUE;
			$string_start = $char;
		} // end else if (is start of string)

		// ... for start of a comment (and remove this comment if found)...
		else if ($char == '#'
		|| ($char == ' ' && $i > 1 && $sql[$i-2] . $sql[$i-1] == '--')) {
			// starting position of the comment depends on the comment type
			$start_of_comment = (($sql[$i] == '#') ? $i : $i-2);
			// if no "\n" exits in the remaining string, checks for "\r"
			// (Mac eol style)
			$end_of_comment   = (strpos(' ' . $sql, "\012", $i+2))
			? strpos(' ' . $sql, "\012", $i+2)
			: strpos(' ' . $sql, "\015", $i+2);
			if (!$end_of_comment) {
				// no eol found after '#', add the parsed part to the returned
				// array if required and exit
				if ($start_of_comment > 0) {
					$ret[]    = trim(substr($sql, 0, $start_of_comment));
				}
				return TRUE;
			} else {
				$sql          = substr($sql, 0, $start_of_comment)
				. ltrim(substr($sql, $end_of_comment));
				$sql_len      = strlen($sql);
				$i--;
			} // end if...else
		} // end else if (is comment)

		// ... and finally disactivate the "/*!...*/" syntax if MySQL < 3.22.07
		else if ($release < 32270
		&& ($char == '!' && $i > 1  && $sql[$i-2] . $sql[$i-1] == '/*')) {
			$sql[$i] = ' ';
		} // end else if

		// loic1: send a fake header each 30 sec. to bypass browser timeout
		$time1     = time();
		if ($time1 >= $time0 + 30) {
			$time0 = $time1;
			header('X-pmaPing: Pong');
		} // end if
	} // end for

	// add any rest to the returned array
	if (!empty($sql) && ereg('[^[:space:]]+', $sql)) {
		$ret[] = $sql;
	}

	return TRUE;
}


?>