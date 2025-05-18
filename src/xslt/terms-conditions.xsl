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
  <xsl:variable name="terms"
    select="document('../data/public/terms-conditions.xml')/terms-conditions" />

  <!-- Transform -->
  <xsl:template match="/">
    <html>
      <head>
        <!-- META TAGS -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- FAVICONS -->
        <link
          rel="apple-touch-icon"
          href="../../assets/img/favicons/apple-touch-icon.png"
          sizes="180x180"
        />
        <link
          rel="icon"
          href="../../assets/img/favicons/favicon-32x32.png"
          sizes="32x32"
          type="image/png"
        />
        <link
          rel="icon"
          href="../../assets/img/favicons/favicon-16x16.png"
          sizes="16x16"
          type="image/png"
        />
        <link rel="icon" href="../../assets/img/favicons/favicon.ico" />

        <!-- PAGE TITLE -->
        <title>Terms / FHLC</title>

        <!-- CSS LIB -->
        <!-- https://bootswatch.com/4/ -->
        <link rel="stylesheet" href="../../assets/css/lib/bootstrap.min.css" />
        <link rel="stylesheet" href="../../assets/css/icons/bootstrap-icons.min.css" />

        <!-- Custom Styles -->
        <link rel="stylesheet" href="../../assets/css/custom.css" />
      </head>
      <body>
        <!-- Header -->
        <xsl:call-template name="navbar" />

        <!-- Main -->
        <main role="main" class="container my-5">
          <h1><xsl:value-of select="$terms/section/title"/></h1>
          <p><xsl:copy-of select="$terms/section/content/node()" /></p>

          <div class="index">
            <h3>Table of contents</h3>
            <ol class="index">
              <li>
                <a href="#accounts-and-membership">Accounts and membership</a>
              </li>
              <li>
                <a href="#user-content">User content</a>
              </li>
              <li>
                <a href="#backups">Backups</a>
              </li>
              <li>
                <a href="#links-to-other-resources">Links to other resources</a>
              </li>
              <li>
                <a href="#prohibited-uses">Prohibited uses</a>
              </li>
              <li>
                <a href="#indemnification">Indemnification</a>
              </li>
              <li>
                <a href="#severability">Severability</a>
              </li>
              <li>
                <a href="#dispute-resolution">Dispute resolution</a>
              </li>
              <li>
                <a href="#changes-and-amendments">Changes and amendments</a>
              </li>
              <li>
                <a href="#acceptance-of-these-terms">Acceptance of these terms</a>
              </li>
              <li>
                <a href="#contacting-us">Contacting us</a>
              </li>
            </ol>
          </div>
          <h2 id="accounts-and-membership">Accounts and membership</h2>
          <p>If you create an account on the Website, you are responsible for maintaining the
    security of your account and you are fully responsible for all activities that occur
            under the account and any other actions taken in connection with it. We may monitor and
    review new accounts before you may sign in and start using the Services. Providing false
            contact information of any kind may result in the termination of your account. You must
    immediately notify us of any unauthorized uses of your account or any other breaches of
            security. We will not be liable for any acts or omissions by you, including any damages
    of any kind incurred as a result of such acts or omissions. We may suspend, disable, or
            delete your account (or any part thereof) if we determine that you have violated any
    provision of this Agreement or that your conduct or content would tend to damage our
            reputation and goodwill. If we delete your account for the foregoing reasons, you may
            not re-register for our Services. We may block your email address and Internet protocol
    address to prevent further registration.</p>
          <h2 id="user-content">User content</h2>
          <p>We do not own any data, information or material (collectively, “Content”) that you
    submit on the Website in the course of using the Service. You shall have sole
            responsibility for the accuracy, quality, integrity, legality, reliability,
    appropriateness, and intellectual property ownership or right to use of all submitted
            Content. We may monitor and review the Content on the Website submitted or created using
    our Services by you. You grant us permission to access, copy, distribute, store,
            transmit, reformat, display and perform the Content of your user account solely as
    required for the purpose of providing the Services to you. Without limiting any of those
    representations or warranties, we have the right, though not the obligation, to, in our
            own sole discretion, refuse or remove any Content that, in our reasonable opinion,
    violates any of our policies or is in any way harmful or objectionable. You also grant
            us the license to use, reproduce, adapt, modify, publish or distribute the Content
    created by you or stored in your user account for commercial, marketing or any similar
            purpose.</p>
          <h2 id="backups">Backups</h2>
          <p>We are not responsible for the Content residing on the Website. In no event shall we be
    held liable for any loss of any Content. It is your sole responsibility to maintain
            appropriate backup of your Content. Notwithstanding the foregoing, on some occasions and
    in certain circumstances, with absolutely no obligation, we may be able to restore some
            or all of your data that has been deleted as of a certain date and time when we may have
    backed up data for our own purposes. We make no guarantee that the data you need will be
    available.</p>
          <h2 id="links-to-other-resources">Links to other resources</h2>
          <p>Although the Website and Services may link to other resources (such as websites, mobile
    applications, etc.), we are not, directly or indirectly, implying any approval,
            association, sponsorship, endorsement, or affiliation with any linked resource, unless
    specifically stated herein. We are not responsible for examining or evaluating, and we
            do not warrant the offerings of, any businesses or individuals or the content of their
    resources. We do not assume any responsibility or liability for the actions, products,
            services, and content of any other third parties. You should carefully review the legal
    statements and other conditions of use of any resource which you access through a link
            on the Website. Your linking to any other off-site resources is at your own risk.</p>
          <h2 id="prohibited-uses">Prohibited uses</h2>
          <p>In addition to other terms as set forth in the Agreement, you are prohibited from using
    the Website and Services or Content: (a) for any unlawful purpose; (b) to solicit others
            to perform or participate in any unlawful acts; (c) to violate any international,
    federal, provincial or state regulations, rules, laws, or local ordinances; (d) to
            infringe upon or violate our intellectual property rights or the intellectual property
    rights of others; (e) to harass, abuse, insult, harm, defame, slander, disparage,
            intimidate, or discriminate based on gender, sexual orientation, religion, ethnicity,
    race, age, national origin, or disability; (f) to submit false or misleading
            information; (g) to upload or transmit viruses or any other type of malicious code that
    will or may be used in any way that will affect the functionality or operation of the
            Website and Services, third party products and services, or the Internet; (h) to spam,
    phish, pharm, pretext, spider, crawl, or scrape; (i) for any obscene or immoral purpose;
            or (j) to interfere with or circumvent the security features of the Website and
            Services, third party products and services, or the Internet. We reserve the right to
    terminate your use of the Website and Services for violating any of the prohibited uses.</p>
          <h2 id="indemnification">Indemnification</h2>
          <p>You agree to indemnify and hold FHLC Inc. and its affiliates, directors, officers,
    employees, agents, suppliers and licensors harmless from and against any liabilities,
            losses, damages or costs, including reasonable attorneys’ fees, incurred in connection
    with or arising from any third party allegations, claims, actions, disputes, or demands
            asserted against any of them as a result of or relating to your Content, your use of the
    Website and Services or any willful misconduct on your part.</p>
          <h2 id="severability">Severability</h2>
          <p>All rights and restrictions contained in this Agreement may be exercised and shall be
    applicable and binding only to the extent that they do not violate any applicable laws
            and are intended to be limited to the extent necessary so that they will not render this
    Agreement illegal, invalid or unenforceable. If any provision or portion of any
            provision of this Agreement shall be held to be illegal, invalid or unenforceable by a
    court of competent jurisdiction, it is the intention of the parties that the remaining
            provisions or portions thereof shall constitute their agreement with respect to the
    subject matter hereof, and all such remaining provisions or portions thereof shall
            remain in full force and effect.</p>
          <h2 id="dispute-resolution">Dispute resolution</h2>
          <p>The formation, interpretation, and performance of this Agreement and any disputes
    arising out of it shall be governed by the substantive and procedural laws of
            Philippines without regard to its rules on conflicts or choice of law and, to the extent
    applicable, the laws of Philippines. The exclusive jurisdiction and venue for actions
            related to the subject matter hereof shall be the courts located in Philippines, and you
    hereby submit to the personal jurisdiction of such courts. You hereby waive any right to
            a jury trial in any proceeding arising out of or related to this Agreement. The United
    Nations Convention on Contracts for the International Sale of Goods does not apply to
            this Agreement.</p>
          <h2 id="changes-and-amendments">Changes and amendments</h2>
          <p>We reserve the right to modify this Agreement or its terms related to the Website and
    Services at any time at our discretion. When we do, we will revise the updated date at
            the bottom of this page. We may also provide notice to you in other ways at our
    discretion, such as through the contact information you have provided.</p>
          <p>An updated version of this Agreement will be effective immediately upon the posting of
    the revised Agreement unless otherwise specified. Your continued use of the Website and
            Services after the effective date of the revised Agreement (or such other act specified
    at that time) will constitute your consent to those changes.</p>
          <h2 id="acceptance-of-these-terms">Acceptance of these terms</h2>
          <p>You acknowledge that you have read this Agreement and agree to all its terms and
    conditions. By accessing and using the Website and Services you agree to be bound by this
    Agreement. If you do not agree to abide by the terms of this Agreement, you are not authorized
            to access or use the Website and Services.</p>
          <h2 id="contacting-us">Contacting us</h2>
          <p>If you have any questions, concerns, or complaints regarding this Agreement, we
    encourage you to contact us using the details below:</p>
          <p>
            <a
              href="&#109;&#097;&#105;&#108;&#116;&#111;&#058;fhlc&#64;y&#109;&#97;&#105;l&#46;&#99;&#111;m">
    &#102;h&#108;&#99;&#64;y&#109;ai&#108;.co&#109;</a>
          </p>

          <p>This document was last updated on <xsl:value-of select="$terms/section/update" />. <p>
            </p>
          </p>
        </main>

        <!-- Footer -->
        <xsl:call-template name="footer">
          <xsl:with-param name="currentPage" select="'terms-conditions'" />
        </xsl:call-template>

        <!-- JS LIB -->
        <script type="text/javascript" src="../../assets/js/lib/jquery.min.js"></script>
        <script type="text/javascript" src="../../assets/js/lib/bootstrap.min.js"></script>

        <!-- Custom Scripts -->
        <script src="../../assets/js/custom.js"></script>
      </body>
    </html>
  </xsl:template>

  <!-- Other XSL Templates -->
  <!-- <xsl:template></xsl:template> -->
</xsl:stylesheet>
