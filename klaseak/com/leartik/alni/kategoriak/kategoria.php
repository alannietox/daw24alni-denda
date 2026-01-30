<?php
namespace com\leartik\alni\kategoriak;

class Kategoria
{
    private $id;
    private $izena;
    private $laburpena;
    private $sortze_data;

    // Métodos Getter
    public function getId() {
        return $this->id;
    }

    public function getIzena() {
        return $this->izena;
    }

    public function getLaburpena() {
        return $this->laburpena;
    }

    public function getSortzeData() {
        return $this->sortze_data;
    }

    // Métodos Setter
    public function setId($id) {
        $this->id = $id;
    }

    public function setIzena($izena) {
        $this->izena = $izena;
    }

    public function setLaburpena($laburpena) {
        $this->laburpena = $laburpena;
    }

    public function setSortzeData($sortze_data) {
        $this->sortze_data = $sortze_data;
    }
}
?>