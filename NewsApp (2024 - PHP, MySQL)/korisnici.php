<?php
    print '
    <main>
    <form method="post" action="index.php?menu=21">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Email</th>
                    <th>Drzava</th>
                    <th>Grad</th>
                    <th>Ulica</th>
                    <th>Datum rođenja</th>
                    <th>Lozinka</th>
                    <th>Korisničko ime</th>
                    <th>Uloga</th>
                </tr>
            </thead>
            <tbody>';
                $sql = "SELECT * FROM korisnici";
                $result = $MySQL->query($sql);
                $key = 'NTPWS';
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $storedEncryptedPassword = $row['lozinka'];
                        
                        $decryptedPassword = openssl_decrypt(base64_decode($storedEncryptedPassword), 'aes-256-cbc', $key, OPENSSL_RAW_DATA, '1234567812345678');
                        echo "<tr>";
                        echo "<td><input type='text' name='id[]' value='" . $row["id"] . "' readonly></td>";
                        echo "<td><input type='text' name='ime[]' value='" . $row["ime"] . "'></td>";
                        echo "<td><input type='text' name='prezime[]' value='" . $row["prezime"] . "'></td>";
                        echo "<td><input type='text' name='email[]' value='" . $row["email"] . "'></td>";
                        echo "<td><input type='text' name='drzava[]' value='" . $row["drzava"] . "'></td>";
                        echo "<td><input type='text' name='grad[]' value='" . $row["grad"] . "'></td>";
                        echo "<td><input type='text' name='ulica[]' value='" . $row["ulica"] . "'></td>";
                        echo "<td><input type='text' name='datumRodenja[]' value='" . substr($row["datumRodenja"], 0, 10) . "'></td>";
                        echo "<td><input type='text' name='lozinka[]' value='" . $decryptedPassword . "'></td>";
                        echo "<td><input type='text' name='korisnickoIme[]' value='" . $row["korisnickoIme"] . "'></td>";
                        echo "<td><input type='text' name='uloga[]' value='" . $row["uloga"] . "'></td>";
                        echo "</tr>";
                    }
                    
                } else {
                    echo "<tr><td colspan='12'>Nema korisnika.</td></tr>";
                }
                
                print '
            </tbody>
        </table>';
        echo "<input type='submit' name='save' value='Spremi'>";
        print '
    </form>
    </main>';
?>