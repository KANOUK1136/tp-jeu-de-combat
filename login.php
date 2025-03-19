<?php
    $pseudo = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $prenom = isset($_POST["first_name"]) ? trim($_POST["first_name"]) : "";
        $nom = isset($_POST["name"]) ? trim($_POST["name"]) : "";

        if (!empty($prenom) && !empty($nom)) {
            $pseudo = strtolower(substr($prenom, 0, 1) . $nom);
        }

    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page d'inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>

    <h1>Inscription</h1>

    <form method="post">

        <div class="form-input-material">
            <label for="name">Nom</label> 
            <input type="text" name="name" id="name" class="form-control-material" required>
        </div>

        <div class="form-input-material">
            <label for="first_name">Prenom</label> 
            <input type="text" name="first_name" id="first_name" class="form-control-material" required>
        </div>

        <div class="form-input-material">
            <label for="password">Mot de passe</label> 
            <input type="password" name="password" id="password" class="form-control-material" required>
        </div>

        <div id="radio-buttons">
            <input type="radio" id="male" name="gender" value="male">
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Femelle</label>
        </div>

        <div>
            <label for="mail">E-mail :</label>
            <input type="email" id="mail" name="user_mail" required>
        </div>

        <input type="hidden" name="username" value="<?= htmlspecialchars($pseudo) ?>">

        <br>
        <button type="submit" class="btn btn-primary btn-ghost">S'inscrire</button>

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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $prenom = isset($_POST["first_name"]) ? trim($_POST["first_name"]) : "";
        $nom = isset($_POST["name"]) ? trim($_POST["name"]) : "";
        $password = isset($_POST["password"]) ? $_POST["password"] : "";
        $email = isset($_POST["user_mail"]) ? trim($_POST["user_mail"]) : "";
        $genre = isset($_POST["gender"]) ? $_POST["gender"] : "";

        if (!empty($prenom) && !empty($nom) && !empty($password) && !empty($email) && !empty($genre)) {
            // Vérification si l'email est déjà utilisé
            $checkEmail = $pdo->prepare("SELECT id FROM table_utilisateurs WHERE email = :email");
            $checkEmail->execute([":email" => $email]);

            if ($checkEmail->rowCount() > 0) {
                echo "Erreur : Cet email est deja utilise.";
            } else {
                $pseudo = strtolower(substr($prenom, 0, 1) . $nom);
                $password_hashed = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO table_utilisateurs (pseudo, nom, prenom, mdp_hash, email, genre) 
                        VALUES (:pseudo, :nom, :prenom, :mdp_hash, :email, :genre)";

                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ":pseudo" => $pseudo,
                    ":nom" => $nom,
                    ":prenom" => $prenom,
                    ":mdp_hash" => $password_hashed,
                    ":email" => $email,
                    ":genre" => $genre
                ]);

                echo "Inscription réussie !";
                header("Location: choix_personnage.php");
                exit();
            }
        } else {
            echo "Tous les champs sont obligatoires.";
        }
    }
?>

</form>
</body>
</html>
