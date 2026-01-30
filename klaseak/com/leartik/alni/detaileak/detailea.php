<?php
namespace com\leartik\alni\detaileak;

class Detailea
{
    private $produktua;
    private $kopurua;
    private $prezioa;

    public function __construct($produktua = null, $kopurua = 0, $prezioa = 0) {
        $this->produktua = $produktua;
        $this->kopurua = $kopurua;
        $this->prezioa = $prezioa;

        if ($this->prezioa == 0 && $this->produktua != null) {
            $this->prezioa = $this->produktua->getPrezioa();
        }
    }
    // Métodos Getter
    public function getProduktua() {
        return $this->produktua;
    }

    public function getKopurua() {
        return $this->kopurua;
    }

    public function getPrezioa() {
        return $this->prezioa;
    }

    // Métodos Setter
    public function setProduktua($produktua) {
        $this->produktua = $produktua;
    }

    public function setKopurua($kopurua) {
        $this->kopurua = $kopurua;
    }

    public function setPrezioa($prezioa) {
        $this->prezioa = $prezioa;
    }
}
?>