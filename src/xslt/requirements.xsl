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
<!--   <xsl:variable name="requirements" select="document('../data/public/requirements.xml')/requirements.xml" /> -->

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
        <title>New Applicant Requirements / FHLC</title>

        <!-- CSS LIB -->
        <!-- https://bootswatch.com/4/ -->
        <link rel="stylesheet" href="../../assets/css/lib/bootstrap.min.css" />
        <link rel="stylesheet" href="../../assets/css/icons/bootstrap-icons.min.css" />

        <!-- Custom Styles -->
        <link rel="stylesheet" href="../../assets/css/requirements.css" />
      </head>
      <body>
        <xsl:call-template name="navbar">
          <xsl:with-param name="currentPage" select="'admission'" />
        </xsl:call-template>

        <main class="container my-5">
          <h2>Requirements For New Applicants</h2>

          <xsl:for-each select="departments/department">
            <div class="row align-items-center mb-5">
              <xsl:choose>
                <!-- Even: Image left, Box right -->
                <xsl:when test="position() mod 2 = 0">
                  <div class="col-md-6 text-center">
                    <img>
                      <xsl:attribute name="src">
                        <xsl:choose>
                          <xsl:when test="@type = 'Preschool'">../../assets/img/req1.png</xsl:when>
                          <xsl:when test="@type = 'Elementary'">../../assets/img/req2.png</xsl:when>
                        </xsl:choose>
                      </xsl:attribute>
                      <xsl:attribute name="alt"><xsl:value-of select="@type" /></xsl:attribute>
                      <xsl:attribute name="class">img-fluid enrollment-image</xsl:attribute>
                      <xsl:attribute name="id"><xsl:value-of select="concat(@type, '-img')" /></xsl:attribute>
                    </img>
                  </div>
                  <div class="col-md-6">
                    <div>
                      <xsl:attribute name="class">department-box</xsl:attribute>
                      <xsl:attribute name="id"><xsl:value-of select="concat(@type, '-box')" /></xsl:attribute>

                      <h4>
                        <xsl:choose>
                          <xsl:when test="@type = 'Preschool'">🎒 Preschool Department</xsl:when>
                          <xsl:when test="@type = 'Elementary'">📘 Elementary Department</xsl:when>
                        </xsl:choose>
                      </h4>

                      <h5>Age Requirements</h5>
                      <ul>
                        <xsl:for-each select="ageRequirements/level">
                          <li><xsl:value-of select="."/></li>
                        </xsl:for-each>
                      </ul>

                      <h5>Required Credentials</h5>
                      <ol>
                        <xsl:for-each select="credentials/item">
                          <li><xsl:value-of select="."/></li>
                        </xsl:for-each>
                      </ol>
                    </div>
                  </div>
                </xsl:when>

                <!-- Odd: Box left, Image right -->
                <xsl:otherwise>
                  <div class="col-md-6">
                    <div>
                      <xsl:attribute name="class">department-box</xsl:attribute>
                      <xsl:attribute name="id"><xsl:value-of select="concat(@type, '-box')" /></xsl:attribute>

                      <h4>
                        <xsl:choose>
                          <xsl:when test="@type = 'Preschool'">🎒 Preschool Department</xsl:when>
                          <xsl:when test="@type = 'Elementary'">📘 Elementary Department</xsl:when>
                        </xsl:choose>
                      </h4>

                      <h5>Age Requirements</h5>
                      <ul>
                        <xsl:for-each select="ageRequirements/level">
                          <li><xsl:value-of select="."/></li>
                        </xsl:for-each>
                      </ul>

                      <h5>Required Credentials</h5>
                      <ol>
                        <xsl:for-each select="credentials/item">
                          <li><xsl:value-of select="."/></li>
                        </xsl:for-each>
                      </ol>
                    </div>
                  </div>
                  <div class="col-md-6 text-center">
                    <img>
                      <xsl:attribute name="src">
                        <xsl:choose>
                          <xsl:when test="@type = 'Preschool'">../../assets/img/req1.png</xsl:when>
                          <xsl:when test="@type = 'Elementary'">../../assets/img/req2.png</xsl:when>
                        </xsl:choose>
                      </xsl:attribute>
                      <xsl:attribute name="alt"><xsl:value-of select="@type" /></xsl:attribute>
                      <xsl:attribute name="class">img-fluid enrollment-image</xsl:attribute>
                      <xsl:attribute name="id"><xsl:value-of select="concat(@type, '-img')" /></xsl:attribute>
                    </img>
                  </div>
                </xsl:otherwise>
              </xsl:choose>
            </div>
          </xsl:for-each>
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
