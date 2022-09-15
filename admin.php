<?php
require 'configDB.php';
require 'configDB1.php';

$levelid = $_SESSION['logged_user_level'];
$user = $_SESSION['logged_user'];
$userid = $_SESSION['logged_user_Id'];

    $sth = $pdo->prepare("SELECT * FROM `settinguser` WHERE `Iduser` = :userid");
$sth->execute(array('userid' => $userid));
$color = $sth->fetch(PDO::FETCH_OBJ);
$colordisignsetting = $color->colordisign;
$createzakazsetting = $color->createzakaz;
$numberzakazsetting = $color->numberzakaz;
$lvlsetting = $color->createzakazlevel;

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

$data = $_POST;
if( isset($data['zakaz']) )
  { $_SESSION['sort'] = "zakaz";
$sort2 = 'v_rabote';
}
if( isset($data['people']) )
  { $_SESSION['sort'] = "people"; }
if( isset($data['setting']) )
  { $_SESSION['sort'] = "setting"; }

if( isset($data['v_rabote']) )
  { $sort2 = "v_rabote"; }
if( isset($data['free']) )
  { $sort2 = "free"; }
if( isset($data['result']) )
  { $sort2 = "result"; }

if ( isset($data['Zakasred']) )
{ $_SESSION['sort'] = "zakaz";
$sort2 = 'v_rabote'; }

if ($_SESSION['sort'] == NULL) {
  $_SESSION['sort'] == 'people';
  $sort = 'people';
}

if ($sort == NULL) {
  $_SESSION['sort'] == 'people';
  $sort = 'people';
}

$sort = $_SESSION['sort'];

if( isset($data['Zakasdel']) )
  {
  $sql = 'DELETE FROM `work` WHERE `id` = ?';
  $query = $pdo->prepare($sql);
  $query->execute([$Zakasfree]);
    $delete = 1; }

$sthas = $pdo->prepare("SELECT * FROM `user` WHERE `Id` = :userid");
$sthas->execute(array('userid' => $userid));
$avatarasss = $sthas->fetch(PDO::FETCH_OBJ);
$adminsetting = $avatarasss->admin;

$level = $_POST['lvl1'];
$name = $_POST['name'];
$login = $_POST['login'];
$password = $_POST['password'];
$createf = $_POST['createf'];

if ($createf == NULL) {
    $createf = '0';
}


if( isset($data['redrresult']) )
  {
    if ($lvl1 == NULL and $lvl2 == NULL and $lvl3 == NULL) { $lvlno = 1; } else {
      $lvlno = 0;
      $Zakasfreelevel = $lvl1.$lvl2.$lvl3;
  $query = $pdo->prepare("UPDATE `work` SET `nameclient` = :Zakasfreenameclient, `number` = :Zakasfreenumber, `name` = :Zakasfreename, `task` = :Zakasfreetask, `text` = :Zakasfreetext, `level` = :Zakasfreelevel, `price` = :Zakasfreeprice WHERE `Id` = $Zakasfree");
    $query->execute(array('Zakasfreenameclient' => $Zakasfreenameclient, 'Zakasfreenumber' => $Zakasfreenumber, 'Zakasfreename' => $Zakasfreename, 'Zakasfreetask' => $Zakasfreetask, 'Zakasfreetext' => $Zakasfreetext, 'Zakasfreelevel' => $Zakasfreelevel, 'Zakasfreeprice' => $Zakasfreeprice));
    $Zakasred = 1; } }

if( isset($data['redpeople']) )
  {
      $idpeople = $_POST['idpeople'];
      $numberzakaz = $_POST['numberzakaz'];
      $createset = $_POST['createset'];
      $createzakazlevel = $_POST['createzakazlevel'];
      $invite = $_POST['invite'];
      $lvlel = $_POST['lvlel'];

      $query = $pdo->prepare("UPDATE `user` SET `level` = :lvlel WHERE `Id` = $idpeople");
    $query->execute(array('lvlel' => $lvlel));

  $query = $pdo->prepare("UPDATE `settinguser` SET `createzakaz` = :createset, `createzakazlevel` = :createzakazlevel, `invite` = :invite, `numberzakaz` = :numberzakaz WHERE `Iduser` = $idpeople");
    $query->execute(array('createset' => $createset, 'createzakazlevel' => $createzakazlevel, 'invite' => $invite, 'numberzakaz' => $numberzakaz));
    $Zakasred = 1; }

