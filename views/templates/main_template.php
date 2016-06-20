<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>Книга скарт та пропозицій</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Mar’yan Pylypiv">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
	
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" >

	<!-- Project style -->
	<link rel="stylesheet" href="<?= SITE_URL;?>/style.css">
	
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" ></script>

	<!-- Project JS -->
	<script src="<?= SITE_URL;?>/js/main.js"></script>
</head>
<body>
<!-- Modal -->
<div class="modal fade" id="add_complaint_dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Додати пропозицію або скаргу</h4>
      </div>
      <div class="modal-body" style="overflow: hidden;">
       <?php include '/views/add_complaint.php'; ?>
      </div>
    </div>
  </div>
</div>

<?php include '/views/navbar.php'; ?>
<?php include '/views/'.$content_view; ?>
</body>
</html>