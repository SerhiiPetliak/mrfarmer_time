<div class="s-bk-lf">
	<div class="acc-title">���� � ������� ������ �������</div>
</div>
<div class="silver-bk">
� ���� ������� �� ������ ������� � ������� ��� ����������� ������� �������. 
<br>��� �������� "�������" � "�������" �� ������� ���� � ���������� ����������� ������ �������. <br><br>
<?PHP
$_OPTIMIZATION["title"] = "���� � �������";
$usid = $_SESSION["user_id"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

	if(isset($_POST["sbor"])){

		if($user_data["last_sbor"] < (time() - 600) ){

			$tomat_s = $func->SumCalc($sonfig_site["a_in_h"], $user_data["a_t"], $user_data["last_sbor"]);
			$straw_s = $func->SumCalc($sonfig_site["b_in_h"], $user_data["b_t"], $user_data["last_sbor"]);
			$pump_s = $func->SumCalc($sonfig_site["c_in_h"], $user_data["c_t"], $user_data["last_sbor"]);
			$peas_s = $func->SumCalc($sonfig_site["d_in_h"], $user_data["d_t"], $user_data["last_sbor"]);
			$pean_s = $func->SumCalc($sonfig_site["e_in_h"], $user_data["e_t"], $user_data["last_sbor"]);
            $peanf_s = $func->SumCalc($sonfig_site["f_in_h"], $user_data["f_t"], $user_data["last_sbor"]);
		    $peang_s = $func->SumCalc($sonfig_site["g_in_h"], $user_data["g_t"], $user_data["last_sbor"]);	
			$peanh_s = $func->SumCalc($sonfig_site["h_in_h"], $user_data["h_t"], $user_data["last_sbor"]);
			
			$db->Query("UPDATE db_users_b SET
			a_b = a_b + '$tomat_s',
			b_b = b_b + '$straw_s',
			c_b = c_b + '$pump_s',
			d_b = d_b + '$peas_s',
			e_b = e_b + '$pean_s',
			f_b = f_b + '$peanf_s',
			g_b = g_b + '$peang_s',
			h_b = h_b + '$peanh_s',
			all_time_a = all_time_a + '$tomat_s',
			all_time_b = all_time_b + '$straw_s',
			all_time_c = all_time_c + '$pump_s',
			all_time_d = all_time_d + '$peas_s',
			all_time_e = all_time_e + '$pean_s',
			all_time_f = all_time_f + '$peanf_s',
			all_time_g = all_time_g + '$peang_s',
			all_time_h = all_time_h + '$peanh_s',
			last_sbor = '".time()."'
			WHERE id = '$usid' LIMIT 1");

			echo "<center><font color = 'green'><b>�� ������� ��� �������</b></font></center><BR />";

			$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
			$user_data = $db->FetchArray();

		}else echo "<center><font color = 'red'><b>������� ������� ����� �������� �� ���� 1�� ���� �� 10 �����</b></font></center><BR />";

	}



?>
<center><br><b>
<span style="color: #FF6600; font-family: cyrillichover; font-size: 15pt;text-shadow: #000 0 1px 1px;"><strong>����� �� ������ �������</strong></span></center></b>
<br>

<script type="text/javascript" src="https://yourjavascript.com/21139232152/bxslider.min.js"></script>
<script type="text/javascript" src="https://yourjavascript.com/11225442391/common.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery('#slider1').bxSlider({
  auto: true,           // true, false - �������������� ����� �������
  speed: 1000,      // ����� ����� - � ������������, �������� ����� �������
 pause: 55000,  // ����� ����� - � ������������, ������ ����� ������� �������
    });
  });
