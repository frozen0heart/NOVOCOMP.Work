<?php
  require "configDB.php";
  require "configDB1.php";

  $levelid = $_SESSION['logged_user_level'];
  $user = $_SESSION['logged_user'];
  $userid = $_SESSION['logged_user_Id'];

  $sth = $pdo->prepare("SELECT * FROM `settinguser` WHERE `Iduser` = :userid");
$sth->execute(array('userid' => $userid));
$color = $sth->fetch(PDO::FETCH_OBJ);
$invitesettinng = $color->invite;

  $sth = $pdo->prepare("SELECT * FROM `settinguser` WHERE `Iduser` = :userid");
$sth->execute(array('userid' => $userid));
$color = $sth->fetch(PDO::FETCH_OBJ);
$colordisignsetting = $color->colordisign;

  $d = 0;
  $Id = $_POST['id'];
  $data = $_POST;

if ($_SESSION['otmena'] == 1) { $err =  $_SESSION['otmena']; $_SESSION['otmena'] = 3;}
if ($_SESSION['otmena'] == 0) { $err =  $_SESSION['otmena']; $_SESSION['otmena'] = 3;}

if( isset($data['otmena']) )
  {
$sth_ = $pdo->prepare("SELECT * FROM `reg` WHERE `Id` = $Id");
$sth_->execute();
$regz = $sth_->fetch(PDO::FETCH_OBJ);
$avatars = $regz->avatar;
unlink($avatars);
$_SESSION['otmena'] = 1;
$sql = 'DELETE FROM `reg` WHERE `Id` = ?';
$query = $pdo->prepare($sql);
$query->execute([$Id]);
header('Location: /invite.php');
}

if( isset($data['result']) )

  { $_SESSION['otmena'] = 0;
    $iduser = $_POST['id'];
    $query = $pdo->prepare("UPDATE `reg` SET `status` = '1' WHERE `Id` = $iduser ");
    $query->execute(array());

$sth_ = $pdo->prepare("SELECT * FROM `reg` WHERE `Id` = $Id");
$sth_->execute();
$regz = $sth_->fetch(PDO::FETCH_OBJ);
$name = $regz->name;
$login = $regz->login;
$password = $regz->password;
$avatar = $regz->avatar;
$level = $_POST['lvl'];
$datereg = date("d.m.Y");
$sql_ = 'INSERT INTO user(name, login, password, level, avatar, status, datereg) VALUES(:name, :login, :password, :level, :avatar, :status, :datereg)';
$query_ = $pdo->prepare($sql_);
$query_->execute(['name' => $name, 'login' => $login, 'password' => $password, 'avatar' => $avatar, 'level' => $level, 'status' => 'Зарегистрирован', 'datereg' => $datereg]);

$users = R::findOne('user', 'login = ?', array($login)); //ищет совпадения
    if( $users )
    {
      if( $users->password == $password )
      {
        $iduser = $users->Id; } }

$sql = 'INSERT INTO settinguser(Iduser, createzakaz, invite, numberzakaz, createzakazlevel, colordisign) VALUES(:Iduser, :createzakaz, :invite, :numberzakaz, :createzakazlevel, :colordisign)';
$query = $pdo->prepare($sql);
$query->execute(['Iduser' => $iduser, 'createzakaz' => '0', 'invite' => '0', 'numberzakaz' => '1', 'createzakazlevel' => '1', 'colordisign' => '#FFA500']);
      header('Location: /invite.php'); }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=1100px, initial-scale=1.0"><meta name="viewport" content="width=1100px, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://yastatic.net/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js" type="text/javascript"></script>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="icon" href="img/ico.ico" type="image/x-icon">
  <title>NOVOCOMP.Work</title>
<style>
   body {
   background: #242428;
}
/* Стили Тёмной темы */
body.dark-theme {
    background: #fff;
}
.form1 {
  background: #FFFFFF;
  border: 5px solid <?php echo $colordisignsetting; ?>;
  border-radius: 20px;
  padding: 10px 10px;
}
  </style>
</head>
<body class="<?php echo $_SESSION['themeClass']; ?>">
    <?php if($levelid < 1) {
  ?> <a style="font-size: 20px; color: gray">У вас нет прав для посещения данной страницы</a>
  <a href="/" style="font-size: 16px; color: red; margin-top: 8px" class="obvod">На главную</a> <?php exit();
}

  if($invitesettinng == 0) {
  ?> <a style="font-size: 20px; color: gray">Недостаточно прав для посещения данной страницы, запросите разрешения у администратора </a>
  <a href="/" style="font-size: 16px; color: red; margin-top: 8px" class="obvod">На главную</a> <?php exit();
}
?>
<?php require 'header.php';
if ($err == '0') { ?>
    <div class="center" style="color: green; font-size: 15px; margin-top: 10px">Заявка принята</div>
   <?php }
  if ($err == '1') { ?>
    <div class="center" style="color: red; font-size: 15px; margin-top: 10px">Заявка отклонена</div>
 <?php }
