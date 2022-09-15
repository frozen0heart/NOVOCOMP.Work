<?php
  require "configDB.php";
  require "configDB1.php";

  $levelid = $_SESSION['logged_user_level'];
  $user = $_SESSION['logged_user'];
  $userid = $_SESSION['logged_user_Id'];
  $rresult = 0;

    $sth = $pdo->prepare("SELECT * FROM `settinguser` WHERE `Iduser` = :userid");
$sth->execute(array('userid' => $userid));
$color = $sth->fetch(PDO::FETCH_OBJ);
$colordisignsetting = $color->colordisign;
$createzakazsetting = $color->createzakaz;
$numberzakazsetting = $color->numberzakaz;
$lvlsetting = $color->createzakazlevel;

if ($lvlsetting == '123') {
  $lvl1set = 1;
  $lvl2set = 1;
  $lvl3set = 1;
}

if ($lvlsetting == '12') {
   $lvl1set = 1;
  $lvl2set = 1;
}

if ($lvlsetting == '13') {
  $lvl1set = 1;
  $lvl3set = 1;
}

if ($lvlsetting == '23') {
  $lvl2set = 1;
  $lvl3set = 1;
}

if ($lvlsetting == '1') {
  $lvl1set = 1;
}

if ($lvlsetting == '2') {
  $lvl2set = 1;
}

if ($lvlsetting == '3') {
  $lvl3set = 1;
}


if ($colordisignsetting == NULL) {
  $colordisignsetting = '#FFA500';
}

$sort = $_POST['sort'];
if ($sort == '') {
  $sort = "new";
}


if ($_SESSION['sort'] == 'my') {
  $sort = 'my';
}

  $Zakasfree = $_POST['Zakasfree'];
  $Zakasfreenameclient = $_POST['Zakasfreenameclient'];
  $Zakasfreenumber = $_POST['Zakasfreenumber'];
  $Zakasfreename = $_POST['Zakasfreename'];
  $Zakasfreetask = $_POST['Zakasfreetask'];
  $Zakasfreetext = $_POST['Zakasfreetext'];
  $Zakasfreeprice = $_POST['Zakasfreeprice'];
  $Zakasfreelevel = $_POST['Zakasfreelevel'];
  $text2 = $_POST['text2'];
  $lvl1 = $_POST['lvl1'];
  $lvl2 = $_POST['lvl2'];
  $lvl3 = $_POST['lvl3'];

if ($_SESSION['create'] == 1) {
  $Zakascreate = 1;
  $_SESSION['create'] = 0;
}

$data = $_POST;
if( isset($data['my']) )
  { $sort = "my";
    $mysort = "all"; }
if( isset($data['result']) )
  { $sort = "result"; }
if( isset($data['Zakasred1']) )
  { $sort = "my"; }

if( isset($data['mycreate']) )
  { $sort = "my";
    $mysort = "mycreate"; }
if( isset($data['all']) )
  { $sort = "my";
    $mysort = "all"; }
if( isset($data['myzakaz']) )
  { $sort = "my";
    $mysort = "myzakaz"; }

if( isset($data['Zakas']) )
  {
    $userwork = 0;
    $sth_ = $pdo->prepare("SELECT * FROM `work` WHERE `userwork` = :Id");
$sth_->execute(array('Id' => $userid));
    while ($book = $sth_->fetch(PDO::FETCH_OBJ)) {
$result1 = $book->result;
if ($result1 == '0') {
  $userwork = $userwork + 1;
} }

if ($numberzakazsetting == $userwork) {
  $maxzakaz = 1;
} else {
  $query_ = $pdo->prepare("UPDATE `work` SET `userwork` = $userid WHERE `Id` = $Zakasfree");
    $query_->execute(array());
    $zakasvzyat = 1; }
}

if( isset($data['Zakasotmena']) )
  {
  $query_ = $pdo->prepare("UPDATE `work` SET `userwork` = '0' WHERE `Id` = $Zakasfree");
    $query_->execute(array());
    $Zakasotmena = 1;
    $sort = 'my'; }

if( isset($data['redrresult']) )
  {
    if ($lvl1 == NULL and $lvl2 == NULL and $lvl3 == NULL) { $lvlno = 1; } else {
      $lvlno = 0;
      $Zakasfreelevel = $lvl1.$lvl2.$lvl3;
  $query = $pdo->prepare("UPDATE `work` SET `nameclient` = :Zakasfreenameclient, `number` = :Zakasfreenumber, `name` = :Zakasfreename, `task` = :Zakasfreetask, `text` = :Zakasfreetext, `level` = :Zakasfreelevel, `price` = :Zakasfreeprice WHERE `Id` = $Zakasfree");
    $query->execute(array('Zakasfreenameclient' => $Zakasfreenameclient, 'Zakasfreenumber' => $Zakasfreenumber, 'Zakasfreename' => $Zakasfreename, 'Zakasfreetask' => $Zakasfreetask, 'Zakasfreetext' => $Zakasfreetext, 'Zakasfreelevel' => $Zakasfreelevel, 'Zakasfreeprice' => $Zakasfreeprice));
    $Zakasred = 1; } }

