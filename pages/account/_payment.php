<script LANGUAGE="JavaScript1.1">document.oncontextmenu = function(){return false;};</script>
<?
//Проверяем Пост и Гет на ненужные символы
$arrs=array('_GET', '_POST');
foreach($arrs as $arr_key => $arr_value){
    if(is_array($$arr_value)){
        foreach($$arr_value as $key => $value){
            $nbz1=substr_count($value,'--');
            $nbz2=substr_count($value,'/*');
            $nbz3=substr_count($value,"'");
            $nbz4=substr_count($value,'"');
            if($nbz1>0 || $nbz2>0 || $nbz3>0 || $nbz4>0){
                print '<div class="error">Вы используете недопустимые

символы в '.str_replace('_','',$arr_value).'-запросе!<br><a

href="javascript:window.history.back();">Назад</a></div>';
                exit();
            }
        }
    }
}
?>
<div class="s-bk-lf">
	<div class="acc-title">Заказ выплаты</div>
</div>
<div class="silver-bk">

<?PHP
$_OPTIMIZATION["title"] = "Заказ выплаты";
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_users_a WHERE id = '$usid' LIMIT 1");
$user_dataa = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

$status_array = array( 0 => "Проверяется", 1 => "Выплачивается", 2 => "Отменена", 3 => "Выплачено");

# Минималка серебром!
$minPay = 101; 

?>
<b>Выплаты осуществляются в автоматическом режиме и только на платежную систему <a href="https://payeer.com/?partner=17201" target="_BLANK"><font color="blue">PAYEER!</font></a>! Процент при выводе составляет 0%</b> <BR /><BR />
<b>Из платежной системы Payeer Вы можете вывести свои средства в автоматическом режиме на все известные платежные системы и международные банки.</b><BR /><BR />
<b>Ссылки на учебные материалы:</b><BR />
- <a href="https://payeer.com/" target="_blank"><font color="blue">Создание счета в Payeer</font></a> <BR />
 - <a href="https://payeer.com/" target="_blank"><font color="blue">Вывод средств из payeer</font></a> <BR /><BR />
<?PHP
# Заглушка от халявщиков
if($user_data["insert_sum"] <= 9.99 AND $user_data["from_referals"] <= 0){

?>
<center><font color="red"><b>Выплату могут заказывать пользователи, которые пополнили баланс больше, чем на 10 RUB ! 
<br>У нас нет платежных баллов !<b></font></center><BR />
<BR />
<BR /><BR />
<div class="clr"></div>		
</div>
<?PHP

return;
}

?>
<center><b>Заказ выплаты:</b></center><BR />
<center><font color=red><b>ВНИМАНИЕ! ПОСЛЕ ПЕРВОЙ ВЫПЛАТЫ ИЗМЕНИТЬ НОМЕР КОШЕЛЬКА <font color = "blue">PAYEER</font> БУДЕТ НЕВОЗМОЖНО!!!!</b></font></center> <br>


<?PHP

