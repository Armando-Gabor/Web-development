<?php
    session_start();
    include("dbconn.php");

    if(!isset($_POST['_action_'])) { $_POST['_action_'] = FALSE; };
    $menu = isset($_GET['menu']) ? $_GET['menu'] : 1;

    $content = '';

    switch($menu) {
        case 1: 
            $content = 'home.php'; 
            break;
        case 2: 
            $content = 'news.php'; 
            break;
        case 3: 
            $content = 'contact.php'; 
            break;
        case 4: 
            $content = 'about.php'; 
            break;
        case 5: 
            $content = 'gallery.php'; 
            break;
        case 6: 
            $content = 'article.php'; 
            break;
        case 9: 
            $content = 'prijava.php'; 
            break;
        case 10: 
            $content = 'registracija.php'; 
            break;
        case 11: 
            $content = 'admin.php'; 
            break;
        case 12: 
            $content = 'odjava.php'; 
            break;
        case 13: 
            $content = 'korisnici.php'; 
            break;
        case 14: 
            $content = 'vijesti.php'; 
            break;
        case 15: 
            $content = 'insert_news.php'; 
            break;
        case 16: 
            $content = 'delete_news.php'; 
            break;
        case 17: 
            $content = 'approve_news.php'; 
            break;
        case 18: 
            $content = 'archive_news.php'; 
            break;
        case 19: 
            $content = 'edit_news.php'; 
            break;
        case 20: 
            $content = 'edit.php'; 
            break;
        case 21: 
            $content = 'edit_users.php'; 
            break;
        default: 
            $content = 'home.php'; // Default to home
    }

    print '
    <!DOCTYPE html>
    <html lang="hr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Stranica o tehnologiji umjetne inteligencije">
        <meta name="keywords" content="umjetna inteligencija, AI, LLM, strojno učenje, automatizacija, agenti, racunalna vizija, duboko učenje">
        <meta name="author" content="Armando Gabor">
        <link href="style.css" rel="stylesheet">
        <title>Umjetna inteligencija</title>
    </head>
    <body>
        <header>
            <img src="images/banner.png" alt="Banner o umjetnoj inteligenciji" class="banner">
            <nav>
                <ul>
                    <li><a href="index.php?menu=1">Početna stranica</a></li>
                    <li><a href="index.php?menu=2">Novosti</a></li>
                    <li><a href="index.php?menu=3">Kontakt</a></li>
                    <li><a href="index.php?menu=4">O nama</a></li>
                    <li><a href="index.php?menu=5">Galerija</a></li>';
                    if (!isset($_SESSION['user']['valid']) || $_SESSION['user']['valid'] == 'false') {
                        print '
                        <li><a href="index.php?menu=9">Prijava</a></li>
                        <li><a href="index.php?menu=10">Registracija</a></li>';
                    }
                    else if ($_SESSION['user']['valid'] == 'true') {
                        print '
                        <li><a href="index.php?menu=11">Admin</a></li>
                        <li><a href="index.php?menu=12">Sign Out</a></li>';
                    }
                print '    
                </ul>
            </nav>
        </header>';
    if (isset($_SESSION['message'])) {
		print $_SESSION['message'];
		unset($_SESSION['message']);
	};

    // Include the appropriate content file
    if (file_exists($content)) {
        include($content);
    } else {
        // Handle file not found
        print "<p>Stranica nije pronađena.</p>";
    }

    print '
        <footer>
            <div>
                <p>&copy; 2024 Armando Gabor. Sva prava pridržana.
                    <a href="https://github.com/Armando-Gabor/NTPWS">
                        <img src="images/github.png" alt="GitHub" class="social-icon">
                    </a>
                </p>
            </div>
        </footer>
    </body>
    </html>
    ';
?>