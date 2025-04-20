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
        <!-- meta tags -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description"
          content="A web-based portal for guardians and students to track learning progress and communicate with educators." />
        <meta name="keywords"
          content="guardian portal, student progress, school communication, learning management, education tools" />
        <meta name="author" content="Full House Learning Center" />

        <title>Home / FHLC</title>

        <!-- CSS FRAMEWORKS -->
        <link rel="stylesheet" href="css/lib/bootstrap.min.css" />
        <!-- ACCESSIBILITY STYLES -->
        <link id="style" rel="stylesheet" href="css/accessibility/none.css" />
      </head>
      <body>
        <!-- EXAMPLE -->
        <!--
          <a class="navbar-brand" href="#">
            <img src="{ $home/navbar/logo }" alt="Logo" style="height: 40px; margin-right: 10px;" />
            <xsl:value-of select="$home/navbar/title" />
          </a>
        -->

        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
          <a class="navbar-brand" href="#">
            <img src="{ $home/navbar/logo }" alt="Logo" style="height: 40px; margin-right: 10px;" />
            <xsl:value-of select="$home/navbar/title" />
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                  aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Separated link</a>
                </div>
              </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="text" placeholder="Search" />
              <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
          </div>
        </nav>


        <script type="text/javascript" src="js/style.js"> </script>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>
