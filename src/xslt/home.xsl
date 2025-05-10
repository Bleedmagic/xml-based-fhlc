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
          type="image/png"
        />
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
              <h1> Nurturing <span class="text-green">Young Minds</span> for <br> a <span
                    class="text-orange">Brighter</span> Tomorrow </br>
              </h1>
              <p class="mt-3">
              At Full House Learning Center, we nurture every child's potential <br>
              through purposeful learning, a caring environment, and programs that build strong </br>
              foundations for future success. 
              </p>
            </div>
            <div class="hero-image">
              <img src="../../assets/img/image.png" alt="Happy Student" class="img-fluid" />
            </div>
          </section>

          <!--Under Hero -->
          <section class="hero-section d-flex align-items-center justify-content-between px-5 py-5">
            <div class="Enrollment">
              <img src="../../assets/img/home1.png" alt="Enrollment" class="img-fluid" />
            </div>
            <div class="hero-text">
            <h2>Give Your Child the Gift of Early Learning!</h2>
                    <p>Full House Learning Center Inc.'s Early Enrollment Program for SY: 2025-2026</p>
                    <ul>
                      <li>Stable Tuition Rates</li>
                      <li>Flexible Payment Options</li>
                      <li>Exceptional Educational Opportunities</li>
                    </ul>
                    <p class="mt-3">We're committed to quality and affordability.</p>
                    <a href="#" class="btn btn-success">ENROLL NOW</a>
            </div> 
          </section>

          <!--Under Hero 2-->
          <section class="hero-section d-flex align-items-center justify-content-between px-5 py-5">
            <div class="hero-text">
            <h2>Looking for Summer Fun for Your Little One?</h2>
                    <p>Full House Learning Center Inc.  is offering a special Preschool Summer Class.</p>
                    <p class="mt-3">A wonderful way for children to stay engaged during the break! Our program provides a safe and caring place where children can grow and learn through fun experiences.</p>
                    <a href="#" class="btn btn-success">INQUIRE NOW</a>
            </div> 
            <div class="Summer">
              <img src="../../assets/img/home2.png" alt="Summer Class" class="img-fluid" />
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
