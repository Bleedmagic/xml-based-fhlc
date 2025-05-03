<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template name="footer">
    <xsl:variable name="footer" select="document('../../data/public/footer.xml')/footer" />
    <footer class="footer py-2">
      <div class="text-center">

        <!-- Reach us at: -->
        <div class="mt-2 text-white" style="background-color: #1A906B;">

          <div class="pt-2">
            <a href="#link1" class="mr-3" style="font-size: 1.5em; text-decoration: none;">
              <i class="bi bi-facebook"></i>
            </a>
            <a href="#link2" class="mr-3" style="font-size: 1.5em; text-decoration: none;">
              <i class="bi bi-youtube"></i>
            </a>
            <a href="#link3" class="mr-3" style="font-size: 1.5em; text-decoration: none;">
              <i class="bi bi-instagram"></i>
            </a>
            <a href="#link3" class="mr-3" style="font-size: 1.5em; text-decoration: none;">
              <i class="bi bi-envelope"></i>
            </a>
            <a href="#link3" style="font-size: 1.5em; text-decoration: none;">
              <i class="bi bi-telephone"></i>
            </a>
          </div>

          <!-- Footer Links -->
          <div class="mt-2 mb-2 pb-2">
            <span class="h7">ABOUT FHLC | CONTACT US | ANNOUNCEMENTS | ADMISSIONS</span>
          </div>
        </div>

        <!-- Copyright -->
        <span class="font-weight-bold">
          &#169;
           <xsl:value-of select="$footer/copyright/year" /> /
           <xsl:value-of select="$footer/copyright/name" /> /
          <xsl:value-of select="$footer/copyright/text" />
        </span>
      </div>
    </footer>

  </xsl:template>
</xsl:stylesheet>
