<?php

class ObjectPost {
    
    private $p1;
    private $p2;
    private $p3;
    private $p4;
    private $p5;
    private $p6;
    private $p7;
    private $p8;
    private $p9;
    private $p10;
    
    function __construct($p1 = "", $p2 = "", $p3 = "", $p4 = "", $p5 = "", $p6 = "", $p7 = "", $p8 = "", $p9 = "", $p10 = "") {
        $this->p1 = $p1;
        $this->p2 = $p2;
        $this->p3 = $p3;
        $this->p4 = $p4;
        $this->p5 = $p5;
        $this->p6 = $p6;
        $this->p7 = $p7;
        $this->p8 = $p8;
        $this->p9 = $p9;
        $this->p10 = $p10;
    }

    public function getP1() {
        $this->p1 = $_POST['p1'] ? $_POST['p1'] : $this->p1;
        return $this->p1;
    }

    public function setP1($p1 = null) {
        $this->p1 = $p1;
    }

    public function getP2() {
        $this->p2 = $_POST['p2'] ? $_POST['p2'] : $this->p2;
        return $this->p2;
    }

    public function setP2($p2 = null) {
        $this->p2 = $p2;
    }

    public function getP3() {
        $this->p3 = $_POST['p3'] ? $_POST['p3'] : $this->p3;
        return $this->p3;
    }

    public function setP3($p3 = null) {
        $this->p3 = $p3;
    }

    public function getP4() {
        $this->p4 = $_POST['p4'] ? $_POST['p4'] : $this->p4;
        return $this->p4;
    }

    public function setP4($p4 = null) {
        $this->p4 = $p4;
    }

    public function getP5() {
        $this->p5 = $_POST['p5'] ? $_POST['p5'] : $this->p5;
        return $this->p5;
    }

    public function setP5($p5 = null) {
        $this->p5 = $p5;
    }

    public function getP6() {
        $this->p6 = $_POST['p6'] ? $_POST['p6'] : $this->p6;
        return $this->p6;
    }

    public function setP6($p6 = null) {
        $this->p6 = $p6;
    }

    public function getP7() {
        $this->p7= $_POST['p7'] ? $_POST['p7'] : $this->p7;
        return $this->p7;
    }

    public function setP7($p7 = null) {
        $this->p7 = $p7;
    }

    public function getP8() {
        $this->p8 = $_POST['p8'] ? $_POST['p8'] : $this->p8;
        return $this->p8;
    }

    public function setP8($p8 = null) {
        $this->p8 = $p8;
    }

    public function getP9() {
        $this->p9 = $_POST['p9'] ? $_POST['p9'] : $this->p9;
        return $this->p9;
    }

    public function setP9($p9 = null) {
        $this->p9 = $p9;
    }

    public function getP10() {
        $this->p10 = $_POST['p10'] ? $_POST['p10'] : $this->p10;
        return $this->p10;
    }

    public function setP10($p10 = null) {
        $this->p10 = $p10;
    }
}

?>
