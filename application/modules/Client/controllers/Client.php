<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Client extends MX_Controller
{
    public $admin_email = array();

    function __construct()
    {
        parent::__construct();
        Modules::run('Login/_login');
        $this->load->library('email');
        $this->load->model('Mdl_client');
        $this->load->library('Pdf');
        $this->load->library('upload');
        $this->admin_email = $this->Mdl_client->_get_admin_email();
    }

    public function index()
    {
        $client_record = $this->Mdl_client->_get_client_record_byid();
        $data['client_record'] = $client_record;
        //$data['result_set'] = $this->Mdl_client->_get_category_list();
        $data['content']  = 'Client/client_record';
        $this->load->view('Template/template', $data);
    }

    //client record List
    public function client_record()
    {

        $client_record = $this->Mdl_client->_get_client_personal_list();
        $data['client_record'] = $client_record;
        //$data['result_set'] = $this->Mdl_client->_get_category_list();
        $data['content']  = 'Client/client_record';
        $this->load->view('Template/template', $data);
    }

    //client history List
    public function client_history()
    {
        // Client Record By ID		
        $client_record = $this->Mdl_client->_get_client_personal_record_byid();
        $data['client_record'] = $client_record;

        //$data['result_set'] = $this->Mdl_client->_get_sub_category_list();
        $data['content']  = 'Client/client_history';
        $this->load->view('Template/template', $data);
    }

    //Client List Action
    public function client_action()
    {
        $id = $this->uri->segment(3);

        //File No Generator		
        $file_code = $this->Mdl_client->_get_file_code_generator();
        // print_r($file_code);exit;
        $data['file_code'] = $file_code; 
        $data['content']  = 'Client/client_action';
        $this->load->view('Template/template', $data);
    }


    //Client Search By File No
    public function search_by_fileno()
    {
        $search_fileno         =  $this->input->post('search_fileno');
        $user_id = $this->session->userdata('id');
        $this->db->select('*');
        if ($this->session->userdata('user_type') == '1') {
            $this->db->where('file_no', $search_fileno);
        } else {
            $this->db->where('file_no', $search_fileno);
            //$this->db->where('user_id',$user_id);
            $this->db->where('branch_id', $this->session->userdata('branch_id'));
        }
        $this->db->order_by('id', 'desc');
        $result =  $this->db->get('client_personal_list');
        //print_r($result);exit;
        if ($result->num_rows() > 0) {
            //echo "YES";
            foreach ($result->result() as $res) {
?>
                <div class="row">
                    <input type="hidden" id="client_personal_id" name="client_personal_id" value="<?php echo $res->id; ?>" />
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="col-md-3 control-label">File No </label>
                            <div class="col-md-9">
                                <input type="text" id="fileid" name="fileid" readonly value="<?php echo $res->file_no; ?>" placeholder="File No" class=" form-control required-field">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="form-group">
                            <label for="inputEmail3" class="col-md-3 control-label">Name</label>
                            <div class="col-md-9">
                                <input type="text" id="name" name="name" value="<?php echo $res->name; ?>" placeholder="Name" class="form-control required-field">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-md-3 control-label">Email</label>
                            <div class="col-md-9">
                                <input type="email" id="email" name="email" value="<?php echo $res->email; ?>" placeholder="Email" class="form-control required-field">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4">

                        <div class="form-group">
                            <label for="inputEmail3" class="col-md-3 control-label">S/O, D/O, W/O</label>
                            <div class="col-md-9">
                                <input type="text" id="soname" name="soname" value="<?php echo $res->so_name; ?>" placeholder="S/O, D/O, W/O" class="form-control required-field">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="form-group">
                            <label for="inputEmail3" class="col-md-3 control-label">Postal Address</label>
                            <div class="col-md-9">
                                <textarea id="postal_address" name="postal_address" value="" placeholder="Postal Address" class="form-control required-field"><?php echo $res->postal_address; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-md-3 control-label">Contact Number</label>
                            <div class="col-md-9">
                                <input type="text" id="contact1" name="contact1" value="<?php echo $res->contact1; ?>" placeholder="Contact Number" class="form-control required-field">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">

                        <div class="form-group">
                            <label for="inputEmail3" class="col-md-3 control-label">Other Contact Number</label>
                            <div class="col-md-9">
                                <input type="text" id="contact2" name="contact2" value="<?php echo $res->contact2; ?>" placeholder="Other Contact Number" class="form-control required-field">
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
        } else {

            ?>
            <script type="text/javascript">
                $.gritter.add({
                    // (string | mandatory) the heading of the notification
                    title: 'Not Exists!',
                    // (string | mandatory) the text inside the notification
                    // text: search_input+' this File No Already Exists with Name '+details.name,
                    text: ' File No Not Exists ',
                    class_name: 'gritter-danger gritter-light'
                });
                //$('.check_fileno_exists').val(''); 
                $("#search_fileno").val('');
                //$("#search_fileno").focus();
            </script>
            <?php
            $file_code = $this->Mdl_client->_get_file_code_generator();
            //echo "NO";
            ?>
            <div class="row">
                <input type="hidden" id="client_personal_id" name="client_personal_id" value="" />
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="col-md-3 control-label">File No </label>
                        <div class="col-md-9">
                            <input type="text" id="fileid" name="fileid" readonly value="<?php echo $file_code; ?>" placeholder="File No" class="check_fileno_exists form-control required-field">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-md-3 control-label">Name</label>
                        <div class="col-md-9">
                            <input type="text" id="name" name="name" value="" placeholder="Name" class="form-control required-field">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-md-3 control-label">Email</label>
                        <div class="col-md-9">
                            <input type="email" id="email" name="email" value="" placeholder="Email" class="form-control required-field">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-4">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-md-3 control-label">S/O, D/O, W/O</label>
                        <div class="col-md-9">
                            <input type="text" id="soname" name="soname" value="" placeholder="S/O, D/O, W/O" class="form-control required-field">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-md-3 control-label">Postal Address</label>
                        <div class="col-md-9">
                            <textarea id="postal_address" name="postal_address" value="" placeholder="Postal Address" class="form-control required-field"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-md-3 control-label">Contact Number</label>
                        <div class="col-md-9">
                            <input type="text" id="contact1" name="contact1" value="" placeholder="Contact Number" class="form-control required-field">
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-md-3 control-label">Other Contact Number</label>
                        <div class="col-md-9">
                            <input type="text" id="contact2" name="contact2" value="" placeholder="Other Contact Number" class="form-control required-field">
                        </div>
                    </div>
                </div>
            </div>
        <?php

        }
    }

    //Search File No By Client
    public function search_client_by_fileno()
    {
        $fileid = $this->input->post('fileid');
        $this->db->select('id');
        $this->db->where('file_no', $fileid);
        $query = $this->db->get('client_personal_list');
        $count = $query->num_rows();
        if ($count > 0) {
            $_result = $query->result();
            if ($_result[0]->file_no == $fileid) {
                $count = 0;
            }
        }
        $array['return'][0] = $count;
        echo json_encode($array);
    }


    //Client Submit
    public function client_submit()
    {
        $post = $this->input->post();
        //documents 
        // var_dump(isset($_FILES['docs']['name']) && count(array_filter($_FILES['docs']['name'])) > 0);
        // exit;
        if (isset($_FILES['docs']['name']) && count(array_filter($_FILES['docs']['name'])) > 0) {
          
            $filesCount = count($_FILES['docs']['name']); 
            for($i = 0; $i < $filesCount; $i++)
            { 
        // print_r($_FILES['docs']['name'][$i]);
        $_FILES['file']['name']     = "guardfile_" . time() . "_" . str_replace(' ', '-', $_FILES['docs']['name'][$i]); 
        $_FILES['file']['type']     = $_FILES['docs']['type'][$i]; 
        $_FILES['file']['tmp_name'] = $_FILES['docs']['tmp_name'][$i]; 
        $_FILES['file']['error']     = $_FILES['docs']['error'][$i]; 
        $_FILES['file']['size']     = $_FILES['docs']['size'][$i]; 
            $newname = "guardfile_" . time() . "_" . str_replace(' ', '-', $_FILES['docs']['name'][$i]);
            $config = [
                'file_name' => $newname,
                'allowed_types' => 'pdf|jpg|png|jpeg',
                'upload_path' => 'public_html/frontend/files/guard/'
            ];
            $this->upload->initialize($config);  
            $upload_file = $this->upload->do_upload('file');
            if($upload_file){
                $uploaded_files[]=$newname;
            }else{
                $uploaded_files[]="";

            }

            
        }
        $files=json_encode($uploaded_files);
        // print_r($uploaded_files);exit;
        }else{
            $files=null;
        }

      
        //personal Image
        //  var_dump(!empty($_FILES['pic']['name']) );
        // exit;
        if (!empty(($_FILES['pic']['name']))) {
            // $addImg = $_FILES['pic']['name'];
            $newname = "guardprofile_" . time() . "_" . str_replace(' ', '-', $_FILES['pic']['name']);
            $config = [
                'file_name' => $newname,
                'allowed_types' => 'gif|jpg|png|jpeg',
                'upload_path' => 'public_html/frontend/image/guard/'
            ];
            $this->upload->initialize($config);
        $upload = $this->upload->do_upload('userfile');

        }else{
            $newname=null;
        }


        // if ($upload ) {
            $data_p_relation =
                array(
                    'file_no'          => $post['fileid'],
                    'contact_no'          => $post['contact_no'],
                    'nic_no'          => $post['nic_no'],
                    'name'             => $post['name'],
                    'f_name'          => $post['f_name'],
                    'present_address'   => $post['present_address'],
                    'permanent_address'   => $post['permanent_address'],
                    'marital_status_id'   => $post['marital_status_id'],
                    'sect_id'          => $post['sect_id'],
                    'religion_id'        => $post['religion_id'],
                    'status_id'        => $post['status_id'],
                    'dob'        => $post['dob'],
                    'education'        => $post['education'],
                    'kin_name'        => $post['kin_name'],
                    'kin_address'        => $post['kin_address'],
                    'cheque'        => $post['terms_cond'],
                    'company_no'        => $post['comp_no'],
                    'enrollment_date'        => $post['enrollment_date'],
                    'pic'        => $newname,
                    'documents'        =>$files,
                    'weapon' =>$post['weapon'],
                     'client_id' =>$post['client'],
                    'dailywages' => $post['dailywages'],
                );
            // print_r($data_p_relation);exit;
            $db_command = $this->Mdl_client->db_command($data_p_relation, null, 'client_personal_list');
            if ($db_command) {
                $this->session->set_flashdata('saved', 'your data successfully Saved');
                redirect(base_url() . 'Client/client_action', 'refresh');
            } else {
                $this->session->set_flashdata('Error', 'your data has not been saved');
                redirect(base_url() . 'Client/client_action', 'refresh');
            }
  
    }




    //Payment Type Change Html
    public function payment_type_change()
    {

        $pm = $this->input->post('payment_type');
        if ($pm == "check") {
        ?>
            <div class="row">
                <div class="col-md-4">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-md-3 control-label">Check Image</label>
                        <div class="col-md-9">
                            <input type="file" id="check_img" name="check_img" value="" placeholder="Check Image" class="form-control required-field">
                        </div>
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-md-3 control-label">Check No</label>
                        <div class="col-md-9">
                            <input type="text" id="check_no" name="check_no" value="" placeholder="Check No" class="form-control required-field">
                        </div>
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-md-3 control-label">Bank Name</label>
                        <div class="col-md-9">
                            <input type="text" id="check_bank_name" name="check_bank_name" value="" placeholder="Bank Name" class="form-control required-field">
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-4">

                <div class="form-group">
                    <label for="inputEmail3" class="col-md-3 control-label">Branch Name</label>
                    <div class="col-md-9">
                        <input type="text" id="check_branch_name" name="check_branch_name" value="" placeholder="Branch Name" class="form-control required-field">
                    </div>
                </div>

            </div>
        <?php
        } else if ($pm == "pay") {
        ?>
            <div class="row">
                <div class="col-md-4">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-md-3 control-label">Pay Order Image</label>
                        <div class="col-md-9">
                            <input type="file" id="pay_img" name="pay_img" value="" placeholder="Pay Order Image" class="form-control required-field">
                        </div>
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-md-3 control-label">Pay Order No</label>
                        <div class="col-md-9">
                            <input type="text" id="pay_no" name="pay_no" value="" placeholder="Pay Order No" class="form-control required-field">
                        </div>
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-md-3 control-label">Bank Name</label>
                        <div class="col-md-9">
                            <input type="text" id="pay_bank_name" name="pay_bank_name" value="" placeholder="Bank Name" class="form-control required-field">
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-4">

                <div class="form-group">
                    <label for="inputEmail3" class="col-md-3 control-label">Branch Name</label>
                    <div class="col-md-9">
                        <input type="text" id="pay_branch_name" name="pay_branch_name" value="" placeholder="Branch Name" class="form-control required-field">
                    </div>
                </div>

            </div>
        <?php
        } else if ($pm == "online") {
        ?>
            <h4>Account From</h4>
            <hr />
            <div class="row">
                <div class="col-md-4">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-md-3 control-label">Account No From</label>
                        <div class="col-md-9">
                            <input type="text" id="online_account_from" name="online_account_from" value="" placeholder="Account No From" class="form-control required-field">
                        </div>
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-md-3 control-label">Bank Name From</label>
                        <div class="col-md-9">
                            <input type="text" id="online_bank_from" name="online_bank_from" value="" placeholder="Bank Name From" class="form-control required-field">
                        </div>
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-md-3 control-label">Branch Name From</label>
                        <div class="col-md-9">
                            <input type="text" id="online_branch_from" name="online_branch_from" value="" placeholder="Branch Name From" class="form-control required-field">
                        </div>
                    </div>

                </div>
            </div>

            <h4>Account To</h4>
            <hr />
            <div class="row">
                <div class="col-md-4">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-md-3 control-label">Account No To</label>
                        <div class="col-md-9">
                            <input type="text" id="online_account_to" name="online_account_to" value="" placeholder="Account No To" class="form-control required-field">
                        </div>
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-md-3 control-label">Bank Name To</label>
                        <div class="col-md-9">
                            <input type="text" id="online_bank_to" name="online_bank_to" value="" placeholder="Bank Name To" class="form-control required-field">
                        </div>
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-md-3 control-label">Branch Name To</label>
                        <div class="col-md-9">
                            <input type="text" id="online_branch_to" name="online_branch_to" value="" placeholder="Branch Name To" class="form-control required-field">
                        </div>
                    </div>

                </div>
            </div>
        <?php

        }
    }

    //Payment Submit Client
    public function payment_submit()
    {

        $post = $this->input->post();

        //Payment Code  Generator
        $get_payment_code = $this->Mdl_client->_get_payment_code_generator();
        $first_variable1 = "RCPT";
        $get_current_date1 = date('dmy');
        $payment_code = $first_variable1 . "-" . $get_payment_code . "-" . $get_current_date1;


        //Check Image
        if ($_FILES['check_img']['name'] != "") {
            $targetDir = FCPATH . "public_html/frontend/image/check/";
            $fileName = "check_" . time() . $this->session->userdata('id') . '.jpg';
            move_uploaded_file($_FILES['check_img']['tmp_name'], $targetDir . $fileName);
            $check_image = $fileName;
        } else {
            $check_image = "";
        }

        //Pay Order Image
        if ($_FILES['pay_img']['name'] != "") {
            $targetDir = FCPATH . "public_html/frontend/image/pay/";
            $fileName = "pay_" . time() . $this->session->userdata('id') . '.jpg';
            move_uploaded_file($_FILES['pay_img']['tmp_name'], $targetDir . $fileName);
            $pay_image = $fileName;
        } else {
            $pay_image = "";
        }



        if ($this->session->userdata('user_type') == '1') {
            $user_type = "admin";
            $branch_id = $post['branch_id'];
        } else {
            $user_type = "user";
            $branch_id = $this->session->userdata('branch_id');
        }
        $user_id = $this->session->userdata('id');


        $patient_personal_id = $post['personal_id'];

        $paid = $post['paid'];
        $payment_type = @$post['payment_type'];
        $payment_date = @$post['mydate'];
        $payment_description = @$post['payment_description'];
        $remarks = @$post['remarks'];
        $check_no = @$post['check_no'];
        $check_bank_name = @$post['check_bank_name'];
        $check_branch_name = @$post['check_branch_name'];
        $pay_no = @$post['pay_no'];
        $pay_bank_name = @$post['pay_bank_name'];
        $pay_branch_name = @$post['pay_branch_name'];
        $online_account_from = @$post['online_account_from'];
        $online_bank_from = @$post['online_bank_from'];
        $online_branch_from = @$post['online_branch_from'];
        $online_account_to = @$post['online_account_to'];
        $online_bank_to = @$post['online_bank_to'];
        $online_branch_to = @$post['online_branch_to'];

        $this->db->trans_start(); // Query will be rolled back

        //Patient PAYMENT Record
        $data_p_relation2 =
            array(
                'payment_code'          => $payment_code,
                'discount'          => 0,
                'paid'          => $paid,
                'payment_type'        => $payment_type,
                'check_no'        => $check_no,
                'check_image'        => $check_image,
                'check_bank_name'        => $check_bank_name,
                'check_branch_name'        => $check_branch_name,
                'check_status'        => 0,
                'pay_no'        => $pay_no,
                'pay_image'        => $pay_image,
                'pay_bank_name'        => $pay_bank_name,
                'pay_branch_name'        => $pay_branch_name,
                'pay_status'        => 0,
                'online_account_from'        => $online_account_from,
                'online_bank_from'        => $online_bank_from,
                'online_branch_from'        => $online_branch_from,
                'online_account_to'        => $online_account_to,
                'online_bank_to'        => $online_bank_to,
                'online_branch_to'        => $online_branch_to,
                'client_personal_id'        => $patient_personal_id,
                'user_id'        => $user_id,
                'branch_id'        => $branch_id,
                'description'        => $payment_description,
                'remarks'        => $remarks,
                'payment_date'        => $payment_date,
                'payment_status'        => 'remaining paid',
                'is_enable'        => 1
            );
        $db_command = $this->Mdl_client->db_command($data_p_relation2, null, 'client_payment_list');
        $last_payment_id = $this->db->insert_id();

        $this->db->trans_complete();


        if ($db_command) {

            $data['pre_payment'] = $post['remaining_amount'] - $post['paid'];
            $data['last_payment_id'] = $last_payment_id;
            //$data['content']    = 'Buyer/view_order_slip';
            $this->load->view('Client/view_order_slip_payment', $data);

            /* 
                if($post['id'] > 0)
                {
                    $this->session->set_flashdata('update', 'your data successfully Updated');
                }else
                {
                    $this->session->set_flashdata('saved', 'your data successfully Saved');
                }
                redirect(base_url().'Client/add_amount/'.$patient_personal_id,'refresh'); */
        } else {
            $this->session->set_flashdata('Error', 'your data has not been saved');
            redirect(base_url() . 'Client/add_amount/' . $patient_personal_id, 'refresh');
        }
    }

    //edit_client_detail
    public function edit_client_detail()
    {

        $client_personal_id = $this->uri->segment(3);

        // Client Record By ID		
        $client_record = $this->Mdl_client->_get_client_personal_record_byid($client_personal_id);

        $data['client_record'] = $client_record;

        $data['content']  = 'Client/edit_client_detail';
        $this->load->view('Template/template', $data);
    }

    //file_detail
    public function file_detail()
    {

        $client_personal_id = $this->uri->segment(3);

        // Client Record By ID		
        $file_record = $this->Mdl_client->_get_client_file_record_byid($client_personal_id);

        $data['file_record'] = $file_record;

        $data['content']  = 'Client/file_detail';
        $this->load->view('Template/template', $data);
    }

    //file_action
    public function file_action()
    {
        $personal_id = $this->uri->segment(3);
        $file_id = $this->uri->segment(4);
        // File Record By ID		
        $file_record = $this->Mdl_client->_get_file_record_byid($file_id);
        $data['file_record'] = $file_record;
        $data['personal_id'] = $personal_id;
        $data['content']  = 'Client/file_action';
        $this->load->view('Template/template', $data);
    }

    //file Submit
    public function file_submit()
    {
        $post = $this->input->post();
        if ($this->session->userdata('user_type') == '1') {
            $user_type = "admin";
            $branch_id = $post['branch_id'];
        } else {
            $user_type = "user";
            $branch_id = $this->session->userdata('branch_id');
        }
        $user_id = $this->session->userdata('id');
        //Edit File
        if ($post['file_id'] > 0) {
            $personal_id = $post['personal_id'];
            //File Image
            if ($_FILES['client_file']['name'] != "") {
                $targetDir = FCPATH . "public_html/frontend/image/file/";
                $fileName = "file_" . time() . $this->session->userdata('id') . '.jpg';
                move_uploaded_file($_FILES['client_file']['tmp_name'], $targetDir . $fileName);
                $client_file = $fileName;
            } else {
                $client_file = $post[''];
            }


            $this->db->trans_start(); // Query will be rolled back

            //Patient PAYMENT Record
            $data_p_relation2 =
                array(
                    'detail'          => $post['detail'],
                    'image_name'        => $client_file
                );
            $db_command = $this->Mdl_client->db_command($data_p_relation2, $post['file_id'], 'file_record_list');
            $pid3 = $this->db->insert_id();

            $this->db->trans_complete();


            if ($db_command) {
                if ($post['id'] > 0) {
                    $this->session->set_flashdata('update', 'your data successfully Updated');
                } else {
                    $this->session->set_flashdata('saved', 'your data successfully Saved');
                }
                redirect(base_url() . 'Client/file_detail/' . $personal_id, 'refresh');
            } else {
                $this->session->set_flashdata('Error', 'your data has not been saved');
                redirect(base_url() . 'Client/file_action/' . $personal_id . '/' . $post['file_id'], 'refresh');
            }
        } //Add File
        else {
            $personal_id = $post['personal_id'];
            //Check Image
            if ($_FILES['client_file']['name'] != "") {
                $targetDir = FCPATH . "public_html/frontend/image/file/";
                $fileName = "file_" . time() . $this->session->userdata('id') . '.jpg';
                move_uploaded_file($_FILES['client_file']['tmp_name'], $targetDir . $fileName);
                $client_file = $fileName;
            } else {
                $client_file = "";
            }

            $this->db->trans_start(); // Query will be rolled back

            //Patient PAYMENT Record
            $data_p_relation2 =
                array(
                    'client_id'          => $personal_id,
                    'user_id'        => $user_id,
                    'detail'          => $post['detail'],
                    'create_date'        => date('Y-m-d'),
                    'image_name'        => $client_file,
                    'is_enable'        => 1
                );
            $db_command = $this->Mdl_client->db_command($data_p_relation2, null, 'file_record_list');
            $pid3 = $this->db->insert_id();

            $this->db->trans_complete();


            if ($db_command) {
                if ($post['id'] > 0) {
                    $this->session->set_flashdata('update', 'your data successfully Updated');
                } else {
                    $this->session->set_flashdata('saved', 'your data successfully Saved');
                }
                redirect(base_url() . 'Client/file_detail/' . $personal_id, 'refresh');
            } else {
                $this->session->set_flashdata('Error', 'your data has not been saved');
                redirect(base_url() . 'Client/file_action/' . $personal_id, 'refresh');
            }
        }
    }

    //edit_client_submit
    public function edit_client_submit()
    {
        $post = $this->input->post();
        //personal Image
        $oldImg = $post['old_img'];
        $oldFiles = $post['old_files'];
        $newImg =  $_FILES['pic']['name'];
        // $newFiles =  $_FILES['docs']['name'];
        if ($newImg == TRUE) {
            $newImg = "guardprofile_" . time() . "_" . str_replace(' ', '-', $_FILES['pic']['name']);
            $config = [
                'file_name' => $newImg,
                'allowed_types' => 'gif|jpg|png|jpeg',
                'upload_path' => 'public_html/frontend/image/guard/'
            ];
            $this->upload->initialize($config);
            if ($this->upload->do_upload('pic')) {
                $this->upload->data();
                // var_dump(file_exists("public_html/frontend/image/guard/".$oldImg));
                // exit;
                if (file_exists("public_html/frontend/image/guard/" . $oldImg)) {

                    unlink("public_html/frontend/image/guard/" . $oldImg);
                }
            } else {
                $this->session->set_flashdata('Error', 'Image not uploaded');
                redirect(base_url() . 'Client/client_record', 'refresh');
            }
        } else {
            $newImg = $oldImg;
        }
       
        if (!empty($_FILES['docs']['name']) && count(array_filter($_FILES['docs']['name'])) > 0) {
          
            $filesCount = count($_FILES['docs']['name']); 
            for($i = 0; $i < $filesCount; $i++)
            { 
        // print_r($_FILES['docs']['name'][$i]);
        $_FILES['file']['name']     = "guardfile_" . time() . "_" . str_replace(' ', '-', $_FILES['docs']['name'][$i]); 
        $_FILES['file']['type']     = $_FILES['docs']['type'][$i]; 
        $_FILES['file']['tmp_name'] = $_FILES['docs']['tmp_name'][$i]; 
        $_FILES['file']['error']     = $_FILES['docs']['error'][$i]; 
        $_FILES['file']['size']     = $_FILES['docs']['size'][$i]; 
            $newname = "guardfile_" . time() . "_" . str_replace(' ', '-', $_FILES['docs']['name'][$i]);
            $config = [
                'file_name' => $newname,
                'allowed_types' => 'pdf|jpg|png|jpeg',
                'upload_path' => 'public_html/frontend/files/guard/'
            ];
            $this->upload->initialize($config);  
            $upload_file = $this->upload->do_upload('file');
            if($upload_file){
                $uploaded_files[]=$newname;
                if (file_exists("public_html/frontend/files/guard/" . $oldFiles)) {

                    unlink("public_html/frontend/files/guard/" . $oldFiles);
                }
            }else{
                $uploaded_files[]="";

            }

            
        }
        $files=json_encode($uploaded_files);
        // print_r($uploaded_files);exit;
        }else{
            $files=$oldFiles;
        }



        $data_p_relation =
            array(
                'file_no'          => $post['fileid'],
                'contact_no'          => $post['contact_no'],
                'nic_no'          => $post['nic_no'],
                'name'             => $post['name'],
                'f_name'          => $post['f_name'],
                'present_address'   => $post['present_address'],
                'permanent_address'   => $post['permanent_address'],
                'marital_status_id'   => $post['marital_status_id'],
                'sect_id'          => $post['sect_id'],
                'religion_id'        => $post['religion_id'],
                'status_id'        => $post['status_id'],
                'dob'        => $post['dob'],
                'education'        => $post['education'],
                'kin_name'        => $post['kin_name'],
                'kin_address'        => $post['kin_address'],
                'cheque'        => $post['terms_cond'],
                'company_no'        => $post['comp_no'],
                'enrollment_date'        => $post['enrollment_date'],
                'pic'        => $newImg,
                'documents'        => $files,
                 'weapon' =>$post['weapon'],
                 'client_id' =>$post['client'],
                    'dailywages' => $post['dailywages'],
            );
        // print_r($data_p_relation);exit;
        $db_command = $this->Mdl_client->db_command($data_p_relation, $post['id'], 'client_personal_list');
        if ($db_command) {
            $this->session->set_flashdata('update', 'your data successfully Updated');
            redirect(base_url() . 'Client/client_record', 'refresh');
        } else {
            $this->session->set_flashdata('Error', 'your data has not been Update');
            redirect(base_url() . 'Client/client_record', 'refresh');
        }
    }
    // //edit_client_submit
    //  public function edit_client_submit()
    // {

    //     $post = $this->input->post();
    //     $id = $this->uri->segment(3);
    // 	//Client Code  Generator


    // 		 $fileid=$post['fileid'];

    //         $name=$post['name'];
    //         $soname=$post['soname'];
    //         $email=$post['email'];
    //         $postal_address=$post['postal_address'];
    //         $contact1=$post['contact1'];
    //         $contact2=$post['contact2'];

    //         $this->db->trans_start(); // Query will be rolled back
    //         ////Client Personal Record

    // 		$data_p_relation =
    //             array
    //             (
    //                 'file_no'          => $fileid,
    //                 'name'             => $name,
    //                 'so_name'          => $soname,
    //                 'postal_address'   => $postal_address,
    //                 'contact1'         => $contact1,
    //                 'contact2'      	=> $contact2,
    //                 'email'         	=> $email,                  
    //                 'user_id'          => $user_id,
    //                 'branch_id'        => $branch_id,                  
    //                 //'is_enable'        => 1
    //             );
    //         $db_command = $this->Mdl_client->db_command($data_p_relation,$post['client_personal_id'],'client_personal_list');
    // 		$pid1 = $post['client_personal_id'];	

    // 		$this->db->trans_complete();


    //         if($db_command)
    //         {
    //             if($post['id'] > 0)
    //             {
    //                 $this->session->set_flashdata('update', 'your data successfully Updated');
    //             }else
    //             {
    //                 $this->session->set_flashdata('saved', 'your data successfully Saved');
    //             }
    //             redirect(base_url().'Client/client_action','refresh');
    //         }
    //         else
    //         {
    //             $this->session->set_flashdata('Error', 'your data has not been saved');
    //             redirect(base_url().'Client/client_action','refresh');

    //         }

    // }

    //Client Record Search
    public function search_by_client_record()
    {
        $data_post       = $this->input->post();
        //Admin Search
        if ($this->session->userdata('user_type') == '1') {
            $country_id = $data_post['country_id'];
            $city_id = $data_post['city_id'];
            $branch_id = $data_post['branch_id'];
            $fileid = $data_post['fileid'];
            $date = $data_post['date'];
            $name = $data_post['name'];
            $contact1 = $data_post['contact1'];

            $this->db->select('client_record_list.id as clt_id,client_record_list.*,client_personal_list.*,country_list.*,city_list.*,branch_list.*');
            $this->db->from('client_record_list');
            $this->db->join('client_personal_list', 'client_personal_list.id = client_record_list.client_personal_id');
            $this->db->join('login', 'login.id = client_record_list.user_id');
            $this->db->join('country_list', 'country_list.id = login.country_id');
            $this->db->join('city_list', 'city_list.id = login.city_id');
            $this->db->join('branch_list', 'branch_list.id = client_record_list.branch_id');

            if ($country_id > 0) {
                $this->db->where('country_list.id', $country_id);
            }
            if ($city_id > 0) {
                $this->db->where('city_list.id', $city_id);
            }
            if ($branch_id > 0) {
                $this->db->where('branch_list.id', $branch_id);
            }
            if ($fileid > 0) {
                $this->db->where('client_personal_list.file_no', $fileid);
            }
            if ($date > 0) {
                $this->db->where('client_record_list.mydate', $date);
            }
            if ($name > 0) {
                $this->db->where('client_personal_list.name', $name);
            }
            if ($contact1 > 0) {
                $this->db->where('client_personal_list.contact1', $contact1);
                $this->db->or_where('client_personal_list.contact2', $contact1);
            }
            $result = $this->db->get()->result();
        } //User Search
        else {
            $branch_id = $this->session->userdata('branch_id');
            $fileid = $data_post['fileid'];
            $date = $data_post['date'];
            $name = $data_post['name'];
            $contact1 = $data_post['contact1'];



            $this->db->select('client_record_list.id as clt_id,client_record_list.*,client_personal_list.*');
            $this->db->from('client_record_list');
            $this->db->join('client_personal_list', 'client_personal_list.id = client_record_list.client_personal_id');

            if ($fileid > 0) {
                $this->db->where('client_personal_list.file_no', $fileid);
            }
            if ($date > 0) {
                $this->db->where('client_record_list.mydate', $date);
            }
            if ($name > 0) {
                $this->db->where('client_personal_list.name', $name);
            }
            if ($contact1 > 0) {
                $this->db->where('client_personal_list.contact1', $contact1);
                $this->db->or_where('client_personal_list.contact2', $contact1);
            }
            $this->db->where('client_personal_list.branch_id', $branch_id);

            $result = $this->db->get()->result();

            //echo $this->db->last_query();
        }
        ?>
        <!--
		<div class="panel panel-default">
  
			<div class="panel-heading">
				<a data-toggle="collapse" data-target="#deal" href="#"> Results for Client Record</a>
			</div>
		  	<div id="deal" class="panel-body">
			-->

        <div class="space-2"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-header">
                            Result for Client Record
                        </div>
                        <div class="table-responsive ">
                            <table id="product-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>

                                        <th>File No.</th>
                                        <th>Client Code.</th>
                                        <th>Cottage No</th>
                                        <th>Floor</th>
                                        <th>C/O</th>
                                        <th>Cnic</th>
                                        <th>Nomine</th>
                                        <th>Relation</th>
                                        <th>Nomine Address</th>
                                        <th>Date</th>
                                        <th>Cash</th>
                                        <th>Loan</th>
                                        <th>Documentation</th>
                                        <th>Discount</th>
                                        <th>Total Cost</th>
                                        <th>Detail</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($result as $res) :

                                    ?>
                                        <tr>

                                            <td><?php echo $res->file_no; ?></td>
                                            <td><?php echo $res->client_code; ?></td>
                                            <td><?php echo $res->cottage_no; ?></td>
                                            <td><?php echo $res->floor; ?></td>
                                            <td><?php echo $res->co; ?></td>
                                            <td><?php echo $res->cnic; ?></td>
                                            <td><?php echo $res->nomine; ?></td>
                                            <td><?php echo $res->relation; ?></td>
                                            <td><?php echo $res->nomine_address; ?></td>
                                            <td><?php echo $res->mydate; ?></td>
                                            <td><?php echo $res->cash; ?></td>
                                            <td><?php echo $res->loan; ?></td>
                                            <td><?php echo $res->documentation; ?></td>
                                            <td><?php echo $res->discount; ?></td>


                                            <td><?php echo $res->total_cost; ?></td>


                                            <td>
                                                <a class="green btn-xs btn" target="_blank" href="<?php echo base_url('Client/view_client_detail/' . $res->clt_id . ''); ?>">
                                                    View Detail
                                                </a>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--</div>
		</div>-->
        <script type="text/javascript">
            jQuery(function($) {
                var oTable1 = $('#product-table').dataTable({
                    "aoColumns": [{
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": false
                        }
                    ]
                });
            });
        </script>
    <?php


    }

    //view_client_detail
    public function view_client_detail()
    {

        $client_record_id = $this->uri->segment(3);

        // Client Record By ID		
        $client_record = $this->Mdl_client->_get_client_record_byid($client_record_id);
        // print_r($client_record);exit;
        $data['client_record'] = $client_record;
        $data['content']  = 'Client/view_client_detail';
        $this->load->view('Template/template', $data);
    }




    //view_complete_client_detail
    public function view_complete_client_detail()
    {

        $client_personal_id = $this->uri->segment(3);

        // Client Record By ID		
        $client_record = $this->Mdl_client->_get_client_personal_record_byid($client_personal_id);
        $client_invoice_record = $this->Mdl_client->_get_client_invoice_record_byid($client_personal_id);
        $client_payment_record = $this->Mdl_client->_get_client_payment_record_byid($client_personal_id);
        $client_payment_total = $this->Mdl_client->_get_client_payment_total($client_personal_id);
        $client_discount_total = $this->Mdl_client->_get_client_discount_total($client_personal_id);
        $client_paid_total = $this->Mdl_client->_get_client_paid_total($client_personal_id);

        $data['client_record'] = $client_record;
        $data['client_invoice_record'] = $client_invoice_record;
        $data['client_payment_record'] = $client_payment_record;
        $data['client_payment_total'] = $client_payment_total;
        $data['client_paid_total'] = $client_paid_total;
        $data['client_discount_total'] = $client_discount_total;
        $data['content']  = 'Client/view_complete_client_detail';
        $this->load->view('Template/template', $data);
    }



    //view_order_slip
    public function view_payment_slip()
    {

        /*  $payment_id = $this->uri->segment(3);
        $client_personal_id = $this->uri->segment(4);
        
		// Client Record By ID		
        $client_record = $this->Mdl_client->_get_client_personal_record_byid($client_personal_id);
        $client_invoice_record = $this->Mdl_client->_get_client_invoice_record_byid($client_personal_id);
        $client_payment_record = $this->Mdl_client->_get_client_payment_record_byid($client_personal_id);
		$client_payment_total = $this->Mdl_client->_get_client_payment_total($client_personal_id);
		$client_discount_total = $this->Mdl_client->_get_client_discount_total($client_personal_id);
		$client_paid_total = $this->Mdl_client->_get_client_paid_total($client_personal_id);
		
		$data['client_record'] = $client_record; 
		$data['client_invoice_record'] = $client_invoice_record; 
		$data['client_payment_record'] = $client_payment_record; 
		$data['client_payment_total'] = $client_payment_total; 
		$data['client_paid_total'] = $client_paid_total; 
		$data['client_discount_total'] = $client_discount_total;  */
        //$data['content']  = 'Client/view_order_slip';
        $this->load->view('Client/view_order_slip_payment', $data);
    }


    //add_amount
    public function add_amount()
    {

        $client_personal_id = $this->uri->segment(3);

        // Client Record By ID		
        $client_record = $this->Mdl_client->_get_client_personal_record_byid($client_personal_id);
        $client_invoice_record = $this->Mdl_client->_get_client_invoice_record_byid($client_personal_id);

        $client_payment_record = $this->Mdl_client->_get_client_payment_record_byid($client_personal_id);
        $client_payment_total = $this->Mdl_client->_get_client_payment_total($client_personal_id);
        $client_discount_total = $this->Mdl_client->_get_client_discount_total($client_personal_id);
        $client_paid_total = $this->Mdl_client->_get_client_paid_total($client_personal_id);
        //echo $client_payment_total;exit;

        $data['client_record'] = $client_record;
        $data['client_invoice_record'] = $client_invoice_record;
        $data['client_payment_record'] = $client_payment_record;
        $data['client_payment_total'] = $client_payment_total;
        $data['client_paid_total'] = $client_paid_total;
        $data['client_discount_total'] = $client_discount_total;
        $data['content']  = 'Client/add_amount';
        $this->load->view('Template/template', $data);
    }


    //Client History Search
    public function search_by_client_history()
    {
        $data_post       = $this->input->post();
        //Admin Search
        if ($this->session->userdata('user_type') == '1') {
            $country_id = $data_post['country_id'];
            $city_id = $data_post['city_id'];
            $branch_id = $data_post['branch_id'];
            $fileid = $data_post['fileid'];
            $date = $data_post['date'];
            $name = $data_post['name'];
            $contact1 = $data_post['contact1'];

            $this->db->select('client_personal_list.id as cl_id,client_personal_list.*,country_list.*,city_list.*,branch_list.*');
            $this->db->from('client_personal_list');
            if ($country_id > 0) {
                $this->db->where('country_list.id', $country_id);
            }
            if ($city_id > 0) {
                $this->db->where('city_list.id', $city_id);
            }
            if ($branch_id > 0) {
                $this->db->where('branch_list.id', $branch_id);
            }
            if ($fileid > 0) {
                $this->db->where('client_personal_list.file_no', $fileid);
            }
            if ($mydate > 0) {

                $date = str_replace('/', '-', $mydate);
                $newDate =  date('Y-m-d', strtotime($date));
                $this->db->like('client_personal_list.created_date', $newDate);
            }
            if ($name > 0) {
                $this->db->where('client_personal_list.name', $name);
            }
            if ($email > 0) {
                $this->db->where('client_personal_list.email', $email);
            }
            if ($contact1 > 0) {
                $this->db->where('client_personal_list.contact1', $contact1);
                $this->db->or_where('client_personal_list.contact2', $contact1);
            }
            //$this->db->where('client_personal_list.branch_id',$branch_id);
            $this->db->join('login', 'login.id = client_personal_list.user_id');
            $this->db->join('country_list', 'country_list.id = login.country_id');
            $this->db->join('city_list', 'city_list.id = login.city_id');
            $this->db->join('branch_list', 'branch_list.id = client_personal_list.branch_id');
            $result = $this->db->get()->result();
        } //User Search
        else {
            $branch_id = $this->session->userdata('branch_id');
            $fileid = $data_post['fileid'];
            $mydate = $data_post['date'];
            $name = $data_post['name'];
            $email = $data_post['email'];
            $contact1 = $data_post['contact1'];



            $this->db->select('client_personal_list.id as cl_id,client_personal_list.*');
            $this->db->from('client_personal_list');

            if ($fileid > 0) {
                $this->db->where('client_personal_list.file_no', $fileid);
            }
            if ($mydate > 0) {

                $date = str_replace('/', '-', $mydate);
                $newDate =  date('Y-m-d', strtotime($date));
                $this->db->like('client_personal_list.created_date', $newDate);
            }
            if ($name > 0) {
                $this->db->where('client_personal_list.name', $name);
            }
            if ($email > 0) {
                $this->db->where('client_personal_list.email', $email);
            }
            if ($contact1 > 0) {
                $this->db->where('client_personal_list.contact1', $contact1);
                $this->db->or_where('client_personal_list.contact2', $contact1);
            }
            $this->db->where('client_personal_list.branch_id', $branch_id);

            $result = $this->db->get()->result();

            //echo $this->db->last_query();
        }
    ?>
        <!--
		<div class="panel panel-default">
  
			<div class="panel-heading">
				<a data-toggle="collapse" data-target="#deal" href="#"> Results for Client Record</a>
			</div>
		  	<div id="deal" class="panel-body">
			-->

        <div class="space-2"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-header">
                            Result for Client History
                        </div>
                        <div class="table-responsive ">
                            <table id="product-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>

                                        <th>File No.</th>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Amount</th>
                                        <th>Detail</th>

                                        <th>Attachment</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($result as $res) :

                                    ?>
                                        <tr>

                                            <td><?php echo $res->file_no; ?></td>
                                            <td><?php echo $res->name; ?></td>
                                            <td><?php echo $res->contact1 . ", " . $res->contact2; ?></td>
                                            <td>
                                                <a class="green btn-success btn-xs btn" target="_blank" href="<?php echo base_url('Client/add_amount/' . $res->cl_id . ''); ?>">
                                                    Add Amount
                                                </a>
                                            </td>
                                            <td>
                                                <a class="green btn-xs btn" target="_blank" href="<?php echo base_url('Client/view_complete_client_detail/' . $res->cl_id . ''); ?>">
                                                    View Detail
                                                </a>
                                            </td>
                                            <!--<td>
                                            <a class="green btn-xs btn" target="_blank" href="<?php echo base_url('Client/edit_client_detail/' . $res->cl_id . ''); ?>">
												Edit
                                            </a>
                                        </td>-->
                                            <td>
                                                <a class="green btn-success btn-xs btn" target="_blank" href="<?php echo base_url('Client/file_detail/' . $res->cl_id . ''); ?>">
                                                    Go to
                                                </a>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--</div>
		</div>-->
        <script type="text/javascript">
            jQuery(function($) {
                var oTable1 = $('#product-table').dataTable({
                    "aoColumns": [{
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": false
                        }
                    ]
                });
            });
        </script>
    <?php


    }


    //Success List Client 
    public function success()
    {
        //$data['result_set'] = $this->Mdl_client->_this_controller_record_customer_distribution(); 
        $data['content']  = 'Client/success';
        $this->load->view('Template/template', $data);
    }


    function getfrequency($code)
    {
        switch ($code) {
            case '1':
                return 'Monthly';
            case '3':
                return 'Quarterly';
            case '6':
                return 'Half Yearly';
            case '12':
                return 'Annual';
        }
        return false;
    }


    //Payment Receiving Search
    public function payment_receiving()
    {
        //$data['result_set'] = $this->Mdl_client->_this_controller_record_customer_distribution(); 
        $data['content']  = 'Client/payment_receiving';
        $this->load->view('Template/template', $data);
    }


    //Payment Receiving Search
    public function payment_receiving_search()
    {

        $data_post       = $this->input->post();
        //print_r($data_post);

        $search_payment      = $data_post['search_payment_input'];
        $result_payment =  $this->Mdl_client->_payment_receiving_search($search_payment);
        //echo "<pre>";
        //print_r($result_payment);
        //exit;

    ?>
        <div class="space-2"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-header">
                            Results for Payment Receiving
                        </div>
                        <div class="table-responsive sample-table-5">
                            <table id="payment_table" class="table table-striped table-responsive table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center">
                                            <!--<label>
                                            <input type="checkbox" id="select_all_mailing" class="ace" />
                                            <span class="lbl"></span>
                                            </label>  -->
                                        </th>
                                        <th>Cust Id </th>
                                        <th>Phone No </th>
                                        <th>Registration Date </th>
                                        <th>Name</th>
                                        <th>Postal Address</th>
                                        <th>Category</th>

                                        <th>No. of Copies</th>
                                        <th>Total Amount</th>
                                        <th>Payment Type</th>
                                        <th>Payment Status</th>
                                        <th>Receipt No/Slip No</th>
                                        <th>Payment Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($result_payment as $fc) :

                                        $category_name = $this->Mdl_client->get_relation_pax('category_list', 'title', 'id', $fc->category_id);
                                        $distribution_name = $this->Mdl_client->get_relation_pax('distribution_channel', 'title', 'id', $fc->dis_channel_id);
                                        $currency_name = $this->Mdl_client->get_relation_pax('currency_list', 'code', 'id', $fc->currency_id);
                                    ?>
                                        <tr>
                                            <td class="center">
                                                <!--<label>
                                                <input type="checkbox" name="checkbox_<?php  //echo $fc->inv_id; 
                                                                                        ?>" id="checkbox_<?php  //echo $fc->inv_id; 
                                                                                                                                    ?>" class="ace count_quantity" />
                                                <span class="lbl"></span>
                                                </label>-->

                                                <?php
                                                if ($fc->payment_status == 0) {
                                                ?>
                                                    <input type="hidden" name="customer_id[]" id="customer_id" value="<?php echo $fc->id; ?>" />

                                                    <label>
                                                        <input type="checkbox" name="checkbox_customer[]" id="checkbox_customer" value="<?php echo $fc->id; ?>" class="ace checkbox checkbox_customer_payment" />
                                                        <span class="lbl"></span>
                                                    </label>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $fc->customer_code; ?></td>
                                            <td><?php echo $fc->mobile_no; ?></td>
                                            <td><?php echo $fc->created_date; ?></td>
                                            <td><?php echo $fc->name; ?></td>
                                            <td><?php echo $fc->postal_address; ?></td>

                                            <td><?php echo $category_name; ?></td>

                                            <td><?php echo $fc->noofcopy; ?> </td>
                                            <td><?php echo $currency_name . ' ' . (($fc->amount + $fc->shipping) * $fc->noofcopy); ?> </td>
                                            <td><?php
                                                if ($fc->payment_type == "bank") {
                                                    echo '<span class="btn btn-sm" style="padding:0px 10px;" title="Bank">Bank</span>';
                                                } else {
                                                    echo '<span class="btn btn-warning btn-sm tooltip-warning" title="Cash" style="padding:0px 10px;">Cash</span>';
                                                }

                                                ?> </td>
                                            <td><?php //echo $fc->payment_status; 

                                                if ($fc->payment_status == 1) {
                                                    echo '<span class="btn btn-success btn-sm" style="padding:0px 10px;" title="Received">Received</span>';
                                                } else {
                                                    echo '<span class="btn btn-danger btn-sm" title="Pending" style="padding:0px 10px;">Pending</span>';
                                                }


                                                ?> </td>
                                            <td>
                                                <?php
                                                if ($fc->payment_status == 0) {
                                                ?>
                                                    <input type="text" name="slip_no[<?php echo $fc->id; ?>]" id="slip_no" value="<?php //echo $fc->id; 
                                                                                                                                    ?>" class="col-xs-3 col-sm-12" />
                                                <?php
                                                } else {

                                                    echo $fc->receipt_no;
                                                }
                                                ?>

                                            </td>

                                            <td>
                                                <?php
                                                if ($fc->payment_status == 0) {
                                                ?>
                                                    <div class="clearfix">
                                                        <input type="date" name="payment_date[<?php echo $fc->id; ?>]" id="payment_date" value="<?php //echo $fc->id; 
                                                                                                                                                ?>" class="date-picker col-xs-3 col-sm-9" placeholder="Payment Date" data-date-Productat="yyyy-mm-dd" />
                                                    </div>
                                                <?php
                                                } else {
                                                    echo $fc->payment_date;
                                                }
                                                ?>

                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix Client-actions" style="text-align: center;">
            <div class="col-md-6"></div>
            <div class="col-md-3">
                <!--<button class="btn pull-right btn-info btn-validate" name="submit_all" type="submit">
                <i class="icon-ok bigger-110"></i>
                Submit All
                </button>-->
            </div>
            <div class="col-md-3">
                <button class="btn pull-right btn-info btn-validate payment_receiving_submit" disabled name="submit_selected" type="submit">
                    <i class="icon-ok bigger-110"></i>
                    Received
                </button>
                <!--
                &nbsp; &nbsp; &nbsp;
                <button class="btn" type="reset">
                <i class="icon-undo bigger-110"></i>
                Cancel
                </button>-->
            </div>
        </div>
        <script type="text/javascript">
            jQuery(function($) {
                var oTable1 = $('#payment_table').dataTable({
                    "aoColumns": [{
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": false
                        }
                    ]
                });
            });
        </script>
    <?php



    }


    //Payment Submit
    public function payment_submit123()
    {
        $data_post = $this->input->post();
        //echo "<pre>";
        //print_r($data_post);
        foreach ($data_post['checkbox_customer'] as $chk) {

            $mobile_no = $this->Mdl_client->get_relation_pax('customer', 'mobile_no', 'id', $chk);
            $shipping = $this->Mdl_client->get_relation_pax('customer', 'shipping', 'id', $chk);
            $amount = $this->Mdl_client->get_relation_pax('customer', 'amount', 'id', $chk);
            $noofcopy = $this->Mdl_client->get_relation_pax('customer', 'noofcopy', 'id', $chk);
            $customer_code = $this->Mdl_client->get_relation_pax('customer', 'customer_code', 'id', $chk);


            $total_amount = ($amount + $shipping) * $noofcopy;


            $search_char = substr($mobile_no, 0, 2);
            if ($search_char == "92") {
                $sms_num = $post['mobile_no'];
            } else {
                $new_no = substr($mobile_no, 1);
                $sms_num = "92" . $new_no;
            }

            $msg_payment = 'Thanks for the Registration with Mahnama Faizan-e-madinah.Your Payment Rs.' . $total_amount . ' against ID ' . $customer_code . ' has been received successfully.';

            //$msg = 'Dawateislami Testing Server​​.';

            $this->actionSms($sms_num, urlencode($msg_payment));


            //echo $chk."<br/>";
            $data_customer = array(
                'payment_status' => 1
            );
            $db_command =  $this->Mdl_client->db_command($data_customer, $chk, 'customer');
        }

        foreach ($data_post['slip_no'] as $slp_key => $slp_val) {
            $data_customer = array(
                'receipt_no' => $slp_val
            );
            $db_command =  $this->Mdl_client->db_command($data_customer, $slp_key, 'customer');
        }

        foreach ($data_post['payment_date'] as $slp_keys => $slp_vals) {
            $payment_date = "";
            if (!empty($slp_vals)) {
                $payment_date = $slp_vals;
            } else {
                $payment_date = date("Y-m-d");
            }
            $data_customer = array(
                'payment_date' => $payment_date
            );
            $db_command =  $this->Mdl_client->db_command($data_customer, $slp_keys, 'customer');
        }


        $this->session->set_flashdata('update', 'your payment has been received successfully');
        redirect(base_url() . "Client/payment_receiving", 'refresh');
    }

    //Send SMS API
    public function actionSms($number, $msg)
    {
        $mask = "InfoSMS";
        $user = "1289";
        $password = "attar";
        //$destination = '923343161260';
        //$message = urlencode('This is testing for.');
        $post_data = "user=" . $user . "&pwd=" . $password . "&mask=" . $mask . "&text=" . $msg . "&dest=" . $number . "";    //post string
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://api.capitalsms.com/sentadd.asp?" . $post_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: application/x-www-Client-urlencoded'));
        echo $result = curl_exec($ch);
    }

    //Mailing List Client 
    public function mailing_list()
    {
        //$data['result_set'] = $this->Mdl_client->_this_controller_record_customer_distribution(); 
        $data['content']  = 'Client/mailing_list';
        $this->load->view('Template/template', $data);
    }

    //Mailing Lsit 
    public function get_customer_mailing_list()
    {
        $data_post       = $this->input->post();
        //print_r($data_post);

        $trans_code      = $data_post['trans_code'];
        $trans_date      = $data_post['date_mailing'];
        $product_id      = $data_post['product_id'];
        $location_id      = $data_post['location_id'];
        //echo "<pre>";
        //print_r($data_post);
        //exit;

        $this->db->select('inv_distribution.id as inv_id,inv_distribution.trans_code,inv_distribution.trans_date,customer.*,customer.id,customer.name,customer.email,customer.noofcopy,customer.category_id,inv_distribution.product_id,inv_distribution.location_id');
        if ($trans_code > 0) {
            $this->db->where('inv_distribution.trans_code', $trans_code);
        }
        if ($trans_date > 0) {
            $this->db->where('inv_distribution.trans_date', $trans_date);
        }
        if ($product_id > 0) {
            $this->db->where('inv_distribution.product_id', $product_id);
        }
        if ($location_id > 0) {
            $this->db->where('inv_distribution.location_id', $location_id);
        }
        $this->db->where('dispatch_status', 0);
        $this->db->from('inv_distribution');
        $this->db->join('customer', 'customer.id = inv_distribution.customer_id');

        $result = $this->db->get();


        if ($result->num_rows() > 0) {
            $filtered_customer = $result->result();
        }


    ?>
        <div class="space-2"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-header">
                            Results for Mailing List
                        </div>
                        <div class="table-responsive sample-table-5">
                            <table id="mailing_table" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center">
                                            <!--<label>
                                            <input type="checkbox" id="select_all_mailing" class="ace" />
                                            <span class="lbl"></span>
                                            </label>-->
                                        </th>
                                        <th>Cust Id </th>
                                        <th>Phone No </th>
                                        <th>Registration Date </th>
                                        <th>Name</th>
                                        <th>Postal Address</th>
                                        <th>Client </th>
                                        <th>Location </th>
                                        <th>No. of Copies</th>
                                        <th>View/Print</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($filtered_customer as $fc) :

                                        $product_name = $this->Mdl_client->get_relation_pax('product_list', 'title', 'id', $fc->product_id);
                                        $location_name = $this->Mdl_client->get_relation_pax('location_list', 'title', 'id', $fc->location_id);
                                    ?>
                                        <tr>
                                            <td class="center">
                                                <!--<label>
                                                <input type="checkbox" name="checkbox_<?php  //echo $fc->inv_id; 
                                                                                        ?>" id="checkbox_<?php  //echo $fc->inv_id; 
                                                                                                                                    ?>" class="ace count_quantity" />
                                                <span class="lbl"></span>
                                                </label>-->
                                                <input type="hidden" name="inv_id[]" id="inv_id" value="<?php echo $fc->inv_id; ?>" />

                                                <label>
                                                    <input type="checkbox" name="checkbox_mailing[]" id="checkbox_mailing" value="<?php echo $fc->inv_id; ?>" class="ace checkbox" />
                                                    <span class="lbl"></span>
                                                </label>

                                            </td>

                                            <td><?php echo $fc->customer_code; ?></td>
                                            <td><?php echo $fc->mobile_no; ?></td>
                                            <td><?php echo $fc->created_date; ?></td>
                                            <td><?php echo $fc->name; ?></td>
                                            <td><?php echo $fc->shipping_address; ?></td>

                                            <td><?php echo $product_name; ?></td>
                                            <td><?php echo $location_name; ?></td>
                                            <td><?php echo $fc->noofcopy; ?> </td>
                                            <td>
                                                <a href="<?php echo base_url('Client/print_card/' . $fc->inv_id . ''); ?>" class="tooltip-error" data-rel="tooltip" title="View" target="_blank">
                                                    <span class="purple">
                                                        <i class="icon-eye-open bigger-120"></i>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix Client-actions" style="text-align: center;">
            <div class="col-md-6"></div>
            <div class="col-md-3">
                <button class="btn pull-right btn-info btn-validate" name="submit_all" type="submit">
                    <i class="icon-ok bigger-110"></i>
                    Generate All
                </button>
            </div>
            <div class="col-md-3">
                <button class="btn pull-right btn-info btn-validate" name="submit_selected" type="submit">
                    <i class="icon-ok bigger-110"></i>
                    Generate Selected
                </button>
                <!--
                &nbsp; &nbsp; &nbsp;
                <button class="btn" type="reset">
                <i class="icon-undo bigger-110"></i>
                Cancel
                </button>-->
            </div>
        </div>
        <script type="text/javascript">
            jQuery(function($) {
                var oTable1 = $('#mailing_table').dataTable({
                    "aoColumns": [{
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": false
                        }
                    ]
                });
            });
        </script>
    <?php

    }



    //Dispatch Lsit 
    public function get_customer_dispatch_list()
    {
        $data_post       = $this->input->post();
        //print_r($data_post);

        $trans_code      = $data_post['trans_code'];
        $trans_date      = $data_post['date_mailing'];
        $product_id      = $data_post['product_id'];
        $location_id      = $data_post['location_id'];
        //echo "<pre>";
        //print_r($data_post);
        //exit;

        $this->db->select('inv_distribution.id as inv_id,inv_distribution.trans_code,inv_distribution.trans_date,customer.id,customer.*,customer.name,customer.email,customer.noofcopy,customer.category_id,inv_distribution.product_id,inv_distribution.location_id');
        if ($trans_code > 0) {
            $this->db->where('inv_distribution.trans_code', $trans_code);
        }
        if ($trans_date > 0) {
            $this->db->where('inv_distribution.trans_date', $trans_date);
        }
        if ($product_id > 0) {
            $this->db->where('inv_distribution.product_id', $product_id);
        }
        if ($location_id > 0) {
            $this->db->where('inv_distribution.location_id', $location_id);
        }
        $this->db->where('dispatch_status', 0);
        $this->db->from('inv_distribution');
        $this->db->join('customer', 'customer.id = inv_distribution.customer_id');

        $result = $this->db->get();


        if ($result->num_rows() > 0) {
            $filtered_customer = $result->result();
        }


    ?>
        <div class="space-2"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-header">
                            Results for Dispatch List
                        </div>
                        <div class="table-responsive sample-table-5">
                            <table id="dispatch_table" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center">
                                            <label>
                                                <input type="checkbox" class="ace" id="ckbCheckAllDispatch" />
                                                <span class="lbl"></span>
                                            </label>
                                        </th>
                                        <th>Cust Id </th>
                                        <th>Phone No </th>
                                        <th>Registration Date </th>
                                        <th>Name</th>
                                        <th>Postal Address</th>
                                        <th>Client </th>
                                        <th>Location </th>
                                        <th>No. of Copies</th>
                                        <!--<th>View/Print</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($filtered_customer as $fc) :

                                        $product_name = $this->Mdl_client->get_relation_pax('product_list', 'title', 'id', $fc->product_id);
                                        $location_name = $this->Mdl_client->get_relation_pax('location_list', 'title', 'id', $fc->location_id);
                                    ?>
                                        <tr>
                                            <td class="center">
                                                <!--<label>
                                                <input type="checkbox" name="checkbox_<?php  //echo $fc->inv_id; 
                                                                                        ?>" id="checkbox_<?php  //echo $fc->inv_id; 
                                                                                                                                    ?>" class="ace count_quantity" />
                                                <span class="lbl"></span>
                                                </label>-->
                                                <input type="hidden" name="inv_id[]" id="inv_id" value="<?php echo $fc->inv_id; ?>" />

                                                <label>
                                                    <input type="checkbox" name="checkbox_dispatch[]" id="checkbox_dispatch" value="<?php echo $fc->inv_id; ?>" class="ace checkbox dispatch_quantity" />
                                                    <span class="lbl"></span>
                                                </label>

                                            </td>

                                            <td><?php echo $fc->customer_code; ?></td>
                                            <td><?php echo $fc->mobile_no; ?></td>
                                            <td><?php echo $fc->created_date; ?></td>
                                            <td><?php echo $fc->name; ?></td>
                                            <td><?php echo $fc->shipping_address; ?></td>

                                            <td><?php echo $product_name; ?></td>
                                            <td><?php echo $location_name; ?></td>
                                            <td><?php echo $fc->noofcopy; ?> </td>
                                            <!--<td>
                                                <a href="<?php //echo base_url('Client/print_card/'.$fc->inv_id.''); 
                                                            ?>" class="tooltip-error" data-rel="tooltip" title="View" target="_blank" >
                                                    <span class="purple">
                                                        <i class="icon-eye-open bigger-120"></i>
                                                    </span>
                                                </a>
                                            </td>-->
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--<div class="clearfix Client-actions" style="text-align: center;">
            <div class="col-md-6"></div>
            <div class="col-md-3">
                <button class="btn pull-right btn-info btn-validate" name="submit_all" type="submit">
                    <i class="icon-ok bigger-110"></i>
                    Generate All
                </button>
            </div>
            <div class="col-md-3">
                <button class="btn pull-right btn-info btn-validate" name="submit_selected" type="submit">
                    <i class="icon-ok bigger-110"></i>
                    Generate Selected
                </button>
                
            </div>
        </div>-->
        <div class="clearfix Client-actions" style="text-align: center;">
            <div class="col-md-12 ">
                <button class="btn pull-right btn-info btn-validate dispatch_sub" disabled type="submit">
                    <i class="icon-ok bigger-110"></i>
                    Submit
                </button>

                &nbsp; &nbsp; &nbsp;
                <!--<button class="btn" type="reset">
                                    <i class="icon-undo bigger-110"></i>
                                    Cancel
                                    </button>-->
            </div>
        </div>
        <script type="text/javascript">
            jQuery(function($) {
                var oTable1 = $('#dispatch_table').dataTable({
                    "aoColumns": [{
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": false
                        }
                    ]
                });
            });
        </script>
    <?php

    }

    //Dispatch Submit
    public function dispatch_submit()
    {
        $data_post = $this->input->post();
        // echo "<pre>";
        //print_r($data_post);
        //exit;
        $get_customer_data = array();
        $customer_id_get = '';
        $quantity_get = 0;
        $dispatch_quantity_get = 0;
        $final_dispatch_quantity = 0;
        foreach ($data_post['checkbox_dispatch'] as $chk) {

            //$mobile_no = $this->Mdl_client->get_relation_pax('customer','mobile_no','id',$chk);

            /* $search_char = substr($mobile_no, 0, 2);			
            if($search_char == "92")
            {
            $sms_num = $post['mobile_no'];
            }
            else
            {
            $new_no = substr($mobile_no,1);
            $sms_num = "92".$new_no;
            }			

            $msg = 'Dawateislami Testing Server​​.';

            $this->actionSms($sms_num,urlencode($msg)); */


            // echo $chk."<br/>";

            //Quantity ID
            $quantity_id_get = $this->Mdl_client->get_relation_pax('inv_distribution', 'quantity', 'id', $chk);


            //Customer ID
            $customer_id_get = $this->Mdl_client->get_relation_pax('inv_distribution', 'customer_id', 'id', $chk);

            //Dispatch Quantity Get
            $dispatch_quantity_get = $this->Mdl_client->get_relation_pax('customer', 'dispatch_quantity', 'id', $customer_id_get);

            $final_dispatch_quantity = $quantity_id_get + $dispatch_quantity_get;


            //print_r($get_customer_data);

            $data_inv = array(
                'dispatch_status' => 1
            );
            $db_command =  $this->Mdl_client->db_command($data_inv, $chk, 'inv_distribution');


            $data_customer = array(
                'dispatch_quantity' => $final_dispatch_quantity
            );
            $db_command =  $this->Mdl_client->db_command($data_customer, $customer_id_get, 'customer');
        }
        unset($get_customer_data);
        //exit;

        $this->session->set_flashdata('update', 'your packed has been dispatch successfully');
        redirect(base_url() . "Client/dispatch_list", 'refresh');
    }


    //Print Card Mailing List
    public function print_card()
    {

        $id  = $this->uri->segment(3);

        if ($id != null) {
            if ($id  == 0) {
                $this->session->set_flashdata('Invalid Customer ID', 'Sorry system could not find any token related to this Customer ID <i class="icon-eye-open"></i>!');
                redirect(base_url() . 'Client/mailing_list', 'refresh');
            } else {
                $this->db->where('id', $id);
                $distribution = $this->db->get('inv_distribution')->result();

                $this->db->where('id', $distribution[0]->customer_id);
                $filtered_customer = $this->db->get('customer')->result();
                $city_name = $this->Mdl_client->get_relation_pax('city_list', 'title', 'id', $filtered_customer[0]->city_id);
                $location_name = $this->Mdl_client->get_relation_pax('location_list', 'title', 'id', $distribution[0]->location_id);
                //echo "<pre>";
                //print_r($distribution);
                //print_r($filtered_customer);
                //exit;

                $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

                $pdf->SetTitle('Print Card');

                $image_logo   = 'public_html/assets/images/logo.jpg';
                $pdf->SetHeaderMargin(2);
                $pdf->SetTopMargin(20);
                $pdf->SetLeftMargin(10);
                $pdf->SetRightMargin(10);
                $pdf->setFooterMargin(20);
                $pdf->SetPrintHeader(false);
                $pdf->SetPrintFooter(false);
                $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
                $pdf->SetAuthor('Author');
                $pdf->SetDisplayMode('real', 'default');

                $pdf->AddPage('P');
                $count = 0;
                $pdf->Ln(0);
                $pdf->SetFont('times', '', 25, true);
                //$pdf->SetFont('dejavusans', '', 25,true);
                //Output Html
                $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
                $pdf->Image($image_logo, 15,   15, 20, 20, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

                $tbl = '
                <div style="border:1px solid" >
                <table cellspacing="0" width="100%" cellpadding="3" border="" style="font-weight:900; font-size:11px;text-align:justify;">
                <tr >
                <td width="100%" height="50px"  align="center" ><p style="font-size:30px;color:green;font-weight:bolder;text-shadow:2px 2px 4px #000000;" >Dawat-e-Islami</p></td>
                <td width="0" align="right"></td>
                </tr>
                <tr>

                <td width="25%" align="right">Name:</td>
                <td width="75%">' . $filtered_customer[0]->name . '</td>
                </tr>
                <tr>
                <td width="25%" align="right">Address:</td>
                <td width="75%">' . $filtered_customer[0]->postal_address . '</td>
                </tr>
                <tr>
                <td width="25%" align="right">Phone No:</td>
                <td width="75%">' . $filtered_customer[0]->mobile_no . '</td>
                </tr>
                <tr>
                <td width="25%" align="right">Origin:</td>
                <td width="75%">' . $location_name . '</td>
                </tr>
                <tr>
                <td width="25%" align="right">Trans. Ref.:</td>
                <td width="75%">' . $distribution[0]->trans_code . '</td>
                </tr>
				<tr>
                <td width="25%" align="right">No. of Copies:</td>
                <td width="75%">' . $distribution[0]->quantity . '</td>
                </tr>

                </table>
                </div>';
                $pdf->writeHTML($tbl, true, false, false, false, '');
                $pdf->Output('My-File-Name.pdf', 'I');
            }
        }
        $data['content']  = 'Client/mailing_list';
        $this->load->view('Template/template', $data);
    }


    //Generate Card Single & All
    public function generate_card()
    {
        //Single Card
        if (isset($_POST['submit_selected'])) {
            $data_post = $this->input->post();

            /* if(count($data_post['checkbox_mailing'])  == 0)
            {
            $this->session->set_flashdata('Invalid Customer ID', 'Sorry system could not find any token related to this Customer ID <i class="icon-eye-open"></i>!'); 
            redirect(base_url().'Client/mailing_list','refresh');   
            }
            else
            { */

            $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
            $pdf->SetTitle('Print Card');
            $image_logo   = 'public_html/assets/images/logo.jpg';
            $pdf->SetHeaderMargin(2);
            $pdf->SetTopMargin(20);
            $pdf->SetLeftMargin(10);
            $pdf->SetRightMargin(10);
            $pdf->setFooterMargin(20);
            $pdf->SetPrintHeader(false);
            $pdf->SetPrintFooter(false);
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            $pdf->SetAuthor('Author');
            $pdf->SetDisplayMode('real', 'default');

            ini_set('max_execution_time', 900);
            $page_Productat = array(
                'MediaBox' => array('llx' => 0, 'lly' => 0, 'urx' => 210, 'ury' => 210),
                'Dur' => 3,
                'trans' => array(
                    'D' => 1.5,
                    'S' => 'Split',
                    'Dm' => 'V',
                    'M' => 'O'
                ),
                'Rotate' => 0,
                'PZ' => 1,
            );

            foreach ($data_post['checkbox_mailing'] as $chk) {
                $this->db->where('id', $chk);
                $distribution = $this->db->get('inv_distribution')->result();

                $this->db->where('id', $distribution[0]->customer_id);
                $filtered_customer = $this->db->get('customer')->result();
                $city_name = $this->Mdl_client->get_relation_pax('city_list', 'title', 'id', $filtered_customer[0]->city_id);
                $location_name = $this->Mdl_client->get_relation_pax('location_list', 'title', 'id', $distribution[0]->location_id);


                $pdf->AddPage('P');
                $count = 0;
                $pdf->Ln(0);
                $pdf->SetFont('times', '', 25, true);
                //$pdf->SetFont('dejavusans', '', 25,true);
                //Output Html
                $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
                $pdf->Image($image_logo, 15,   15, 20, 20, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

                $tbl = '
                <div style="border:1px solid" >
                <table cellspacing="0" width="100%" cellpadding="3" border="" style="font-weight:900; font-size:11px;text-align:justify;">
                <tr >
                <td width="100%" height="50px"  align="center" ><p style="font-size:30px;color:green;font-weight:bolder;text-shadow:2px 2px 4px #000000;" >Dawat-e-Islami</p></td>
                <td width="0%" align="right"></td>
                </tr>
                <tr>

                <td width="25%" align="right">Name:</td>
                <td width="75%">' . $filtered_customer[0]->name . '</td>
                </tr>
                <tr>
                <td width="25%" align="right">Address:</td>
                <td width="75%">' . $filtered_customer[0]->postal_address . '</td>
                </tr>
                <tr>
                <td width="25%" align="right">Phone No:</td>
                <td width="75%">' . $filtered_customer[0]->mobile_no . '</td>
                </tr>
                <tr>
                <td width="25%" align="right">Origin:</td>
                <td width="75%">' . $location_name . '</td>
                </tr>
                <tr>
                <td width="25%" align="right">Trans. Ref.:</td>
                <td width="75%">' . $distribution[0]->trans_code . '</td>
                </tr>
				<tr>
                <td width="25%" align="right">No. of Copies:</td>
                <td width="75%">' . $distribution[0]->quantity . '</td>
                </tr>
				

                </table>
                </div>';
                $pdf->writeHTML($tbl, true, false, false, false, '');
            }

            $pdf->Output('My-File-Name.pdf', 'I');

            /* } */
        } //All Submit
        else if (isset($_POST['submit_all'])) {
            $data_post = $this->input->post();
            $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
            $pdf->SetTitle('Print Card');
            $image_logo   = 'public_html/assets/images/logo.jpg';
            $pdf->SetHeaderMargin(2);
            $pdf->SetTopMargin(20);
            $pdf->SetLeftMargin(10);
            $pdf->SetRightMargin(10);
            $pdf->setFooterMargin(20);
            $pdf->SetPrintHeader(false);
            $pdf->SetPrintFooter(false);
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            $pdf->SetAuthor('Author');
            $pdf->SetDisplayMode('real', 'default');

            ini_set('max_execution_time', 900);
            $page_Productat = array(
                'MediaBox' => array('llx' => 0, 'lly' => 0, 'urx' => 210, 'ury' => 210),
                'Dur' => 3,
                'trans' => array(
                    'D' => 1.5,
                    'S' => 'Split',
                    'Dm' => 'V',
                    'M' => 'O'
                ),
                'Rotate' => 0,
                'PZ' => 1,
            );

            foreach ($data_post['inv_id'] as $chk) {
                $this->db->where('id', $chk);
                $distribution = $this->db->get('inv_distribution')->result();

                $this->db->where('id', $distribution[0]->customer_id);
                $filtered_customer = $this->db->get('customer')->result();
                $city_name = $this->Mdl_client->get_relation_pax('city_list', 'title', 'id', $filtered_customer[0]->city_id);
                $location_name = $this->Mdl_client->get_relation_pax('location_list', 'title', 'id', $distribution[0]->location_id);


                $pdf->AddPage('P');
                $count = 0;
                $pdf->Ln(0);
                $pdf->SetFont('times', '', 25, true);
                //$pdf->SetFont('dejavusans', '', 25,true);
                //Output Html
                $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
                $pdf->Image($image_logo, 15,   15, 20, 20, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

                $tbl = '
                <div style="border:1px solid" >
                <table cellspacing="0" width="100%" cellpadding="3" border="" style="font-weight:900; font-size:11px;text-align:justify;">
                <tr >
                <td width="100%" height="50px"  align="center" ><p style="font-size:30px;color:green;font-weight:bolder;text-shadow:2px 2px 4px #000000;" >Dawat-e-Islami</p></td>
                <td width="0%" align="right"></td>
                </tr>
                <tr>

                <td width="25%" align="right">Name:</td>
                <td width="75%">' . $filtered_customer[0]->name . '</td>
                </tr>
                <tr>
                <td width="25%" align="right">Address:</td>
                <td width="75%">' . $filtered_customer[0]->postal_address . '</td>
                </tr>
                <tr>
                <td width="25%" align="right">Phone No:</td>
                <td width="75%">' . $filtered_customer[0]->mobile_no . '</td>
                </tr>
                <tr>
                <td width="25%" align="right">Origin:</td>
                <td width="75%">' . $location_name . '</td>
                </tr>
                <tr>
                <td width="25%" align="right">Trans. Ref.:</td>
                <td width="75%">' . $distribution[0]->trans_code . '</td>
                </tr>
				<tr>
                <td width="25%" align="right">No. of Copies:</td>
                <td width="75%">' . $distribution[0]->quantity . '</td>
                </tr>

                </table>
                </div>';

                $pdf->writeHTML($tbl, true, false, false, false, '');
            }

            $pdf->Output('My-File-Name.pdf', 'I');
        }
    }

    public function command()
    {
        //Inventory Action
        if (isset($_POST['save_inventory'])) {
            $post = $this->input->post();
            if ($post['date'] == "") {
                $data['trans_date']            = date("Y-m-d");
            } else {
                $data['trans_date']            = $post['date'];
            }
            $data['product_id']         = $post['product_id'];
            $data['quantity']        = $post['qty'];
            $data['location_id']        = $post['location_id'];

            $db_command =  $this->Mdl_client->db_command($data, $post['id'], 'inv_receiving');
            if ($db_command) {
                if ($post['id'] != null) {
                    $this->session->set_flashdata('update', 'your data successfully Updated');
                } else {
                    $this->session->set_flashdata('saved', 'your data successfully Saved');
                }

                redirect(base_url() . 'Client/inventory_receiving', 'refresh');
            }
        } else {
            /*  $post = $this->input->post();
            if($post['status']){$is_enable = 1;}else{$is_enable = 0;}      
            $data['email']        = $post['email']; 
            $data['username']     = $post['username']; 
            $data['mobile_no']     = $post['mobile_no']; 
            $data['markaz_id']     = $post['markaz_id'];
            if($post['password'])
            {
            $data['password']     =   Modules::run('Login/_hash',$post['password']); #$this->Mdl_login->hash($post['password']); 
            }
            $data['is_enable']    = $is_enable;
            $data['user_type']    = 0;
            $data['ip_address']   = $this->input->ip_address();
            if(empty($post['markaz_id'])){
            $data['user_type']    = 0;
            }
            if($this->session->userdata('markaz_id')){
            $data['user_type']    = 3;
            $data['markaz_id'] = $this->session->userdata('markaz_id');
            }
            else{
            $data['user_type']    = 2;
            }
            $db_command =  $this->Mdl_users->db_command($data,$post['id'],'login');
            if($db_command)
            {
            if($post['id'] != null)
            {
            $this->session->set_flashdata('update', 'your data successfully Updated');  
            }else
            {
            $this->session->set_flashdata('saved', 'your data successfully Saved');    
            }

            redirect(base_url().'Users','refresh');  
            }  */
        }
    }



    //Dispatch List Client
    public function dispatch_list()
    {
        //$data['result_set'] = $this->Mdl_client->_this_controller_record_customer_distribution(); 
        $data['content']  = 'Client/dispatch';
        $this->load->view('Template/template', $data);
    }

    //Recent SMS List Client
    public function resend_sms()
    {
        //$data['result_set'] = $this->Mdl_client->_this_controller_record_customer_distribution(); 
        $data['content']  = 'Client/resend_sms';
        $this->load->view('Template/template', $data);
    }


    //Recent SMS Search
    public function recent_sms_search()
    {

        $data_post       = $this->input->post();
        //print_r($data_post);

        $search_payment      = $data_post['search_sms_input'];
        $result_payment =  $this->Mdl_client->_payment_receiving_search($search_payment);
        //echo "<pre>";
        //print_r($result_payment);
        //exit;

    ?>
        <div class="space-2"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-header">
                            Results for Recent SMS
                        </div>
                        <div class="table-responsive sample-table-5">
                            <table id="payment_table" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center">
                                            <!--<label>
                                            <input type="checkbox" id="select_all_mailing" class="ace" />
                                            <span class="lbl"></span>
                                            </label>  -->
                                        </th>
                                        <th>Cust Id </th>
                                        <th>Phone No </th>
                                        <th>Registration Date </th>
                                        <th>Name</th>
                                        <th>Postal Address</th>
                                        <th>Category</th>

                                        <th>No. of Copies</th>
                                        <th>Total Amount</th>
                                        <th>Payment Type</th>
                                        <th>Payment Status</th>
                                        <!--<th>Receipt No/Slip No</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($result_payment as $fc) :

                                        $category_name = $this->Mdl_client->get_relation_pax('category_list', 'title', 'id', $fc->category_id);
                                        $distribution_name = $this->Mdl_client->get_relation_pax('distribution_channel', 'title', 'id', $fc->dis_channel_id);
                                        $currency_name = $this->Mdl_client->get_relation_pax('currency_list', 'code', 'id', $fc->currency_id);
                                    ?>
                                        <tr>
                                            <td class="center">
                                                <!--<label>
                                                <input type="checkbox" name="checkbox_<?php  //echo $fc->inv_id; 
                                                                                        ?>" id="checkbox_<?php  //echo $fc->inv_id; 
                                                                                                                                    ?>" class="ace count_quantity" />
                                                <span class="lbl"></span>
                                                </label>-->

                                                <?php
                                                // if($fc->payment_status == 0)
                                                // {
                                                ?>
                                                <input type="hidden" name="customer_id[]" id="customer_id" value="<?php echo $fc->id; ?>" />

                                                <label>
                                                    <input type="checkbox" name="checkbox_sms[]" id="checkbox_sms" value="<?php echo $fc->id; ?>" class="ace checkbox checkbox_sms_customer" />
                                                    <span class="lbl"></span>
                                                </label>
                                                <?php
                                                // }
                                                ?>
                                            </td>
                                            <td><?php echo $fc->customer_code; ?></td>
                                            <td><?php echo $fc->mobile_no; ?></td>
                                            <td><?php echo $fc->created_date; ?></td>
                                            <td><?php echo $fc->name; ?></td>
                                            <td><?php echo $fc->postal_address; ?></td>

                                            <td><?php echo $category_name; ?></td>

                                            <td><?php echo $fc->noofcopy; ?> </td>
                                            <td><?php echo $currency_name . ' ' . (($fc->amount + $fc->shipping) * $fc->noofcopy); ?> </td>
                                            <td><?php
                                                if ($fc->payment_type == "bank") {
                                                    echo '<span class="btn btn-sm" style="padding:0px 10px;" title="Bank">Bank</span>';
                                                } else {
                                                    echo '<span class="btn btn-warning btn-sm tooltip-warning" title="Cash" style="padding:0px 10px;">Cash</span>';
                                                }

                                                ?> </td>
                                            <td><?php //echo $fc->payment_status; 

                                                if ($fc->payment_status == 1) {
                                                    echo '<span class="btn btn-success btn-sm" style="padding:0px 10px;" title="Received">Received</span>';
                                                } else {
                                                    echo '<span class="btn btn-danger btn-sm" title="Pending" style="padding:0px 10px;">Pending</span>';
                                                }


                                                ?> </td>
                                            <!--<td>
											 <?php
                                                // if($fc->payment_status == 0)
                                                //{
                                                ?>
											 <input type="text" name="slip_no[<?php //echo $fc->id; 
                                                                                ?>]" id="slip_no" value="<?php //echo $fc->id; 
                                                                                                                                ?>" class="" />
											 <?php
                                                //}
                                                //else
                                                //{
                                                ?>
												<input type="text" name="slip_no" readonly id="slip_no" value="<?php //echo $fc->receipt_no; 
                                                                                                                ?>" class="" />
											<?php
                                            //}
                                            ?>
											 
											</td>-->

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix Client-actions" style="text-align: center;">
            <div class="col-md-6"></div>
            <div class="col-md-3">
                <div class="clearfix">
                    <select name="sms_type" class="col-xs-12 col-sm-12 sms_type" id="sms_type" disabled required placeholder="SMS Type">
                        <option value="">Select SMS Type</option>
                        <option value="registration">Registration</option>
                        <option value="payment">Payment Received</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <button class="btn pull-right btn-info btn-validate payment_sms_submit" disabled name="submit_selected" type="submit">
                    <i class="icon-ok bigger-110"></i>
                    Send SMS
                </button>
                <!--
                &nbsp; &nbsp; &nbsp;
                <button class="btn" type="reset">
                <i class="icon-undo bigger-110"></i>
                Cancel
                </button>-->
            </div>
        </div>
        <script type="text/javascript">
            jQuery(function($) {
                var oTable1 = $('#payment_table').dataTable({
                    "aoColumns": [{
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": true
                        },
                        {
                            "bSortable": false
                        }
                    ]
                });
            });
        </script>
<?php



    }

    //Recent SMS Submit
    public function recent_sms_submit()
    {
        $data_post = $this->input->post();
        //echo "<pre>";
        //print_r($data_post);
        //exit;
        foreach ($data_post['checkbox_sms'] as $chk) {

            $mobile_no = $this->Mdl_client->get_relation_pax('customer', 'mobile_no', 'id', $chk);

            // $mobile_no = $this->Mdl_client->get_relation_pax('customer','mobile_no','id',$chk);
            $shipping = $this->Mdl_client->get_relation_pax('customer', 'shipping', 'id', $chk);
            $amount = $this->Mdl_client->get_relation_pax('customer', 'amount', 'id', $chk);
            $noofcopy = $this->Mdl_client->get_relation_pax('customer', 'noofcopy', 'id', $chk);
            $customer_code = $this->Mdl_client->get_relation_pax('customer', 'customer_code', 'id', $chk);


            $total_amount = ($amount + $shipping) * $noofcopy;


            $search_char = substr($mobile_no, 0, 2);
            if ($search_char == "92") {
                $sms_num = $post['mobile_no'];
            } else {
                $new_no = substr($mobile_no, 1);
                $sms_num = "92" . $new_no;
            }


            //Registration Type
            if ($data_post['sms_type'] == "registration") {
                $msg = 'Mahnama Sub:Deposit Rs.' . $total_amount . ' to BANK:MCB BR.CODE:0037 Title:DAWAT E ISLAMI TRUST-MAHNAMA A/C#0779283171003236 *Mention Cust.ID:' . $customer_code . ' in Deposit Slip.';
                //$this->actionSms($sms_num,urlencode($msg));	

            } //Payment SMS
            else if ($data_post['sms_type'] == "payment") {
                $msg_payment = 'Thanks for the Registration with Mahnama Faizan-e-madinah.Your Payment Rs.' . $total_amount . ' against ID ' . $customer_code . ' has been received successfully.';
                //$this->actionSms($sms_num,urlencode($msg_payment));		
            }
        }

        $this->session->set_flashdata('update', 'your SMS has been send successfully');
        redirect(base_url() . "Client/resend_sms", 'refresh');
    }


    //Check USer Exit
    public function check_user_exists()
    {
        $post    =  $this->input->post();
        $username    =  $post['username'];
        $id     =  $post['id'];
        $cmd_return         =  $this->Mdl_client->_get_single_record_byusername($username, $id);
        $_return['_return'] =  $cmd_return;
        $return = json_encode($_return);
        echo $return;
    }

    //Check Email Exit
    public function check_email_exists()
    {
        $post               =  $this->input->post();
        $email           =  $post['email'];
        $id                 =  $post['id'];
        $cmd_return         =  $this->Mdl_client->_get_single_record_byemail($email, $id);

        $_return['_return'] =  $cmd_return;

        $return = json_encode($_return);
        echo $return;
    }

    //Check Phone Exit
    public function check_phone_exists()
    {
        $post               =  $this->input->post();
        $mobile_no           =  $post['mobile_no'];
        $id                 =  $post['id'];
        $cmd_return         =  $this->Mdl_client->_get_single_record_byphone($mobile_no, $id);

        $_return['_return'] =  $cmd_return;

        $return = json_encode($_return);
        echo $return;
    }

    //get Category Price
    public function get_category_channel_list()
    {
        $category_id         =  $this->input->post('category_id');
        $dis_channel_id         =  $this->input->post('dis_channel_id');
        $noc         =  $this->input->post('noc');
        $data = $this->Mdl_client->_get_category_channel_list($category_id, $dis_channel_id);



        if ($data[0]->rate > 0) {
            $currency = $this->Mdl_client->get_relation_pax('currency_list', 'code', 'id', $data[0]->currency_id);
            $prc = $currency . ' ' . $data[0]->rate . ' per copy for 12 Months';

            $total_price = ($data[0]->rate + $data[0]->shipping) *  $noc;

            $res = array(
                'price' => $prc,
                'total_price' => $currency . ' ' . $total_price
            );

            echo json_encode($res);
        } else {
            $res = array(
                'total' => '1'

            );

            echo json_encode($res);
        }
    }



    public function change_user_status()
    {
        $post               =  $this->input->post();
        $id                 =  $post['id'];
        $status             =  $post['status'];

        $_return['_return'] =  $this->Mdl_ulama->_change_user_status($id, $status);
        $return             = json_encode($_return);
        echo $return;
    }

    //Get Sub Category List
    public function get_subcategory_byid()
    {
        $search_cat_id         =  $this->input->post('search_cat_id');
        $data['result_set'] = $this->Mdl_client->sub_category_list($search_cat_id);
        foreach ($data['result_set'] as $key => $value) :
            $option .= '<option value = ' . $key . ' >' . $value . '</option>';
        endforeach;
        echo $option;
    }

    //Get Client By ID
    public function get_product_byid()
    {
        $search_cat_id         =  $this->input->post('search_cat_id');
        $scat_id         =  $this->input->post('scat_id');
        $_return['_return'] = $this->Mdl_client->_get_single_product_byCategory($search_cat_id, $scat_id);
        $return             = json_encode($_return);
        echo $return;
    }


    public function delete($id)
    {
        $delete = $this->Mdl_client->_delete($id);
        if ($delete == 1) {
            $this->session->set_flashdata('delete', 'your data successfully Deleted!');
        } else {
            $this->session->set_flashdata('error', 'No record found for Deleting !');
        }
        redirect(base_url() . 'Client/product_list', 'refresh');
    }

    //Change Category Status
    public function change_category_status()
    {
        $post               =  $this->input->post();
        $id                 =  $post['id'];
        $status             =  $post['status'];

        $_return['_return'] =  $this->Mdl_client->_change_category_status($id, $status);
        $return             = json_encode($_return);
        echo $return;
    }

    //Change Client Status
    public function change_product_status()
    {
        $post               =  $this->input->post();
        $seller_id                 =  $post['seller_id'];
        $id                 =  $post['id'];
        $status             =  $post['status'];

        $_return['_return'] =  $this->Mdl_client->_change_product_status($id, $status);
        if ($_return['_return'] == 1) {
            //Active Account
            if ($status == 0) {
                $seller_detail = $this->Mdl_client->_this_seller_controller_record($seller_id);
                $from_email1 = $this->session->userdata('email');
                $to_email1 = $seller_detail[0]->email;
                //Load email library
                $get_link1 = base_url() . "admin";
                $username = $seller_detail[0]->username;
                $msg1 = "Dear " . $$username . "<br/>Your Client has been Active at Online Shopping";
                $msg1 .= "<br/><a href='" . $get_link1 . "' >CLICK HERE</a> to login your account and view your products.<br/>Thank you";
                $this->email->from($from_email1, 'Online Shopping');
                $this->email->to($to_email1);
                $this->email->subject('Seller Client Active at Online Shopping');
                $this->email->message($msg1);
                $this->email->send();
            } //Unactive Account
            else {
                $seller_detail = $this->Mdl_client->_this_seller_controller_record($seller_id);
                $from_email1 = $this->session->userdata('email');
                $to_email1 = $seller_detail[0]->email;
                //Load email library
                $get_link1 = base_url() . "admin";
                $username = $seller_detail[0]->username;
                $msg1 = "Dear " . $$username . "<br/>Your Client has been De-Active at Online Shopping";
                $msg1 .= "<br/>please contact site admin.<br/>Thank you";
                $this->email->from($from_email1, 'Online Shopping');
                $this->email->to($to_email1);
                $this->email->subject('Seller Client DeActive at Online Shopping');
                $this->email->message($msg1);
                $this->email->send();
            }
            // print_r($seller_detail);
            //  exit;
            $return             = json_encode($_return);
            echo $return;
        } else {
            $return             = json_encode($_return);
            echo $return;
        }
    }

    //Change Discount Status
    public function change_discount_status()
    {
        $post               =  $this->input->post();
        $id                 =  $post['id'];
        $status             =  $post['status'];

        $_return['_return'] =  $this->Mdl_client->_change_discount_status($id, $status);
        $return             = json_encode($_return);
        echo $return;
    }
}
