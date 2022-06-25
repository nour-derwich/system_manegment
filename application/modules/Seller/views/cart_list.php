<div class="page-content">
    <div class="page-header">
        <h1>
            Seller Management
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
                                    <th>Name</th>
                                    <th>Price</th>

                                    <th>Quantity</th>
                                    <th>Total</th>
                                  
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                //print_r($result_set);
                                foreach($result_set as $key => $row) { ?>

                                    <tr>
                                        <td><?php echo $row->cart_date;?></td>
                                       
                                        <td><?php
                                            $product_name = $this->Mdl_seller->get_relation_pax('product_list','product_name','id',$row->product_id);
                                            echo $product_name;

                                            ?></td>
                                        <td>Rs. <?php echo $row->product_price;?></td>
                                        <td><?php echo $row->qty;?></td>
                                        <td>Rs. <?php echo ($row->total_price);?></td>


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


