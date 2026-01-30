<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Mezuak</title>
</head>

<body>
    <h1>Administrazio gunea</h1>
    <p><a href="..">Hasiera</a></p>
    
    <h2>Mezu Berria</h2>

    <p style="color: red;"><?php echo $alerta; ?></p>

    <form method="post" action="index.php">
        <table cellspacing="5" cellpadding="5" border="1">
            <tr>
                <td align="right">Izena:</td>
                <td><input type="text" name="izena" value="<?php echo $izena ?>"></td>
            </tr>
            <tr>
                <td align="right">Email:</td>
                <td><input type="email" name="email" value="<?php echo $email ?>"></td>
            </tr>
            <tr>
                <td align="right">Mezua:</td>
                <td>
                    <textarea name="gorputza" rows="4" cols="30"><?php echo $gorputza ?></textarea>
                </td>
            </tr>
            <tr>
                <td align="right">Erantzuna:</td>
                <td>
                    <input type="checkbox" name="erantzuna" value="1" <?= ($erantzuna == 1) ? 'checked' : '' ?>>
                </td>
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