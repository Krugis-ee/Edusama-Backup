<?php if( Session::get('roleId')==2) { ?>
<iframe src="<?php echo $class_room->zoom_join_url; ?>" width="100%" height="90%" title="Online Class Room">
</iframe>
<?php } ?>
<?php  if( Session::get('roleId')==4) { ?>
<iframe src="<?php echo $class_room->zoom_start_url; ?>" width="100%" height="90%" title="Online Class Room">
</iframe>
<?php } ?>
<?php if( Session::get('roleId')==1) { ?>
<iframe src="<?php echo $class_room->zoom_start_url; ?>" width="100%" height="90%" title="Online Class Room">
</iframe>
<?php }  ?>