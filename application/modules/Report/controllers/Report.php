<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Report extends MX_Controller  
{    
    function __construct()
    {
        parent::__construct();
        Modules::run('Login/_login');
        $this->load->model('Mdl_report');
        $this->load->library('Pdf');
		$this->load->library('excel');
    }

    public function index()
    {    
        $data['content']  = 'Report/buyer_sales_report';
        $this->load->view('Template/template',$data);
    }
	
	//Buyer Sales Report
	public function buyer_sales_report()
    {    
        $data['content']  = 'Report/buyer_sales_report';
        $this->load->view('Template/template',$data);
    }
	
	//Seller Sales Report
	public function seller_sales_report()
    {    
        $data['content']  = 'Report/seller_sales_report';
        $this->load->view('Template/template',$data);
    }
	
	
	//Seller Sales Report
	public function seller_sales_report1()
    {    
        $data['content']  = 'Report/seller_sales_report1';
        $this->load->view('Template/template',$data);
    }

	//Check List Report
	public function check_list_report()
    {    
        $data['content']  = 'Report/check_list_report';
        $this->load->view('Template/template',$data);
    }

	//Expense Report
	public function expense_report()
    {    
        $data['content']  = 'Report/expense_report';
        $this->load->view('Template/template',$data);
    }
	
	//With Draw Report
	public function with_draw_report()
    {    
        $data['content']  = 'Report/with_draw_report';
        $this->load->view('Template/template',$data);
    }
	

	//Expense Report Action
	public function expense_report_action()
    {
        $data_post = $this->input->post();
        $expense_type_id = $data_post['expense_type_id'];
        $date_to = $data_post['date_to'];
        $date_from = $data_post['date_from'];
//echo $date_to;
//echo $date_from;
        $this->db->select('*');
        if ($expense_type_id != "") 
		{			
			$this->db->where('expense_type_id', $expense_type_id);
        }      
        if ($date_from > 0) {
            $this->db->where('exp_date>=', $date_from);
            //$this->db->where('expense_list.payment_date>=', $date_from);
        }

        if ($date_to > 0) {
            $this->db->where('exp_date<=', $date_to);//$this->db->where('expense_list.payment_date<=', $date_to);
        }       
        $this->db->where('exp_type','expense');
        $this->db->from('expense_list');
		
 

        $result_set_order = $this->db->get()->result();
//echo $this->db->last_query();exit;
         
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Expense Report');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Sr No');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Country Name');
        $this->excel->getActiveSheet()->setCellValue('C1', 'City Name');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Branch Name');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Expense Type');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Description');
        $this->excel->getActiveSheet()->setCellValue('G1', 'Price');
        $this->excel->getActiveSheet()->setCellValue('H1', 'From');
        $this->excel->getActiveSheet()->setCellValue('I1', 'Date');

        for ($col = ord('A'); $col <= ord('Z'); $col++) {
            //set column dimension
            $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
            //change the font size
            $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
        }
        $row_count = 2;
        $srno = 1;
		$paid = 0;
		$rem = 0;
		$total = 0;
        //Customer Record Result
        foreach ($result_set_order as $row) {
    $country_name = $this->Mdl_report->get_relation_pax('country_list','country_name','id',$row->country_id);
	$city_name = $this->Mdl_report->get_relation_pax('city_list','city_name','id',$row->city_id);
	$branch_name = $this->Mdl_report->get_relation_pax('branch_list','branch_name','id',$row->branch_id);
	$exp_name1 = $this->Mdl_report->get_relation_pax('expense_type_list','expense_type_name','id',$row->expense_type_id);
	
			$paid = $paid + $row->exp_price;
			//$rem = $rem + $row->remaining_price;
			//$total = $total + $total_price;
          //  $city_name = $this->Mdl_report->get_relation_pax('city_list', 'title', 'id', $row->city_id);
           // $total_price = $row->order_price + $row->shipping_charges;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row_count, $srno);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $row_count, $country_name);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $row_count, $city_name);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, $row_count, $branch_name);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $row_count, $exp_name1);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, $row_count, $row->exp_des);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(6, $row_count, "Rs. ".$row->exp_price);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(7, $row_count, $row->exp_from);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(8, $row_count, $row->exp_date);
            $row_count++;
            $srno++;


        }
		
		$this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $row_count+1, 'Total Amount');
				$this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, $row_count+1, "Rs. ".($paid+$rem));
				
				
				
        //$column_count++;
        $filename = 'expense_report.xlsx'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

        /*}
        else
        {
            $this->session->set_flashdata('error', 'your data not fonund please try again');
            $data['content']  = 'Report/daily_sales_report';
            $this->load->view('Template/template',$data);
        }*/

        $data['content'] = 'Report/expense_report';
        $this->load->view('Template/template', $data);
    }

	//With Draw Report Action
	public function with_draw_report_action()
    {
        $data_post = $this->input->post();
        $exp_name = $data_post['exp_name'];
        $date_to = $data_post['date_to'];
        $date_from = $data_post['date_from'];
//echo $date_to;
//echo $date_from;
        $this->db->select('*');
        if ($exp_name != "") 
		{			
			$this->db->like('exp_name', $exp_name);
        }      
        if ($date_from > 0) {
            $this->db->where('exp_date>=', $date_from);
            //$this->db->where('expense_list.payment_date>=', $date_from);
        }

        if ($date_to > 0) {
            $this->db->where('exp_date<=', $date_to);//$this->db->where('expense_list.payment_date<=', $date_to);
        }       
        $this->db->where('exp_type','withdraw');
        $this->db->from('expense_list');
		
 

        $result_set_order = $this->db->get()->result();

         
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('With Draw Report');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Sr No');
        $this->excel->getActiveSheet()->setCellValue('B1', 'With Draw Name');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Description');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Price');
        $this->excel->getActiveSheet()->setCellValue('E1', 'From');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Date');

        for ($col = ord('A'); $col <= ord('Z'); $col++) {
            //set column dimension
            $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            //change the font size
            $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
        }
        $row_count = 2;
        $srno = 1;
		$paid = 0;
		$rem = 0;
		$total = 0;
        //Customer Record Result
        foreach ($result_set_order as $row) {
          /*   $order_date = $this->Mdl_report->get_relation_pax('order_list', 'order_date', 'order_code', $row->order_code);
            $total_price = $this->Mdl_report->get_relation_pax('order_list', 'total_price', 'order_code', $row->order_code); */
			$paid = $paid + $row->exp_price;
			//$rem = $rem + $row->remaining_price;
			//$total = $total + $total_price;
          //  $city_name = $this->Mdl_report->get_relation_pax('city_list', 'title', 'id', $row->city_id);
           // $total_price = $row->order_price + $row->shipping_charges;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row_count, $srno);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $row_count, $row->exp_name);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $row_count, $row->exp_des);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, $row_count, "Rs. ".$row->exp_price);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $row_count, $row->exp_from);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, $row_count, $row->exp_date);
            $row_count++;
            $srno++;


        }
		
		$this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $row_count+1, 'Total Amount');
				$this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, $row_count+1, "Rs. ".($paid+$rem));
				
				
				
        //$column_count++;
        $filename = 'with_draw_report.xlsx'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

        /*}
        else
        {
            $this->session->set_flashdata('error', 'your data not fonund please try again');
            $data['content']  = 'Report/daily_sales_report';
            $this->load->view('Template/template',$data);
        }*/

        $data['content'] = 'Report/with_draw_report';
        $this->load->view('Template/template', $data);
    }


	//Buyer Report Action
	public function buyer_report_action()
    {
        $data_post = $this->input->post();
        $buyer_id = $data_post['buyer_id'];
        $date_to = $data_post['date_to'];
        $date_from = $data_post['date_from'];

        $this->db->select('order_list.order_id as ord_id,order_list.*,user_list.*,order_list.user_id,order_list.order_date,payment_list.payment_date,payment_list.*');
        if ($buyer_id != "" && $buyer_id != "all") 
		{			
			$this->db->where('order_list.user_id', $buyer_id);
        }      
        if ($date_from > 0) {
            $this->db->where('order_list.order_date>=', $date_from);
            $this->db->where('payment_list.payment_date>=', $date_from);
        }

        if ($date_to > 0) {
            $this->db->where('order_list.order_date<=', $date_to);
            $this->db->where('payment_list.payment_date<=', $date_to);
        }       
        $this->db->where('order_list.user_type','buyer');
        $this->db->from('order_list');

        $this->db->join('user_list', 'user_list.id = order_list.user_id');
        $this->db->join('payment_list', 'payment_list.order_code = order_list.order_code');
        //$this->db->join('cart_list', 'cart_list.order_code = order_list.order_code');


        $result_set_order = $this->db->get()->result();

      /*    echo "<pre>";
        print_r($result_set_order); 
		exit;
         */
		
	
		
		$this->db->select('payment_list.payment_id as payment_id,payment_list.*,user_list.*,payment_list.user_id,payment_list.payment_date');
        if ($buyer_id != "" && $buyer_id != "all") 
		{			
			$this->db->where('payment_list.user_id', $buyer_id);
        }      
        if ($date_from > 0 && $date_to > 0)
		{
            $this->db->where('payment_list.payment_date>=', $date_from);
			$this->db->where('payment_list.payment_date<=', $date_to);
		}else 
        if ($date_from > 0) {
            $this->db->where('payment_list.payment_date=', $date_from);
        }       
        $this->db->where('payment_list.user_type','buyer');
        $this->db->from('payment_list');

        $this->db->join('user_list', 'user_list.id = payment_list.user_id');
        //$this->db->join('payment_list', 'payment_list.order_code = order_list.order_code');
        //$this->db->join('cart_list', 'cart_list.order_code = order_list.order_code');


        $result_set_payment = $this->db->get()->result();
		/* echo $this->db->last_query();
        echo "<pre>";
        print_r($result_set_payment);
        
		
		
		exit;  */
        /*if( $result->num_rows() > 0 ) { */
        //$result_set = $result->result();

        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Buyer Sales Report');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Sr No');
        $this->excel->getActiveSheet()->setCellValue('B1', 'User Type');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Name');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Contact');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Address');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Order Code');
        $this->excel->getActiveSheet()->setCellValue('G1', 'Order Date');
        $this->excel->getActiveSheet()->setCellValue('H1', 'Payment Date');
        $this->excel->getActiveSheet()->setCellValue('I1', 'Total Price');
        $this->excel->getActiveSheet()->setCellValue('J1', 'Paid Price');
        $this->excel->getActiveSheet()->setCellValue('K1', 'Remaining Price');
        $this->excel->getActiveSheet()->setCellValue('L1', 'Payment Mode');
       /*  $this->excel->getActiveSheet()->setCellValue('M1', 'Order Price');
        $this->excel->getActiveSheet()->setCellValue('N1', 'Shipping Charges');
        $this->excel->getActiveSheet()->setCellValue('O1', 'Total Price');
        $this->excel->getActiveSheet()->setCellValue('P1', 'Payment Mode');
        $this->excel->getActiveSheet()->setCellValue('Q1', 'Tracking No');
        $this->excel->getActiveSheet()->setCellValue('R1', 'Order Stats');
        $this->excel->getActiveSheet()->setCellValue('S1', 'Final Date');
        $this->excel->getActiveSheet()->setCellValue('T1', 'Comments'); */

        for ($col = ord('A'); $col <= ord('Z'); $col++) {
            //set column dimension
            $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setBold(true);
            //change the font size
            $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
        }
        $row_count = 2;
        $srno = 1;
		$paid = 0;
		$rem = 0;
		$total = 0;
        //Customer Record Result
        foreach ($result_set_payment as $row) {
            $order_date = $this->Mdl_report->get_relation_pax('order_list', 'order_date', 'order_code', $row->order_code);
            $total_price = $this->Mdl_report->get_relation_pax('order_list', 'total_price', 'order_code', $row->order_code);
			$paid = $paid + $row->paid_price;
			$rem = $rem + $row->remaining_price;
			//$total = $total + $total_price;
          //  $city_name = $this->Mdl_report->get_relation_pax('city_list', 'title', 'id', $row->city_id);
           // $total_price = $row->order_price + $row->shipping_charges;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row_count, $srno);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $row_count, ucwords($row->user_type));
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $row_count, $row->name);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, $row_count, $row->contact);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $row_count, $row->address);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, $row_count, $row->order_code);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(6, $row_count, $order_date);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(7, $row_count, $row->payment_date);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(8, $row_count, "Rs. ".$total_price);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $row_count, "Rs. ".$row->paid_price);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(10, $row_count, "Rs. ".$row->remaining_price);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(11, $row_count, $row->payment_mode);
           /*  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(12, $row_count, "Rs. " . $row->order_price);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(13, $row_count, "Rs. " . $row->shipping_charges);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(14, $row_count, "Rs. " . $total_price);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(15, $row_count, $row->payment_mode);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(16, $row_count, $row->order_track);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(17, $row_count, $row->order_status);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(18, $row_count, $row->final_date);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(19, $row_count, $row->comments); */
            $row_count++;
            $srno++;


        }
		
		$this->excel->getActiveSheet()->setCellValueByColumnAndRow(7, $row_count+1, 'Total Amount');
				$this->excel->getActiveSheet()->setCellValueByColumnAndRow(8, $row_count+1, "Rs. ".($paid+$rem));
				$this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $row_count+1, "Rs. ".$paid);
				$this->excel->getActiveSheet()->setCellValueByColumnAndRow(10, $row_count+1,"Rs. ".$rem);
				
				
				
        //$column_count++;
        $filename = 'buyer_sales_report.xlsx'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

        /*}
        else
        {
            $this->session->set_flashdata('error', 'your data not fonund please try again');
            $data['content']  = 'Report/daily_sales_report';
            $this->load->view('Template/template',$data);
        }*/

        $data['content'] = 'Report/buyer_sales_report';
        $this->load->view('Template/template', $data);
    }

	//Seller Report Action
	public function seller_report_action1()
    {
        $data_post = $this->input->post();
        $buyer_id = $data_post['buyer_id'];
        $date_to = $data_post['date_to'];
        $date_from = $data_post['date_from'];
		
		$this->db->select('payment_list.payment_id as payment_id,payment_list.*,user_list.*,payment_list.user_id,payment_list.payment_date');
        if ($buyer_id != "" && $buyer_id != "all") 
		{			
			$this->db->where('payment_list.user_id', $buyer_id);
        }      
        if ($date_from > 0 && $date_to > 0)
		{
            $this->db->where('payment_list.payment_date>=', $date_from);
			$this->db->where('payment_list.payment_date<=', $date_to);
		}else 
        if ($date_from > 0) {
            $this->db->where('payment_list.payment_date=', $date_from);
        }       
        $this->db->where('payment_list.user_type','seller');
        $this->db->from('payment_list');

        $this->db->join('user_list', 'user_list.id = payment_list.user_id');
        //$this->db->join('payment_list', 'payment_list.order_code = order_list.order_code');
        //$this->db->join('cart_list', 'cart_list.order_code = order_list.order_code');


        $result_set_payment = $this->db->get()->result();
		
		
        /*if( $result->num_rows() > 0 ) { */
        //$result_set = $result->result();

        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Seller Sales Report');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Sr No');
        $this->excel->getActiveSheet()->setCellValue('B1', 'User Type');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Name');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Contact');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Address');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Order Code');
        $this->excel->getActiveSheet()->setCellValue('G1', 'Order Date');
        $this->excel->getActiveSheet()->setCellValue('H1', 'Payment Date');
        $this->excel->getActiveSheet()->setCellValue('I1', 'Total Price');
        $this->excel->getActiveSheet()->setCellValue('J1', 'Paid Price');
        $this->excel->getActiveSheet()->setCellValue('K1', 'Remaining Price');
        $this->excel->getActiveSheet()->setCellValue('L1', 'Payment Type');
        $this->excel->getActiveSheet()->setCellValue('M1', 'Total Paid Price');
      
	  /*  $this->excel->getActiveSheet()->setCellValue('M1', 'Material Cost');
        $this->excel->getActiveSheet()->setCellValue('N1', 'Other Cost');
        $this->excel->getActiveSheet()->setCellValue('O1', 'Price Square Feet');
        $this->excel->getActiveSheet()->setCellValue('P1', 'Profit');*/
       /*  $this->excel->getActiveSheet()->setCellValue('M1', 'Order Price');
        $this->excel->getActiveSheet()->setCellValue('N1', 'Shipping Charges');
        $this->excel->getActiveSheet()->setCellValue('O1', 'Total Price');
        $this->excel->getActiveSheet()->setCellValue('P1', 'Payment Mode');
        $this->excel->getActiveSheet()->setCellValue('Q1', 'Tracking No');
        $this->excel->getActiveSheet()->setCellValue('R1', 'Order Stats');
        $this->excel->getActiveSheet()->setCellValue('S1', 'Final Date');
        $this->excel->getActiveSheet()->setCellValue('T1', 'Comments'); */

        for ($col = ord('A'); $col <= ord('Z'); $col++) {
            //set column dimension
            $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setBold(true);
            //change the font size
            $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
        }
        $row_count = 2;
        $srno = 1;
        $paid = 0;
        $rem = 0;
        $tmcost = 0;
        $tocost = 0;
        $tproduct_price = 0;
        $total_price_ = 0;
        $tprof = 0;
		
        //Customer Record Result
        foreach ($result_set_payment as $row) {
			
			$payment_type = $row->payment_type;
			
			
			if($payment_type == "regular")
			{
				
			
			
			$order_cart_list = $this->Mdl_report->_this_cart_record($row->order_code);
			$mcost = 0;
			$ocost = 0;
			$pcost = 0;
			$prof = 0;
			
			foreach($order_cart_list as $cart)
			{
				$pid = $cart->product_id;
				$square_feet = $cart->square_feet;
				$product_price = $cart->product_price;
				$ftprice = $cart->ftprice;
				$qty = $cart->qty;
				 $material_cost = $this->Mdl_report->get_relation_pax('product_list', 'material_cost', 'id', $pid);
				 $other_expense = $this->Mdl_report->get_relation_pax('product_list', 'other_expense', 'id', $pid);
				 
				 $val = ($ftprice/2); 
				 
				 $mcost1 = ($material_cost * $square_feet);
				 $ocost1 = ($other_expense * $square_feet);
				 $pcost1 = ($product_price * $square_feet);
				 //$tproduct_price = ($product_price);
				 $mcost = $mcost + $mcost1;
				 $ocost = $ocost + $ocost1;
				 $docost = $ocost + $val;
				 $pcost = $pcost + $pcost1;
				 $prof =  $pcost - ($mcost + $ocost); 
				 $dprof =  $prof + $val; 
			}
			$tmcost = $tmcost + $mcost;
			$tocost = $tocost + $ocost + $val;
			$tproduct_price = $tproduct_price + $pcost;
			$tprof = $tprof + $prof + $val;
			}
			else
			{
				/* $mcost = "";
				 $ocost = "";
				 $pcost = ;
				 $prof = ($mcost + $ocost) - $pcost;  */
			}
			
			
            $order_date = $this->Mdl_report->get_relation_pax('order_list', 'order_date', 'order_code', $row->order_code);
            if($payment_type == "regular")
			{
			$total_price = $this->Mdl_report->get_relation_pax('order_list', 'total_price', 'order_code', $row->order_code);
			
			$total_price_ = $total_price_ + $total_price;
			}
			$paid = $paid + $row->paid_price;
			$rem = $rem + $row->remaining_price;
          //  $city_name = $this->Mdl_report->get_relation_pax('city_list', 'title', 'id', $row->city_id);
           // $total_price = $row->order_price + $row->shipping_charges;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row_count, $srno);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $row_count, ucwords($row->user_type));
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $row_count, $row->name);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, $row_count, $row->contact);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $row_count, $row->address);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, $row_count, $row->order_code);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(6, $row_count, $order_date);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(7, $row_count, $row->payment_date);
if($payment_type == "regular")
			{ 
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(8, $row_count, "Rs. ".$total_price);
			}
			else
			{
			$this->excel->getActiveSheet()->setCellValueByColumnAndRow(8, $row_count, "---");
				
			}
		   $this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $row_count, "Rs. ".$row->paid_price);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(10, $row_count, "Rs. ".$row->remaining_price);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(11, $row_count, $row->payment_type);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(12, $row_count, $row->total_paid_price);
