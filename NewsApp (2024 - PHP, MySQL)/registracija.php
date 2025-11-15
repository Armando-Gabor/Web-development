<?php
if ($_POST['_action_'] == FALSE){
    print '
        <main>
            <form action="" method="post">
            <label for="name">Ime:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="surname">Prezime:</label>
            <input type="text" id="surname" name="surname" required><br><br>

            <label for="email">Email adresa:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="country">Država:</label>
            <select id="country" name="country" required>';
            $stmt = $MySQL->prepare("SELECT id, country_name FROM countries");
            $stmt->execute();
            $stmt->bind_result($id, $country_name);   
            while ($stmt->fetch()) {
                echo "<option value='" . htmlspecialchars($id) . "'>"
                   . htmlspecialchars($country_name) . "</option>";
            }
            $stmt->close();
            print '
            </select><br><br>

            <label for="city">Grad:</label>
            <input type="text" id="city" name="city" required><br><br>

            <label for="street">Ulica:</label>
            <input type="text" id="street" name="street" required><br><br>

            <label for="birthdate">Datum rođenja:</label>
            <input type="date" id="birthdate" name="birthdate" required><br><br>

            <label for="username">Korisničko ime:</label>
            <input type="text" id="username" name="username"><br><br>

            <label for="password">Lozinka:</label>
            <input type="password" id="password" name="password"><br><br>

            <label for="generiraj">Generiraj korisničko ime i lozinku automatski</label>
            <input type="checkbox" id="generiraj" name="generiraj"><br><br>

            <input type="hidden" name="_action_" value="1">
            <input class="submit" type="submit" value="Registriraj se">
        </form>   
        </main>';
}

else if ($_POST['_action_'] == TRUE) {

    function generatePassword($length = 10) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $password;
    }

    function generateUsername($name, $surname, $MySQL) {
        $baseUsername = strtolower($name[0] . $surname);
        $username = $baseUsername;
        $i = 1;
        while (true) {
            $query = "SELECT COUNT(*) FROM korisnici WHERE korisnickoIme = ?";
            $stmt = mysqli_prepare($MySQL, $query);
    
            if (!$stmt) {
                die('MySQL prepare failed: ' . mysqli_error($MySQL));
            }
    
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $count);
            mysqli_stmt_fetch($stmt);
            
            if ($count == 0) {
                mysqli_stmt_close($stmt);
                break;
            }
            mysqli_stmt_close($stmt);
            $username = $baseUsername . $i;
            $i++;
        }
        return $username;
    }

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $countryId = $_POST['country'];
    $city = $_POST['city'];
    $street = $_POST['street'];
    $birthdate = $_POST['birthdate'];
    if (isset($_POST['generiraj'])){
        $password = generatePassword();
        $username = generateUsername($name, $surname, $MySQL);
    }
    else{
        $username = $_POST['username'];
        $password = $_POST['password'];
    }
    
    $key = 'NTPWS';
    $encryptedPassword = base64_encode(openssl_encrypt($password, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, '1234567812345678'));

    $stmt = $MySQL->prepare("INSERT INTO korisnici (ime, prezime, email, drzava, grad, ulica, datumRodenja, korisnickoIme, lozinka) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $surname, $email, $countryId, $city, $street, $birthdate, $username, $encryptedPassword]);

    echo "Registracija uspješna! Vaše korisničko ime je: $username, a lozinka je: $password. Zapamtite ih za prijavu.";

}

?>