if( isset($data['createresult']) )
  {
    if ($lvl1 == NULL and $lvl2 == NULL and $lvl3 == NULL) { $lvlno = 2; } else {
      $lvlno = 0;
      $Zakasfreelevel = $lvl1.$lvl2.$lvl3;
      $date = date("d.m.Y");
  $sql = 'INSERT INTO work(nameclient, `number`, name, task, `text`, level, price, useradd, result, `date`, userwork) VALUES(:Zakasfreenameclient, :Zakasfreenumber, :Zakasfreename, :Zakasfreetask, :Zakasfreetext, :Zakasfreelevel, :Zakasfreeprice, :useradd, :result, :date_, :userwork)';
            $query = $pdo->prepare($sql);
            $query->execute(['Zakasfreenameclient' => $Zakasfreenameclient, 'Zakasfreenumber' => $Zakasfreenumber, 'Zakasfreeprice' => $Zakasfreeprice, 'Zakasfreename' => $Zakasfreename, 'Zakasfreetask' => $Zakasfreetask, 'Zakasfreetext' => $Zakasfreetext, 'Zakasfreelevel' => $Zakasfreelevel, 'useradd' => $userid, 'result' => '0', 'date_' => $date, 'userwork' => '0']);
            $_SESSION['create'] = 1;
    header('Location: /');} }

if( isset($data['resultzakaz']) )
  {
    $date = date("d.m.Y");
  $query = $pdo->prepare("UPDATE `work` SET `result` = '1', `text2` = :text2, `date2` = :date_ WHERE `Id` = $Zakasfree");
    $query->execute(array('text2' => $text2, 'date_' => $date));
    $rresult = 1; }

if( isset($data['Zakasdel']) )
  {
  $sql = 'DELETE FROM `work` WHERE `id` = ?';
  $query = $pdo->prepare($sql);
  $query->execute([$Zakasfree]);
    $delete = 1; }

if( isset($data['regotmena']) )
  {
  $idreg = $_SESSION['idreg'];
  $sql = 'DELETE FROM `reg` WHERE `Id` = ?';
  $query = $pdo->prepare($sql);
  $query->execute([$idreg]);
  $avatars = $_SESSION['avatars'];
$findme = 'ava/';
$pos = strpos($avatars, $findme);
if ($pos === false) {
  $avatars = 'ava/'.$avatars;
}
unlink($avatars);
$_SESSION['avatars'] = 1;
$_SESSION['reg'] = 0;
$_SESSION['errorreg'] = 0;
$_SESSION['regerror'] = 0;
header('Location: /');
}

$d = 10000;
$d1 = 10000;
$d2 = 10000;

if( isset($data['createreg']) ) // reeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeg
  {
$name = $_POST['name'];
$login = $_POST['login'];
$password = $_POST['password'];
$code = $_POST['code'];
$_SESSION['errorreg'] = 0;

if ( R::count('user', "login = ?", array($data['login']) ) > 0)
    {
      $_SESSION['errorreg'] = '1';
      $_SESSION['reg'] = 0;
if ($_SESSION['avatars'] == '1') { $vvvsfs = 1; } else {
$avatars = $_SESSION['avatars'];
$findme = 'ava/';
$pos = strpos($avatars, $findme);
if ($pos === false) {
  $avatars = 'ava/'.$avatars;
}
unlink($avatars);

$idreg = $_SESSION['idreg'];

  $sql = 'DELETE FROM `reg` WHERE `Id` = ?';
  $query = $pdo->prepare($sql);
  $query->execute([$idreg]);
  $_SESSION['avatars'] = 1;
} } else { //Если уже есть регистрация

if ($_SESSION['reg'] == '1') {

  if ($_SESSION['avatars'] == '1') {
  $vvvsfs = 1;
} else {
$avatars = $_SESSION['avatars'];
$findme = 'ava/';
$pos = strpos($avatars, $findme);
if ($pos === false) {
  $avatars = 'ava/'.$avatars;
}
unlink($avatars); }

$idreg = $_SESSION['idreg'];
$path = 'ava/';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
 $avatarf = $_FILES['picture']['name'];
 $avatar = 'ava/'.$avatarf;
  if (!@copy($_FILES['picture']['tmp_name'], $path . $_FILES['picture']['name']))
    $hello = 1;
}
 $query = $pdo->prepare("UPDATE `reg` SET `name` = :name, `login` = :login, `password` = :password, `avatar` = :avatar WHERE `Id` = $idreg");
    $query->execute(array('name' => $name, 'login' => $login, 'password' => $password, 'avatar' => $avatar));
    $_SESSION['avatars'] = $avatar;
    $_SESSION['regerror'] = 1;
} else { //Если нет регистрации
  $path = 'ava/';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $avatarf = $_FILES['picture']['name'];
  $avatar = 'ava/'.$avatarf;
  if (!@copy($_FILES['picture']['tmp_name'], $path . $_FILES['picture']['name']))
    $hello = 1;
}
$datenow = date("d.m.Y");
$timennow_ = date("H:i");
$timennow = date("H:i", strtotime("+1 hour", strtotime($timennow_)));
   $sql = 'INSERT INTO reg(name, login, password, avatar, datereg, timereg, status) VALUES(:name, :login, :password, :avatar, :datereg, :timereg, :status)';
$query = $pdo->prepare($sql);
$query->execute(['name' => $name, 'login' => $login, 'password' => $password, 'avatar' => $avatar, 'datereg' => $datenow, 'timereg' => $timennow, 'status' => '0']);
            $_SESSION['reg'] = 1;
            $_SESSION['avatars'] = $avatar;
            $_SESSION['regerror'] = 1;

$users = R::findOne('reg', 'login = ?', array($data['login'])); //ищет совпадения
    if( $users )
    {
      if( $users->password == $data['password'] )
      {
        $idreg = $users->Id;
        $_SESSION['idreg'] = $idreg;
      } } } header('Location: /'); } } // reeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeg

  if( isset($data['do_login']) )
  {
    $errors = array();
    $users = R::findOne('user', 'login = ?', array($data['login'])); //ищет совпадения
    if( $users )
    {
      if( $users->password == $data['password'] )
      {
        $user = $users->name;
        $level = $users->level;
        $iduser = $users->Id;
        $avatar = $users->avatar;
        $_SESSION['logged_user'] = $user;
        $_SESSION['logged_user_level'] = $level;
        $_SESSION['logged_user_Id'] = $iduser;
        $_SESSION['avatar'] = $avatar;

        $log = $users->login;
        $pas = $users->password;
       $users = R::findOne('reg', 'login = ?', array($log)); //ищет совпадения
    if( $users )
    {
      if( $users->password == $pas )
      {
        $id = $users->Id; } }

if ($id) {
         $sql = 'DELETE FROM `reg` WHERE `Id` = ?';
        $query = $pdo->prepare($sql);
        $query->execute([$id]);
      $_SESSION['reg'] = 0;
      $_SESSION['errorreg'] = 0;
}
      } else
      {
        $errors[] = 'Неверно введен пароль!';
      }
    } else
    {
      $errors[] = 'Сотрудник с таким логином не найден!';
    }
    if( ! empty($errors) ){}}
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
  <title>NOVOCOMP.Work</title>
