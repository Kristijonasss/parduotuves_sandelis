<?php
include_once 'config.php';


// sukruti about me puslapi, kuriame galima redaguoti informacija apie save ir issaugoti
// atnaujinta i faila. Nebutina atnaujinti visko. pvz passwordas tuscias - jo nekeiciam
//file_get_contents()
//explode()
//implode()
//file_put_contents()

?>
<hr>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parduotuves sandelis!</title>
</head>
<body>
<style>
    table {
        padding: 10px;
    }

    td {
        padding: 10px;
    }
</style>
<!--menu-->
<table>
    <tr>
        <td>
            <a href="index.php">Namai</a>
        </td>

        <?php if (isLoged() === false) { ?>
            <td>
                <a href="index.php?page=login">Prisijungimas</a>
            </td>
            <td>
                <a href="index.php?page=register">Registracija</a>
            </td>
        <?php } ?>
        <?php if (isLoged() === true) { ?>
            <td>
                <a href="index.php?page=parduotuves">Parduotuves</a>
            </td>
            <td>
                <a href="index.php?page=logout">Atsijungti</a>
            </td>

        <?php } ?>
    </tr>
</table>

<?php
if ($page === null) {
    include 'pages/namai.php';
} elseif ($page === 'register') {
    include 'pages/register.php';
} elseif ($page === 'login') {
    include 'pages/login.php';
} elseif ($page === 'logout') {
    include 'pages/logout.php';
} elseif ($page === 'parduotuves') {
    include 'pages/parduotuves.php';
}
?>

</body>
</html>
