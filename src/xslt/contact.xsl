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
  <xsl:include href="./shared/footer.xsl" />
  <xsl:include href="./shared/navbar.xsl" />

  <!-- Variables to access the database XML files -->
  <xsl:variable name="contact" select="document('../data/public/contact.xml')/contact" />

  <!-- Transform -->
  <xsl:template match="/">
    <html>
      <head>
        <!-- META TAGS -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- FAVICONS -->
        <link rel="apple-touch-icon" href="../../assets/img/favicons/apple-touch-icon.png"
          sizes="180x180" />
        <link rel="icon" href="../../assets/img/favicons/favicon-32x32.png" sizes="32x32"
          type="image/png" />
        <link rel="icon" href="../../assets/img/favicons/favicon-16x16.png" sizes="16x16"
          type="image/png"
        />
        <link rel="icon" href="../../assets/img/favicons/favicon.ico" />

        <!-- PAGE TITLE -->
        <title>Contact / FHLC</title>

        <!-- CSS LIB -->
        <!-- https://bootswatch.com/4/ -->
        <link rel="stylesheet" href="../../assets/css/lib/bootstrap.min.css" />
        <link rel="stylesheet" href="../../assets/css/icons/bootstrap-icons.min.css" />

        <!-- Custom Styles -->
        <link rel="stylesheet" href="../../assets/css/contact.css" />
      </head>

      <!-- Header -->
      <xsl:call-template name="navbar">
        <xsl:with-param name="currentPage" select="'contact'" />
      </xsl:call-template>

      <!-- Main -->
      <main role="main">
        <div class="container contact-container mt-5 mb-5">
          <h2 class="contact-title text-center mb-4">Contact Us</h2>
          <div class="contact-box p-4">
            <div class="row">
              <!-- Left Column: Form -->
              <div class="col-md-6">
                <h5 class="mb-3">Leave us a message...</h5>
                <form>
                  <div class="form-group mb-2">
                    <input type="text" class="form-control input-custom" placeholder="Your Name" />
                  </div>
                  <div class="form-group mb-2">
                    <input type="email" class="form-control input-custom" placeholder="Email Address" />
                  </div>
                  <div class="form-group mb-3">
                    <textarea class="form-control input-custom" rows="4" placeholder="Your message..."></textarea>
                  </div>
                  <button type="submit" class="btn btn-submit">SUBMIT</button>
                </form>
              </div>

              <!-- Right Column: Contact Info from XML -->
              <div class="col-md-6 mt-4 mt-md-0">
                <p><strong><xsl:value-of select="$contact/organization/name" /></strong></p>
                <p>Address: <xsl:value-of select="$contact/organization/address" /></p>
                <p>
                  Contact Numbers:
                  <xsl:value-of select="$contact/organization/landline" /> (Landline) |
                  <xsl:value-of select="$contact/organization/mobile" /> (Mobile)
                </p>
                <p>Email: <xsl:value-of select="$contact/organization/email" /></p>
                <iframe
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3670.0394550612705!2d121.09285357487269!3d14.5943686858913!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b80bbadebcd7%3A0x32e8d0e0ce21ba66!2sFull%20House%20Learning%20Center%20Inc.!5e1!3m2!1sen!2sph!4v1747131196405!5m2!1sen!2sph"
                  allowfullscreen=""
                  loading="lazy"
                  referrerpolicy="no-referrer-when-downgrade"
                  class="contact-map">
                </iframe>
              </div>
            </div>
          </div>
        </div>
      </main>

      <!-- Footer -->
      <xsl:call-template name="footer" />

      <!-- JS LIB -->
      <script type="text/javascript" src="../../assets/js/lib/jquery.min.js"></script>
      <script type="text/javascript" src="../../assets/js/lib/bootstrap.min.js"></script>

      <!-- Custom Scripts -->
      <script src="../../assets/js/custom.js"></script>
    </html>
  </xsl:template>

  <!-- Other XSL Templates -->
  <!-- <xsl:template></xsl:template> -->
</xsl:stylesheet>