</head>
<style>
   body {
   background: #242428;
}
/* Стили Тёмной темы */
body.dark-theme {
    background: #fff;
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
#zatemnenie1 {
        background: rgba(102, 102, 102, 0.5);
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
      }
#okno1 {
        width: 600px;
        height: 550px;
        text-align: center;
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
#zatemnenie1:target {display: block;}
  </style>
</head>
<body class="<?php echo $_SESSION['themeClass']; ?>">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <?php if(isset($_SESSION['logged_user'])) :
require 'header.php'; ?>



<form action="/" method="post" id="f">
   <?php if($createzakazsetting == '1') { ?>
  <div class="d-flex gap-5 justify-content-center">
    <button type="submit" name="create" class="btn btn-lg fw-bold border-orange bg-white" style="border: 1px solid <?php echo $colordisignsetting; ?>; color: black; width: 250px">Создать заказ</button></div> <?php } ?><br>
    <div class="d-flex gap-5 justify-content-center">
<button type="submit" name="new" class="<?php if($sort == 'new') { ?>btn btn-lg fw-bold border-black<?php } else {?>btn btn-lg btn-secondary fw-bold border-black bg-white<?php } ?>" style="color: black; background: <?php echo $colordisignsetting; ?>; width: 250px">Новые заказы</button>
<button type="submit" name="my" class="<?php if($sort == 'my') { ?>btn btn-lg fw-bold border-black<?php } else {?>btn btn-lg btn-secondary fw-bold border-black bg-white<?php } ?>" style="color: black; background: <?php echo $colordisignsetting; ?>; width: 250px">Мои заказы</button>
<button type="submit" name="result" class="<?php if($sort == 'result') { ?>btn btn-lg fw-bold border-black<?php } else {?>btn btn-lg btn-secondary fw-bold border-black bg-white<?php } ?>" style="color: black; background: <?php echo $colordisignsetting; ?>; width: 250px">Завершённые заказы</button>
</div>
  </form>

<?php if ($sort == "new" or $sort == NULL) { ?>
  <div class="center" style="color:<?php echo $colordisignsetting; ?>; font-size: 20px; margin-top: 10px">Подходящие для вас заказы:</div>
<?php } if ($sort == "my") { ?>
  <div class="center" style="color:<?php echo $colordisignsetting; ?>; font-size: 20px; margin-top: 10px">Мои заказы:</div>
<?php } if ($sort == "result") { ?>
<div class="center" style="color:<?php echo $colordisignsetting; ?>; font-size: 20px; margin-top: 10px">Завершённые заказы:</div>
<?php } if ($zakasvzyat == "1") { ?>
<div class="center" style="color: green; font-size: 15px; margin-top: 10px">Заказ успешно взят в работу</div>
<?php } if ($Zakasotmena == "1") { ?>
<div class="center" style="color: green; font-size: 15px; margin-top: 10px">Заказ отменён</div>
<?php } if ($Zakasred == "1") { ?>
<div class="center" style="color: green; font-size: 15px; margin-top: 10px">Заказ изменён</div>
<?php } if ($rresult == "1") { ?>
<div class="center" style="color: green; font-size: 15px; margin-top: 10px">Заказ завершен</div>
<?php } if ($Zakascreate == "1") { ?>
<div class="center" style="color: green; font-size: 15px; margin-top: 10px">Заказ успешно создан</div>
<?php } if ($delete == "1") { ?>
<div class="center" style="color: green; font-size: 15px; margin-top: 10px">Заказ удалён</div>
<?php } if ($maxzakaz == "1") { ?>
<div class="center" style="color: red; font-size: 15px; margin-top: 10px">Достигнуто максимальное количество взятых заказов!</div>
<?php }

if ($sort == "my") { ?>
<form action="/" method="post" id="form1"  style="margin-top: 10px">
    <div class="d-flex gap-5 justify-content-center">
<table style="width: 600px"><tr>
<td style="text-align: center; width: 200px"><input type="submit" id="submitB" name="mycreate" value="Созданные мной заказы" style="<?php if($mysort == "mycreate") { ?> color: <?php echo $colordisignsetting; ?> <?php } else { ?> color: <?php if($_SESSION['themeClass'] == '') { ?> white <?php } else { ?> black <?php } } ?>"></td>
<td style="text-align: center; width: 200px"><input type="submit" id="submitB" name="all" value="Все заказы" style="<?php if($mysort == "all" or $mysort == NULL) { ?> color: <?php echo $colordisignsetting; ?> <?php } else { ?> color: <?php if($_SESSION['themeClass'] == '') { ?> white <?php } else { ?> black <?php } } ?>"></td>
<td style="text-align: center; width: 200px"><input type="submit" id="submitB" name="myzakaz" value="Взятые в работу заказы" style="<?php if($mysort == "myzakaz") { ?> color: <?php echo $colordisignsetting; ?> <?php } else { ?> color: <?php if($_SESSION['themeClass'] == '') { ?> white <?php } else { ?> black <?php } } ?>"></td></tr></table></div>
</form>
<?php } ?>

  <div class="container" style="width: 1000px; margin-top: 25px">
    <div class="form1">
