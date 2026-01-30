
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($titulo_pagina); ?> - PcZone</title>
    <link rel="stylesheet" href="./produktua.css">
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

        <h1>Produktuak</h1>

        <p class="breadcrumb">
            <a href="../hasiera/index.php">Hasiera</a> &gt; 
            <?php echo htmlspecialchars($titulo_pagina); ?>
        </p>

        <hr>

        <?php if ($produktua): ?>

            <div class="produktua-layout">

                <div class="produktua-img-container">
                    <img src="../hasiera/img/produktua<?php echo htmlspecialchars($produktua->getId()); ?>.png" 
                         alt="<?php echo htmlspecialchars($produktua->getModeloa()); ?>">
                </div>

                <div class="produktua-info">

                    <h2 class="marka-modeloa">
                        <?php echo htmlspecialchars($produktua->getMarka()); ?> - 
                        <?php echo htmlspecialchars($produktua->getModeloa()); ?>
                    </h2>

                    <p class="gama-info">
                        <strong>Gama:</strong> 
                        <?php echo htmlspecialchars($produktua->getGama()); ?>
                    </p>

                    <hr>

                    <?php if ($deskontua > 0): ?>

                        <p class="prezio-originala">
                            <?php echo number_format($prezioa, 2, ',', '.'); ?> €
                        </p>

                        <p class="prezio-finala">
                            <?php echo number_format($prezio_final, 2, ',', '.'); ?> €
                        </p>

                        <span class="deskontu-etiketa">
                            -%<?php echo $deskontua; ?> DESKONTUA
                        </span>

                    <?php else: ?>

                        <p class="prezio-finala">
                            <?php echo number_format($prezioa, 2, ',', '.'); ?> €
                        </p>

                    <?php endif; ?>

                    <hr>

                    <p class="produktua-deskribapena">
                        "Produktu hau errendimendu altuko ordenagailuentzat diseinatua dago. 
                        Jolasetan eta lan profesionaletan errendimendu maximoa lortzeko aukera ematen du."
                    </p>

                    <form action="../saskia/index.php" method="POST">
    <input type="hidden" name="action" value="add">
    <input type="hidden" name="id_produktua" value="<?php echo $produktua->getId(); ?>">
    
    <input type="number" name="kopurua" value="1" min="1" style="width: 60px; padding: 10px; margin-top:10px; border-radius:5px; border:1px solid #ccc;">
    
    <button type="submit" class="btn-erosketa" style="border:none; cursor:pointer; width:100%;">
        GEHITU SASKIRA
    </button>
</form>

                </div>

            </div>

        <?php else: ?>

            <div class="produktua-errorea">
                <h2>Produktua Ez Da Aurkitu</h2>
                <p>Barkatu, eskatutako produktua ez dago eskuragarri.</p>
            </div>

        <?php endif; ?>

    </main>

</body>
</html>
