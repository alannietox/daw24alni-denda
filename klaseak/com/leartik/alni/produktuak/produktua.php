<?php
namespace com\leartik\alni\produktuak;

class Produktua
{
    private $id;
    private $marka;
    private $modeloa;
    private $gama;
    private $prezioa;
    private $id_kategoriak;
    private $nobedadea;
    private $deskontua;

    // Métodos Getter
    public function getId() {
        return $this->id;
    }

    public function getMarka() {
        return $this->marka;
    }

    public function getModeloa() {
        return $this->modeloa;
    }

    public function getGama() {
        return $this->gama;
    }

    public function getPrezioa() {
        return $this->prezioa;
    }

    public function getIdKategoriak() {
        return $this->id_kategoriak;
    }
    public function setNobedadea($nobedadea) {
        $this->nobedadea = $nobedadea;
    }

    public function setDeskontua($deskontua) {
        $this->deskontua = $deskontua;
    }

    // Métodos Setter
    public function setId($id) {
        $this->id = $id;
    }

    public function setMarka($marka) {
        $this->marka = $marka;
    }

    public function setModeloa($modeloa) {
        $this->modeloa = $modeloa;
    }

    public function setGama($gama) {
        $this->gama = $gama;
    }

    public function setPrezioa($prezioa) {
        $this->prezioa = $prezioa;
    }

    public function setIdKategoriak($id_kategoriak) {
        $this->id_kategoriak = $id_kategoriak;
    }
    public function getNobedadea() {
        return $this->nobedadea;
    }
    public function getDeskontua() {
        return $this->deskontua;
    }
}
?>