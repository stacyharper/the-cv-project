<?php
$bdd = new PDO(
    'mysql:host=the-cv-project-mysql;dbname=cv;charset=utf8',
    'cv',
    'cv'
);
?>

<?php
if (!empty($_POST)) {
    if (!empty($_POST['category'])) {
        if ('schooling' === $_POST['category']) {
            if (
                !empty($_POST['title']) &&
                !empty($_POST['description']) &&
                !empty($_POST['location']) &&
                !empty($_POST['beginningDate']) &&
                !empty($_POST['endingDate'])
            ) {
                $query = 'INSERT INTO schooling(title, description, location, beginningDate, endingDate) VALUES(:title, :description, :location, :beginningDate, :endingDate)';
                $req = $bdd->prepare($query);
                $req->execute(array(
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                    'location' => $_POST['location'],
                    'beginningDate' => $_POST['beginningDate'],
                    'endingDate' => $_POST['endingDate']
                ));
            } elseif (!empty($_POST['id'])) {
                $bdd->exec('DELETE FROM schooling WHERE id = '. $_POST['id']);
            }
        } elseif ('experience' === $_POST['category']) {
            if (
                !empty($_POST['title']) &&
                !empty($_POST['description']) &&
                !empty($_POST['companyName']) &&
                !empty($_POST['beginningDate']) &&
                !empty($_POST['endingDate']) &&
                !empty($_POST['location'])
            ) {
                $query = 'INSERT INTO experience(title, description, companyName, beginningDate, endingDate, location) VALUES(:title, :description, :companyName, :beginningDate, :endingDate, :location)';
                $req = $bdd->prepare($query);
                $req->execute(array(
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                    'companyName' => $_POST['companyName'],
                    'beginningDate' => $_POST['beginningDate'],
                    'endingDate' => $_POST['endingDate'],
                    'location' => $_POST['location']
                ));
            } elseif (!empty($_POST['id'])) {
                $bdd->exec('DELETE FROM experience WHERE id = '. $_POST['id']);
            }
        } elseif ('hobby' === $_POST['category']) {
            if (
                !empty($_POST['title']) &&
                !empty($_POST['description']) &&
                !empty($_POST['beginningDate'])
            ) {
                $query = 'INSERT INTO hobby(title, description, beginningDate) VALUES(:title, :description, :beginningDate)';
                $req = $bdd->prepare($query);
                $req->execute(array(
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                    'beginningDate' => $_POST['beginningDate']
                ));
            } elseif (!empty($_POST['id'])) {
                $bdd->exec('DELETE FROM hobby WHERE id = '. $_POST['id']);
            }
        }
    }
}
?>

<!doctype html>
<html lang='fr'>
<head>
  <meta charset='utf-8'>
  <title>CV Eddie Barraco</title>
  <link rel='stylesheet' href='style.css'>
  <script src='script.js'></script>
</head>
<body>
    <h1>Mon CV</h1>

    <h2>Mes passions</h2>
    <ul>
        <?php
        $rows = $bdd->query('SELECT * FROM hobby');
        if ($rows) {
            foreach ($rows as $row) {
                echo '<li>';
                echo '<h3>' . $row['title'] . '</h3>';
                echo '<p>' . $row['beginningDate'] . '</p>';
                echo '<p>' . $row['description'] . '</p>';
                echo '<form method="post">';
                echo '<input required name="category" type="hidden" value="hobby"></input>';
                echo '<input required name="id" type="hidden" value="' . $row['id'] .'"></input>';
                echo '<input type="submit" value="Supprimer"></input>';
                echo '</form>';
                echo '</li>';
            }
        }
        ?>
    </ul>
    <h4>Ajouter une passion</h4>
    <form method="post">
        <input required name="category" type="hidden" value="hobby"></input>
        Titre: <input required name="title" type="text"></input><br />
        Date de début: <input required name="beginningDate" type="text"></input><br />
        Description: <input required name="description" type="text"></input><br />
        <input type="submit" value="Ajouter"></input>
    </form>

    <h2>Expériences Professionnelles</h2>
    <ul>
        <?php
        $rows = $bdd->query('SELECT * FROM experience');
        if ($rows) {
            foreach ($rows as $row) {
                echo '<li>';
                echo '<h3>' . $row['title'] . '</h3>';
                echo '<p>' . $row['beginningDate'] . ' - ' . $row['endingDate'] . '</p>';
                echo '<p>' . $row['companyName'] . '</p>';
                echo '<p>' . $row['location'] . '</p>';
                echo '<p>' . $row['description'] . '</p>';
                echo '<form method="post">';
                echo '<input required name="category" type="hidden" value="experience"></input>';
                echo '<input required name="id" type="hidden" value="' . $row['id'] .'"></input>';
                echo '<input type="submit" value="Supprimer"></input>';
                echo '</form>';
                echo '</li>';
            }
        }
        ?>
    </ul>
    <h4>Ajouter une expérience professionnelle</h4>
    <form method="post">
        <input required name="category" type="hidden" value="experience"></input>
        Titre: <input required name="title" type="text"></input type="text"><br />
        Nom de l'entreprise: <input required name="companyName" type="text"></input><br />
        Lieu: <input required name="location" type="text"></input><br />
        Date de début: <input required name="beginningDate" type="text"></input><br />
        Date de fin: <input required name="endingDate" type="text"></input><br />
        Description: <input required name="description" type="text"></input><br />
        <input type="submit" value="Ajouter"></input>
    </form>

    <h2>Mes Formations</h2>
    <ul>
        <?php
        $rows = $bdd->query('SELECT * FROM schooling');
        if ($rows) {
            foreach ($rows as $row) {
                echo '<li>';
                echo '<h3>' . $row['title'] . '</h3>';
                echo '<p>' . $row['beginningDate'] . ' - ' . $row['endingDate'] . '</p>';
                echo '<p>' . $row['companyName'] . '</p>';
                echo '<p>' . $row['location'] . '</p>';
                echo '<p>' . $row['description'] . '</p>';
                echo '<form method="post">';
                echo '<input required name="category" type="hidden" value="schooling"></input>';
                echo '<input required name="id" type="hidden" value="' . $row['id'] .'"></input>';
                echo '<input type="submit" value="Supprimer"></input>';
                echo '</form>';
                echo '</li>';
            }
        }
        ?>
    </ul>
    <h4>Ajouter une formation</h4>
    <form method="post">
        <input required name="category" type="hidden" value="schooling"></input>
        Titre: <input required name="title" type="text"></input><br />
        Lieu: <input required name="location" type="text"></input><br />
        Date de début: <input required name="beginningDate" type="date"></input><br />
        Date de fin: <input required name="endingDate" type="date"></input><br />
        Description: <input required name="description" type="text"></input><br />
        <input type="submit" value="Ajouter"></input>
    </form>
</body>
</html>


