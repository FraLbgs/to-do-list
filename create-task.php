<?php
$ttl = "Création de tâches";
include_once "includes/_header.php";
require_once "includes/_functions.php";
if (isset($_POST['color'])) $_POST['color'] = str_replace("#", "", $_POST['color']);

$queryThemes = $dbCo->query("SELECT id_themes, name_theme FROM themes;");
$themes = $queryThemes->fetchAll();
?>

<div class="container">
  <h2 class="sub-ttl">Veuillez rentrer les données : </h2>
  <form class="form" method="post" action="#">
    <div class="field">
      <label class="label">Description : <?php if (isset($_POST['description']) && strlen($_POST['description']) > 255) echo "<span class='form-err'>*La description est trop longue</span><br>"; ?><br>
        <input class="input" type="text" name="description" required></label>
    </div>
    <div class="field"><label class="label">Date de rappel : <?php if (isset($_POST['date']) && $_POST['date'] < date("Y-m-d")) echo "<span class='form-err'>*Date déjà dépassée ou non définie</span><br>"; ?><br>
        <input class="input" type="date" name="date" required></label>
    </div>
    <div class="field"><label class="label">Couleur : <?php if (isset($_POST['color']) && preg_match('/^[a-f0-9]{6}$/', $_POST['color']) !== 1) echo "<span class='form-err'>*Code hexa invalide</span><br>"; ?><br>
        <input class="input" type="color" name="color" value="#ffffff" required></label>
    </div>
    <div class="field">
      <?=displayThemes($themes);?>
    </div>
    <div class="field">
      <input class="input" type="submit" name="submit" value="Valider les données">
    </div>
  </form>
</div>

<?php
var_dump($_POST);
// $_POST = array_map(recursiveStripTags($_POST), $_POST);

// function recursiveStripTags(array|string $var) :array{
//   recursiveStripTags($var);
//   if(is_array($var)) 
//   foreach($var as $v){
//     strip_tags($v);
//   }
// }


// $query1 = $dbCo->query("SELECT MAX(priority) AS max_prio FROM tasks WHERE id_users = 1;");
// $res = $query1->fetch();

// if (isset($_POST['submit']) && verifyForm($_POST['description'], $_POST['date'], $_POST['color']) === true) {
//   $query2 = $dbCo->prepare("INSERT INTO tasks (description, date_reminder, color, priority, id_users) VALUES
//       (:description, :date, :color, :priority, :id);");
//   $query2->execute([
//     "description" => $_POST['description'],
//     "date" => $_POST['date'],
//     "color" => $_POST['color'],
//     "priority" => $res['max_prio'] + 1,
//     "id" => 1
//   ]);
// }

?>

</body>

</html>