<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $title; ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--BEGIN : Bootstrap and jquery from local-->
<link rel="stylesheet" href="<?= base_url("Assets/Bootstrap/css/bootstrap.min.css" ) ?>">
<script src="<?= base_url("Assets/js/jquery-3.3.1.min.js" ) ?>"></script>  
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  -->
<script src="<?= base_url("Assets/Bootstrap/js/bootstrap.min.js" ) ?>"></script>  
<!--END :  Bootstrap and jquery from local-->

<!--BEGIN : datatable from local-->
<link href="<?= base_url("Assets/js/table/jquery.dataTables.min.css") ?>" rel="stylesheet"> 
<script src="<?= base_url("Assets/js/table/jquery.dataTables.min.js") ?>"></script>
<!--END : datatable from local-->

<link href="<?= base_url("Assets/CSS/dashboard_style.css") ?>" rel="stylesheet"> 
<script src="<?= base_url("Assets/js/table/jquery.dataTables.min.js") ?>"></script>
</head>
<body>
<div class="well">
  <div class="row">
  	 <div class="col-sm-10">
	  Library Management System
     </div>
     <div class="col-sm-2">
     	<div class="dropdown">
     		<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="background-color: #278c8b;border-color: #278c8b">
     			<span class="glyphicon glyphicon-user"></span> User
     			<span class="caret"></span></button>
     			<ul class="dropdown-menu">
     				<li><a href="#"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
     			</ul>
     		</div>
     	</div>
  </div>
</div>