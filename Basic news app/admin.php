<?php

if ($_SESSION['uloga'] == "admin"){
    print "<main><br> Vaša uloga je: " . $_SESSION['uloga'];
    print '

		<div>
			<ul>
                <li><a href="index.php?menu=13">Uređivanje korisnika</a></li>
                <li><a href="index.php?menu=14">Uređivanje vijesti</a></li>   
            </ul>
		</div>
        </main>
    ';
}

if ($_SESSION['uloga'] == "editor"){
    header("Location: index.php?menu=14");
} 

if ($_SESSION['uloga'] == "user"){
    header("Location: index.php?menu=14");
} 

if ($_SESSION['uloga'] == ""){
    print "<main><br> Pristup će vam biti odobren kada vam administrator dodijeli razinu prava.</main>";
} 

?>