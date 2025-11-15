<?php
// SQL upit za selekciju podataka
$sql = "SELECT id, naslov, tekst, slike, datum, arhiva, odobreno FROM vijesti";
$result = $MySQL->query($sql);

// Provjera da li je upit uspješan
if ($result->num_rows > 0) {
    // Ispis podataka
    print '<main>
        <h1>Novosti</h1>';

    while($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $naslov = $row["naslov"];
        $tekst = substr($row["tekst"], 0, 200);
        $datum = substr($row["datum"], 0, 10);
        $thumbnail = strtok($row["slike"], ',');
        $odobreno = $row["odobreno"];
        $arhiva = $row["arhiva"];
        if ($odobreno && !$arhiva){
        print '
        <article>
                <a href="index.php?menu=6&id=' . $id .'">
                    <figure>
                        <img src="images/' . $thumbnail . '" alt="Koncept umjetne inteligencije">
                    </figure>
                    <h2>' . $naslov . '</h2>
                    <p>' . $tekst . '<b style="color:darksalmon;"> Pročitajte više...</b></p>
                    <p class="date">' . $datum . '</p>
                </a>
            </article>
        ';
        }
    }
    print '</main>';
} else {
    echo "Nema podataka u bazi.";
}
?>