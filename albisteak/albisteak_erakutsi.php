<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produktuak - PescaNova</title>
    <link rel="stylesheet" href="../css/index.css"> 
    <link rel="stylesheet" href="../css/albisteak_erakutsi.css"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
</head>
<body>

    <header class="main-header">
        <div class="logo-container">
            <a href="..">
            <img class="logoa" src="../img/logo.png" alt="PescaNova Logo">
            </a>
        </div>

        <div class="titulos-centrales"> 
            <h1>PescaNova</h1> 
            <h3>Arrain-denda</h3>       
        </div>         
        <div class="cart-container">
            <a href="../saskia/index.php" class="zesta-link">
                <img class="zesta" src="../img/zesta.png" alt="Saskia">
                <span class="cart-text">Saskia</span>
            </a>
        </div>
    </header>

    <nav class="main-nav">
        <ul>
            <li><a href="..">Hasiera</a></li>
            <li><a href="../katalogoa/index.php">Katalogoa</a></li>
            <li><a href="../gehiago/gehiago.html">Gehiago</a></li>
            <li><a href="../kontaktua/kontaktua.php">Kontaktua</a></li>
            <li><a href="../produktuak/index.php">Produktuak</a></li>
        </ul>
    </nav>

    <h1 class="section-title">Gure Albisteak</h1>
    <hr class="section-divider">

    <?php if (empty($albisteak)): ?>
        <p class="error">Ez da albisterik aurkitu edo konexio errorea egon da.</p>
    <?php else: ?>
        
        <div class="zerrenda">
            <?php foreach ($albisteak as $item): ?>
                <div class="albistea">
                    <h2>
                        <a href="albistea_ikusi.php?id=<?= $item['id'] ?>">
                            <?= htmlspecialchars($item['izenburua']) ?>
                        </a>
                    </h2>
                    <hr>
                
                    <p><strong style="color: black;">Laburpena: </strong><?= htmlspecialchars($item['laburpena']) ?></strong></p>
                    <p><strong style="color: black;">Xehetasunak: </strong><?= htmlspecialchars($item['xehetasunak']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>
</body>
</html>