<?php
namespace com\leartik\alni\bezeroak;

class Bezeroa
{
    // Propietate pribatuak (Private properties)
    private $id;
    private $izena;
    private $abizena;
    private $helbidea;
    private $herria;
    private $postakodea;
    private $probintzia;
    private $emaila;

    public function __construct($id=0, $izena="", $abizena="", $helbidea="", $herria="", $postakodea="", $probintzia="", $emaila="")
    {
        $this->id = $id;
        $this->izena = $izena;
        $this->abizena = $abizena;
        $this->helbidea = $helbidea;
        $this->herria = $herria;
        $this->postakodea = $postakodea;
        $this->probintzia = $probintzia;
        $this->emaila = $emaila;
    }

    // --- GETTERS ---

    public function getId() {
        return $this->id;
    }

    public function getIzena() {
        return $this->izena;
    }

    public function getAbizena() {
        return $this->abizena;
    }

    public function getHelbidea() {
        return $this->helbidea;
    }

    public function getHerria() {
        return $this->herria;
    }

    public function getPostakodea() {
        return $this->postakodea;
    }

    public function getProbintzia() {
        return $this->probintzia;
    }

    public function getEmaila() {
        return $this->emaila;
    }

    // --- SETTERS ---

    public function setId($id) {
        $this->id = $id;
    }

    public function setIzena($izena) {
        $this->izena = $izena;
    }

    public function setAbizena($abizena) {
        $this->abizena = $abizena;
    }

    public function setHelbidea($helbidea) {
        $this->helbidea = $helbidea;
    }

    public function setHerria($herria) {
        $this->herria = $herria;
    }

    public function setPostakodea($postakodea) {
        $this->postakodea = $postakodea;
    }

    public function setProbintzia($probintzia) {
        $this->probintzia = $probintzia;
    }

    public function setEmaila($emaila) {
        $this->emaila = $emaila;
    }
}
?>