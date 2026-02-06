<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Eskariak</title>
</head>
<body>
    <p>Eskariak</p>
    <ul>
        <?php for ($i = 0; $i < count($eskariak); $i++) { ?>
            <li>
                <p>
                <strong>ID:</strong>
                <?php echo $eskariak[$i]->getId() ?>
                <strong>/ Data:</strong>
                <?php echo $eskariak[$i]->getData() ?>
                <strong>/ Bezeroa:</strong>
                <?php echo $eskariak[$i]->getBezeroa()->getIzena() ?>
                <strong>/ Egoera:</strong>
                <?php echo ($eskariak[$i]->getEgoera() == 1 ? 'Bai' : 'Ez') ?>
                [<a href="eskari_aldatu/?id=<?php echo $eskariak[$i]->getId() ?>">aldatu</a>]
                [<a href="eskari_ezabatu/?id=<?php echo $eskariak[$i]->getId() ?>">ezabatu</a>]
                </p>
            </li>
        <?php } ?>
    </ul>
    <p><a href="irten.php">Sesiotik irten</a></p>
</body>
</html>