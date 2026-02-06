<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Eskariak</title>
</head>

<body>
    <h1>Administrazio gunea</h1>
    <p><a href="..">Hasiera</a></p>

    <h2>Eskaria Aldatu</h2>

    <p><strong>Errorea:</strong> <?php echo $alerta; ?></p>

    <table cellspacing="5" cellpadding="5" border="1" class="tabla">
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
            <td><?php echo ($egoera == 1 ? 'Bai' : 'Ez') ?></td>
        </tr>
    </table>
</body>

</html>