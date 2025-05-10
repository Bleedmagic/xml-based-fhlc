<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns="http://www.w3.org/1999/xhtml">

  <!-- Set Output to XHTML -->
  <xsl:output method="xml" indent="yes"
    doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN"
    doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" />

  <!-- Includes -->
  <xsl:include href="./shared/navbar.xsl" />
  <xsl:include href="./shared/footer.xsl" />

  <!-- Variables to access the database XML files -->
  <xsl:variable name="home" select="document('../data/public/home.xml')/home" />

  <!-- Transform -->
  <xsl:template match="/">
    <html>
      <head>
        <!-- META TAGS -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- FAVICONS -->
        <link rel="apple-touch-icon" href="../../assets/img/favicons/apple-touch-icon.png"
          sizes="180x180" />
        <link rel="icon" href="../../assets/img/favicons/favicon-32x32.png" sizes="32x32"
          type="image/png" />
        <link rel="icon" href="../../assets/img/favicons/favicon-16x16.png" sizes="16x16"
          type="image/png"
        />
        <link rel="icon" href="../../assets/img/favicons/favicon.ico" />

        <!-- PAGE TITLE -->
        <title>Home / FHLC</title>

        <!-- CSS LIB -->
        <!-- https://bootswatch.com/4/ -->
        <link rel="stylesheet" href="../../assets/css/lib/bootstrap.min.css" />
        <link rel="stylesheet" href="../../assets/css/icons/bootstrap-icons.min.css" />

        <!-- Custom Styles -->
        <link rel="stylesheet" href="../../assets/css/home.css" />
      </head>
      <body>
        <!-- Header -->
        <xsl:call-template name="navbar">
          <xsl:with-param name="currentPage" select="'home'" />
        </xsl:call-template>

        <!-- Main -->
        <main role="main">
         <!-- Hero Section -->
          <section class="hero-section d-flex align-items-center justify-content-between px-5 py-5">
            <div class="hero-text">
              <h1>
              Nurturing <span class="text-green">Young Minds</span> for <br>
              a <span class="text-orange">Brighter</span> Tomorrow </br>
              </h1>
              <p class="mt-3">
              At Full House Learning Center, we nurture every child's potential through<br>
              purposeful learning, a caring environment, and programs that build </br>
              strong foundations for future success. 
              </p>
            </div>
            <div class="hero-image">
              <img src="../../assets/img/image.png" alt="Happy Student" class="img-fluid" />
            </div>
        </section>



        </main>

        <!-- Footer -->
        <xsl:call-template name="footer" />

        <!-- JS LIB -->
        <script type="text/javascript" src="../../assets/js/lib/jquery.min.js"></script>
        <script type="text/javascript" src="../../assets/js/lib/bootstrap.min.js"></script>

        <!-- Custom Scripts -->
        <script src="../../assets/js/custom.js"></script>
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
