<?php
namespace com\leartik\alni\eskariak;

use PDO;
use com\leartik\alni\eskariak\Eskaria;

class EskariaDB
{
    /**
     * Datu-basearen bidea definitzen du.
     */
    private static function getDbPath()
    {
        // Ziurtatu bidea zuzena dela zure ingurunerako
        return "sqlite:C:\\xampp\\htdocs\\0erronka\\produktuak.db";
    }

    /**
     * Eskari guztiak lortzen ditu.
     */
    public static function selectEskariak()
    {
        try {
            $db = new PDO(self::getDbPath());
            // Suposatzen dugu taula 'eskariak' deitzen dela
            $erregistroak = $db->query("SELECT * FROM eskariak");
            $eskariak = array();

            while ($erregistroa = $erregistroak->fetch(PDO::FETCH_ASSOC)) {
                $eskaria = new Eskaria();
                $eskaria->setId($erregistroa['id']);
                $eskaria->setData($erregistroa['data']);
                // Bezeroa objektu bat edo ID bat izan daiteke, hemen IDa esleitzen dugu DBtik
                $eskaria->setBezeroa($erregistroa['id_bezeroa']); 
                
                // OHARRA: Hemen 'detaileak' kargatu beharko lirateke beste kontsulta batekin
                // baldin eta eskariaren lerroak erakutsi nahi badira.
                
                $eskariak[] = $eskaria;
            }

            return $eskariak;

        } catch (\Exception $e) {
            echo "<p>Salbuspena (SelectEskariak): " . $e->getMessage() . "</p>\n";
            return null;
        }
    }

    /**
     * Eskari bat lortzen du IDaren bidez.
     */
    public static function selectEskaria($id)
    {
        try {
            $db = new PDO(self::getDbPath());
            
            $stmt = $db->prepare("SELECT * FROM eskariak WHERE id = ?");
            $stmt->execute([$id]); 

            if ($erregistroa = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $eskaria = new Eskaria();
                $eskaria->setId($erregistroa['id']);
                $eskaria->setData($erregistroa['data']);
                $eskaria->setBezeroa($erregistroa['id_bezeroa']);
                
                // Hemen ere 'detaileak' kargatzeko logika gehi daiteke
                
                return $eskaria;
            }

            return null;

        } catch (\Exception $e) {
            echo "<p>Salbuspena (SelectEskaria): " . $e->getMessage() . "</p>\n";
            return null;
        }
    }

    /**
     * Eskari berri bat txertatzen du datu-basean.
     */
    public static function insertEskaria($eskaria)
    {
        try {
            $db = new PDO(self::getDbPath());

            // Suposatzen dugu 'data' eta 'id_bezeroa' direla bete beharreko eremuak
            $sql = "INSERT INTO eskariak (data, id_bezeroa) VALUES (?, ?)";
            
            $stmt = $db->prepare($sql);
            
            // Bezeroaren IDa lortu behar dugu. Bezeroa objektua bada, ->getId() erabili beharko litzateke.
            // Hemen suposatzen dugu setBezeroa-rekin ID bat pasa zaiola edo balio zuzena dela.
            $emaitza = $stmt->execute([
                $eskaria->getData(),
                $eskaria->getBezeroa() 
            ]);

            return $emaitza ? $stmt->rowCount() : 0; 

        } catch (\Exception $e) {
            echo "<p>Salbuspena (InsertEskaria): " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }
    
    /**
     * Eskari bat eguneratzen du.
     */
    public static function updateEskaria($eskaria)
    {
        try {
            $db = new PDO(self::getDbPath());

            $sql = "UPDATE eskariak SET data = ?, id_bezeroa = ? WHERE id = ?";

            $stmt = $db->prepare($sql);
            
            $emaitza = $stmt->execute([
                $eskaria->getData(),
                $eskaria->getBezeroa(),
                $eskaria->getId() 
            ]);

            return $emaitza ? $stmt->rowCount() : 0;

        } catch (\Exception $e) {
            echo "<p>Salbuspena (UpdateEskaria): " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }

    /**
     * Eskari bat ezabatzen du IDaren bidez.
     */
    public static function deleteEskaria($id)
    {
        try {
            $db = new PDO(self::getDbPath());

            // Kontuz: Eskaria ezabatzean, normalean bere detaileak ere ezabatu behar dira
            // (Cascade delete edo eskuz).
            $sql = "DELETE FROM eskariak WHERE id = ?";
            
            $stmt = $db->prepare($sql);
            $emaitza = $stmt->execute([$id]);

            return $emaitza ? $stmt->rowCount() : 0;

        } catch (\Exception $e) {
            echo "<p>Salbuspena (DeleteEskaria): " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }
}