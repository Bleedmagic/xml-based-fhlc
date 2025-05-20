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
  <!-- <xsl:variable name="admission" select="document('../data/public/about.xml')/admission" /> -->

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
        <title>Admission / FHLC</title>

        <!-- CSS LIB -->
        <!-- https://bootswatch.com/4/ -->
        <link rel="stylesheet" href="../../assets/css/lib/bootstrap.min.css" />
        <link rel="stylesheet" href="../../assets/css/icons/bootstrap-icons.min.css" />

        <!-- Custom Styles -->
        <link rel="stylesheet" href="../../assets/css/admission.css" />
      </head>

      <body>
        <xsl:call-template name="navbar">
          <xsl:with-param name="currentPage" select="'admission'" />
        </xsl:call-template>

        <main class="container my-5">
          <h2>ADMISSIONS</h2>
          <div class="row justify-content-center">

            <div class="col-md-5 m-3 admission-card text-center">
              <div class="card">
                <i class="bi bi-gear-wide-connected"></i>
                <a href="#" class="btn-style">Enrollment Process For New Students</a>

              </div>
            </div>

            <div class="col-md-5 m-3 admission-card text-center">
              <div class="card">
                <i class="bi bi-file-earmark-text"></i>
                <a href="#" class="btn-style">Enrollment Process For Current Students</a>
              </div>
            </div>

            <div class="col-md-5 m-3 admission-card text-center">
              <div class="card">
                <i class="bi bi-file-earmark-check"></i>
                <a href="#" class="btn-style">Grade Levels Offered</a>
              </div>
            </div>

            <div class="col-md-5 m-3 admission-card text-center">
              <div class="card">
                <i class="bi bi-patch-plus"></i>
                <a href="#" class="btn-style">Requirements for New Applicants</a>
              </div>
            </div>

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
