<?php

    $ids = $_POST['id'];
    $names = $_POST['ime'];
    $surnames = $_POST['prezime'];
    $emails = $_POST['email'];
    $countries = $_POST['drzava'];
    $cities = $_POST['grad'];
    $streets = $_POST['ulica'];
    $dates = $_POST['datumRodenja'];
    $passwords = $_POST['lozinka'];
    $usernames = $_POST['korisnickoIme'];
    $roles = $_POST['uloga'];
    $key = 'NTPWS';
    

    for ($i = 0; $i < count($ids); $i++) {
        $sql = "UPDATE korisnici SET ime=?, prezime=?, email=?, drzava=?, grad=?, ulica=?, datumRodenja=?, lozinka=?, korisnickoIme=?, uloga=? WHERE id=?";

        if ($stmt = $MySQL->prepare($sql)) {
            $encryptedPassword = base64_encode(openssl_encrypt($passwords[$i], 'aes-256-cbc', $key, OPENSSL_RAW_DATA, '1234567812345678'));
            $stmt->bind_param("ssssssssssi", $names[$i], $surnames[$i], $emails[$i], $countries[$i], $cities[$i], $streets[$i], $dates[$i], $encryptedPassword, $usernames[$i], $roles[$i], $ids[$i]);

            if ($stmt->execute()) {
                $_SESSION['message'] = 'Korisnici uspješno ažurirani.';
                header("Location: index.php?menu=13");
            } else {
                $_SESSION['message'] = 'Korisnici nisu uspješno ažurirani, došlo je do pogreške.';
                header("Location: index.php?menu=13");

            }
        } else {
            echo "Error preparing statement: " . $MySQL->error;
        }
    }
?>
