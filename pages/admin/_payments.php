<div class="s-bk-lf">
	<div class="acc-title">Список выплат на Payeer</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<center><a href="/?menu=admin4ik&sel=payments&payeer"><font color="#000000">Заявки на выплату</a></font> || <a href="/?menu=admin4ik&sel=payments"><font color="#000000">Выплачено</a></font> || <a href="/?menu=admin4ik&sel=payments&balance"><font color="#000000">Баланс на Payeer</a></font> ||
<a href="/?menu=admin4ik&sel=payments&list_day"><font color="#000000">По дням</a></font> || <a href="/?menu=admin4ik&sel=payments&last_31"><font color="#000000">График за 30 дней</a></font></center><BR />
<?PHP
# График
if(isset($_GET["last_31"])){
	
	$dlim = time() - 60*60*24*30;
	$db->Query("SELECT * FROM db_payment WHERE date_add > $dlim ORDER BY id DESC");
	
	$days_money = array();
	$days_insert = array();
	
	if($db->NumRows() > 0){
		
		while($data = $db->FetchArray()){
		$index = date("d.m.Y", $data["date_add"]);
		
			$days_money[$index] = (isset($days_money[$index])) ? $days_money[$index] + $data["sum"] : $data["sum"];
			$days_insert[$index] = (isset($days_insert[$index])) ? $days_insert[$index] + 1 : 1;
			
		}
	
	# Вывод
	if(count($days_money) > 0){
		
		$array_for_chart = array();
		$array_for_chart2 = array();
		$array_for_chart3 = array();
		
			foreach($days_money as $date => $sum){
			
				$array_for_chart[] = "['".$date."', ".round($sum)."]";
				$array_for_chart2[] = "['".$date."', ".$days_insert[$date]."]";
				$array_for_chart3[] = "['".$date."', ".round($sum / $days_insert[$date], 2)."]";
			
			}
			
			$retd = implode(", ", array_reverse($array_for_chart));
			$retd2 = implode(", ", array_reverse($array_for_chart2));
			$retd3 = implode(", ", array_reverse($array_for_chart3));
			
		?>

	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['День', 'Сумма'],
          <?=$retd; ?>
        ]);

        var options = {
          title: 'История Выплат (Сумма)',
          hAxis: {title: 'Last 30 Days',  titleTextStyle: {color: 'green'}}
        };

        var chart = new google.visualization.SteppedAreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
	<div id="chart_div" style="width: 100%; height: 500px;"></div>
	
	<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart2);
      function drawChart2() {
        var data2 = google.visualization.arrayToDataTable([
          ['День', 'Кол-во'],
          <?=$retd2; ?>
        ]);

        var options2 = {
          title: 'История Выплат (Кол-во)',
          hAxis: {title: 'Last 30 Days',  titleTextStyle: {color: 'green'}}
        };

        var chart2 = new google.visualization.SteppedAreaChart(document.getElementById('chart_div2'));
        chart2.draw(data2, options2);
      }
    </script>
	<div id="chart_div2" style="width: 100%; height: 500px;"></div>
	<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart3);
      function drawChart3() {
        var data3 = google.visualization.arrayToDataTable([
          ['День', 'Сумма'],
          <?=$retd3; ?>
        ]);

        var options3 = {
          title: 'AVG (Сумма / Кол-во)',
          hAxis: {title: 'Last 30 Days',  titleTextStyle: {color: 'green'}}
        };

        var chart3 = new google.visualization.SteppedAreaChart(document.getElementById('chart_div3'));
        chart3.draw(data3, options3);
      }
    </script>
	<div id="chart_div3" style="width: 100%; height: 500px;"></div>
	
	
		<?PHP
		
	}
	
	}else echo "<center><b>Записей нет</b></center><BR />";
	
	
	
?></div><div class="clr"></div>	<?PHP
return;
}

