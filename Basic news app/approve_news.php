<?php
        $odobreno = 1;
		$query  = " UPDATE vijesti SET odobreno=$odobreno";
        $query .= " WHERE id=" . (int)$_POST['news'];
        $result = @mysqli_query($MySQL, $query);

		$_SESSION['message'] = '<p>Vijest uspješno odobrena</p>';
		header("Location: index.php?menu=14");
?>