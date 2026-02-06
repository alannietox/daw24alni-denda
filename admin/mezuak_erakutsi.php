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
                <p>
                <strong>ID:</strong>
                <?php echo $mezuak[$i]->getId() ?>
                <strong>/ Data:</strong>
                <?php echo $mezuak[$i]->getSortzeData() ?>
                <strong>/ Email:</strong>
                <?php echo $mezuak[$i]->getEmail() ?>
                <strong>/ Erantzuna:</strong>
                <?php echo ($mezuak[$i]->getErantzuna() == 1 ? 'Bai' : 'Ez') ?>
                [<a href="mezu_aldatu/?id=<?php echo $mezuak[$i]->getId() ?>">aldatu</a>]
                [<a href="mezu_ezabatu/?id=<?php echo $mezuak[$i]->getId() ?>">ezabatu</a>]
                </p>
            </li>
        <?php } ?>
    </ul>
</body>
</html>