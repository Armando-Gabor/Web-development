<?php
        $arhiva = 1;
		$query  = " UPDATE vijesti SET arhiva=$arhiva";
        $query .= " WHERE id=" . (int)$_POST['news'];
        $result = @mysqli_query($MySQL, $query);

		$_SESSION['message'] = '<p>Vijest uspješno arhivirana</p>';
		header("Location: index.php?menu=14");
?>