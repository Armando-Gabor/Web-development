<?php
$id = $_POST['news'];
$result = mysqli_query($MySQL, "SELECT naslov, slike, tekst, datum FROM vijesti WHERE id = $id");
if (!$result) {
    die('Error in SQL query: ' . mysqli_error($MySQL));
}
$_SESSION["id"] = $id;

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    print '
    <main>
    <form action="index.php?menu=20" method="post">
        <label for="naslov">Naslov:</label><br>
        <input type="text" id="naslov" name="naslov" value="'; echo htmlspecialchars($row["naslov"]);print '"required><br><br>
        
        <label for="slike">Slike (ime slike s nastavkom, odvojeno zarezom ako ima više slika):</label><br>
        <input type="text" id="slike" name="slike" value="'; echo htmlspecialchars($row["slike"]);print '"required><br><br>
        
        <label for="tekst">Tekst:</label><br>
        <textarea id="tekst" name="tekst" rows="4" cols="50" required>'; echo htmlspecialchars($row["tekst"]); print '</textarea><br><br>
        
        <label for="datum">Datum:</label><br>
        <input type="date" id="datum" name="datum" value="'; echo substr($row["datum"], 0, 10); print '" required><br><br>

        <input type="submit" value="Spremi">
    </form>
    </main>
    ';
} else {
    echo "0 results";
}
?>