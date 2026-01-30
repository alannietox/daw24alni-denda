<?php
namespace com\leartik\alni\kategoriak;

use PDO;
// Nota: La clase Kategoria debe estar en este mismo namespace, lo cual ya se cumple arriba.

class KategoriaDB
{
    /**
     * Define la ruta de la base de datos SQLite.
     * ADVERTENCIA: Debes cambiar esta ruta.
     */
    private static function getDbPath() {
        // Usamos una ruta de ejemplo para la base de datos
        return "sqlite:C:\\xampp\\htdocs\\0erronka\\produktuak.db"; 
    }

    /**
     * Retrieves all "kategoriak" (categories) from the database.
     */
    public static function selectKategoriak()
    {
        try {
            $db = new PDO(self::getDbPath());
            $erregistroak = $db->query("SELECT * FROM kategoriak");
            $kategoriak = array();

            while ($erregistroa = $erregistroak->fetch(PDO::FETCH_ASSOC)) {
                $kategoria = new Kategoria();
                $kategoria->setId($erregistroa['id_kategoria']);
                $kategoria->setIzena($erregistroa['izena']);
                $kategoria->setLaburpena($erregistroa['laburpena']);
                $kategoria->setSortzeData($erregistroa['sortze_data']);
                $kategoriak[] = $kategoria;
            }

            return $kategoriak;

        } catch (\Exception $e) {
            echo "<p>Salbuspena (SelectKategoriak): " . $e->getMessage() . "</p>\n";
            return null;
        }
    }
    
    /**
     * Retrieves a single "kategoria" (category) by its ID.
     */
    public static function selectKategoria($id)
    {
        try {
            $db = new PDO(self::getDbPath());
            
            $stmt = $db->prepare("SELECT * FROM kategoriak WHERE id_kategoria = ?");
            $stmt->execute([$id]); 

            if ($erregistroa = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $kategoria = new Kategoria();
                $kategoria->setId($erregistroa['id_kategoria']);
                $kategoria->setIzena($erregistroa['izena']);
                $kategoria->setLaburpena($erregistroa['laburpena']);
                $kategoria->setSortzeData($erregistroa['sortze_data']);
                return $kategoria;
            }

            return null;

        } catch (\Exception $e) {
            echo "<p>Salbuspena (SelectKategoria): " . $e->getMessage() . "</p>\n";
            return null;
        }
    }

    /**
     * Inserts a new "kategoria" (category) into the database.
     */
    public static function insertKategoria($kategoria)
    {
        try {
            $db = new PDO(self::getDbPath());

            $sql = "INSERT INTO kategoriak (izena, laburpena) VALUES (?, ?)";
            
            $stmt = $db->prepare($sql);
            
            $emaitza = $stmt->execute([
                $kategoria->getIzena(),
                $kategoria->getLaburpena()
            ]);

            return $emaitza ? $stmt->rowCount() : 0; 

        } catch (\Exception $e) {
            echo "<p>Salbuspena (InsertKategoria): " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }
    
    /**
     * Updates an existing "kategoria" (category) in the database.
     */
    public static function updateKategoria($kategoria)
    {
        try {
            $db = new PDO(self::getDbPath());

            $sql = "UPDATE kategoriak SET izena = ?, laburpena = ? WHERE id_kategoria = ?";

            $stmt = $db->prepare($sql);
            
            $emaitza = $stmt->execute([
                $kategoria->getIzena(),
                $kategoria->getLaburpena(),
                $kategoria->getId() 
            ]);

            return $emaitza ? $stmt->rowCount() : 0;

        } catch (\Exception $e) {
            echo "<p>Salbuspena (UpdateKategoria): " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }

    /**
     * Deletes a "kategoria" (category) from the database by its ID.
     */
    public static function deleteKategoria($id)
    {
        try {
            $db = new PDO(self::getDbPath());

            $sql = "DELETE FROM kategoriak WHERE id_kategoria = ?";
            
            $stmt = $db->prepare($sql);
            $emaitza = $stmt->execute([$id]);

            return $emaitza ? $stmt->rowCount() : 0;

        } catch (\Exception $e) {
            echo "<p>Salbuspena (DeleteKategoria): " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }
}
?>