<?php
use Dompdf\Dompdf;

class Pdf
{
    public function __construct(){
        
        // include autoloader
        require_once FCPATH.'third_party/vendor/autoload.php';
        
        // instantiate and use the dompdf class
        $pdf = new DOMPDF();
        
        $CI =&get_instance();
        $CI->dompdf = $pdf;
        
    }
}
?>