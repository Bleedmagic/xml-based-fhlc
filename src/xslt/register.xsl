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
  <xsl:variable name="register" select="document('../data/public/register.xml')/register" />

  <!-- Error Message -->
  <xsl:param name="error_message" />

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
        <title>Register / FHLC</title>

        <!-- CSS LIB -->
        <link rel="stylesheet" href="../../../assets/css/lib/bootstrap.min.css" />
        <link rel="stylesheet" href="../../../assets/css/icons/bootstrap-icons.min.css" />

        <!-- Custom Styles -->
        <link rel="stylesheet" href="../../../assets/css/custom.css" />
        <link rel="stylesheet" href="../../../assets/css/floating-labels.css" />

      </head>
      <body>
        <div class="container">
          <a href="../home.php" class="home-icon text-success position-absolute"
            style="top: 20px; right: 30px;">
            <i class="bi bi-house-door" style="font-size: 36px;"></i>
          </a>

          <div class="row">

            <!-- Image -->
            <div class="col-lg-6 d-none d-lg-block shadow-lg">
              <img src="{ $register/page/decorative-image }" alt="Decorative image"
                class="img-fluid w-100 h-100"
                style="object-fit: contain;" />
            </div>

            <!-- Form -->
            <div class="col-lg-6">
              <form class="form-signin" method="POST" action="register_validate.php"
                autocomplete="off">
                <div class="text-center mb-4">
                  <img src="{ $register/page/logo }" alt="Logo" width="100" height="100" />
                  <h1 class="h3 mb-3 font-weight-normal">
                    <xsl:value-of select="$register/page/title" />
                  </h1>
                </div>

                <xsl:if test="$error_message != ''">
                  <div id="register-error" class="alert alert-danger" role="alert">
                    <xsl:value-of select="$error_message" disable-output-escaping="yes" />
                  </div>
                </xsl:if>

                <div class="form-row">
                  <div class="form-group col-md-6 form-label-group">
                    <input type="text" id="inputFirstName" name="first_name" class="form-control"
                      placeholder="First Name" required="required" maxlength="64"
                      autocomplete="given-name" />
                    <label for="inputFirstName">First Name</label>
                  </div>
                  <div class="form-group col-md-6 form-label-group">
                    <input type="text" id="inputLastName" name="last_name" class="form-control"
                      placeholder="Last Name" required="required" maxlength="64"
                      autocomplete="family-name" />
                    <label for="inputLastName">Last Name</label>
                  </div>
                </div>

                <div class="form-group form-label-group">
                  <input type="email" id="inputEmail" name="email" class="form-control"
                    placeholder="Email Address" required="required" maxlength="128"
                    autocomplete="email" />
                  <label for="inputEmail">Email Address</label>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6 form-label-group position-relative">
                    <input type="password" id="inputPassword" name="password" class="form-control"
                      placeholder="Password" required="required" maxlength="64"
                      autocomplete="new-password" />
                    <label for="inputPassword">Password</label>
                    <i id="togglePasswordIcon" class="bi bi-eye-slash toggle-password"
                      onclick="togglePasswordVisibility('inputPassword', 'togglePasswordIcon')"
                      style="position:absolute; top:50%; right:15px; transform:translateY(-50%); cursor:pointer;"></i>
                  </div>

                  <div class="form-group col-md-6 form-label-group position-relative">
                    <input type="password" id="inputConfirmPassword" name="confirm_password"
                      class="form-control"
                      placeholder="Confirm Password" required="required" maxlength="64"
                      autocomplete="new-password" />
                    <label for="inputConfirmPassword">Confirm Password</label>
                    <i id="toggleConfirmPasswordIcon" class="bi bi-eye-slash toggle-password"
                      onclick="togglePasswordVisibility('inputConfirmPassword', 'toggleConfirmPasswordIcon')"
                      style="position:absolute; top:50%; right:15px; transform:translateY(-50%); cursor:pointer;"></i>
                  </div>
                </div>

                <div class="form-check my-3">
                  <input class="form-check-input" type="checkbox" id="termsCheckbox" name="terms"
                    required="required" />
                  <label class="form-check-label" for="termsCheckbox">
                    <xsl:copy-of select="$register/page/checkbox/node()"
                      disable-output-escaping="yes" />
                  </label>
                </div>

                <button class="btn btn-lg btn-primary btn-block btn-success" type="submit"
                  id="register-btn">Register</button>

                <p class="mt-5 mb-0 text-muted text-center">
                  <xsl:copy-of select="$register/page/forgot-password/node()"
                    disable-output-escaping="yes" />
                </p>

                <p class="mt-1 mb-3 text-muted text-center">
                  <xsl:copy-of select="$register/page/call-to-action/node()"
                    disable-output-escaping="yes" />
                </p>
              </form>
            </div>

          </div>
        </div>

        <!-- JS LIB -->
        <script type="text/javascript" src="../../../assets/js/lib/jquery.min.js"></script>
        <script type="text/javascript" src="../../../assets/js/lib/bootstrap.min.js"></script>

        <!-- Custom -->
        <script src="../../../assets/js/password-toggle.js"></script>
        <script>
          document.addEventListener('DOMContentLoaded', function () {
          const errorBox = document.getElementById('register-error');
          const inputFirstName = document.getElementById('inputFirstName');
          const inputLastName = document.getElementById('inputLastName');
          const inputEmail = document.getElementById('inputEmail');
          const inputPassword = document.getElementById('inputPassword');

          function hideError() {
          if (errorBox) errorBox.style.display = 'none';
          }

          if (inputFirstName) inputFirstName.addEventListener('input', hideError);
          if (inputLastName) inputLastName.addEventListener('input', hideError);
          if (inputEmail) inputEmail.addEventListener('input', hideError);
          if (inputPassword) inputPassword.addEventListener('input', hideError);
          });
        </script>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>
