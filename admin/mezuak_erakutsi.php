<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Mezuak</title>
</head>
<body>
    <p>Mezuak</p>
    <ul>
        <?php for ($i = 0; $i < count($mezuak); $i++) { ?>
            <li>
                <?php echo $mezuak[$i]->getSortzeData() ?>
                <?php echo $mezuak[$i]->getEmail() ?>
                [<a href="mezu_aldatu/?id=<?php echo $mezuak[$i]->getId() ?>">aldatu</a>]
                [<a href="mezu_ezabatu/?id=<?php echo $mezuak[$i]->getId() ?>">ezabatu</a>]
            </li>
        <?php } ?>
    </ul>
    <form action="mezu_berria/" method="post">
        <p><input type="submit" value="Mezu berria"></p>
    </form>
    <p><a href="irten.php">Sesiotik irten</a></p>
</body>
</html>