</script>
<?PHP
$_OPTIMIZATION["title"] = "���� � �������";
$usid = $_SESSION["user_id"];
$refid = $_SESSION["referer_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

# ������� ������ ������
if(isset($_POST["item"])){

$array_items = array(1 => "a_t", 2 => "b_t", 3 => "c_t", 4 => "d_t", 5 => "e_t", 6 => "f_t", 7 => "g_t", 8 => "h_t");
$array_name = array(1 => "������� 1", 2 => "������� 2", 3 => "������� 3", 4 => "������� 4", 5 => "������� 5", 6 => "������� 6", 7 => "������� 7", 8 => "������� 8");
$item = intval($_POST["item"]);
$citem = $array_items[$item];

	if(strlen($citem) >= 3){

		# ��������� �������� ������������
		$need_money = $sonfig_site["amount_".$citem];
		if($need_money <= $user_data["money_b"]){

			if($user_data["last_sbor"] == 0 OR $user_data["last_sbor"] > ( time() - 60*20) ){

				$to_referer = $need_money * 0.1;
				# ��������� ������ � ��������� ������
				$db->Query("UPDATE db_users_b SET money_b = money_b - $need_money, $citem = $citem + 1,
				last_sbor = IF(last_sbor > 0, last_sbor, '".time()."') WHERE id = '$usid'");

				# ������ ������ � �������
				$db->Query("INSERT INTO db_stats_btree (user_id, user, tree_name, amount, date_add, date_del)
				VALUES ('$usid','$usname','".$array_name[$item]."','$need_money','".time()."','".(time()+60*60*24*15)."')");

				echo "<center><font color = 'green'><b>�� ������� ������ ��������</b></font></center><BR />";

				$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
				$user_data = $db->FetchArray();

			}else echo "<center><font color = 'red'><b>����� ��� ��� �������� ����� ������� ������� ������� �������!</b></font></center><BR />";

		}else echo "<center><font color = 'red'><b>������������ ����� ��� �������</b></font></center><BR />";

	}else echo 222;

}

?>
<?PHP
# �������
if(isset($_POST["sell"])){

$all_items = $user_data["a_b"] + $user_data["b_b"] + $user_data["c_b"] + $user_data["d_b"] + $user_data["e_b"] + $user_data["f_b"] + $user_data["g_b"] + $user_data["h_b"];

	if($all_items > 0){
	
		$money_add = $func->SellItems($all_items, $sonfig_site["items_per_coin"]);
		
		$tomat_b = $user_data["a_b"];
		$straw_b = $user_data["b_b"];
		$pump_b = $user_data["c_b"];
		$pean_b = $user_data["d_b"];
		$peas_b = $user_data["e_b"];
		$peas_b = $user_data["f_b"];
		$peas_b = $user_data["g_b"];
		$peas_b = $user_data["h_b"];
		
		$money_b = ( (100 - $sonfig_site["percent_sell"]) / 100) * $money_add;
		$money_p = ( ($sonfig_site["percent_sell"]) / 100) * $money_add;
		
		# ��������� ������
		$db->Query("UPDATE db_users_b SET money_b = money_b + '$money_b', money_p = money_p + '$money_p', a_b = 0, b_b = 0, c_b = 0, d_b = 0, e_b = 0, f_b = 0, g_b = 0, h_b = 0 
		WHERE id = '$usid'");
		
		$da = time();
		$dd = $da + 60*60*24*15;
		
		# ��������� ������ � ����������
		$db->Query("INSERT INTO db_sell_items (user, user_id, a_s, b_s, c_s, d_s, e_s, f_s, g_s, h_s, amount, all_sell, date_add, date_del) VALUES 
		('$usname','$usid','$tomat_b','$straw_b','$pump_b','$pean_b','$peanf_b','$peang_b','$peanh_b','$peas_b','$money_add','$all_items','$da','$dd')");
		
		echo "<center><font color = 'green'><b>�� ������� {$all_items} ������, �� ����� {$money_add} �����</b></font></center><BR />";
		
		$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
		$user_data = $db->FetchArray();
		
	}else echo "<center><font color = 'red'><b>��� ������ ���������!</b></font></center><BR />";

}
?>
<div id="slider_cont">
<div id="slider1">

<div>

<!----><!---->
<center>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<!----><!---->
<td align="center">
<div class="fr-block3">
<div class="fr-te-gr-title"> <font color="#000000"; ><b>����� - ������� 1</b></font></div>
<div colspan="3"><img src="/img/fruit/kot.gif" name="slide_show"></div>

<!--<div id="example3" style=" display: none; ">-->
<center>

<div class="fr-te-gr"><b>����������:</b> <font color="#000000"><?=$user_data["a_t"]; ?> ��</font></div>
		
<div class="fr-te-gr"><b>��� �����: </b><font color="#000000"><?=$func->SumCalc($sonfig_site["a_in_h"], $user_data["a_t"], $user_data["last_sbor"]);?> </font></div>

		<div class="fr-te-gr"><b>��� �������: </b><font color="#000000"> <?=$func->SellItems($user_data["a_b"], $sonfig_site["items_per_coin"]); ?> </font></div>
</center>
<!--</div>-->


</td>
<!----><!---->

<!----><!---->
<td align="center">
<div class="fr-block3">
<div class="fr-te-gr-title"><font color="#000000"><b>����� - ������� 2</b></font></div>

<div colspan="3"><img src="/img/fruit/kot.gif" name="slide_show2"></div>

<!--<div id="example4" style=" display: none; ">-->
<center>

<div class="fr-te-gr"><b>����������:</b> <font color="#000000"><?=$user_data["b_t"]; ?> ��</font></div>

		<div class="fr-te-gr"><b>��� �����: </b><font color="#000000"><?=$func->SumCalc($sonfig_site["b_in_h"], $user_data["b_t"], $user_data["last_sbor"]);?> </font></div>
		

		<div class="fr-te-gr"><b>��� �������:</b><font color="#000000"> <?=$func->SellItems($user_data["b_b"], $sonfig_site["items_per_coin"]); ?> </font></div>	</div>

</center>
<!--</div>-->

</td>
<!----><!---->


<!----><!---->
<td align="center">
<div class="fr-block3">
<div class="fr-te-gr-title"><font color="#000000"><b>����� - ������� 3</b></font></div>
<div colspan="3"><img src="/img/fruit/kot.gif" name="slide_show2"></div>

<!--<div id="example4" style=" display: none; ">-->
<center>
		
		<div class="fr-te-gr"><b>����������:</b> <font color="#000000"><?=$user_data["c_t"]; ?> ��</font></div>

<div class="fr-te-gr"><b>��� �����: </b><font color="#000000"><?=$func->SumCalc($sonfig_site["c_in_h"], $user_data["c_t"], $user_data["last_sbor"]);?> </font></div>

		<div class="fr-te-gr"><b>��� �������:</b><font color="#000000"> <?=$func->SellItems($user_data["c_b"], $sonfig_site["items_per_coin"]); ?> </font></div>	</div>

</center>
<!--</div>-->

</td>
<!----><!---->


<!----><!---->
<td align="center">
<div class="fr-block3">
<div class="fr-te-gr-title"><font color="#000000"><b>����� - ������� 4</b></font></div>
<div colspan="3"><img src="/img/fruit/kot.gif" name="slide_show2"></div>

<!--<div id="example4" style=" display: none; ">-->
<center>
		
		<div class="fr-te-gr"><b>����������:</b> <font color="#000000"><?=$user_data["d_t"]; ?> ��</font></div>

<div class="fr-te-gr"><b>��� �����: </b><font color="#000000"><?=$func->SumCalc($sonfig_site["d_in_h"], $user_data["d_t"], $user_data["last_sbor"]);?> </font></div>

		<div class="fr-te-gr"><b>��� �������:</b><font color="#000000"> <?=$func->SellItems($user_data["d_b"], $sonfig_site["items_per_coin"]); ?> </font></div>	</div>

</center>
<!--</div>-->


</td>
<!----><!----> 
</tr>
</table>
 </div>




<div>

<!----><!---->
<center>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<!----><!---->
<td align="center">
<div class="fr-block3">
<div class="fr-te-gr-title"> <font color="#000000"; ><b>����� - ������� 5</b></font></div>
<div colspan="3"><img src="/img/fruit/kot.gif" name="slide_show"></div>

<!--<div id="example3" style=" display: none; ">-->
<center>

<div class="fr-te-gr"><b>����������:</b> <font color="#000000"><?=$user_data["e_t"]; ?> ��</font></div>

<div class="fr-te-gr"><b>��� �����: </b><font color="#000000"><?=$func->SumCalc($sonfig_site["e_in_h"], $user_data["e_t"], $user_data["last_sbor"]);?> </font></div>
		<div class="fr-te-gr"><b>��� �������: </b><font color="#000000"> <?=$func->SellItems($user_data["e_b"], $sonfig_site["items_per_coin"]); ?> </font></div>	</div>

</center>
<!--</div>-->


</td>
<!----><!---->
<!----><!---->
<td align="center">
<div class="fr-block3">
<div class="fr-te-gr-title"> <font color="#000000"; ><b>����� - ������� 6</b></font></div>
<div colspan="3"><img src="/img/fruit/kot.gif" name="slide_show"></div>

<!--<div id="example3" style=" display: none; ">-->
<center>

<div class="fr-te-gr"><b>����������:</b> <font color="#000000"><?=$user_data["f_t"]; ?> ��</font></div>

<div class="fr-te-gr"><b>��� �����: </b><font color="#000000"><?=$func->SumCalc($sonfig_site["f_in_h"], $user_data["f_t"], $user_data["last_sbor"]);?> </font></div>
		<div class="fr-te-gr"><b>��� �������: </b><font color="#000000"> <?=$func->SellItems($user_data["f_b"], $sonfig_site["items_per_coin"]); ?> </font></div>	</div>

</center>
<!--</div>-->


</td>
<!----><!---->
<!----><!---->
<td align="center">
<div class="fr-block3">
<div class="fr-te-gr-title"> <font color="#000000"; ><b>����� - ������� 7</b></font></div>
<div colspan="3"><img src="/img/fruit/kot.gif" name="slide_show"></div>

<!--<div id="example3" style=" display: none; ">-->
<center>

<div class="fr-te-gr"><b>����������:</b> <font color="#000000"><?=$user_data["g_t"]; ?> ��</font></div>

<div class="fr-te-gr"><b>��� �����: </b><font color="#000000"><?=$func->SumCalc($sonfig_site["g_in_h"], $user_data["g_t"], $user_data["last_sbor"]);?> </font></div>
		<div class="fr-te-gr"><b>��� �������: </b><font color="#000000"> <?=$func->SellItems($user_data["g_b"], $sonfig_site["items_per_coin"]); ?> </font></div>	</div>

</center>
<!--</div>-->


</td>
<!----><!---->
<!----><!---->
<td align="center">
<div class="fr-block3">
<div class="fr-te-gr-title"> <font color="#000000"; ><b>����� - ������� 8</b></font></div>
<div colspan="3"><img src="/img/fruit/kot.gif" name="slide_show"></div>

<!--<div id="example3" style=" display: none; ">-->
<center>

<div class="fr-te-gr"><b>����������:</b> <font color="#000000"><?=$user_data["h_t"]; ?> ��</font></div>

<div class="fr-te-gr"><b>��� �����: </b><font color="#000000"><?=$func->SumCalc($sonfig_site["h_in_h"], $user_data["h_t"], $user_data["last_sbor"]);?> </font></div>
		<div class="fr-te-gr"><b>��� �������: </b><font color="#000000"> <?=$func->SellItems($user_data["h_b"], $sonfig_site["items_per_coin"]); ?> </font></div>	</div>

</center>
<!--</div>-->


</td>
<!----><!---->

</tr>
</table>
 </div>




</div>

<center>
<table><tr><td>
<form action="" method="post">
		<input type="hidden" name="sbor" value="1" />
		<input type="submit" value="������� ���" style="height: 30px; margin-top:10px;" class="btn_8" />	
	</form>
	</td><td>
	<form action="" method="post">
		<input type="hidden" name="sell" value="1" />
		<input type="submit" value="������� ���" style="height: 30px; margin-top:10px;" class="btn_8" />	
	</form></td></tr></table></center>
	
	
	���������� � ������� ������ �������������� ����� ����� ������� (���� ��� ������� � ���� 
��� ������) � ����������: <?=100-$sonfig_site["percent_sell"]; ?>% �� ���� ��� ������� � <?=$sonfig_site["percent_sell"]; ?>% �� �����.<br /><br />
<b>���� ������� ������ �������: <font color="#ffffff"><?=$sonfig_site["items_per_coin"]; ?> ������ = 1 ������.</font></b>
<p>
<b>��������� ������ ��� �����: <font color="#ffffff"><?=$func->SumCalc($sonfig_site["a_in_h"], $user_data["a_t"], $user_data["last_sbor"])+$func->SumCalc($sonfig_site["b_in_h"], $user_data["b_t"], $user_data["last_sbor"])+$func->SumCalc($sonfig_site["c_in_h"], $user_data["c_t"], $user_data["last_sbor"])+$func->SumCalc($sonfig_site["d_in_h"], $user_data["d_t"], $user_data["last_sbor"])+$func->SumCalc($sonfig_site["e_in_h"], $user_data["e_t"], $user_data["last_sbor"])+$func->SumCalc($sonfig_site["f_in_h"], $user_data["f_t"], $user_data["last_sbor"])+$func->SumCalc($sonfig_site["g_in_h"], $user_data["g_t"], $user_data["last_sbor"])+$func->SumCalc($sonfig_site["h_in_h"], $user_data["h_t"], $user_data["last_sbor"])?> ������</font></b>
<p>
<b>��������� ������ ��� �������: <font color="#ffffff"><?=$user_data

["a_b"]+$user_data["b_b"]+$user_data["c_b"]+$user_data["d_b"]+$user_data["e_b"]+$user_data["f_b"]+$user_data["g_b"]+$user_data["h_b"];?> ������</font></b>
</div>
<?php $life_time->GetTable($usid); ?>

<style>
/* ���������� � ������ ����� */
#slider_cont {
    border: 0px solid #006699;
    margin: 0px;
    width: 900px!important;
    padding: 0px;
}

/* ������ ��������� ����������� */
.bx-prev {
position:absolute;
top:39%;
left:-10px;
width:40px;
height:61px;;
text-indent:-999999px;
background:url(/img/prev.png) no-repeat  0 0px;
}

/* ������ ���������� ����������� */
.bx-next {
position:absolute;
top:39%;
right:-10px;
width:40px;
height:61px;
text-indent:-999999px;
background:url(/img/next.png) no-repeat 0 0px;
}

/* ��� ������ ��� ��������� ������� */
.bx-next:hover {
background:url(/img/next1.png) no-repeat 0 0px;
border:0; 
}
/* ��� ������ ��� ��������� ������� */
.bx-prev:hover {
background:url(/img/prev1.png) no-repeat  0 0px;
border:0;
}
</style>





<div class="clr"></div>
</div>



<div class="clr"></div>


							<div class="clr"></div>
							