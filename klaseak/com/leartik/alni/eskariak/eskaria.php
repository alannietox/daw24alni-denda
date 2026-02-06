<?php
namespace com\leartik\alni\eskariak;
use com\leartik\alni\bezeroak\Bezeroa;
class Eskaria
{
    private $id;
    private $data;
    private $bezeroa;
    private $detaileak;
    private $egoera;

    public function __construct($id = 0, $data = null, $bezeroa = [], $detaileak = [], $egoera = 0) {
        $this->id = $id;
        $this->data = $data;
        $this->bezeroa = new Bezeroa();
        $this->detaileak = $detaileak;
        $this->egoera = $egoera;
    }
    // Métodos Getter
    public function getId() {
        return $this->id;
    }

    public function getData() {
        return $this->data;
    }

    public function getBezeroa() {
        return $this->bezeroa;
    }

    public function getDetaileak() {
        return $this->detaileak;
    }

    public function getEgoera() {
        return $this->egoera;
    }

    // Métodos Setter
    public function setId($id) {
        $this->id = $id;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function setBezeroa($bezeroa) {
        $this->bezeroa = $bezeroa;
    }

    public function setDetaileak($detaileak) {
        $this->detaileak = $detaileak;
    }
    public function setEgoera($egoera) {
        $this->egoera = $egoera;
    }
}
?>