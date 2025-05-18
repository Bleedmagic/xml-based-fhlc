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
  <xsl:variable name="privacy" select="document('../data/public/privacy-policy.xml')/privacy-policy" />

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
          href="../../assets/img/favicons/apple-touch-icon.png"
          sizes="180x180"
        />
        <link
          rel="icon"
          href="../../assets/img/favicons/favicon-32x32.png"
          sizes="32x32"
          type="image/png"
        />
        <link
          rel="icon"
          href="../../assets/img/favicons/favicon-16x16.png"
          sizes="16x16"
          type="image/png"
        />
        <link rel="icon" href="../../assets/img/favicons/favicon.ico" />

        <!-- PAGE TITLE -->
        <title>Privacy / FHLC</title>

        <!-- CSS LIB -->
        <!-- https://bootswatch.com/4/ -->
        <link rel="stylesheet" href="../../assets/css/lib/bootstrap.min.css" />
        <link rel="stylesheet" href="../../assets/css/icons/bootstrap-icons.min.css" />

        <!-- Custom Styles -->
        <link rel="stylesheet" href="../../assets/css/custom.css" />
      </head>
      <body>
        <!-- Header -->
        <xsl:call-template name="navbar" />

        <!-- Main -->
        <main role="main" class="container my-5">
          <h1 class="mb-4 text-center">Privacy Policy</h1>

          <xsl:choose>
            <xsl:when test="$privacy/section">
              <xsl:for-each select="$privacy/section">
                <section class="mb-4">
                  <h2>
                    <xsl:value-of select="title" />
                  </h2>
                  <p>
                    <xsl:value-of select="content" />
                  </p>
                </section>
              </xsl:for-each>
            </xsl:when>
            <xsl:otherwise>
              <p>No privacy policy content available at this time.</p>
            </xsl:otherwise>
          </xsl:choose>
        </main>

        <!-- Footer -->
        <xsl:call-template name="footer">
          <xsl:with-param name="currentPage" select="'privacy-policy'" />
        </xsl:call-template>

        <!-- JS LIB -->
        <script type="text/javascript" src="../../assets/js/lib/jquery.min.js"></script>
        <script type="text/javascript" src="../../assets/js/lib/bootstrap.min.js"></script>

        <!-- Custom Scripts -->
        <script src="../../assets/js/custom.js"></script>
      </body>
    </html>
  </xsl:template>

  <!-- Other XSL Templates -->
  <!-- <xsl:template></xsl:template> -->
</xsl:stylesheet>
