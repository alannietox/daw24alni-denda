<?php
namespace com\leartik\alni\eskariak;

class Eskaria
{
    private $id;
    private $data;
    private $bezeroa;
    private $detaileak;

    public function __construct($id = 0, $data = null, $bezeroa = [], $detaileak = []) {
        $this->id = $id;
        $this->data = $data;
        $this->bezeroa = $bezeroa;
        $this->detaileak = $detaileak;
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
}
?>