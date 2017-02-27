<?php
/*
 * Серфинг для фермы
 * Версия: 1.00
 * SKYPE: sereega393
 * Использование без оплаты ЗАПРЕЩЕНО!!!
*/
define('TIME', time());

header("Content-Type: text/html; charset=windows-1251");

$msg = '';
$_SESSION['cnt'] = md5($_SESSION['user_id'].session_id());

$db->Query("SELECT * FROM db_users_b WHERE id = '".$_SESSION['user_id']."'");
$users_info = $db->FetchArray();

?>
<script>



function getHTTPRequest()
{
    var req = false;
    try {
        req = new XMLHttpRequest();
    } catch(err) {
        try {
            req = new ActiveXObject("MsXML2.XMLHTTP");
        } catch(err) {
            try {
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(err) {
                req = false;
            }
        }
    }
    return req;
}

 var  defsummin = 1;
            function advevent(badv, buse) 
            {
                var postc = '<?php echo $_SESSION['cnt']; ?>';
                var issend = true;
                if (buse == 3) issend = confirm("Обнулить счётчик просмотров ссылки №" + badv + "?");
                if (buse == 4) issend = confirm("Вы уверены что хотите удалить ссылку №" + badv + "?");
                if (issend)
                    senddata(badv, buse, postc, 1);
                return true;
            }
         
 
 function senddata(radv, ruse, rpostc, rmode)
{
    var myReq = getHTTPRequest();
    var params = "use="+ruse+"&mode="+rmode+"&adv="+radv+"&cnt="+rpostc;
    function setstate()
    {
        console.log(myReq.readyState+ " "+myReq.status);
        if ((myReq.readyState == 4)&&(myReq.status == 200)) {
            var resvalue = parseInt(myReq.responseText);
            if (resvalue > 0) {
                if (ruse == 1) {
                    document.getElementById("advimg"+radv).innerHTML = "<span class='serfcontrol-pause' title='Остановить показ рекламной площадки' onclick='javascript:advevent(" + radv + ",2);'></span>";
                } else
                if (ruse == 2) {
                    document.getElementById("advimg"+radv).innerHTML = "<span class='serfcontrol-play' title='Запустить показ рекламной площадки' onclick='javascript:advevent(" + radv + ",1);'></span>";
                } else
                if (ruse == 3) {
                    document.getElementById("erase"+radv).innerHTML = "0";
                } else
                if (ruse == 4) {
                    $('#adv'+radv).fadeOut('def');
                } else
                if (ruse == 5) {
                    if ((resvalue > 0)&&(resvalue < 8))
                        document.getElementById("int"+radv).className = 'scon-speed-'+resvalue;
                } else
                if (ruse == 6) {
                    document.getElementById("status"+radv).innerHTML = "<span class='desctext' style='text-decoration: blink;'>Ожидает<br />проверки</span>";
                    document.getElementById("advimg"+radv).innerHTML = "<span class='serfcontrol-postmoder'></span>";
                } else
                if (ruse == 7) {
                    window.location.reload(true);
                }
            }
        }
    }
    myReq.open("POST", "/ajax/us-advservice.php", true);
    myReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myReq.setRequestHeader("Content-lenght", params.length);
    myReq.setRequestHeader("Connection", "close");
    myReq.onreadystatechange = setstate;
    myReq.send(params);
    return false;
}

function submitform(formnum)
{
    if (document.forms['payform'+formnum].pay_order) {
        var field = document.forms['payform'+formnum].pay_order.value;
        var minsum = $('#minsum'+formnum).text();      
        var tm;
        var pay_type = $(".payform_select_"+formnum).val();
        function hidemsg()
        {
            $('#entermsg'+formnum).fadeOut('slow');
            if (tm)
                clearTimeout(tm);
        }
        field = field.replace(",", ".");
        if (field == '') {
            document.getElementById('entermsg'+formnum).innerHTML = "<span class='msgbox-error'>Введите необходимую сумму</span>";
            document.getElementById('entermsg'+formnum).style.display = '';
            tm = setTimeout(function() {
                hidemsg()
            }, 1000);
            return false;
        }
        rprice = parseFloat(field);
        if (isNaN(rprice)) {
            document.getElementById('entermsg'+formnum).innerHTML = "<span class='msgbox-error'>Значение должно быть числовым</span>";
            document.getElementById('entermsg'+formnum).style.display = '';
            tm = setTimeout(function() {
                hidemsg()
            }, 1000);
            return false;
        }
        if (rprice != field) {
            document.getElementById('entermsg'+formnum).innerHTML = "<span class='msgbox-error'>Значение должно быть числовым</span>";
            document.getElementById('entermsg'+formnum).style.display = '';
            tm = setTimeout(function() {
                hidemsg()
            }, 1000);
            return false;
        }
        if (rprice < minsum) {
            document.getElementById('entermsg'+formnum).innerHTML = "<span class='msgbox-error'>Сумма должна быть не менее "+minsum+" баксов</span>";
            document.getElementById('entermsg'+formnum).style.display = '';
            tm = setTimeout(function() {
                hidemsg()
            }, 1000);
            return false;
        }
        var rnote = document.forms['payform'+formnum].pay_adv.value;
        var rart = document.forms['payform'+formnum].pay_mode.value;
        var rcnt = document.forms['payform'+formnum].pay_cnt.value;
        senddatacart(rnote, rart, rprice, rcnt, pay_type);
        return true;
    }
    return false;
}

function senddatacart(rnote, rart, rprice, rcnt, pay_type)
{
    var myReq = getHTTPRequest();
    var params = "adv="+rnote+"&use="+rart+"&price="+rprice+"&cnt="+rcnt+"&pay_type="+pay_type;
    function setstate()
    {
        if ((myReq.readyState == 4)&&(myReq.status == 200)) {
            var resvalue = myReq.responseText;
            if (resvalue != '') {
                if (resvalue > 0) {                   
                    document.getElementById("entermsg"+rnote).innerHTML = "<center>Оплачено</center>";
                    window.location.reload(true);
                } else
                    document.getElementById("entermsg"+rnote).innerHTML = "<span class='msgbox-error'>"+resvalue+"</span>";
            } else {
                document.getElementById("entermsg"+rnote).innerHTML = "<span class='msgbox-error'>Не удалось обработать запрос</span>";
            }
        } else {
            document.getElementById("entermsg"+rnote).innerHTML = "<span class='loading' title='Подождите пожалуйста...'></span>";
            document.getElementById("entermsg"+rnote).style.display = '';
        }
    }
    myReq.open("POST", "/ajax/us-advservice.php", true);
    myReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myReq.setRequestHeader("Content-lenght", params.length);
    myReq.setRequestHeader("Connection", "close");
    myReq.onreadystatechange = setstate;
    myReq.send(params);
    return false;
}

function hideserfaddblock(bname) {

    if (document.getElementById(bname).style.display == 'none')
        document.getElementById(bname).style.display = '';
    else
        document.getElementById(bname).style.display = 'none';
    return false;
}
function alertbudget()
{
    alert("Пополните рекламный бюджет");
    return false;
}
function alertnochange()
{
    alert("Задание можно редактировать только раз в 3 часа");
    return false;
}

function reportformactivate(dnum, dmode) {
    if (dmode == 2)
        document.getElementById('delcomment'+dnum).style.display = '';
    else
    if (dmode == 3)
        document.getElementById('reversecomment'+dnum).style.display = '';
    document.getElementById('btns'+dnum).style.display = 'none';
    return false;
    }


function getpayeerform(type, id, mysum, myid) {
    if(type == 3){
        $(".adv_type_button").css("cssText", "display: none !important;");
        $(".payeer_"+id).html("<form method=\"POST\" action=\"/account/advpayeer.html\">"+
                "<input type=\"hidden\" name=\"method\" value=\"payeer\">"+
                "<input type=\"hidden\" name=\"sum\" value=\""+mysum+"\">"+
                "<input type=\"hidden\" name=\"adv_id\" value=\""+myid+"\">"+
                "<input type=\"submit\" class=\"payeer_submit\" name=\"pay\" value=\"Перейти к оплате счета\" />"+
            "</form>");
    }else{
        $(".payeer_"+id).html("");
        $(".adv_type_button").css("display", "block");
    }
}

function payselect(id) {
    $(".pay_order_"+id).css("display", "none");
    $(".payform"+id).append("<center><select class=\"payform_select payform_select_"+id+"\" name=\"pay_type\"  " +
        "onchange=\"javascript:getpayeerform(this.options[this.selectedIndex].value, id, document.getElementById('pay_adv_sum_"+id+"').value, "+id+")\">" +
            "<option value=\"1\" selected>Счет для вывода</option>" +
            "<option value=\"2\">Счет для покупок</option>" +
            "<option value=\"3\">Payeer</option>" +
        "</select>" +
        "<span class=\"button-red-new adv_type_button\" title=\"Внести средства в бюджет площадки\" onclick=\"javascript:submitform("+id+");\">Оплатить</span>" +
        "");
}



</script>

<div class="s-bk-lf">
    <div class="acc-title">Серфинг</div>
</div>

<div class="silver-bk">

    <center>
        <a href="/account/serfing/add" class="button-green-big" style="margin-top:10px">Разместить ссылку</a>
    </center>
	<center>
	После оплаты баланса ссылки не забудьте включить показы!!!
	</center><BR/>

    <div class="serfing_list_wrap adv-serf">
 <?php

 if (isset($_POST['delete']))
 {
     $id = (int)$_POST['delete'];


         $db->query("SELECT money, user_name FROM db_serfing WHERE id = '".$id."' LIMIT 1");

         $result = $db->FetchArray();

         $db->query("UPDATE db_users_b SET money_b = money_b + '".$result['money']."' WHERE user = '".$result['user_name']."'");

         $db->query("DELETE FROM db_serfing WHERE id = '".$id."'");
         $db->query("DELETE FROM db_serfing_view WHERE ident = '".$id."'");

 }


 $db->Query("SELECT * FROM db_serfing WHERE user_name = '".$_SESSION['user']."' ORDER BY time_add DESC");

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
                <div class="serfing_list_item__footer">
                    <div class="serfing_list_item__footer_left">
                        Оплата: <?= $pay_user; ?>
                    </div>
                    <div class="serfing_list_item__footer_right">
                        <img src="/img/serfing_time.png" alt="">
                        <?= $row['timer']; ?>
                        сек
                    </div>
                </div>
            </div>
     <?php
   }
 } 
 else
 {
   echo 'ссылок нет';
 }
 
 ?>

    </div>
    <div class="clr"></div>
</div>


