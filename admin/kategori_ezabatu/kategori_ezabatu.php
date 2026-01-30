<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Kategoriak</title>
</head>

<body>
    <h1>Administrazio gunea</h1>
    <p><a href="..">Hasiera</a></p>
    
    <h2>Kategoria Ezabatu</h2>
    
    <p><?php echo $mezua; ?></p>
    
    <form method="post" action="index.php">
        <input type="hidden" name="id_kategoria" value="<?php echo $id ?>">
        
        <table cellspacing="5" cellpadding="5" border="1">
            <tr>
                <td align="right">Izena:</td>
                <td><?php echo $izena ?></td>
            </tr>
            <tr>
                <td align="right">Laburpena:</td>
                <td><?php echo $laburpena ?></td>
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