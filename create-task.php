<?php
error_reporting(E_ALL); 
// display_errors(true);
$ttl = "Création de tâches";
include_once "includes/_header.php";
?>

<div class="container">
    <h2 class="sub-ttl">Veuillez rentrer les données : </h2>
    <form class="form" method="post" action="#">
        <div class="field">
          <label class="label">Description : <?php if(isset($_POST['description']) && strlen($_POST['description']) > 255) echo "<span class='form-err'>*La description est trop longue</span><br>";?><br>
          <input class="input" type="text" name="description" required></label>
      </div>
        <div class="field"><label class="label">Date de rappel : <?php if(isset($_POST['date']) && $_POST['date'] < date("Y-m-d")) echo "<span class='form-err'>*Date déjà dépassée ou non définie</span><br>";?><br>
          <input class="input" type="date" name="date" required></label>
      </div>
        <div class="field"><label class="label">Couleur : 
        <input class="input" type="color" name="color" required></label>
      </div>
        <div class="field"><label class="label">Priorité : (chiffre entre 1 et 5) : <?php if(isset($_POST['priority']) && preg_match('/^[1-5]{1}$/', $_POST['priority']) !== 1) echo "<span class='form-err'>*Veuillez entrer un chiffre entre 1 et 5</span><br>";?><br> 
        <input class="input" type="number" name="priority" required></label>
      </div>
      <!-- <div class="field"><label class="label">Votre identifiant : <br>
        <input class="input" type="number" name="id"></label>
      </div> -->
      <div class="field">
          <input class="input" type="submit" name="submit" value="Valider les données">
      </div>
    </form>
    <div class="content-btn"><a class="btn-return" href="index.php">Retour à la liste</a></div>
</div>

<?php

$_POST = array_map("strip_tags", $_POST);
if(isset($_POST['color'])) $_POST['color'] = str_replace("#", "", $_POST['color']);

$verifyForm = function(string $desc, string $date, string $color, int $priority){
  if(strlen($desc) > 255 || $date < date("Y-m-d") || preg_match('/^[a-f0-9]{6}$/', $color) !== 1 || preg_match('/^[1-5]{1}$/', $priority) !== 1){
    return false;
  }
  return true;
};



// <?php if(isset($_POST['color']) && preg_match('/^[a-f0-9]{6}$/', $_POST['color']) !== 1) echo "<span class='form-err'>*Code hexa invalide</span><br>";
// if( preg_match('/^[0-9]{1-2}$/', $_POST['id']) !== 1) echo "Veuillez entrer un chiffre entre 1 et 5<br>";
if(isset($_POST['submit']) && $verifyForm($_POST['description'], $_POST['date'], $_POST['color'], $_POST['priority']) === true){
  $query = $dbCo->prepare("INSERT INTO tasks (description, date_reminder, color, priority, id_users) VALUES
      (:description, :date, :color, :priority, :id);");
  $query->execute([
      "description" => $_POST['description'],
      "date" => $_POST['date'],
      "color" => $_POST['color'],
      "priority" => $_POST['priority'],
      "id" => 1
  ]);
}
?>

</body>

</html>