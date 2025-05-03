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
  <xsl:variable name="home" select="document('../data/public/home.xml')/home" />

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
        <title>Home / FHLC</title>

        <!-- CSS LIB -->
        <!-- https://bootswatch.com/4/ -->
        <link rel="stylesheet" href="./css/lib/bootstrap.min.css" />
        <link rel="stylesheet" href="./css/icons/bootstrap-icons.min.css" />

        <!-- Custom Styles -->
        <link rel="stylesheet" href="css/custom.css" />
      </head>
      <body>
        <!-- Header -->
        <xsl:call-template name="navbar">
          <xsl:with-param name="currentPage" select="'home'" />
        </xsl:call-template>

        <!-- Main -->
        <main role="main">
          <!-- Hero Section -->
          <section class="hero-section text-center py-5">
            <div class="container">
              <h1 class="display-4">Welcome to FHLC</h1>
              <p class="lead">Your portal for tracking learning progress and communication.</p>
            </div>
          </section>

          <section class="container my-5">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem animi odit vero, tenetur dolore provident magni nam nemo corporis, sequi dicta a veritatis assumenda cupiditate voluptatem vitae necessitatibus reprehenderit obcaecati!
            Assumenda quia pariatur perspiciatis cupiditate corporis eum iste ratione, nulla aliquam sunt, enim, incidunt error molestiae sed repudiandae perferendis dicta deleniti suscipit molestias. Sint vitae voluptatibus sapiente dignissimos, nam quas.
            Quisquam, voluptatum commodi? Error ea nulla voluptatibus aliquam pariatur voluptatum, temporibus exercitationem iusto incidunt debitis in earum possimus tenetur! Voluptates autem cum modi velit amet esse necessitatibus nisi quia itaque?
            Atque voluptatem explicabo quod laudantium officia voluptatibus aliquam? Nobis inventore beatae ad quod dolore maxime eum excepturi! Ullam voluptates commodi expedita laborum necessitatibus amet quibusdam sequi ab, dolore distinctio assumenda?
            A ullam nihil maiores eum est explicabo enim dignissimos doloribus! Sunt voluptatem mollitia autem velit ad. Nesciunt repellendus ullam quae molestiae nam veritatis voluptatum at, tenetur recusandae quisquam adipisci quos?
            Similique molestiae expedita consequuntur exercitationem quas, eaque doloremque ea iure ad placeat, soluta, est tempora! Eos maiores expedita neque, autem inventore possimus dicta dolorem repellat totam similique, blanditiis recusandae illo.
            Saepe deleniti aliquid eum nostrum vel reiciendis, aut repellat ab necessitatibus eos quibusdam unde cumque quo quisquam voluptas asperiores numquam quod impedit? Nostrum voluptatibus est reprehenderit, hic maxime veritatis excepturi.
          </section>

        </main>

        <!-- Footer -->
        <xsl:call-template name="footer" />

        <!-- JS LIB -->
        <script type="text/javascript" src="js/lib/jquery.min.js"></script>
        <script type="text/javascript" src="js/lib/bootstrap.min.js"></script>
        <!-- <script type="text/javascript" src="js/lib/sweetalert2.all.min.js"></script> -->
        <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

        <!-- Custom Scripts -->
        <script src="../frontend/js/custom.js"></script>
      </body>
    </html>
  </xsl:template>

  <!-- Other XSL Templates -->
  <xsl:template match="p">
    <p>
      <xsl:value-of select="." />
    </p>
  </xsl:template>
</xsl:stylesheet>
