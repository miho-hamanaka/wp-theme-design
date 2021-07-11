<!DOCTYPE HTML>
<html lang="ja">
  <head>
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="format-detection" content="telephone=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--[if IE]><meta http-equiv="cleartype" content="on"><![endif]-->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=0" id="viewport">
  <meta charset="<?php bloginfo('charset'); ?>" />
  <title><?php echo wp_get_document_title(); ?>｜</title>
  <meta name="description" content="">
  <meta name="keywords" content="" />
  <link href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()); ?>/css/catering.css"> -->
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />
  <?php
  wp_enqueue_script('jquery');
  wp_head(); ?>
  <!-- <script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/.js"></script> -->
  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <script src="http://ie7-js.googlecode.com/svn/trunk/lib/IE9.js"></script>
  <![endif]-->
  <script type="application/ld+json">
      {
      "@context": "http://schema.org",
      "@type": "Organization",
      "name": "ホーム",
      "logo": "/img/common/header_logo_01.svg",
      "url": "",
      "contactPoint": [{
          "@type": "ContactPoint",
          "telephone": "03-6284-4501",
          "contactType": "Customer service"
      }],
      "address": [{
          "@type": "PostalAddress",
          "streetAddress": "東京都",
          "addressLocality": "Tokyo",
          "postalCode": "110-0005",
          "addressCountry": "Japan"
      }]
      }
  </script>

  </head>

  <body <?php body_class(); ?>>
  <!--header-->
  <div class="container">
    <header>
    </header>
