<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
    /**
     * 1. Importez le contenu du fichier user.sql dans une nouvelle base de données.
     * 2. Utilisez un des objets de connexion que nous avons fait ensemble pour vous connecter à votre base de données.
     *
     * Pour chaque résultat de requête, affichez les informations, ex:  Age minimum: 36 ans <br>   ( pour obtenir une information par ligne ).
     *
     * 3. Récupérez l'age minimum des utilisateurs.
     * 4. Récupérez l'âge maximum des utilisateurs.
     * 5. Récupérez le nombre total d'utilisateurs dans la table à l'aide de la fonction d'agrégation COUNT().
     * 6. Récupérer le nombre d'utilisateurs ayant un numéro de rue plus grand ou égal à 5.
     * 7. Récupérez la moyenne d'âge des utilisateurs.
     * 8. Récupérer la somme des numéros de maison des utilisateurs ( bien que ca n'ait pas de sens ).
     */

    // TODO Votre code ici, commencez par require un des objet de connexion que nous avons fait ensemble.
    $server = 'localhost';
    $user = 'root';
    $password ='dev';
    $db = 'db_cours';

    try {
        $connect= new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $password);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);


        /*1*/
        $stmt = $connect->prepare("SELECT MIN(age) FROM user");
        $result = $stmt->execute();

        /*2*/
        $stmt = $connect->prepare("SELECT MAX(age) FROM user");
        $result = $stmt->execute();

        /*3*/
        $stmt = $connect->prepare("SELECT count(*) as user FROM user");
        if($stmt) {
            $calcul = $stmt->fetch();
            echo "Il y a " . $calcul;
        }
        $result = $stmt->execute();

        /*4*/
        $stmt = $connect->prepare("SELECT count(*) as numero From user AND numero='5' ");
        if($stmt) {
            $tadaam = $stmt->fetch();
            echo "il y a " . $tadaam . "utilisateurs";
        }
        $result = $stmt->execute();

        /*5*/
        $stmt = $connect->prepare("SELECT AVG(age) as moyenne_age FROM user");
        if($stmt) {
            $answer = $stmt->fetch();
            echo "La moyenne d'ages des users est de -> " . $answer;
        }
        $result = $stmt->execute();

        /*6*/
        $stmt = $connect->prepare("SELECT SUM(numero) as somme_numero FROM user");
        if($stmt) {
            $go = $stmt->fetch();
            echo "la somme des numéros de maison des utilisateurs est de -> " . $go;
        }
        $result = $stmt->execute();
    }
    catch(PDOException $exception) {
        echo $exception->getMessage();
    }

    ?>
</body>
</html>

