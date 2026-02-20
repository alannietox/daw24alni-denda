<?php
header('Content-Type: application/json');

try {
    // Conexión a la base de datos
    $db = new PDO("sqlite:../../albisteak.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $method = $_SERVER['REQUEST_METHOD'];
    $id = isset($_GET['id']) ? (int)$_GET['id'] : null;

    // GET: obtener uno o todos
    if ($method === 'GET') {
        if ($id) {
            $stmt = $db->prepare("SELECT * FROM albisteak WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $albistea = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($albistea) {
                echo json_encode($albistea, JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'No encontrado']);
            }
        } else {
            $stmt = $db->query("SELECT * FROM albisteak ORDER BY id");
            $albisteak = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($albisteak, JSON_UNESCAPED_UNICODE);
        }

    // POST: crear nuevo
    } elseif ($method === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['izenburua'], $data['xehetasunak'], $data['laburpena'])) {
            $stmt = $db->prepare("INSERT INTO albisteak (izenburua, laburpena, xehetasunak) VALUES (:izenburua, :laburpena, :xehetasunak)");
            $stmt->execute([
                ':izenburua' => $data['izenburua'],
                ':laburpena' => $data['laburpena'],
                ':xehetasunak' => $data['xehetasunak']
            ]);
            echo json_encode(['success' => "Elemento creado", 'id' => $db->lastInsertId()]);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Datos incompletos']);
        }

    // PUT: actualizar
    } elseif ($method === 'PUT') {
        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'ID requerido']);
            exit;
        }

        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['izenburua'],  $data['laburpena'], $data['xehetasunak'])) {
            $stmt = $db->prepare("UPDATE albisteak SET izenburua=:izenburua,  laburpena=:laburpena, xehetasunak=:xehetasunak WHERE id=:id");
            $stmt->execute([
                ':izenburua' => $data['izenburua'],
                ':laburpena' => $data['laburpena'],
                ':xehetasunak' => $data['xehetasunak'],
                ':id' => $id
            ]);
            echo json_encode(['success' => "Elemento editado"]);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Datos incompletos']);
        }

    // DELETE: eliminar
    } elseif ($method === 'DELETE') {
        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'ID requerido']);
            exit;
        }

        $stmt = $db->prepare("DELETE FROM albisteak WHERE id=:id");
        $stmt->execute([':id' => $id]);
        echo json_encode(['success' => "Elemento eliminado"]);

    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
