<div class="s-bk-lf">
	<div class="acc-title">���������� �������</div>
</div>
<?
//��������� ���� � ��� �� �������� �������
$arrs=array('_GET', '_POST');
foreach($arrs as $arr_key => $arr_value){
    if(is_array($$arr_value)){
        foreach($$arr_value as $key => $value){
            $nbz1=substr_count($value,'--');
            $nbz2=substr_count($value,'/*');
            $nbz3=substr_count($value,"'");
            $nbz4=substr_count($value,'"');
            if($nbz1>0 || $nbz2>0 || $nbz3>0 || $nbz4>0){
                print '<div class="error">�� ����������� ������������

������� � '.str_replace('_','',$arr_value).'-�������!<br><a

href="javascript:window.history.back();">�����</a></div>';
                exit();
            }
        }
    }
}
?>
<?PHP
$_OPTIMIZATION["title"] = "���������� �������";
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

/*
if($_SESSION["user_id"] != 1){
echo "<center><b><font color = red>����������� ������</font></b></center>";
return;
}
*/
?>

<div class="silver-bk">
<BR />
<br>
<center><font color=orange> <img title='Payeer' src='/img/Payeer1.gif'></font><br></center>
<br>
<center>
���� ������� ������: 1 ����� (<?=$config->VAL; ?>) = <?=$sonfig_site["ser_per_wmr"]; ?> �������.
���� ������� ��������� ������������� ���������� ������� ������� � ������� ��������� ��������� 
������: Yandex ������, QIWI, Payeer, Perfect Money, �������� ��������� � �.�.
������ � ���������� ����� �� ������ ������������ � �������������� ������.
������� ����� � ������, ������� �� ������ ��������� �� ������. 
����� ���������� ��� ����� ��������� �������. 
<BR />
<BR />
<br><font color="red"><b>��� ������ ���������� +50% � �������!</b></font></font>
<br><font color="red"><b>��� ���������� ����� 100 ������ +10% � �������!</b></font></font>
<br><font color="red"><b>��� ���������� ����� 1000 ������ +15% � �������!</b></font></font>
<br><font color="red"><b>��� ���������� ����� 5000 ������ +20% � �������!</b></font></font>
<br><font color="red"><b>��� ���������� ����� 10000 ������ +25% � �������!</b></font></font>
<BR />
<BR />
</center>
<?
/// db_payeer_insert
if(isset($_POST["sum"])){

$sum = round(floatval($_POST["sum"]),2);


# ������� � ��
$db->Query("INSERT INTO db_payeer_insert (user_id, user, sum, date_add) VALUES ('".$_SESSION["user_id"]."','".$_SESSION["user"]."','$sum','".time()."')");

$desc = base64_encode($_SERVER["HTTP_HOST"]." - USER ".$_SESSION["user"]);
$m_shop = $config->shopID;
$m_orderid = $db->LastInsert();
$m_amount = number_format($sum, 2, ".", "");
$m_curr = "RUB";
$m_desc = $desc;
$m_key = $config->secretW;

$arHash = array(
 $m_shop,
 $m_orderid,
 $m_amount,
 $m_curr,
 $m_desc,
 $m_key
);
$sign = strtoupper(hash('sha256', implode(":", $arHash)));

?>
<center>
<form method="GET" action="//payeer.com/api/merchant/m.php">
	<input type="hidden" name="m_shop" value="<?=$config->shopID; ?>">
	<input type="hidden" name="m_orderid" value="<?=$m_orderid; ?>">
	<input type="hidden" name="m_amount" value="<?=number_format($sum, 2, ".", "")?>">
	<input type="hidden" name="m_curr" value="RUB">
	<input type="hidden" name="m_desc" value="<?=$desc; ?>">
	<input type="hidden" name="m_sign" value="<?=$sign; ?>">
	<input type="submit" name="m_process" value="�������� � �������� �������" />
</form>
</center>
<h3 style="border-top: solid 1px #fff; padding-top: 10px;"></h3>
<div class="clr"></div>
</div>
<?PHP

return;
}
?>
<script type="text/javascript">
var min = 0.01;
var ser_pr = 100;
function calculate(st_q) {

	var sum_insert = parseFloat(st_q);
	$('#res_sum').html( (sum_insert * ser_pr).toFixed(0) );


}

</script>
<center>
<div id="error3"></div>
<form method="POST" action="">
    <input type="hidden" name="m" value="<?=$fk_merchant_id?>">
������� ����� [<?=$config->VAL; ?>]:
<input type="text" value="100" name="sum" size="7" id="psevdo" onchange="calculate(this.value)" onkeyup="calculate(this.value)" onfocusout="calculate(this.value)" onactivate="calculate(this.value)" ondeactivate="calculate(this.value)">

    �� �������� <span id="res_sum">10000</span> �������
	<BR /><BR />
    <input type="submit" id="submit" value="��������� ������" class="btn_9">
</form>
<script type="text/javascript">
calculate(100);
</script>

<h3 style="border-top: solid 1px #fff; padding-top: 10px;"><a href="/account/swap" class="btn_9">�������� �������</a>
<a href="https://www.bestchange.ru/?p=12525" class="btn_9" target="_blank">�������� ������</a>
</h3>




