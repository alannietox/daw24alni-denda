<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Produktuak</title>
</head>
<body>
    <p>Produktuak</p>
    <ul>
        <?php for ($i = 0; $i < count($produktuak); $i++) { ?>
            <li>
                <p>
                <strong>ID:</strong>
                <?php echo $produktuak[$i]->getId() ?>
                <strong>/ Marka:</strong>
                <?php echo $produktuak[$i]->getMarka() ?> 
                <strong>/ Modeloa:</strong>
                <?php echo $produktuak[$i]->getModeloa() ?>
                [<a href="produktu_aldatu/?id=<?php echo $produktuak[$i]->getId() ?>">aldatu</a>]
                [<a href="produktu_ezabatu/?id=<?php echo $produktuak[$i]->getId() ?>">ezabatu</a>]
                </p>
            </li>
        <?php } ?>
    </ul>
    <form action="produktu_berria/" method="post">
        <p><input type="submit" value="Produktu berria"></p>
    </form>
</body>
</html>