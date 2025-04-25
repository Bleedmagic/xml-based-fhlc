<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns="http://www.w3.org/1999/xhtml">

  <!-- Set Output to XHTML -->
  <xsl:output method="xml"
    doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN"
    doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
    indent="yes" />

  <!-- Variables to access the database XML files -->
  <xsl:variable name="navbar" select="document('../data/public.xml')/public/navbar" />
  <xsl:variable name="home" select="document('../data/public.xml')/public/home" />
  <xsl:variable name="footer" select="document('../data/public.xml')/public/footer" />
  <xsl:variable name="hero" select="document('../data/public.xml')/public/hero" />

  <!-- Transform -->
  <xsl:template match="/">
    <html>
      <head>

        <!-- META TAGS -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description"
          content="A web-based portal for guardians and students to track learning progress and communicate with educators." />
        <meta name="keywords"
          content="guardian portal, student progress, school communication, learning management, education tools" />

        <!-- FAVICONS -->
        <link
          rel="apple-touch-icon"
          href="img/favicons/apple-touch-icon.png"
          sizes="180x180"
        />
        <link
          rel="icon"
          href="img/favicons/favicon-32x32.png"
          sizes="32x32"
          type="image/png"
        />
        <link
          rel="icon"
          href="img/favicons/favicon-16x16.png"
          sizes="16x16"
          type="image/png"
        />
        <link rel="icon" href="img/favicons/favicon.ico" />

        <!-- PAGE TITLE -->
        <title>Home / FHLC</title>
        <!-- CSS LIB -->
        <link rel="stylesheet" href="css/lib/bootstrap.min.css" />
        <link rel="stylesheet" href="css/icons/bootstrap-icons.min.css" />
        <!-- Custom Styles -->
        <link rel="stylesheet" href="css/custom.css" />
      </head>
      <body>

        <!-- NAVBAR -->
        <header class="container">
          <nav class="navbar navbar-expand-lg navbar-dark bg-gray">

            <a class="navbar-brand d-flex align-items-center" href="#">
              <img src="{ $navbar/logo }" alt="Logo" style="height: 50px; margin-right: 10px;" />
              <xsl:value-of select="$navbar/brand" />
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse"
              data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarColor01">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about.xhtml">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact.xhtml">Contact Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="announcements.xhtml">Announcements</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="true" aria-expanded="false">Admissions</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Admissions Process</a>
                    <a class="dropdown-item" href="#">Forms &amp; Requirements</a>
                    <a class="dropdown-item" href="#">Re-enrollment &amp; Withdrawal</a>
                    <a class="dropdown-item" href="#">New Student Information</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Apply Now</a>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Forum</a>
                </li>
              </ul>
              <button class="btn btn-outline-info my-2 my-sm-0 ml-2">Login</button>
            </div>
          </nav>
        </header>

        <!-- Main -->
        <main role="main">

          <!-- Hero Section -->
          <div class="hero-section text-center py-5">
            <h1 class="display-4">Welcome to FHLC</h1>
            <p class="lead">Your portal for tracking learning progress and communication.</p>
            <a href="#link" class="btn btn-primary btn-lg" onclick="showAlert()">Get Started</a>
          </div>

          <div class="hero-section text-center py-5">
            <h1 class="display-4">
              <xsl:value-of select="$hero/header" />
            </h1>
            <p class="lead">
              <xsl:apply-templates select="$hero/description/p" />
            </p>
          </div>

        </main>

        <!-- FOOTER -->
        <footer class="footer py-3">
          <div class="container text-center">
            <span class="text-muted"> &#169;<xsl:value-of select="$footer/copyright" />
            </span>
            <div class="mt-2">
              <a href="#link1" class="mr-2">
                <i class="bi bi-facebook"></i>
              </a>
              <a href="#link2" class="mr-2">
                <i class="bi bi-youtube"></i>
              </a>
              <a href="#link3">
                <i class="bi bi-instagram"></i>
              </a>
            </div>
          </div>
        </footer>


        <!-- JS LIB -->
        <script type="text/javascript" src="js/lib/jquery.min.js"></script>
        <script type="text/javascript" src="js/lib/bootstrap.min.js"></script>
        <!-- <script type="text/javascript" src="js/lib/sweetalert2.all.min.js"></script> -->
        <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

        <!-- Custom Scripts -->
      </body>
    </html>
  </xsl:template>

  <!-- Other XSL Templates -->
  <xsl:template match="p">
    <p>
      <xsl:value-of select="." />
    </p>
  </xsl:template>
</xsl:stylesheet>
