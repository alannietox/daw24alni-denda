<?php

namespace com\leartik\alni\mezuak;

class Mezua
{
    private $id;
    private $izena;
    private $abizena;
    private $email;
    private $gorputza;
    private $erantzuna;
    private $sortzeData;

    // ID
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }

    // Izena
    public function setIzena($izena)
    {
        $this->izena = $izena;
    }
    public function getIzena()
    {
        return $this->izena;
    }
    // Abizena
    public function setAbizena($abizena)
    {
        $this->abizena = $abizena;
    }
    public function getAbizena()
    {
        return $this->abizena;
    }

    // Email
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }

    // Gorputza
    public function setGorputza($gorputza)
    {
        $this->gorputza = $gorputza;
    }
    public function getGorputza()
    {
        return $this->gorputza;
    }

    // Erantzuna (0 / 1)
    public function setErantzuna($erantzuna)
    {
        $this->erantzuna = $erantzuna;
    }
    public function getErantzuna()
    {
        return $this->erantzuna;
    }

    // Sortze data
    public function setSortzeData($sortzeData)
    {
        $this->sortzeData = $sortzeData;
    }
    public function getSortzeData()
    {
        return $this->sortzeData;
    }
}

