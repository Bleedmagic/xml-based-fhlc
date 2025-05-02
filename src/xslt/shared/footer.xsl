<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template name="footer">
    <xsl:variable name="footer" select="document('../../data/public/footer.xml')/footer" />
            <footer
      class="footer py-3">
      <div class="container text-center">
        <span class="text-muted"> &#169;<xsl:value-of select="$footer/copyright" />
        </span>
        <div class="mt-2">
          <a href="#link1" class="mr-2">
            <i class="bi bi-facebook"></i>
          </a>
          <a href="#link2" class="mr-2">
            <i class="bi bi-youtube"></i>
          </a>
          <a href="#link3">
            <i class="bi bi-instagram"></i>
          </a>
        </div>
      </div>
    </footer>

  </xsl:template>
</xsl:stylesheet>
