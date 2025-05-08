<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:template name="navbar">
    <xsl:param name="currentPage" />
    <xsl:variable name="navbar"
      select="document('../../data/public/navbar.xml')/navbar" />

    <header class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-gray">
        <a class="navbar-brand d-flex align-items-center" href="{ $navbar/identity/link }">
          <img src="{ $navbar/identity/logo }" alt="Logo" style="height: 50px; margin-right: 10px;" />
          <xsl:value-of select="$navbar/identity/name" />
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse"
          data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarColor01">
          <ul class="navbar-nav">
            <xsl:for-each select="$navbar/menu/item[text != 'Login']">
              <li class="nav-item">
                <xsl:attribute name="class"> nav-item<xsl:if test="$currentPage = slug"> active</xsl:if></xsl:attribute>
                <a class="nav-link" href="{link}">
                  <xsl:value-of select="text" />
                  <xsl:if test="$currentPage = slug">
                    <span class="sr-only">(current)</span>
                  </xsl:if>
                </a>
              </li>
            </xsl:for-each>
          </ul>

          <xsl:for-each select="$navbar/menu/item[text = 'Login']">
            <a href="{link}">
              <button class="btn btn-success my-2 my-sm-0 ml-1 mr-1" type="button">
                <xsl:value-of select="text" />
              </button>
            </a>
          </xsl:for-each>
        </div>
      </nav>
    </header>
  </xsl:template>
</xsl:stylesheet>
