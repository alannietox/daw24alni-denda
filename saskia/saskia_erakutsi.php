<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zure Saskia - PcZone</title>
    <link rel="stylesheet" href="../hasiera/style.css">
    <link rel="stylesheet" href="saskia_erakutsi.css">
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
        <h1 style="margin-bottom: 20px;">Erosketa Saskia</h1>
        <hr>

        <div class="info-grid saskia-grid">
            
            <article class="info-card saskia-card">
                
                <div class="saskia-actions">
                    <a href="../katalogoa/index.php" class="info-link" style="font-size: 16px;">&larr; Jarraitu erosten</a>
                    <a href="index.php?action=empty" class="btn-contact btn-red">Hustu Saskia</a>
                </div>

                <div class="card-info">
                    <table class="saskia-table">
                        <thead>
                            <tr>
                                <th class="info-name" style="font-size: 18px;">Produktua</th>
                                <th class="info-name" style="font-size: 18px;">Prezioa</th>
                                <th class="info-name" style="font-size: 18px;">Kopurua</th>
                                <th class="info-name" style="font-size: 18px;">Guztira</th>
                                <th class="info-name"></th> </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $detaileak = $saskia->getDetaileak();
                        $totala = 0;

                        if (!empty($detaileak)): 
                            foreach ($detaileak as $det):
                                $prod = $det->getProduktua();
                                $prezioa = $prod->getPrezioa();
                                if($prod->getDeskontua() > 0){
                                    $prezioa = $prezioa * (1 - ($prod->getDeskontua()/100));
                                }
                                
                                $kopurua = $det->getKopurua();
                                $subtotala = $prezioa * $kopurua;
                                $totala += $subtotala;
                        ?>
                            <tr>
                                <td>
                                    <span class="info-name" style="font-size: 16px; margin:0;">
                                        <?php echo htmlspecialchars($prod->getMarka() . " " . $prod->getModeloa()); ?>
                                    </span>
                                </td>
                                <td class="info-description"><?php echo number_format($prezioa, 2, ',', '.'); ?> €</td>
                                
                                <td class="info-description">
                                    <form action="index.php" method="POST">
                                        <input type="hidden" name="action" value="update">
                                        <input type="hidden" name="id_produktua" value="<?php echo $prod->getId(); ?>">
                                        <input type="number" name="kopurua" value="<?php echo $kopurua; ?>" min="1" class="input-kopurua" onchange="this.form.submit()">
                                    </form>
                                </td>

                                <td class="info-prezioa" style="font-size: 18px; margin:0;"><?php echo number_format($subtotala, 2, ',', '.'); ?> €</td>
                                
                                <td style="text-align: center;">
                                    <a href="index.php?action=remove&id=<?php echo $prod->getId(); ?>" class="btn-delete" title="Ezabatu produktua">X</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="info-description" style="text-align: center; padding: 40px;">Saskia hutsik dago.</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if (!empty($detaileak)): ?>
                    <div style="margin-top: 30px; text-align: right; border-top: 1px solid #ddd; padding-top: 20px;">
                        <p class="info-name" style="display: inline-block; margin-right: 15px;">GUZTIRA:</p>
                        <span class="info-prezioa" style="font-size: 28px;"><?php echo number_format($totala, 2, ',', '.'); ?> €</span>
                        
                        <div style="margin-top: 20px;">
                            <a href="index.php?action=checkout" class="btn-contact btn-green">EROSKETAREKIN JARRAITU &rarr;</a>
                        </div>
                    </div>
                <?php endif; ?>

            </article>
        </div>
    </main>
</body>
</html>