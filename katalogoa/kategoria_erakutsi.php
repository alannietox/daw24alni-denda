<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produktuak - PcZone</title>
    <link rel="stylesheet" href="../hasiera/style.css"> 
</head>
<body>
    <header class="navbar">
        <div class="nav-left">
            <a href="../kontaktua" class="btn-contact">Kontaktua</a>
        </div>
        <div class="nav-right">
            <a href="../hasiera/index.php" aria-label="Inicio">🏠</a>
            <a href="#" aria-label="Perfil de Usuario">👤</a>
        </div>
    </header>

    <main>
        <article class="main-header" style="padding-block: 4%;">
        <h1>
            <?php echo isset($kategoriaActual) ? htmlspecialchars($kategoriaActual->getIzena()) : "Produktuak"; ?>
        </h1>
        </article>
        <p style="margin-left: 20px;"><a href="../hasiera/index.php">Hasiera</a> / <a href="./index.php">Kategoriak</a> / <?php echo isset($kategoriaActual) ? htmlspecialchars($kategoriaActual->getIzena()) : "Produktuak";?></p>
        <hr>

        <?php if ($dbError): ?>
            <p style="color: red; text-align: center;"><?php echo htmlspecialchars($dbError); ?></p>
        <?php elseif (!empty($produktuak)): ?>
            <nav class="info-grid">
                <?php foreach ($produktuak as $produktua): 
                ?>
                    <article class="info-card">
                        <div class="card-info">
                            <img src="../hasiera/img/produktua<?php echo $produktua->getId(); ?>.png" alt="" class="img">
                            
                            <h3 class="info-name"><?php echo htmlspecialchars($produktua->getMarka()); ?></h3>
                            <p class="info-description"><?php echo htmlspecialchars($produktua->getModeloa()); ?></p>
                            
                            <?php 
                                $prezioa = $produktua->getPrezioa();
                                $deskontua = $produktua->getDeskontua();
                                
                                if ($deskontua > 0) {
                                    $prezioFinal = $prezioa * (1 - ($deskontua / 100));
                                    echo "<h2 class='info-deskontua'>" . number_format($prezioa, 2) . "€</h2>";
                                    echo "<h2 class='info-prezioa'>" . number_format($prezioFinal, 2) . "€</h2>";
                                } else {
                                    echo "<h2 class='info-prezioa'>" . number_format($prezioa, 2) . "€</h2>";
                                }
                            ?>
                            
                            <a href="index.php?id_produktua=<?php echo $produktua->getId(); ?>" class="info-link">Ikusi Produktua</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </nav>
        <?php else: ?>
            <p style="text-align: center;">Ez dago produkturik kategoria honetan.</p>
        <?php endif; ?>
    </main>
</body>
</html>