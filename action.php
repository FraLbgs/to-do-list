<?php
$ttl = "test";
include_once "includes/_header.php";
require_once "includes/_functions.php";

var_dump($_GET);
if(isset($_GET['action']) && $_GET['action'] === "done" && isset($_GET['idtask'])){
    $query = $dbCo->prepare("UPDATE tasks
    SET done = 1
    WHERE id_tasks = :idtasks;");
    $query->execute([
        "idtasks" => $_GET['idtask']
    ]);
}
header("location:index.php");
exit;
?>