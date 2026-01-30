<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eskaria Eginda - PcZone</title>
    <link rel="stylesheet" href="../hasiera/style.css">
    <link rel="stylesheet" href="saskia_erakutsi.css">
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
        <h1>Eskaria Berretsita!</h1>
        <hr>
        <div class="info-grid saskia-grid" style="margin-top: 40px;">

            <article class="info-card saskia-card">
                
                <h3 class="info-name" style="border-bottom: 2px solid #ddd; padding-bottom: 10px; margin-bottom: 15px;">
                    Bezeroaren Datuak
                </h3>
                
                <div style="display: flex; flex-wrap: wrap; margin-bottom: 30px;">
                    <div style="flex: 1; min-width: 250px;">
                        <p class="info-description"><strong>Izena:</strong> <?php echo htmlspecialchars($bezeroa['izena']); ?></p>
                        <p class="info-description"><strong>Abizena:</strong> <?php echo htmlspecialchars($bezeroa['abizena']); ?></p>
                    </div>
                    <div style="flex: 1; min-width: 250px;">
                        <p class="info-description"><strong>Email:</strong> <?php echo htmlspecialchars($bezeroa['email']); ?></p>
                        <p class="info-description"><strong>Helbidea:</strong> <?php echo htmlspecialchars($bezeroa['helbidea']); ?></p>
                    </div>
                </div>

                <h3 class="info-name" style="border-bottom: 2px solid #ddd; padding-bottom: 10px; margin-bottom: 15px;">
                    Erositako Produktuak
                </h3>
                
                <table class="saskia-table">
                    <thead>
                        <tr>
                            <th class="info-name" style="font-size: 16px;">Produktua</th>
                            <th class="info-name" style="font-size: 16px; text-align: center;">Kop.</th>
                            <th class="info-name" style="font-size: 16px; text-align: right;">Prezioa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // Recuperar datos antes de borrar la sesión
                        $detaileak = $saskia->getDetaileak();
                        $totala = 0;

                        foreach ($detaileak as $det):
                            $prod = $det->getProduktua();
                            
                            // Prezio kalkulua
                            $prezioa = $prod->getPrezioa();
                            if(method_exists($prod, 'getDeskontua') && $prod->getDeskontua() > 0){
                                $prezioa = $prezioa * (1 - ($prod->getDeskontua()/100));
                            }
                            
                            $kopurua = $det->getKopurua();
                            $subtotala = $prezioa * $kopurua;
                            $totala += $subtotala;
                        ?>
                        <tr>
                            <td>
                                <span class="info-name" style="font-size: 15px; margin:0;">
                                    <?php echo htmlspecialchars($prod->getMarka() . " " . $prod->getModeloa()); ?>
                                </span>
                            </td>
                            <td class="info-description" style="text-align: center;"><?php echo $kopurua; ?></td>
                            <td class="info-prezioa" style="font-size: 16px; margin:0; text-align: right;">
                                <?php echo number_format($subtotala, 2, ',', '.'); ?> €
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <tr>
                            <td colspan="2" style="text-align: right; padding-top: 20px; border-bottom: none;">
                                <strong class="info-name">GUZTIRA ORDAINDUA:</strong>
                            </td>
                            <td style="text-align: right; padding-top: 20px; border-bottom: none;">
                                <span class="info-prezioa" style="font-size: 22px;"><?php echo number_format($totala, 2, ',', '.'); ?> €</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <div style="text-align: center; margin-top: 40px;">
                    <?php 
                        // Lógica original: vaciar saskia
                        $_SESSION['saskia'] = new com\leartik\alni\saskiak\Saskia();
                    ?>
                    <a href="../hasiera" class="btn-contact" style="font-size: 16px; padding: 12px 25px;">Itzuli Hasierara</a>
                </div>

            </article>
        </div>
    </main>

</body>
</html>