<div class="s-bk-lf">
	<div class="acc-title">О проекте</div>
</div>
<div class="silver-bk">	
<span style="color: #00aed2; font-family: cyrillichover; font-size: 15pt;text-shadow: #000 0 1px 1px;"><strong><font color = "red">Добро пожаловать на проект</font> </strong></span>
<center><b>
<span style="color: #00aed2; font-family: cyrillichover; font-size: 15pt;text-shadow: #000 0 1px 1px;"><strong><font color = "red">Действующие Акции Проекта:</font> </strong></span></center></b>
<br>
<center>
<table border="0">
<tbody>

<tr>
<td>

<div class="bko">

<span style="color: #FFC400; font-family: cyrillichover; margin-top: 10px;font-size: 14pt;text-shadow: #000 0 1px 1px;"><strong>При первом пополнении<font color = "red"> +10 %</font>  в подарок!</br></strong></span></br>
<span style="color: #FFC400; font-family: cyrillichover; margin-top: 10px;font-size: 14pt;text-shadow: #000 0 1px 1px;"><strong>Сразу после регистрации<font color = "red"> +10 рублей</font>  в подарок!</br></strong></span></br>
<span style="color: #00aed2; font-family: cyrillichover; margin-top: 10px;font-size: 14pt;text-shadow: #000 0 1px 1px;"><strong><font color = "red">АКЦИЯ:</font> При каждом пополнении свыше 100 руб.</br> + 10% в подарок!</br></strong></span>
<span style="color: #00aed2; font-family: cyrillichover; margin-top: 10px;font-size: 14pt;text-shadow: #000 0 1px 1px;"><strong><font color = "red">АКЦИЯ:</font> При каждом пополнении свыше 1000 руб. + 15% в подарок!</strong></span></br>
<span style="color: #00aed2; font-family: cyrillichover; margin-top: 10px;font-size: 14pt;text-shadow: #000 0 1px 1px;"><strong><font color = "red">АКЦИЯ:</font> При каждом пополнении свыше 5000 руб. + 20% в подарок!</strong></span></br>
<span style="color: #00aed2; font-family: cyrillichover; margin-top: 10px; font-size: 14pt;text-shadow: #000 0 1px 1px;"><strong><font color = "red">АКЦИЯ:</font> При каждом пополнении свыше 10000 руб. + 25% в подарок!</br></strong></span>
<center><span style="color: #5CD216; font-family: cyrillichover; margin-top: 10px;font-size: 14pt;text-shadow: #000 0 1px 1px;"><strong>Реферальная программа<font color = "red"> 10%</font> на вывод!</br></strong></span></center>
<center>&nbsp; &nbsp;<span style="color: #5CD216; font-family: cyrillichover; margin-top: 10px;font-size: 14pt;text-shadow: #000 0 1px 1px;"><strong>За регистрацию реферала<font color = "red"> 50 монет</font> на покупки!</br></strong></span></center>
 
</div>

</td>
</tr>

</tbody>
</table>
</center>
<hr>
<center><br><b>
<span style="color: #FF6600; font-family: cyrillichover; font-size: 15pt;text-shadow: #000 0 1px 1px;"><strong>Персонажи онлайн игры - НУ ПОГОДИ!: </strong></span></center></b>
<br>

<script type="text/javascript" src="https://yourjavascript.com/21139232152/bxslider.min.js"></script>
<script type="text/javascript" src="https://yourjavascript.com/11225442391/common.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery('#slider1').bxSlider({
  auto: true,           // true, false - автоматическая смена слайдов
  speed: 1000,      // целое число - в милисекундах, скорость смены слайдов
 pause: 55000,  // целое число - в милисекундах, период между сменами слайдов
    });
  });
