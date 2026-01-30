<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontaktua - PcZone</title>
    <link rel="stylesheet" href="./kontaktua.css">
</head>

<body>
    <header class="navbar">
        <div class="nav-left">
            <a href="../hasiera/index.php" class="btn-contact">Hasiera</a>
        </div>
        <div class="nav-right">
            <a href="../hasiera/index.php" aria-label="Hasiera">🏠</a>
            <a href="#" aria-label="Erabiltzailearen Profila">👤</a>
        </div>
    </header>

    <main>
        <article class="main-header">
            <h1>Kontaktua</h1>
        </article>
        
        <hr>

        <div class="contact-container">
            
            <div class="contact-info-box">
                <h2>Harremanetarako Informazioa</h2>
                <p>Zalantzarik baduzu edo laguntza behar baduzu, jarri gurekin harremanetan.</p>
                
                <div class="contact-details">
                    <p><strong>Helbidea:</strong><br>Kale Nagusia 12, 48001 Bilbo, Bizkaia</p>
                    <p><strong>Emaila:</strong><br>info@pczone.eus</p>
                    <p><strong>Telefonoa:</strong><br>+34 944 123 456</p>
                    <p><strong>Ordutegia:</strong><br>Astelehenetik - Ostiralera: 09:00 - 20:00 <br> Zapatuetan: 10:00 - 14:00</p>
                </div>
            </div>

            <div class="contact-form-box">
                <h2>Bidali Mezu Bat</h2>
                <form method="post" action="index.php">
                    <div class="form-group">
                        <label for="izena">Izena</label>
                        <input type="text" id="izena" name="izena" placeholder="Zure izena" value="<?php echo $izena ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="abizena">Abizena</label>
                        <input type="text" id="abizena" name="abizena" placeholder="Zure abizena" value="<?php echo $abizena ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="emaila">Email</label>
                        <input type="email" id="emaila" name="email" placeholder="adibidea@email.com" value="<?php echo $email ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="mezua">Mezua</label>
                        <textarea id="mezua" name="gorputza" rows="5" placeholder="Idatzi zure mezua hemen..." value="<?php echo $gorputza ?>" required></textarea>
                    </div>

                    <button type="submit" class="btn-submit" value="Bilai" name="biali">Bidali</button>
                </form>
            </div>
        </div>

    </main>
</body>

</html>