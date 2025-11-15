<?php
    // Collect values from the form
    $naslov = $_POST['naslov'];
    $slike = $_POST['slike'];
    $tekst = $_POST['tekst'];
    $datum = $_POST['datum'];
    $arhiva = isset($_POST['arhiva']) ? 1 : 0;
    ($_SESSION['uloga'] == "admin" || $_SESSION['uloga'] == "editor") ? $odobreno = 1 : $odobreno = 0;


    // Insert query
    $query = "INSERT INTO vijesti (naslov, slike, tekst, datum, arhiva, odobreno) VALUES ('$naslov', '$slike', '$tekst', '$datum', '$arhiva', '$odobreno')";
    $stmt = $MySQL->prepare($query);

    if ($stmt->execute() === TRUE) {
        $_SESSION['message'] = '<p>Vijest uspješno dodana.</p>';
        header("Location: index.php?menu=14");

    } else {
        $_SESSION['message'] = '<p>Pogreška pri dodavanju vijesti.</p>';
        header("Location: index.php?menu=14");
    }
?>