<?php
$ttl = "test";
include_once "includes/_header.php";
require_once "includes/_functions.php";

$query = $dbCo->prepare("SELECT priority FROM tasks WHERE id_tasks = :idtasks AND done = 0;");
$query->execute([
    "idtasks" => $_GET['idtask']
]);
$res = $query->fetch();
$prio = $res["priority"];

// var_dump($_GET);
if(isset($_GET['action']) && $_GET['action'] === "done" && isset($_GET['idtask'])){

    $query = $dbCo->prepare("UPDATE tasks
    SET done = 1, priority = 0
    WHERE id_tasks = :idtasks;");
    $query->execute([
        "idtasks" => $_GET['idtask']
    ]);

    $query1 = $dbCo->prepare("UPDATE tasks
    SET priority = priority-1
    WHERE priority > $prio AND done = 0;");
    $query1->execute();
}


if(isset($_GET['action']) && $_GET['action'] === "up" && isset($_GET['idtask'])){
    
    $query1 = $dbCo->prepare("UPDATE tasks
    SET priority = priority-1
    WHERE priority = $prio AND done = 0;");
    $query1->execute();
    
    $query2 = $dbCo->prepare("UPDATE tasks
    SET priority = priority+1
    WHERE priority = $prio-1 AND id_tasks != :idtask AND done = 0;");
    $query2->execute([
        "idtask" => $_GET['idtask']
    ]);
}


if(isset($_GET['action']) && $_GET['action'] === "down" && isset($_GET['idtask'])){

    // $query = $dbCo->prepare("SELECT priority FROM tasks WHERE id_tasks = :idtasks AND done = 0;");
    // $query->execute([
    //     "idtasks" => $_GET['idtask']
    // ]);
    // $res = $query->fetch();
    // $prio = $res["priority"];
    // var_dump($prio);

    $query1 = $dbCo->prepare("UPDATE tasks
    SET priority = priority+1
    WHERE priority = $prio AND done = 0;");
    $query1->execute();

    $query2 = $dbCo->prepare("UPDATE tasks
    SET priority = priority-1
    WHERE priority = $prio+1 AND id_tasks != :idtask AND done = 0;");
    $query2->execute([
        "idtask" => $_GET['idtask']
    ]);

}

header("location:index.php");
exit;
?>