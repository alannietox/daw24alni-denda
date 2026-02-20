<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albisteak - PcZone</title>
    <link rel="stylesheet" href="../hasiera/style.css"> 
</head>
<body>

    <header class="navbar">
        <div class="nav-left">
            <a href="../kontaktua" class="btn-contact">Kontaktua</a>
        </div>
        <div class="nav-right">
            <a href="../hasiera/index.php" aria-label="Hasiera">🏠</a>
            <a href="#" aria-label="Perfil de Usuario">👤</a>
        </div>
    </header>

    <main>
        <article class="main-header">
            <h1>Albisteak</h1>
        </article>
        
        <hr>

        <?php if (empty($albisteak)): ?>
            <p style="text-align: center; margin-bottom: 40px; color: red;">Ez da albisterik aurkitu edo konexio errorea egon da.</p>
        <?php else: ?>
            
            <nav class="info-grid">
                <?php foreach ($albisteak as $item): ?>
                    <article class="info-card">
                        <div class="card-info">
                            <h3 class="info-name">
                                <?= htmlspecialchars($item['izenburua']) ?>
                            </h3>
                            <hr style="width: 50px; margin: 15px auto;">
                            <p class="info-description">
                                <strong style="color: #333;">Laburpena: </strong><br>
                                <?= htmlspecialchars($item['laburpena']) ?>
                            </p>
                            <p class="info-description">
                                <strong style="color: #333;">Xehetasunak: </strong><br>
                                <?= htmlspecialchars($item['xehetasunak']) ?>
                            </p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </nav>

        <?php endif; ?>
    </main>

</body>
</html>