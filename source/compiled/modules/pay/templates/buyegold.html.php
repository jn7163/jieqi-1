<?php
$GLOBALS['jieqiTset']['jieqi_blocks_module'] = 'pay';
echo '
';
$GLOBALS['jieqiTset']['jieqi_blocks_config'] = 'payblocks';
echo '
<table class="grid" width="600" align="center">
  <caption>兑换规则</caption>
  <tr>
    <td class="even"><br />      
      &nbsp; 1、每1元人民币钱兑换100点'.$this->_tpl_vars['egoldname'].'<br />
      <br />
    &nbsp; 2、银行汇款最少额度为10元人民币<br />
    <br />
  &nbsp; 3、邮局汇款最少额度为20元人民币<br />
    <br /></td>
  </tr>
</table>
<br /><br />
';
?>