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
  <xsl:include href="./shared/navbar.xsl" />
  <xsl:include href="./shared/footer.xsl" />

    <!-- Variables to access the database XML files -->
<!--   <xsl:variable name="gradelevel" select="document('../data/public/gradelevels.xml')/gradelevels.xml" /> -->

    <!-- Transform -->
  <xsl:template match="/gradeLevels">
    <html>
      <head>
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
        <title>Grade Levels Offered / FHLC</title>

        <!-- CSS LIB -->
        <!-- https://bootswatch.com/4/ -->
        <link rel="stylesheet" href="../../assets/css/lib/bootstrap.min.css" />
        <link rel="stylesheet" href="../../assets/css/icons/bootstrap-icons.min.css" />

        <!-- Custom Styles -->
        <link rel="stylesheet" href="../../assets/css/gradelevels.css" />
      </head>
      <body>
        <!-- Navbar -->
        <xsl:call-template name="navbar">
          <xsl:with-param name="currentPage" select="'admission'" />
        </xsl:call-template>

        <!-- Main Content -->
        <main class="container my-5">
          <h2 class="section-title">Grade Levels Offered</h2>
          <div class="grade-container">
            <xsl:for-each select="section">
              <div class="grade-card">
                <div class="grade-image">
                  <img>
                    <xsl:attribute name="src">
                      <xsl:value-of select="image"/>
                    </xsl:attribute>
                    <xsl:attribute name="alt">
                      <xsl:value-of select="@type"/>
                    </xsl:attribute>
                  </img>
                </div>
                <h3><xsl:value-of select="@type"/></h3>
                  <xsl:for-each select="levels/level">
                    <li><xsl:value-of select="."/></li>
                  </xsl:for-each>
              </div>
            </xsl:for-each>
          </div>

      <div class="back-icon-container">
          <a href="javascript:history.back()" class="back-icon-btn">
            <i class="bi bi-arrow-left"></i>
          </a>
      </div>

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
