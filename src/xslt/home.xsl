<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns="http://www.w3.org/1999/xhtml">
  <!-- Set Output to XHTML -->
  <xsl:output method="xml"
    doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN"
    doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
    indent="yes" />

  <!-- Variables to access the database XML files -->
  <xsl:variable name="home" select="document('../data/home.xml')/homepage" />

  <!-- Transform -->
  <xsl:template match="/">
    <html>
      <head>
        <!-- <meta name="description" content="Hier finden Sie eine Übersicht aller Angebote." /> -->

        <!-- CSS FRAMEWORKS -->
        <!-- <link rel="stylesheet" href="css/lib/flatly.bootstrap.min.css" />
        <link rel="stylesheet" href="css/lib/flatly.custom.min.css" />
        <link rel="stylesheet" href="css/lib/glyphicon.css" /> -->

        <!-- ACCESSIBILITY STYLES -->
        <!-- <link id="style" rel="stylesheet" href="css/accessibility/none.css" />
        <script type="text/javascript" src="js/audio.js"> </script> -->

        <title>Home</title>
      </head>
      <body>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>
