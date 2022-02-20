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

<h1 class="H1Name">Search Movie by Broadcast Date |<a href="index.php" class="aName"> Return Home</a>
</h1>

<form method="get" action="search_moviedate.php">
<input class="input" type="date" name="search_moviedate" >
<input class="input" type="submit" name="Search" value="Search">
</form>

<?php 

if(isset($_GET['search_moviedate'])) {

    $search_moviedate = $_GET['search_moviedate'];
    if($search_moviedate == "") {
        echo "";
    }

    else {

    echo "<h2>Movies broadcast on: $search_moviedate</h2>";
    
    }
}
    



?>

<table border="2">
    <tr>
        <td class="titre">Title</td>
        <td class="titre">Screening Date</td>
        <td class="titre">Resume</td>
    </tr>
<?php

if(isset($_GET['Search'])) {

    $search_moviedate = $_GET['search_moviedate'];

    if($search_moviedate == "") {

        $result = $db->query("SELECT film.titre, film.date_debut_affiche, film.date_fin_affiche, film.resum FROM film ORDER BY id_film DESC");

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>".$row['titre']."</td>";
            echo "<td>". "From: " .$row['date_debut_affiche']. "<br>" . "to: " . $row['date_fin_affiche']."</td>";
            echo "<td>".$row['resum']."</td>";

        }
    }
    else {

        $search = $db->prepare("SELECT film.titre, film.date_debut_affiche, film.date_fin_affiche, film.resum FROM film WHERE ? BETWEEN film.date_debut_affiche AND film.date_fin_affiche ORDER BY id_film DESC");
        $search->bindParam(1, $search_moviedate, PDO::PARAM_STR);
        $search->execute();

        while($row = $search->fetch(PDO::FETCH_ASSOC)) {

            echo "<tr>";
            echo "<td>".$row['titre']."</td>";
            echo "<td>". "From: " .$row['date_debut_affiche']. "<br>" . "to: " . $row['date_fin_affiche']."</td>";
            echo "<td>".$row['resum']."</td>";

        }
    }
}
?>

</table>
</body>
</html>