<?php
	require "configDB.php";
  require "configDB1.php";
$avatar = $_SESSION['avatar'];
$userid = $_SESSION['logged_user_Id'];
$levelid = $_SESSION['logged_user_level'];

$sth = $pdo->prepare("SELECT * FROM `settinguser` WHERE `Iduser` = :userid");
$sth->execute(array('userid' => $userid));
$color = $sth->fetch(PDO::FETCH_OBJ);
$colordisignsetting = $color->colordisign;



$picture = $_FILES['picture'];
if ($picture == NUll) {

} else {
  $findme = 'ava/';
  $avatars = $_SESSION['avatar'];
$pos = strpos($avatars, $findme);
if ($pos === false) {
  $avatars = 'ava/'.$avatars;
}
unlink($avatars);

$path = 'ava/';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
 $avatarf = $_FILES['picture']['name'];
 $avatar = 'ava/'.$avatarf;
  if (!@copy($_FILES['picture']['tmp_name'], $path . $_FILES['picture']['name']))
    $redava = 1;
}
$_SESSION['avatar'] = $avatar; $redava = 1;

    $query = $pdo->prepare("UPDATE `user` SET `avatar` = :avatar WHERE `Id` = $userid");
    $query->execute(array('avatar' => $avatar));
}


$data = $_POST;
if( isset($data['redinfo']) )
  {
$name = $_POST['name'];
$login = $_POST['login'];
$oldpassword = $_POST['oldpassword'];
$newpassword = $_POST['newpassword'];
$mail = $_POST['mail'];

$sth = $pdo->prepare("SELECT * FROM `user` WHERE `Id` = :Id");
$sth->execute(array('Id' => $userid));
$reduser = $sth->fetch(PDO::FETCH_OBJ);
$true_password = $reduser->password;
$true_login = $reduser->login;
$zaglushka = $login;
if ($true_login == $login) {
  $zaglushka = '♪♪♪frozen_heart_♪♪♪';
}
if ( R::count('user', "login = ?", array($zaglushka) ) > 0)
    { $errorlogin = '1'; } else {
if ($newpassword == NULL or $newpassword == '') {
  $query = $pdo->prepare("UPDATE `user` SET `name` = :name, `login` = :login, `mail` = :mail WHERE `Id` = $userid");
    $query->execute(array('name' => $name, 'login' => $login, 'mail' => $mail));
    $redinfo = '1';
} else {
  if ($true_password == $oldpassword) {
$query = $pdo->prepare("UPDATE `user` SET `name` = :name, `login` = :login, `password` = :password, `mail` = :mail WHERE `Id` = $userid");
    $query->execute(array('name' => $name, 'login' => $login, 'password' => $newpassword, 'mail' => $mail));
$redinfo = '1';
 } else { $errorpassword = '1'; } } } }


if( isset($data['redstatus']) )
  {
$status = $_POST['bdF17'];

$query = $pdo->prepare("UPDATE `user` SET `status` = :status WHERE `Id` = $userid");
    $query->execute(array('status' => $status));
    $redstatus = 1;
  }

if( isset($data['optionacc']) )
  {
$colordisign = $_POST['colordisign'];

if ($colordisign == '#000000') {
  $colordisign = '#FFA500';
}
if ($colordisign == '#ffffff') {
  $colordisign = '#FFA500';
}

$query = $pdo->prepare("UPDATE `settinguser` SET `colordisign` = :colordisign WHERE `Iduser` = $userid");
    $query->execute(array('colordisign' => $colordisign));
    header('Location: /kabinet.php');
  }

