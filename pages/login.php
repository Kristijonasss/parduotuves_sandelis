<?php
if (isset($_POST['pastas'])) {
    $pastas = $_POST['pastas'];
    $slaptazodis= $_POST['slaptazodis'];

    $errors = [];

    if (empty($pastas) || empty($slaptazodis)) {
        $errors[] = 'Yra tusciu lauku';
    }


    $checkUser = mysqli_query($database, 'select * from darbuotojai where pastas = "' . $pastas . '" and slaptazodis = "' . $slaptazodis . '"');
    $checkUser = mysqli_fetch_row($checkUser);

    if ($checkUser == null) {
        $errors[] = 'Blogi prisijungimo duomenys';
    }

    if (empty($errors)) {
        $_SESSION['pastas'] = $pastas;
        header('Location: index.php');
    }
}
?>
<h1>Prisijungimas</h1>
<ul>
    <?php
    if (isset($errors)) {
        foreach ($errors as $error) {
            ?>
            <li>
                <?php echo $error ?>
            </li>
        <?php }
    } ?>
</ul>
<form action="index.php?page=login" method="post">
    <table>
        <tr>
            <td>
                Paštas:
            </td>
            <td>
                <input type="text" name="pastas" value="<?php echo $_GET['pastas'] ?? null ?>">
            </td>
        </tr>
        <tr>
            <td>
                Slaptažodis:
            </td>
            <td>
                <input type="text" name="slaptazodis">
            </td>
        </tr>
    </table>
    <br/><br/>
    <button type="submit">Prisijungti</button>
</form>
