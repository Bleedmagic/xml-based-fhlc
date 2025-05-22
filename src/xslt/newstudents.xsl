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
<!--   <xsl:variable name="newstudents" select="document('../data/public/newstudents.xml')/newstudents" /> -->

  <xsl:template match="/enrollment">
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
        <title>New Students Enrollment / FHLC</title>

        <!-- CSS LIB -->
        <!-- https://bootswatch.com/4/ -->
        <link rel="stylesheet" href="../../assets/css/lib/bootstrap.min.css" />
        <link rel="stylesheet" href="../../assets/css/icons/bootstrap-icons.min.css" />

        <!-- Custom Styles -->
        <link rel="stylesheet" href="../../assets/css/newstudents.css" />
      </head>
      <body>
        <!-- Navbar -->
        <xsl:call-template name="navbar">
          <xsl:with-param name="currentPage" select="'admission'" />
        </xsl:call-template>

        <!-- Main Content -->
        <main class="container my-5">
          <h2>
            <xsl:value-of select="title" />
          </h2>

          <div class="step-container">
            <xsl:for-each select="steps/step">
              <div class="step-card">
                <div class="step-icon">
                  <i>
                    <xsl:choose>
                      <xsl:when test="@number='1'">
                        <xsl:attribute name="class">bi bi-download</xsl:attribute>
                      </xsl:when>
                      <xsl:when test="@number='2'">
                        <xsl:attribute name="class">bi bi-file-earmark-text</xsl:attribute>
                      </xsl:when>
                      <xsl:when test="@number='3'">
                        <xsl:attribute name="class">bi bi-building</xsl:attribute>
                      </xsl:when>
                      <xsl:when test="@number='4'">
                        <xsl:attribute name="class">bi bi-cash-stack</xsl:attribute>
                      </xsl:when>
                      <xsl:when test="@number='5'">
                        <xsl:attribute name="class">bi bi-person-circle</xsl:attribute>
                      </xsl:when>
                    </xsl:choose>
                  </i>
                </div>

                <h5>
                  <xsl:value-of select="title" />
                </h5>
                <p>
                  <xsl:value-of select="description" />
                </p>
                <div class="step-number">
                  <xsl:value-of select="@number" />
                </div>
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
