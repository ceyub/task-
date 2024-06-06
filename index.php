<?php
require("db.php");
$res=mysqli_query($con,'SELECT * FROM tasks');
if(mysqli_num_rows($res)>0){
    while($row=$res(fetch_assoc())){
        echo('Tâche:'.$row['task']);
    }
}
$task=$_GET['task'];
$req="INSERT INTO tasks (task) VALUES ("read the text")";
$res1=mysqli_query($con,$req);
if (mysqli_num_rows($res)==0){
    echo "Tâche ajoutée avec succès";
}
else{
    die ("erreur d'ajout");
}
if(mysqli_num_rows($res)>0){
    echo ("<h2>Liste des taches</h2>");
    echo "<ul>"
    while ($row=$res->fetch_assoc()){
        echo "<li>" .$row['task'] . "</li>";
    }
    echo ("</ul>");
} else{
    echo ("Aucune tâche trouvée.");
}
while($row=$res->fetch_assoc()){
    echo ("<li>" .($row['task'])." ");
    echo ("<a href='edit.php?id=" . $row['id']."'>Editer</a> ");
    echo ("<a href='delete.php?id=" . $row['id']."'>Supprimer</a>");
    echo "</li>";
}
$res2=mysqli_query($con, "UPDATE tasks WHERE id=1;");
if(mysqli_num_rows($res2)!=0){
    echo("tache modifier avec succes");
}
$res3=mysqli_query($con,"DELETE FROM tasks WHERE id=0;");
if(mysqli_num_rows($res3)!=0){
    echo("suppression avec succes");
}
$sql = "SELECT * FROM taches WHERE titre LIKE '%$search_query%' OR description LIKE '%$search_query%' ORDER BY id LIMIT 10 OFFSET 0";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo ("ID: " . $row["id"] . " - Titre: " . $row["titre"] . " - Description: " . $row["description"] . "<br>";
    }
}
if (isset($_GET['search'])) {
    $search_query=$_GET['search'];
    $search_query=mysqli_real_escape_string($con,$search_query);
    $sql .=" WHERE titre LIKE '%$search_query%' OR description LIKE '%$search_query%'";
}
$limit=10;
$page=isset($_GET['page'])?$_GET['page']:1;
$offset=($page-1)*$limit;
$sql .=" LIMIT $limit OFFSET $offset";

if(isset($_GET['status'])) {
    $filter=$_GET['status'];
    $filter=mysqli_real_escape_string($con,$filter);
    $sql .="WHERE statut='$filter'";
}
$stmt=$con->prepare("SELECT * FROM taches WHERE id = ?");
$stmt->bind_param("s", $id);
$id="id";
$stmt->execute();
$res = $stmt->get_result();
while ($row=$res->fetch_assoc()) {
    echo ("Nom: " . $row["nom"] . ", Email: " . $row["email"]);
}
?>