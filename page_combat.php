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

        $sql = "SELECT id, pseudo FROM table_personnage WHERE id = :id";
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
        <!-- Display the selected character's image -->
        <img src="<?= $image_path ?>" alt="<?= htmlspecialchars($personnage['pseudo']) ?>">
        <img src="images/vs.png" alt="VS">
        <!-- Placeholder image for the opponent -->
        <img src="images/iron_mike.png" alt="Opponent">
    </div>

    <h2><?= htmlspecialchars($personnage['pseudo']) ?> vs Opponent</h2>

    <?php
        // Example of the combat functions being used
        function tour_vitesse_joueur1($bdd_vitesse_j1) {
            return rand(0, $bdd_vitesse_j1);
        }

        function tour_vitesse_joueur2($bdd_vitesse_j2) {
            return rand(0, $bdd_vitesse_j2);
        }

        function boxeur_attaque($puissance_initiateur) {
            return rand(0, $puissance_initiateur);
        }

        // Example of game logic or loop here
        // Use the above functions to simulate turns and calculate damage
    ?>
</body>

</html>
