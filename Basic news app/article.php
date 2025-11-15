<?php
$id = isset($_GET['id']) ? $_GET['id'] : 1;
$sql = "SELECT naslov, tekst, slike, datum FROM vijesti WHERE id = $id";
$result = mysqli_query($MySQL, $sql);

// Provjera da li je upit uspješan
if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $naslov = $row["naslov"];
    $tekst = $row["tekst"];
    $datum = substr($row["datum"], 0, 10);
    $thumbnails = explode(",", $row["slike"]);

    print '
        <main>
        <h1>Novosti</h1>
        <div class="gallery-article">';
        foreach($thumbnails as $slika) {
            print '
                <figure>
                <img src="images/' . $slika . '" alt="">
                <figcaption>' . $naslov . '</figcaption>
                </figure>';
        };
        print '    
        </div>
        <div class="clear"></div>
        <hr/>
        <article>
            <h2>' . $naslov . '</h2>
            <p>' . $tekst . '</p>
            <p>' . $tekst . '</p>
            <p>' . $tekst . '</p>
            <p>' . $tekst . '</p>
            <p class="date">' . $datum . '</p>
        </article>
        <a href="index.php?menu=2">Nazad na novosti</a>
    </main>';
} 

else {
    echo "Nema podataka u bazi.";
}
?>