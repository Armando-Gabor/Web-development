<?php
if ($_POST['_action_'] == FALSE){
    print '
        <main>
            <form action="" method="post">
            <label for="username">Korisničko ime:</label>
            <input type="text" id="username" name="username"><br><br>

            <label for="password">Lozinka:</label>
            <input type="password" id="password" name="password"><br><br>

            <input type="hidden" name="_action_" value="1">
            <input class="submit" type="submit" value="Prijava">
        </form>   
        </main>';
}

else if ($_POST['_action_'] == TRUE) {
    
    function checkUserCredentials($username, $password, $MySQL) {
        $stmt = $MySQL->prepare("SELECT lozinka, uloga FROM korisnici WHERE korisnickoIme = ?");
        $stmt->execute([$username]);
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) { // Provjera da li smo dobili rezultate
            $row = $result->fetch_assoc();
            $storedEncryptedPassword = $row['lozinka'];
            $key = 'NTPWS'; // Ključ za enkripciju
            
            $decryptedPassword = openssl_decrypt(base64_decode($storedEncryptedPassword), 'aes-256-cbc', $key, OPENSSL_RAW_DATA, '1234567812345678');
    
            if ($decryptedPassword !== false) {
                if ($password === $decryptedPassword) {
                    $_SESSION['uloga'] = $row['uloga'];
                    return True;
                } else {
                    return False;
                }
            }
        }
    }
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (checkUserCredentials($username, $password, $MySQL)) {
        echo "Prijava uspješna!";
            $_SESSION['user']['valid'] = 'true';
			$_SESSION['message'] = '<p>Dobrodošao ' . $username . '!';
			header("Location: index.php?menu=11");
    } else {
            unset($_SESSION['user']);
            $_SESSION['message'] = '<p>Pogrešno korisničko ime ili lozinka!</p>';
            header("Location: index.php?menu=9");
    }
};

?>
