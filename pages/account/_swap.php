<div class="s-bk-lf">
	<div class="acc-title">��������</div>
</div>
<?PHP
$_OPTIMIZATION["title"] = "������� - ��������";
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_swap_ser WHERE user_id = '$usid' order by id DESC LIMIT 1");
$fromswap = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

###########
#���������#
###########
# ��������� ��������!
$minPay = 1000;
# ���������� ��������!
$maxPay = 10000; 
# ����������� ���-�� ����� ��� �����������.
$nd_time = 1; 
# ���� (1), ��� (0).
//$statswl = 0; 
?>  
<div class="silver-bk">� �������� ������ �� ������ �������� ������� ��� ������ �� ������� ��� �������. 
��� ������ ������� �� ��������� +<?=$sonfig_site["percent_swap"]; ?>% �� ���� ��� �������.<br /><br />
<center><font color="red">����� �������� ������ � ���� �������</font></p></center>


<?PHP
# ������ ������
if(isset($_POST["sum"])){

$sum = intval($_POST["sum"]);

    if ($fromswap["date_add"] <= time() - $nd_time * 86400) {

    	if($sum <= $maxPay){
	
			if($sum >= $minPay){
	
				if($user_data["money_p"] >= $sum){
		
				$add_sum = ($sonfig_site["percent_swap"] > 0) ? ( ($sonfig_site["percent_swap"] / 100) * $sum) + $sum : $sum;
		
				$ta = time();
				$td = $ta + 60*60*24*15;
		
				$db->Query("UPDATE db_users_b SET money_b = money_b + $add_sum, money_p = money_p - $sum WHERE id = '$usid'");
				$db->Query("INSERT INTO db_swap_ser (user_id, user, amount_b, amount_p, date_add, date_del) VALUES ('$usid','$usname','$add_sum','$sum','$ta','$td')");
		
				echo "<center><font color = 'green'><b>����� ����������</b></font></center><BR />";
		
				}else echo "<center><font color = 'red'><b>������������ ������� ��� ������</b></font></center><BR />";
	
			}else echo "<center><font color = 'red'><b>����������� ����� ��� ������ {$minPay} �������</b></font></center><BR />";
	
		}else echo "<center><font color = 'red'><b>������������ ����� ��� ������ {$maxPay} �������</b></font></center><BR />";
	
	}else echo "<center><font color = 'red'><b>����� ����� ��������� �� ���� {$nd_time} ���(a) � ����</b></font></center><BR />";

	
}
?>
<form action="" method="post">

<table width="400" border="0" align="center">
  <tr>
    <td><font color="#000;">������� ������� ��� ������</font> [���. 1000]: </td>
    <td align="center"><input type="text" class="lg" name="sum" id="sum" value="0" onkeyup="GetSumPer();" style="margin:0px; width:60px;"/></td>
  </tr>
  <tr>
    <td><font color="#000;">��������� ������� ��� �������</font> [+<?=$sonfig_site["percent_swap"]; ?>%]: </td>
    <td align="center"><span id="res_sum" name="res">0.00</span>
		<input type="hidden" name="per" id="percent" value="<?=$sonfig_site["percent_swap"]; ?>" disabled="disabled"/></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><BR /><input type="submit" name="swap" value="��������" class="button_0" style="height: 30px; margin-top:10px;" /></td>
  </tr>
</table>
</form>

<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
<tr>
	<style>
	a.knopka {
		color: #fff; /* ���� ������ */
		text-decoration: none; /* ������� ������������� � ������ */
		user-select: none; /* ������� ��������� ������ */
		background: rgb(212,75,56); /* ��� ������ */
		padding: .7em 1.5em; /* ������ �� ������ */
		outline: none; /* ������� ������ � Mozilla */
	} 
    a.knopka:hover { background: rgb(232,95,76); } /* ��� ��������� ������� ����� */
    a.knopka:active { background: rgb(152,15,0); } /* ��� ������� */

	.modalDialog {
		position: fixed;
		font-family: Arial, Helvetica, sans-serif;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		background: rgba(0,0,0,0.8);
		z-index: 99999;
		-webkit-transition: opacity 400ms ease-in;
		-moz-transition: opacity 400ms ease-in;
		transition: opacity 400ms ease-in;
		display: none;
		pointer-events: none;
	}

	.modalDialog:target {
		display: block;
		pointer-events: auto;
	}

	.modalDialog > div {
		width: 400px;
		position: relative;
		margin: 10% auto;
		padding: 5px 20px 13px 20px;
		border-radius: 10px;
		background: #fff;
		background: -moz-linear-gradient(#fff, #999);
		background: -webkit-linear-gradient(#fff, #999);
		background: -o-linear-gradient(#fff, #999);
	}

	.close {
		background: #606061;
		color: #FFFFFF;
		line-height: 25px;
		position: absolute;
		right: -12px;
		text-align: center;
		top: -10px;
		width: 24px;
		text-decoration: none;
		font-weight: bold;
		-webkit-border-radius: 12px;
		-moz-border-radius: 12px;
		border-radius: 12px;
		-moz-box-shadow: 1px 1px 3px #000;
		-webkit-box-shadow: 1px 1px 3px #000;
		box-shadow: 1px 1px 3px #000;
	}

	.close:hover { background: #00d9ff; }
	</style>

<center>
    <a href="#openModal" class="knopka">��������� ����������</a>

        <div id="openModal" class="modalDialog">
	        <div>
		        <a href="#close" title="�������" class="close"></a>
		        <h2>��������� ����������:</h2>
		        <p>��������: <?=$fromswap["amount_p"]; ?> ���.</p>
		        <p>�������: <?=$fromswap["amount_b"]; ?> ���.</p>
	        </div>
        </div>
</center>
<BR />
</tr>
   <tr>
    <td colspan="5" align="center"><h4>���� ��������� ������</h4></td>
   </tr>
    <tr>
    <td align="center" class="m-tb">�����</td>
	<td align="center" class="m-tb">�������</td>
	<td align="center" class="m-tb">����</td>
	<td align="center" class="m-tb">������</td>
  </tr>
  <?PHP
  
  $db->Query("SELECT * FROM db_swap_ser WHERE user_id = '$usid' ORDER BY id DESC LIMIT 10");
  
	if($db->NumRows() > 0){
  
  		while($bon = $db->FetchArray()){
		
		?>
		<tr class="htt">
    		<td align="center"><?=$bon["amount_p"]; ?></td>
    		<td align="center"><?=$bon["amount_b"]; ?></td>
			<td align="center"><?=date("d.m.Y",$bon["date_add"]); ?></td>
			<td align="center">��������</td>
  		</tr>
		<?PHP
		
		}
  
	}else echo '<tr><td align="center" colspan="5">��� ������� =(</td></tr>'
  ?>

  
</table>

</div>								
<div class="clr"></div>