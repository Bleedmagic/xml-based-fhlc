<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns="http://www.w3.org/1999/xhtml">

  <xsl:output method="xml"
    doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN"
    doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
    indent="yes" />

  <xsl:variable name="login" select="document('../data/public/login.xml')/login" />
  <xsl:variable name="users" select="document('../data/private/users.xml')/users" />

  <xsl:template match="/">
    <html>
      <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Login / FHLC</title>

        <link rel="stylesheet" href="../../../assets/css/lib/bootstrap.min.css" />
        <link rel="stylesheet" href="../../../assets/css/icons/bootstrap-icons.min.css" />

        <style>
          * {
            box-sizing: border-box;
          }

          body {
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            background-color: #ffffff;
          }

          .left-panel, .right-panel {
            width: 50%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
          }

          .left-panel {
            background-color: #fff;
          }

          .logo {
            width: 150px;
            height: 150px;
            margin-top: 20px;
          }

          h2 {
            margin-top: 20px;
            font-weight: bold;
            margin-bottom: 40px;
          }

          .form-box {
            width: 80%;
            max-width: 400px;
          }

          .input-group {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
            margin-bottom: 15px;
          }

          .input-group input[type="text"],
          .input-group input[type="password"] {
            width: 100%;
            padding: 10px 40px 10px 15px;
            border: 1px solid #ccc;
            border-radius: 20px;
            font-size: 16px;
            height: 45px;
            box-sizing: border-box;
            border: 2px solid black;
          }

          .input-group i {
            position: absolute;
            right: 15px;
            color: #555;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
          }

          .btn-login {
            background-color: #1A906B;
            color: #fff;
            width: 100%;
            border: none;
            border-radius: 25px;
            padding: 10px;
            font-size: 16px;
          }

          .btn-register {
            background-color: #1A906B;;
            border: 2px solid #1A906B;
            color: white;
            width: 100%;
            border-radius: 25px;
            padding: 10px;
            font-size: 16px;
          }

          .register-text {
            text-align: center;
            font-size: 16px;
            color: black;
            font-weight: 500;
            margin-top: 200px;
          }


          .forgot {
            text-align: right;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 20px;
          }

          .forgot a {
            color: #1A906B; /* Example: Bootstrap blue */
            text-decoration: none;
          }

          .forgot a:hover {
            color: #166f54
          }

          .home-icon {
            position: absolute;
            top: 20px;
            left: 30px;
          }

          .right-panel {
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
          }

          .right-panel .card-box {
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 20px;
            padding: 180px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 800px;
            height: 850px;
            align-items: center;
          }

          .right-panel .card-box img {
            width: 500px;
            height: auto;
            border-radius: 0;
            margin-top: 82px;
          }
        </style>
      </head>
      <body>
        <!-- Home Button -->
        <a href="../home.php" class="home-icon">
          <i class="bi bi-house-door" style="font-size: 32px; color: #1A906B;"></i>
        </a>


        <!-- Left Panel -->
        <div class="left-panel">
          <img class="logo">
            <xsl:attribute name="src"><xsl:value-of select="$login/page/logo" /></xsl:attribute>
          </img>
          <h2>Welcome Back!</h2>

          <form method="POST" action="login_validate.php" class="form-box">
            <div class="input-group">
              <input type="text" name="username" placeholder="Email" required="required" />
            </div>

            <div class="input-group">
              <input type="password" name="password" id="inputPassword" placeholder="Password" required="required" />
              <i class="bi bi-eye-slash" onclick="togglePassword()" id="toggleIcon"></i>
            </div>

            <div class="forgot">
              <a href="#">Forgot Password?</a>
            </div>

            <button type="submit" class="btn-login">Login</button>
            <p class="register-text">Don’t have an account? Register now!</p>
            <button type="button" onclick="window.location.href='register.php'" class="btn-register">Register</button>

          </form>
        </div>

        <!-- Right Panel -->
        <div class="right-panel">
          <div class="card-box">
            <p style="font-size: 24px; font-weight: bold;">
              Sign in and stay connected to your Full House experience.
            </p>
            <img src="../../../assets/img/login.png" alt="Illustration" />
          </div>
        </div>

        <!-- JS -->
        <script>
          function togglePassword() {
            const pw = document.getElementById("inputPassword");
            const icon = document.getElementById("toggleIcon");
            if (pw.type === "password") {
              pw.type = "text";
              icon.classList.remove("bi-eye-slash");
              icon.classList.add("bi-eye");
            } else {
              pw.type = "password";
              icon.classList.remove("bi-eye");
              icon.classList.add("bi-eye-slash");
            }
          }
        </script>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>
