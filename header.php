<?php
  require "configDB1.php";


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>NOVOCOMP.Work</title>
  <script src="https://yastatic.net/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js" type="text/javascript"></script>
<link href="css/tutorial.css" media="all" type="text/css" rel="stylesheet">
</head>
<style>
  .mess_for_me{
 display: inline-block;
 box-shadow: 0 0 5px #000000;
 -ms-user-select: none;
    -moz-user-select: none;
    -khtml-user-select: none;
    -webkit-user-select: none;
  }
 .mess_from_me{
 display: inline-block;
 float:right;
 box-shadow: 0 0 5px <?php echo $colordisignsetting; ?>;
 -ms-user-select: none;
    -moz-user-select: none;
    -khtml-user-select: none;
    -webkit-user-select: none;
  }
  .clear {
    clear: both;
        -ms-user-select: none;
    -moz-user-select: none;
    -khtml-user-select: none;
    -webkit-user-select: none;
  }
  .ksu_kotyatka {
    z-index: 999999;
  }
  .obvod2 {
  transition: 1s; /* Время эффекта */
  text-align: center;
  cursor: pointer;
  text-decoration:none;
}
.obvod2:hover{
  box-shadow:0 0 15px <?php echo $colordisignsetting; ?>;
  border-radius: 100px;
  transform: scale(1.2);
}
#side-checkbox {
    display: none; } #side-checkbox2 { display: none; } #side-checkbox3 { display: none; } #side-checkbox4 {  display: none; } #side-checkbox5 {
    display: none; } #side-checkbox6 { display: none; } #side-checkbox7 { display: none; } #side-checkbox8 { display: none; } #side-checkbox9 {
    display: none; } #side-checkbox10 { display: none; } #side-checkbox11 { display: none; } #side-checkbox12 { display: none; } #side-checkbox13 {
    display: none; } #side-checkbox14 { display: none; } #side-checkbox15 { display: none; } #side-checkbox16 { display: none; } #side-checkbox17 {
    display: none; } #side-checkbox18 { display: none; } #side-checkbox19 { display: none; } #side-checkbox20 { display: none; } #side-checkbox21 {
    display: none; } #side-checkbox22 { display: none; } #side-checkbox23 { display: none; } #side-checkbox24 {display: none; } #side-checkbox25 {
    display: none; }

