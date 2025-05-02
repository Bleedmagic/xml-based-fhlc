<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns="http://www.w3.org/1999/php">

  <xsl:template name="navbar">
    <xsl:param name="currentPage" />

  <xsl:variable name="navbar"
      select="document('../../data/public/navbar.xml')/navbar" />

  <header class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-gray">
        <a class="navbar-brand d-flex align-items-center" href="#">
          <img src="{ $navbar/logo }" alt="Logo" style="height: 50px; margin-right: 10px;" />
          <xsl:value-of select="$navbar/brand" />
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse"
          data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarColor01">
          <ul class="navbar-nav">
            <!-- HOME -->
            <li>
              <xsl:attribute name="class"> nav-item<xsl:if test="$currentPage = 'home'"> active</xsl:if>
              </xsl:attribute>
              <a class="nav-link" href="home.php"> Home <xsl:if test="$currentPage = 'home'">
                  <span class="sr-only">(current)</span>
                </xsl:if>
              </a>
            </li>

            <!-- ABOUT -->
            <li>
              <xsl:attribute name="class"> nav-item<xsl:if test="$currentPage = 'about'"> active</xsl:if>
              </xsl:attribute>
              <a class="nav-link" href="about.php"> About <xsl:if test="$currentPage = 'about'">
                  <span class="sr-only">(current)</span>
                </xsl:if>
              </a>
            </li>

            <!-- CONTACT -->
            <li>
              <xsl:attribute name="class"> nav-item<xsl:if test="$currentPage = 'contact'"> active</xsl:if>
              </xsl:attribute>
              <a class="nav-link" href="contact.php"> Contact Us <xsl:if
                  test="$currentPage = 'contact'">
                  <span class="sr-only">(current)</span>
                </xsl:if>
              </a>
            </li>

            <!-- ANNOUNCEMENTS -->
            <li>
              <xsl:attribute name="class"> nav-item<xsl:if test="$currentPage = 'announcements'">
    active</xsl:if>
              </xsl:attribute>
              <a class="nav-link" href="announcements.php"> Announcements <xsl:if
                  test="$currentPage = 'announcements'">
                  <span class="sr-only">(current)</span>
                </xsl:if>
              </a>
            </li>

            <!-- ADMISSIONS DROPDOWN -->
            <li>
              <xsl:attribute name="class"> nav-item dropdown<xsl:if
                  test="$currentPage = 'admissions'"> active</xsl:if>
              </xsl:attribute>
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="true" aria-expanded="false">Admissions</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Admissions Process</a>
                <a class="dropdown-item" href="#">Forms &amp; Requirements</a>
                <a class="dropdown-item" href="#">Re-enrollment &amp; Withdrawal</a>
                <a class="dropdown-item" href="#">New Student Information</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Apply Now</a>
              </div>
            </li>
          </ul>
          <button class="btn btn-outline-info my-2 my-sm-0 ml-2">Login</button>
        </div>
      </nav>
    </header>
  </xsl:template>

</xsl:stylesheet>
