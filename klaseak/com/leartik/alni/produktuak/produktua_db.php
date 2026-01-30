<?php

namespace com\leartik\alni\produktuak;

use PDO;
// Importamos la clase modelo Producto
// use com\leartik\alni\produktuak\Produktua; 

/**
 * ProduktuakDB
 * Clase de Acceso a Datos (DAO) estática para la tabla 'produktuak'.
 */
class ProduktuaDB
{
    /**
     * Define la ruta de la base de datos SQLite.
     * ADVERTENCIA: Debes cambiar esta ruta a la ubicación de tu archivo DB.
     */
    private static function getDbPath()
    {
        // Asegúrate de que esta ruta sea correcta para tu base de datos
        return "sqlite:C:\\xampp\\htdocs\\0erronka\\produktuak.db";
    }

    /**
     * Retorna todos los productos de la base de datos.
     * @return Produktua[] | null Array de objetos Produktua o null en caso de error.
     */
    public static function selectProduktuak()
    {
        try {
            $db = new PDO(self::getDbPath());
            $erregistroak = $db->query("SELECT * FROM produktuak");
            $produktuak = array();

            while ($erregistroa = $erregistroak->fetch(PDO::FETCH_ASSOC)) {
                $produktua = new Produktua();
                $produktua->setId($erregistroa['id']);
                $produktua->setMarka($erregistroa['marka']);
                $produktua->setModeloa($erregistroa['modeloa']);
                $produktua->setGama($erregistroa['gama']);
                $produktua->setPrezioa($erregistroa['prezioa']);
                $produktua->setIdKategoriak($erregistroa['id_kategoria']);
                $produktua->setNobedadea($erregistroa['nobedadea']);
                $produktua->setDeskontua($erregistroa['deskontua']);
                $produktuak[] = $produktua;
            }

            return $produktuak;
        } catch (\Exception $e) {
            echo "<p>Salbuspena (SelectAll): " . $e->getMessage() . "</p>\n";
            return null;
        }
    }

    /**
     * Retorna un producto por su ID.
     * @param int $id El ID del producto.
     * @return Produktua | null Objeto Produktua o null si no se encuentra o hay error.
     */
    public static function selectProduktua($id)
    {
        try {
            $db = new PDO(self::getDbPath());

            $stmt = $db->prepare("SELECT * FROM produktuak WHERE id = ?");
            $stmt->execute([$id]);

            if ($erregistroa = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $produktua = new Produktua();
                $produktua->setId($erregistroa['id']);
                $produktua->setMarka($erregistroa['marka']);
                $produktua->setModeloa($erregistroa['modeloa']);
                $produktua->setGama($erregistroa['gama']);
                $produktua->setPrezioa($erregistroa['prezioa']);
                $produktua->setIdKategoriak($erregistroa['id_kategoria']);
                $produktua->setNobedadea($erregistroa['nobedadea']);
                $produktua->setDeskontua($erregistroa['deskontua']);
                return $produktua;
            }

            return null;
        } catch (\Exception $e) {
            echo "<p>Salbuspena (SelectOne): " . $e->getMessage() . "</p>\n";
            return null;
        }
    }

