<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns="http://www.w3.org/1999/xhtml">

  <!-- Set Output to XHTML -->
  <xsl:output method="xml"
    doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN"
    doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
    indent="yes" />

  <!-- Includes -->
  <xsl:include href="./shared/footer.xsl" />
  <xsl:include href="./shared/navbar.xsl" />

  <!-- Variables to access the database XML files -->
  <!-- <xsl:variable name="contact" select="document('../data/public/contact.xml')/contact" /> -->

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
          href="./img/favicons/apple-touch-icon.png"
          sizes="180x180"
        />
        <link
          rel="icon"
          href="./img/favicons/favicon-32x32.png"
          sizes="32x32"
          type="image/png"
        />
        <link
          rel="icon"
          href="./img/favicons/favicon-16x16.png"
          sizes="16x16"
          type="image/png"
        />
        <link rel="icon" href="./img/favicons/favicon.ico" />

        <!-- PAGE TITLE -->
        <title>Contact / FHLC</title>

        <!-- CSS LIB -->
        <!-- https://bootswatch.com/4/ -->
        <link rel="stylesheet" href="./css/lib/bootstrap.min.css" />
        <link rel="stylesheet" href="./css/icons/bootstrap-icons.min.css" />

        <!-- Custom Styles -->
        <link rel="stylesheet" href="./css/custom.css" />
      </head>

      <!-- Header -->
      <xsl:call-template name="navbar">
        <xsl:with-param name="currentPage" select="'contact'" />
      </xsl:call-template>

      <!-- Main -->
      <main role="main">
        <div class="container mt-5">
          <h1>Contact Us</h1>
          <p>If you have any questions or feedback, please reach out to us!</p>
        </div>

      </main>

      <!-- Footer -->
      <xsl:call-template name="footer" />

      <!-- JS LIB -->
      <script type="text/javascript" src="./js/lib/jquery.min.js"></script>
      <script type="text/javascript" src="./js/lib/bootstrap.min.js"></script>

      <!-- Custom Scripts -->
      <script src="./js/custom.js"></script>
    </html>
  </xsl:template>

  <!-- Other XSL Templates -->
  <!-- <xsl:template></xsl:template> -->
</xsl:stylesheet>