$themeClass = '';
if (isset($_GET['theme'])) {
if (isset($_GET['theme']) && $_GET['theme'] == 'light') {
  $_SESSION['themeClass'] = '';
}
if (isset($_GET['theme']) && $_GET['theme'] == 'dark') {
  $_SESSION['themeClass'] = 'dark-theme';
  $themeClass = 'dark-theme';
}
$themeToggle = ($themeClass == '') ? 'dark' : 'light';
$_SESSION['themeToggle'] = $themeToggle;
}
  $levelid = $_SESSION['logged_user_level'];
  $user = $_SESSION['logged_user'];
  $userid = $_SESSION['logged_user_Id'];

  $lvl3 = $_POST['lvl3'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=1100px, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://yastatic.net/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js" type="text/javascript"></script>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="icon" href="img/ico.ico" type="image/x-icon">
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <title>NOVOCOMP.Work</title>
<style>
  body {
   background: #242428;
}
/* Стили Тёмной темы */
body.dark-theme {
    background: #fff;
}
   td{
     border: 1px solid #242428;
   }
.avatar2 {
    border-radius: 100px; /* Радиус скругления */
    border: 1px solid white; /* Параметры рамки */
    box-shadow: 0 0 7px #666; /* Параметры тени */
image-rendering: pixelated;
   }
.image-upload>input {
  display: none;
}
.avatar2:hover{
  box-shadow:0 0 15px <?php echo $colordisignsetting; ?>;
  border:1px solid <?php echo $colordisignsetting; ?>;
  cursor: pointer;
}
.field-radio:hover{
  box-shadow:0 0 15px <?php echo $colordisignsetting; ?>;
  border:1px solid <?php echo $colordisignsetting; ?>;
  cursor: pointer;
}
#zatemnenie2 {
        background: rgba(102, 102, 102, 0.5);
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        display: none;
      }
#okno2 {
        width: 600px;
        height: 450px;

        padding: 15px;
        border: 3px solid <?php echo $colordisignsetting; ?>;
        border-radius: 10px;
        color: <?php echo $colordisignsetting; ?>;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        margin: auto;
        background: #fff;
      }
#zatemnenie2:target {display: block;}
#primary_color{
    border: none;
    outline: none;
    -webkit-appearance: none;
}

#primary_color::-webkit-color-swatch-wrapper {
    padding: 0;
}
.popup__overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: rgba(0, 0, 0, 0.7);
  cursor: default;
}
.popup__overlayz {
position: fixed;
top: 0;
bottom: 0;
left: 0;
right: 0;
cursor: default;
}
.form1 {
  background: #FFFFFF;
  border: 5px solid <?php echo $colordisignsetting; ?>;
  border-radius: 20px;
  padding: 10px 10px;
}
#zatemnenie {
        background: rgba(102, 102, 102, 0.5);
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        display: none;
      }
#okno {
        width: 600px;
        height: 400px;

        padding: 15px;
        border: 3px solid <?php echo $colordisignsetting; ?>;
        border-radius: 10px;
        color: <?php echo $colordisignsetting; ?>;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        margin: auto;
        background: #fff;
      }
#zatemnenie:target {display: block;}
  </style>
</head>
<body class="<?php echo $_SESSION['themeClass']; ?>">
  <?php
if($levelid < 1) {
  ?> <a style="font-size: 20px; color: gray">У вас нет прав для посещения данной страницы</a>
  <a href="/" style="font-size: 16px; color: red; margin-top: 8px" class="obvod">На главную</a> <?php exit();
}
  ?>
<?php require 'header.php';
$result = 0;
$userwork = 0;
$price = 0;
$sth_ = $pdo->prepare("SELECT * FROM `work` WHERE `userwork` = :Id");
$sth_->execute(array('Id' => $userid));
while ($book = $sth_->fetch(PDO::FETCH_OBJ)) {
$result1 = $book->result;
if ($result1 == '1') {
  $result = $result + 1;
  $price1 = $book->price;
$price = $price + $price1;
}
if ($result1 == '0') {
  $userwork = $userwork + 1;
} }
$useradd = 0;
$sth_ = $pdo->prepare("SELECT * FROM `work` WHERE `useradd` = :Id");
$sth_->execute(array('Id' => $userid));
while ($book = $sth_->fetch(PDO::FETCH_OBJ)) {
$useradd = $useradd + 1;
}
$sth = $pdo->prepare("SELECT * FROM `user` WHERE `Id` = :Id");
$sth->execute(array('Id' => $userid));
$users = $sth->fetch(PDO::FETCH_OBJ);
$datereg = $users->datereg;
$mail = $users->mail;
$status = $users->status;
?>
    <div class="d-flex justify-content-center">
  <div class="container" style="width: 700px; margin-top: 5px">
    <div class="form1" style="height: 357px">
      <div class="d-flex justify-content-center">
              <script type="text/javascript">
  jQuery(function(){
    $("#ava").change(function(){ // событие выбора файла
      $("#myform").submit(); // отправка формы
    });
  });
</script>
        <form enctype="multipart/form-data" action="/kabinet.php" method="post" id="myform">
