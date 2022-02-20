<?php

include_once("connection.php");

$id_perso = $_GET['id_perso'];

$sql = "SELECT fiche_personne.nom AS membernom, fiche_personne.prenom AS memberprenom, membre.id_abo AS subscription_id, abonnement.nom AS subscription_name  FROM fiche_personne LEFT JOIN membre ON fiche_personne.id_perso = membre.id_fiche_perso LEFT JOIN abonnement ON membre.id_abo = abonnement.id_abo WHERE id_perso=:id_perso";
$query = $db->prepare($sql);
$query->execute(array(':id_perso' => $id_perso));

while($row = $query->fetch(PDO::FETCH_ASSOC))
{
    $id_abo = $row['subscription_id'];
    $nom = $row['membernom'];
    $prenom = $row['memberprenom'];
    $subscription = $row['subscription_name'];

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
<h1 class="H1Name">Edit Subscription |<a href="javascript:self.history.back();" class="aName"> Go Back</a></h1>

    <h3>LastName : <?php echo $nom ?></h3>
    <h3>FirstName : <?php echo $prenom ?></h3>
    <h3>Subscription Name : <?php echo $subscription ?></h3>


    <form action="edit_subscription.php" method="get" name="form1">
    <table>
        <tr>
            <td class="titre">Subscription ID</td>
            <td class="titre"><input type="text" name="subscription_id" value="<?php echo $id_abo;?>"><small>(1 = VIP, 2 = GOLD, 3 = Classic, 4 = pass day)</small></td>
            
            <?php 
            if(isset($_GET['update']))
{
    $id_perso = $_GET['id_perso'];
    $id_abo = $_GET['subscription_id'];

    if(empty($id_abo) OR $id_abo == 0) {
        
        echo "<font color='red'>Please enter a subscription_id between 1 and 4.</font><br/>";
    
    } 
    elseif($id_abo > 4) {
        echo "<font color='red'>Please enter a subscription_id between 0 and 4.</font><br/>";
    }
    else {
        $sql = "UPDATE membre SET id_abo=:subscription_id WHERE id_fiche_perso=:id_perso";
        $query = $db->prepare($sql);
        $query->execute(array(':id_perso' => $id_perso, ':subscription_id' => $id_abo));
        
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