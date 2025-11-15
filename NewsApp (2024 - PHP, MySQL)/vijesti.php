<?php
    print "<main>";
    print "<br> Vaša uloga je: " . $_SESSION['uloga'];
    
    if ($_SESSION['uloga'] == "admin"){
        //Vijest - naslov, slike, tekst, datum, arhiva (bool)
        print '
            <h2>Unos vijesti</h2>
            <form action="index.php?menu=15" method="post">
                <label for="naslov">Naslov:</label><br>
                <input type="text" id="naslov" name="naslov" required><br><br>
                
                <label for="slike">Slike (ime slike s nastavkom, odvojeno zarezom ako ima više slika):</label><br>
                <input type="text" id="slike" name="slike" required><br><br>
                
                <label for="tekst">Tekst:</label><br>
                <textarea id="tekst" name="tekst" rows="4" cols="50" required></textarea><br><br>
                
                <label for="datum">Datum:</label><br>
                <input type="date" id="datum" name="datum" required><br><br>
                
                <label for="arhiva">Arhiva:</label><br>
                <input type="checkbox" id="arhiva" name="arhiva" value="1"><br><br>
                
                <input type="submit" value="Unesi Vijest">
            </form>
        ';
        

        //Uređivanje vijesti
        print '
            <h2>Uređivanje vijesti</h2>
            <form action="index.php?menu=19" method="post">
                <select name="news" id="news">
				<option value="">molimo odaberite</option>';
				$query  = "SELECT * FROM vijesti WHERE odobreno = 1 and arhiva = 0";
				$result = @mysqli_query($MySQL, $query);
				while($row = @mysqli_fetch_array($result)) {
					print '<option value="' . $row['id'] . '">' . $row['naslov'] . '</option>';
				}
			    print '
			    </select>
                <input type="submit" value="Uređivanje vijesti">
            </form>
        ';
        //Brisanje vijesti
        print '
            <h2>Brisanje vijesti</h2>
            <form action="index.php?menu=16" method="post">
                <select name="news" id="news">
				<option value="">molimo odaberite</option>';
				$query  = "SELECT * FROM vijesti WHERE odobreno = 1 AND arhiva = 0";
				$result = @mysqli_query($MySQL, $query);
				while($row = @mysqli_fetch_array($result)) {
					print '<option value="' . $row['id'] . '">' . $row['naslov'] . '</option>';
				}
			    print '
			    </select>
                <input type="submit" value="Obriši vijest">
            </form>
        ';
        //Odobravanje vijesti
        print '
            <h2>Odobravanje vijesti</h2>
            <form action="index.php?menu=17" method="post">
                <select name="news" id="news">
				<option value="">molimo odaberite</option>';
				$query  = "SELECT * FROM vijesti WHERE odobreno = 0";
				$result = @mysqli_query($MySQL, $query);
				while($row = @mysqli_fetch_array($result)) {
					print '<option value="' . $row['id'] . '">' . $row['naslov'] . '</option>';
				}
			    print '
			    </select>
                <input type="submit" value="Odobri vijest">
            </form>
            </main>
        ';
    }
    
    if ($_SESSION['uloga'] == "editor"){
        //Unos vijesti
        print '
            <h2>Unos vijesti</h2>
            <form action="index.php?menu=15" method="post">
                <label for="naslov">Naslov:</label><br>
                <input type="text" id="naslov" name="naslov" required><br><br>
                
                <label for="slike">Slike (ime slike s nastavkom, odvojeno zarezom ako ima više slika):</label><br>
                <input type="text" id="slike" name="slike" required><br><br>
                
                <label for="tekst">Tekst:</label><br>
                <textarea id="tekst" name="tekst" rows="4" cols="50" required></textarea><br><br>
                
                <label for="datum">Datum:</label><br>
                <input type="date" id="datum" name="datum" required><br><br>
                
                <label for="arhiva">Arhiva:</label><br>
                <input type="checkbox" id="arhiva" name="arhiva" value="1"><br><br>
                
                <input type="submit" value="Unesi Vijest">
            </form>
        ';
        //Uređivanje vijesti
        print '
            <h2>Uređivanje vijesti</h2>
            <form action="index.php?menu=19" method="post">
                <select name="news" id="news">
				<option value="">molimo odaberite</option>';
				$query  = "SELECT * FROM vijesti WHERE odobreno = 1 and arhiva = 0";
				$result = @mysqli_query($MySQL, $query);
				while($row = @mysqli_fetch_array($result)) {
					print '<option value="' . $row['id'] . '">' . $row['naslov'] . '</option>';
				}
			    print '
			    </select>
                <input type="submit" value="Uređivanje vijesti">
            </form>
        ';
        //Arhiviranje vijesti
        print '
            <h2>Arhiviranje vijesti</h2>
            <form action="index.php?menu=18" method="post">
                <select name="news" id="news">
				<option value="">molimo odaberite</option>';
				$query  = "SELECT * FROM vijesti WHERE arhiva = 0 AND odobreno = 1";
				$result = @mysqli_query($MySQL, $query);
				while($row = @mysqli_fetch_array($result)) {
					print '<option value="' . $row['id'] . '">' . $row['naslov'] . '</option>';
				}
			    print '
			    </select>
                <input type="submit" value="Arhiviraj vijest">
            </form>
            </main>
        ';
    } 
    
    if ($_SESSION['uloga'] == "user"){
        //Unos vijesti (za odobravanje)
        print '
            <h2>Unos vijesti</h2>
            <form action="index.php?menu=15" method="post">
                <label for="naslov">Naslov:</label><br>
                <input type="text" id="naslov" name="naslov" required><br><br>
                
                <label for="slike">Slike (ime slike s nastavkom, odvojeno zarezom ako ima više slika):</label><br>
                <input type="text" id="slike" name="slike" required><br><br>
                
                <label for="tekst">Tekst:</label><br>
                <textarea id="tekst" name="tekst" rows="4" cols="50" required></textarea><br><br>
                
                <label for="datum">Datum:</label><br>
                <input type="date" id="datum" name="datum" required><br><br>
                
                <label for="arhiva">Arhiva:</label><br>
                <input type="checkbox" id="arhiva" name="arhiva" value="1"><br><br>
                
                <input type="submit" value="Unesi Vijest">
            </form>
            </main>
        ';
    } 
?>