<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns="http://www.w3.org/1999/xhtml">

  <!-- Set Output to XHTML -->
  <xsl:output method="xml"
    doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN"
    doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
    indent="yes" />

  <!-- Variables to access the database XML files -->
  <xsl:variable name="about" select="document('../data/public.xml')/public/about-us" />

  <!-- Transform -->
  <xsl:template match="/">
    <html>
      <head>

        <!-- META TAGS -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description"
          content="A web-based portal for guardians and students to track learning progress and communicate with educators." />
        <meta name="keywords"
          content="guardian portal, student progress, school communication, learning management, education tools" />

        <!-- FAVICONS -->
        <link
          rel="apple-touch-icon"
          href="img/favicons/apple-touch-icon.png"
          sizes="180x180"
        />
        <link
          rel="icon"
          href="img/favicons/favicon-32x32.png"
          sizes="32x32"
          type="image/png"
        />
        <link
          rel="icon"
          href="img/favicons/favicon-16x16.png"
          sizes="16x16"
          type="image/png"
        />
        <link rel="icon" href="img/favicons/favicon.ico" />

        <!-- PAGE TITLE -->
        <title>About / FHLC</title>
        <!-- CSS FRAMEWORKS -->
        <link rel="stylesheet" href="css/lib/bootstrap.min.css" />

      </head>
      <body>

        <!-- About Us Description -->
        <xsl:apply-templates select="$about/description/p" />

        <!-- Mission -->
        <div class="mission">
          <p>
            <xsl:value-of select="$about/mission/intro" />
          </p>
          <ul>
            <xsl:apply-templates select="$about/mission/goals/li" />
          </ul>
        </div>

        <!-- Vision -->
        <div class="vision">
          <p>
            <xsl:value-of select="$about/vision" />
          </p>
        </div>

        <!-- JS FRAMEWORKS -->
        <script type="text/javascript" src="js/lib/jquery.min.js"></script>
        <script type="text/javascript" src="js/lib/bootstrap.min.js"></script>
      </body>
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
