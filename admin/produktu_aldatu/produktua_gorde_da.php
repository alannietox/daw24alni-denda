<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Produktuak</title>
</head>

<body>
    <h1>Administrazio gunea</h1>
    <p><a href="..">Hasiera</a></p>
    
    <h2>Produktu Aldatu</h2>
    
    <p><?php echo $mezua; ?></p>
    
    <table cellspacing="5" cellpadding="5" border="1">
        <tr>
            <td align="right">Marka:</td>
            <td><?php echo $marka ?></td>
        </tr>
        <tr>
            <td align="right">Modeloa:</td>
            <td><?php echo $modeloa ?></td>
        </tr>
        <tr>
            <td align="right">Gama:</td>
            <td><?php echo $gama ?></td>
        </tr>
        <tr>
            <td align="right">Prezioa:</td>
            <td><?php echo $prezioa ?></td>
        </tr>
        <tr>
            <td align="right">Kategoria:</td>
            <td><?php echo $kategoriaIzena ?></td>
        </tr>
        <tr>
            <td align="right">Nobedadea:</td>
            <td><?php echo ($nobedadea == 1 ? 'Bai' : 'Ez') ?></td>
        </tr>
        <tr>
            <td align="right">Deskontua:</td>
            <td><?php echo $deskontua ?></td>
        </tr>
    </table>
</body>

</html>