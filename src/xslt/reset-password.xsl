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
  <xsl:variable name="reset-password"
    select="document('../data/public/reset-password.xml')/reset-password" />

  <!-- Transform -->
  <xsl:template match="/">
    <html>
      <head>
        <!-- META TAGS -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- FAVICONS -->
        <link rel="apple-touch-icon" href="../../../assets/img/favicons/apple-touch-icon.png"
          sizes="180x180" />
        <link rel="icon" href="../../../assets/img/favicons/favicon-32x32.png" sizes="32x32"
          type="image/png" />
        <link rel="icon" href="../../../assets/img/favicons/favicon-16x16.png" sizes="16x16"
          type="image/png" />
        <link rel="icon" href="../../../assets/img/favicons/favicon.ico" />

        <!-- PAGE TITLE -->
        <title>Reset Password / FHLC</title>

        <!-- CSS LIB -->
        <link rel="stylesheet" href="../../../assets/css/lib/bootstrap.min.css" />
        <link rel="stylesheet" href="../../../assets/css/icons/bootstrap-icons.min.css" />

        <!-- Custom Styles -->
        <link rel="stylesheet" href="../../../assets/css/custom.css" />
        <link rel="stylesheet" href="../../../assets/css/floating-labels.css" />

      </head>
      <body>
        <div class="container d-flex align-items-center justify-content-center"
          style="min-height: 100vh;">
          <!-- Centered Form -->
          <div class="col-lg-6">
            <form class="form-signin" method="POST" action="reset-password-handler.php"
              autocomplete="off">
              <div class="text-center mb-4">
                <img src="{ $reset-password/page/logo }" alt="Logo" width="100" height="100" />
                <h1 class="h3 mb-3 font-weight-normal">
                  <xsl:value-of select="$reset-password/page/title" />
                </h1>
                <p class="text-muted">
                  <xsl:value-of select="$reset-password/page/description" />
                </p>
              </div>

              <xsl:if test="$error_message != ''">
                <div id="reset-error" class="alert alert-danger" role="alert">
                  <xsl:value-of select="$error_message" disable-output-escaping="yes" />
                </div>
              </xsl:if>

              <!-- Hidden token field -->
              <input type="hidden" name="token" value="{$token}" />

              <div class="form-group form-label-group">
                <input type="password" id="inputPassword" name="password" class="form-control"
                  placeholder="New Password" required="required" minlength="8" />
                <label for="inputPassword">New Password</label>
                <i id="togglePasswordIcon" class="bi bi-eye-slash toggle-password"
                  onclick="togglePasswordVisibility('inputPassword', 'togglePasswordIcon')"
                  style="position:absolute; top:50%; right:15px; transform:translateY(-50%); cursor:pointer;"></i>
              </div>

              <div class="form-group form-label-group">
                <input type="password" id="inputConfirmPassword" name="confirm_password"
                  class="form-control" placeholder="Confirm New Password" required="required"
                  minlength="8" />
                <label for="inputConfirmPassword">Confirm New Password</label>
                <i id="toggleConfirmPasswordIcon" class="bi bi-eye-slash toggle-password"
                  onclick="togglePasswordVisibility('inputConfirmPassword', 'toggleConfirmPasswordIcon')"
                  style="position:absolute; top:50%; right:15px; transform:translateY(-50%); cursor:pointer;"></i>
              </div>

              <button class="btn btn-lg btn-primary btn-block btn-success" type="submit"
                id="reset-password-btn">Reset Password</button>

              <div class="text-center mt-4 mb-2">
                <a href="../home.php" class="text-success">
                  <i class="bi bi-house-door" style="font-size: 36px;"></i>
                </a>
              </div>
            </form>
          </div>
        </div>

        <!-- JS LIB -->
        <script type="text/javascript" src="../../../assets/js/lib/jquery.min.js"></script>
        <script type="text/javascript" src="../../../assets/js/lib/bootstrap.min.js"></script>

        <!-- Custom -->
        <script src="../../../assets/js/password-toggle.js"></script>
        <script>
          document.addEventListener('DOMContentLoaded', function () {
          const errorBox = document.getElementById('reset-error');
          const successBox = document.getElementById('reset-success');
          const inputPassword = document.getElementById('inputPassword');
          const inputConfirmPassword = document.getElementById('inputConfirmPassword');

          function hideError() {
          if (errorBox) errorBox.style.display = 'none';
          }
          function hideSuccess() {
          if (successBox) successBox.style.display = 'none';
          }

          if (inputPassword) inputPassword.addEventListener('input', hideError);
          if (inputConfirmPassword) inputConfirmPassword.addEventListener('input', hideError);
          });
        </script>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>
