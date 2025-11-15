<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

print '
    <main>
        <h1>Kontakt forma</h1>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2781.797289129755!2d15.966938677207498!3d45.795288711285735!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4765d68b441ce2df%3A0x54e2a03adf42446f!2sTehni%C4%8Dko%20veleu%C4%8Dili%C5%A1te%20u%20Zagrebu!5e0!3m2!1shr!2shr!4v1732299926933!5m2!1shr!2shr" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <form action="" method="post">
            <label for="ime">Ime:</label>
            <input type="text" id="ime" name="ime" required>

            <label for="prezime">Prezime:</label>
            <input type="text" id="prezime" name="prezime" required>

            <label for="email">E-mail adresa:</label>
            <input type="email" id="email" name="email" required>

            <label for="drzava">Država:</label>
            <select id="drzava" name="drzava">
                <option value="hr">Hrvatska</option>
                <option value="ba">Bosna i Hercegovina</option>
                <option value="rs">Srbija</option>
            </select>

            <label for="opis">Opis:</label>
            <textarea id="opis" name="opis" rows="10" cols="60"></textarea>

            <input type="submit" value="Pošalji" class="submit">
        </form>
        
    </main>
';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Prikupljanje podataka iz forme
    $ime = htmlspecialchars($_POST['ime']);
    $prezime = htmlspecialchars($_POST['prezime']);
    $email = htmlspecialchars($_POST['email']);
    $drzava = htmlspecialchars($_POST['drzava']);
    $opis = htmlspecialchars($_POST['opis']);
    
    // Postavljanje primatelja emaila
    $to = "armandog.private@gmail.com";
    
    // Predmet emaila
    $subject = "Kontakt forma - " . $ime . " " . $prezime;
    
    // Sadržaj emaila
    $message = "Ime: " . $ime . "\n";
    $message .= "Prezime: " . $prezime . "\n";
    $message .= "Email: " . $email . "\n";
    $message .= "Država: " . $drzava . "\n";
    $message .= "Opis:\n" . $opis;

    // Zaglavlje emaila
    $headers = "From: " . $email . "\r\n" .
               "Reply-To: " . $email . "\r\n" .
               "X-Mailer: PHP/" . phpversion();
    
    // Slanje emaila - simulacija zbog nepostavljenog mail procesa
    if (mail($to, $subject, $message, $headers)){
        $_SESSION['message'] = "<p>Poruka nije uspješno poslana.</p>";
    } else{
        $_SESSION['message'] = "<p>Poruka je uspješno poslana.</p>";
    }

    header("Location: index.php?menu=3");
    exit();
}
?>