//Выплачено
if(isset($_POST["payment"])){

	$ret_id = intval($_POST["payment"]);
	$db->Query("SELECT * FROM db_payment WHERE status = '0' AND id = '{$ret_id}'");

	if($db->NumRows() == 1){

		$ret_data = $db->FetchArray();

		$user_id = $ret_data["user_id"];
		$sum = $ret_data["sum"];

		$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
		$sonfig_site = $db->FetchArray();
		$res_sum = $sum * $sonfig_site["ser_per_wmr"];

		$serebro = $ret_data["serebro"];

		$db->Query("UPDATE db_users_b SET money_p = ABS(money_p - '$res_sum'), payment_sum = payment_sum + '$sum' WHERE id = '$user_id'");

		$db->Query("UPDATE db_payment SET status = '3' WHERE id = '$ret_id'");
		$db->Query("UPDATE db_stats SET all_payments = all_payments + '$sum' WHERE id = '1'");


		echo "<center><b>Выплачено, статистика обновлена</b></center><BR />";

	}else echo "<center><b>Заявка не найдена :(</b></center><BR />";
	header("Location: ".$_SERVER["REQUEST_URI"]);
	exit;
}

// Возврат
if(isset($_POST["return"])){

	$ret_id = intval($_POST["return"]);
	$db->Query("SELECT * FROM db_payment WHERE status = '0' AND id = '{$ret_id}'");

	if($db->NumRows() == 1){

		$ret_data = $db->FetchArray();

		$user_id = $ret_data["user_id"];
		$sum = $ret_data["sum"];
		$serebro = $ret_data["serebro"];

		$db->Query("UPDATE db_payment SET status = '2' WHERE id = '$ret_id'");

		echo "<center><b>Заявка отменена, средства возвращены</b></center><BR />";

	}else{
		echo "<center><b>Заявка не найдена :(</b></center><BR />";
	}
	header("Location: ".$_SERVER["REQUEST_URI"]);
	exit;
}


if(isset($_GET['payeer'])){

	$db->Query("SELECT * FROM db_payment ORDER BY date_add DESC LIMIT 50");
	$ast = $db->NumRows();
	if($ast > 0){
?>
		<table cellpadding='3' class="admin_pay_table" cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
			<tr bgcolor="#efefef">
				<td align="center" width="75" class="m-tb">Логин</td>
				<td align="center" width="75" class="m-tb">Сумма</td>
				<td align="center" width="100" class="m-tb">Кошелек</td>
				<td align="center" width="50" class="m-tb">Дата</td>
				<td align="center" width="100" class="m-tb">Статус</td>
			</tr>

			<?php

			while($data = $db->FetchArray()){

				?>
				<tr class="htt">
					<td align="center"><a href="/?menu=admin4ik&sel=users&edit=<?=$data["user_id"]; ?>"><?=$data["user"]; ?></td>
					<td align="center"><?=$data["serebro"]; ?></td>
					<td align="center"><?=$data["purse"]; ?></td>
					<td align="center"><?= date("d/m/Y", $data["date_add"]);  ?> </td>
					<td align="center">


						<?php
						switch ($data["status"]){
							case 0:
								?>
								<div class="admin_pay_action_buttons" method="post">
									<form class="admin_pay_action_refuse" method="post">
										<input type="hidden" class="admin_pay_action_refuse_return" name="return" value="<?=$data["id"]; ?>" />
										<input type="submit" class="button-green3" value="Отказать" />
									</form>

									<form class="admin_pay_action_pay" method="post">
										<input type="hidden" class="admin_pay_action_pay_payment" name="payment" value="<?=$data["id"]; ?>" />
										<input type="submit" class="button-green3" value="Выплатить" />
									</form>
								</div>
								<?php

								break;
							case 2:
								echo "Отказано";
								break;
							case 3:
								echo "Выплачено";
								break;
							default:
								echo "Выплачивается";
								break;
						}
						?>

					</td>
				</tr>
				<?PHP

			}

			?>

		</table>
		<?PHP

	}else echo "<center><b>Нет заявок для выплаты</b></center><BR />";

	?>
	</div>
	<div class="clr"></div>
<?php

	return;
}