<div class="list-group mx-0">
<?php //-------------------------------------------------------------------------------------------------------------------------
if($sort == "new") {
      $sth = $pdo->prepare("SELECT * FROM `work` WHERE `userwork` = '0' AND `level` LIKE '%$levelid%' ORDER BY `Id` DESC");
$sth->execute(array());
$d = 0;
while ($book = $sth->fetch(PDO::FETCH_OBJ)) {
  $d = 1;
  $task1 = $book->task;
  $id = $book->Id;
$task = str_replace(",", "<br>- ", $task1);
$useradd = $book->useradd;
$sth_ = $pdo->prepare("SELECT * FROM `user` WHERE `Id` = $useradd");
$sth_->execute();
$add = $sth_->fetch(PDO::FETCH_OBJ);
$useraddname = $add->name;

if ($useraddname == NULL) {
  $useraddname = 'Удаленный сотрудник';
}

$text1 = $book->text;
$text = wordwrap($text1, 70, "\n", true);
if ($text == NULL) {
  $text = "Описание отсуствует";
}
  ?>
  <form action="/" method="post" id="form1">

  <div class="red"><div class="obvod" style="color:black; font-size: 30px;"><?php echo $book->name; ?></div></div>
   <?php if ($useradd == $userid) { ?>
    <button type="submit" name="Zakasred" class="red" style="background: white;"><img src="/img/red.png" alt="редактировать" style="width: 32px; height: 32px; margin-top: 5px"></button>
    <button type="submit" name="Zakasdel" class="red" style="background: white;"><img src="/img/del.png" alt="удалить" style="width: 32px; height: 32px; margin-top: 5px"></button>
  <?php } ?>
  <div class="d-flex gap-5 justify-content-center">
  <div class="abc" style="color:hidden; font-size: 1px; width: 500px; height: 3px; margin-top: 50px">.</div>
  <div class="abc" style="color:gray; font-size: 20px; width: 500px; text-align: right">Добавил: <?php echo '<span style="color: black;">'.$useraddname.'</span>' ?></div></div>
<table><th><div class="obvod" style="color:gray; font-size: 20px; margin-bottom: 10px">- <?php echo $task; ?></div></th>
  <th valign="top"><div style="color:black; font-size: 20px; margin-bottom: 10px; text-align: right"><?php echo $book->date; ?></div></th></table>
<table><td><div style="color:black; font-size: 20px; margin-bottom: 15px"><?php echo $text; ?></div></td>
  <th valign="top"><div style="color:<?php echo $colordisignsetting; ?>; font-size: 20px; margin-bottom: 10px; text-align: right"><?php echo $book->price; ?> <a style="color: black">руб.</a></div></th></table>
<div class="d-flex gap-5 justify-content-center">
  <input type="hidden" name="Zakasfree" id="Zakasfree" value="<?php echo $id; ?>">
  <input type="hidden" name="Zakasfreename" id="Zakasfreename" value="<?php echo $book->name; ?>">
  <input type="hidden" name="Zakasfreetask" id="Zakasfreetask" value="<?php echo $task1; ?>">
  <input type="hidden" name="Zakasfreetext" id="Zakasfreetext" value="<?php echo $book->text; ?>">
  <input type="hidden" name="Zakasfreeprice" id="Zakasfreeprice" value="<?php echo $book->price; ?>">
  <input type="hidden" name="Zakasfreenameclient" id="Zakasfreenameclient" value="<?php echo $book->nameclient; ?>">
  <input type="hidden" name="Zakasfreenumber" id="Zakasfreenumber" value="<?php echo $book->number; ?>">
  <input type="hidden" name="Zakasfreelevel" id="Zakasfrelevel" value="<?php echo $book->level; ?>">
<button type="submit" name="Zakas" class="btn fw-bold border-black" style="background: <?php echo $colordisignsetting; ?>; width: 250px">Взять</button></form>
</div>
<hr>
  <?php } } if ($d == 0) {
    ?><div class="center" style="color:<?php echo $colordisignsetting; ?>; font-size: 20px; margin-top: 10px">Нет подходящих заказов</div><?php }
