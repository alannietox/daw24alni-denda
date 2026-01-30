<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Mezuak</title>
</head>

<body>
    <h1>Administrazio gunea</h1>
    <p><a href="..">Hasiera</a></p>
    
    <h2>Mezua Aldatu</h2>

    <p><strong>Errorea:</strong> <?php echo $alerta; ?></p>
    
    <table cellspacing="5" cellpadding="5" border="1" class="tabla">
        <tr>
            <td align="right">Izena:</td>
            <td><?php echo $izena ?></td>
        </tr>
        <tr>
            <td align="right">Email:</td>
            <td><?php echo $email ?></td>
        </tr>
        <tr>
            <td align="right">Mezua:</td>
            <td><?php echo $gorputza ?></td>
        </tr>
        <tr>
            <td align="right">Erantzuna:</td>
            <td><?php echo ($erantzuna == 1 ? 'Bai' : 'Ez') ?></td>
        </tr>
    </table>
</body>

</html>