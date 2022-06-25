<?php
$controller = $this->uri->segment(1);
?>
</div><!-- /.main-content -->

<!--<div class="ace-settings-container" id="ace-settings-container">
<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
<i class="icon-cog bigger-150"></i>
</div>

<div class="ace-settings-box" id="ace-settings-box">
<div>
<div class="pull-left">
<select id="skin-colorpicker" class="hide">
<option data-skin="default" value="#438EB9">#438EB9</option>
<option data-skin="skin-1" value="#222A2D">#222A2D</option>
<option data-skin="skin-2" value="#C6487E">#C6487E</option>
<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
</select>
</div>
<span>&nbsp; Choose Skin</span>
</div>

<div>
<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
</div>

<div>
<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
</div>

<div>
<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
</div>

<div>
<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
</div>

<div>
<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
<label class="lbl" for="ace-settings-add-container">
Inside
<b>.container</b>
</label>
</div>
</div>
</div>--><!-- /#ace-settings-container -->
</div><!-- /.main-container-inner -->

<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
    <i class="icon-double-angle-up icon-only bigger-110"></i>
</a>
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->



<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
window.jQuery || document.write("<script src='<?php echo base_url('public_html/assets/js/jquery-1.10.2.min.js')?>assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

<script type="text/javascript">
    if("ontouchend" in document) document.write("<script src='<?php echo base_url('public_html/assets/js/jquery.mobile.custom.min.js')?>'>"+"<"+"/script>");
</script>
<script src="<?php echo base_url('public_html/assets/js/bootstrap.min.js')?>">              </script>
<script src="<?php echo base_url('public_html/assets/js/typeahead-bs2.min.js')?>">          </script>

<!-- page specific plugin scripts -->
<script src="<?php echo base_url('public_html/assets/js/jquery.easy-pie-chart.min.js')?>"></script>
<script src="<?php echo base_url('public_html/assets/js/fuelux/data/fuelux.tree-sampledata.js')?>"></script>
<script src="<?php echo base_url('public_html/assets/js/fuelux/fuelux.tree.min.js')?>"></script>
<script src="<?php echo base_url('public_html/assets/js/fuelux/fuelux.wizard.min.js')?>">   </script>
<script src="<?php echo base_url('public_html/assets/js/jquery.validate.min.js')?>">        </script>
<script src="<?php echo base_url('public_html/assets/js/additional-methods.min.js')?>">     </script>
<script src="<?php echo base_url('public_html/assets/js/bootbox.min.js')?>">                </script>  
<script src="<?php echo base_url('public_html/assets/js/jquery.maskedinput.min.js')?>">     </script>
<script src="<?php echo base_url('public_html/assets/js/jquery.dataTables.min.js')?>">      </script>
<script src="<?php echo base_url('public_html/assets/js/jquery.dataTables.bootstrap.js')?>"></script>    
<script src="<?php echo base_url('public_html/assets/js/jquery.gritter.min.js')?>"></script>    
<script src="<?php echo base_url('public_html/assets/js/spin.min.js')?>"></script>
<script src="<?php echo base_url('public_html/assets/js/bootstrap-wysiwyg.min.js')?>"></script>

<!-- page specific plugin scripts -->

<script src="<?php echo base_url('public_html/assets/js/jquery-ui-1.10.3.custom.min.js')?>"></script>
<script src="<?php echo base_url('public_html/assets/js/jquery.ui.touch-punch.min.js')?>"></script>
<script src="<?php echo base_url('public_html/assets/js/markdown/markdown.min.js')?>"></script>
<script src="<?php echo base_url('public_html/assets/js/markdown/bootstrap-markdown.min.js')?>"></script>
<script src="<?php echo base_url('public_html/assets/js/jquery.hotkeys.min.js')?>"></script>
<script src="<?php echo base_url('public_html/assets/js/bootstrap-wysiwyg.min.js')?>"></script>
<script src="<?php echo base_url('public_html/assets/js/bootbox.min.js')?>"></script>


<script src="<?php echo base_url('public_html/assets/js/froala_editor.min.js')?>"></script>




<script type="text/javascript">
    jQuery(function($){
      //  $('textarea#froala-editor').froalaEditor();

    });

</script>
<!-- ace scripts -->

<script src="<?php echo base_url('public_html/assets/js/ace-elements.min.js')?>">           </script>
<script src="<?php echo base_url('public_html/assets/js/ace.min.js')?>">                    </script>

<script src="<?php echo base_url('public_html/assets/js/webcam.js')?>">                     </script>
<script src="<?php echo base_url('public_html/assets/js/script.js')?>">                     </script>
<script type="text/javascript">
    jQuery(function($) 
        {
            var today = new Date();
            $('.date-picker').datepicker({autoclose:true,			
                //startDate: '01-01-2010',
                //endDate: today,

            }).next().on(ace.click_event, function()
                {
                    $(this).prev().focus();
            });
            $('.date-picker-hierarchy').datepicker({autoclose:true });

            //$('body').addClass("rtl");
            //$('#ace-settings-rtl').prop('selected', true);



    });
</script>
<!-- Dropdown JS -->
<script src="<?php echo base_url('public_html/assets/js/chosen.jquery.min.js')?>"></script>


<!-- Date Picker-->
<script src="<?php echo base_url('public_html/assets/js/date-time/bootstrap-datepicker.min.js')?>"></script>



<!-- inline scripts related to this page -->
<?php
if(file_exists('application/modules/'.$controller.'/views/js.php') == true)
{
    $this->load->view($controller.'/js');  
}  



?>


</body>
</html>