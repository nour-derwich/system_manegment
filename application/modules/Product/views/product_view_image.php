<?php
$category_dd         = Modules::run('Hierarchy/category_dd');
?>
<div class="page-content">
    <div class="page-header">
        <h1>
            Product Management
            <small>
                <i class="icon-double-angle-right"></i>
                Product View Image
            </small>
            <a href="<?php echo base_url('Product/product_list'); ?>" class="pull-right btn bigger-50 ws-btn-font  btn-success">List View</a>
            <i class="icon-spinner icon-spin orange bigger-125 hide"></i>
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

            <div class="table-header">
              Images of Product <?php echo $view_image[0]->product_name; ?>
          </div>

            <div class="table-responsive">
                <table id="product-image" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>

                        <th>Product Image </th>
                        <th>Featured Image</th>

                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td><?php

                            if($view_image[0]->product_image != "")
                            {
                                $image_pic = "public_html/frontend/image/product/" .$view_image[0]->product_image;
                                //echo $image_pic;
                                if(file_exists($image_pic))
                                {
                                    $img_url = "public_html/frontend/image/product/" . $view_image[0]->product_image;
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
                            <img class="img-responsive" style="height:100px;width:100px;" src="<?php echo  base_url().$img_url;?>" title="<?php echo $view_image[0]->product_name_;?>" alt="<?php echo $view_image[0]->product_name_;?>" />

                            <?php

                            //echo $view_image[0]->product_image; ?></td>
                        <td><?php //echo $view_image[0]->featured_image;
                            if($view_image[0]->featured_image!="")
                            {
                                $single_image = explode(',', $view_image[0]->featured_image);
                                foreach ($single_image as $img)
                                {

                                    $image_pic_inner = "public_html/frontend/image/product/" . $img;
                                    //echo $image_pic;
                                    if(file_exists($image_pic_inner))
                                    {
                                        $img_url_inner = $image_pic_inner;
                                    }
                                    else
                                    {
                                        $img_url_inner = 'public_html/frontend/image/no_image.png';
                                    }

                                    //  echo $img . "<br/>";
                                    ?>

                                        <img class="img-responsive" style="height:100px;width:100px;" src="<?php echo  base_url().$img_url_inner;?>"
                                             title="<?php echo $view_image[0]->product_name_;?>" alt="<?php echo $view_image[0]->product_name_;?>"/>

                                        <br/>
                                <?php
                                }


                            }


                            ?></td>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>