//-------------------------------------------------------------------------------------------------------------------------------
  if($sort == "my") {
      if($mysort == "all" or $mysort == NULL) {
      $sth = $pdo->prepare("SELECT * FROM `work` WHERE (`userwork` = $userid AND `result` = '0') OR (`useradd` = $userid AND `result` = '0' AND `userwork` = '0') ORDER BY `Id` DESC"); }
      if($mysort == "mycreate") {
      $sth = $pdo->prepare("SELECT * FROM `work` WHERE (`useradd` = $userid AND `result` = '0' AND `userwork` = '0') ORDER BY `Id` DESC"); }
      if($mysort == "myzakaz") {
      $sth = $pdo->prepare("SELECT * FROM `work` WHERE (`userwork` = $userid AND `result` = '0') ORDER BY `Id` DESC"); }
$sth->execute(array());
$d1 = 0;
while ($book = $sth->fetch(PDO::FETCH_OBJ)) {
  $d1 = 1;
  $task1 = $book->task;
  $id = $book->Id;
$task = str_replace(",", "<br>- ", $task1);
$useradd = $book->useradd;
$sth_ = $pdo->prepare("SELECT * FROM `user` WHERE `Id` = $useradd");
$sth_->execute();
$add = $sth_->fetch(PDO::FETCH_OBJ);
$useraddname = $add->name;

if ($useraddname == NULL) {
  $useraddname = 'Удаленный сотрудник';
}

$text1 = $book->text;
$text = wordwrap($text1, 70, "\n", true);
if ($text == NULL) {
  $text = "Описание отсуствует";
}
  ?>
  <form action="/" method="post" id="form1">

   <div class="red"><div class="obvod" style="color:black; font-size: 30px;"><?php echo $book->name; ?></div></div>
   <?php if ($useradd == $userid) { ?>
    <button type="submit" name="Zakasred" class="red" style="background: white;"><img src="/img/red.png" alt="редактировать" style="width: 32px; height: 32px; margin-top: 5px"></button>
    <button type="submit" name="Zakasdel" class="red" style="background: white;"><img src="/img/del.png" alt="удалить" style="width: 32px; height: 32px; margin-top: 5px"></button>
  <?php } ?>
  <div class="d-flex gap-5 justify-content-center">
  <div class="abc" style="color:hidden; font-size: 1px; width: 500px; height: 3px; margin-top: 50px">.</div>
  <div class="abc" style="color:gray; font-size: 20px; width: 500px; text-align: right">Добавил: <?php echo '<span style="color: black;">'.$useraddname.'</span>' ?></div></div>
<table><th><div class="obvod" style="color:gray; font-size: 20px; margin-bottom: 10px">- <?php echo $task; ?></div></th>
  <th valign="top"><div style="color:black; font-size: 20px; margin-bottom: 10px; text-align: right"><?php echo $book->date; ?></div></th></table>
<table><td><div style="color:black; font-size: 20px; margin-bottom: 15px"><?php echo $text; ?></div></td>
  <th valign="top"><div style="color:<?php echo $colordisignsetting; ?>; font-size: 20px; margin-bottom: 10px; text-align: right"><?php echo $book->price; ?> <a style="color: black">руб.</a></div></th></table>
<div class="d-flex gap-5 justify-content-center">

  <input type="hidden" name="Zakasfree" id="Zakasfree" value="<?php echo $id; ?>">
  <?php $iddd = $book->userwork;?>
<form action="/" method="post" id="form1"><?php
  if($iddd == $userid) { ?>
  <button type="submit" name="Zakasotmena" class="btn btn-danger fw-bold border-black" style="width: 200px">Отмена заказа</button>
<button type="submit" name="Zakasresult" class="btn fw-bold border-black" style="background: <?php echo $colordisignsetting; ?>; width: 200px">Заказ выполнен!</button> <?php } ?>
<input type="hidden" name="Zakasfree" id="Zakasfree" value="<?php echo $id; ?>">
  <input type="hidden" name="Zakasfreename" id="Zakasfreename" value="<?php echo $book->name; ?>">
  <input type="hidden" name="sort" id="sort" value="<?php echo $sort; ?>">
  <input type="hidden" name="Zakasfreetask" id="Zakasfreetask" value="<?php echo $task1; ?>">
  <input type="hidden" name="Zakasfreetext" id="Zakasfreetext" value="<?php echo $book->text; ?>">
  <input type="hidden" name="Zakasfreeprice" id="Zakasfreeprice" value="<?php echo $book->price; ?>">
  <input type="hidden" name="Zakasfreenameclient" id="Zakasfreenameclient" value="<?php echo $book->nameclient; ?>">
  <input type="hidden" name="Zakasfreenumber" id="Zakasfreenumber" value="<?php echo $book->number; ?>">
  <input type="hidden" name="Zakasfreelevel" id="Zakasfrelevel" value="<?php echo $book->level; ?>">
</form>
</div>
<hr>
  <?php } } if ($d1 == 0) {
    ?><div class="center" style="color:<?php echo $colordisignsetting; ?>; font-size: 20px; margin-top: 10px">Нет заказов взятых в работу</div><?php
  } ?>
<?php //---------------------------------------------------------------------------------------------------------------------------------------
  if($sort == "result") {
      $sth = $pdo->prepare("SELECT * FROM `work` WHERE (`userwork` = $userid AND `result` = '1') ORDER BY `Id` DESC");
$sth->execute(array());
$d2 = 0;
while ($book = $sth->fetch(PDO::FETCH_OBJ)) {
  $d2 = 1;
  $task1 = $book->task;
  $id = $book->Id;
$task = str_replace(",", "<br>- ", $task1);
$useradd = $book->useradd;
$sth_ = $pdo->prepare("SELECT * FROM `user` WHERE `Id` = $useradd");
$sth_->execute();
$add = $sth_->fetch(PDO::FETCH_OBJ);
$useraddname = $add->name;

if ($useraddname == NULL) {
  $useraddname = 'Удаленный сотрудник';
}

$text1 = $book->text2;

$text = $book->text;
$text2 = wordwrap($text1, 70, "\n", true);
if ($text2 == NULL) {
  $text2 = "Описание отсуствует";
}
  ?>
  <form action="/" method="post" id="form1">
  <div class="obvod" style="color:black; font-size: 30px"><?php echo $book->name; ?></div>
  <div class="d-flex gap-5 justify-content-center">
  <div class="abc" style="color:hidden; font-size: 1px; width: 500px; height: 3px; margin-top: 50px">.</div>
  <div class="abc" style="color:gray; font-size: 20px; width: 500px; text-align: right">Добавил: <?php echo '<span style="color: black;">'.$useraddname.'</span>' ?></div></div>
<table><th><div class="obvod" style="color:gray; font-size: 20px; margin-bottom: 10px">- <?php echo $task; ?></div></th>
  <th valign="top"><div style="color:black; font-size: 20px; margin-bottom: 10px; text-align: right"><?php echo $book->date2; ?></div></th></table>
<table><td><div style="color:black; font-size: 20px; margin-bottom: 15px"><?php if($text1 == NULL) { if($text == NULL) { echo $text2; } echo $text; } else { echo $text2; } ?></div></td>
  <th valign="top"><div style="color:<?php echo $colordisignsetting; ?>; font-size: 20px; margin-bottom: 10px; text-align: right"><?php echo $book->price; ?> <a style="color: black">руб.</a></div></th></table>
<div class="d-flex gap-5 justify-content-center">

  <input type="hidden" name="Zakasfree" id="Zakasfree" value="<?php echo $id; ?>">
</div>
<hr>
  <?php } } if ($d2 == 0) {
    ?><div class="center" style="color:<?php echo $colordisignsetting; ?>; font-size: 20px; margin-top: 10px">Нет завершенных заказов</div><?php
  } ?>
