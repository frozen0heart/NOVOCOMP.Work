<?php
require "configDB.php";
require "configDB1.php";

if (isset($_POST["name"]) && isset($_POST["phonenumber"]) ) {

    // Формируем массив для JSON ответа
    $result = array(
        'name' => $_POST["name"],
        'phonenumber' => $_POST["phonenumber"]
    );

    // Переводим массив в JSON
    echo json_encode($result);

$text_mes = $_POST['name'];
$for_mes = $_POST['phonenumber'];
$from_mes = $_SESSION['logged_user_Id'];


$datenow = date("d.m.Y");
$timennow_ = date("H:i");
$timennow = date("H:i", strtotime("+1 hour", strtotime($timennow_)));

if ($text_mes == NULL) {
    $z = 1;
} else {
        $sql = "INSERT INTO message(from_mes, for_mes, text_mes, time_mes, date_mes, read_mes) VALUES(:from_mes, :for_mes, :text_mes, :time_mes, :date_mes, :read_mes)";
        $query = $pdo->prepare($sql);
        $query->execute(['from_mes' => $from_mes, 'for_mes' => $for_mes, 'text_mes' => $text_mes, 'time_mes' => $timennow, 'date_mes' => $datenow, 'read_mes' => '0']);

        $query = $pdo->prepare("UPDATE `message` SET `read_mes` = :read_mes WHERE `from_mes` = $for_mes");
    $query->execute(array('read_mes' => '1'));
}
}
?>