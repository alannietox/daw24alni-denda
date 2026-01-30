<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Produktuak</title>
</head>

<body>
    <h1>Administrazio gunea</h1>
    <p><a href="..">Hasiera</a></p>
    
    <h2>Produktu Berria</h2>

    <p><?php echo $mezua; ?></p>

    <form method="post" action="index.php">
        <table cellspacing="5" cellpadding="5" border="1">
            <tr>
                <td align="right">Marka:</td>
                <td><input type="text" name="marka" value="<?php echo $marka ?>"></td>
            </tr>
            <tr>
                <td align="right">Modeloa:</td>
                <td><input type="text" name="modeloa" value="<?php echo $modeloa ?>"></td>
            </tr>
            <tr>
                <td align="right">Gama:</td>
                <td><input type="text" name="gama" value="<?php echo $gama ?>"></td>
            </tr>
            <tr>
                <td align="right">Prezioa:</td>
                <td><input type="text" name="prezioa" value="<?php echo $prezioa ?>"></td>
            </tr>
            <tr>
                <td align="right">Kategoria:</td>
                <td>
                    <select name="id_kategoriak" id="id_kategoriak" required>
                        <?php foreach ($kategoriak as $kategoria): ?>
                            <option value="<?= $kategoria->getId(); ?>"
                                <?= ($id_kategoriak == $kategoria->getId()) ? 'selected' : '' ?>>
                                <?= $kategoria->getIzena(); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right">Nobedadea:</td>
                <td><input type="checkbox" name="nobedadea" value="1" <?= (!empty($nobedadea) && $nobedadea == 1) ? 'checked' : '' ?>></td>
            </tr>
            <tr>
                <td align="right">Deskontua:</td>
                <td><input type="text" name="deskontua" value="<?php echo $deskontua ?>"></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Gorde" name="gorde">
                </td>
            </tr>
        </table>
    </form>
    </body>

</html>