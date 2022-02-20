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

<h1 class="H1Name">Search Movie by Distributor |<a href="index.php" class="aName"> Return Home</a>
</h1>

<form method="get" action="search_moviedistrib.php">
<input  class="input" type="text" placeholder="Search Movie Distributor" name="search_moviedistrib" >
<input class="input" type="submit" name="Search" value="Search">
</form>

<table border="2">
    <tr>
        <td class="titre">Title</td>
        <td class="titre">Distributor</td>
        <td class="titre">Resume</td>
    </tr>
<?php

if(isset($_GET['Search'])) {

    $search_moviedistrib = $_GET['search_moviedistrib'];

    if($search_moviedistrib == "") {

        $result = $db->query("SELECT film.titre, distrib.nom, film.resum FROM film INNER JOIN distrib ON film.id_distrib = distrib.id_distrib ORDER BY id_film DESC");

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>".$row['titre']."</td>";
            echo "<td>".$row['nom']."</td>";
            echo "<td>".$row['resum']."</td>";

        }
    }
    else {

        $search = $db->prepare("SELECT film.titre, distrib.nom, film.resum FROM film INNER JOIN distrib ON film.id_distrib = distrib.id_distrib WHERE distrib.nom LIKE ? ORDER BY id_film DESC");
        $search_moviedistrib = $search_moviedistrib . "%";
        $search->bindParam(1, $search_moviedistrib, PDO::PARAM_STR);
        $search->execute();
        
        while($row = $search->fetch(PDO::FETCH_ASSOC)) {

            echo "<tr>";
            echo "<td>".$row['titre']."</td>";
            echo "<td>".$row['nom']."</td>";
            echo "<td>".$row['resum']."</td>";

        }
    }
}
?>

</table>
</body>
</html>