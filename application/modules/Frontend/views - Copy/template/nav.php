    <div class="clearfix col-md-3">

	
	
	
	
	
	
	
	  <?php
	   echo "<ul class='dropdown-menu dropdown-menu-category dropdown-menu-category-hold dropdown-menu-category-sm'>";
        // print_r($category);
        //Category List
        foreach($category as $cat)
        {

            $cat_name =  $cat->category_name;
            $cat_id =  $cat->id;
            $p_cat_id =  $cat->parent_category_id;
            $cat_image =  $cat->category_image;
            $final_url=base_url().addunderscores(strtolower($cat_name)).".html";
           // echo '<li><a href="'.$final_url.'">'.$cat_name.'</a>';

		    echo "
 <li><a href='".$final_url."'><i class='fa fa-home dropdown-menu-category-icon'></i>".ucwords($cat_name)."</a>";
 
 
            $sub_category = $this->Mdl_frontend->get_sub_category($cat_id);
            //print_r($sub_category);
            if($sub_category > 0)
            {
                //echo '<span class="down"></span> <ul>';
                
				                echo "
                <div class='dropdown-menu-category-section'>
            <div class='dropdown-menu-category-section-inner''>
                <div class='dropdown-menu-category-section-content'>
                    <div class='row'>
                        <div class='col-md-6'>
                            <h5 class='dropdown-menu-category-title'>".ucwords($cat_name)."</h5>
                            <ul class='dropdown-menu-category-list'>
";


				foreach ($sub_category as $scat) {
                    $scat_name = $scat->category_name;
                    $scat_id = $scat->id;
                    $p_scat_id = $scat->parent_category_id;
                    $scat_image = $scat->category_image;
                    $final_url1=base_url().addunderscores(strtolower($cat_name)).'/'.addunderscores(strtolower($scat_name)).".html";
                  //  echo ' <li><a href="'.$final_url1.'">' . ucwords($scat_name) . '</a></li>';
                             echo "

<li><a href='".$final_url1."'>".ucwords($scat_name)."</a>
 
</li>";
//<p>".ucwords($stag)."</p>
				}
               
                echo "
</ul>
                </div>
                </div>
                  </div>
                </div>
                  </div>
                </li>
";
            }
            echo "</li>";


        }
 echo "</ul>";
        ?>
	
    </div>