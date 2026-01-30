<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Kategoriak - Aldatzea</title>
</head>

<body>
    <h1>Administrazio gunea</h1>
    <p><a href="..">Hasiera</a></p>
    
    <h2>Kategoria Aldatu</h2>

    <p><?php echo $mezua;?></p>

    <form method="post" action="index.php">
        <input type="hidden" name="id_kategoria" value="<?php echo htmlspecialchars($id) ?>">
        <table cellspacing="5" cellpadding="5" border="1">
            <tr>
                <td align="right">Izena:</td>
                <td><input type="text" name="izena" value="<?php echo htmlspecialchars($izena) ?>"></td>
            </tr>
            <tr>
                <td align="right">Laburpena:</td>
                <td><input type="text" name="laburpena" value="<?php echo htmlspecialchars($laburpena) ?>"></td>
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