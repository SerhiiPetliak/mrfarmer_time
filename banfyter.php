<table align="center" width="1000"> 
   <td>
   <div id="linkslot_153864" class="header_banner_table"><script src="https://linkslot.ru/bancode.php?id=153864" async></script></div>
   </td>
   <td>
<div id="linkslot_153863" class="header_banner_table"><script src="https://linkslot.ru/bancode.php?id=153863" async></script></div>
 </td>
</table>
<script>
    $(".header_banner_table").click(function(){
        $.ajax({
            method : "get",
            url    : "bannerbonus.php",
            data   : "banbonus",
            success: function (data) {
                if(data.status == "error"){
                    alert("— моента прошлого получени€ бонусов не прошло 24 часа!");
                }else{
                    alert("¬ам начислен бонус в размере "+data.sum+" монет");
                    location.replace('account/bonus');
                }
            },
            error  : function (data) {
                console.log(data);
            },
            dataType: "json"
        });
    });
</script>