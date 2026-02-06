<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Eskariak - Aldatzea</title>
</head>

<body>
    <h1>Administrazio gunea</h1>
    <p><a href="..">Hasiera</a></p>

    <h2>Eskaria Aldatu</h2>

    <p style="color:red;"><?php echo $alerta; ?></p>

    <form method="post" action="index.php">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars((string)($id ?? '')) ?>">

        <table cellspacing="5" cellpadding="5" border="1">
                <tr>
                <td align="right">Izena:</td>
                <td><?php echo $izena ?></td>
                </tr>
                <tr>
                    <td align="right">Abizena:</td>
                    <td><?php echo $abizena ?></td>
                </tr>
                <tr>
                    <td align="right">Helbidea:</td>
                    <td><?php echo $helbidea ?></td>
                </tr>
                <tr>
                    <td align="right">Herria:</td>
                    <td><?php echo $herria ?></td>
                </tr>
                <tr>
                    <td align="right">Postakodea:</td>
                    <td><?php echo $postakodea ?></td>
                </tr>
                <tr>
                    <td align="right">Probintzia:</td>
                    <td><?php echo $probintzia ?></td>
                </tr>
                <tr>
                    <td align="right">Email:</td>
                    <td><?php echo $email ?></td>
                </tr>
                <tr>
                    <td align="right">Egoera:</td>
                    <td>
                        <input type="checkbox" name="egoera" value="1" <?= (!empty($egoera) && $egoera == 1) ? 'checked' : '' ?>>
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