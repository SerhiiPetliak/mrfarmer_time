<?php
define('TIME', time());
define('BASE_DIR', $_SERVER['DOCUMENT_ROOT']);
header("Content-Type: text/html; charset=windows-1251");
session_start();
if (!isset($_SESSION['user_id'])) { exit(); }

if (isset($_GET['cnt']) && isset($_SESSION['view']['id']) && isset($_SESSION['view']['timer']) && $_GET['cnt'] == $_SESSION['view']['cnt'])
{

    function __autoload($name){ include(BASE_DIR."/classes/_class.".$name.".php");}

    $config = new config;

    $db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);
    $db->Query("set names cp1251;");

    $serf_id = $_SESSION['view']['id'];
    $db->Query("SELECT * FROM `db_serfing` WHERE `id` = '$serf_id'");
    $serf = $db->FetchArray();

    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="stylesheet" href="/style/style-serf.css" type="text/css" />
        <script type="text/javascript" src="/js/serfing.js"></script>
        <script type="text/javascript" language="JavaScript">
            var vtime = stattime = <?php echo $_SESSION['view']['timer']; ?>;
            var cnt = '<?php echo $_SESSION['view']['cnt']; ?>';
        </script>
    </head>
    <body>
    <table class="serfframe" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td>
                <div id="blockverify">
                    <div id="blockwait">
                        Подождите, сайт загружается...
                    </div>
                    <div id="blocktimer" style="display: none;">
                        <form class="clockalert" name="frm" method="post" action="" onsubmit="return false;">
                            <input name="clock" size="3" readonly="readonly" type="text" value=""/>
                            <br />
                            <span>Дождитесь окончания таймера</span>
                        </form>
            <td>

                <a href="<?php echo $serf['url'];?>" target="_blank">Перейти на сайт рекламодателя >>></a><BR/>
                <span><?php echo $serf['desc'];?></span>
            </td>
            </div>
            </div>
            </td>
            <td align="right" class="footer" width="500">
<?php
$banners[1] = '<a href="http://socpublic.com/?i=1421000" target="_blank"><img src="https://socpublic.com/storage/banners/banner_2_468x60.gif" width="468" height="60" border="0" alt="SOCPUBLIC.COM - заработок в интернете!"></a>';
$banners[2] = '<a href="http://freebitco.in/?r=1537931" target="_blank"><img src="https://static1.freebitco.in/banners/468x60-3.png" width="468" height="60" border="0" alt="Лучший биткоин кран" /></a>';
$banners[3] = '<a href="http://exmo.com/?ref=152898" target="_blank"><img src="https://mr-farmer.biz/img/EXMO.png" width="468" height="60" border="0" alt="Лучшая биржа криптовалют" /></a>';
$banners[4] = '<a href="http://epay.info/rotator/1386577" target="_blank"><img src="https://mr-farmer.biz/img/bitcoins-free.jpg" width="468" height="60" border="0" alt="Лучший ротатор биткоин кранов"></a>';
$banners[5] = '<a href="http://wmrfast.com/?r=308242" target="_blank"><img src="https://wmrfast.com/banners/WF-468.gif" width="468" height="60" border="0" alt="WMRFast - лучшее место для заработка" /></a>';
$banners[6] = '<a href="http://seo-fast.ru/?r=1221685" target="_blank"><img src="https://mr-farmer.biz/img/monitor/fastbanner468x60.gif" width="468" height="60" border="0" alt="Реферальные банеры" /></a>';
$banners[7] = '<a href="http://profitcentr.com/?r=aligattoorr" target="_blank"><img src="https://profitcentr.com/banners/profit9x468x60.gif" width="468" height="60" border="0" alt="ProfitCentr - рекламное агентство"></a>';
$banners[8] = '<a href="http://ru.ifaucet.net/?ref=103444" title="Зарабатывай с 500+ кранов на одном сайте"><img src="https://mr-farmer.biz/img/monitor/ifaucet.net-468x60ru.gif" alt="Зарабатывай с 500+ кранов на одном сайте"></a>';
$banners[9] = '<a href="http://golden-birds.biz/?i=983630" target=_blank> <img src="https://mr-farmer.biz/img/monitor/golden%20468-60.png" alt="Прибыль каждые 10 минут!"> </a>';
$banners[10] = '<a href="http://rgame.biz/r/1685" target=_blank> <img src="https://rgame.biz/promo/a_468x60.gif" alt="Прибыль каждый день"> </a>';
$banners[11] = '<a href="http://fishing-money.ru/?i=1239" target="_blank"><img src="https://mr-farmer.biz/img/monitor/riba2.gif"/> </a>';
$rnd = rand(1,11);
echo $banners[$rnd];
?>
            </td>
        </tr>
    </table>
    </body>
    </html>
    <?php
}
?>