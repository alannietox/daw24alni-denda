<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Negozio Txatbota</title>
    <style>
        /* --- ESTILOS GENERALES (Tu CSS Original) --- */
        html, body {
            height: 100%;
            min-height: 100%;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background-color: #fff; /* Asegurar fondo blanco */
            border-bottom: 1px solid #eee;
        }

        .btn-contact {
            background-color: #007bff;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }
        .btn-contact:active, .btn-submit:active {
            background-color: #0056b3;
        }
        .nav-right a {
            color: #333;
            text-decoration: none;
            font-size: 20px;
            margin-left: 15px;
        }

        .main-header {
            padding-block: 8%;
            width: 100%; /* Un poco de margen lateral */
            background-image: url('../hasiera/img/fondo.jpg'); /* Asegúrate que la ruta sea correcta */
            background-color: #333; /* Color de respaldo si no carga la imagen */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 10px;
        }

        .main-header h1 {
            text-align: center;
            font-size: 50px;
            color: white;
            margin: 0;
            text-shadow:
                -1px -1px 0 #000,
                 1px -1px 0 #000,
                -1px 1px 0 #000,
                 1px 1px 0 #000;
        }

        h1.section-title {
            text-align: center;
            font-size: 36px;
            color: #333;
            margin-top: 40px;
            margin-bottom: 20px;
        }

        /* --- ESTILOS ESPECÍFICOS PARA EL CHAT --- */
        
        .chat-container {
            max-width: 800px;
            margin: 0 auto 50px;
            padding: 0 20px;
        }

        /* Usamos el estilo .info-card para el contenedor del chat */
        .chat-card {
            background-color: #f9f9f9;
            border: 1px solid #eee;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        #txataren-mezuak {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 20px;
            height: 300px;
            overflow-y: auto;
            margin-bottom: 10px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        #txataren-mezuak p {
            margin: 0;
            padding: 10px;
            border-radius: 5px;
            max-width: 80%;
        }

        /* Estilo para distinguir mensajes (opcional, JS no añade clases actualmente pero el CSS queda preparado) */
        #txataren-mezuak p:nth-child(odd) { /* Usuario */
            background-color: #e3f2fd;
            align-self: flex-end;
        }
        #txataren-mezuak p:nth-child(even) { /* Bot */
            background-color: #f1f1f1;
            align-self: flex-start;
        }

        .input-area {
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }

        textarea {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
            min-height: 50px;
            font-family: inherit;
        }

        /* Botón de enviar con el mismo estilo que .btn-contact */
        .btn-submit {
            background-color: #007bff;
            color: white;
            padding: 10px 25px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            height: 100%;
        }
        
        .error-message {
            color: red;
            text-align: center;
        }

        .status-message {
            text-align: center;
            color: #666;
            margin-bottom: 10px;
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
            <a href="#" aria-label="Perfil">👤</a>
        </div>
    </header>

    <main>
        <article class="main-header">
            <h1>ChatBot</h1>
        </article>

        <h1 class="section-title">Nola lagundu ahal dizut?</h1>

        <div class="chat-container">
            <?php if (!empty($hasierako_mezua)): ?>
                <p class="status-message"><?= $hasierako_mezua ?></p>
            <?php endif; ?>
            <?php if (!empty($erroreak['erabiltzailearen_mezua'])): ?>
                <p class="error-message"><?= $erroreak['erabiltzailearen_mezua'] ?></p>
            <?php endif; ?>

            <div class="chat-card">
                
                <div id="txataren-mezuak">
                    <?php 
                    // Mostrar historial existente si lo hay
                    if (isset($_SESSION['txataren_mezuak'])) {
                        foreach ($_SESSION['txataren_mezuak'] as $msg) {
                            // Filtramos mensajes de sistema para no mostrarlos
                            if ($msg['role'] != 'system') {
                                echo "<p>" . htmlspecialchars($msg['content']) . "</p>";
                            }
                        }
                    }
                    ?>
                </div>

                <form action="" method="post" onsubmit="event.preventDefault(); mezuaBidali();">
                    <div class="input-area">
                        <textarea id="erabiltzailearen-mezua" placeholder="Idatzi zure galdera hemen..."></textarea>
                        <input type="button" class="btn-submit" id="bidali" value="Bidali" onClick="mezuaBidali()">
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Función para hacer scroll automático al fondo del chat
        function scrollAlFondo() {
            var chatDiv = document.getElementById('txataren-mezuak');
            chatDiv.scrollTop = chatDiv.scrollHeight;
        }

        // Ejecutar scroll al cargar
        window.onload = scrollAlFondo;

        function mezuaBidali() {
            var inputCampo = document.getElementById('erabiltzailearen-mezua');
            var mezua = inputCampo.value;

            if (mezua.trim() == "") {
                alert("Mezuaren testua falta da");
                return;
            }

            var mezuakDiv = document.getElementById('txataren-mezuak');
            
            // Añadir mensaje del usuario visualmente
            var erabiltzaileaP = document.createElement('p');
            erabiltzaileaP.innerHTML = mezua; // Nota: Usar innerText es más seguro para prevenir XSS
            erabiltzaileaP.style.backgroundColor = "#e3f2fd"; // Estilo inline para inmediatez (Usuario)
            erabiltzaileaP.style.alignSelf = "flex-end";
            mezuakDiv.appendChild(erabiltzaileaP);
            
            // Limpiar input y scroll
            inputCampo.value = '';
            scrollAlFondo();

            var httpRequest = new XMLHttpRequest();
            httpRequest.open("POST", "index.php", true);
            httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            httpRequest.send("erabiltzailearen_mezua=" + encodeURIComponent(mezua));
            
            httpRequest.onreadystatechange = function() {
                if (this.readyState == 4) {
                    if (this.status == 200) {
                        var botP = document.createElement('p');
                        botP.innerHTML = this.responseText;
                        botP.style.backgroundColor = "#f1f1f1"; // Estilo inline para inmediatez (Bot)
                        botP.style.alignSelf = "flex-start";
                        mezuakDiv.appendChild(botP);
                        scrollAlFondo();
                    } else {
                        alert("Errorea komunikazioan: " + this.statusText);
                    }
                }
            };
        }
        
        // Permitir enviar con Enter
        document.getElementById('erabiltzailearen-mezua').addEventListener('keypress', function (e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                mezuaBidali();
            }
        });
    </script>
</body>
</html>