# Вывод статистики по дням
if(isset($_GET["list_day"])){

	$db->Query("SELECT * FROM db_payment ORDER BY id DESC");
	
	$days_money = array();
	$days_insert = array();
	
	if($db->NumRows() > 0){
		
		while($data = $db->FetchArray()){
		$index = date("d.m.Y", $data["date_add"]);
		
			$days_money[$index] = (isset($days_money[$index])) ? $days_money[$index] + $data["sum"] : $data["sum"];
			$days_insert[$index] = (isset($days_insert[$index])) ? $days_insert[$index] + 1 : 1;
			
		}
	
	# Вывод
	if(count($days_money) > 0){
	
		?>
		<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
		  <tr bgcolor="#efefef">
			<td align="center" class="m-tb">Дата</td>
			<td align="center" class="m-tb">Выплат</td>
			<td align="center" class="m-tb">На сумму</td>
			<td align="center" class="m-tb">AVG</td>
		  </tr>
		<?PHP
		
		$array_for_chart = array();
		
			foreach($days_money as $date => $sum){
			
				?>
				<tr class="htt">
					<td align="center"><b><?=$date; ?></b></td>
					<td align="center"><?=$days_insert[$date]; ?> шт.</td>
					<td align="center"><?=$sum; ?> <?=$config->VAL;?></td>
					<td align="center"><?=round($sum/$days_insert[$date],2); ?> <?=$config->VAL;?></td>
				</tr>
				<?PHP
				
			}
			
		?>
		</table>
		<?PHP
		
	}
	
	}else echo "<center><b>Записей нет</b></center><BR />";
	
	
	
?></div><div class="clr"></div>	<?PHP
return;
}

# Проверка баланса Payeer
if(isset($_GET["balance"])){

$payeer = new rfs_payeer($config->AccountNumber, $config->apiId, $config->apiKey);
	if ($payeer->isAuth())
	{
		
		$arBalance = $payeer->getBalance();
		echo "<pre>".print_r($arBalance, true)."</pre>";	
	
	}
	
?></div><div class='clr'></div><?PHP

return;			
}	



$num_p = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"]) -1) : 0;
$lim = $num_p * 100;

$db->Query("SELECT * FROM db_payment ORDER BY id DESC LIMIT {$lim}, 100");

function colorSum($sum){

	if($sum >= 100) return "red";
	return "#000000";
}

if($db->NumRows() > 0){

?>
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  <tr bgcolor="#efefef">
    <td align="center" width="50" class="m-tb">User</td>
	<td align="center" width="50" class="m-tb">Serebro</td>
	<td align="center" width="50" class="m-tb">Money</td>
	<td align="center" width="50" class="m-tb">Purse</td>
	<td align="center" width="50" class="m-tb">Date</td>
  </tr>


<?PHP

	while($data = $db->FetchArray()){
	
	?>
	<tr class="htt">
	<td align="center"><a href="/?menu=admin4ik&sel=users&edit=<?=$data["user_id"]; ?>" class="stn"><?=$data["user"]; ?></a></td>
    <td align="center"><?=$data["serebro"]; ?></td>
    
	
	
    <td align="center"><font color="<?=colorSum($data["sum"]); ?>"><?=sprintf("%.2f",$data["sum"]); ?> <?=$data["valuta"]; ?></font></td>
	<td align="center"><?=$data["purse"]; ?></td>
	<td align="center"><?=date("d.m H:i:s",$data["date_add"]); ?></td>
  	</tr>
	<?PHP
	
	}

?>

</table>
<BR />
<?PHP


}else echo "<center><b>На данной странице нет записей</b></center><BR />";

	
$db->Query("SELECT COUNT(*) FROM db_payment");
$all_pages = $db->FetchRow();

	if($all_pages > 100){
	
	$sort_b = (isset($_GET["sort"])) ? intval($_GET["sort"]) : 0;
	
	$nav = new navigator;
	$page = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"])) : 1;
	
	echo "<BR /><center>".$nav->Navigation(10, $page, ceil($all_pages / 100), "/?menu=admin4ik&sel=payments&page="), "</center>";
	
	}
?>
</div><div class='clr'></div>
