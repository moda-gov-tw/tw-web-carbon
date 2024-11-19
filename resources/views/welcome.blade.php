<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link type="image/svg+xml" href="" rel="icon">
    <link type="image/png" href="" rel="icon">
    <title inertia>{{ config('app.name', 'Carbon') }}</title>

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Scripts -->
    @routes(nonce: 'qweras789qqaaeeee12345687dfzxccccv')
    @vite(['resources/js/home.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="bg-dark">
    <noscript>
        <strong>
            <h1 aria-hidden="true">偵測到您目前的瀏覽器未開啟JavaScript功能，在此情形下本網站無法正常使用，請開啟瀏覽器的JavaScript支援。</h1>
        </strong>
    </noscript>
    @inertia
    <script src="main.js"></script>
</body>

</html>
