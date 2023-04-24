<?php 

include 'fpdf.php';

class pdf extends FPDF {
    public function header() {
        $this->setFont('Courier','B',12);
        $this->Write(5,'CAPREMCI 2019');
    }
    
    public function footer() {
        $this->setFont('Courier','B',12);
        $this->setY(-15);
        $this->Write(5,'2019');
    }
}

?>