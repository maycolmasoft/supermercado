<?php
/**
 * @package dompdf
 * @link    http://www.dompdf.com/
 * @author  Benj Carson <benjcarson@digitaljunkies.ca>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @version $Id: tcpdf_adapter.cls.php 448 2011-11-13 13:00:03Z fabien.menager $
 */

require_once(DOMPDF_LIB_DIR . '/tcpdf/tcpdf.php');

/**
 * TCPDF PDF Rendering interface
 *
 * TCPDF_Adapter provides a simple, stateless interface to TCPDF.
 *
 * Unless otherwise mentioned, all dimensions are in points (1/72 in).
 * The coordinate origin is in the top left corner and y values
 * increase downwards.
 *
 * See {@link http://tcpdf.sourceforge.net} for more information on
 * the underlying TCPDF class.
 *
 * @package dompdf
 */
    
// Workaround for idiotic limitation on statics...
PDFLib_Adapter::$PAPER_SIZES = CPDF_Adapter::$PAPER_SIZES;
