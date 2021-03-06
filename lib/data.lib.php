<?
/* $Id: data.lib.php,v 1.1.1.1 2004/05/04 01:08:18 mmr Exp $ */
function b1n_getVar($var, &$dest, $default='')
{
  $dest = $default;

  $ret = isset($_REQUEST[$var]);

  if($ret){
    $dest = $_REQUEST[$var];
  }

  return $ret;
}

function b1n_retMsg($msg, $replace=array(), $status=b1n_FIZZLES)
{
  global $ret_msgs;

  if(sizeof($replace)){
    foreach($replace as $k => $v){
      $msg = str_replace($k, $v, $msg);
    }
  }
  array_push($ret_msgs, array('status' => $status, 'msg' => $msg));
}

function b1n_cmp($v1, $v2)
{
  // Numeric
  if(is_numeric($v1) && is_numeric($v2)){
    return $v1 == $v2;
  }
  else {
  // String
    return (strcmp($v1, $v2) == 0);
  }
}

function b1n_cleanArray($a = array())
{
  if(is_array($a)){
    foreach($a as $k=>$v){
      $a[$k] = '';
    }
  }
  else {
    $a = array();
  }

  return $a;
}

function b1n_inBd($var, $delim = "'")
{
  $var = trim($var);

  if(strlen($var)==0 || is_null($var)){
    return 'NULL';
  }

  return $delim . addslashes($var) . $delim;
}

function b1n_inHtml($var)
{
  return wordwrap(nl2br(htmlspecialchars($var, ENT_QUOTES)), 75, '<br />');
}

function b1n_inHtmlNoBr($var)
{
  return "<nobr>" . htmlspecialchars($var, ENT_QUOTES) . "</nobr>";
}

function b1n_inHtmlLimit($var)
{
  return b1n_inHtml((strlen($var) <= b1n_LIST_MAX_CHARS)? $var : substr($var, 0, b1n_LIST_MAX_CHARS) . "...");
}

function b1n_arrayRand($a)
{
  return $a[array_rand($a)];
}

function b1n_formatDate($var){
  if($ret=preg_match('/(\d{2}).(\d{2}).(\d{4})/',$var,$match)){
    list(,$d,$m,$y) = $match;
    $ret = sprintf("%04d-%02d-%02d", $y, $m, $d); 
  }
  elseif($ret=preg_match('/(\d{4}).(\d{2}).(\d{2})/',$var,$match)){
    list(,$y,$m,$d) = $match;
    $ret = sprintf("%04d-%02d-%02d", $y, $m, $d); 
  }
  return $ret;
}

function b1n_showDate($var)
{
  if($ret=preg_match('/(\d{2}).(\d{2}).(\d{4})/',$var,$match)){
    list(,$d,$m,$y) = $match;
    $ret = sprintf("%02d/%02d/%04d", $d, $m, $y); 
  }
  elseif($ret=preg_match('/(\d{4}).(\d{2}).(\d{2})/',$var,$match)){
    list(,$y,$m,$d) = $match;
    $ret = sprintf("%02d/%02d/%04d", $d, $m, $y); 
  }
  return $ret;
}
?>