if( isset($data['delpeople']) )
  {
$idpeople = $_POST['idpeople'];
$ava = $_POST['ava'];
  $sql = 'DELETE FROM `user` WHERE `Id` = ?';
  $query = $pdo->prepare($sql);
  $query->execute([$idpeople]);

  $sql = 'DELETE FROM `settinguser` WHERE `Iduser` = ?';
  $query = $pdo->prepare($sql);
  $query->execute([$idpeople]);

  $sql = "DELETE FROM `message` WHERE `for_mes` = $idpeople or `from_mes` = $idpeople";
  $query = $pdo->prepare($sql);
  $query->execute();

  unlink($ava);

  header('Location: /admin.php');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=1100px, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="icon" href="img/ico.ico" type="image/x-icon">
  <title>Novocomp-admin</title>
  <style>
  body {
   background: #242428;
}
/* Стили Тёмной темы */
body.dark-theme {
    background: #fff;
}
a {
  text-decoration:none;
}
   .rightstr {
    text-align: right;
   }
   .center {
    text-align: center;
    text-shadow: 1px 0 1px #000,
    0 1px 1px #000,
    -1px 0 1px #000,
    0 -1px 1px #000;
   }
table {
  width: 100%;
}
th {
   width: 50%;
}
.abc {
  position: relative;
  bottom: 25px;
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
        height: 230px;

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
        width: 800px;
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

.close {
        display: inline-block;
        border: 1px solid <?php echo $colordisignsetting; ?>;
        color: <?php echo $colordisignsetting; ?>;
        padding: 0 12px;
        margin: 10px;
        text-decoration: none;
        background: #f2f2f2;
        font-size: 14pt;
        cursor:pointer;
      }
.close:hover {background: #e6e6ff;}
textarea {
    width: 90%; /* Ширина поля в процентах */
    height: 90px; /* Высота поля в пикселах */
    resize: none; /* Запрещаем изменять размер */
   }
.red {
  border:  none;
  text-align: left;
  display:inline-block;
    height: 28px;
    vertical-align: middle;
  }
.ul {
	list-style: none;
	padding: 15px;
	margin-bottom: 10px;
	background: #fcfcfc;
	border: 1px solid silver;
	border-radius: 5px;
}
ul li button {
	border: 0;
	padding: 5px 15px;
	color: white;
	font-size: 13px;
	background: #FFA500;
	position: relative;
	left: 70px;
	border-radius: 5px;
}

ul li button:hover {
	background: #FF5500;
}
.b {
position: absolute;
}
.but{
    margin: -20px -50px;
    position:relative;
    left: 75%;
}
.form1 {
  background: #FFFFFF;
  border: 5px solid <?php echo $colordisignsetting; ?>;
  border-radius: 20px;
  padding: 10px 10px;
}
   td{
     border: 1px solid #242428;
   }
   .avatar {
    border-radius: 100px; /* Радиус скругления */
    border: 1px solid white; /* Параметры рамки */
    box-shadow: 0 0 7px #666; /* Параметры тени */
image-rendering: pixelated;
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
.clear {
    clear: both;
  }
  </style>
</head>
<body class="<?php echo $_SESSION['themeClass']; ?>">
  <?php
if($adminsetting != "1") {
  ?> <a style="font-size: 20px; color: gray">У вас нет прав для посещения данной страницы</a>
  <a href="/" style="font-size: 16px; color: red; margin-top: 8px" class="obvod">На главную</a> <?php exit();
}
  ?>
	<?php
	require 'header.php'; ?>
		<div class="d-flex gap-5 justify-content-center">
			<div class="container" style="width: 1000px">


<form action="/admin.php" method="post">
  <div class="d-flex gap-5 justify-content-center">
<button type="submit" name="people" class="<?php if($sort == 'people') { ?>btn btn-lg fw-bold border-black<?php } else {?>btn btn-lg btn-secondary fw-bold border-black bg-white<?php } ?>" style="background: <?php echo $colordisignsetting; ?>; background: <?php echo $colordisignsetting; ?>; color: black; width: 250px">Сотрудники</button>
<?php /* ?>
<button type="submit" name="setting" class="<?php if($sort == 'setting') { ?>btn btn-lg fw-bold border-black<?php } else {?>btn btn-lg btn-secondary fw-bold border-black bg-white<?php } ?>" style="background: <?php echo $colordisignsetting; ?>; background: <?php echo $colordisignsetting; ?>; color: black; width: 250px">Статистика</button>
<?php */ ?>
<button type="submit" name="zakaz" class="<?php if($sort == 'zakaz') { ?>btn btn-lg fw-bold border-black<?php } else {?>btn btn-lg btn-secondary fw-bold border-black bg-white<?php } ?>" style="background: <?php echo $colordisignsetting; ?>; color: black; width: 250px">Заказы</button>
<?php if ($sort == 'setting') { ?>
<button type="button" onclick="window.location.href = '#zatemnenie';" name="set" class="red" style="<?php if ($_SESSION['themeClass'] == '') { ?>background: #242428; <?php } else { ?>background: #ffffff; <?php } ?>"><img src="/img/set.png" alt="Сортировка" style="position: relative; width: 32px; height: 32px; margin-top: 5px"></button>
<?php } ?>
</div>
</form>


<?php
if ($sort == "zakaz") { ?>
<form action="/admin.php" method="post" id="form1"  style="margin-top: 10px">
    <div class="d-flex gap-5 justify-content-center">
<table style="width: 600px"><tr>
<td style="border: none; text-align: center; width: 200px"><input type="submit" id="submitB" name="v_rabote" value="Заказы в работе" style="<?php if($sort2 == "v_rabote" or $sort2 == NULL) { ?> color: <?php echo $colordisignsetting; ?> <?php } else { ?> color: <?php if($_SESSION['themeClass'] == '') { ?> white <?php } else { ?> black <?php } } ?>"></td>
<td style="border: none; text-align: center; width: 200px"><input type="submit" id="submitB" name="free" value="Свободные заказы" style="<?php if($sort2 == "free") { ?> color: <?php echo $colordisignsetting; ?> <?php } else { ?> color: <?php if($_SESSION['themeClass'] == '') { ?> white <?php } else { ?> black <?php } } ?>"></td>
<td style="border: none; text-align: center; width: 200px"><input type="submit" id="submitB" name="result" value="Завершенные заказы" style="<?php if($sort2 == "result") { ?> color: <?php echo $colordisignsetting; ?> <?php } else { ?> color: <?php if($_SESSION['themeClass'] == '') { ?> white <?php } else { ?> black <?php } } ?>"></td></tr></table></div>
</form>

<?php
$zakaznumber = 0;
$reluts = 0;
$userworks = 0;
$free = 0;

$sth = $pdo->prepare("SELECT * FROM `work` ORDER BY `Id` DESC");
$sth->execute(array());
while ($book = $sth->fetch(PDO::FETCH_OBJ)) {
$userwork = $book->userwork;
if ($userwork == '0') {
  $zakaznumber = $zakaznumber + 1;
  $free = $free + 1;
} else {
  $result1 = $book->result;
  if ($result1 == '1') {
    $results = $results + 1;
    $zakaznumber = $zakaznumber + 1;
  } else { $userworks = $userworks + 1; $zakaznumber = $zakaznumber + 1; }
} } ?>

<div class="container" style="width: 1000px; margin-top: 25px">
<div class="form1" style="margin-top: 15px">
<table style="color: black; text-align: center;">
<tr><td>Свободные заказы</td><td>Заказы в работе</td><td>Завершённые заказы</td><td>Всего заказов</td></tr>
<tr><td><?php echo $free; ?></td><td><?php echo $userworks; ?></td><td><?php echo $results; ?></td><td><?php echo $zakaznumber; ?></td></tr>
</table></div></div>

  <div class="container" style="width: 1000px; margin-top: 25px">
    <div class="form1">
<div class="list-group mx-0">
<?php if ($sort == 'zakaz') { //----------------------------------------------------------------------------------------------------

if ($sort2 == 'v_rabote' or $sort2 == NULL) {
$sth = $pdo->prepare("SELECT * FROM `work` WHERE `result` = '0' and `userwork` != '0' ORDER BY `Id` DESC");
$sth->execute(array()); }

if ($sort2 == 'free') {
$sth = $pdo->prepare("SELECT * FROM `work` WHERE `userwork` = '0' ORDER BY `Id` DESC");
$sth->execute(array()); }

if ($sort2 == 'result') {
$sth = $pdo->prepare("SELECT * FROM `work` WHERE `result` = '1' ORDER BY `Id` DESC");
$sth->execute(array()); }

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
$text1 = $book->text;
$text = wordwrap($text1, 70, "\n", true);
if ($text == NULL) {
  $text = "Описание отсуствует";
}
$result = $book->result;
if ($result == '1') {
  $free = $book->userwork;
  $sth_ = $pdo->prepare("SELECT * FROM `user` WHERE `Id` = $free");
  $sth_->execute();
  $add = $sth_->fetch(PDO::FETCH_OBJ);
  $ver = $add->name;

if ($ver == NULL) {
  $ver = 'Удаленный пользователь';
}

  $verdict = 'Завершил '.$ver;
} else {
  $free = $book->userwork;
  if ($free == '0') {
    $verdict = 'Свободен';
  } else {
      $sth_ = $pdo->prepare("SELECT * FROM `user` WHERE `Id` = $free");
  $sth_->execute();
  $add = $sth_->fetch(PDO::FETCH_OBJ);
  $ver = $add->name;
  $verdict = 'В процессе '.$ver;
  }
}

  ?>
  <form action="/admin.php" method="post" id="form1">

  <div class="red"><div class="obvod" style="color:black; font-size: 30px;"><?php echo $book->name; ?></div></div>
    <button type="submit" name="Zakasred" class="red" style="background: white;"><img src="/img/red.png" alt="редактировать" style="width: 32px; height: 32px; margin-top: 5px"></button>
    <button type="submit" name="Zakasdel" class="red" style="background: white;"><img src="/img/del.png" alt="удалить" style="width: 32px; height: 32px; margin-top: 5px"></button>

  <div class="d-flex gap-5 justify-content-center">
  <div class="abc" style="color:hidden; font-size: 1px; width: 500px; height: 3px; margin-top: 50px">.</div>
  <div class="abc" style="color:gray; font-size: 20px; width: 500px; text-align: right">Добавил: <?php echo '<span style="color: black;">'.$useraddname.'</span>' ?></div></div>
<table><th><div class="obvod" style="color:gray; font-size: 20px; margin-bottom: 10px">- <?php echo $task; ?></div></th>
  <th valign="top"><div style="color:black; font-size: 20px; margin-bottom: 10px; text-align: right"><?php echo $book->date; ?></div></th></table>
<table><td style="border: none"><div style="color:black; font-size: 20px; margin-bottom: 15px"><?php echo $text; ?></div></td>
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
     <div class="obvod" style="color:<?php echo $colordisignsetting; ?>; font-size: 20px; text-align: center;"><?php echo $verdict; ?></div>
</form>
</div>
<hr>
  <?php } } if ($d == 0) {
    ?><div class="center" style="color:<?php echo $colordisignsetting; ?>; font-size: 20px; margin-top: 10px">Нет заказов в данной категории</div><?php }
}//---------------------------------------------------------------------------------------------------------
?>

<?php if ($sort == 'people') { ?>
<div class="container" style="width: 500px">
		<?php
			echo '<ul><br>';
			$query = $pdo->query('SELECT * FROM `user` ORDER BY `Id` DESC');
			while($row = $query->fetch(PDO::FETCH_OBJ)) {
?>
<form action="/admin.php" method="post">
				<li class="ul"><b class="b"><?php echo $row->name; ?></b><a class="but"><button type="submit" style="background: <?php echo $colordisignsetting; ?>" name="idusersbutton">Изменить</button></a></li>
        <input type="hidden" name="Idusers" id="Idusers" value="<?php echo $row->Id; ?>">
</form>
				<?php
			}
			echo '</ul>';
		?>
	</div>
	<?php $_SESSION['add'] = 0;
} ?>

<?php
if ( isset($data['Zakasred']) or $lvlno == '1') {?>
  <div id="zatemnenie1" style="position: fixed;">
    <a href="/admin.php" class="popup__overlay"></a>
      <div id="okno1">
        <form action="/admin.php" method="post" id="for">
          <input type="hidden" value="<?php echo $Zakasfree; ?>" name="Zakasfree" id="Zakasfree">
          <h1 class="center" style="color:<?php echo $colordisignsetting; ?>; font-size: 25px; text-align: center">Редактировать заказ</h1>
          <?php if ($lvlno == '1') { ?>
          <div style="color: red; font-size: 15px; margin-top: 10pxж text-align: center;">Необходимо выбрать хотя бы один уровень!</div> <?php } ?>
          <input type="text" value="<?php echo $Zakasfreenameclient; ?>" name="Zakasfreenameclient" id="Zakasfreenameclient" placeholder="ФИО клиента" class="form-control" style="margin-bottom: 10px" required>
          <input type="text" value="<?php echo $Zakasfreenumber; ?>" name="Zakasfreenumber" id="Zakasfreenumber" placeholder="Номер телефона клиента" class="form-control" style="margin-bottom: 10px" autocomplete="off" required>
          <div style="color: green; font-size: 15px; margin-top: 10pxж text-align: center;">Для какого уровня сотрудников заказ</div>
          <div class="d-flex gap-5 justify-content-center">
<div class="form-check" style="margin-bottom: 10px">
  <input class="form-check-input" type="checkbox" value="1" name="lvl1" id="lvl1" <?php if ($lvl2set == NULL and $lvl3set == NULL) { ?> checked <?php } ?> <?php if (preg_match("/1/", $Zakasfreelevel)) { ?> checked <?php } ?>>
  <label class="form-check-label" for="flexCheckDefault" style="text-align: left; color: <?php echo $colordisignsetting; ?>">
    Уровень 1
  </label>
</div>
<div class="form-check" style="margin-bottom: 10px">
  <input class="form-check-input" type="checkbox" value="2" name="lvl2" id="lvl2" <?php if ($lvl1set == NULL and $lvl3set == NULL) { ?> checked <?php } ?> <?php if (preg_match("/2/", $Zakasfreelevel)) { ?> checked <?php } ?>>
  <label class="form-check-label" for="flexCheckDefault" style="text-align: left; color: <?php echo $colordisignsetting; ?>">
    Уровень 2
  </label>
</div>
<div class="form-check" style="margin-bottom: 10px">
  <input class="form-check-input" type="checkbox" value="3" name="lvl3" id="lvl3" <?php if ($lvl1set == NULL and $lvl2set == NULL) { ?> checked <?php } ?> <?php if (preg_match("/3/", $Zakasfreelevel)) { ?> checked <?php } ?>>
  <label class="form-check-label" for="flexCheckDefault" style="text-align: left; color: <?php echo $colordisignsetting; ?>">
    Уровень 3
  </label></div></div>
          <input type="text" value="<?php echo $Zakasfreename; ?>" name="Zakasfreename" id="Zakasfreename" placeholder="Тема заказа" class="form-control" style="margin-bottom: 10px" autocomplete="off" required maxlength="25">
          <input type="text" value="<?php echo $Zakasfreetask; ?>" name="Zakasfreetask" id="Zakasfreetask" placeholder="Задачи заказа, писать через запятую" class="form-control" style="margin-bottom: 10px" autocomplete="off" required>
          <textarea class="form-control" name="Zakasfreetext" id="Zakasfreetext" placeholder="Описание заказа (Необязательно)" style="margin-bottom: 10px" maxlength="255"><?php echo $Zakasfreetext; ?></textarea>
          <input type="text" value="<?php echo $Zakasfreeprice; ?>" name="Zakasfreeprice" id="Zakasfreeprice" placeholder="Цена заказа" class="form-control" style="margin-bottom: 10px" autocomplete="off" required>
          <button type="submit" form="for" name="redrresult" class="btn fw-bold border-black" style="background: <?php echo $colordisignsetting; ?>; margin-top: 10px; width: 250px">Подтвердить изменение</button>
          <?php if ($sort == 'my') {
            $_SESSION['sort'] = 'my';
          } ?>
</form>
        <a href="/admin.php" class="close">Отмена</a>
      </div>
    </div>

<?php }

if ( isset($data['idusersbutton'])) {
  $Idusers = $_POST['Idusers'];
$sth = $pdo->prepare("SELECT * FROM `user` WHERE `Id` = :Idusers");
$sth->execute(array('Idusers' => $Idusers));
$kotyatka = $sth->fetch(PDO::FETCH_OBJ);
$result = 0;
$userwork = 0;
$price = 0;
$sth_ = $pdo->prepare("SELECT * FROM `work` WHERE `userwork` = :Id");
$sth_->execute(array('Id' => $Idusers));
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
$sth_->execute(array('Id' => $Idusers));
while ($book = $sth_->fetch(PDO::FETCH_OBJ)) {
$useradd = $useradd + 1;
}
$datereg = $kotyatka->datereg;
$mail = $kotyatka->mail;
$ava = $kotyatka->avatar;
$Id = $kotyatka->Id;

if ($mail == NULL) {
  $mail = 'не указана';
}

$lvlel = $kotyatka->level;

$stha = $pdo->prepare("SELECT * FROM `settinguser` WHERE `Iduser` = :Id");
$stha->execute(array('Id' => $Idusers));
$setting = $stha->fetch(PDO::FETCH_OBJ);

$create = $setting->createzakaz;
$invite = $setting->invite;
$finance = $setting->finance;
$numberzakaz = $setting->numberzakaz;
$createzakazlevel = $setting->createzakazlevel;
$allmail = $setting->allmail;

if ($create == 1) {
  $createset = 'Да';
} else { $createset = 'Нет'; }

if ($invite == 1) {
  $invite = 'Да';
} else { $invite = 'Нет'; }

if ($finance == 1) {
  $finance = 'Да';
} else { $finance = 'Нет'; }

if ($allmail == 1) {
  $allmail = 'Да';
} else { $allmail = 'Нет'; }
  ?>
  <div id="zatemnenie1" style="position: fixed;">
    <a href="/admin.php" class="popup__overlay"></a>
      <div id="okno1" style="width: 700">
        <form action="/admin.php" method="post" id="for">
          <h1 class="center" style="color:<?php echo $colordisignsetting; ?>; font-size: 25px; text-align: center"><?php echo $kotyatka->name; ?></h1>
          <div class="d-flex gap-5 justify-content-center">
          <img src="<?php echo $kotyatka->avatar; ?>" class="avatar" style="object-fit: cover; width: 200px; height: 200px;">
          <table style="font-size: 15px; width: 500px"><tr><td>Имя пользователя: </td><td style="color: <?php echo $colordisignsetting; ?>"><?php echo $kotyatka->name; ?></td></tr>
        <tr><td>Логин:</td><td style="color: <?php echo $colordisignsetting; ?>"><?php echo $kotyatka->login; ?></td></tr>
        <tr><td>Уровень сотрудника:</td><td style="color: <?php echo $colordisignsetting; ?>">
          <select class="form-select" name="lvlel">
  <option value="1" <?php if ($lvlel == '1') { ?> selected <?php } ?>>1</option>
  <option value="2" <?php if ($lvlel == '2') { ?> selected <?php } ?>>2</option>
  <option value="3" <?php if ($lvlel == '3') { ?> selected <?php } ?>>3</option>
</select></td></tr>
        <tr><td>Заработано с заказов:</td><td style="color: <?php echo $colordisignsetting; ?>"><?php echo $price; ?> р.</td></tr>
        <tr><td>Выполненных заказов:</td><td style="color: <?php echo $colordisignsetting; ?>"><?php echo $result; ?></td></tr>
        <tr><td>Заказов в работе:</td><td style="color: <?php echo $colordisignsetting; ?>"><?php echo $userwork; ?></td></tr>
        <tr><td>Создано заказов:</td><td style="color: <?php echo $colordisignsetting; ?>"><?php echo $useradd; ?></td></tr>
        <tr><td>Зарегистрированы:</td><td style="color: <?php echo $colordisignsetting; ?>"><?php echo $datereg; ?></td></tr>
        <tr><td>Почта:</td><td style="color: <?php echo $colordisignsetting; ?>"><?php echo $mail; ?></td></tr>
      </table></div>
<div class="d-flex gap-5 justify-content-center">
         <table style="font-size: 15px; margin-top: 15px; width: 550px; border: none"><tr><td style="border: none">Создавать заказы</td><td style="text-align: center; border: none; color: <?php echo $colordisignsetting; ?>">
          <select class="form-select" name="createset">
  <option value="1" <?php if ($createset == 'Да') { ?> selected <?php } ?>>Да</option>
  <option value="0" <?php if ($createset == 'Нет') { ?> selected <?php } ?>>Нет</option>
</select>
</div></td></tr>
<tr><td style="border: none">Просматривать заявки</td><td style="text-align: center; border: none; color: <?php echo $colordisignsetting; ?>">
 <select class="form-select" name="invite">
  <option value="1" <?php if ($invite == 'Да') { ?> selected <?php } ?>>Да</option>
  <option value="0" <?php if ($invite == 'Нет') { ?> selected <?php } ?>>Нет</option>
</select></td></tr>
<?php /*
<tr><td>Просматривать аналитику</td><td style="text-align: center; color: <?php echo $colordisignsetting; ?>"><?php echo $finance; ?></td></tr> */ ?>
<tr><td style="border: none">Допустимое кол-во взятых заказов</td><td style="text-align: center; border: none; color: <?php echo $colordisignsetting; ?>">
<input type="text" value="<?php echo $numberzakaz; ?>" name="numberzakaz" id="numberzakaz" class="form-control" maxlength="2" style="" autocomplete="off" required onkeypress="return isNumberKey(event)">
<script>
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
       return true;
    };
</script>
</td></tr>
  <tr><td style="border: none">Для какого уровня может быть создан заказ</td><td style="text-align: center; border: none; color: <?php echo $colordisignsetting; ?>">
    <select class="form-select" name="createzakazlevel">
  <option value="1" <?php if ($createzakazlevel == '1') { ?> selected <?php } ?>>1</option>
  <option value="2" <?php if ($createzakazlevel == '2') { ?> selected <?php } ?>>2</option>
    <option value="3" <?php if ($createzakazlevel == '3') { ?> selected <?php } ?>>3</option>
      <option value="12" <?php if ($createzakazlevel == '12') { ?> selected <?php } ?>>1 и 2</option>
        <option value="13" <?php if ($createzakazlevel == '13') { ?> selected <?php } ?>>1 и 3</option>
          <option value="23" <?php if ($createzakazlevel == '23') { ?> selected <?php } ?>>2 и 3</option>
            <option value="123" <?php if ($createzakazlevel == '123') { ?> selected <?php } ?>>Все уровни</option>
</select></td></tr>
</table></div>
<input type="hidden" name="idpeople" id="idpeople" value="<?php echo $Idusers; ?>">
<input type="hidden" name="ava" id="ava" value="<?php echo $ava; ?>">
<div class="d-flex gap-5 justify-content-center">
  <?php if ($Id != $userid) { ?>
    <button type="submit" name="delpeople" class="btn btn-danger" style="margin-top: 10px; width: 250px">Удалить сотрудника</button>
  <?php } ?>
<button type="submit" name="redpeople" class="btn fw-bold border-black" style="background: <?php echo $colordisignsetting; ?>; margin-top: 10px; width: 250px">Подтвердить изменение</button>
</form>

      </div>
    </div>

  <?php } ?>
<?php if ($sort == 'setting') { //----------------------------------------------------------------------------------------------------

if( isset($data['sort_finance']) )
  {
$date_1_sort = $_POST['date_1'];
$date_2_sort = $_POST['date_2'];


$sth = $pdo->prepare("SELECT * FROM `user` ORDER BY `Id` ASC");
$sth->execute(array());
$kotyatka = $sth->fetch(PDO::FETCH_OBJ);
$result = 0;
$userwork = 0;
$price = 0;
$createzakaz = 0;
$Idusers_ = $kotyatka->Id;
$sth_ = $pdo->prepare("SELECT * FROM `work`");
$sth_->execute(array('date_1_sort' => $date_1_sort, 'date_2_sort' => $date_2_sort));
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

$sth_ = $pdo->prepare("SELECT * FROM `work` WHERE `date` > $date_1_sort and `date` < $date_2_sort");
$sth_->execute(array('Id' => $Idusers));
while ($book = $sth_->fetch(PDO::FETCH_OBJ)) {
  $createzakaz = $createzakaz + 1;
}
$useradd = 0;
$sth_ = $pdo->prepare("SELECT * FROM `work` WHERE `useradd` = :Id");
$sth_->execute(array('Id' => $Idusers));
while ($book = $sth_->fetch(PDO::FETCH_OBJ)) {
$useradd = $useradd + 1;
}
$ava = $kotyatka->avatar;
$sort_sort = 1;

$date_1_sort_1 = substr($date_1_sort, 8);
$date_1_sort_2 = substr($date_1_sort, 5, -3);
$date_1_sort_3 = substr($date_1_sort, 0, -6);

$date_2_sort_1 = substr($date_2_sort, 8);
$date_2_sort_2 = substr($date_2_sort, 5, -3);
$date_2_sort_3 = substr($date_2_sort, 0, -6);

$date_1_sort = $date_1_sort_1.'.'.$date_1_sort_2.'.'.$date_1_sort_3;
$date_2_sort = $date_2_sort_1.'.'.$date_2_sort_2.'.'.$date_2_sort_3;

if ($date_1_sort == $date_2_sort) {
$sort_sort_ = 'Сортировка за '.$date_1_sort;
} else {
$sort_sort_ = 'Сортировка с '.$date_1_sort.' по '.$date_2_sort;
}
}
?>
<br>
<?php //-----------------------------html----------------------?>
  <div class="d-flex justify-content-center">



<div class="container">
    <div class="form1" style="width: 750px;">
      <?php if ($sort_sort == "1") { ?>
  <div class="center" style="color:orange; font-size: 20px; margin-bottom: 15px;"><?php echo $sort_sort_; ?></div>
<?php } else { ?>
<div class="center" style="color:orange; font-size: 20px;">Статистика за всё время</div>
<?php } ?>
<br>
<div style="font-size: 20px; margin-top: 3px; text-align: center;">Заработано: <?php echo $price; ?> р.</div>
<div style="font-size: 20px; margin-top: 3px; text-align: center;">Выполненных заказов: <?php echo $result; ?></div>
<div style="font-size: 20px; margin-top: 3px; text-align: center;">Оформлено заказов: <?php echo $createzakaz; ?></div>


<?php
$sth = $pdo->prepare("SELECT * FROM `user`");
$sth->execute(array());
while ($user = $sth->fetch(PDO::FETCH_OBJ)) {
$iduserrr = $user->Id; ?>
<div style="font-size: 20px; margin-top: 3px; color: orange;"><?php echo $user->name; ?></div>
<?php } ?>
</div>
</div>
<div class="container">
    <div class="form1" style="width: 500px;">
</div>
</div>
<?php }
//----------------------------Окна---------------------------------------------
?>

<div id="zatemnenie" style="position: fixed;">
    <a href="#" class="popup__overlay"></a>
      <div id="okno">
        <form action="/admin.php" method="post" id="for">
          <input type="hidden" value="<?php echo $Zakasfree; ?>" name="Zakasfree" id="Zakasfree">
          <h1 class="center" style="color:<?php echo $colordisignsetting; ?>; font-size: 25px; text-align: center">Сортировать статистику</h1>
<br>

<?php $datenowss = date("Y-m-d"); ?>
       <div class="d-flex gap-5 justify-content-center">
<div style="width: 45%; text-align: center; color: black">Дата 1</div>
<div style="width: 45%; text-align: center; color: black">Дата 2</div>
</div>
<form action="/admin.php" method="post" id="for">
    <div class="d-flex gap-5 justify-content-center">
<input type="date" value="<?php echo $datenowss; ?>" name="date_1" id="date_1" class="form-control" style="width: 45%" autocomplete="off" required>
<input type="date" value="<?php echo $datenowss; ?>" name="date_2" id="date_2" class="form-control" style="width: 45%" autocomplete="off" required>
</div>
<br>
<div class="d-flex gap-5 justify-content-center">
<button type="submit" name="sort_finance" class="btn fw-bold border-black" style="background: <?php echo $colordisignsetting; ?>; color: black; width: 250px">Продолжить</button>
</div>
</form>

</div>
    </div>
    </div>

</form>
</body>
</html>