<?PHP
######################################
# ������ Fruit Farm
# ����� Rufus
# ICQ: 819-374
# Skype: Rufus272
######################################
$_OPTIMIZATION["title"] = "�������";
$_OPTIMIZATION["description"] = "����� ������� �������";
$_OPTIMIZATION["keywords"] = "�������, ������� ������������, ������� �������";
?>
<div class="s-bk-lf">
	<div class="acc-title">������� �������</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<?PHP

$db->Query("SELECT rules FROM db_conabrul WHERE id = '1'");
$xt = $db->FetchRow();
echo $xt;
?>
</div>
<div class="clr"></div>	