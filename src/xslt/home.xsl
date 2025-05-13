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
        <link rel="apple-touch-icon" href="../../assets/img/favicons/apple-touch-icon.png"
              sizes="180x180" />
        <link rel="icon" href="../../assets/img/favicons/favicon-32x32.png" sizes="32x32"
              type="image/png" />
        <link rel="icon" href="../../assets/img/favicons/favicon-16x16.png" sizes="16x16"
              type="image/png" />
        <link rel="icon" href="../../assets/img/favicons/favicon.ico" />
    
        <!-- PAGE TITLE -->
        <title>Home / FHLC</title>

	<!-- CSS LIB -->
        <!-- https://bootswatch.com/4/ -->
        <link rel="stylesheet" href="../../assets/css/lib/bootstrap.min.css" />
        <link rel="stylesheet" href="../../assets/css/icons/bootstrap-icons.min.css" />

	<!-- Custom Styles -->
        <link rel="stylesheet" href="../../assets/css/home.css" />
      </head>
      <body>
	<!-- Header -->
        <xsl:call-template name="navbar">
          <xsl:with-param name="currentPage" select="'home'" />
        </xsl:call-template>

	<!-- Main -->
        <main role="main">
	        <!-- Hero Section -->
          <section class="hero-section d-flex align-items-center justify-content-between px-5 py-5">
            <div class="hero-text">
              <h1>
              Nurturing <span class="text-green">Young Minds</span> for <br/> a <span class="text-orange">Brighter</span> Tomorrow
              </h1>
              <p class="mt-3">
                <xsl:value-of select="$home/hero/paragraph" disable-output-escaping="yes" />
              </p>
            </div>
            <div class="hero-image">
              <xsl:element name="img">
                <xsl:attribute name="src">
                  <xsl:value-of select="$home/hero/image/@src" />
                </xsl:attribute>
                <xsl:attribute name="alt">
                  <xsl:value-of select="$home/hero/image/@alt" />
                </xsl:attribute>
                <xsl:attribute name="class">img-fluid</xsl:attribute>
              </xsl:element>
            </div>
          </section>

	  <!--Under Hero -->
          <section class="hero-section d-flex align-items-center justify-content-between px-5 py-5">
            <div class="Enrollment">
              <xsl:element name="img">
                <xsl:attribute name="src">
                  <xsl:value-of select="$home/enrollment/image/@src" />
                </xsl:attribute>
                <xsl:attribute name="alt">
                  <xsl:value-of select="$home/enrollment/image/@alt" />
                </xsl:attribute>
                <xsl:attribute name="class">img-fluid</xsl:attribute>
              </xsl:element>
            </div>
            <div class="hero-text">
              <h2>
                <xsl:value-of select="$home/enrollment/h2" />
              </h2>
              <p>
                <xsl:value-of select="$home/enrollment/paragraph" />
              </p>
              <ul>
                <xsl:for-each select="$home/enrollment/ul/li">
                  <li>
                    <xsl:value-of select="." />
                  </li>
                </xsl:for-each>
              </ul>
              <p class="mt-3">
                <xsl:value-of select="$home/enrollment/commitment" />
              </p>
              <xsl:element name="a">
                <xsl:attribute name="href">
                  <xsl:value-of select="$home/enrollment/enroll_button_link" />
                </xsl:attribute>
                <xsl:attribute name="class">btn btn-success</xsl:attribute>
                <xsl:value-of select="$home/enrollment/enroll_button_text" />
              </xsl:element>
            </div>
          </section>

	  <!--Under Hero 2-->
          <section class="hero-section d-flex align-items-center justify-content-between px-5 py-5">
            <div class="hero-text">
              <h2>
                <xsl:value-of select="$home/summer_class/h2" />
              </h2>
              <p>
                <xsl:value-of select="$home/summer_class/paragraph" />
              </p>
              <p class="mt-3">
                <xsl:value-of select="$home/summer_class/additional_info" />
              </p>
              <xsl:element name="a">
                <xsl:attribute name="href">
                  <xsl:value-of select="$home/summer_class/inquire_button_link" />
                </xsl:attribute>
                <xsl:attribute name="class">btn btn-success</xsl:attribute>
                <xsl:value-of select="$home/summer_class/inquire_button_text" />
              </xsl:element>
            </div>
            <div class="Summer">
              <xsl:element name="img">
                <xsl:attribute name="src">
                  <xsl:value-of select="$home/summer_class/image/@src" />
                </xsl:attribute>
                <xsl:attribute name="alt">
                  <xsl:value-of select="$home/summer_class/image/@alt" />
                </xsl:attribute>
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