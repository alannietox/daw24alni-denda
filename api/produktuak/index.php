<?php
header('Content-Type: application/json');

try {
    // Conexión a la base de datos
    $db = new PDO("sqlite:C:/xampp/htdocs/0erronka/produktuak.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $method = $_SERVER['REQUEST_METHOD'];
    $id = isset($_GET['id']) ? (int)$_GET['id'] : null;
    $mota = isset($_GET['mota']) ? $_GET['mota'] : null;

    // GET: obtener uno o todos
    if ($method === 'GET') {
        if ($id) {
            $stmt = $db->prepare("SELECT * FROM produktuak WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $produktua = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($produktua) {
                echo json_encode($produktua, JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'No encontrado']);
            }
        } else {
            $sql = "SELECT * FROM produktuak";
            $params = [];

            if ($mota === 'nobedadeak') {
                $sql .= " WHERE nobedadea = 1";
            } elseif ($mota === 'deskontuak') {
                $sql .= " WHERE deskontua > 0";
            }
            
            $sql .= " ORDER BY id";

            $stmt = $db->prepare($sql);
            $stmt->execute($params);

            $produktuak = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($produktuak, JSON_UNESCAPED_UNICODE);
        }

    // POST: crear nuevo
    } elseif ($method === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['marka'], $data['modeloa'], $data['gama'], $data['id_kategoria'], $data['prezioa'], $data['nobedadea'], $data['deskontua'])) {
            $stmt = $db->prepare("INSERT INTO produktuak (marka, modeloa, gama) VALUES (:marka, :modeloa, :gama, :id_kategoria, :prezioa, :nobedadea, :deskontua)");
            $stmt->execute([
                ':marka' => $data['marka'],
                ':modeloa' => $data['modeloa'],
                ':gama' => $data['gama'],
                ':id_kategoria' => $data['id_kategoria'],
                ':prezioa' => $data['prezioa'],
                ':nobedadea' => $data['nobedadea'],
                ':deskontua' => $data['deskontua']
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
        if (isset($data['marka'],  $data['modeloa'], $data['gama'], $data['id_kategoria'], $data['prezioa'], $data['nobedadea'], $data['deskontua'])) {
            $stmt = $db->prepare("UPDATE produktuak SET marka=:marka,  modeloa=:modeloa, gama=:gama, id_kategoria=:id_kategoria, prezioa=:prezioa, nobedadea=:nobedadea, deskontua=:deskontua WHERE id=:id");
            $stmt->execute([
                ':marka' => $data['marka'],
                ':modeloa' => $data['modeloa'],
                ':gama' => $data['gama'],
                ':id_kategoria' => $data['id_kategoria'],
                ':prezioa' => $data['prezioa'],
                ':nobedadea' => $data['nobedadea'],
                ':deskontua' => $data['deskontua'],
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

        $stmt = $db->prepare("DELETE FROM produktuak WHERE id=:id");
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
