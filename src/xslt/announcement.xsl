<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns="http://www.w3.org/1999/xhtml">

  <!-- Set Output to XHTML -->
  <xsl:output method="xml"
    doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN"
    doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" indent="yes" />

  <!-- Includes -->
  <xsl:include href="./shared/footer.xsl" />
  <xsl:include href="./shared/navbar.xsl" />

  <!-- Variables to access the database XML files -->
  <!-- <xsl:variable name="announcement" select="document('../data/public/about.xml')/announcement"
  /> -->

  <!-- Transform -->
  <!-- Main Template -->
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
          type="image/png" />
        <link rel="icon" href="../../assets/img/favicons/favicon.ico" />

        <!-- PAGE TITLE -->
        <title>Announcement / FHLC</title>

        <!-- CSS LIB -->
        <link rel="stylesheet" href="../../assets/css/lib/bootstrap.min.css" />
        <link rel="stylesheet" href="../../assets/css/icons/bootstrap-icons.min.css" />

        <!-- Custom Styles -->
        <link rel="stylesheet" href="../../assets/css/announcement.css" />
      </head>

      <body>
        <!-- Header -->
        <xsl:call-template name="navbar">
          <xsl:with-param name="currentPage" select="'announcement'" />
        </xsl:call-template>

        <!-- Main -->
        <main role="main" class="container">
         <h2 class="section-title">Announcements</h2>
          <xsl:for-each select="announcements/announcement">
            <div class="announcement-card">
              <img>
                <xsl:attribute name="src"><xsl:value-of select="image/@src" /></xsl:attribute>
                <xsl:attribute name="alt"><xsl:value-of select="image/@alt" /></xsl:attribute>
                <xsl:attribute name="class">announcement-img <xsl:value-of select="image/@class" /></xsl:attribute>
              </img>
              <div class="card-body">
                <h5 class="card-title">
                  <xsl:value-of select="title" />
                </h5>
                <p class="card-text">
                  <xsl:value-of select="text" />
                </p>
              </div>
            </div>
          </xsl:for-each>
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
</xsl:stylesheet>
