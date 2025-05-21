<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:output method="html"
              doctype-public="-//W3C//DTD HTML 4.01 Transitional//EN"
              indent="yes"/>

  <!-- Includes -->
  <xsl:include href="./shared/navbar.xsl"/>
  <xsl:include href="./shared/footer.xsl"/>

  <xsl:template match="/admissions">
    <html>
      <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Admissions / FHLC</title>

        <!-- CSS Links -->
        <link rel="stylesheet" href="../../assets/css/lib/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"/>
        <link rel="stylesheet" href="../../assets/css/newstudents.css"/>
      </head>

      <body>
        <xsl:call-template name="navbar">
          <xsl:with-param name="currentPage" select="page"/>
        </xsl:call-template>

        <main class="container my-5">
        <div class="enrollment-container">
          <h2 class="text-center mb-4">Enrollment Process For New Students</h2>
          <div class="steps">
            <div class="step">
              <div class="icon"><i class="bi bi-download"></i></div>
              <p>Download and print the <a href="#">Enrollment Form</a><br/>(fill it out completely)</p>
              <div class="step-number">1</div>
            </div>
            <div class="step">
              <div class="icon"><i class="bi bi-files"></i></div>
              <p>Prepare the <a href="#">Required Documents</a></p>
              <div class="step-number">2</div>
            </div>
            <div class="step">
              <div class="icon"><i class="bi bi-building"></i></div>
              <p>Bring all completed requirements to the school for submission.</p>
              <div class="step-number">3</div>
            </div>
            <div class="step">
              <div class="icon"><i class="bi bi-cash-stack"></i></div>
              <p>After submitting your documents, proceed to the cashier to pay the enrollment fee.</p>
              <div class="step-number">4</div>
            </div>
            <div class="step">
              <div class="icon"><i class="bi bi-person-check"></i></div>
              <p>Once enrolled: Wait for Account Setup</p>
              <div class="step-number">5</div>
            </div>
          </div>
          <div class="text-center mt-4">
            <button class="btn btn-warning">Back</button>
          </div>
        </div>
        </main>

        <xsl:call-template name="footer"/>

        <script src="../../assets/js/lib/jquery.min.js"></script>
        <script src="../../assets/js/lib/bootstrap.min.js"></script>
        <script src="../../assets/js/custom.js"></script>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>
