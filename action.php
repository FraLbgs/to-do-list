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

    $query1 = $dbCo->prepare("UPDATE tasks
    SET done = 1, priority = 0
    WHERE id_tasks = :idtask;");
    $isDone = $query1->execute([
        "idtask" => $_GET['idtask']
    ]);

    $query2 = $dbCo->prepare("UPDATE tasks
    SET priority = priority-1
    WHERE priority > $prio AND done = 0;");
    $isDone2 = $query2->execute();

    $action = "done";

    var_dump($isDone, $isDone2);
}

else if(isset($_GET['action']) && $_GET['action'] === "delete" && isset($_GET['idtask'])){

    $query1 = $dbCo->prepare("DELETE FROM tasks
    WHERE id_tasks = :idtask;");
    $isDone = $query1->execute([
        "idtask" => $_GET['idtask']
    ]);

    $query2 = $dbCo->prepare("UPDATE tasks
    SET priority = priority-1
    WHERE priority > $prio AND done = 0;");
    $isDone2 = $query2->execute();

    $action = "delete";

}


else if(isset($_GET['action']) && $_GET['action'] === "up" && isset($_GET['idtask'])){
    
    $query1 = $dbCo->prepare("UPDATE tasks
    SET priority = priority-1
    WHERE priority = $prio AND done = 0;");
    $isDone = $query1->execute();
    
    $query2 = $dbCo->prepare("UPDATE tasks
    SET priority = priority+1
    WHERE priority = $prio-1 AND id_tasks != :idtask AND done = 0;");
    $isDone2 = $query2->execute([
        "idtask" => $_GET['idtask']
    ]);

    $action = "up";
}


else if(isset($_GET['action']) && $_GET['action'] === "down" && isset($_GET['idtask'])){

    $query1 = $dbCo->prepare("UPDATE tasks
    SET priority = priority+1
    WHERE priority = $prio AND done = 0;");
    $isDone = $query1->execute();

    $query2 = $dbCo->prepare("UPDATE tasks
    SET priority = priority-1
    WHERE priority = $prio+1 AND id_tasks != :idtask AND done = 0;");
    $isDone2 = $query2->execute([
        "idtask" => $_GET['idtask']
    ]);

    $action = "down";

}

function returnMessage() : string {
    global $action;
    global $isDone;
    global $isDone2;

    if($isDone && $isDone2){
        if($action === "done") return "?action=0";
        else if($action === "delete") return "?action=1";
        else return "?action=4";
    }
    else{
        return "?action=2";
    }
}

$res = returnMessage();

header("location:index.php$res");
exit;
?>