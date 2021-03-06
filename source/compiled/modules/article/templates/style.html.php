<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 

"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset='.$this->_tpl_vars['jieqi_charset'].'">
<meta name="keywords" content="'.$this->_tpl_vars['meta_keywords'].'" />
<meta name="description" content="'.$this->_tpl_vars['meta_description'].'" />
<TITLE>'.$this->_tpl_vars['article_title'].'-'.$this->_tpl_vars['jieqi_title'].'-'.$this->_tpl_vars['sortname'].'-'.$this->_tpl_vars['jieqi_sitename'].'</TITLE>
<link href="/themes/chaoliu/css/reset.css" rel="stylesheet"/>
<link href="/themes/chaoliu/css/content.css" rel="stylesheet"/>
<script type="text/javascript" src="/themes/chaoliu/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/themes/chaoliu/js/content.js"></script>

<!--[if IE 6]><script type="text/javascript" src="/themes/chaoliu/js/DD_belatedPNG.js">
</script>
<script>
 DD_belatedPNG.fix(".pngFix,.pngFix:hover,.pngFix img");
</script>
<![endif]-->
<script type="text/javascript">
<!--
var preview_page = "'.$this->_tpl_vars['preview_page'].'";
var next_page = "'.$this->_tpl_vars['next_page'].'";
var index_page = "'.$this->_tpl_vars['index_page'].'";
var article_id = "'.$this->_tpl_vars['article_id'].'";
var chapter_id = "'.$this->_tpl_vars['chapter_id'].'";

function jumpPage() {
  if (event.keyCode==37) location=preview_page;
  if (event.keyCode==39) location=next_page;
  if (event.keyCode==13) location=index_page;
}
document.onkeydown=jumpPage;
-->
</script>
</head>


<body style="background-image:url(/themes/chaoliu/images/wood.jpg);background-attachment: fixed;" >

<div id="wrap" > 
    <div class="page_head">
        <p class="nav pngFix"><a href="/" target="_blank">'.$this->_tpl_vars['jieqi_sitename'].'</a> &gt; <a href="/modules/article/articleinfo.php?id='.$this->_tpl_vars['articleid'].'">'.$this->_tpl_vars['article_title'].'</a> &gt; '.$this->_tpl_vars['jieqi_title'].'&nbsp;</p>
        <div class="clear"></div>
    </div>
    <ul class="side_btn">
        <li  onmouseout="clear_all()" onMouseOver="fontsize_list()">
            <a class="fontsize"  title="字号"></a>
            <ul class="btn_list pngFix" id="fontsize_list" style="display:none">
                <li class="font_mr"><a>默认</a></li>
                <li class="font_st"><a>宋体</a></li>
                <li class="font_yh"><a>雅黑</a></li>
                <li class="font_kt"><a>楷体</a></li>
                <li class="font_ht"><a>黑体</a></li>
                <li class="font_16"><a>16px</a></li>
                <li class="font_18"><a>18px</a></li>
                <li class="font_24"><a>24px</a></li>
                <li class="font_32"><a>32px</a></li>
            
            </ul>
        </li>
        <li  onmouseout="clear_all()" onMouseOver="width_list()">
            <a class="changewidth"  title="宽度"></a>
            <ul class="btn_list pngFix" id="width_list" style="display:none">
                <li class="width_820"><a>60%</a></li>
                <li class="width_1080"><a>70%</a></li>
                <li class="width_1240"><a>75%</a></li>
                <li class="width_1400"><a>80%</a></li>
                <li class="width_1720"><a>85%</a></li>
            </ul>
        </li>
        <li  onmouseout="clear_all()" onMouseOver="daynight_list()">
            <a class="daynight"  title="正常/夜间模式"></a>
            <ul class="btn_list pngFix" id="daynight_list" style="display:none">
                <li class="day"><a>默认模式</a></li>
                <li class="night"><a>夜间模式</a></li>
            </ul>
        </li>
        <li onmouseout="clearthis(this)" onMouseOver="mulu_list()">
            <a class="mulu"  title="目录"></a>
            <div  class="btn_list pngFix" id="mulu_list" style="display:none" >
                <div class="mulu_con" >
				<p class="section_title">正文'.$this->_tpl_vars['a'].'</p>	<ul class="section_list">
						'.$this->_tpl_vars['str'].'
                    			<div class="clear"></div>	</ul> 
                </div>
            </div>
        </li>
        
        
    </ul>
    <div class="page_main">
        <h1 class="chapter_title">'.$this->_tpl_vars['jieqi_title'].'</h1>
        <div class="chapter_info">
			<div class="prev_arrow"><a href="'.$this->_tpl_vars['preview_page'].'" class=\'pngFix\'></a></div>  <p class="chapter_info_mid"></p> <div class="next_arrow"><a href="'.$this->_tpl_vars['next_page'].'" class=\'pngFix\'></a></div>
        </div>
        <div class="chapter_con">
        <p>'.$this->_tpl_vars['jieqi_content'].'</p>
        </div>
<div class="chapter_info">
			<div class="prev_arrow"><a href="'.$this->_tpl_vars['preview_page'].'" class=\'pngFix\'></a></div>  <p class="chapter_info_mid"><span>←可使用左右快捷键翻页→</span></p> <div class="next_arrow"><a href="'.$this->_tpl_vars['next_page'].'" class=\'pngFix\'></a></div>
        </div>

</div>
<!-- 头部背景 结束 -->

<!-- 禁用右键: -->
<script>
function stop(){
return false;
}
document.oncontextmenu=stop;

</script>


<!-- 禁用选择文本 -->
<script type="text/javascript">
 var omitformtags=["input", "textarea", "select"]
 omitformtags=omitformtags.join(",")
 omitformtags=","+omitformtags+\',\';
 if (typeof document.onselectstart!="undefined"){
      document.onselectstart=function(){
           if(omitformtags.indexOf(\',\'+event.srcElement.tagName.toLowerCase()+\',\') == -1)
              return false; 
      };
 }else{
     document.onmousedown=function(e){
         if(omitformtags.indexOf(\',\'+e.target.tagName.toLowerCase()+\',\') == -1)
            return false;
     };
     document.onmouseup=function(){
        return true;
     };
 }
</script>




<SCRIPT language=JavaScript1.2>
function disableselect(e){
return false}
function reEnable(){return true
}
file://if IE4+
document.onselectstart=new Function ("return false")
file://if NS6
if (window.sidebar){
document.onmousedown=disableselect
document.onclick=reEnable
}
</SCRIPT>

<SCRIPT language=JavaScript type=text/JavaScript>
<!--
function MM_reloadPage(init) {    //reloads the window if Nav4 resized
    if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
      document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
    else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</SCRIPT>';
?>