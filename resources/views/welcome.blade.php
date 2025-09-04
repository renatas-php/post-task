<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>Drabužiai pagaminti Lietuvoje | Stitch Please</title>
        <meta name="description" content="Drabužiai pagaminti Lietuvoje, unikalūs mūsų kurti ir siųti moteriški ir vyriški drabužiai">
        <meta name="msapplication-TileColor" content="rgb(122 82 244)">
        <meta name="theme-color" content="rgb(122 82 244)">
        <meta name="DC.title" content="Drabužiai pagaminti Lietuvoje | Stitch Please">
        <meta name="DC.description" content="Drabužiai pagaminti Lietuvoje, unikalūs mūsų kurti ir siųti moteriški ir vyriški drabužiai">
        <meta name="og:image" content="https://stitchplease.lt/assets/logo.svg">
        <meta name="og:image:type" content="image/jpg">
        <meta name="og:description" content="Drabužiai pagaminti Lietuvoje, unikalūs mūsų kurti ir siųti moteriški ir vyriški drabužiai">
        <meta name="og:title" content="Drabužiai pagaminti Lietuvoje | Stitch Please">
        <meta name="og:type" content="website">
        <meta name="og:url" content="/">
        <meta name="og:site_name" content="Stitch Please">
        <meta name="author" content="Stitch Please">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@100..900&display=swap" rel="stylesheet">

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
    </head>
    <body>
        <div class="" id="app">
            <router-view></router-view>
        </div>
    </body>
    <!-- Google tag (gtag.js) --> 
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ETZ3LPX2CH"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}

            gtag('js', new Date());
            gtag('config', 'G-ETZ3LPX2CH');
        </script>
        <!-- End Google tag (gtag.js) --> 
        <!-- Cookie Consent by TermsFeed https://www.TermsFeed.com -->
        <script src="//www.termsfeed.com/public/cookie-consent/4.1.0/cookie-consent.js" charset="UTF-8"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                cookieconsent.run({
                    "notice_banner_type":"simple",
                    "consent_type":"express",
                    "palette":"light",
                    "language":"lt",
                    "page_load_consent_levels":["strictly-necessary"],
                    "notice_banner_reject_button_hide":false,
                    "preferences_center_close_button_hide":false,
                    "page_refresh_confirmation_buttons":false,
                    "callbacks": {
                    "scripts_specific_loaded": (level) => {
                                switch(level) {
                                    case 'targeting':
                                        gtag('consent', 'update', {
                                            'ad_storage': 'granted',
                                            'ad_user_data': 'granted',
                                            'ad_personalization': 'granted',
                                            'analytics_storage': 'granted'
                                        });
                                        break;
                                }
                            }
                        },
                        "callbacks_force": true
                });
            });
        </script>
        <!-- End Cookie Consent by TermsFeed https://www.TermsFeed.com -->
</html>