<div class="image-upload">
  <label for="ava">
    <img src="<?php echo $avatar; ?>" class="avatar2" alt="нет аватара" style="object-fit: cover; width: 200px; height: 200px; margin-right: 5px; margin-top: 5px">
  </label>
      <input class="avatar2" type="file" name="picture" id="ava" accept=".jpg,.jpeg,.png"></div>
</form>
      <table style="font-size: 15px"><tr><td>Имя пользователя: </td><td style="color: <?php echo $colordisignsetting; ?>"><?php echo $users->name; ?></td></tr>
        <tr><td>Логин:</td><td style="color: <?php echo $colordisignsetting; ?>"><?php echo $users->login; ?></td></tr>
        <tr><td>Уровень сотрудника:</td><td style="color: <?php echo $colordisignsetting; ?>"><?php echo $users->level; ?></td></tr>
        <tr><td>Заработано с заказов:</td><td style="color: <?php echo $colordisignsetting; ?>"><?php echo $price; ?> р.</td></tr>
        <tr><td>Выполненных заказов:</td><td style="color: <?php echo $colordisignsetting; ?>"><?php echo $result; ?></td></tr>
        <tr><td>Заказов в работе:</td><td style="color: <?php echo $colordisignsetting; ?>"><?php echo $userwork; ?></td></tr>
        <tr><td>Создано заказов:</td><td style="color: <?php echo $colordisignsetting; ?>"><?php echo $useradd; ?></td></tr>
        <tr><td>Зарегистрированы:</td><td style="color: <?php echo $colordisignsetting; ?>"><?php echo $datereg; ?></td></tr>
      </table></div>
      <?php if ($mail == NULL) { ?>
        <div class="d-flex justify-content-center">
<input type="submit" class="obvod" style="color: red; margin-top: 10px; font-size: 17px" onclick="window.location.href = '#zatemnenie';" id="submitB" name="reg" value="Не указанa электронная почта!"></div>
      <?php } else { ?>
      <div style="font-size: 20px; margin-top: 10px; text-align: center;" class="obvod"><a style="color: <?php echo $colordisignsetting; ?>">Электронная почта: </a><?php echo '<span>'.$mail.'</span>'; ?></div> <?php } ?>
     <?php /* <div style="font-size: 20px; margin-top: 10px; text-align: center;"><a style="color: grey">Статус: </a><?php echo $status; ?> <input type="submit" style="color: <?php echo $colordisignsetting; ?>; font-size: 15px" onclick="window.location.href = '#zatemnenie2';" id="submitB" name="status" value="Изменить"></div> */ ?>
<div class="d-flex gap-5 justify-content-center">
<input type="button" class="obvod" style="color: <?php echo $colordisignsetting; ?>; margin-top: 10px; font-size: 15px;" onclick="window.location.href = '#zatemnenie';" id="submitB" name="reg" value="Изменить основную информацию"></div>
<div class="d-flex gap-5 justify-content-center">
<a href="/logout.php" style="font-size: 15px; margin-top: 10px; color: red" class="center">Выйти из аккаунта</a></div>
<?php if ($redstatus == '1') { ?> <div style="color: green; font-size: 15px; margin-bottom: 10px; margin-top: 10px; text-align: center;">Статус изменён</div> <?php } ?>
<?php if ($redava == '1') { ?> <div style="color: green; font-size: 15px; margin-bottom: 10px; margin-top: 10px; text-align: center;">Изображение загружено</div> <?php } ?>
<?php if ($redinfo == '1') { ?> <div style="color: green; font-size: 15px; margin-bottom: 10px; margin-top: 10px; text-align: center;">Изменения сохранены</div> <?php } ?>
<?php if ($errorlogin == '1') { ?> <div style="color: red; font-size: 15px; margin-bottom: 10px; margin-top: 10px; text-align: center;">Такой логин уже занят</div> <?php } ?>
<?php if ($errorpassword == '1') { ?> <div style="color: red; font-size: 15px; margin-bottom: 10px; margin-top: 10px; text-align: center;">Неверно введён старый пароль</div> <?php } ?>
</div>
</div>
  <div class="container" style="width: 600px; margin-top: 5px">
    <div class="form1">
      <div class="center" style="color:<?php echo $colordisignsetting; ?>; font-size: 20px; margin-bottom: 15px">Ваши разрешения</div>
<?php
$stha = $pdo->prepare("SELECT * FROM `settinguser` WHERE `Iduser` = :Id");
$stha->execute(array('Id' => $userid));
$setting = $stha->fetch(PDO::FETCH_OBJ);

