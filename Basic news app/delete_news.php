<?php
# Delete picture
		# Delete news
		$query  = "DELETE FROM vijesti";
		$query .= " WHERE id=".(int)$_POST['news'];
		$query .= " LIMIT 1";
		$result = @mysqli_query($MySQL, $query);

		$_SESSION['message'] = '<p>Vijest uspješno obrisana</p>';
		header("Location: index.php?menu=14");
?>