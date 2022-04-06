<?php
if (isset($_POST['pastas'])) {
    $pastas = $_POST['pastas'];
    $pareigybe = $_POST['pareigybe'];
    $slaptazodis = $_POST['slaptazodis'];
    $vardas = $_POST['vardas'];

    $errors = [];


    if (!filter_var($pastas, FILTER_VALIDATE_EMAIL)) {
        $errors['pastas'][] = 'Neteisingas el. pastas';
    }

    if (strlen($slaptazodis) < 9) {
        $errors['slaptazodis'][] = 'slaptazodis turi buti ilgesnis nei 9 simboliai';
    }

    if (!preg_match('/[A-Za-z]/', $slaptazodis) || !preg_match('/[0-9]/', $slaptazodis)) {
        $errors['password'][] = 'slaptazodyje turi buti raide ir skaicius';
    }

    if (strlen($vardas) < 3 || strlen($vardas) > 60) {
        $errors['vardas'][] = 'vardas yra per ilgas arba per trumpas';
    }


    $checkEmail = mysqli_query($database, 'select * from darbuotojai where pastas = "' . $pastas . '"');
    $checkEmail = mysqli_fetch_row($checkEmail);
    if ($checkEmail != null) {
        $errors['pastas'][] = 'Pastas uzimtas';
    }
    echo '<pre>';
    print_r($checkEmail);


    if (empty($errors)) {
        $user = mysqli_query($database, 'insert into darbuotojai (vardas, pareigybe, pastas, slaptazodis) value ("' . $vardas . '", ' . $pareigybe . ', "' . $pastas . '", "' . $slaptazodis . '")');
        if ($user != false) {
            header('Location: index.php?=login&email=' . $pastas);
        } else {
            echo 'Nepavyko sukurti vartotojo';
        }
    }

}


//$darbuotojai = mysqli_fetch_all(
//    mysqli_query($database, 'select * from darbuotojai'),
//    MYSQLI_ASSOC
//);



?>
<h1>Registracija</h1>
<form action="index.php?page=register" method="post">
    <table>
        <tr>
            <td>
                Vardas:
            </td>
            <td>
                <input type="text" name="vardas" value="<?php echo $vardas ?? null ?>">
            </td>
            <td>
                <?php
                if (isset($errors['vardas'])) {
                    echo implode(',', $errors['vardas']);
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Pareigybe:
            </td>
            <td>
                <select name="pareigybe">
                    <option value="">-</option>
                    <option value="pareigybe"
                        <?php
                        if (($pareigybe ?? null) == 'sandelininkas') {
                            echo 'selected';
                        }
                        ?>
                    >
                        Sandelininkas
                    </option>
                    <option value="pareigybe"
                        <?php
                        if (($pareigybe ?? null) == 'parduotuves_darbuotojas') {
                            echo 'selected';
                        }
                        ?>
                    >
                        Parduotuves darbuotojas
                </select>
            </td>
            <td>
                <?php
                if (isset($errors['pareigybe'])) {
                    echo implode(',', $errors['pareigybe']);
                }
                ?>
            </td>
        </tr>
        <td>
            Paštas:
        </td>
        <td>
            <input type="text" name="pastas" value="<?php echo $pastas ?? null ?>">
        </td>
        <td>
            <?php
            if (isset($errors['pastas'])) {
                echo implode(',', $errors['pastas']);
            }
            ?>
        </td>
        </tr>
        <tr>
            <td>
                Slaptažodis:
            </td>
            <td>
                <input type="text" name="slaptazodis">
            </td>
            <td>
                <?php
                if (isset($errors['slaptazodis'])) {
                    echo implode(',', $errors['slaptazodis']);
                }
                ?>
            </td>
        </tr>

    </table>
    <button type="submit">Registruotis</button>
</form>
