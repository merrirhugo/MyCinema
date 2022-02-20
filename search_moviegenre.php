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

<h1 class="H1Name">Search Movie by Genre |<a href="index.php" class="aName"> Return Home</a>
</h1>

<form method="get" action="search_moviegenre.php">
<input class="input" type="text" placeholder="Search Movie Genre" name="search_moviegenre" >
<input class="input" type="submit" name="Search" value="Search">
</form>

<table border="2">
    <tr>
        <td class="titre">Title</td>
        <td class="titre">Genre</td>
        <td class="titre">Resume</td>
    </tr>
<?php

if(isset($_GET['Search'])) {

    $search_moviegenre = $_GET['search_moviegenre'];

    if($search_moviegenre == "") {

        $result = $db->query("SELECT film.titre, genre.nom, film.resum FROM film INNER JOIN genre ON film.id_genre = genre.id_genre ORDER BY id_film DESC");

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>".$row['titre']."</td>";
            echo "<td>".$row['nom']."</td>";
            echo "<td>".$row['resum']."</td>";

        }
    }
    else {

        $search = $db->prepare("SELECT film.titre, genre.nom, film.resum FROM film INNER JOIN genre ON film.id_genre = genre.id_genre WHERE genre.nom LIKE ? ORDER BY id_film DESC");
        $search_moviegenre = $search_moviegenre . "%";
        $search->bindParam(1, $search_moviegenre, PDO::PARAM_STR);
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