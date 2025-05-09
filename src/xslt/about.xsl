<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
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
  <xsl:variable name="about" select="document('../data/public/about.xml')/about" />

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
        <title>About / FHLC</title>

        <!-- CSS LIB -->
        <!-- https://bootswatch.com/4/ -->
        <link rel="stylesheet" href="./css/lib/bootstrap.min.css" />
        <link rel="stylesheet" href="./css/icons/bootstrap-icons.min.css" />

        <!-- Custom Styles -->
        <link rel="stylesheet" href="./css/custom.css" />
      </head>

      <!-- Header -->
      <xsl:call-template name="navbar">
        <xsl:with-param name="currentPage" select="'about'" />
      </xsl:call-template>

      <!-- Main -->
      <main role="main">
        <div class="container mt-5">
          <h1>About Us</h1>
          <xsl:apply-templates select="$about/description/p" />

          <div class="mission">
            <p>
              <xsl:value-of select="$about/mission/intro" />
            </p>
            <ul>
              <xsl:apply-templates select="$about/mission/goals/li" />
            </ul>
          </div>

          <div class="vision">
            <p>
              <xsl:value-of select="$about/vision" />
            </p>
          </div>
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

  <!-- <main role="main" class="container">
    <xsl:apply-templates select="$about/description/p" />

    <div class="mission">
      <p>
        <xsl:value-of select="$about/mission/intro" />
      </p>
      <ul>
        <xsl:apply-templates select="$about/mission/goals/li" />
      </ul>
    </div>

    <div class="vision">
      <p>
        <xsl:value-of select="$about/vision" />
      </p>
    </div>
  </main> -->

  <!-- Other XSL Templates -->
  <xsl:template match="p">
    <p>
      <xsl:value-of select="." />
    </p>
  </xsl:template>

  <xsl:template match="li">
    <li>
      <xsl:value-of select="." />
    </li>
  </xsl:template>
</xsl:stylesheet>
