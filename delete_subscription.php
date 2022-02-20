<?php

include_once('connection.php');

$id_perso = $_GET['id_perso'];

$sql = "UPDATE membre SET id_abo = 0 WHERE id_fiche_perso=:id_perso";
$query = $db->prepare($sql);
$query->execute(array('id_perso' => $id_perso));

header("Location: search_membername.php");
?>
