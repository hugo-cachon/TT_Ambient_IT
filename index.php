<?php

// Import de la fonction de tri
include_once('utils/utils.php');

$xml = @simplexml_load_file("DatesFormations.xml") or die('Error: Can\'t load XML file.');

// Création d'un tableau pour stocker les données du XML
$sessions = array();

    foreach($xml->Formation as $formation) {
        
        foreach($formation->Session as $info) {
            
            // Chaque informations à afficher de la formation sont stockées
            // dans tableau associatif 

            $currentFormation = array(
                "category" => $formation->Categorie,
                "image" => $formation->Image,
                "duration" => $formation->Duree,
                "name" => $formation->Nom,
                "url" => $formation->Url,
                // Conversion de la date en int pour pouvoir effectuer le tri
                "startDate" => strtotime($info->StartDate),
            );
            
            // Chaque nouveau tableau associatif est ensuite ajouté
            // dans le tableau principal $sessions
            array_push($sessions, $currentFormation);
    
        }
        
    }

    // En utlisant un algorithme de tri, les formations ressortiront triées par
    // dates croissantes
    $sorted_sessions = bubble_Sort($sessions);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://meyerweb.com/eric/tools/css/reset/reset.css">
    <link rel="stylesheet" href="style/style.css">
    <title>Formations</title>
</head>
<body>
    <header>
            <h1>PROCHAINES SESSIONS</h1>
            <p>Retrouvez-nous sur Paris ou en Classe Virtuelle lors de nos prochaines sessions de formation organisées en interentreprises</p>
    </header>
    <!-- Pour chaque sessions qui ressortiront triées, on peut ensuite afficher les informations en faisant simplement une loop -->
    <main>
    <?php foreach($sorted_sessions as $display): ?>
    
    <div class="formation-container">
        
        <a href="<?= $display["url"]?>">            
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Formation</th>
                    <th>Catégorie</th>
                    <th>Date</th>
                    <th>Durée</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img src="<?= $display["image"] ?>" alt="logo <?=$display["name"]?>"></td>
                    <td><?= $display["name"]  ?></td>
                    <td><?= $display["category"]?></td>
                    <!-- Conversion du timestamp en date -->
                    <td><?= strftime("%d %h %Y", $display["startDate"]) ?></td>
                    <td><?= $display["duration"] ?> jours</td>
                </tr>
            </tbody>
        </table>
        </a>

    </div>
    
    <?php endforeach ?>
    </main>
</body>
</html>

