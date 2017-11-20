<?php
// Pagination links configuration
$pagConfig = array('baseURL'=>'show_user.php', 'totalRows'=>$rowCount, 'perPage'=>$limit, 'contentDiv'=>'userTable');
// Initialize pagination class
$pagination =  new Pagination($pagConfig);
?>


<!-- Display pagination links -->
<?php echo $pagination->createLinks(); ?>