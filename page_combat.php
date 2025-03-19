<?php
    function tour_vitesse_joueur1($bdd_vitesse_j1){
        $vitesse_joueur1 = rand(0,$bdd_vitesse_j1);
        return $vitesse_joueur1;
    }

    function tour_vitesse_joueur2($bdd_vitesse_j2){
        $vitesse_joueur2 = rand(0,$bdd_vitesse_j2);
        return $vitesse_joueur2;
    }

    function boxeur_attaque($puissance_initiateur){
        $degats = rand(0,$puissance_initiateur);
        return $degats;
    }
?>

<!DOCTYPE html>
<html lang="fr">

  <head>
    <meta charset="UTF-8">
    <title>FIGHT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/page_combat.css" />
    <?php include 'banniere.php'; ?>

  </head>

  <body>
      <link rel="stylesheet" type="text/css" href="css/page_combat.css" >
      <div class="row">
            <div class="column">
                <img src="images/iron_mike.png" alt="Jouer1_perso" style="width:50%">
                
            </div>

            <div class="column">
                <img src="images/vs.png" alt="Vs_logo" style="width:50%">
            </div>
        
            <div class="column">
                <img src="images/jotaro_kujo.png" alt="Joueur2_perso" style="width:50%">
            </div>
        </div>

        <?php
        $local_host = "127.0.0.1"; 
        $nom_bdd= "base";
        $username_bdd = "root"; 
        $password_bdd = ""; 

        /*
        // Initialisation de la connexion SQL
        $connexion = new mysqli($local_host, $username_bdd, $password_bdd, $nom_bdd);

        $stmt = $pdo->prepare("SELECT nom FROM utilisateurs WHERE nom = :nom");
        $stmt->execute(['nom' => $nom]);

        
        // Recuperation des vitesses, pv et prenom/nom du joueurs 1 et 2
        $vitesse_joueur1 = 


        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
            
        $sql = "SELECT id, , vitesse, puissance FROM table_personnage";
        $result = $conn->query($sql);
            
        if ($result->num_rows > 0) {


            while($row = $result->fetch_assoc()) {
                    echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
            }
        }
        while(){

        }
            */

        // Boucle des tours : condition de sorties (un des deux joueurs < 0)
        // Qui attaque au debut dans ce tour ?


        ?>

  </body>

</html>