function CheckPurse()
	{
		global $db;
		global $usid;
		$db->Query("SELECT * FROM `db_payment` WHERE `ps`='py' AND `user_id`='$usid'");
		$v = $db->FetchArray();
		if (empty($v["id"]))
			return FALSE;
		else
			return $v["purse"];
	}
	
	function ViewPurse($purse){
		
		if( substr($purse,0,1) != "P" ) return false;
		if( !preg_match("/^[0-9]{7,8}$/", substr($purse,1)) ) return false;	
		return $purse;
	}
	
	
	# Заносим выплату
	if(isset($_POST["purse"])){
	
		if(empty($user_data['purse'])) {
			$purse = ViewPurse($_POST["purse"]);
		}
		else
		{
			$purse = $user_data['purse'];
		}
		
		$sum = intval($_POST["sum"]);
		$val = "RUB";
		
		
		
			if($purse !== false){
				
					if($sum >= $minPay){
					
						if($sum <= $user_data["money_p"]){
							
							# Проверяем на существующие заявки
							$db->Query("SELECT COUNT(*) FROM db_payment WHERE user_id = '$usid' AND (status = '0' OR status = '1')");
							if($db->FetchRow() == 0){
									
									
								### Делаем выплату ###	
								$payeer = new rfs_payeer($config->AccountNumber, $config->apiId, $config->apiKey);
								if ($payeer->isAuth())
								{
									
									$arBalance = $payeer->getBalance();
									if($arBalance["auth_error"] == 0)
									{
										
										$sum_pay = round( ($sum / $sonfig_site["ser_per_wmr"]), 2);
										
										$balance = $arBalance["balance"]["RUB"]["DOSTUPNO"];
										if( ($balance) >= ($sum_pay+0)){
										
										
										
										$arTransfer = $payeer->transfer(array(
										'curIn' => 'RUB', // счет списания
										'sum' => $sum_pay, // сумма получения
										'curOut' => 'RUB', // валюта получения
										'to' => $purse, // получатель (email)
										//'to' => '+71112223344',  // получатель (телефон)
										//'to' => 'P1000000',  // получатель (номер счета)
										'comment' => iconv('windows-1251', 'utf-8', "Выплата пользователю {$usname} с проекта Time Money.win! Спасибо что вы снами, будем благодарны за отзывы о проекте!")
										//'anonim' => 'Y', // анонимный перевод
										//'protect' => 'Y', // протекция сделки
										//'protectPeriod' => '3', // период протекции (от 1 до 30 дней)
										//'protectCode' => '12345', // код протекции
										));
										
											if (!empty($arTransfer["historyId"]))
											{	
											
											
												# Снимаем с пользователя
												$db->Query("UPDATE db_users_b SET money_p = money_p - '$sum' WHERE id = '$usid'");
												
												# Вставляем запись в выплаты
												$da = time();
												$dd = $da + 60*60*24*15;
												
												$ppid = $arTransfer["historyId"];
												
												$db->Query("INSERT INTO db_payment (user, user_id, purse, sum, valuta, serebro, payment_id, date_add, status) 
												VALUES ('$usname','$usid','$purse','$sum_pay','RUB', '$sum','$ppid','".time()."', '3')");
												if(empty($user_data['purse'])) { 
							                    $db->Query("UPDATE db_users_b SET purse = '$purse' WHERE id = '$usid'");
						                        }
												$db->Query("UPDATE db_users_b SET payment_sum = payment_sum + '$sum_pay' WHERE id = '$usid'");
												$db->Query("UPDATE db_stats SET all_payments = all_payments + '$sum_pay' WHERE id = '1'");
												
												echo "<center><font color = 'green'><b>Выплачено!</b></font></center><BR />";
												
											}
											else
											{
											
												echo "<center><font color = 'red'><b>Заказ выплаты доступен раз в сутки!</b></font></center><BR />";	
											
											}
										
										
										}else echo "<center><font color = 'red'><b>Внутреняя ошибка - пожалуйста повторите!</b></font></center><BR />";
										
									}else echo "<center><font color = 'red'><b>Не удалось выплатить! Попробуйте позже</b></font></center><BR />";
									
								}else echo "<center><font color = 'red'><b>Не удалось выплатить! Попробуйте позже</b></font></center><BR />";
								
									
							}else echo "<center><font color = 'red'><b>У вас имеются необработанные заявки. Дождитесь их выполнения.</b></font></center><BR />";
								
							
						}else echo "<center><font color = 'red'><b>Вы указали больше, чем имеется на вашем счету</b></font></center><BR />";
					
					}else echo "<center><b><font color = 'red'>Минимальная сумма для выплаты составляет {$minPay} серебра!</font></b></center><BR />";
			
			}else echo "<center><b><font color = 'red'>Кошелек указан неверно! Смотрите образец!</font></b></center><BR />";
		
	}
?>

<form action="" method="post">
<table width="99%" border="0" align="center">
  <tr>
    <td><font color="#000;"><b>Введите кошелек Payeer [Пример: P1234567]</b></font>: </td>
<?php

	IF($sonfig_purse["purse"])
	{$pur=$sonfig_purse["purse"];
	echo"<td><input type='text' name='purse' size='15' value='".$pur."' readonly='readonly'";
	echo"</td>";
	}

	else echo"<td><input type='text' name='purse' size='15'/> </td>";


?>
	
	</td>
  </tr>
  <tr>
    <td><font color="#000;">Отдаете монеты для вывода</font> [Мин. 101]<font color="#000;">:</font> </td>
	<td><input type="text" name="sum" id="sum" value="0" size="15" onkeyup="PaymentSum();" /></td>
  </tr>
  <tr>
    <td><font color="#000;">Получаете [RUR]<span id="res_val"></span></font><font color="#000;">:</font> </td>
	<td>
	<input type="text" name="res" id="res_sum" value="0" size="15" disabled="disabled"/>
	<input type="hidden" name="per" id="RUB" value="<?=$sonfig_site["ser_per_wmr"]; ?>" disabled="disabled"/>
	<input type="hidden" name="per" id="min_sum_RUB" value="0.5" disabled="disabled"/>
	<input type="hidden" name="val_type" id="val_type" value="RUB" />
	</td>
  </tr>
  
 
  <tr>
    <td colspan="2" align="center"><input type="submit" name="swap" value="Заказать выплату" style="height: 30px; margin-top:10px;" /></td>
  </tr>
</table>
</form>
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  <tr>
    <td colspan="5" align="center"><h1>Ваши последние выплаты</h1></td>
    </tr>
  <tr>
    <td align="center" class="m-tb">Сумма</td>
	<td align="center" class="m-tb">Игрок</td>
	<td align="center" class="m-tb">Кошелек</td>
	<td align="center" class="m-tb">Статус</td>
  </tr>
  <?PHP
  
  $db->Query("SELECT * FROM db_payment WHERE user_id = '$usid' ORDER BY id DESC LIMIT 20");
  
	if($db->NumRows() > 0){
  
  		while($ref = $db->FetchArray()){
		
		?>
		<tr class="htt">
    		<td align="center"><?=$ref["sum"]; ?> RUB</td>
			<td align="center"><?=$ref["user"]; ?></td>
			<td align="center"><?=$ref["purse"]; ?></td>
    		<td align="center"><?=$status_array[$ref["status"]]; ?></td>
  		</tr>
		<?PHP
		
		}
  
	}else echo '<tr><td align="center" colspan="5">Нет записей</td></tr>'
  
  ?>

  
  
</table>

<div class="clr"></div>		
</div>