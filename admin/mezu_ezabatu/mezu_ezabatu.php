<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Mezuak</title>
</head>

<body>
    <h1>Administrazio gunea</h1>
    <p><a href="..">Hasiera</a></p>

    <h2>Mezua Ezabatu</h2>

    <p style="color:red; font-weight:bold;"><?php echo $alerta; ?></p>

    <form method="post" action="index.php">
        <input type="hidden" name="id" value="<?php echo $id ?>">

        <table cellspacing="5" cellpadding="5" border="1">
            <tr>
                <td align="right">Izena:</td>
                <td><?php echo $izena ?></td>
            </tr>
            <tr>
                <td align="right">Email:</td>
                <td><?php echo $email ?></td>
            </tr>
            <tr>
                <td align="right">Mezua (Gorputza):</td>
                <td><?php echo $gorputza ?></td>
            </tr>
            <tr>
                <td align="right">Erantzuna:</td>
                <td><?php echo ($erantzuna == 1 ? 'Bai' : 'Ez') ?></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" name="ezabatu" value="Ezabatu">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>