<?php

$jsonData = file_get_contents('books.json');
$books = json_decode($jsonData, true);
$searchQuery = '';
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
}
function compareBooks($a, $b) {
    return strcmp($a['title'], $b['title']);
}
usort($books, 'compareBooks');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Księgarnia CDV</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar d-block d-lg-none" style="position: relative; z-index: 1;">
        <div class="container-fluid">
        <div class="site-logo">
            <a href="index.php" class="text-black"><span class="text-primary" style="font-size: 25px;font-weight: 900;">Projekt CDV</a>
        </div>
            <button class="navbar-toggler2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>  
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mb-2 mb-sm-0">
                <li class="nav-item">
                    <a class="nav-link nav-link-1 active" aria-current="page" href="/cdv/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-2" href="/cdv/ksiazki.html">Książki</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-3" href="/cdv/ksiazki.php">Wyszukaj</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <header class="site-navbar js-sticky-header site-navbar-target d-none d-lg-block" role="banner">
    <div class="container">
      <div class="row align-items-center position-relative">
        <div class="site-logo">
            <a href="index.php" class="text-black"><span class="text-primary">Projekt CDV</a>
        </div>
        <div class="col-12">
          <nav class="site-navigation text-right ml-auto " role="navigation">
            <ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">
                <li><a href="index.php" class="nav-link">Home</a></li>
              <li><a href="ksiazki.html" class="nav-link">Książki</a></li>
              <li class="has-children">
                <a href="/cdv/ksiazki.php" class="nav-link">Wyszukaj</a>
                <ul class="dropdown arrow-top">
                  <li><a href="/cdv/ksiazki.php?genre=Komedia&sort=none" class="nav-link">Komedie</a></li>
                  <li><a href="/cdv/ksiazki.php?genre=Horror&sort=none" class="nav-link">Horrory</a></li>
                  <li><a href="/cdv/ksiazki.php?genre=Akcji&sort=none" class="nav-link">Akcji</a></li>
                  <li><a href="/cdv/ksiazki.php?genre=Najnowsze+książki&sort=none" class="nav-link">Najnowsze</a></li>    
                </ul>
              </li>
            </ul>
          </nav>
        </div>
        <div class="toggle-button d-inline-block d-lg-none"><a href="#" class="d-flex justify-content-start site-menu-toggle py-5 js-menu-toggle text-black"><span class="icon-menu h3"></span></a>
</div>
      </div>
    </div>
  </header>
<div class="hero" style="background-image: url('obrazy/hero_1.jpg');">
    <div class="tekst-slider">
       <div class="opacity1">ODKRYJ ŚWIAT LITERATURY ONLINE</div> 
      </div>
