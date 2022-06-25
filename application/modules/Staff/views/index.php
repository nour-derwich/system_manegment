<?php
	$system_name	=	$system_info[0]->system_name;
	$system_title	=	$system_info[0]->system_title;
	$text_align	=	'';
	$account_type 	=	$this->session->userdata('login_type');
	?>
<!DOCTYPE html>
<html lang="en" dir="<?php if ($text_align == 'right-to-left') echo 'rtl';?>">
<head>
	
	<title><?php echo $page_title;?> | <?php echo $system_title;?></title>
    <?php if($system_info[0]->system_image != "")
{?>
<link rel="icon" href="<?php echo base_url();?>/public_html/frontend/image/system/<?php echo $system_info[0]->system_image; ?>" type="image/x-icon" />
<?php 
}?>

	
	

	<?php include 'includes_top.php';?>

	
</head>
<body class="page-body" >
	<div class="page-container <?php if ($text_align == 'right-to-left') echo 'right-sidebar';?>" >
		<?php include 'admin/navigation.php';?>	
		<div class="main-content">
		
			<?php include 'header.php';?>

           <h3 style="margin:20px 0px; color:#818da1; font-weight:200;">
           	<i class="entypo-right-circled"></i> 
				<?php echo $page_title;?>
           </h3>

			<?php include 'admin/'.$page_name.'.php';?>

			<?php include 'footer.php';?>

		</div>
		<?php //include 'chat.php';?>
        	
	</div>
    <?php include 'modal.php';?>
    <?php include 'includes_bottom.php';?>
    	<?php include 'js.php';?>
</body>
</html>