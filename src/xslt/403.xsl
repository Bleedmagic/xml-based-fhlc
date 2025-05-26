<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns="http://www.w3.org/1999/xhtml">

  <!-- Set Output to XHTML -->
  <xsl:output method="xml"
    doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN"
    doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
    indent="yes" />

  <!-- Variables to access the database XML files -->
  <xsl:variable name="error" select="document('../data/public/403.xml')/error" />
  <xsl:variable name="assets-path" select="$error/assets" />

  <!-- Transform -->
  <xsl:template match="/">
    <html>
      <head>
        <!-- META TAGS -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- FAVICONS -->
        <link rel="apple-touch-icon" href="{$assets-path}img/favicons/apple-touch-icon.png"
          sizes="180x180" />
        <link rel="icon" href="{$assets-path}img/favicons/favicon-32x32.png" sizes="32x32"
          type="image/png" />
        <link rel="icon" href="{$assets-path}img/favicons/favicon-16x16.png" sizes="16x16"
          type="image/png" />
        <link rel="icon" href="{$assets-path}img/favicons/favicon.ico" />

        <!-- PAGE TITLE -->
        <title>403 / FHLC</title>

        <!-- CSS LIB -->
        <link rel="stylesheet" href="{$assets-path}css/lib/bootstrap.min.css" />
        <link rel="stylesheet" href="{$assets-path}css/icons/bootstrap-icons.min.css" />

        <!-- Custom Styles -->
        <link rel="stylesheet" href="{$assets-path}css/custom.css" />

        <style>
          body {
          background-color: #f8f9fa;
          }

          .container {
          display: flex;
          justify-content: center;
          align-items: center;
          min-height: 100vh;
          }

          .left-side {
          padding: 15px;
          }

          .right-side {
          padding: 15px;
          }

          h1 {
          font-size: 6rem;
          color: #dc3545;
          animation: glitch 1s infinite;
          }

          .quirky {
          font-size: 1.5rem;
          color: #D9534F;
          }

          @keyframes glitch {
          0% {
          text-shadow: 2px 0 red, -2px 0 blue;
          }

          20% {
          text-shadow: -2px 0 red, 2px 0 blue;
          }

          40% {
          text-shadow: 2px 0 red, -2px 0 blue;
          }

          60% {
          text-shadow: -2px 0 red, 2px 0 blue;
          }

          100% {
          text-shadow: 2px 0 red, -2px 0 blue;
          }
          }

          .return-link {
          font-size: 1.2rem;
          color: #007bff;
          text-decoration: none;
          margin-top: 20px;
          }

          .return-link:hover {
          text-decoration: underline;
          }
        </style>
      </head>
      <body>

        <main role="main" class="container">
          <div class="row">
            <div class="col-md-6 order-md-1 order-2">
              <img src="{$assets-path}img/default.png" alt="403 Image" class="img-fluid" />
            </div>

            <div class="col-md-6 order-md-2 order-1">
              <h1>
                <xsl:value-of select="$error/code" />
              </h1>
              <h2 class="quirky">
                <xsl:value-of select="$error/message" />
              </h2>
              <xsl:apply-templates select="$error/description/p" />
              <a href="/_XAMPP/XML-FHLC/src/frontend/auth/logout.php" class="return-link">
                <xsl:value-of select="$error/solution" /> &gt; </a>
            </div>
          </div>
        </main>

        <!-- JS LIB -->
        <script type="text/javascript" src="{$assets-path}js/lib/jquery.min.js"></script>
        <script type="text/javascript" src="{$assets-path}js/lib/bootstrap.min.js"></script>

        <!-- Custom Scripts -->
        <script src="{$assets-path}js/custom.js"></script>

        <script
          src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
        <script>
          confetti({
          particleCount: 150,
          spread: 100,
          origin: {
          y: 0.6
          }
          });
        </script>
      </body>
    </html>
  </xsl:template>

  <xsl:template match="p">
    <p class="lead">
      <xsl:value-of select="." />
    </p>
  </xsl:template>
</xsl:stylesheet>
