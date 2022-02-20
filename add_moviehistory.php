<?php

include_once("connection.php");

if(isset($_GET['id_perso'])) {
    $id_perso = $_GET['id_perso'];
    $result = $db->query("SELECT nom, prenom from fiche_personne WHERE id_perso='$id_perso'");
    
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

        <title>Edit Data</title>
    </head>


<body>
<h1 class="H1Name">Add Movie to History |<a href="javascript:self.history.back();" class="aName"> Go Back</a></h1>

    <h3>LastName : <?php echo $nom ?></h3>
    <h3>FirstName : <?php echo $prenom ?></h3>

    <form action="add_moviehistory.php" method="get" name="form1">
    <table>
        <tr>
            <td class="titre">Movie ID</td>
            <td><input type="text" name="movie_id" value=""></td>
            <td><input type="date" name="movie_date" value=""></td>
            
        <?php 
        if(isset($_GET['update'])) {

    $id_perso = $_GET['id_perso'];

    if(empty($_GET['movie_id']) OR empty($_GET['movie_date'])) {
        
        echo "<font color='red'>Please enter an movie_id between 0 and 3679 and a date.</font><br/>";
    
    } 
    elseif($_GET['movie_id'] > 3679) {
        echo "<font color='red'>Please enter an movie_id between 0 and 3679.</font><br/>";
    }
    else {
        $sql = "INSERT INTO historique_membre (id_membre, id_film, date) VALUES(:id_perso, :movie_id, :movie_date) ";
        $query = $db->prepare($sql);
        $query->execute(array(':id_perso' => $id_perso, ':movie_id' => $_GET['movie_id'], ':movie_date' => $_GET['movie_date']));
        
        header("Location: search_membername.php");
    }
}
?>
        </tr>

        <tr>
            <td><input type="hidden" name="id_perso" value=<?php echo $_GET['id_perso'];?>></td>
            <td><input type="submit" name="update" value="Update"></td>
        </tr>
    </table>
    </form>
</body>
</html>