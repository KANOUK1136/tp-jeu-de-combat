<?php
    $personnage_id = $_POST['personnage_id'];

    if (isset($personnage_id)) {
        $host = "127.0.0.1";
        $dbname = "base_jeu_de_combat";
        $username_db = "root";
        $password_db = "";

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username_db, $password_db, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }

        $sql = "SELECT id, pseudo, vitesse, puissance, pv FROM table_personnage WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $personnage_id]);
        $personnage = $stmt->fetch();
        
        if (!$personnage) {
            die("Personnage non trouvé.");
        }
        $image_path = "images/" . htmlspecialchars($personnage['id']) . ".png";
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
    <br><br><br>
    <div class="image-container">
        <img src="<?= $image_path ?>" alt="<?= htmlspecialchars($personnage['pseudo']) ?>">
        <img src="images/vs.png" alt="VS">
        <img src="images/2.png" alt="Opponent">
    </div>

    <h2><?= htmlspecialchars($personnage['pseudo']) ?> vs Opponent</h2>

    <?php
function tour_vitesse_joueur1($bdd_vitesse_j1) {
    return rand(0, $bdd_vitesse_j1);
}

function tour_vitesse_joueur2($bdd_vitesse_j2) {
    return rand(0, $bdd_vitesse_j2);
}

function boxeur_attaque($puissance_initiateur) {
    return rand(0, $puissance_initiateur);
}

$local_host = "127.0.0.1"; 
$nom_bdd= "base";
$username_bdd = "root"; 
$password_bdd = ""; 

$pseudo_j1 = $personnage['pseudo'];
$pseudo_j2 = 'The Flash';

$vitesse_j1 = $personnage['vitesse'];
$vitesse_j2 = 9;

$puissance_j1 = $personnage['puissance'];
$puissance_j2 = 3;

$vie_combat_j1 = $personnage['pv'];
$vie_combat_j2 = 19;

while(True){
    // Qui attaque au debut dans ce tour ?
     $vitesse_j1_tour = tour_vitesse_joueur1($vitesse_j1);
     $vitesse_j2_tour = tour_vitesse_joueur2($vitesse_j2);

     // Tour si J2 est plus rapide
     if ($vitesse_j2_tour > $vitesse_j1_tour){

        echo("$pseudo_j1 attaque $pseudo_j1");

        $degats_subis_j1 = boxeur_attaque($puissance_j2);
        $vie_combat_j1 = $vie_combat_j1 - $degats_subis_j1;

        if ($vie_combat_j1 <= 0) { 
            echo("$pseudo_j1  à perdu !!");
            echo("Le gagnant est $pseudo_j2");
            break;
         }

         echo("$pseudo_j1 attaque $pseudo_j2");
         $degats_subis_j2 = boxeur_attaque($puissance_j1);
         $vie_combat_j2 = $vie_combat_j2 - $degats_subis_j2;
        
         if ($vie_combat_j2 <= 0 ){ 
            echo("$pseudo_j2 à perdu !!");
            echo("Le gagnant est $pseudo_j1 ");
            break;
         }
    }

    // Tour si J1 est plus rapide
     else {
        echo("$pseudo_j1  attaque $pseudo_j2");
        $degats_subis_j2 = boxeur_attaque($puissance_j1);
        $vie_combat_j2 = $vie_combat_j1 - $degats_subis_j2;

        if ($vie_combat_j2 <= 0 ){ 
            echo("$pseudo_j2 à perdu !!");
            echo("Le gagnant est $pseudo_j1 ");
            break;
         }

         echo("$pseudo_j2 attaque $pseudo_j1 ") ;
         $degats_subis_j1 = boxeur_attaque($puissance_j2);
         $vie_combat_j1 = $vie_combat_j1 - $degats_subis_j1;
        
         if ($vie_combat_j1 <= 0 ){ 
            echo("$pseudo_j1  à perdu !!") ;
            echo("Le gagnant est $pseudo_j2") ;
            break;
         }
     }
}
    ?>
</body>

</html>
