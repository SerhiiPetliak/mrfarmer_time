<?PHP
$_OPTIMIZATION["title"] = "�������";
$user_id = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.id = '$user_id'");
$prof_data = $db->FetchArray();
$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();
?>
								<div class="s-bk-lf">
									<div class="acc-title">��� �������</div>
								</div>
								<div class="silver-bk">
								<p><center>���� ���� �����������: <font color="#000;"><?=date("d.m.Y � H:i:s",$prof_data["date_reg"]); ?></font></center></p>
								
  <p>
<center>
<p><?if(empty($prof_data['ava'])) {
echo '<center><img src="/img/c50.gif"></center>';
}else{
echo '<center><img src="/'.$prof_data['ava'].'"></center>';
}
?></p>
</center>							

<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr><td colspan="2" align="center">&nbsp;</td></tr>
  <tr>
    <td align="left" style="padding:3px;">ID</td>
    <td align="left" style="padding:3px;"><font color="#000;"><?=$prof_data["id"]; ?></font></td>
  </tr>
  <tr>
    <td align="left" style="padding:3px;">���������</td>
    <td align="left" style="padding:3px;"><font color="#000;"><?=$prof_data["user"]; ?></font></td>
  </tr>
  <tr>
    <td align="left" style="padding:3px;">Email</td>
    <td align="left" style="padding:3px;"><font color="#000;"><?=$prof_data["email"]; ?></font></td>
  </tr>
  <tr>
    <td align="left" style="padding:3px;">������ (��� �������)</td>
    <td align="left" style="padding:3px;"><font color="#000;"><?=sprintf("%.2f",$prof_data["money_b"]); ?> �����</font></td>
  </tr>
  <tr>
    <td align="left" style="padding:3px;">������ (�� �����)</td>
    <td align="left" style="padding:3px;"><font color="#000;"><?=sprintf("%.2f",$prof_data["money_p"]); ?> �����</font> [<a href="/account/withdraw.html"><font color="blue">�������</font></a>]</td>
  </tr>
  <tr>
    <td align="left" style="padding:3px;">���������� �� ���������</td>
    <td align="left" style="padding:3px;"><font color="#000;"><?=sprintf("%.2f",$prof_data["from_referals"]); ?> �����</font></td>
  </tr>
    <tr>
    <td align="left" style="padding:3px;">���������</td>
    <td align="left" style="padding:3px;"><font color="#000;"><?=sprintf("%.2f",$prof_data["payment_sum"]); ?> <?=$config->VAL; ?></font></td>
  </tr>
  <tr align="left">
    <td colspan="2" style="padding:3px;">&nbsp;</td>
    </tr>
  <tr>
    <td align="left" style="padding:3px;">��� ���������:</td>
    <td align="left" style="padding:3px;"><font color="#000;"><?=$prof_data["referer"]; ?> ��� ID <?=$prof_data["referer_id"]; ?></font></td>
  </tr>
  
</table>
<br>
<center><table border='0' align="center" class="ta" width="40%"><tr>

<td>
<a href="/account/referals"><button class="btn_in" type="button">��������</button></a>
</td>

<td>
<a href="/account/config"><button class="btn_in" type="button">���������</button></a>
</td>
</tr></table></center>

								<div class="clr"></div>	
								</div>