$sth = $pdo->prepare("SELECT * FROM `reg` WHERE `status` = '0' ORDER BY `Id` DESC");
$sth->execute(array());
$d = 0;
while ($book = $sth->fetch(PDO::FETCH_OBJ)) {
    $d = $d + 1;
  $date = $book->datereg;
  $time = $book->timereg;
  $ds = 1;
  $t = 1;
$datenow = date("d.m.Y");
$timennow_ = date("H:i");
$timennow = date("H:i", strtotime("+1 hour", strtotime($timennow_)));
  if ($time == $timennow) {
    $t = ' Только что';
  }
$plusonetime = date("H:i", strtotime("-1 minute", strtotime($timennow)));
if ($time == $plusonetime) {
    $t = '1 минуту назад';
  }
  $plusonetime = date("H:i", strtotime("-2 minute", strtotime($timennow)));
if ($time == $plusonetime) {
    $t = '2 минуты назад';
  }
  $plusonetime = date("H:i", strtotime("-3 minute", strtotime($timennow)));
if ($time == $plusonetime) {
    $t = '3 минуты назад';
  }
  $plusonetime = date("H:i", strtotime("-4 minute", strtotime($timennow)));
if ($time == $plusonetime) {
    $t = '4 минуты назад';
  }
  $plusonetime = date("H:i", strtotime("-5 minute", strtotime($timennow)));
if ($time == $plusonetime) {
    $t = '5 минут назад';
  }
  $plusonedate = date("d.m.Y", strtotime("-1 day", strtotime($datenow)));
if ($plusonedate == $date) {
    $ds = 'Вчера';
  }
if ($date == $datenow) {
    $ds = 'Сегодня';
  }
  ?>
  <div class="d-flex gap-5 justify-content-center">
<div class="container" style="width: 800px; margin-top: 25px">
    <div class="form1" style="width: 800px;">
<div class="list-group mx-0" style="width: 800px;">
<img src="<?php echo $book->avatar; ?>" class="avatar" style="object-fit: cover; width: 200px; height: 200px;">
<table style="position: absolute; width: 575px; margin-left: 175px"><tr><td style="width: 200px; text-align: left; font-size: 15px"><?php if ($ds == '1') { echo $date; } else { echo $ds; } ?> <?php if ($t == '1') { echo "в"; } else { echo "-"; } ?> <?php if ($date == $datenow) { if($t == '1') {echo $time;} else {echo $t;} } else { echo $time; } ?></td><td><div class="obvod" style="color:<?php echo $colordisignsetting; ?>; font-size: 25px; text-align: right"><?php echo $book->name; ?></div></td></tr>
<tr><td></td><td><div class="obvod" style="color:black; font-size: 20px; margin-bottom: 20px; text-align: right"><?php echo $book->login; ?></div></td></tr></table><table style="position: absolute; width: 575px; margin-left: 175px; margin-top: 80px"><tr><td>
            <div style="color: green; font-size: 15px; margin-bottom: 10px; text-align: center;">Какого уровня сотрудник?</div>
          <form action="/invite.php" method="post" id="f">
          <div class="d-flex gap-5 justify-content-center">
<div class="form-check" style="margin-bottom: 15px">
  <input class="form-check-input" name="lvl" type="radio" value="1" id="lvl1" checked>
  <label class="form-check-label" for="flexCheckDefault" style="text-align: left; font-size: 15px">
    Уровень 1
  </label>
</div>
<div class="form-check" style="margin-bottom: 10px">
  <input class="form-check-input" name="lvl" type="radio" value="2" id="lvl2">
  <label class="form-check-label" for="flexCheckDefault" style="text-align: left; font-size: 15px">
    Уровень 2
  </label>
</div>
<div class="form-check" style="margin-bottom: 10px">
  <input class="form-check-input" name="lvl" type="radio" value="3" id="lvl3">
  <label class="form-check-label" for="flexCheckDefault" style="text-align: left; font-size: 15px">
    Уровень 3
  </label></td></tr><tr><td>
    <input type="hidden" name="id" id="id" value="<?php echo $book->Id; ?>">
  <div class="d-flex gap-5 justify-content-center">
  <button type="submit" name="otmena" class="btn btn-danger fw-bold border-black" style="width: 200px">Отклонить заявку</button>
<button type="submit" name="result" class="btn fw-bold border-black" style="background: <?php echo $colordisignsetting; ?>; width: 200px">Подтвердить заявку</button>
</td></tr></table></div></td></tr></div></div></form></td></tr></table>
</div></div>
<?php } ?>
<br>
<?php if ($d == '0') { ?>
  <div class="center" style="color:<?php echo $colordisignsetting; ?>; font-size: 30px; margin-top: 10px">Нет ни одной поступившей заявки</div>
<?php } ?>
</body>
</html>