</script>
<?PHP
$_OPTIMIZATION["title"] = "О проекте";
$usid = $_SESSION["user_id"];
$refid = $_SESSION["referer_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();


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
<div class="fr-te-gr-title"> <font color="#000000"; ><b>Время: Уровень 1</b></font></div>
<div colspan="3"><img src="/img/fruit/kot.gif" name="slide_show"></div>

<!--<div id="example3" style=" display: none; ">-->
<center>

<div class="fr-te-gr"><b>Цена:</b> <font color="#000000"><?=$sonfig_site["amount_a_t"]; ?> <img src="/img/fruit/serebro.png" width="15" height="15"></font></div>
		
<div class="fr-te-gr"><b>Доход: </b><font color="#000000"><?=$sonfig_site["a_in_h"]; ?> единиц в час</font></div>

		<div class="fr-te-gr"><b>Куплено: </b><font color="#000000"> <?=$user_data["a_t"]; ?> </font></div><form action="" method="post">
		<input type="hidden" name="item" value="1" />
		<input type="submit" value="Купить" style="height: 30px; margin-top:10px;" class="btn_8" />	</div>
	</form>
</center>
<!--</div>-->


</td>
<!----><!---->


<!----><!---->
<td align="center">
<div class="fr-block3">
<div class="fr-te-gr-title"><font color="#000000"><b>Время: Уровень 2</b></font></div>

<div colspan="3"><img src="/img/fruit/kot.gif" name="slide_show2"></div>

<!--<div id="example4" style=" display: none; ">-->
<center>

<div class="fr-te-gr"><b>Цена:</b> <font color="#000000"><?=$sonfig_site["amount_b_t"]; ?> <img src="/img/fruit/serebro.png" width="15" height="15"></font></div>

		<div class="fr-te-gr"><b>Доход: </b><font color="#000000"><?=$sonfig_site["b_in_h"]; ?>  единиц в час</font></div>
		

		<div class="fr-te-gr"><b>Куплено:</b><font color="#000000"> <?=$user_data["b_t"]; ?> </font></div><form action="" method="post">
		<input type="hidden" name="item" value="2" />
		<input type="submit" value="Купить" style="height: 30px; margin-top:10px;"class="btn_8">	</div>
	</form>
</center>
<!--</div>-->

</td>
<!----><!---->


<!----><!---->
<td align="center">
<div class="fr-block3">
<div class="fr-te-gr-title"><font color="#000000"><b>Время: Уровень 3</b></font></div>
<div colspan="3"><img src="/img/fruit/kot.gif" name="slide_show2"></div>

<!--<div id="example4" style=" display: none; ">-->
<center>
		
		<div class="fr-te-gr"><b>Цена:</b> <font color="#000000"><?=$sonfig_site["amount_c_t"]; ?> <img src="/img/fruit/serebro.png" width="15" height="15"></font></div>

<div class="fr-te-gr"><b>Доход: </b><font color="#000000"><?=$sonfig_site["c_in_h"]; ?> единиц в час</font></div>

		<div class="fr-te-gr"><b>Куплено:</b><font color="#000000"> <?=$user_data["c_t"]; ?> </font></div><form action="" method="post">
		<input type="hidden" name="item" value="3" />
		<input type="submit" value="Купить" style="height: 30px; margin-top:10px;"class="btn_8">	</div>
	</form>
</center>
<!--</div>-->

</td>
<!----><!---->


<!----><!---->
<td align="center">
<div class="fr-block3">
<div class="fr-te-gr-title"><font color="#000000"><b>Время: Уровень 4</b></font></div>
<div colspan="3"><img src="/img/fruit/kot.gif" name="slide_show2"></div>

<!--<div id="example4" style=" display: none; ">-->
<center>
		
		<div class="fr-te-gr"><b>Цена:</b> <font color="#000000"><?=$sonfig_site["amount_d_t"]; ?> <img src="/img/fruit/serebro.png" width="15" height="15"></font></div>

<div class="fr-te-gr"><b>Доход: </b><font color="#000000"><?=$sonfig_site["d_in_h"]; ?> единиц в час</font></div>

		<div class="fr-te-gr"><b>Куплено:</b><font color="#000000"> <?=$user_data["d_t"]; ?> </font></div><form action="" method="post">
		<input type="hidden" name="item" value="4" />
		<input type="submit" value="Купить" style="height: 30px; margin-top:10px;"class="btn_8">	</div>
	</form>
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
<div class="fr-te-gr-title"> <font color="#000000"; ><b>Время: Уровень 5</b></font></div>
<div colspan="3"><img src="/img/fruit/kot.gif" name="slide_show"></div>

<!--<div id="example3" style=" display: none; ">-->
<center>

<div class="fr-te-gr"><b>Цена:</b> <font color="#000000"><?=$sonfig_site["amount_e_t"]; ?> <img src="/img/fruit/serebro.png" width="15" height="15"></font></div>

<div class="fr-te-gr"><b>Доход: </b><font color="#000000"><?=$sonfig_site["e_in_h"]; ?> единиц в час</font></div>
		<div class="fr-te-gr"><b>Куплено: </b><font color="#000000"> <?=$user_data["e_t"]; ?> </font></div><form action="" method="post">
 <input type="hidden" name="item" value="5" />
		<input type="submit" value="Купить" style="height: 30px; margin-top:10px;"class="btn_8">	</div>
	</form>
</center>
<!--</div>-->


</td>
<!----><!---->
<!----><!---->
<td align="center">
<div class="fr-block3">
<div class="fr-te-gr-title"> <font color="#000000"; ><b>Время: Уровень 6</b></font></div>
<div colspan="3"><img src="/img/fruit/kot.gif" name="slide_show"></div>

<!--<div id="example3" style=" display: none; ">-->
<center>

<div class="fr-te-gr"><b>Цена:</b> <font color="#000000"><?=$sonfig_site["amount_f_t"]; ?> <img src="/img/fruit/serebro.png" width="15" height="15"></font></div>

<div class="fr-te-gr"><b>Доход: </b><font color="#000000"><?=$sonfig_site["f_in_h"]; ?> единиц в час</font></div>
		<div class="fr-te-gr"><b>Куплено: </b><font color="#000000"> <?=$user_data["f_t"]; ?> </font></div><form action="" method="post">
 <input type="hidden" name="item" value="6" />
		<input type="submit" value="Купить" style="height: 30px; margin-top:10px;"class="btn_8">	</div>
	</form>
</center>
<!--</div>-->


</td>
<!----><!---->
<!----><!---->
<td align="center">
<div class="fr-block3">
<div class="fr-te-gr-title"> <font color="#000000"; ><b>Время: Уровень 7</b></font></div>
<div colspan="3"><img src="/img/fruit/kot.gif" name="slide_show"></div>

<!--<div id="example3" style=" display: none; ">-->
<center>

<div class="fr-te-gr"><b>Цена:</b> <font color="#000000"><?=$sonfig_site["amount_g_t"]; ?> <img src="/img/fruit/serebro.png" width="15" height="15"></font></div>

<div class="fr-te-gr"><b>Доход: </b><font color="#000000"><?=$sonfig_site["g_in_h"]; ?> единиц в час</font></div>
		<div class="fr-te-gr"><b>Куплено: </b><font color="#000000"> <?=$user_data["g_t"]; ?> </font></div><form action="" method="post">
 <input type="hidden" name="item" value="7" />
		<input type="submit" value="Купить" style="height: 30px; margin-top:10px;"class="btn_8">	</div>
	</form>
</center>
<!--</div>-->


</td>
<!----><!---->
<!----><!---->
<td align="center">
<div class="fr-block3">
<div class="fr-te-gr-title"> <font color="#000000"; ><b>Время: Уровень 8</b></font></div>
<div colspan="3"><img src="/img/fruit/kot.gif" name="slide_show"></div>

<!--<div id="example3" style=" display: none; ">-->
<center>

<div class="fr-te-gr"><b>Цена:</b> <font color="#000000"><?=$sonfig_site["amount_h_t"]; ?> <img src="/img/fruit/serebro.png" width="15" height="15"></font></div>

<div class="fr-te-gr"><b>Доход: </b><font color="#000000"><?=$sonfig_site["h_in_h"]; ?> единиц в час</font></div>
		<div class="fr-te-gr"><b>Куплено: </b><font color="#000000"> <?=$user_data["h_t"]; ?> </font></div><form action="" method="post">
 <input type="hidden" name="item" value="8" />
		<input type="submit" value="Купить" style="height: 30px; margin-top:10px;"class="btn_8">	</div>
	</form>
</center>
<!--</div>-->


</td>
<!----><!---->

</tr>
</table>
 </div>



</div>
</div><style>
/* оформление и размер блока */
#slider_cont {
    border: 0px solid #006699;
    margin: 0px;
    width: 900px!important;
    padding: 0px;
}

/* кнопка следующее изображение */
.bx-prev {
position:absolute;
top:39%;
left:-10px;
width:40px;
height:61px;;
text-indent:-999999px;
background:url(/img/prev.png) no-repeat  0 0px;
}

/* кнопка предыдущее изображение */
.bx-next {
position:absolute;
top:39%;
right:-10px;
width:40px;
height:61px;
text-indent:-999999px;
background:url(/img/next.png) no-repeat 0 0px;
}

/* для кнопок при наведении курсора */
.bx-next:hover {
background:url(/img/next1.png) no-repeat 0 0px;
border:0; 
}
/* для кнопок при наведении курсора */
.bx-prev:hover {
background:url(/img/prev1.png) no-repeat  0 0px;
border:0;
}
</style>





<div class="clr"></div>
</div>
  