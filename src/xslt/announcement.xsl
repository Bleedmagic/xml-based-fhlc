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
  <!-- <xsl:variable name="announcement" select="document('../data/public/announcement.xml')/announcement" /> -->

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
        <title>Announcement / FHLC</title>

        <!-- CSS LIB -->
        <!-- https://bootswatch.com/4/ -->
        <link rel="stylesheet" href="./css/lib/bootstrap.min.css" />
        <link rel="stylesheet" href="./css/icons/bootstrap-icons.min.css" />

        <!-- Custom Styles -->
        <link rel="stylesheet" href="css/custom.css" />
      </head>

      <!-- Header -->
      <xsl:call-template name="navbar">
        <xsl:with-param name="currentPage" select="'announcement'" />
      </xsl:call-template>

      <!-- Main -->
      <main role="main">
        <div class="container mt-5">
          <h1>Announcement</h1>
          <p>Details about the announcement will go here.</p>
        </div>
      </main>

      <!-- Footer -->
      <xsl:call-template name="footer" />

      <!-- JS LIB -->
      <script type="text/javascript" src="js/lib/jquery.min.js"></script>
      <script type="text/javascript" src="js/lib/bootstrap.min.js"></script>

      <!-- Custom Scripts -->
      <script src="../frontend/js/custom.js"></script>
    </html>
  </xsl:template>

  <!-- Other XSL Templates -->
  <!-- <xsl:template></xsl:template> -->
</xsl:stylesheet>
