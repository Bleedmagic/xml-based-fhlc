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
        <link rel="apple-touch-icon" href="../../assets/img/favicons/apple-touch-icon.png"
          sizes="180x180" />
        <link rel="icon" href="../../assets/img/favicons/favicon-32x32.png" sizes="32x32"
          type="image/png" />
        <link rel="icon" href="../../assets/img/favicons/favicon-16x16.png" sizes="16x16"
          type="image/png"
        />
        <link rel="icon" href="../../assets/img/favicons/favicon.ico" />

        <!-- PAGE TITLE -->
        <title>About / FHLC</title>

        <!-- CSS LIB -->
        <!-- https://bootswatch.com/4/ -->
        <link rel="stylesheet" href="../../assets/css/lib/bootstrap.min.css" />
        <link rel="stylesheet" href="../../assets/css/icons/bootstrap-icons.min.css" />

        <!-- Custom Styles -->
        <link rel="stylesheet" href="../../assets/css/about.css" />
      </head>

      <!-- Header -->
      <xsl:call-template name="navbar">
        <xsl:with-param name="currentPage" select="'about'" />
      </xsl:call-template>

      <!-- Main -->
      <main role="main">
        <!-- Hero Section -->
        <section class="hero-section d-flex align-items-center justify-content-between px-5 py-5">
          <div class="hero-text">
            <h1>
              <xsl:value-of select="$about/header" />
            </h1>
            <h3>
              Providing <span class="text-yellow">Quality Education And Lifelong Learning Opportunities for Children Since 2001</span>
            </h3>

            <!-- Content Paragraphs -->
            <xsl:for-each select="$about/content">
              <p>
                <xsl:value-of select="." />
              </p>
            </xsl:for-each>
          </div>
          <div class="hero-image">
      <xsl:element name="img">
        <xsl:attribute name="src">
          <xsl:value-of select="$about/image" />
        </xsl:attribute>
        <xsl:attribute name="alt">About</xsl:attribute>
        <xsl:attribute name="class">img-fluid</xsl:attribute>
      </xsl:element>
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
    </html>
  </xsl:template>


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
