<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page d'inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>

<body>
        <br>
        <h1>Inscription</h1>

        <div class="form-input-material">
            <label for="username">Pseudo</label> 
            <input type="text" name="username" id="username" autocomplete="off" class="form-control-material" required>
        </div>

        <div class="form-input-material">
            <label for="password">Mot de passe</label> 
            <input type="password" name="password" id="password" autocomplete="off" class="form-control-material" required>
        </div>

        <div class="form-input-material">
            <label for="nom">Nom</label> 
            <input type="name" name="name" id="name" autocomplete="off" class="form-control-material" required>
        </div>

        <div class="form-input-material">
            <label for="first_name">Prénom</label> 
            <input type="first_name" name="first_name" id="first_name" autocomplete="off" class="form-control-material" required>
        </div>

        <div id="radio-buttons">
            <input type="radio" id="male" name="gender" value="male">
            <label for="male">Male</label>
            <input type="radio" id="gender" name="gender" value="female">
            <label for="female">Femelle</label>
        </div>

        <div>
            <label for="mail">E-mail:</label>
            <input type="email" id="mail" name="user_mail" />
        </div>
        <br>
        <button type="submit" class="btn btn-primary btn-ghost">Connexion</button>
    </form>
</body>
</html>
