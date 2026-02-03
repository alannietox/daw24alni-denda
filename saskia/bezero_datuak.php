<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bezeroaren Datuak - PcZone</title>
    <link rel="stylesheet" href="../hasiera/style.css">
    <link rel="stylesheet" href="saskia_erakutsi.css">
    
    <style>
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; margin-bottom: 8px; font-weight: bold; color: #333; }
        .form-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box; /* Para que el padding no rompa el ancho */
            font-family: Arial, sans-serif;
        }
        .form-input:focus {
            border-color: #007bff;
            outline: none;
        }
    </style>
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
        <h1 style="margin-bottom: 20px;">Datuak Bete</h1>
        <hr>

        <div class="info-grid saskia-grid">
            
            <article class="info-card saskia-card">
                <h3 class="info-name" style="border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 20px;">
                    Bidalketa Informazioa
                </h3>
                
                <p class="info-description" style="margin-bottom: 25px;">
                    Erosketa amaitzeko, mesedez bete zure datuak.
                </p>
                
                <form action="index.php" method="POST">
                    <input type="hidden" name="action" value="confirm">

                    <div class="form-group">
                        <label for="izena" class="form-label">Izena:</label>
                        <input type="text" class="form-input" id="izena" name="izena" placeholder="Zure izena" required>
                    </div>

                    <div class="form-group">
                        <label for="abizena" class="form-label">Abizena:</label>
                        <input type="text" class="form-input" id="abizena" name="abizena" placeholder="Zure abizena" required>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Emaila:</label>
                        <input type="email" class="form-input" id="email" name="email" placeholder="adibidea@email.com" required>
                    </div>

                    <div class="form-group">
                        <label for="helbidea" class="form-label">Helbidea:</label>
                        <input type="text" class="form-input" id="helbidea" name="helbidea" placeholder="Kalea, Zenbakia, Herria..." required>
                    </div>

                    <div class="form-group">
                        <label for="herria" class="form-label">Herria:</label>
                        <input type="text" class="form-input" id="herria" name="herria" placeholder="Herria..." required>
                    </div>

                    <div class="form-group">
                        <label for="postakodea" class="form-label">Postakodea:</label>
                        <input type="text" class="form-input" id="postakodea" name="postakodea" placeholder="Postakodea..." required>
                    </div>

                    <div class="form-group">
                        <label for="probintzia" class="form-label">Probintzia:</label>
                        <input type="text" class="form-input" id="probintzia" name="probintzia" placeholder="Probintzia..." required>
                    </div>

                    <div class="saskia-actions" style="margin-top: 30px; border-top: 1px solid #eee; padding-top: 20px; border-bottom: none;">
                        <a href="index.php" class="info-link" style="font-size: 16px;">Atzera Saskira</a>
                        <button type="submit" class="btn-contact btn-green" style="border: none; cursor: pointer;">
                            BERRETSI EROSKETA
                        </button>
                    </div>
                </form>
            </article>
        </div>
    </main>

</body>
</html>