<link rel="stylesheet" type="text/css" media="all" href="/templates/admin/style.css" />
<style>
	.even textarea{font-size:12px;}
</style>
<div id="content">

<form name="frmcollect" id="frmcollect" action="/modules/article/admin/cuigeng.php" method="post">
<table class="grid" width="100%" align="center"><div id="content"><div class="gridtop">�߸���¼</div>

<?php if($cuigenglist){?>
  <tr align="center">
  	<!--td width="5%" class="title"><input type="checkbox" id="checkall" name="checkall" value="checkall" onclick="javascript: for (var i=0;i<this.form.elements.length;i++){ if (this.form.elements[i].name != 'checkkall') this.form.elements[i].checked = form.checkall.checked; }"></th-->
    <td width="5%" class="title">���</td>
    <td width="20%" class="title">����</td>
    <td width="10%" class="title">�߸����</td>
    <td width="8%" class="title">�߸�����</td>
    <td width="13%" class="title">ʵ�ʸ�������</td>
    <td width="12%" class="title">�߸���</td>
    <td width="15%" class="title">�߸�ʱ��</td>
    <td width="8%" class="title">״̬</td>
	<td width="7%" class="title">����</td>
  </tr>
  <?php foreach($cuigenglist as $key=>$value){?>
  <tr>
  	<!--td class="even" align="center"><input type="checkbox" id="checkid[]" name="checkid[]" value="<?php echo $value[id]?>"></td-->
    <td class="even" align="center"><?php echo $key+1;?></td>
    <td class="odd"><a href="/modules/article/articleinfo.php?id=<?php echo $value[articleid]?>" target="_blank"><?php echo $value[articlename]?><br />
</a></td>
    <td align="center" class="odd"><?php echo $value[nums];?></td>
    <td align="center" class="odd"><?php if($value[nums]=='100'){ $xuyao='2000';echo '2000��';}elseif($value['nums']=='190'){$xuyao='4000';echo '4000��';}else{$xuyao='6000';echo '6000��';};?></td>
    <td align="center" class="odd"><?php $gengxinnums = getsize($value[dateline],$value[articleid]);echo $gengxinnums?></td>
    <td class="even"><a href="/userpage.php?uid=<?php echo $value[uid]?>" target="_blank"><?php echo $value[uname]?></a></td>
    <td align="center" class="odd"><?php echo date("Y-m-d H:i:s",$value[dateline]);?></td>
    <td align="center" class="odd"><?php if($value['status']=='1'){echo '�ѽ���';}else{echo 'δ����';}?></td>
	<td align="center" class="even"><?php if($value['status']=='0'){?><a href="javascript:if(confirm('ȷʵҪ����ô��')) document.location='/modules/article/admin/cuigeng.php?action=jiesuan&cgid=<?php echo $value[id]?>&type=<?php if($xuyao<$gengxinnums){echo 'yes';}else{echo 'no';}?>&fabuid=<?php echo $value[uid];?>';">����</a><?php }?></td>
  </tr>
  <?php } ?>
  <?php }else{ ?>
    <tr align="center">
        <td>
            û���ҵ�������� <a href="/modules/article/admin/cuigeng.php"><font style="color:blue;">[����]</font></a>
        </td>
    </tr>
  <?php } ?>
</table>


</div>