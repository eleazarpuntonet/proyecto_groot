<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="author" content="Eleazar Ortega">
        <link rel="icon" href="../../../../favicon.ico">

        <title>Core UI | Proyecto Groot</title>
        <link rel="stylesheet" href="/css/app.css">

        <title>CoreUI - Vue Open Source Bootstrap Admin Template</title>
        {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script> --}}
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          // Shared ID
          gtag('config', 'UA-118965717-3');
          // Vue.js ID
          gtag('config', 'UA-118965717-7');
        </script>
    </head>

  <!-- BODY options, add following classes to body to change options

  // Header options
  1. '.header-fixed'        - Fixed Header

  // Sidebar options
  1. '.sidebar-fixed'       - Fixed Sidebar
  2. '.sidebar-hidden'      - Hidden Sidebar
  3. '.sidebar-off-canvas'  - Off Canvas Sidebar
  4. '.sidebar-minimized'       - Minimized Sidebar (Only icons)
  5. '.sidebar-compact'     - Compact Sidebar

  // Aside options
  1. '.aside-menu-fixed'        - Fixed Aside Menu
  2. '.aside-menu-hidden'       - Hidden Aside Menu
  3. '.aside-menu-off-canvas'     - Off Canvas Aside Menu

  // Footer options
  1. 'footer-fixed'     - Fixed footer

  -->

  <body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <div id="app"></div>
    <h1>Estas en HomeCore</h1>
    <!-- built files will be auto injected -->
    <script src="/js/jquery3.js"></script>
    <script src="/js/app.js"></script>
    <script src="/js/main.js"></script>
    <footer>Copyright ® {{ date('Y') }}</footer>
  </body>
</html>