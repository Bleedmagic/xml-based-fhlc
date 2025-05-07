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
        <!-- https://bootswatch.com/4/ -->
        <link rel="stylesheet" href="./css/lib/bootstrap.min.css" />
        <link rel="stylesheet" href="./css/icons/bootstrap-icons.min.css" />

        <!-- Custom Styles -->
        <link rel="stylesheet" href="css/custom.css" />
      </head>
      <body>
        <!-- Header -->
        <xsl:call-template name="navbar">
          <xsl:with-param name="currentPage" select="'home'" />
        </xsl:call-template>

        <!-- Main -->
        <main role="main">
          <!-- Hero Section -->



        </main>

        <!-- Footer -->
        <xsl:call-template name="footer" />

        <!-- JS LIB -->
        <script type="text/javascript" src="js/lib/jquery.min.js"></script>
        <script type="text/javascript" src="js/lib/bootstrap.min.js"></script>
        <!-- <script type="text/javascript" src="js/lib/sweetalert2.all.min.js"></script> -->
        <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

        <!-- Custom Scripts -->
        <script src="../frontend/js/custom.js"></script>
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
