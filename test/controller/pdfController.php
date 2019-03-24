<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
    class pdfController{

        public function makePDF($userInfo, $orderId){
            // Include the main TCPDF library (search for installation path).
            require_once('vendors/TCPDF-master/tcpdf.php');

            // create new PDF document
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Job Vermeulen');
            $pdf->SetTitle('Payment Complete');
            $pdf->SetSubject('PDF Document');
            $pdf->SetKeywords('TCPDF, PDF, payment, complete');

            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf->setLanguageArray($l);
            }

            // ---------------------------------------------------------

            // set default font subsetting mode
            $pdf->setFontSubsetting(true);

            // Set font
            // dejavusans is a UTF-8 Unicode font, if you only need to
            // print standard ASCII chars, you can use core fonts like
            // helvetica or times to reduce file size.
            $pdf->SetFont('dejavusans', '', 14, '', true);

            // Add a page
            // This method has several options, check the source code documentation for more information.
            $pdf->AddPage();

            // set text shadow effect
            $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

            // Set some content to print
            $html = "   <h1>Uw betaling is compleet!</h1>
                        <h2>Beste ".$userInfo['user_first']." ".$userInfo['user_last'].",</h2>
                        <p>Hierbij ontvangt u uw bevestiging van de donatie aan shoppingcart.nl! Wij bedanken u vriendelijk dat u de ontwikkeling steunt van shoppingcart.nl!</p>
                        <h2>Met vriendelijke groet,</h2>
                        <h3>Namens de oprichter van shoppingcart.nl,</h3>
                        <p>Job Vermeulen</p>";
            
            // output the HTML content
            $pdf->writeHTML($html, true, false, true, false, '');


            // new style
            $style = array(
                'border' => false,
                'padding' => 0,
                'fgcolor' => array(0,0,0),
                'bgcolor' => false
            );

            // QRCODE,H : QR-CODE Best error correction
            $pdf->write2DBarcode($orderId, 'QRCODE,H', 15, 120, 50, 50, $style, 'N');

            // ---------------------------------------------------------

            // Close and output PDF document
            // This method has several options, check the source code documentation for more information.
            $pdfDocument = $pdf->Output('paymentComplete.pdf', 's');

            //============================================================+
            // END OF FILE
            //============================================================

            return $pdfDocument;
        }
    }