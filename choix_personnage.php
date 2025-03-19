<?php
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

    // Recuperer les personnages depuis la base de donnees
    $sql = "SELECT id, nom, prenom, pseudo, puissance, pv, vitesse FROM table_personnage";
    $stmt = $pdo->query($sql);
    $personnages = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Choix des personnages</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/choix_des_personnages.css">
    <?php include 'banniere.php'; ?>
</head>

<body> 
    <link rel="stylesheet" type="text/css" href="css/choix_des_personnages.css">
    <h1>Choix des personnages</h1>  
    <form method="post" action="page_combat.php">
        <div class="personnages-container">
            <?php foreach ($personnages as $personnage): ?>
                <label class="personnage">
                    <input type="radio" name="personnage_id" value="<?= $personnage['id'] ?>" required>
                    <div class="card">
                        <h2><?= htmlspecialchars($personnage['pseudo']) ?></h2>
                        <p><strong>Nom :</strong> <?= htmlspecialchars($personnage['nom']) ?></p>
                        <p><strong>Prenom :</strong> <?= htmlspecialchars($personnage['prenom']) ?></p>
                        <p><strong>Puissance :</strong> <?= htmlspecialchars($personnage['puissance']) ?></p>
                        <p><strong>PV :</strong> <?= htmlspecialchars($personnage['pv']) ?></p>
                        <p><strong>Vitesse :</strong> <?= htmlspecialchars($personnage['vitesse']) ?></p>
                    </div>
                </label>
            <?php endforeach; ?>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
</body>
</html>
