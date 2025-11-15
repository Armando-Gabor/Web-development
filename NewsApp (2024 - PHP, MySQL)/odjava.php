<?php
    unset($_POST);
    unset($_SESSION['user']);

    $_SESSION['user']['valid'] = 'false';
    $_SESSION['message'] = '<p>Odjava uspješna!</p>';
        
    header("Location: index.php?menu=1");
    exit;
?>