.side-panel { position: fixed; z-index: 999999; top: 0; left: -570px; background: #242428; transition: all 1s; width: 530px; height: 100vh; overflow-y: auto; overflow-x:hidden; box-shadow: 10px 0 20px rgba(0,0,0,0.4); color: #FFF; padding: 40px 20px; }
.side-panel2 { position: fixed; z-index: 999999; top: 0; left: -570px; background: #242428; transition: all 1s; width: 530px; height: 100vh; overflow-y: hidden; overflow-x:hidden; box-shadow: 10px 0 20px rgba(0,0,0,0.4); color: #FFF; padding: 40px 20px; }

.side-title {
    font-size: 20px;
    padding-bottom: 10px;
    margin-bottom: 20px;
    border-bottom: 2px solid #BFE2FF;
}
/* Оформление кнопки на странице */
.side-button-1-wr {
    text-align: center; /* Контейнер для кнопки, чтобы было удобнее ее разместить */
}
.side-button-1 {
    display: inline-block;

}
.side-button-1 .side-b {
    text-decoration: none;
    position: relative;
    cursor: pointer;
    transition: 1s;
}
.side-button-1 .side-b:hover {
  transform: scale(1.1);
}
#side-checkbox:checked + .side-panel { left: 0; }
#side-checkbox2:checked + .side-panel2 { left: 0; } #side-checkbox3:checked + .side-panel2 { left: 0; } #side-checkbox4:checked + .side-panel2 { left: 0; }
#side-checkbox5:checked + .side-panel2 { left: 0; } #side-checkbox6:checked + .side-panel2 { left: 0; } #side-checkbox7:checked + .side-panel2 { left: 0; }
#side-checkbox8:checked + .side-panel2 { left: 0; } #side-checkbox9:checked + .side-panel2 { left: 0; } #side-checkbox10:checked + .side-panel2 { left: 0; }
#side-checkbox11:checked + .side-panel2 { left: 0; } #side-checkbox12:checked + .side-panel2 { left: 0; } #side-checkbox13:checked + .side-panel2 { left: 0; }
#side-checkbox14:checked + .side-panel2 { left: 0; } #side-checkbox15:checked + .side-panel2 { left: 0; } #side-checkbox16:checked + .side-panel2 { left: 0; }
#side-checkbox17:checked + .side-panel2 { left: 0; } #side-checkbox18:checked + .side-panel2 { left: 0; } #side-checkbox19:checked + .side-panel2 { left: 0; }
#side-checkbox20:checked + .side-panel2 { left: 0; } #side-checkbox21:checked + .side-panel2 { left: 0; } #side-checkbox22:checked + .side-panel2 { left: 0; }
#side-checkbox23:checked + .side-panel2 { left: 0; } #side-checkbox24:checked + .side-panel2 { left: 0; } #side-checkbox25:checked + .side-panel2 { left: 0; }

.side-button-2 {
    font-size: 30px;
    border-radius: 20px;
    position: absolute;
    z-index: 1;
    top: 8px;
    right: 8px;
    cursor: pointer;
    transform: rotate(45deg);
    color: #BFE2FF;
    transition: all 280ms ease-in-out;
    -ms-user-select: none;
    -moz-user-select: none;
    -khtml-user-select: none;
    -webkit-user-select: none;
}
.adw {
     -ms-user-select: none;
    -moz-user-select: none;
    -khtml-user-select: none;
    -webkit-user-select: none;
}
.side-button-2:hover {
    transform: rotate(45deg) scale(1.1);
    color: #FFF;
}
</style>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="ajax.js"></script>
<?php

$levelid = $_SESSION['logged_user_level'];
$avatar = $_SESSION['avatars'];
$userid = $_SESSION['logged_user_Id'];
$sth = $pdo->prepare("SELECT * FROM `settinguser` WHERE `Iduser` = :userid");
$sth->execute(array('userid' => $userid));
$color = $sth->fetch(PDO::FETCH_OBJ);
$colordisignsetting = $color->colordisign;
$hide_toolbarsetting = $color->hide_toolbar;
$invitesettinng = $color->invite;

$userid = $_SESSION['logged_user_Id'];


$sthas = $pdo->prepare("SELECT * FROM `user` WHERE `Id` = :userid");
$sthas->execute(array('userid' => $userid));
$avataras_ = $sthas->fetch(PDO::FETCH_OBJ);
$avatar = $avataras_->avatar;
$adminsetting = $avataras_->admin;
?>
<?php if ($_SESSION['themeClass'] == '') { ?>

<header class="p-3 bg-dark text-white" <?php if ($hide_toolbarsetting == '0') { ?> style="position: fixed; width: 100%; top: 0;" <?php } ?>>
<?php } else { ?> <header class="p-3 bg-white text-black" <?php if ($hide_toolbarsetting == '0') { ?> style="position: fixed; width: 100%; top: 0" <?php } ?>>  <?php } ?>

    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="obvod" style="text-decoration: none">
        <span class="fs-4"><a class="obvod2" href="/" style="color: <?php echo $colordisignsetting; ?>; font-size: 25px">NOVOCOMP.Work</a></span>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0" style="margin-top: 5px; margin-left: 15px;">
          <li><a href="/" <?php if ($_SESSION['themeClass'] == '') { ?> class="nav-link px-2 text-white" <?php } else { ?> class="nav-link px-2 text-black" style="color: black;" <?php } ?> >Заказы</a></li>
          <?php if ($invitesettinng == '1') { ?>
          <li><a href="/invite.php" <?php if ($_SESSION['themeClass'] == '') { ?> class="nav-link px-2 text-white" <?php } else { ?> class="nav-link px-2 text-black" style="color: black;" <?php } ?> >Заявки</a></li> <?php } ?>
          <?php if ($adminsetting == '1') { ?>
          <li><a href="/admin.php" <?php if ($_SESSION['themeClass'] == '') { ?> class="nav-link px-2 text-white" <?php } else { ?> class="nav-link px-2 text-black" style="color: black;" <?php } ?> >Управление</a></li> <?php } ?>
        </ul>


        <div class="text-end">

          <table style="border: none;"><tr style="border: none;"><td style="border: none;">
          <img src="<?php echo $avatar; ?>" class="avatar" alt="нет аватара" style="object-fit: cover; width: 40px; height: 40px; margin-right: 5px; margin-top: 5px"></td><td style="border: none;">
          <a href="/kabinet.php" class="obvod2" style="font-size: 20px; font-weight: bold; color:<?php echo $colordisignsetting; ?>; text-decoration: none; margin-bottom: 10px"><?php echo $_SESSION['logged_user']; ?></a></td>
<td style="width: 20px; border: none"></td>
          <td style="border: none;"><div class="d-flex gap-5 justify-content-center">
            <div class="side-button-1-wr">
    <label class="side-button-1" for="side-checkbox">
      <div class="side-b side-open">

<script>
  setInterval(function(){
$("#psina").load("# #psina"); }, 5000); // 1000 это 1 секунда
</script>

<div class="chat-upload" id="psina">

        <?php
$message_new = 0;
$sthmsad = $pdo->prepare("SELECT DISTINCT `from_mes` FROM `message` WHERE (`for_mes` = $userid) and (`read_mes` = '0') ORDER BY `Id` DESC");
$sthmsad->execute(array());
while ($message_new_db = $sthmsad->fetch(PDO::FETCH_OBJ)) {


if ($message_new_db->from_mes != $userid) {
  $message_new = $message_new + 1;
} }

        if ($message_new != NULL or $message_new != 0) { ?>
          <div class="ksu_kotyatka" style="position: absolute; bottom: 15px; margin-left: 20px; border-radius: 100px; background: <?php echo $colordisignsetting; ?>; border: 0.3px solid #4682B4; width: 17px; text-align: center; font-size: 10px; color: black"><?php echo $message_new; ?></div>
        <?php } ?>
          <div style="border: none; <?php if ($_SESSION['themeClass'] == '') { ?>background: #242428; <?php } else { ?>background: #ffffff; <?php } ?>"><img src="/img/chat0.png" alt="Чат" style="width: 32px; height: 32px;"></div>
</div>
        </div>

        </label></div></td></tr></table>
        </div>
      </div>
    </div>
    </div>
    <hr style="<?php if ($_SESSION['themeClass'] == '') { ?> border: 0.5px solid white; <?php } else { ?> border: 0.5px solid black; <?php } ?>">
  </header>
    <?php
    if ($hide_toolbarsetting == '0') { ?> <div style="margin-top: 90px"><br></div> <?php } ?>

    <input type="checkbox" id="side-checkbox" />
<div class="side-panel">
    <label class="side-button-2" for="side-checkbox">+</label>
    <div class="side-title">Личные сообщения:</div>



    <?php
$user = 1;
$btn_ = 'btnbtn_update';

$user_ = 0;
$ididid = -100;

$sths = $pdo->prepare("SELECT * FROM `user` WHERE `Id` != $userid ORDER BY `Id` DESC");
$sths->execute(array());
while ($bookmes = $sths->fetch(PDO::FETCH_OBJ)) {

$fromname = $bookmes->name;
$fromId = $bookmes->Id;
$fromava = $bookmes->avatar;

$sthd = $pdo->prepare("SELECT * FROM `message` WHERE (`for_mes` = $userid and `from_mes` = $fromId) or (`from_mes` = $userid and `for_mes` = $fromId) ORDER BY Id DESC");
$sthd->execute(array());
$usermes = $sthd->fetch(PDO::FETCH_OBJ);

$read_mes = $usermes->read_mes;
$text = $usermes->text_mes;
$time_mes = $usermes->time_mes;
$date_mes = $usermes->date_mes;
$from_mes = $usermes->from_mes;

if ($text == NULL) {
  $text = 'Начните свой первый диалог с '.$fromname;
}

$message = 0;
$sthm = $pdo->prepare("SELECT * FROM `message` WHERE `for_mes` = $userid and `from_mes` = $fromId and `read_mes` = '0' ORDER BY `Id` DESC");
$sthm->execute(array());
while ($numbermes = $sthm->fetch(PDO::FETCH_OBJ)) {

$message = $message + 1;
}

if ($message == 0) {
  $message = NULL;
}
$code = mb_detect_encoding($text);
if ($code == 'UTF-8') {
  $maxnumber = 66;
  $textnumber = mb_strlen($text, 'utf-8');
} else {
  $maxnumber = 25;
  $textnumber = strlen($text);
}
if ($textnumber >= $maxnumber) {
  $text = substr_replace($text, '...', $maxnumber, 500);
}

if ($read_mes == NULL) {
  $read_mes = 1;
}

$datenow = date("d.m.Y");
$plusonedate = date("d.m.Y", strtotime("-1 day", strtotime($datenow)));
if ($plusonedate == $date_mes) {
  $times = 'Вчера';
} else {
  $times = $date_mes;
}
if ($date_mes == NULL) {
  $times = '';
}
if ($datenow == $date_mes) {
    $times = $time_mes;
  }
  ?>
<div class="container">
<div class="list-group mx-0" style="width: 500px;">
  <div class="side-button-1-wr">
  <?php $user = $user + 1; ?>
</div>


<label class="side-button-1" for="side-checkbox<?php echo $user; ?>" style="margin-bottom: 5px" >
<div class="side-b side-open">
<div style="<?php if ($read_mes == 0 and $from_mes != $userid) { ?> background: #E0FFFF; <?php } else { ?> background: white; <?php } ?> width: 467px;">
<table style="width: 380px; border: none; position: absolute; margin-top: 7px; margin-left: 80px" ><tr><td style="border: none; width: 250px; font-size: 17px;"><a class="obvod" style="text-decoration: none; color: <?php echo $colordisignsetting; ?>"><?php echo $fromname; ?></a></td><td style="border: none; width: 130px; text-align: right; font-size: 10px; color: black;"><?php echo $times; ?></td></tr>
<tr style=""><td style="border: none; width: 350px; font-size: 12px; color: black"><?php if ($from_mes == $userid) { ?> <a style="color: gray">Вы: </a> <?php } ?><?php echo $text; ?></td>

  <td style="border: none;"><div class="d-flex gap-5 justify-content-center"><div style="border-radius: 100px; <?php if ($read_mes == 0 and $from_mes != $userid) { ?> background: <?php echo $colordisignsetting; ?>; border: 0.3px solid #4682B4; <?php } ?> width: 17px; text-align: center; font-size: 10px; color: black"><?php if ($read_mes == 0 and $from_mes != $userid) { echo $message; } ?></div></div></td></tr>
</table>
  <img src="<?php echo $fromava; ?>" class="avatar" style="object-fit: cover; width: 70px; height: 70px;">
</div>
</div>
</label>
</div>
</div>

<input type="checkbox" id="side-checkbox<?php echo $user; ?>" />
<div class="side-panel2">
    <label class="side-button-2" for="side-checkbox<?php echo $user; ?>">+</label>
    <div class="side-title" style="text-align: center;" ><img src="<?php echo $fromava; ?>" class="avatar" style="object-fit: cover; width: 40px; height: 40px;"> <?php echo $fromname; ?>

  </div>

    <div class='chat' style="border:1px solid #333; margin-left:15px; width:95%; height:530px; background:#fff; color:black;">
  <div class='chat-messages' style="height:93%; overflow:auto; ">
    <div class='chat-messages__content' id='messages' style="padding: 1px; min-height: 300px">

<?php
$ididid = $ididid + 1;
$btn_ = $btn_.'x';
?>

<script>
  setInterval(function(){
$("#<?php echo $ididid; ?>").load("# #<?php echo $ididid; ?>"); }, 1000); // 1000 это 1 секунда
  lastMessageScroll('smooth');
</script>

<div class="chat-upload" id="<?php echo $ididid; ?>">

<?php
$date_1 = NULL;
$date_2 = NULL;
$date_false = NULL;
$date_true = NULL;
$now = NULL;
$now_ = NULL;
?>

 <?php //Переписка начало ------------------------------------------------------------------------
$sthmn = $pdo->prepare("SELECT * FROM `message` WHERE (`for_mes` = $userid and `from_mes` = $fromId) or (`from_mes` = $userid and `for_mes` = $fromId) ORDER BY `Id` ASC");
$sthmn->execute(array());
while ($mess = $sthmn->fetch(PDO::FETCH_OBJ)) {
$text = $mess->text_mes;
$time_mes = $mess->time_mes;
$date_mes = $mess->date_mes;
$from_mes = $mess->from_mes;
$read_mes = $mess->read_mes;

$code = mb_detect_encoding($text);
if ($code == 'UTF-8') {
  $text2 = wordwrap($text, 64, "\n", true);
$text3 = wordwrap($text2, 104, "\n", true);
$text4 = wordwrap($text3, 144, "\n", true);
$text5 = wordwrap($text4, 184, "\n", true);
$text6 = wordwrap($text5, 224, "\n", true);
$text = wordwrap($text6, 264, "\n", true);
} else {
  $text2 = wordwrap($text, 32, "\n", true);
$text3 = wordwrap($text2, 52, "\n", true);
$text4 = wordwrap($text3, 72, "\n", true);
$text5 = wordwrap($text4, 102, "\n", true);
$text6 = wordwrap($text5, 132, "\n", true);
$text = wordwrap($text6, 162, "\n", true);
}

if ($date_true == NULL) {
$date_1 = $date_mes;
$date_true = 1;
$date_false = NULL;
} else {
if ($date_false == NULL) {
    $date_2 = $date_mes;
    $date_true = NULL;
} }

  if ($date_1 != $date_2) {
    $now = 1;
  } else {
    $now = 0;
  }

if ($now_ == NULL) {
if ($read_mes == 0 and $from_mes != $userid) {
    $now_ = 1;
  }
}
?>

<?php if ($now == 1) { ?>
<div class="adw" style="font-size: 10px; text-align: center;" ><?php echo $date_mes; ?></div>
<?php } ?>

<?php if ($now_ == 1) {
$now_ = 2;
  ?>
<div class="adw" style="font-size: 10px; text-align: center;" >Новые сообщения</div>
<?php } ?>

<?php if ($from_mes == $userid) { ?>
  <div class="mess_from_me" style="background: <?php echo $colordisignsetting; ?>; border: 1px solid <?php echo $colordisignsetting; ?>; border-radius: 20px; padding: 5px 5px; margin-top: 5px; max-width: 85%; font-size: 15px;">
<?php echo $text; ?><a style="float:right; font-size: 10px; margin-top: 10px; margin-right: 5px; margin-left: 10px; color: #242"><?php echo $time_mes; ?></a>
</div>
<?php } else { ?>

<div class="mess_for_me" style="background: #778899; border: 1px solid #778899; border-radius: 20px; padding: 5px 5px; margin-top: 5px; max-width: 85%; font-size: 15px">
<?php echo $text; ?><a style="float:right; font-size: 10px; margin-top: 10px; margin-right: 5px; margin-left: 10px; color: #242"><?php echo $time_mes; ?></a>
</div>
<?php } ?>
<br class="clear">

<?php } ?>

</div>
<div class="sak"></div>
 <?php //Переписка конец --------------------------------------------------------------------------?>
    </div>
  </div>

  <div class='chat-input'>
<?php

$user_ = $user_ + 1;
?>
 <form method="post" id="<?php echo $user_; ?>" action="" >
      <input type='search' name="name" id="name<?php echo $user_; ?>" onkeydown="if(event.keyCode==13){return false;}" class='chat-form__input' placeholder='Введите сообщение' autocomplete="off" style="width: 390px; margin-left: 10px; color: white; background: #242428" maxlength='150' required>
      <button type="button" id="<?php echo $fromId; ?>" class="red" style="width: 50px; margin-bottom: 8px; margin-left: 5px; background: white"><img src="/img/mes.png" alt="=>"  style="width: 25px; height: 25px;"></button>
</div>
 <input type='hidden' name="phonenumber" value="<?php echo $fromId; ?>">
     </form>
  </div>
    </div>
    <script type="text/javascript">
$("#name<?php echo $user_; ?>").keyup(function(event){
    if(event.keyCode == 13){
        $("#<?php echo $fromId; ?>").click();
    }
});

$(document).ready(function() {
  $('input').keydown(function(e) {
    if(e.keyCode === 13) {
      // можете делать все что угодно со значением текстового поля console.log($(this).val());
    }
  });
});

      $( document ).ready(function() {
    $("#<?php echo $fromId; ?>").click(
    function(){

      sendAjaxForm('result_form', '<?php echo $user_; ?>', 'send.php');

    $('#name<?php echo $user_; ?>').val('');

   $(this).parents('.<?php echo $user_; ?>').children('.name').val('');
      return false;
    }
  );
    lastMessageScroll('smooth');
});

function sendAjaxForm(result_form, ajax_form, url) {
    $.ajax({

        url:     '/send.php', //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#"+ajax_form).serialize(), // Сеарилизуем объект

        success: function(response) { //Данные отправлены успешно
          result = $.parseJSON(response);
          $('#result_form').html('Имя: '+result.name+'<br>Телефон: '+result.phonenumber);
          setTimeout(() => {  lastMessageScroll('smooth') }, 1000);
      },

      error: function(response) { // Данные не отправлены
          $('#result_form').html('Ошибка. Данные не отправлены.');
      }
  });
}
    </script>
<script type="text/javascript">

    </script>
 <?php } ?>
        </div>
<script>
function lastMessageScroll(b) {
    var e = document.querySelector(".sak");
    if (!e) return ;

    e.scrollIntoView({
        behavior: b || 'auto',
        block: 'end',
    });
}
</script>
</div>
</div></div></div></div></header></header></body></html>
