<?php
$GLOBALS['jieqiTset']['jieqi_blocks_module'] = 'system';
echo '
<link href="/css/nt.css" rel="stylesheet" type="text/css" />
<!--���Ĳ���-->
	<div class="homecon">
		<div class="homedh">
			<div class="hometit1">
				<ul>
					<li class="homesy"><a href="/userdetail.php" class="size14">�û�����</a></li>
					<li class="homesy2"><a target="_blank" href="/modules/article/applywriter.php"
						class="size14">��������</a></li>
				</ul>
			</div>
			<div class="cl">
			</div>
			<div>
			</div>
		</div>
		<div class="homedown">
			<!--��Ա���-->
			<div class="homeDL">
	<div class="photo">
		<div class="photo_pic">
			<div>
				<a href="touxiang.aspx">
					<img style="width: 80px; height: 80px; border: 1px solid #ccc;" id="imagesrc" src="'.$this->_tpl_vars['url_avatar'].'?'.$this->_tpl_vars['jieqi_time'].'" /></a>
			</div>
			<div class="photo_name">'.$this->_tpl_vars['jieqi_username'].'
			</div>
		</div>
	</div>
	<div class="homeleft_dh">
		<ul>
			<li class="myaccount"><a href="/userdetail.php" title="�˻�">�˻�</a></li>
			<li class="myaccount" style="background-position: 0px -705px;"><a href="/setavatar.php"
				title="ͷ��">ͷ��</a></li>
			<li class="mybookcase"><a href="/modules/article/bookcase.php" title="���">���</a></li>
			<li class="mymsg"><a href="/message.php?box=inbox" title="��Ϣ">��Ϣ</a></li>
			<li class="myfootmark"><a href="/ptopics.php?uid=self" title="���">���</a></li>
			<li class="myhelp"><a target="_blank" href="/modules/forum/" title="����">����</a></li>
			<li class="zuxiao"><a href="/logout.php" title="ע��">ע��</a></li>
		</ul>
	</div>
</div>

			<!--��Ա��߽���-->
			<div class="homeDR">
                <div class="homezhdh">
					<ul>
						<li>�ҵ�ͷ��</li>
					</ul>
				</div>

				<div class="homeDRcon">
					<div class="myinformation">
						<form name="setavatar" id="setavatar" action="'.$this->_tpl_vars['jieqi_url'].'/setavatar.php?do=submit" method="post" enctype="multipart/form-data">
<table width="100%" class="grid" cellspacing="1" align="center">
<caption>����ͷ��</caption>
<tr valign="middle" align="left">
  <td class="odd" width="25%">�û���</td>
  <td class="even">'.$this->_tpl_vars['jieqi_username'].'</td>
</tr>
<tr valign="middle" align="left">
  <td class="odd" width="25%">��ǰͷ��</td>
  <td class="even">
';
if($this->_tpl_vars['avatartype'] > 0){
echo '
<img id="cut_img" src="'.$this->_tpl_vars['url_avatar'].'?'.$this->_tpl_vars['jieqi_time'].'" style="margin:0;padding:0;border:1px solid #000000;" />
';
if($this->_tpl_vars['avatarcut'] == 1){
echo '
<img id="cut_img" src="'.$this->_tpl_vars['url_avatars'].'?'.$this->_tpl_vars['jieqi_time'].'" style="margin:0;padding:0;border:1px solid #000000;" />
<img id="cut_img" src="'.$this->_tpl_vars['url_avatari'].'?'.$this->_tpl_vars['jieqi_time'].'" style="margin:0;padding:0;border:1px solid #000000;" />
';
}
echo '
';
}
echo '
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="odd" width="25%">�ϴ�ͷ��</td>
  <td class="even"><input type="file" class="text" size="30" name="avatarimage" id="avatarimage" /><br />
  <span class="hottext">ͷ��ͼƬ��ʽΪ '.$this->_tpl_vars['need_imagetype'].' ���ļ���С���ܳ��� '.$this->_tpl_vars['max_imagesize'].'K</span>
  </td>
</tr>
<tr valign="middle" align="left">
  <td class="odd" width="25%">&nbsp;
  <input type="hidden" name="action" id="action" value="upload" />
  </td>
  <td class="even"><input type="submit" class="button" name="submit"  id="submit" value="�ϴ�ͷ��" /></td>
</tr>
</table>
</form>
						<div class="cl">
						</div>
					</div>
				</div>
			</div>
			<div class="cl">
			</div>
		</div>
	</div>
';
?>