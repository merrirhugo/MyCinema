<?php

include_once('connection.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">   
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet"> 

    <title>Document</title>
</head>
<body>

<h1 class="H1Name">Search Member by Name |<a href="index.php" class="aName"> Return Home</a>
</h1>

<form method="get" action="search_membername.php">
<input class="input" type="text" placeholder="Search Member LastName" name="search_membernom" >
<input class="input" type="text" placeholder="Search Member FirstName" name="search_memberprenom" >
<input class="input" type="submit" name="Search" value="Search">
</form>


<table border="2">
    <tr>
        <td class="titre">LastName</td>
        <td class="titre">FirstName</td>
        <td class="titre">Email</td>
        <td class="titre">Subscription</td>
        <td class="titre">Movie History</td>
        <td class="titre">Review</td>
    </tr>

   <?php 
    
    if(isset($_GET['Search'])) {

$search_nom = $_GET['search_membernom'];
$search_prenom = $_GET['search_memberprenom'];

if($search_nom == "" && $search_prenom == "")
{

    $result = $db->query("SELECT * FROM fiche_personne ORDER BY id_perso DESC");

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>".$row['nom']."</td>";
        echo "<td>".$row['prenom']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td><a class=\"ADD\" href=\"add_subscription.php?id_perso=$row[id_perso]\">Add</a> | <a class=\"EDIT\" href=\"edit_subscription.php?id_perso=$row[id_perso]\">Edit</a> | <a class=\"DELETE\" href=\"delete_subscription.php?id_perso=$row[id_perso]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
        echo "<td><a class=\"EDIT\" href=\"movie_history.php?id_perso=$row[id_perso]\">See History</a> | <a class=\"ADD\" href=\"add_moviehistory.php?id_perso=$row[id_perso]\">Add Movie</a></td>";
        echo "<td><a class=\"EDIT\" href=\"avis.php?id_perso=$row[id_perso]\">Show Review</a> | <a class=\"ADD\" href=\"add_avis.php?id_perso=$row[id_perso]\">Add Review</a></td>";

    } 
}
else {

    $search = $db->prepare("SELECT * FROM fiche_personne WHERE (nom LIKE ? AND prenom LIKE ?) ORDER BY id_perso DESC");
    $search_nom = $search_nom . "%";
    $search_prenom = $search_prenom . "%";
    $search->bindParam(1, $search_nom, PDO::PARAM_STR);
    $search->bindParam(2, $search_prenom, PDO::PARAM_STR);
    $search->execute();

    while($row = $search->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>".$row['nom']."</td>";
        echo "<td>".$row['prenom']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td><a class=\"ADD\" href=\"add_subscription.php?id_perso=$row[id_perso]\">Add</a> | <a class=\"EDIT\" href=\"edit_subscription.php?id_perso=$row[id_perso]\">Edit</a> | <a class=\"DELETE\" href=\"delete_subscription.php?id_perso=$row[id_perso]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
        echo "<td><a class=\"EDIT\" href=\"movie_history.php?id_perso=$row[id_perso]\">See History</a> | <a class=\"ADD\" href=\"add_moviehistory.php?id_perso=$row[id_perso]\">Add Movie</a></td>";
        echo "<td><a class=\"EDIT\" href=\"avis.php?id_perso=$row[id_perso]\">Show Review</a> | <a class=\"ADD\" href=\"add_avis.php?id_perso=$row[id_perso]\">Add Review</a></td>";
    }  
    
}
}

?> 

</table>

</body>
</html>