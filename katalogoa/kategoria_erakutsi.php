<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produktuak - PcZone</title>
    <link rel="stylesheet" href="../hasiera/style.css"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .filtro-wrapper {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        #buscador-categoria {
            width: 100%;
            max-width: 500px;
            padding: 12px 20px;
            font-size: 16px;
            border: 2px solid #ddd;
            border-radius: 30px;
            outline: none;
            transition: border-color 0.3s;
        }

        #buscador-categoria:focus {
            border-color: #007bff;
        }
    </style>
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

        <div class="filtro-wrapper">
            <input type="text" id="buscador-categoria" placeholder="Bilatu kategoria honetan..." autocomplete="off">
        </div>

        <?php if (isset($produktuak) && !empty($produktuak)): ?>
            
            <nav class="info-grid" id="lista-productos">
                
                <?php foreach ($produktuak as $produktua): ?>
                    <article class="info-card producto-card">
                        <div class="card-info">
                            <img src="../hasiera/img/produktua<?php echo $produktua->getId(); ?>.png" alt="" class="img">
                            
                            <h3 class="info-name"><?php echo htmlspecialchars($produktua->getMarka()); ?></h3>
                            
                            <p class="info-description"><?php echo htmlspecialchars($produktua->getModeloa()); ?></p>
                            
                            <div class="prezio-box">
                                <?php 
                                    $prezioa = $produktua->getPrezioa();
                                    $deskontua = $produktua->getDeskontua();
                                    
                                    if ($deskontua > 0) {
                                        $prezioFinal = $prezioa * (1 - ($deskontua / 100));
                                        // Precio original tachado
                                        echo "<h2 class='info-deskontua'>" . number_format($prezioa, 2) . "€</h2>";
                                        // Precio final con descuento
                                        echo "<h2 class='info-prezioa'>" . number_format($prezioFinal, 2) . "€</h2>";
                                    } else {
                                        // Precio normal
                                        echo "<h2 class='info-prezioa'>" . number_format($prezioa, 2) . "€</h2>";
                                    }
                                ?>
                            </div>
                            
                            <a href="index.php?id_produktua=<?php echo $produktua->getId(); ?>" class="info-link">Ikusi Produktua</a>
                        </div>
                    </article>
                <?php endforeach; ?>

            </nav>

            <p id="sin-resultados" style="display:none; text-align:center; margin-top:20px; font-size:1.2em;">Ez da produkturik aurkitu bilaketa honekin.</p>

        <?php else: ?>
            <p style="text-align: center; margin-top: 50px;">Ez dago produkturik kategoria honetan.</p>
        <?php endif; ?>

    </main>

    <script>
        $(document).ready(function() {
            // Detectar cuando se escribe en el input
            $('#buscador-categoria').on('keyup', function() {
                var valor = $(this).val().toLowerCase();
                var contador = 0;

                // Recorrer cada tarjeta de producto
                $('.producto-card').each(function() {
                    // Cogemos todo el texto de la tarjeta (marca, modelo, precio...)
                    var textoTarjeta = $(this).text().toLowerCase();

                    // Si el texto de la tarjeta incluye lo que hemos escrito...
                    if (textoTarjeta.indexOf(valor) > -1) {
                        $(this).show(); // Mostrar
                        contador++;
                    } else {
                        $(this).hide(); // Ocultar
                    }
                });

                // Si se han ocultado todos, mostramos mensaje de aviso
                if (contador === 0) {
                    $('#sin-resultados').show();
                } else {
                    $('#sin-resultados').hide();
                }
            });
        });
    </script>
</body>
</html>