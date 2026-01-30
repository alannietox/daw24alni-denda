<?php
namespace com\leartik\alni\mezuak;

use PDO;

class MezuaDB
{
    private static function getDbPath()
    {
        return "sqlite:C:\\xampp\\htdocs\\0erronka\\produktuak.db";
    }

    public static function selectMezuak()
    {
        try {
            $db = new PDO(self::getDbPath());
            $stmt = $db->query("SELECT * FROM mezuak");
            $mezuak = [];

            while ($erregistroa = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $mezua = new Mezua();
                $mezua->setId($erregistroa['id']);
                $mezua->setIzena($erregistroa['izena']);
                $mezua->setAbizena($erregistroa['abizena']);
                $mezua->setEmail($erregistroa['email']);
                $mezua->setGorputza($erregistroa['gorputza']);
                $mezua->setErantzuna($erregistroa['erantzuna']);
                $mezua->setSortzeData($erregistroa['sortze_data']);
                $mezuak[] = $mezua;
            }

            return $mezuak;

        } catch (\Exception $e) {
            echo "<p>Salbuspena (SelectMezuak): " . $e->getMessage() . "</p>\n";
            return null;
        }
    }

    /**
     * Obtiene un mensaje por ID.
     */
    public static function selectMezua($id)
    {
        try {
            $db = new PDO(self::getDbPath());

            $stmt = $db->prepare("SELECT * FROM mezuak WHERE id = ?");
            $stmt->execute([$id]);

            if ($erregistroa = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $mezua = new Mezua();
                $mezua->setId($erregistroa['id']);
                $mezua->setIzena($erregistroa['izena']);
                $mezua->setAbizena($erregistroa['abizena']);
                $mezua->setEmail($erregistroa['email']);
                $mezua->setGorputza($erregistroa['gorputza']);
                $mezua->setErantzuna($erregistroa['erantzuna']);
                $mezua->setSortzeData($erregistroa['sortze_data']);
                return $mezua;
            }

            return null;

        } catch (\Exception $e) {
            echo "<p>Salbuspena (SelectMezua): " . $e->getMessage() . "</p>\n";
            return null;
        }
    }

    /**
     * Inserta un nuevo mensaje.
     */
    public static function insertMezua($mezua)
    {
        try {
            $db = new PDO(self::getDbPath());

            $sql = "INSERT INTO mezuak (izena, abizena, email, gorputza, erantzuna)
                    VALUES (?, ?, ?, ?, ?)";

            $stmt = $db->prepare($sql);

            $emaitza = $stmt->execute([
                $mezua->getIzena(),
                $mezua->getAbizena(),
                $mezua->getEmail(),
                $mezua->getGorputza(),
                $mezua->getErantzuna()
            ]);

            return $emaitza ? $stmt->rowCount() : 0;

        } catch (\Exception $e) {
            echo "<p>Salbuspena (InsertMezua): " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }

    /**
     * Actualiza un mensaje existente.
     */
    public static function updateMezua($mezua)
    {
        try {
            $db = new PDO(self::getDbPath());

            $sql = "UPDATE mezuak
                    SET izena = ?, abizena = ?, email = ?, gorputza = ?, erantzuna = ?
                    WHERE id = ?";

            $stmt = $db->prepare($sql);

            $emaitza = $stmt->execute([
                $mezua->getIzena(),
                $mezua->getAbizena(),
                $mezua->getEmail(),
                $mezua->getGorputza(),
                $mezua->getErantzuna(),
                $mezua->getId()
            ]);

            return $emaitza ? $stmt->rowCount() : 0;

        } catch (\Exception $e) {
            echo "<p>Salbuspena (UpdateMezua): " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }

    /**
     * Borra un mensaje por ID.
     */
    public static function deleteMezua($id)
    {
        try {
            $db = new PDO(self::getDbPath());

            $stmt = $db->prepare("DELETE FROM mezuak WHERE id = ?");
            $emaitza = $stmt->execute([$id]);

            return $emaitza ? $stmt->rowCount() : 0;

        } catch (\Exception $e) {
            echo "<p>Salbuspena (DeleteMezua): " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }
}
?>