$create = $setting->createzakaz;
$invite = $setting->invite;
$finance = $setting->finance;
$numberzakaz = $setting->numberzakaz;
$createzakazlevel = $setting->createzakazlevel;
$allmail = $setting->allmail;

if ($create == 1) {
  $create = 'Да';
} else { $create = 'Нет'; }

if ($invite == 1) {
  $invite = 'Да';
} else { $invite = 'Нет'; }

if ($finance == 1) {
  $finance = 'Да';
} else { $finance = 'Нет'; }

if ($createzakazlevel == 1) {
  $createzakazlevel = 'Для 1го уровня';
}

if ($createzakazlevel == 2) {
  $createzakazlevel = 'Для 2го уровня';
}

if ($createzakazlevel == 3) {
  $createzakazlevel = 'Для 3го уровня';
}

if ($createzakazlevel == 12) {
  $createzakazlevel = 'Для 1го и 2го уровня';
}

if ($createzakazlevel == 13) {
  $createzakazlevel = 'Для 1го и 3го уровня';
}

if ($createzakazlevel == 123) {
  $createzakazlevel = 'Для любого уровня';
}

if ($allmail == 1) {
  $allmail = 'Да';
} else { $allmail = 'Нет'; }
?>
    <table style="font-size: 15px;"><tr><td>Создавать заказы</td><td style="text-align: center; color: <?php echo $colordisignsetting; ?>"><?php echo $create; ?></td></tr>
<tr><td>Просматривать заявки</td><td style="text-align: center; color: <?php echo $colordisignsetting; ?>"><?php echo $invite; ?></td></tr>
<?php /*
<tr><td>Просматривать аналитику</td><td style="text-align: center; color: <?php echo $colordisignsetting; ?>"><?php echo $finance; ?></td></tr> */ ?>
<tr><td>Допустимое кол-во взятых заказов</td><td style="text-align: center; color: <?php echo $colordisignsetting; ?>"><?php echo $numberzakaz; ?></td></tr>
<?php if ($create == 'Да') { ?>
  <tr><td>Для какого уровня может быть создан заказ</td><td style="text-align: center; color: <?php echo $colordisignsetting; ?>"><?php echo $createzakazlevel; ?></td></tr>
<?php } ?>
<?php /*
<tr><td>Создавать рассылки</td><td style="text-align: center; color: <?php echo $colordisignsetting; ?>"><?php echo $allmail; ?></td></tr> */ ?>
</table>

<?php
$colordisign = $setting->colordisign;
$notificationofinvite = $setting->notificationofinvite;
$hide_toolbar = $setting->hide_toolbar;
$autostatus = $setting->autostatus;

if ($autostatus == 1) {
  $autostatus = 'Да';
} else { $autostatus = 'Нет'; }

if ($hide_toolbar == 1) {
  $hide_toolbar = 'Да';
} else { $hide_toolbar = 'Нет'; }

if ($notificationofinvite == 1) {
  $notificationofinvite = 'Да';
} else { $notificationofinvite = 'Нет'; }

if ($colordisign == NULL) {
  $colordisign = '#FFA500';
}
?>
      <div class="center" style="color:<?php echo $colordisignsetting; ?>; font-size: 20px; <?php if ($redsetting == NULL) { ?> margin-bottom: 15px; <?php } ?> margin-top: 15px">Персональные настройки</div>
     <?php if ($redsetting == '1') {
  ?> <div style="color: green; font-size: 15px; margin-bottom: 10px; text-align: center;">Изменения сохранены</div> <?php
} ?>
    <table style="font-size: 15px;">
<tr><td>Тема веб-сайта</td><td style="text-align: center; width: 200px; height: 20px; <?php if ($_SESSION['themeClass'] == '') { ?> background: #242428; <?php } else { ?> background: #fff; <?php } ?>"><a style="<?php if ($_SESSION['themeClass'] == '') { ?> color: white; <?php } else { ?> color: black; <?php } ?>" href="?theme=<?php echo $_SESSION['themeToggle']; ?>"><?php if ($_SESSION['themeClass'] == '') { ?> Тёмная тема <?php } else { ?> Светлая тема <?php } ?></a></td></tr>
      <form action="/kabinet.php" method="post" id="for">
