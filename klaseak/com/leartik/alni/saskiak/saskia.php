<?php

namespace com\leartik\alni\saskiak;

class Saskia
{
    private $detaileak;

    public function __construct()
    {
        $this->detaileak = array();
    }

    public function setDetaileak($detaileak)
    {
        $this->detaileak = $detaileak;
    }

    public function getDetaileak()
    {
        return $this->detaileak;
    }

    public function detaileaGehitu($detailea)
    {
        $this->detaileak[] = $detailea;
    }
}

?>
