<?php
# ����� ������
@session_start();
# ��������� ��� Include
define("CONST_RUFUS", true);

# ������������� �������
function __autoload($name){ include("classes/_class.".$name.".php");}

# ����� ������� 
$config = new config;

# �������
$func = new func;

# ���� ������
$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);
	
?>


<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  
 <tr>
    <td colspan="5" align="center"><h4>������ ��������� 20 ���</h4></td>
    </tr>
  <tr>
    <td align="center" width="100" class="m-tb">�</td>
    <td align="center" width="100" class="m-tb">������������</td>
    <td align="center" width="100" class="m-tb">�����</td>
	<td align="center" width="100" class="m-tb">����</td>
	<td align="center" width="100" class="m-tb">������</td>
	
	
  </tr>
  <?PHP
  
  $db->Query("SELECT * FROM db_penny ORDER BY id DESC LIMIT 20");
  
	if($db->NumRows() > 0){
  
  	  	while($ref = $db->FetchArray()){
		if ($ref["win"] == 1) { 
		$winn = '<font color="green">�������! :)</font>'; 
		}
       
	    if ($ref["win"] == 2) { 
		$winn = '<font color="blue">�������! :]</font>'; 
		}
	    
		if ($ref["win"] == 0) {
		$winn = '<font color="red">��������! :( </font>'; 
		}
		
		$date = date('d-m-Y', $ref["date"]);
		?>
		<tr class="htt">
    		<td align="center"><?=$ref["id"]; ?></td>
    		<td align="center"><?=$ref['login']; ?></td>
    		<td align="center"><?=$ref['sum']; ?></td>
    		<td align="center"><?=$date; ?></td>
			<td align="center"><?=$winn; ?></td>
    		
  		</tr>
		<?PHP
		
		}
  
	}else echo '<tr><td align="center" colspan="5">��� �������</td></tr>'
  
  ?>

 
</table>