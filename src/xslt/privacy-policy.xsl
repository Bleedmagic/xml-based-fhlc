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
  <xsl:variable name="privacy" select="document('../data/public/privacy-policy.xml')/privacy-policy" />

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
        <title>Privacy / FHLC</title>

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
          <h1><xsl:value-of select="$privacy/section/title" /></h1>
          <p>
            <xsl:copy-of select="$privacy/section/content/node()" />
          </p>
          <div class="index">
            <h3>Table of contents</h3>
            <ol class="index">
              <li>
                <a href="#collection-of-personal-information">Collection of personal information</a>
              </li>
              <li>
                <a href="#use-and-processing-of-collected-information">Use and processing of
    collected information</a>
              </li>
              <li>
                <a href="#managing-information">Managing information</a>
              </li>
              <li>
                <a href="#disclosure-of-information">Disclosure of information</a>
              </li>
              <li>
                <a href="#retention-of-information">Retention of information</a>
              </li>
              <li>
                <a href="#privacy-of-children">Privacy of children</a>
              </li>
              <li>
                <a href="#do-not-track-signals">Do Not Track signals</a>
              </li>
              <li>
                <a href="#social-media-features">Social media features</a>
              </li>
              <li>
                <a href="#email-marketing">Email marketing</a>
              </li>
              <li>
                <a href="#links-to-other-resources">Links to other resources</a>
              </li>
              <li>
                <a href="#information-security">Information security</a>
              </li>
              <li>
                <a href="#data-breach">Data breach</a>
              </li>
              <li>
                <a href="#changes-and-amendments">Changes and amendments</a>
              </li>
              <li>
                <a href="#acceptance-of-this-policy">Acceptance of this policy</a>
              </li>
              <li>
                <a href="#contacting-us">Contacting us</a>
              </li>
            </ol>
          </div>
          <h2 id="collection-of-personal-information">Collection of personal information</h2>
          <p>You can access and use the Website and Services without telling us who you are or
    revealing any information by which someone could identify you as a specific,
            identifiable individual. If, however, you wish to use some of the features offered on
            the Website, you may be asked to provide certain Personal Information (for example, your
    name and email address).</p>
          <p>We receive and store any information you knowingly provide to us when you create an
    account, publish content, or fill any forms on the Website. When required, this
            information may include the following:</p>
          <ul>
            <li>Account details (such as user name, unique user ID, password, etc)</li>
            <li>Contact information (such as email address, phone number, etc)</li>
            <li>Basic personal information (such as name, country of residence, etc)</li>
            <li>Information about other individuals (such as your family members, friends, etc)</li>
            <li>Any other materials you willingly submit to us (such as articles, images, feedback,
    etc)</li>
          </ul>
          <p>You can choose not to provide us with your Personal Information, but then you may not
            be able to take advantage of some of the features on the Website. Users who are
            uncertain about what information is mandatory are welcome to contact us.</p>
          <h2 id="use-and-processing-of-collected-information">Use and processing of collected
    information</h2>
          <p>We act as a data controller and a data processor when handling Personal Information,
    unless we have entered into a data processing agreement with you in which case you would
            be the data controller and we would be the data processor.</p>
          <p>Our role may also differ depending on the specific situation involving Personal
    Information. We act in the capacity of a data controller when we ask you to submit your
            Personal Information that is necessary to ensure your access and use of the Website and
    Services. In such instances, we are a data controller because we determine the purposes
            and means of the processing of Personal Information.</p>
          <p>We act in the capacity of a data processor in situations when you submit Personal
    Information through the Website and Services. We do not own, control, or make decisions
            about the submitted Personal Information, and such Personal Information is processed
            only in accordance with your instructions. In such instances, the User providing
            Personal Information acts as a data controller.</p>
          <p>In order to make the Website and Services available to you, or to meet a legal
    obligation, we may need to collect and use certain Personal Information. If you do not
            provide the information that we request, we may not be able to provide you with the
    requested products or services. Any of the information we collect from you may be used
            for the following purposes:</p>
          <ul>
            <li>Create and manage user accounts</li>
            <li>Respond to inquiries and offer support</li>
            <li>Run and operate the Website and Services</li>
          </ul>
          <p>Processing your Personal Information depends on how you interact with the Website and
    Services, where you are located in the world and if one of the following applies: (a)
            you have given your consent for one or more specific purposes; (b) provision of
    information is necessary for the performance of this Policy with you and/or for any
    pre-contractual obligations thereof; (c) processing is necessary for compliance with a
            legal obligation to which you are subject; (d) processing is related to a task that is
    carried out in the public interest or in the exercise of official authority vested in
            us; (e) processing is necessary for the purposes of the legitimate interests pursued by
    us or by a third party. We may also combine or aggregate some of your Personal
            Information in order to better serve you and to improve and update our Website and
    Services.</p>
          <p>Note that under some legislations we may be allowed to process information until you
    object to such processing by opting out, without having to rely on consent or any other
            of the legal bases. In any case, we will be happy to clarify the specific legal basis
    that applies to the processing, and in particular whether the provision of Personal
            Information is a statutory or contractual requirement, or a requirement necessary to
    enter into a contract.</p>
          <h2 id="managing-information">Managing information</h2>
          <p>You are able to delete certain Personal Information we have about you. The Personal
    Information you can delete may change as the Website and Services change. When you
            delete Personal Information, however, we may maintain a copy of the unrevised Personal
    Information in our records for the duration necessary to comply with our obligations to
            our affiliates and partners, and for the purposes described below. If you would like to
    delete your Personal Information or permanently delete your account, you can do so by
            contacting us.</p>
          <h2 id="disclosure-of-information">Disclosure of information</h2>
          <p>Depending on the requested Services or as necessary to complete any transaction or
    provide any Service you have requested, we may share your non-personally identifiable
            information with our contracted companies, and service providers (collectively, “Service
    Providers”) we rely upon to assist in the operation of the Website and Services
            available to you and whose privacy policies are consistent with ours or who agree to
    abide by our policies with respect to your information. We will not share any
            information with unaffiliated third parties.</p>
          <p>Service Providers are not authorized to use or disclose your information except as
    necessary to perform services on our behalf or comply with legal requirements. Service
            Providers are given the information they need only in order to perform their designated
    functions, and we do not authorize them to use or disclose any of the provided
            information for their own marketing or other purposes.</p>
          <p>We may also disclose any Personal Information we collect, use or receive if required or
    permitted by law, such as to comply with a subpoena or similar legal process, and when
            we believe in good faith that disclosure is necessary to protect our rights, protect
            your safety or the safety of others, investigate fraud, or respond to a government
    request.</p>
          <h2 id="retention-of-information">Retention of information</h2>
          <p>We will retain and use your Personal Information for the period necessary as long as
    your user account remains active, to enforce our Policy, resolve disputes, and unless a
            longer retention period is required or permitted by law.</p>
          <p>We may use any aggregated data derived from or incorporating your Personal Information
    after you update or delete it, but not in a manner that would identify you personally.
            Once the retention period expires, Personal Information shall be deleted. Therefore, the
    right to access, the right to erasure, the right to rectification, and the right to data
    portability cannot be enforced after the expiration of the retention period.</p>
          <h2 id="privacy-of-children">Privacy of children</h2>
          <p>We do not knowingly collect any Personal Information from children under the age of 13.
    If you are under the age of 13, please do not submit any Personal Information through
            the Website and Services. If you have reason to believe that a child under the age of 13
    has provided Personal Information to us through the Website and Services, please contact
            us to request that we delete that child’s Personal Information from our Services.</p>
          <p>We encourage parents and legal guardians to monitor their children’s Internet usage and
    to help enforce this Policy by instructing their children never to provide Personal
            Information through the Website and Services without their permission. We also ask that
    all parents and legal guardians overseeing the care of children take the necessary
            precautions to ensure that their children are instructed to never give out Personal
    Information when online without their permission.</p>
          <h2 id="do-not-track-signals">Do Not Track signals</h2>
          <p>Some browsers incorporate a Do Not Track feature that signals to websites you visit
    that you do not want to have your online activity tracked. Tracking is not the same as using or
    collecting information in connection with a website. For these purposes, tracking refers to
    collecting personally identifiable information from users who use or visit a website or online
    service as they move across different websites over time. How browsers communicate the Do Not
    Track signal is not yet uniform. As a result, the Website and Services are not yet set up to
    interpret or respond to Do Not Track signals communicated by your browser. Even so, as described
    in more detail throughout this Policy, we limit our use and collection of your Personal
    Information. For a description of Do Not Track protocols for browsers and mobile devices or to
    learn more about the choices available to you, visit <a href="https://www.internetcookies.com"
              ref="nofollow noreferrer noopener external">internetcookies.com</a></p>
          <h2 id="social-media-features">Social media features</h2>
          <p>Our Website and Services may include social media features, such as the Facebook and
    Twitter buttons, Share This buttons, etc (collectively, “Social Media Features”). These
            Social Media Features may collect your IP address, what page you are visiting on our
    Website and Services, and may set a cookie to enable Social Media Features to function
            properly. Social Media Features are hosted either by their respective providers or
    directly on our Website and Services. Your interactions with these Social Media Features
            are governed by the privacy policy of their respective providers.</p>
          <h2 id="email-marketing">Email marketing</h2>
          <p>We offer electronic newsletters to which you may voluntarily subscribe at any time. We
    are committed to keeping your email address confidential and will not disclose your
            email address to any third parties except as allowed in the information use and
    processing section or for the purposes of utilizing a third-party provider to send such
            emails. We will maintain the information sent via email in accordance with applicable
    laws and regulations.</p>
          <p>In compliance with the CAN-SPAM Act, all emails sent from us will clearly state who the
    email is from and provide clear information on how to contact the sender.</p>
          <h2 id="links-to-other-resources">Links to other resources</h2>
          <p>The Website and Services contain links to other resources that are not owned or
    controlled by us. Please be aware that we are not responsible for the privacy practices
            of such other resources or third parties. We encourage you to be aware when you leave
            the Website and Services and to read the privacy statements of each and every resource
    that may collect Personal Information.</p>
          <h2 id="information-security">Information security</h2>
          <p>We secure information you provide on computer servers in a controlled, secure
    environment, protected from unauthorized access, use, or disclosure. We maintain
            reasonable administrative, technical, and physical safeguards in an effort to protect
    against unauthorized access, use, modification, and disclosure of Personal Information
            in our control and custody. However, no data transmission over the Internet or wireless
    network can be guaranteed.</p>
          <p>Therefore, while we strive to protect your Personal Information, you acknowledge that
    (a) there are security and privacy limitations of the Internet which are beyond our
            control; (b) the security, integrity, and privacy of any and all information and data
    exchanged between you and the Website and Services cannot be guaranteed; and (c) any
            such information and data may be viewed or tampered with in transit by a third party,
    despite best efforts.</p>
          <p>As the security of Personal Information depends in part on the security of the device
    you use to communicate with us and the security you use to protect your credentials,
            please take appropriate measures to protect this information.</p>
          <h2 id="data-breach">Data breach</h2>
          <p>In the event we become aware that the security of the Website and Services has been
    compromised or Users’ Personal Information has been disclosed to unrelated third parties
            as a result of external activity, including, but not limited to, security attacks or
    fraud, we reserve the right to take reasonably appropriate measures, including, but not
            limited to, investigation and reporting, as well as notification to and cooperation with
    law enforcement authorities.</p>
          <p>In the event of a data breach, we will make reasonable efforts to notify affected
    individuals if we believe that there is a reasonable risk of harm to the User as a
            result of the breach or if notice is otherwise required by law. When we do, we will post
    a notice on the Website, send you an email. In jurisdictions where required, we may also
            report the breach to relevant authorities in accordance with applicable data protection
    regulations.</p>
          <h2 id="changes-and-amendments">Changes and amendments</h2>
          <p>We reserve the right to modify this Policy or its terms related to the Website and
    Services at any time at our discretion. When we do, we will revise the updated date at
            the bottom of this page. We may also provide notice to you in other ways at our
    discretion, such as through the contact information you have provided.</p>
          <p>An updated version of this Policy will be effective immediately upon the posting of the
    revised Policy unless otherwise specified. Your continued use of the Website and
            Services after the effective date of the revised Policy (or such other act specified at
    that time) will constitute your consent to those changes. However, we will not, without
            your consent, use your Personal Information in a manner materially different than what
    was stated at the time your Personal Information was collected.</p>
          <h2 id="acceptance-of-this-policy">Acceptance of this policy</h2>
          <p>You acknowledge that you have read this Policy and agree to all its terms and
    conditions. By accessing and using the Website and Services and submitting your information you
    agree to be bound by this Policy. If you do not agree to abide by the terms of this Policy, you
    are not authorized to access or use the Website and Services. <h2 id="contacting-us">Contacting
    us</h2>
          <p>If you have any questions, concerns, or complaints regarding this Policy, the
    information we hold about you, or if you wish to exercise your rights, we encourage you
              to contact us using the details below:</p>
          <p>
              <a
                href="&#109;&#097;&#105;&#108;&#116;&#111;&#058;fhl&#99;&#64;&#121;ma&#105;l.c&#111;&#109;">
    &#102;hl&#99;&#64;&#121;m&#97;&#105;&#108;.c&#111;m</a>
              <br />
              <a href="https://www.fhlc.com">fhlc.com</a>
            </p>
          <p>We will
    attempt to resolve complaints and disputes and make every reasonable effort to
              honor your wish to exercise your rights as quickly as possible and in any event,
              within
              the timescales provided by applicable data protection laws.</p>
          <p>If you believe your
    concerns have not been adequately addressed, you may escalate the
              matter to the appropriate data protection authority in your region, in accordance with
    applicable privacy laws.</p>
          <p>This document was last updated on <xsl:value-of select="$privacy/section/update" />.
            </p></p>
        </main>

        <!-- Footer -->
        <xsl:call-template name="footer">
          <xsl:with-param name="currentPage" select="'privacy-policy'" />
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
  <xsl:template match="p">
    <p>
      <xsl:value-of select="." />
    </p>
  </xsl:template>
</xsl:stylesheet>
