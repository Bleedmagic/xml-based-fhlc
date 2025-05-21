<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns="http://www.w3.org/1999/xhtml">

  <xsl:output method="xml"
    doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN"
    doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
    indent="yes" />

  <xsl:include href="./shared/navbar.xsl" />
  <xsl:include href="./shared/footer.xsl" />

  <xsl:template match="/">
    <html>
      <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="apple-touch-icon" href="../../assets/img/favicons/apple-touch-icon.png" sizes="180x180" />
        <link rel="icon" href="../../assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png" />
        <link rel="icon" href="../../assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png" />
        <link rel="icon" href="../../assets/img/favicons/favicon.ico" />

        <title>Admission / FHLC</title>

        <!-- CSS LIB -->
        <link rel="stylesheet" href="../../assets/css/lib/bootstrap.min.css" />
        <link rel="stylesheet" href="../../assets/css/icons/bootstrap-icons.min.css" />

        <!-- Custom Styles -->
        <link rel="stylesheet" href="../../assets/css/admission.css" />
      </head>

      <body>
        <!-- Navbar -->
        <xsl:call-template name="navbar">
          <xsl:with-param name="currentPage" select="'admission'" />
        </xsl:call-template>

        <main class="container my-5">
          <h2 class="section-title">ADMISSIONS</h2>
          <div class="row">
            <xsl:for-each select="/admissions/cards/card">
              <div class="admission-card">
                <div class="card text-center p-4">
                  <i class="admission-icon">
                    <xsl:attribute name="class">
                      <xsl:text>bi admission-icon </xsl:text>
                      <xsl:value-of select="icon" />
                    </xsl:attribute>
                  </i>
                  <a>
                    <xsl:attribute name="href">
                      <xsl:value-of select="link" />
                    </xsl:attribute>
                    <xsl:attribute name="class">btn-style</xsl:attribute>
                    <xsl:value-of select="text" />
                  </a>
                </div>
              </div>
            </xsl:for-each>
          </div>
        </main>

        <!-- Footer -->
        <xsl:call-template name="footer" />

        <!-- JS -->
        <script type="text/javascript" src="../../assets/js/lib/jquery.min.js"></script>
        <script type="text/javascript" src="../../assets/js/lib/bootstrap.min.js"></script>
        <script src="../../assets/js/custom.js"></script>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>
