<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Multiple Table Rows Deletion Example in PHP, AJAX, jQuery, MySQL</title>
	<link rel="stylesheet" type="text/css" href="assets/css/table.css"/>
	<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
	<script src="assets/js/app.js"></script>
</head>
<body>

<div>
	<h1>Multiple Table Rows Deletion Example in PHP, AJAX, jQuery, MySQL</h1>

	<div id="body">
		<?php
			require_once 'db.php';
			
			$sql = "SELECT * FROM product";
			$results = dbQuery($sql);

			if($results) {
		?>
			<div id="msg"></div>
			<button id="delete_selected">Delete Selected Product(s)</button>
			<table class="datatable">
				<thead>
					<tr>
						<th><input id="check_all" type="checkbox"></th>
						<th>ID</th>
						<th>Code</th>
						<th>Name</th>
						<th>Price</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i = 0;
						while($p = dbFetchAssoc($results)) {
							$col_class = ($i % 2 == 0 ? 'odd_col' : 'even_col');
							$i++;
						?>
						<tr class="<?php echo $col_class; ?>">
							<td><input type="checkbox" name="row-check" value="<?php echo $p['id'];?>"></td>
							<td><?php echo $p['id']; ?></td>
							<td><?php echo $p['code']; ?></td>
							<td><?php echo $p['name']; ?></td>
							<td><?php echo $p['price']; ?></td>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
		<?php
			} else {
				echo '<div style="color:red;"><p>No Record Found</p></div>';
			}
		?>
	</div>
</div>

</body>
</html>