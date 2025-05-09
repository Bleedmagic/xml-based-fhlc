<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template name="footer">
    <xsl:variable name="footer" select="document('../../data/public/footer.xml')/footer" />
    <xsl:variable
      name="navbar" select="document('../../data/public/navbar.xml')/navbar" />

    <style>
      .icon-circle {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 2em;
      height: 2em;
      margin-right: 0.5rem;
      background-color: #fff;
      border-radius: 50%;
      transition: background-color 0.3s, color 0.3s;
      }

      .icon-circle i {
      font-size: 1.2em;
      }

      .icon-circle.facebook { color: #3b5998; }
      .icon-circle.facebook:hover {
      background-color: #3b5998;
      color: #fff;
      }

      .icon-circle.youtube { color: #FF0000; }
      .icon-circle.youtube:hover {
      background-color: #FF0000;
      color: #fff;
      }

      .icon-circle.instagram { color: #C13584; }
      .icon-circle.instagram:hover {
      background-color: #C13584;
      color: #fff;
      }

      .icon-circle.email { color: #6c757d; }
      .icon-circle.email:hover {
      background-color: #6c757d;
      color: #fff;
      }

      .icon-circle.phone { color: #28a745; }
      .icon-circle.phone:hover {
      background-color: #28a745;
      color: #fff;
      }

      .footer-link {
      color: white;
      text-decoration: none;
      transition: color 0.3s ease;
      }

      .footer-link:hover {
      color: #ddd;
      }
    </style>

    <footer
      class="footer py-2 mt-auto">
      <div class="text-center">

        <div class="mt-2 text-white" style="background-color: #1A906B;">
          <div class="pt-2">
            <xsl:for-each select="$footer/other/media">
              <xsl:choose>
                <xsl:when test="name='Facebook'">
                  <a href="{link}" class="icon-circle facebook" target="_blank">
                    <i class="bi bi-facebook"></i>
                  </a>
                </xsl:when>
                <xsl:when test="name='Instagram'">
                  <a href="{link}" class="icon-circle instagram" target="_blank">
                    <i class="bi bi-instagram"></i>
                  </a>
                </xsl:when>
                <xsl:when test="name='Youtube'">
                  <a href="{link}" class="icon-circle youtube" target="_blank">
                    <i class="bi bi-youtube"></i>
                  </a>
                </xsl:when>
                <xsl:when test="name='Email'">
                  <a href="{link}" class="icon-circle email" target="_blank">
                    <i class="bi bi-envelope"></i>
                  </a>
                </xsl:when>
                <xsl:when test="name='Phone'">
                  <a href="{link}" class="icon-circle phone" target="_blank">
                    <i class="bi bi-telephone"></i>
                  </a>
                </xsl:when>
              </xsl:choose>
            </xsl:for-each>
          </div>

          <div class="mt-2 mb-2 pb-2">
            <span class="h7">
              <a href="about.php" class="footer-link">ABOUT FHLC</a> | <a href="contact.php"
                class="footer-link">CONTACT US</a> | <a href="announcement.php" class="footer-link">
              ANNOUNCEMENTS</a> | <a href="admission.php" class="footer-link">ADMISSIONS</a>
            </span>
          </div>
        </div>

        <span class="font-weight-bold"> &#169; <xsl:text> </xsl:text>
        <xsl:value-of
            select="$footer/copyright/year" />
        <xsl:text disable-output-escaping="yes">&amp;nbsp;</xsl:text>
        <xsl:value-of
            select="$footer/copyright/name" />,<xsl:text disable-output-escaping="yes">&amp;nbsp;</xsl:text>
        <xsl:value-of
            select="$footer/copyright/text" />
        </span>
      </div>
    </footer>
  </xsl:template>
</xsl:stylesheet>