    /**
     * Inserta un nuevo producto en la base de datos.
     * @param Produktua $produktua Objeto Producto con los datos a insertar.
     * @return int Número de filas insertadas (1 o 0).
     */
    public static function insertProduktua($produktua)
    {
        try {
            $db = new PDO(self::getDbPath());

            $sql = "INSERT INTO produktuak (marka, modeloa, gama, prezioa, id_kategoria, nobedadea, deskontua) VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = $db->prepare($sql);

            $emaitza = $stmt->execute([
                $produktua->getMarka(),
                $produktua->getModeloa(),
                $produktua->getGama(),
                $produktua->getPrezioa(),
                $produktua->getIdKategoriak(),
                $produktua->getNobedadea(),
                $produktua->getDeskontua()
            ]);

            return $emaitza ? $stmt->rowCount() : 0;
        } catch (\Exception $e) {
            echo "<p>Salbuspena (Insert): " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }

    /**
     * Actualiza un producto existente en la base de datos.
     * @param Produktua $produktua Objeto Producto con los nuevos datos y el ID.
     * @return int Número de filas actualizadas (1 o 0).
     */
    public static function updateProduktua($produktua)
    {
        try {
            $db = new PDO(self::getDbPath());

            $sql = "UPDATE produktuak SET marka = ?, modeloa = ?, gama = ?, prezioa = ?, id_kategoria = ?, nobedadea = ?, deskontua = ? WHERE id = ?";

            $stmt = $db->prepare($sql);

            $emaitza = $stmt->execute([
                $produktua->getMarka(),
                $produktua->getModeloa(),
                $produktua->getGama(),
                $produktua->getPrezioa(),
                $produktua->getIdKategoriak(),
                $produktua->getNobedadea(),
                $produktua->getDeskontua(),
                $produktua->getId() // El ID va al final para el WHERE
            ]);

            return $emaitza ? $stmt->rowCount() : 0;
        } catch (\Exception $e) {
            echo "<p>Salbuspena (Update): " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }

    /**
     * Elimina un producto de la base de datos por su ID.
     * @param int $id El ID del producto a eliminar.
     * @return int Número de filas eliminadas (1 o 0).
     */
    public static function deleteProduktua($id)
    {
        try {
            $db = new PDO(self::getDbPath());

            $sql = "DELETE FROM produktuak WHERE id = ?";

            $stmt = $db->prepare($sql);
            $emaitza = $stmt->execute([$id]);

            return $emaitza ? $stmt->rowCount() : 0;
        } catch (\Exception $e) {
            echo "<p>Salbuspena (Delete): " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }
    public static function selectProduktuakNobedadea()
    {
        try {
            $db = new PDO(self::getDbPath());

            $erregistroak = $db->query("SELECT * FROM produktuak WHERE nobedadea > 0 LIMIT 3");
            $produktuak = array();

            while ($erregistroa = $erregistroak->fetch(PDO::FETCH_ASSOC)) {
                $produktua = new Produktua();
                $produktua->setId($erregistroa['id']);
                $produktua->setMarka($erregistroa['marka']);
                $produktua->setModeloa($erregistroa['modeloa']);
                $produktua->setGama($erregistroa['gama']);
                $produktua->setPrezioa($erregistroa['prezioa']);
                $produktua->setIdKategoriak($erregistroa['id_kategoria']);
                $produktua->setNobedadea($erregistroa['nobedadea'] ?? 0);
                $produktua->setDeskontua($erregistroa['deskontua'] ?? 0);

                $produktuak[] = $produktua;
            }

            return $produktuak;
        } catch (\Exception $e) {
            echo "<p>Salbuspena (Deskontuarekin): " . $e->getMessage() . "</p>\n";
            return null;
        }
    }
    public static function selectProduktuakDeskontua()
    {
        try {
            $db = new PDO(self::getDbPath());

            $erregistroak = $db->query("SELECT * FROM produktuak WHERE deskontua > 0 LIMIT 3");
            $produktuak = array();

            while ($erregistroa = $erregistroak->fetch(PDO::FETCH_ASSOC)) {
                $produktua = new Produktua();
                $produktua->setId($erregistroa['id']);
                $produktua->setMarka($erregistroa['marka']);
                $produktua->setModeloa($erregistroa['modeloa']);
                $produktua->setGama($erregistroa['gama']);
                $produktua->setPrezioa($erregistroa['prezioa']);
                $produktua->setIdKategoriak($erregistroa['id_kategoria']);
                $produktua->setNobedadea($erregistroa['nobedadea'] ?? 0);
                $produktua->setDeskontua($erregistroa['deskontua'] ?? 0);

                $produktuak[] = $produktua;
            }

            return $produktuak;
        } catch (\Exception $e) {
            echo "<p>Salbuspena (Deskontuarekin): " . $e->getMessage() . "</p>\n";
            return null;
        }
    }
    public static function selectProduktuakByKategoria($id_kategoria)
    {
        try {
            $db = new PDO(self::getDbPath());

            // Seleccionamos productos donde id_kategoriak coincida
            $stmt = $db->prepare("SELECT * FROM produktuak WHERE id_kategoria = ?");
            $stmt->execute([$id_kategoria]);
            
            $produktuak = array();

            while ($erregistroa = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $produktua = new Produktua();
                $produktua->setId($erregistroa['id']);
                $produktua->setMarka($erregistroa['marka']);
                $produktua->setModeloa($erregistroa['modeloa']);
                $produktua->setGama($erregistroa['gama']);
                $produktua->setPrezioa($erregistroa['prezioa']);
                $produktua->setIdKategoriak($erregistroa['id_kategoria']);
                $produktua->setNobedadea($erregistroa['nobedadea'] ?? 0);
                $produktua->setDeskontua($erregistroa['deskontua'] ?? 0);

                $produktuak[] = $produktua;
            }

            return $produktuak;
        } catch (\Exception $e) {
            echo "<p>Salbuspena (SelectByKategoria): " . $e->getMessage() . "</p>\n";
            return null;
        }
    }
}
?>