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