</div>
</div>
<?php //---------------------------------------------------------------------------------------------------------------------------------------
if ($_SESSION['sort'] == 'my') {
  $_SESSION['sort'] = '1';
}
if ( isset($data['create']) or $lvlno == '2') {?>
  <div id="zatemnenie1" style="position: fixed;">
    <a href="/" class="popup__overlay"></a>
      <div id="okno1">
        <form action="/" method="post" id="for">
          <h1 class="center" style="color:<?php echo $colordisignsetting; ?>; font-size: 25px; text-align: center">Создать заказ</h1>
          <?php if ($lvlno == '2') { ?>
          <div style="color: red; font-size: 15px; margin-top: 10pxж text-align: center;">Необходимо выбрать хотя бы один уровень!</div> <?php } ?>
          <input type="text" value="<?php echo $Zakasfreenameclient; ?>" name="Zakasfreenameclient" id="Zakasfreenameclient" placeholder="ФИО клиента" class="form-control" style="margin-bottom: 10px" autocomplete="off" required>
          <input type="text" value="<?php echo $Zakasfreenumber; ?>" name="Zakasfreenumber" id="Zakasfreenumber" placeholder="Номер телефона клиента" class="form-control" style="margin-bottom: 10px" autocomplete="off" required>
          <div style="color: green; font-size: 15px; margin-top: 10pxж text-align: center;">Для какого уровня сотрудников заказ</div>
          <div class="d-flex gap-5 justify-content-center">
           <?php if ($lvl1set == '1') { ?>
<div class="form-check" style="margin-bottom: 10px">
  <input class="form-check-input" type="checkbox" value="1" name="lvl1" id="lvl1" <?php if ($lvl2set == NULL and $lvl3set == NULL) { ?> checked <?php } ?>>
  <label class="form-check-label" for="flexCheckDefault" style="text-align: left; color: <?php echo $colordisignsetting; ?>">
    Уровень 1
  </label>
</div> <?php } ?>
<?php if ($lvl2set == '1') { ?>
<div class="form-check" style="margin-bottom: 10px">
  <input class="form-check-input" type="checkbox" value="2" name="lvl2" id="lvl2" <?php if ($lvl1set == NULL and $lvl3set == NULL) { ?> checked <?php } ?>>
  <label class="form-check-label" for="flexCheckDefault" style="text-align: left; color: <?php echo $colordisignsetting; ?>">
    Уровень 2
  </label>
</div>
<?php } ?>
<?php if ($lvl3set == '1') { ?>
<div class="form-check" style="margin-bottom: 10px">
  <input class="form-check-input" type="checkbox" value="3" name="lvl3" id="lvl3" <?php if ($lvl1set == NULL and $lvl2set == NULL) { ?> checked <?php } ?>>
  <label class="form-check-label" for="flexCheckDefault" style="text-align: left; color: <?php echo $colordisignsetting; ?>">
    Уровень 3
  </label></div> <?php } ?> </div>

          <input type="text" value="<?php echo $Zakasfreename; ?>" name="Zakasfreename" id="Zakasfreename" placeholder="Тема заказа" class="form-control" style="margin-bottom: 10px" autocomplete="off" required maxlength="25">
          <input type="text" value="<?php echo $Zakasfreetask; ?>" name="Zakasfreetask" id="Zakasfreetask" placeholder="Задачи заказа, писать через запятую" class="form-control" style="margin-bottom: 10px" autocomplete="off" required>
          <textarea class="form-control" name="Zakasfreetext" id="Zakasfreetext" placeholder="Описание заказа (Необязательно)" style="margin-bottom: 10px" maxlength="255"><?php echo $Zakasfreetext; ?></textarea>
          <input type="text" value="<?php echo $Zakasfreeprice; ?>" name="Zakasfreeprice" id="Zakasfreeprice" placeholder="Цена заказа" class="form-control" style="margin-bottom: 10px" autocomplete="off" required>
          <button type="submit" form="for" name="createresult" class="btn fw-bold border-black" style="background: <?php echo $colordisignsetting; ?>; margin-top: 10px; width: 250px">Создать заказ</button>
          <?php if ($sort == 'my') {
            $_SESSION['sort'] = 'my';
          } ?>
</form>
        <a href="/" class="close">Отмена</a>
      </div>
    </div>

<?php } if ( isset($data['Zakasred']) or isset($data['Zakasred1']) or $lvlno == '1') {?>
  <div id="zatemnenie1" style="position: fixed;">
    <a href="/" class="popup__overlay"></a>
      <div id="okno1">
        <form action="/" method="post" id="for">
          <input type="hidden" value="<?php echo $Zakasfree; ?>" name="Zakasfree" id="Zakasfree">
          <h1 class="center" style="color:<?php echo $colordisignsetting; ?>; font-size: 25px; text-align: center">Редактировать заказ</h1>
          <?php if ($lvlno == '1') { ?>
          <div style="color: red; font-size: 15px; margin-top: 10pxж text-align: center;">Необходимо выбрать хотя бы один уровень!</div> <?php } ?>
          <input type="text" value="<?php echo $Zakasfreenameclient; ?>" name="Zakasfreenameclient" id="Zakasfreenameclient" placeholder="ФИО клиента" class="form-control" style="margin-bottom: 10px" required>
          <input type="text" value="<?php echo $Zakasfreenumber; ?>" name="Zakasfreenumber" id="Zakasfreenumber" placeholder="Номер телефона клиента" class="form-control" style="margin-bottom: 10px" autocomplete="off" required>
          <div style="color: green; font-size: 15px; margin-top: 10pxж text-align: center;">Для какого уровня сотрудников заказ</div>
          <div class="d-flex gap-5 justify-content-center">
            <?php if ($lvl1set == '1') { ?>
<div class="form-check" style="margin-bottom: 10px">
  <input class="form-check-input" type="checkbox" value="1" name="lvl1" id="lvl1" <?php if ($lvl2set == NULL and $lvl3set == NULL) { ?> checked <?php } ?> <?php if (preg_match("/1/", $Zakasfreelevel)) { ?> checked <?php } ?>>
  <label class="form-check-label" for="flexCheckDefault" style="text-align: left; color: <?php echo $colordisignsetting; ?>">
    Уровень 1
  </label>
</div>
<?php } ?>
<?php if ($lvl2set == '1') { ?>
<div class="form-check" style="margin-bottom: 10px">
  <input class="form-check-input" type="checkbox" value="2" name="lvl2" id="lvl2" <?php if ($lvl1set == NULL and $lvl3set == NULL) { ?> checked <?php } ?> <?php if (preg_match("/2/", $Zakasfreelevel)) { ?> checked <?php } ?>>
  <label class="form-check-label" for="flexCheckDefault" style="text-align: left; color: <?php echo $colordisignsetting; ?>">
    Уровень 2
  </label>
</div>
<?php } ?>
<?php if ($lvl3set == '1') { ?>
<div class="form-check" style="margin-bottom: 10px">
  <input class="form-check-input" type="checkbox" value="3" name="lvl3" id="lvl3" <?php if ($lvl1set == NULL and $lvl2set == NULL) { ?> checked <?php } ?> <?php if (preg_match("/3/", $Zakasfreelevel)) { ?> checked <?php } ?>>
  <label class="form-check-label" for="flexCheckDefault" style="text-align: left; color: <?php echo $colordisignsetting; ?>">
    Уровень 3
  </label></div> <?php } ?> </div>
          <input type="text" value="<?php echo $Zakasfreename; ?>" name="Zakasfreename" id="Zakasfreename" placeholder="Тема заказа" class="form-control" style="margin-bottom: 10px" autocomplete="off" required maxlength="25">
          <input type="text" value="<?php echo $Zakasfreetask; ?>" name="Zakasfreetask" id="Zakasfreetask" placeholder="Задачи заказа, писать через запятую" class="form-control" style="margin-bottom: 10px" autocomplete="off" required>
          <textarea class="form-control" name="Zakasfreetext" id="Zakasfreetext" placeholder="Описание заказа (Необязательно)" style="margin-bottom: 10px" maxlength="255"><?php echo $Zakasfreetext; ?></textarea>
          <input type="text" value="<?php echo $Zakasfreeprice; ?>" name="Zakasfreeprice" id="Zakasfreeprice" placeholder="Цена заказа" class="form-control" style="margin-bottom: 10px" autocomplete="off" required>
          <button type="submit" form="for" name="redrresult" class="btn fw-bold border-black" style="background: <?php echo $colordisignsetting; ?>; margin-top: 10px; width: 250px">Подтвердить изменение</button>
          <?php if ($sort == 'my') {
            $_SESSION['sort'] = 'my';
          } ?>
</form>
        <a href="/" class="close">Отмена</a>
      </div>
    </div>

<?php }

