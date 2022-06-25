<?php 
if($result_set){$row = $result_set;} 
$id = $this->session->userdata('id');
$user_type = $this->session->userdata('user_type');
$country_id = $this->session->userdata('country_id');
$load              = $this->Mdl_hierarchy;
// $markaz_dd         = Modules::run('Hierarchy/markaz_dd');
//print_r($row);
?>
<div class="page-content">
    <div class="page-header">
        <h1>
            Account Management
            <small>
                <i class="icon-double-angle-right"></i>
                My Account
            </small> 


        </h1>
    </div><!-- /.page-header -->
    <?php
    if($this->session->flashdata())
    {
        foreach($this->session->flashdata() as $key => $value):
            if($key == 'update' || $key == 'saved')
            {
                $alert_class = 'alert-success';
            }else
            {
                $alert_class = 'alert-danger';
            }
            ?>
            <div class="alert alert-block <?php echo $alert_class; ?>">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="icon-remove"></i>
                </button>

                <p>
                    <strong>
                        <i class="icon-ok"></i>
                        <?php echo ucwords(strtolower($key)); ?> !
                    </strong>
                    <?php echo $value; ?>

                </p>


            </div>
        <?php
        endforeach;
    }  ?>


    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <?php
            $attributes = array(  
                'class' => 'form-horizontal form-validate', 
                'id'    => 'register-form', 
                'role'  => 'form'
            );
            echo form_open(base_url('MyAccount/command'), $attributes);
            ?>
            <input type="hidden" name="id" id="id" value="<?php echo $id ?>">





            <div class="space-2"></div>     
            <?php //if($this->session->userdata('user_type') == 1):?>
            <!--<div class="form-group">
            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Markaz Name:</label>
            <div class="col-xs-12 col-sm-9">
            <div class="clearfix">

            <?php
            /* echo form_dropdown(
            'markaz_id',
            $markaz_dd,$row[0]->markaz_id,
            'class  ="col-xs-12 col-sm-6 required-field "
            id     ="markaz_id" placeholder="Markaz"'); */
            ?>

            </div>
            </div>
            </div>
            <div class="space-2"></div>-->
            <?php //endif;?>

            <?php
            if($this->session->userdata('user_type') == 'seller')
            {
                ?>

                <fieldset id="account">
                    <legend>Your Personal Details</legend>
                    <div class="errorTxt"></div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">First Name:</label>

                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <input type="text" id="firstname" value="<?php echo $row[0]->firstname; ?>" name="firstname"
                                       placeholder="First Name" class="col-xs-12 col-sm-6 required-field"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Last Name:</label>

                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <input type="text" id="lastname" value="<?php echo $row[0]->lastname; ?>" name="lastname"
                                       placeholder="Last Name" class="col-xs-12 col-sm-6 required-field"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">E-Mail:</label>

                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <input type="email" id="email" value="<?php echo $row[0]->email; ?>" name="email"
                                       placeholder="E-Mail" class="col-xs-12 col-sm-6 required-field"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Telephone:</label>

                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <input type="text" id="telephone" value="<?php echo $row[0]->telephone; ?>" name="telephone"
                                       placeholder="Telephone" class="col-xs-12 col-sm-6 required-field"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Mobile No:</label>

                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <input type="text" id="mobile" value="<?php echo $row[0]->mobile; ?>" name="mobile"
                                       placeholder="Mobile No" class="col-xs-12 col-sm-6 required-field"/>
                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Gender:</label>

                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <select id="gender" name="gender" placeholder="Gender" class="col-xs-10 col-sm-6 required-field">
                                    <option value="">Please Select</option>
                                    <option value="male" <?php if($row[0]->gender == "male"){ echo "selected"; }?>> Male</option>
                                    <option value="female" <?php if($row[0]->gender == "female"){ echo "selected"; }?>> Female</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </fieldset>

                <fieldset>
                    <legend>Your Address Details</legend>

                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Company:</label>

                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <input type="text" id="company" value="<?php echo $row[0]->company; ?>" name="company"
                                       placeholder="Company" class="col-xs-12 col-sm-6 required-field"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Address:</label>

                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <textarea rows="4" class="col-xs-12 col-sm-6 required-field" id="address" placeholder="Address" name="address"><?php echo $row[0]->address; ?></textarea>

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Region / State:</label>

                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <?php
                                echo form_dropdown
                                (
                                    'state_id',
                                    $state_dd,$row[0]->state_id,
                                    'class	= "col-xs-10 col-sm-6 city_get"
			                        id     	= "state_id" placeholder="Region / State"');
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">City:</label>

                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <select id="city_id" name="city_id" placeholder="City" class="col-xs-10 col-sm-6 city_id required-field">
                                  <?php if($row[0]->city_id != ""){
                                      $city_name = $this->Mdl_myaccount->get_relation_pax('city_list','title','id',$row[0]->city_id);
                                      ?>
                                      <option value="<?php echo $row[0]->city_id; ?>"> <?php echo $city_name; ?></option>
                                    <?php
                                  }?>


                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Postal Code:</label>

                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <input type="text" id="postal_code" value="<?php echo $row[0]->postal_code; ?>" name="postal_code"
                                       placeholder="Postal Code" class="col-xs-12 col-sm-6 required-field"/>
                            </div>
                        </div>
                    </div>


                </fieldset>

                <fieldset>
                    <legend>Your Account Details</legend>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">User Name:</label>

                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <input type="text" old-username="<?php echo $row[0]->username; ?>" readonly id="username"
                                       value="<?php echo $row[0]->username; ?>" name="username" placeholder="User name"
                                       class="col-xs-12 col-sm-6 required-field"/>
                            </div>
                        </div>
                    </div>

                    <div class="space-2"></div>
                    <?php if ($id != null) { ?>
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Change
                                Password:</label>

                            <div class="col-xs-12 col-sm-9">
                                <div class="clearfix">
                                    <label class=" inline">
                                        <input id="changepassword" name="changepassword" type="checkbox" value="0"
                                               class="ace ace-switch ace-switch-5"/>
                                        <span class="lbl"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="space-2"></div>

                    <?php } ?>

                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Password:</label>

                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <input type="password" <?php if ($id != null) {
                                    echo 'disabled="disabled"';
                                } ?> id="password" name="password" placeholder="Password" class="col-xs-12 col-sm-6"/>
                            </div>
                        </div>
                    </div>
                    <div class="space-2"></div>

                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Confirm
                            Password:</label>

                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <input type="password" id="retypepassword" <?php if ($id != null) {
                                    echo 'disabled="disabled"';
                                } ?> name="retypepassword" placeholder="Confirm Password" class="col-xs-12 col-sm-6"/>
                            </div>
                        </div>
                    </div>
                    <div class="space-2"></div>


                </fieldset>


                <div class="space-2"></div>






                <div class="clearfix form-actions">
                    <div class="col-md-offset-6 col-md-3">
                        <button class="btn btn-info btn-validate" type="submit">
                            <i class="icon-ok bigger-110"></i>
                            Process
                        </button>

                        <!--         &nbsp; &nbsp; &nbsp;
                        <button class="btn" type="reset">
                        <i class="icon-undo bigger-110"></i>
                        Reset
                        </button>-->
                    </div>
                </div>

            <?php
            }
            else {
                ?>


                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">User Name:</label>

                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <input type="text" old-username="<?php echo $row[0]->username; ?>" readonly id="username"
                                   value="<?php echo $row[0]->username; ?>" name="username" placeholder="User name"
                                   class="col-xs-12 col-sm-6 required-field"/>
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>

                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Email:</label>

                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <input type="email" id="email" value="<?php echo $row[0]->email; ?>" name="email"
                                   placeholder="example@example.com" class="col-xs-12 col-sm-6 required-field"/>
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>

                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Mobile No:</label>

                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <input type="text" id="mobile_no" value="<?php echo $row[0]->mobile_no; ?>" name="mobile_no"
                                   placeholder="9999-999999999" class="col-xs-12 col-sm-6 required-field"/>
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <?php if ($id != null) { ?>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Change
                            Password:</label>

                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <label class=" inline">
                                    <input id="changepassword" name="changepassword" type="checkbox" value="0"
                                           class="ace ace-switch ace-switch-5"/>
                                    <span class="lbl"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="space-2"></div>

                <?php } ?>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Password:</label>

                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <input type="password" <?php if ($id != null) {
                                echo 'disabled="disabled"';
                            } ?> id="password" name="password" placeholder="Password" class="col-xs-12 col-sm-6"/>
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>

                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Confirm
                        Password:</label>

                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <input type="password" id="retypepassword" <?php if ($id != null) {
                                echo 'disabled="disabled"';
                            } ?> name="retypepassword" placeholder="Confirm Password" class="col-xs-12 col-sm-6"/>
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>

               <div class="clearfix form-actions">
                    <div class="col-md-offset-6 col-md-3">
                        <button class="btn btn-info btn-validate" type="submit">
                            <i class="icon-ok bigger-110"></i>
                            Process
                        </button>

                        <!--         &nbsp; &nbsp; &nbsp;
                        <button class="btn" type="reset">
                        <i class="icon-undo bigger-110"></i>
                        Reset
                        </button>-->
                    </div>
                </div>

            <?php
            }
        ?>



            <?php echo form_close();  ?>
            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->




</div>