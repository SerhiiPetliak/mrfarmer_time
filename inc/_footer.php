<BR />
<?PHP if(!isset($_GET["menu"]) OR $_GET["menu"] != "admin4ik"){ ?>
<?PHP } ?>

							<div class="clr"></div>
							</div>
						<div class="clr">
						<form action="" method="post">
<a onclick="document.getElementById('hideBtn').style.display='block';" target="_blank" >
<h4 onclick="document.getElementById('hideBtn').style.display='block';">
						<?php include("banfyter.php");?></div>
							</h4></a>
						</div>

					<BR /> <BR />
<center><font color="#FFF">© 2016 Time-Money.Win ВСЕ ПРАВА ЗАЩИЩЕНЫ</font></center>	
<center>
<div class="footer2">
<div id="templatemo_footer">
<a class="current" href="/">Главная</a> | <a href="/rules/">Соглашение</a> | <a href="/payments/">Выплаты</a> | <a href="#" target="_blank">MMGP.ru</a> | 
		<a href="#" target="_blank">AntiMMGP.ru</a>
 <br><br>
</div></div></center>
<center><table><tr><td><img src="/img/pa.png" width="30" height="30">
</td><td><img src="/img/qiwi-icon.png" width="30" height="30">
</td><td>
<!-- Yandex.Metrika informer -->
<a href="https://metrika.yandex.ru/stat/?id=43070504&amp;from=informer"
target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/43070504/3_0_FFFFFFFF_EFEFEFFF_0_pageviews"
style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="43070504" data-lang="ru" /></a>
<!-- /Yandex.Metrika informer -->

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter43070504 = new Ya.Metrika({
                    id:43070504,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/43070504" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<!--</td><td><img src="/img/ddos.png" width="27" height="30">
</td><td><img src="/img/ssl.png" width="35" height="30"></td> -->
</tr>
</table></center>
				<div class="footer">
					<center>
					
<div class="f1"><span style="color:#FFF;
    font-family: Lasco_Bold;
    font-size:16px;text-shadow: 1px 1px 0px #080808, 1px 1px 0px #707070;
    "><?=$stats_data["all_users"]; ?><BR /> Игроков </a></span></div><div class="fu1"><img src="/img/f1.png" width="60" height="60"></div>

<div class="f2"><span style="color:#FFF;
    font-family: Lasco_Bold;
    font-size:16px;text-shadow: 1px 1px 0px #080808, 1px 1px 0px #707070;
    "> + <?=$stats_data["new_users"]; ?><BR /> Сегодня </a></span></div><div class="fu2"><img src="/img/f1.png" width="60" height="60"></div>

<div class="f3"><span style="color:#FFF;
    font-family: Lasco_Bold;
    font-size:16px;text-shadow: 1px 1px 0px #080808, 1px 1px 0px #707070; 
    "> + <?=sprintf("%.2f",$stats_data["all_insert"]); ?><BR /> Резерв </a></span></div><div class="fu3"><img src="/img/f2.png" width="60" height="60"></div>

<div class="f4"><a href="/payments"><span style="color:#FFF;
    font-family: Lasco_Bold;
    font-size:16px;text-shadow: 1px 1px 0px #080808, 1px 1px 0px #707070; 
    "> - <?=sprintf("%.2f",$stats_data["all_payment"]); ?><BR /> Выплачено </a></span></div><div class="fu4"><img src="/img/f3.png" width="60" height="60"></div></a>

<div class="f5"><span style="color:#FFF;
    font-family: Lasco_Bold;
    font-size:16px;text-shadow: 1px 1px 0px #080808, 1px 1px 0px #707070; 
    "><font color="#FF4500"><?=intval(((time() - $config->SYSTEM_START_TIME) / 86400 ) +1); ?></font><BR />Мы живем!</span></div><div class="fu5"><img src="/img/f4.png" width="60" height="60"></div>

					</center>

				</div>
			
			
			
			
	</body>
</html>
