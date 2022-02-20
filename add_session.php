<?php

include_once("connection.php");


?>
<html>
    <head>
    <link href="style.css" rel="stylesheet">   
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet"> 

        <title>Add Session</title>
    </head>


<body>
<h1 class="H1Name">Add Session to this movie |<a href="javascript:self.history.back();" class="aName"> Go Back</a></h1>

    <form action="add_session.php" method="get" name="form1">
    <table>
        <tr>
        <td class="titre">Session Start</td>
        <td><input type="datetime-local" name="debut_sceance" value=""></td>
        <td class="titre">Session End</td>
        <td><input type="datetime-local" name="fin_sceance" value=""></td>
        <td class="titre">ID room</td>
        <td><input type="text" name="id_salle" value=""></td>
        <td class="titre">ID Movie</td>
        <td><input type="text" name="id_film" value="<?php echo $_GET['id_film']; ?>"></td>


        <?php

            if(isset($_GET['update'])) {

                $id_perso = $_GET['id_film'];


                if($_GET['debut_sceance'] == "" OR $_GET['fin_sceance'] == "") {
                
                echo "<font color='red'>Please enter a session start date and session end date.</font><br/>";
                }
                elseif($_GET['id_salle'] == "") {
                    echo "<font color='red'>Please enter a room_id.</font><br/>";
                }
                else {
                    $sql = "INSERT INTO grille_programme (id_film, id_salle, debut_sceance, fin_sceance) VALUES ( :id_film, :id_salle, :debut_sceance, :fin_sceance) ";
                    $query = $db->prepare($sql);
                    $query->execute(array(':id_film' => $_GET['id_film'], ':id_salle' => $_GET['id_salle'], ':debut_sceance' => $_GET['debut_sceance'], ':fin_sceance' => $_GET['fin_sceance']));
                    
                    header("Location: search_moviename.php");
                }
            }
            
            
        
?>
        </tr>

        <tr>
            <td><input type="submit" name="update" value="Submit"></td>
        </tr>
    </table>
    </form>
</body>
</html>