/*if($payment_type == "regular")
			{          
		  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(12, $row_count, "Rs. " . $mcost);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(13, $row_count, "Rs. " . $docost);
			$this->excel->getActiveSheet()->setCellValueByColumnAndRow(14, $row_count, "Rs. " . $pcost);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(15, $row_count, "Rs. " . $dprof);
			}
			else
			{
			$this->excel->getActiveSheet()->setCellValueByColumnAndRow(12, $row_count, "---");
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(13, $row_count, "---");
			$this->excel->getActiveSheet()->setCellValueByColumnAndRow(14, $row_count, "---");
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(15, $row_count, "---");
				
				
				
			}
			
*/
            /*  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(14, $row_count, "Rs. " . $total_price);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(15, $row_count, $row->payment_mode);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(16, $row_count, $row->order_track);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(17, $row_count, $row->order_status);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(18, $row_count, $row->final_date);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(19, $row_count, $row->comments); */
            $row_count++;
            $srno++;


        }
		
			$this->excel->getActiveSheet()->setCellValueByColumnAndRow(7, $row_count+1, 'Total Amount');
				$this->excel->getActiveSheet()->setCellValueByColumnAndRow(8, $row_count+1, "Rs. ".($total_price_));
				$this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $row_count+1, "Rs. ".$paid);
				$this->excel->getActiveSheet()->setCellValueByColumnAndRow(10, $row_count+1,"Rs. ".$rem);
				
				/*$this->excel->getActiveSheet()->setCellValueByColumnAndRow(12, $row_count+1,"Rs. ".$tmcost);
				$this->excel->getActiveSheet()->setCellValueByColumnAndRow(13, $row_count+1,"Rs. ".$tocost);
				
				$this->excel->getActiveSheet()->setCellValueByColumnAndRow(14, $row_count+1,"Rs. ".$tproduct_price);
				$this->excel->getActiveSheet()->setCellValueByColumnAndRow(15, $row_count+1,"Rs. ".$tprof);
				*/
				
				
        //$column_count++;
        $filename = 'seller_sales_report1.xlsx'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

        /*}
        else
        {
            $this->session->set_flashdata('error', 'your data not fonund please try again');
            $data['content']  = 'Report/daily_sales_report';
            $this->load->view('Template/template',$data);
        }*/

        $data['content'] = 'Report/seller_sales_report1';
        $this->load->view('Template/template', $data);
    }

	//Check List Report Action
	public function check_report_action()
    {
        $data_post = $this->input->post();
       // $user_type = $data_post['user_type'];
        $bank_id = $data_post['bank_id'];
        $date_from = $data_post['date_from'];
        $check_status = $data_post['check_status'];

        $this->db->select('*');
            
        /* if ($user_type > 0) {
            $this->db->where('check_type', $user_type);
            
        } */
		if ($bank_id > 0) {
            $this->db->where('bank', $bank_id);
           
        }
		if ($date_from > 0) {
            $this->db->where('check_date', $date_from);
        }
		if ($check_status > 0) {
            $this->db->where('check_status', $check_status);
        }

        $this->db->from('check_list');      
        $result_set_check = $this->db->get()->result();


        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Cheque List Report');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Sr No');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Cheque Type');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Bank Name');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Account Name');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Amount');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Cheque No');
        $this->excel->getActiveSheet()->setCellValue('G1', 'Branch');
        $this->excel->getActiveSheet()->setCellValue('H1', 'Branch Code');
        $this->excel->getActiveSheet()->setCellValue('I1', 'Cheque Date');
        $this->excel->getActiveSheet()->setCellValue('J1', 'Cheque Clear Date');
        $this->excel->getActiveSheet()->setCellValue('K1', 'Cheque Status');
        $this->excel->getActiveSheet()->setCellValue('L1', 'Cheque Status Date');
       // $this->excel->getActiveSheet()->setCellValue('L1', 'Payment Mode');
       /*  $this->excel->getActiveSheet()->setCellValue('M1', 'Order Price');
        $this->excel->getActiveSheet()->setCellValue('N1', 'Shipping Charges');
        $this->excel->getActiveSheet()->setCellValue('O1', 'Total Price');
        $this->excel->getActiveSheet()->setCellValue('P1', 'Payment Mode');
        $this->excel->getActiveSheet()->setCellValue('Q1', 'Tracking No');
        $this->excel->getActiveSheet()->setCellValue('R1', 'Order Stats');
        $this->excel->getActiveSheet()->setCellValue('S1', 'Final Date');
        $this->excel->getActiveSheet()->setCellValue('T1', 'Comments'); */

        for ($col = ord('A'); $col <= ord('Z'); $col++) {
            //set column dimension
            $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('Q1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('S1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('T1')->getFont()->setBold(true);
            //change the font size
            $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
        }
        $row_count = 2;
        $srno = 1;
		$paid = 0;
		$rem = 0;
		$total = 0;
        //Customer Record Result
        foreach ($result_set_check as $row) {
            $bank_name = $this->Mdl_report->get_relation_pax('bank_list', 'bank_name', 'id', $row->bank);
            //$total_price = $this->Mdl_report->get_relation_pax('order_list', 'total_price', 'order_code', $row->order_code);
			$paid = $paid + $row->paid_price;
			$rem = $rem + $row->remaining_price;
			$total = $total + $row->check_amount;
          //  $city_name = $this->Mdl_report->get_relation_pax('city_list', 'title', 'id', $row->city_id);
           // $total_price = $row->order_price + $row->shipping_charges;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row_count, $srno);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $row_count, ucwords($row->check_type));
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $row_count, $bank_name);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, $row_count, $row->account_name);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $row_count, "Rs. ".$row->check_amount);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, $row_count, $row->check_no);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(6, $row_count, $row->branch);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(7, $row_count, $row->branch_code);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(8, $row_count, $row->check_date);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $row_count, $row->check_clear_date);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(10, $row_count,$row->check_status);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(11, $row_count, $row->modify_date);
           /*  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(12, $row_count, "Rs. " . $row->order_price);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(13, $row_count, "Rs. " . $row->shipping_charges);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(14, $row_count, "Rs. " . $total_price);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(15, $row_count, $row->payment_mode);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(16, $row_count, $row->order_track);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(17, $row_count, $row->order_status);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(18, $row_count, $row->final_date);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(19, $row_count, $row->comments); */
            $row_count++;
            $srno++;


        }
		
		$this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, $row_count+1, 'Total Amount');
				$this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $row_count+1, "Rs. ".($total));
				//$this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $row_count+1, "Rs. ".$paid);
			//	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(10, $row_count+1,"Rs. ".$rem);
			 
			
				
        //$column_count++;
        $filename = 'cheque_list_report.xlsx'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

        /*}
        else
        {
            $this->session->set_flashdata('error', 'your data not fonund please try again');
            $data['content']  = 'Report/daily_sales_report';
            $this->load->view('Template/template',$data);
        }*/

        $data['content'] = 'Report/buyer_sales_report';
        $this->load->view('Template/template', $data);
    }

	
	
}