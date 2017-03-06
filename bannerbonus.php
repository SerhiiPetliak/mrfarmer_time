<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    exit();
}else{
    $usid = $_SESSION['user_id'];
    $usname = $_SESSION['user'];
    # Настройки бонусов
    $bonus_min = 1;
    $bonus_max = 50;
    $res = array();
}

require_once("classes/_class.config.php");
require_once("classes/_class.db.php");

$config = new config;

$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);
$db->Query("set names cp1251;");

if(isset($_GET['banbonus'])){
    $tmp = $db->query("SELECT * FROM db_bonus_list WHERE user_id='$usid'");
    $sum = rand($bonus_min, rand($bonus_min, $bonus_max) );
    $ntime = time();

    if(!empty($tmp) && $db->NumRows($tmp) > 0){

        $binfo = $db->FetchArray($tmp);

        if(($ntime - $binfo['date_add']) < 86400){
            $res = array("status" => "error");
            echo json_encode($res);
            exit();
        }else{
            $db->Query("UPDATE db_users_b SET money_b = money_b + '$sum' WHERE id = '$usid'");
            $db->query("UPDATE db_bonus_list SET sum='$sum', date_add='$ntime, date_del='$ntime' WHERE user_id='$usid'");
            $res = array("status" => "ok", "sum" => $sum );
            echo json_encode($res);
            exit();
        }

    }else{
        $db->Query("UPDATE db_users_b SET money_b = money_b + '$sum' WHERE id = '$usid'");
        $db->query("INSERT INTO db_bonus_list (user, user_id, sum, date_add, date_del) VALUES ('$usname', '$usid', '$sum', '$ntime', '$ntime')");
        $res = array("status" => "ok", "sum" => $sum );
        echo json_encode($res);
        exit();

    }
}

?>