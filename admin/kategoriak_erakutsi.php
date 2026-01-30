<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Kategoriak</title>
</head>
<body>
    <h1>Administrazio gunea</h1>
    <p>Kategoriak</p>
    <ul>
        <?php for ($i = 0; $i < count($kategoriak); $i++) { ?>
            <li>
                <?php echo $kategoriak[$i]->getIzena() ?> 
                <?php echo $kategoriak[$i]->getLaburpena() ?>
                [<a href="kategori_aldatu/?id_kategoria=<?php echo $kategoriak[$i]->getId() ?>">aldatu</a>]
                [<a href="kategori_ezabatu/?id_kategoria=<?php echo $kategoriak[$i]->getId() ?>">ezabatu</a>]
            </li>
        <?php } ?>
    </ul>
    <form action="kategori_berria/" method="post">
        <p><input type="submit" value="Kategoria berria"></p>
    </form>
</body>
</html>