if ( isset($data['Zakasresult'])) { ?>
  <div id="zatemnenie1" style="position: fixed;">
    <a href="#" class="popup__overlay"></a>
      <div id="okno1" style="height: 380px">
        <form action="/" method="post" id="for">
          <input type="hidden" value="<?php echo $Zakasfree; ?>" name="Zakasfree" id="Zakasfree">
          <h1 class="center" style="color:<?php echo $colordisignsetting; ?>; font-size: 25px; text-align: center">Заверешение заказа</h1>
          <div style="color: green; font-size: 15px; margin-top: 10pxж text-align: center;">Вы уверены что заказ завершен?</div><br>
          <div class="d-flex gap-5 justify-content-center">
<div class="form-check" style="margin-bottom: 10px">
  <input class="form-check-input" type="checkbox" value="yes" name="a" id="a" required>
  <label class="form-check-label" for="flexCheckDefault" style="text-align: left; color: <?php echo $colordisignsetting; ?>">
    <b>Да, заказ завершен</b>
  </label>
</div></div><br>
          <textarea class="form-control" name="text2" id="text2" placeholder="Подвести итоги заказа (Необязательно)" style="margin-bottom: 10px" maxlength="255"></textarea>
          <button type="submit" form="for" name="resultzakaz" class="btn fw-bold border-black" style="background: <?php echo $colordisignsetting; ?>; margin-top: 10px; width: 300px">Подтвердить завершение заказа</button>
          <?php if ($sort == 'my') {
            $_SESSION['sort'] = 'my';
          } ?>
</form>
        <a href="/" class="close">Отмена</a>
      </div>
    </div>
<?php } ?>
<br>
<?php
//------------------------------------------------------------------------------------------------------------------------------------------------------
else : ?>

  <div class="container" style="width: 60%; margin-top: 20px">
	<h1 style="font-size: 20px; text-align:  center; color: white; margin-top:15px; margin-bottom:10px" class="center">Войдите в учетную запись</h1>
