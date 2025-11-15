<?php
    $query  = "UPDATE vijesti SET naslov='" . htmlspecialchars($_POST['naslov'], ENT_QUOTES) . "', slike='" . htmlspecialchars($_POST['slike'], ENT_QUOTES) . "', tekst='" . $_POST['tekst'] ."', datum='" . $_POST['datum'] . "'";
    $query .= " WHERE id=" . (int)$_SESSION['id'];
    $query .= " LIMIT 1";
    $result = @mysqli_query($MySQL, $query);
    
    unset($_SESSION['id']);
    $_SESSION['message'] = '<p>Vijest uspješno ažurirana!</p>';
    
    header("Location: index.php?menu=14");
?>