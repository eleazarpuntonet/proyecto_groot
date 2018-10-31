<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
    <title>Api Home SPS</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
	@routes
	<div id="mainApp">

	</div>
    <script src="/js/jquery3.js"></script>
    <script src="/js/app.js"></script>
    <script src="/js/main.js"></script>
    <footer>Copyright Webstar® {{ date('Y') }}</footer>
</body>
</html>