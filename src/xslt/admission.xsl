<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:output method="html"
              doctype-public="-//W3C//DTD HTML 4.01 Transitional//EN"
              indent="yes"/>

  <!-- Includes -->
  <xsl:include href="./shared/navbar.xsl"/>
  <xsl:include href="./shared/footer.xsl"/>

  <xsl:template match="/admissions">
    <html>
      <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Admissions / FHLC</title>

        <!-- CSS Links -->
        <link rel="stylesheet" href="../../assets/css/lib/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"/>
        <link rel="stylesheet" href="../../assets/css/admission.css"/>
      </head>

      <body>
        <xsl:call-template name="navbar">
          <xsl:with-param name="currentPage" select="page"/>
        </xsl:call-template>

        <main class="container my-5">
          <h2>ADMISSIONS</h2>
          <div class="row justify-content-center">
            <xsl:for-each select="cards/card">
              <div class="col-md-5 m-3 admission-card text-center">
                <div class="card">
                  <i class="bi">
                    <xsl:attribute name="class">
                      <xsl:value-of select="concat('bi ', icon)"/>
                    </xsl:attribute>
                  </i>
                  <a href="{link}" class="btn-style">
                    <xsl:value-of select="text"/>
                  </a>
                </div>
              </div>
            </xsl:for-each>
          </div>
        </main>

        <xsl:call-template name="footer"/>

        <script src="../../assets/js/lib/jquery.min.js"></script>
        <script src="../../assets/js/lib/bootstrap.min.js"></script>
        <script src="../../assets/js/custom.js"></script>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>
