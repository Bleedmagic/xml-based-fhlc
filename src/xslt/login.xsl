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
  <xsl:variable name="login" select="document('../data/public/login.xml')/login" />
  <xsl:variable name="users" select="document('../data/private/users.xml')/users" />

  <!-- Transform -->
  <xsl:template match="/">
    <html>
      <head>
        <!-- META TAGS -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- FAVICONS -->
        <link rel="apple-touch-icon" href="img/favicons/apple-touch-icon.png" sizes="180x180" />
        <link rel="icon" href="img/favicons/favicon-32x32.png" sizes="32x32" type="image/png" />
        <link rel="icon" href="img/favicons/favicon-16x16.png" sizes="16x16" type="image/png" />
        <link rel="icon" href="../img/favicons/favicon.ico" />

        <!-- PAGE TITLE -->
        <title>Login / FHLC</title>

        <!-- CSS LIB -->
        <link rel="stylesheet" href="../css/lib/bootstrap.min.css" />
        <link rel="stylesheet" href="../css/icons/bootstrap-icons.min.css" />

        <!-- Custom Styles -->
        <link rel="stylesheet" href="../css/custom.css" />
        <link rel="stylesheet" href="../css/floating-labels.css" />
      </head>
      <body style="height: 100%; background-color: #f5f5f5;"
        class="d-flex align-items-center justify-content-center">

        <div id="account-data" style="display:none;">
          <xsl:for-each select="$users/user">
            <div class="account"
              data-username="{username}"
              data-password="{password}"
              data-role="{role}" />
          </xsl:for-each>
        </div>

        <!-- Main -->
        <form class="form-signin" method="POST" action="login_validate.php">
          <div class="text-center mb-4">
            <img class="mb-4">
              <xsl:attribute name="src">
                <xsl:value-of select="$login/page/logo" />
              </xsl:attribute>
              <xsl:attribute name="alt">Logo</xsl:attribute>
              <xsl:attribute name="width">100</xsl:attribute>
              <xsl:attribute name="height">100</xsl:attribute>
            </img>
            <h1 class="h3 mb-3 font-weight-normal">
              <xsl:value-of select="$login/page/title" />
            </h1>
            <p>
              <xsl:value-of select="$login/page/description" />
            </p>
          </div>

          <xsl:if test="$error_message != ''">
            <div id="login-error" class="alert alert-danger" role="alert">
              <xsl:value-of select="$error_message" />
            </div>
          </xsl:if>

          <div class="form-label-group">
            <input type="email" id="inputEmail" name="username" class="form-control"
              placeholder="Email address"
              required="required" autofocus="autofocus" maxlength="128" autocomplete="on" />
            <label for="inputEmail">Email address</label>
          </div>

          <div class="form-label-group position-relative">
            <input type="password" id="inputPassword" name="password" class="form-control"
              placeholder="Password" required="required" maxlength="45" autocomplete="on" />
            <label for="inputPassword">Password</label>
            <i class="bi bi-eye-slash toggle-password"
              style="position:absolute; top:50%; right:15px; transform:translateY(-50%); cursor:pointer;"
              onclick="togglePasswordVisibility()"></i>
          </div>

          <button class="btn btn-lg btn-primary btn-block" type="submit" id="login-btn">Sign in</button>
          <p class="mt-5 mb-3 text-muted text-center">&#169; <xsl:value-of select="$login/page/copyright" /></p>
        </form>

        <!-- JS LIB -->
        <script type="text/javascript" src="../js/lib/jquery.min.js"></script>
        <script type="text/javascript" src="../js/lib/bootstrap.min.js"></script>

        <!-- Custom -->
        <script src="../js/password-toggle.js"></script>

        <script>
          document.addEventListener('DOMContentLoaded', function () {
          const errorBox = document.getElementById('login-error');
          const inputEmail = document.getElementById('inputEmail');
          const inputPassword = document.getElementById('inputPassword');

          function hideError() {
          if (errorBox) errorBox.style.display = 'none';
          }

          if (inputEmail) inputEmail.addEventListener('input', hideError);
          if (inputPassword) inputPassword.addEventListener('input', hideError);
          });
        </script>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>
