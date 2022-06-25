<?php 
class Authorityletter extends MX_Controller
 {
     public function __construct()
 	{
 		parent::__construct();
  		// add library of Pdf
 		$this->load->library('Pdf');
 		   $this->load->model('Mdl_authority');
 		date_default_timezone_set("Asia/Karachi");

 	}
public function generate($id)
{
    // echo "hello"; exit;
$tcpdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
// set document information
$tcpdf->SetCreator(PDF_CREATOR);
$tcpdf->SetAuthor('Biltz Security Service');
$tcpdf->SetTitle('Authority Letter');
$tcpdf->SetSubject('TCPDF Tutorial');
$tcpdf->SetKeywords('TCPDF, PDF, example, test, guide');

//set default header information

$tcpdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,65,256), array(0,65,127));
$tcpdf->setFooterData(array(0,65,0), array(0,65,127));

//set header textual styles
$tcpdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//set footer textual styles
$tcpdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

//set default monospaced textual style
$tcpdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set default margins
$tcpdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
// Set Header Margin
$tcpdf->SetHeaderMargin(PDF_MARGIN_HEADER);
// Set Footer Margin
$tcpdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto for page breaks
$tcpdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image for scale factor
$tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// it is optional :: set some language-dependent strings
if (@file_exists(dirname(FILE).'/lang/eng.php'))
{
// optional
require_once(dirname(FILE).'/lang/eng.php');
// optional
$tcpdf->setLanguageArray($l);
}

// set default font for subsetting mode
$tcpdf->setFontSubsetting(true);

// Set textual style
// dejavusans is an UTF-8 Unicode textual style, on the off chance that you just need to
// print standard ASCII roasts, you can utilize center text styles like
// helvetica or times to lessen record estimate.
$tcpdf->SetFont('dejavusans', '', 14, '', true);
$tcpdf->AddPage();
$data=$this->Mdl_authority->_get_authority_record_byid($id);
//  	$tcpdf->setY(-70); //position at 15mm from bottom
	$tcpdf->Ln(15);
	$tcpdf->setFont('times','B',10);
 	$tcpdf->Cell(20, 1, '',0,0);
	$tcpdf->Cell(118, 1, '',0,0);
	$tcpdf->Cell(51, 1, '',0,1); 
	$tcpdf->Cell(20, 5, '',0,0); 
	$tcpdf->Cell(118, 5, '',0,0);
	$tcpdf->Cell(51, 5, 'Date  '. date("Y-m-d", strtotime($data->created_date)),0,1);
	$tcpdf->Ln(7);
	$tcpdf->setFont('times','B',14);
	$tcpdf->Cell(189,5,'Authority Letter',0,1,'C');
	$tcpdf->Ln(7);
	$tcpdf->setFont('times','',12);
// 	$tcpdf->Cell(20, 1, 'We hereby authorized our supervisor  _______________  having CNIC # ________________________ to under Supervision ___________________ Shot Gun of this Company for use at our client M/S________________________ Karachi. List of Weapon is attached. ',0,0);
// test some inline CSS


// print_r(date("Y-m-d", strtotime($data->created_date)));exit;
$html = '<p>We hereby authorized our supervisor  <u>'. $data->supervisor_name . '</u> having CNIC # <u>' .$data->cnic .'</u> to under Supervision <u>'.$data->supervision . '</u> Shot Gun of this Company for use at our client M/S <u>' .$data->M/S.'</u> Karachi. List of Weapon is attached.</p><br><p>Authority: Government of Sindh Home Department Letter No. JI/8-1/2014 (Weapon) dated 29-09-2014 cited below.</p>';

$tcpdf->writeHTML($html, true, false, true, false, '');
$tcpdf->Ln(7);

// 	$tcpdf->Cell(20, 1, 'Authority: Government of Sindh Home Department Letter No. JI/8-1/2014 (Weapon) dated 29-09-2014 cited below. ',0,0);
$tcpdf->Output(date('ymdhi').'_Authority_Letter.pdf', 'I');
}
}
 ?>