<?php
// ������ ����������� IP ������� ����� ������
$allowed_ips = "188.163.99.165 127.0.0.1";

$ips = explode(" ",$allowed_ips);
if (array_search($_SERVER["REMOTE_ADDR"],$ips) === FALSE) {
echo "<p>������ ��������!";
exit;
};
?>
<?PHP
if(isset($_SESSION["admin"])){ Header("Location: /?menu=admin4ik"); return; }

if(isset($_POST["admlogin"])){

	$db->Query("SELECT * FROM db_config WHERE id = 1 LIMIT 1");
	$data_log = $db->FetchArray();
	
	if(strtolower($_POST["admlogin"]) == strtolower("admin") AND strtolower($_POST["admpass"]) == strtolower("admin") ){
	
		$_SESSION["admin"] = true;
		Header("Location: /?menu=admin4ik");
		return;
	}else echo "<center><font color = 'red'><b>������� ������ ����� �/��� ������</b></font></center><BR />";
	
}

?>
<div class="s-bk-lf">
	<div class="acc-title">�����-������</div>
</div>
<div class="silver-bk">
<form action="" method="post">
<table width="300" border="0" align="center">
  <tr>
    <td><b>�����:</b></td>
	<td align="center"><input type="text" name="admlogin" value="" /></td>
  </tr>
  <tr>
    <td><b>������:</b></td>
	<td align="center"><input type="password" name="admpass" value="" /></td>
  </tr>
  <tr>
	<td style="padding-top:5px;" align="center" colspan="2"><input type="submit" value="�����" /></td>
  </tr>
</table>
</form>
</div>