</div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/main.js"></script>
 <div class="tm-hero d-flex justify-content-center align-items-center" data-parallax="scroll" > 
        <form action="" method="get">
            <label for="search">Wyszukaj książkę:</label>
            <input type="text" name="search" id="search" value="<?php echo htmlspecialchars($searchQuery); ?>">
            <button type="submit">Szukaj</button>
        </form>
    </div>
    <div class="container-fluid tm-container-content tm-mt-60">
        <div class="book-list mx-auto">
            <?php foreach ($books as $book): ?>
                <?php if (stripos($book['title'], $searchQuery) !== false || stripos($book['author'], $searchQuery) !== false): ?>
                    <div class="book-item">
                        <img src="<?php echo htmlspecialchars($book['image']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>" class="book-image">
                        <div>
                            <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                            <p><strong>Autor:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
                            <p><strong>Rok wydania:</strong> <?php echo htmlspecialchars($book['year']); ?></p>
                            <p><strong>Gatunek:</strong> <?php echo htmlspecialchars($book['genre']); ?></p>
                            <p><strong>Liczba wyświetleń:</strong> <?php echo htmlspecialchars($book['views']); ?></p>
                            <p><strong>Liczba kupionych sztuk:</strong> <?php echo htmlspecialchars($book['purchases']); ?></p>
                            <p><strong>Cena:</strong> $<?php echo number_format($book['price'], 2); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
                </div>
        <div class="row mb-4">
            <h2 class="col-6 tm-text-primary">Najnowsze książki </h2>
        </div>
        <div class="row tm-mb-90 tm-gallery">
        	<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="obrazy/najnowszefilmy.png" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>NAJNOWSZE 1</h2>
                        <a href="szczegoly_ksiazki.html">Zobacz więcej</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">18 Oct 2020</span>
                    <span>9,906 recenzji</span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="obrazy/najnowszefilmy.png" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>NAJNOWSZE 2</h2>
                        <a href="szczegoly_ksiazki.html">Zobacz więcej</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">14 Oct 2020</span>
                    <span>16,100 recenzji</span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="obrazy/najnowszefilmy.png" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>NAJNOWSZE 3</h2>
                        <a href="szczegoly_ksiazki.html">Zobacz więcej</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">12 Oct 2020</span>
                    <span>12,460 recenzji</span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="obrazy/najnowszefilmy.png" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>NAJNOWSZE 4</h2>
                        <a href="szczegoly_ksiazki.html">Zobacz więcej</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">10 Oct 2020</span>
                    <span>11,402 recenzji</span>
                </div>
            </div>
            <h2 class="col-6 tm-text-primary"> Horrory</h2>
        </div>
        <div class="row tm-mb-90 tm-gallery">
        	<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="obrazy/horrory.png" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>HORROR 1</h2>
                        <a href="szczegoly_ksiazki.html">Zobacz więcej</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">18 Oct 2020</span>
                    <span>9,906 recenzji</span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="obrazy/horrory.png" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>HORROR 2</h2>
                        <a href="szczegoly_ksiazki.html">Zobacz więcej</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">14 Oct 2020</span>
                    <span>16,100 recenzji</span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="obrazy/horrory.png" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>HORROR 3</h2>
                        <a href="szczegoly_ksiazki.html">Zobacz więcej</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">12 Oct 2020</span>
                    <span>12,460 recenzji</span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="obrazy/horrory.png" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>HORROR 4</h2>
                        <a href="szczegoly_ksiazki.html">Zobacz więcej</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">10 Oct 2020</span>
                    <span>11,402 recenzji</span>
                </div>
            </div>
            <h2 class="col-6 tm-text-primary">
                Akcji
            </h2>
        </div>
        <div class="row tm-mb-90 tm-gallery">
        	<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="obrazy/akcji.png" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>AKCJI 1</h2>
                        <a href="szczegoly_ksiazki.html">Zobacz więcej</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">18 Oct 2020</span>
                    <span>9,906 recenzji</span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="obrazy/akcji.png" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>AKCJI 2</h2>
                        <a href="szczegoly_ksiazki.html">Zobacz więcej</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">14 Oct 2020</span>
                    <span>16,100 recenzji</span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="obrazy/akcji.png" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>AKCJI 3</h2>
                        <a href="szczegoly_ksiazki.html">Zobacz więcej</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">12 Oct 2020</span>
                    <span>12,460 recenzji</span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="obrazy/akcji.png" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>AKCJI 4</h2>
                        <a href="szczegoly_ksiazki.html">Zobacz więcej</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">10 Oct 2020</span>
                    <span>11,402 recenzji</span>
                </div>
            </div>
            <h2 class="col-6 tm-text-primary">Komedie</h2>
        </div>
        <div class="row tm-mb-90 tm-gallery">
        	<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="obrazy/komedia.png" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>KOMEDIA 1</h2>
                        <a href="szczegoly_ksiazki.html">Zobacz więcej</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">18 Oct 2020</span>
                    <span>9,906 recenzji</span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="obrazy/komedia.png" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>KOMEDIA 2</h2>
                        <a href="szczegoly_ksiazki.html">Zobacz więcej</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">14 Oct 2020</span>
                    <span>16,100 recenzji</span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="obrazy/komedia.png" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>KOMEDIA 3</h2>
                        <a href="szczegoly_ksiazki.html">Zobacz więcej</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">12 Oct 2020</span>
                    <span>12,460 recenzji</span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="obrazy/komedia.png" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>KOMEDIA 4</h2>
                        <a href="szczegoly_ksiazki.html">Zobacz więcej</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light">10 Oct 2020</span>
                    <span>11,402 recenzji</span>
                </div>
            </div>
    <footer class="tm-bg-gray pt-5 pb-3 tm-text-gray tm-footer">
        <div class="container-fluid tm-container-small">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12 px-5 mb-5">
                    <h3 class="tm-text-primary mb-4 tm-footer-title">O nas</h3>
                    <p>Ksiegarnia CDV</p>  
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 px-5 mb-5">
                    <h3 class="tm-text-primary mb-4 tm-footer-title">Skrót</h3>
                    <ul class="tm-footer-links pl-0">
                        <li><a href="#">Reklama</a></li>
                        <li><a href="#">Reklamacje</a></li>
                        <li><a href="#">O nas</a></li>
                        <li><a href="#">Kontakt</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 px-5 mb-5">
                    <ul class="tm-social-links d-flex justify-content-end pl-0 mb-5">
                        <li class="mb-2"><a href="https://facebook.com"><i class="fab fa-facebook"></i></a></li>
                        <li class="mb-2"><a href="https://twitter.com"><i class="fab fa-twitter"></i></a></li>
                        <li class="mb-2"><a href="https://instagram.com"><i class="fab fa-instagram"></i></a></li>
                        <li class="mb-2"><a href="https://pinterest.com"><i class="fab fa-pinterest"></i></a></li>
                    </ul>
                    <a href="#" class="tm-text-gray text-right d-block mb-2">Regulamin</a>
                    <a href="#" class="tm-text-gray text-right d-block">Polityka prywatności</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-7 col-12 px-5 mb-3">
                    M. Konieczny | J. Krzemiński | M. Kaczmarzyk | M. Kotowski | P. Heyn
                </div>
            </div>
        </div>
    </footer>
    <script src="js/plugins.js"></script>
    <script>
        $(window).on("load", function() {
            $('body').addClass('loaded');
        });
    </script>
</body>
</html>