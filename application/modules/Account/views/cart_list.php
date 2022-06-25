<div class="page-content">
    <div class="page-header">
        <h1>
            Cart Management
            <small>
                <i class="icon-double-angle-right"></i>
                Cart List
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


            <div class="row">
                <div class="col-xs-12">

                    <div class="table-header">
                        Results for Cart List

                    </div>

                    <div class="table-responsive">
                        <table id="cart_list_table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>

                                    <th>Date</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>

                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                //print_r($result_set);
                                foreach($result_set as $key => $row) { ?>

                                    <tr>
                                        <td><?php echo $row->cart_date;?></td>
                                        <td><?php //echo $row->username;
                                            $product_image = $this->Mdl_Account->get_relation_pax('product_list','product_image','id',$row->product_id);

                                            if($product_image != "")
                                            {
                                                $image_pic = "public_html/frontend/image/product/" .$product_image;
                                                //echo $image_pic;
                                                if(file_exists($image_pic))
                                                {
                                                    $img_url = "public_html/frontend/image/product/" . $product_image;
                                                }
                                                else
                                                {
                                                    $img_url = 'public_html/frontend/image/default_product.jpg';
                                                }
                                            }
                                            else
                                            {
                                                $img_url = 'public_html/frontend/image/default_product.jpg';
                                            }

                                            ?>
                                            <img class="img-responsive" style="height:50px;width:50px;" src="<?php echo  base_url().$img_url;?>" />


                                            </td>
                                        <td><?php
                                            $product_name = $this->Mdl_Account->get_relation_pax('product_list','product_name','id',$row->product_id);
                                            echo $product_name;

                                            ?></td>
                                        <td><?php echo $row->cart_price;?></td>
                                        <td><?php echo $row->cart_qty;?></td>
                                        <td><?php echo ($row->cart_qty*$row->cart_price);?></td>



                                        <td>
                                           <?php

                                           if($row->cart_status == "complete")
                                           {
                                               echo '<span class="btn btn-success btn-sm" style="padding:0px 10px;" title="Active">Complete</span>';
                                           }
                                           else if($row->cart_status == "pending")
                                           {
                                               echo '<span class="btn btn-danger btn-sm" title="Un-Active" style="padding:0px 10px;">Pending</span>';
                                           }
                                           else if($row->cart_status == "dispatch")
                                           {
                                               echo '<span class="btn btn-danger btn-sm" title="Un-Active" style="padding:0px 10px;">Dispatch</span>';
                                           }


                                           ?>
                                        </td>

                                  </tr>


                                    <?php } ?>




                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>