<tr><td>Цвет сайта</td><td><input type="color" name="colordisign" class="field-radio" id="primary_color" style="width: 200px; height: 20px;" value="<?php echo $colordisign; ?>"></div></td></tr>
</table>
<div class="d-flex gap-5 justify-content-center">
<input type="submit" class="obvod" style="color: <?php echo $colordisignsetting; ?>; margin-top: 10px;" id="submitB" name="optionacc" value="Подтвердить изменения"></div><div class="d-flex gap-5 justify-content-center">
<input type="reset" style="color: black; margin-top: 10px;" id="submitB" value="Сбросить"></div></form>
</div></div></div></div></form>
<br>

    <div id="zatemnenie2" style="position: fixed;">
      <a href="#" class="popup__overlay"></a>
      <div id="okno2">
        <form action="/kabinet.php" method="post" id="zzz">

<div style="color: green; font-size: 15px; margin-bottom: 10px; text-align: center;">Выберите статус из доступных или напишите пользовательский</div>
<script type="text/javascript">
  function update(e, targetId) {
  let target = document.getElementById(targetId);
  let ob = e.options[e.selectedIndex]
  target.value = `${ob.text}`
}</script>

<div class="d-flex gap-5 justify-content-center">

 <input id="bdF17" class="form-control" value="<?php echo $status; ?>" name="bdF17" maxlength="20" type="text" required autocomplete="off">
<select class="form-select" id="siF6" name="country" onchange="update(event.target, 'bdF17')">
  <option value="Свободен" <?php if ($status == 'Свободен') { ?> selected <?php } ?> class="top">Свободен</option>
  <option value="В работе" <?php if ($status == 'В работе') { ?> selected <?php } ?> class="top">В работе</option>
  <option value="Недоступен" <?php if ($status == 'Недоступен') { ?> selected <?php } ?> class="top">Недоступен</option>
</select>
</div>
<br><div style="color: <?php echo $colordisignsetting; ?>">Статус "Свободен" показывает, что вы готовы приступать к следующим задачам.</div><br>
<div style="color: <?php echo $colordisignsetting; ?>">Статус "В работе" предполагает, что вы сейчас заняты текущими заказами. Уведомления, поступающие вам, будут присланы без звука.</div><br>
<div style="color: <?php echo $colordisignsetting; ?>">Статус "Недоступен" означает, что вы не можете приступать к заказам в данный момент. Вам не смогут писать в личные сообщения другие сотрудники.</div>
<hr>
<div style="color: <?php echo $colordisignsetting; ?>">Пользовательcкий статус не имеет никаких функций.</div>
<div class="d-flex gap-5 justify-content-center">
<button type="submit" name="redstatus" class="btn btn-warning" style="margin-top: 10px; width: 250px">Подтвердить изменение</button></div>
      </form>
    </div>
  </div>



     <div id="zatemnenie" style="position: fixed;">
      <a href="#" class="popup__overlay"></a>
      <div id="okno" style="height: 380px">
        <form action="/kabinet.php" method="post" id="for">
          <h1 class="center" style="color:<?php echo $colordisignsetting; ?>; font-size: 20px; text-align: center">Основная информация</h1>

          <input type="text" value="<?php echo $users->name; ?>" name="name" id="name" placeholder="Имя и фамилия" class="form-control" style="margin-bottom: 10px" autocomplete="off" required maxlength="35">
          <input type="text" value="<?php echo $users->login; ?>" name="login" id="login" placeholder="Логин" class="form-control" style="margin-bottom: 10px" autocomplete="off" required maxlength="30">
          <input type="text" value="<?php echo $users->mail; ?>" name="mail" id="mail" placeholder="Электронная почта" class="form-control" style="margin-bottom: 10px" autocomplete="off" required maxlength="60">
          <h1 class="center" style="color:<?php echo $colordisignsetting; ?>; font-size: 20px; text-align: center">Смена пароля</h1>
          <input type="password" name="newpassword" id="newpassword" placeholder="Новый пароль" class="form-control" style="margin-bottom: 10px" autocomplete="off" maxlength="100">
          <input type="password" name="oldpassword" id="oldpassword" placeholder="Старый пароль" class="form-control" style="" autocomplete="off" maxlength="100">
<div class="d-flex gap-5 justify-content-center">
  <button type="submit" name="redinfo" class="btn fw-bold border-black" style="background: <?php echo $colordisignsetting; ?>; margin-top: 10px; width: 250px">Подтвердить изменение</button></div>
    </div>

</body>
</html>