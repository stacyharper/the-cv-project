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
    <?php
    $bdd = new PDO(
        'mysql:host=the-cv-project-mysql;dbname=cv;charset=utf8',
        'cv',
        'cv'
    );
    ?>

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
                echo '</li>';
            }
        }
        ?>
    </ul>

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
                echo '</li>';
            }
        }
        ?>
    </ul>

    <h2>Mes Diplômes</h2>
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
                echo '</li>';
            }
        }
        ?>
    </ul>
</body>
</html>


