<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasiera - PcZone</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="navbar">
        <div class="nav-left">
            <a href="../kontaktua" class="btn-contact">Kontaktua</a>
        </div>
        <div class="nav-right">
            <a href="#" aria-label="Perfil de Usuario">👤</a>
        </div>
    </header>
    <main>
        <article class="main-header">
            <h1>PcZone</h1>
        </article>
        <hr>

        <nav class="info-grid">

            <article class="info-card">
                <div class="card-info">
                    <h3 class="info-name">Kategoriak</h3>
                    <p class="info-description">Gure produktuak zuzenean esploratu: RAM, Txartel Grafikoak eta azken belaunaldiko Prozesadoreak.</p>
                    <a href="../katalogoa/index.php" class="info-link">Ikusi Katalogoa</a>
                </div>
            </article>

            <article class="info-card">
                <div class="card-info">
                    <h3 class="info-name">Informatika Informazioa</h3>
                    <p class="info-description">Gure helburua da teknologia onena zure esku jartzea, prezio justuekin eta aholkularitza adituarekin.</p>
                    <a href="../paginak/informatika_info.html" class="info-link">Informazioa</a>
                </div>
            </article>

            <article class="info-card">
                <div class="card-info">
                    <h3 class="info-name">Gure Buruz</h3>
                    <p class="info-description">Ezagutu PcZone-ren historia, gure komunitate teknologikoarekiko dugun konpromisoa.</p>
                    <a href="../paginak/gure_buruz.html" class="info-link">Gure Taldea Esagutu</a>
                </div>
            </article>
        </nav>
        <hr>
        <h1>Nobedadeak</h1>

        <?php
        if (!isset($nobedadeak)) { $nobedadeak = []; }
        if (!isset($dbError)) { $dbError = null; }

        if ($dbError): ?>
            <p style="color: red; text-align: center; margin-bottom: 40px;">Errorea datu-basean: <?php echo htmlspecialchars($dbError); ?></p>
        <?php elseif (!empty($nobedadeak)): ?>
            <nav class="info-grid">
                <?php foreach ($nobedadeak as $produktua):
                    if (is_array($produktua)) {
                        $marka = $produktua['marka'] ?? '';
                        $modeloa = $produktua['modeloa'] ?? '';
                        $prezioa = $produktua['prezioa'] ?? '';
                        $id = $produktua['id'] ?? '';
                    } 
                ?>
                    <article class="info-card">
                        <div class="card-info">
                            <img src="./img/produktua<?php echo $id; ?>.png" alt="" class="img">
                            <h3 class="info-name"><?php echo htmlspecialchars($marka); ?></h3>
                            <p class="info-description"><?php echo htmlspecialchars($modeloa); ?></p>
                            <h2 class="info-prezioa"><?php echo htmlspecialchars($prezioa); ?>€</h2>
                            <a href="../katalogoa/?id_produktua=<?php echo urlencode($id); ?>" class="info-link">Ikusi Produktua</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </nav>
        <?php else: ?>
            <p style="text-align: center; margin-bottom: 40px;">Ez dago nobedaderik momentu honetan.</p>
        <?php endif; ?>

        <hr>
        <h1>Deskontuak</h1>

        <?php
        if (!isset($deskontuak)) { $deskontuak = []; }
        if (!empty($deskontuak)): ?>
            <nav class="info-grid">
                <?php foreach ($deskontuak as $produktua):
                    if (is_array($produktua)) {
                        $modeloa = $produktua['modeloa'] ?? '';
                        $marka = $produktua['marka'] ?? '';
                        $deskontua = (int) ($produktua['deskontua'] ?? 0);
                        $prezioa = $produktua['prezioa'] ?? '';
                        $id = $produktua['id'] ?? '';
                    }
                    $prezio_final = $prezioa * (1 - ($deskontua / 100));
                ?>
                    <article class="info-card">
                        <div class="card-info">
                            <img src="./img/produktua<?php echo $id; ?>.png" alt="" class="img">
                            <h3 class="info-name"><?php echo htmlspecialchars($modeloa); ?></h3>
                            <p class="info-description">Marka: <?php echo htmlspecialchars($marka); ?></p>
                            <p class="info-description" style="color: red; font-weight: bold;">-<?php echo $deskontua; ?>% DESKONTUA</p>
                            <h2 class="info-deskontua"><?php echo htmlspecialchars($prezioa); ?>€</h2>
                            <h2 class="info-prezioa"> <?php echo number_format($prezio_final, 2, ',', '.') ?>€</h2>
                            <a href="../katalogoa/?id_produktua=<?php echo urlencode($id); ?>" class="info-link">Ikusi Produktua</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </nav>
        <?php else: ?>
            <p style="text-align: center; margin-bottom: 40px;">Ez dago deskonturik momentu honetan.</p>
        <?php endif; ?>

    </main>
</body>

</html>