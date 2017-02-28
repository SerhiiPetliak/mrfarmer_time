
<?php
/*
 * Серфинг для фермы
 * Версия: 1.00
 * SKYPE: sereega393
 * Использование без оплаты ЗАПРЕЩЕНО!!!
*/
define('TIME', time());

header("Content-Type: text/html; charset=windows-1251");


if (!isset($_SESSION['admin'])) { exit(); }

$msg = '';
$_SESSION['cnt'] = md5($_SESSION['user_id'].session_id());

$db->Query("SELECT * FROM db_users_b WHERE id = '".$_SESSION['user_id']."'");
$users_info = $db->FetchArray();

if(isset($_POST['moder-yes'])){
    $sid = $_POST['moder-yes'];
    $db->query("UPDATE db_serfing SET status = '3' WHERE id = '".$sid."'");
    header("Location: ".$_SERVER["REQUEST_URI"]);
    exit;
}

if(isset($_POST['moder-no'])){
    $sid = $_POST['moder-no'];

    $db->query("SELECT * FROM db_serfing WHERE id = '".$sid."'");
    $serf_info = $db->FetchArray();
    if($serf_info['money'] > 0){    //Если у обьявления есть деньги
        $money = $serf_info['money'];
        $db->Query("UPDATE db_users_b SET `money_b` = `money_b` + '".$money."' WHERE id = '".$_SESSION['user_id']."'"); // вернуть их пользователю

        $db->query("DELETE FROM db_serfing WHERE id = '".$sid."'");
        $db->query("DELETE FROM db_serfing_view WHERE ident = '".$sid."'");
    }else{
        $db->query("DELETE FROM db_serfing WHERE id = '".$sid."'");
        $db->query("DELETE FROM db_serfing_view WHERE ident = '".$sid."'");
    }
    header("Location: ".$_SERVER["REQUEST_URI"]);
    exit;
}

?>


<div class="s-bk-lf">
    <div class="acc-title">Серфинг - модераторская</div>
</div>

<div class="silver-bk">
    <div class="serfing_list_wrap adv-serf">
 <?php
     $db->Query("SELECT * FROM db_serfing WHERE status = '1' ORDER BY time_add DESC");

     if ($db->NumRows())
     {
       while ($row = $db->FetchArray())
       {
 ?>

        <div class="serfing_list_item">
            <div class="serfing_list_item__header">
                <a href="<?php echo $row['url']; ?>" target="_blank">
                    <?= $row['title']; ?>
                </a>
            </div>
            <div class="serfing_list_item__body">
                <?= $row['desc']; ?>
            </div>
            <div class="serfing_list_item__footer" style="text-align: left;">
                <div class="serfing_list_item__footer_left">
                    № <?php echo $row['id']; ?>&nbsp;
                    <span title="Клик">
                        <img src="/img/serfing_price.png" alt="">
                        <?php echo $row['price']; ?> м&nbsp;
                    </span>
                    <span title="Просмотров">
                        <img src="/img/serfing_eye.png" alt="">
                        <?php echo $row['view']; ?>
                    </span>
                </div>
                <div class="serfing_list_item__footer_right">
                    <form action="" method="post" style="display: inline;">
                        <input type="hidden" name="moder-yes" value="<?= $row['id']; ?>">
                        <input type="submit" class="moder-yes" title="ОДОБРИТЬ" value="">
                    </form>
                    <form action="" method="post" style="display: inline;">
                        <input type="hidden" name="moder-no" value="<?= $row['id']; ?>">
                        <input type="submit" class="moder-no" title="УДАЛИТЬ" value="">
                    </form>
                </div>
            </div>
        </div>

     <?php
   }
 }
 else
 {
   echo '<center><h1>Cсылок нет</h1></center>';
 }

 ?>
 <center>
 <!--<a href="/account/serfing/add" class="button-green-big" style="margin-top:10px">Разместить ссылку</a>-->
</center>
</div>
    <div class="clr"></div>
</div>
