<?php

include_once('connection.php');

if(isset($_GET['id_perso'])) {
    $id_perso = $_GET['id_perso'];
    $result = $db->prepare("SELECT nom, prenom from fiche_personne WHERE id_perso=? ");
    $result->bindParam(1, $id_perso, PDO::PARAM_INT);
    $result->execute();
    while($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        $nom = $row['nom'];
        $prenom = $row['prenom'];
    
    }
    
}
?>

<html>
    <head>
    <link href="style.css" rel="stylesheet">   
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet"> 

    </head>
    <body>
        <h1 class="H1Name">Movie History |<a href="javascript:self.history.back();" class="aName"> Go Back</a></h1>
        <h3>Member : <?php echo $nom . " " . $prenom ;?></h3>
        <table border="2">
            <tr>
                <td class="titre">Movie ID</td>
                <td class="titre">Movie Title</td>
                <td class="titre">Date</td>
            </tr>
            <?php
            
if(isset($_GET['id_perso'])) {

    $id_perso = $_GET['id_perso'];
    $result = $db->prepare("SELECT membre.id_membre, film.id_film, film.titre, historique_membre.date FROM membre LEFT JOIN historique_membre ON membre.id_membre = historique_membre.id_membre LEFT JOIN film ON film.id_film = historique_membre.id_film WHERE membre.id_membre=? ORDER BY date DESC");
    $result->bindParam(1, $id_perso, PDO::PARAM_INT);
    $result->execute();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>".$row['id_film']."</td>";
        echo "<td>".$row['titre']."</td>";
        echo "<td>".$row['date']."</td>";
    }
}

?>
        </table>
    </body>
</html>