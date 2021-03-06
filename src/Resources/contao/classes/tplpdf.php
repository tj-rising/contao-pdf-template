<?php

/**
 * @copyright  Softleister 2011-2017
 * @author     Softleister <info@softleister.de>
 * @package    pdf-template
 * @license    LGPL
 * @see	       https://github.com/do-while/contao-pdf-template
 *
 */

namespace Softleister\Pdftemplate;

//-----------------------------------------------------------------
//  add special AddPage to class
//-----------------------------------------------------------------
class TPLPDF extends \setasign\Fpdi\TcpdfFpdi
{
    /**
     * Actual num_pages
     * @var integer
     */
    var $num_pages;
    
    /**
     * Actual current_page
     * @var integer
     */
    var $current_page = 1;
    
    
    //-- loads automatically the next side of PDF template
    public function AddPage($orientation='', $format='', $keepmargins=false, $tocpage=false)
    {
        parent::AddPage($orientation, $format, $keepmargins, $tocpage);
        
        $this->useTemplate( $this->importPage( $this->current_page ) );
        if($this->current_page < $this->num_pages) $this->current_page++;
    }
    
    //-- store the number of pages found    
    function setSourceFile($filename)
    {
        $this->num_pages = parent::setSourceFile($filename);
        return $this->num_pages;
    }
}
