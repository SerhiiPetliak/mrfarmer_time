<?PHP
$_OPTIMIZATION["title"] = "������� - ���������";
$usid = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a WHERE id = '$usid'");
$user_data = $db->FetchArray();
?>
<div class="s-bk-lf">
	<div class="acc-title">���������</div>
</div>
<div class="silver-bk">
<div class="clr"></div>	
<?

if (isset($_FILES['file'])) {
    $f_err     = 0; //��������������� ����������
    $types     = array(
        '.jpg',
        '.JPG',
        '.jpeg',
        '.gif',
        '.png'
    ); //�������������� ������� ����������� ������
    $max_size  = 502050; //������������ ������ ������������ ����� (5000-��)
    $path      = 'avatar/'; //���������� ��� ��������
    $path_mini = 'avatar/'; //���������� ��� �������� ���������
    $fname     = $_FILES['file']['name'];
	//$fname = md5($fname);
    $ext       = substr($fname, strpos($fname, '.'), strlen($fname) - 1); //���������� ��� ������������ �����

    //�������� �� ������������ �������
    if (!in_array($ext, $types)) {
        $f_err++;
        $mess = '<p style="color:red;"><center>����������� ���� �� �������� ���������</center></p>';
    }

    //�������� ������� �����
    if (filesize($_FILES['file']['tmp_name']) > $max_size) {
        $f_err++;
        $mess = '<p style="color:red;"><center>������ ����������� �������� ��������� 5 Mb</center></p>';
    }

    //���� ���� ������� ������ ��������
    //���������� ��� � �������� ���������� �� ���������
    if ($f_err == 0) {
        move_uploaded_file($_FILES['file']['tmp_name'], $path . $fname);

        //���� � ������������ �����
        $source_src = $path . $fname;

        //������� ���� � ��� ���������
        $new_name     = md5($fname) . $ext;
        $resource_src = $path_mini . $new_name;

        //�������� ��������� ������������ �����
        $params = getimagesize($source_src);

        switch ($params[2]) {
            case 1:
                $source = imagecreatefromgif($source_src);
                break;
            case 2:
                $source = imagecreatefromjpeg($source_src);
                break;
        }

        //���� ������ ������ ������
        //��������� ����� ������
        if ($params[1] > $params[0]) {
            $newheight = 150;
            $newwidth  = floor($newheight * $params[0] / $params[1]);
        }
        //���� ������ ������ ������
        //��������� ����� ������
        if ($params[1] < $params[0]) {
            $newwidth  = 150;
            $newheight = floor($newwidth * $params[1] / $params[0]);
        }
		 //���� ��� �����
        //��������� ����� ������
        if ($params[1] = $params[0]) {
            $newwidth  = 150;
    $newheight = 150;
            $newheight = floor($newwidth * $params[1] / $params[0]);
   $newwidth  = floor($newheight * $params[0] / $params[1]);
        }

        //������� ��������� ������������ �����������
        $resource = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($resource, $source, 0, 0, 0, 0, $newwidth, $newheight, $params[0], $params[1]);
        imagejpeg($resource, $resource_src, 80); //80 �������� �����������

        //��������� ����� �������
        chmod("$source_src", 0644);
        chmod("$resource_src", 0644);

        //������� ���������
        $mess = '<center><br><p style="color:#FFFF00;"><center>����������� ���������!</center></p></center>';
        $ok   = 1;
    }

//include("session.inc.php");
$file = str_replace($server['DOCUMENT_ROOT'], '/', $path_mini . $new_name); // �������� ���� ���� '/img/avatars/15.jpg'
//mysql_query("UPDATE members SET avatar='$file' WHERE id='$userid';"); //���������� � ��.
$db->Query("UPDATE db_users_a SET ava = '$file' WHERE id = '$usid'");

header('Refresh: 1;URL=/account/config/');


}



if(empty($user_data['ava'])) {
echo '<center><img src="/img/c50.gif"></center>';
}else{
echo '<center><img src="/'.$user_data['ava'].'"></center>';
}
?>



<center><h3>�������� �������</h3></center>
<!--����� ���������--><?= $mess ?>

<center>(�� ����� 150*150px)<br>     
<p><form method="POST"  enctype="multipart/form-data" name="form33">
<table id="upload1" ><tr><td>
</td> <td><span class="psevdoFile"><input id="psevdoFileValue" class="inputFileText" value="�������� ����" style="color:#828282;" type="text"/>
    <input class="fileInput" type="file" size="1" onchange="document.getElementById('psevdoFileValue').value = this.value" name="file"/>
    </span></td></tr></tr>



<tr><td align="center" colspan="2"><br><input type='submit' name='submit' class="btn_8" value='���������'></a></td></tr>
</table></form></p>
</center>

<h3 style="border-top: solid 1px #fff; padding-top: 10px;"></h3>

<center><h3><b>����� ������</b></h3></center>
<BR />
<?PHP
	if(isset($_POST["old"])){
	
	
		$old = $func->md5Password($_POST["old"]);
		$new = $func->md5Password($_POST["new"]);
		
			if($old !== false AND strtolower($old) == strtolower($user_data["pass"])){
			
				if($new !== false){
				
					if( strtolower($new) == strtolower($func->md5Password($_POST["re_new"]))){
					
						$db->Query("UPDATE db_users_a SET pass = '$new' WHERE id = '$usid'");
						
						echo "<center><div class='alert' id='good'>����� ������ ������� ����������.</div></center>";
					
					}else echo "<center><div class='alert' id='error'>������ � ������ ������ �� ���������!</div></center>
";
				
				}else echo "<center><div class='alert' id='error'>����� ������ ����� �������� ������!</div></center>
";
			
			}else echo "<center><div class='alert' id='error'>������ ������ �������� �������!</div></center>
";
		
	}
?>


<form action="" method="post">
<table width="330" border="0" align="center">
  <tr>
    <td><b>������ ������:</b></td>
    <td align="center"><input type="password" name="old" /></td>
  </tr>
  <tr>
    <td><b>����� ������:</b></td>
    <td align="center"><input type="password" name="new" /></td>
  </tr>
  <tr>
    <td><b>������ ������:</b></td>
    <td align="center"><input type="password" name="re_new" /></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><BR /><input type="submit" value="������� ������" class="btn_8"/></td>
  </tr>
</table>
</form>
<BR />
<div style="display: block;width: 100%;position: relative;margin: 20px auto 20px auto;height: 1px;background: rgb(244, 128, 0);border-radius: 1px;box-shadow: 0px 0px 2px 0px black;"></div>

<center><p style="font-weight: bold;">���� �� ������ ������� ����� �������� , �������� ��� � �������� ����� ��������. <a style="font-family: time-new-roman;color: rgb(92, 125, 152);" href="/contacts" target="_blank">���� ��������.</a></p></center>

<div style="display: block;width: 100%;position: relative;margin: 20px auto 20px auto;height: 1px;background: rgb(244, 128, 0);border-radius: 1px;box-shadow: 0px 0px 2px 0px black;"></div>


<br><br>
 <br><br>
<div class="clr"></div>		
</div>