<form action="/" method="post" id="form2">
			<input type="search" name="login" id="login" placeholder="Введите логин" class="form-control" autocomplete="off" required>
		<div class="d-flex gap-2 justify-content-center">
			<input type="password" name="password" id="password" placeholder="Пароль" class="form-control" style="margin-top: 5px" required>
		<button  type="submit" form="form2" name="do_login" class="btn btn-warning" style="font-size: 13px;width: 29%; height: 50%; margin-top: 5px">Войти</button>
		</div>
  </form>
<?php
    if ($errors == "") {
      ?><br><?php
    }
    else
        echo '<div style="color: red; margin-left: 10px" class="obvod">'.array_shift($errors).'</div><br>'; ?>
  <?php
  if ($_SESSION['errorreg'] == '1') {
    $era = 1;
    $_SESSION['errorreg'] = '0';
  }
  if ($era == '1') { ?>
  <div style="color: red; font-size: 20px; margin-top: 10px; text-align: center;">Данный логин уже используется!</div>
  <?php }
  if ($_SESSION['reg'] == "1") {
    $idreg = $_SESSION['idreg'];
$sth_ = $pdo->prepare("SELECT * FROM `reg` WHERE `Id` = $idreg");
$sth_->execute();
$regz = $sth_->fetch(PDO::FETCH_OBJ);
$status = $regz->status;
if ($status == '0') {
    ?>
  <div style="color: green; font-size: 20px; margin-top: 10px; text-align: center;">Ожидайте подтверждения регистрации</div>
<?php }
if ($status == '1') {
    ?>
  <div class="obvod" style="color: <?php echo $colordisignsetting; ?>; font-size: 20px; margin-top: 10px; text-align: center;">Ваша заявка одобрена!</div>
  <div style="<?php if ($_SESSION['themeClass'] == 'dark-theme') { ?> color: black; <?php } else { ?> color: white; <?php } ?> font-size: 15px; margin-top: 10px; text-align: center;">Введите ваш логин и пароль, для того чтобы войти в систему</div>
<?php }
if ($status == NULL) {
    ?>
  <div style="color: red; font-size: 20px; margin-top: 10px; text-align: center;">Ваша заявка отклонена!</div>
<?php
$_SESSION['errorreg'] = '0';
$_SESSION['reg'] = 0;
 } }
?>
  <div class="d-flex gap-2 justify-content-center">
<input type="submit" style="color: <?php echo $colordisignsetting; ?>; margin-top: 10px;" onclick="window.location.href = '#zatemnenie';" id="submitB" name="reg" value="<?php if ($_SESSION['reg'] == '1' and $status == '0') { ?> Отредактировать заявку на регистрацию <?php } if($status == NULL) { ?> Подать заявку на регистрацию <?php } ?>" style="color: <?php echo $colordisignsetting; ?>">
</div>
<div class="d-flex gap-2 justify-content-center">
<?php if ($_SESSION['reg'] == "1" and $status == '0') {
  ?>
<form action="/" method="post">
  <input type="submit" id="submitB" name="regotmena" value="Отмена регистрации" style="color: red; margin-top: 10px">
</form>
   <?php } ?>
</div>

<?php if ($_SESSION['reg'] == '1' and ($status == '0' or $status == '1')) { ?>
  <br>
  <div style="<?php if ($_SESSION['themeClass'] == 'dark-theme') { ?> color: black; <?php } else { ?> color: white; <?php } ?> font-size: 25px; margin-top: 10px; text-align: center;"><?php echo $regz->name; ?></div>
   <div style="<?php if ($_SESSION['themeClass'] == 'dark-theme') { ?> color: black; <?php } else { ?> color: white; <?php } ?> font-size: 15px; margin-top: 10px; margin-bottom: 10px; text-align: center;"><?php echo $regz->login; ?></div>
  <div class="d-flex gap-2 justify-content-center">
<img src="<?php echo $regz->avatar; ?>" class="avatar" style="object-fit: cover; width: 200px; height: 200px;">
</div>
<?php } ?>


<div id="zatemnenie" style="position: fixed;">
  <a href="#" class="popup__overlay"></a>
      <div id="okno" style="height: 350px">
        <form enctype="multipart/form-data" action="/" method="post" id="for">
          <h1 class="center" style="color:<?php echo $colordisignsetting; ?>; font-size: 25px; text-align: center">Регистрация</h1>

          <input type="text" value="<?php echo $regz->name; ?>" name="name" id="name" placeholder="Имя и фамилия" class="form-control" style="margin-bottom: 10px" autocomplete="off" required maxlength="35">
          <input type="text" value="<?php echo $regz->login; ?>" name="login" id="login" placeholder="Логин" class="form-control" style="margin-bottom: 10px" autocomplete="off" required maxlength="30">
          <input type="password" value="<?php echo $regz->password; ?>" name="password" id="password" placeholder="Пароль" class="form-control" style="margin-bottom: 10px" autocomplete="off" required minlength="8">
          <div class="mb-3">
            <a style="text-align: left; color: black; width: 20px">Файл JPG или PNG:</a>
  <input class="form-control" type="file" name="picture" accept=".jpg,.jpeg,.png" required>
</div>
<div class="d-flex gap-5 justify-content-center">
          <button type="submit" form="for" name="createreg" class="btn fw-bold border-black" style="background: <?php echo $colordisignsetting; ?>; margin-top: 10px; width: 250px">Отправить</button></div>
</form>
    </div>


    <?php

     /*
      8.2 Сообщения при открытии становятся прочитанными - не успел
      */
    ?>
		<?php endif; ?>
</div>
</div>
</body>
</html>




