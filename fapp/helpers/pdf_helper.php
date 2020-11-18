<?php
/**
 * pdf_helper short summary.
 *
 * pdf_helper description.
 *
 * @version 1.0
 * @author Kanchan
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function tcpdf()
{
    require_once(APPPATH.'helpers/tcpdf/tcpdf.php');
}

//require_once(APPPATH.'helpers/FPDI/fpdf/fpdf.php');
require_once(APPPATH.'helpers/tcpdf/tcpdf.php');
require_once(APPPATH.'helpers/FPDI/fpdi.php');
require_once(APPPATH.'helpers/FPDI/fpdf_tpl.php');

// Original file with multiple pages 
 //$fullPathToFile = FCPATH . "LISA_Transfer_Form.pdf";


class PDF extends FPDI {

    var $_tplIdx;
	var $_fullPathToFile;
	
    function Header() {

     // global $fullPathToFile;
	  
        if (is_null($this->_tplIdx)) {

            // THIS IS WHERE YOU GET THE NUMBER OF PAGES
            $this->numPages = $this->setSourceFile($this->_fullPathToFile);
            $this->_tplIdx = $this->importPage(1);

        }
        $this->useTemplate($this->_tplIdx, 0, 0,200);

    }

    function Footer() {}

}


?>