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

<h1 class="H1Name">Search Movie by Name |<a href="index.php" class="aName"> Return Home</a>
</h1>

<form method="get" action="search_moviename.php">
<input class="input" type="text" placeholder="Search Movie Name" name="search_moviename" class="input" >
<input class="input" type="submit" name="Search" value="Search">
</form>


<table border="2">
    <tr>
        <td class="titre">Title</td>
        <td class="titre">Resume</td>
        <td class="titre">Length(min)</td>
        <td class="titre">Year</td>
        <td class="titre">Session</td>
    </tr>
<?php

if(isset($_GET['Search'])) {

    $search_moviename = $_GET['search_moviename'];

    if($search_moviename == "") {

        $result = $db->query("SELECT * FROM film ORDER BY id_film DESC");

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>".$row['titre']."</td>";
            echo "<td>".$row['resum']."</td>";
            echo "<td>".$row['duree_min']."</td>";
            echo "<td>".$row['annee_prod']."</td>";
            echo "<td><a class=\"ADD\" href=\"add_session.php?id_film=$row[id_film]\">Add Session</a></td>";


        }
    }
    else {

        $search = $db->prepare("SELECT * FROM film WHERE titre LIKE ? ORDER BY id_film DESC");
        $search_moviename = $search_moviename . '%';
        $search->bindParam(1, $search_moviename, PDO::PARAM_STR);
        $search->execute();
        while($row = $search->fetch(PDO::FETCH_ASSOC)) {

            echo "<tr>";
            echo "<td>".$row['titre']."</td>";
            echo "<td>".$row['resum']."</td>";
            echo "<td>".$row['duree_min']."</td>";
            echo "<td>".$row['annee_prod']."</td>";
            echo "<td><a href=\"add_session.php?id_film=$row[id_film]\">Add Session</a></td>";


        }
    }
}
?>

</table>
</body>
</html>