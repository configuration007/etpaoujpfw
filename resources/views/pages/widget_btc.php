<div class="iframe_body">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Cantarell:wght@400;700&family=Inter:wght@300;400;500;600;700&family=Open+Sans:wght@400;600;700&family=Oxygen:wght@400;700&family=Roboto:wght@300;400;500;700&family=Ubuntu:wght@400;500;700&display=swap");

        canvas {
            height: 106px !important;
            width: 100% !important;
        }

        .iframe_body {
            position: relative;
            overflow: hidden
        }

        .iframe_body::after {
            position: absolute;
            bottom: 0px;
            left: 0;
            content: ' ';
            width: 100%;
            height: 8px;
            background-image: linear-gradient(180deg,#fff5e6, white);
        }

        a {
            display:none !important
        }

        span {
            opacity: 0;
            display:none !important
        }

    

        .iframe_a body {
            margin: 0 !important;
        }

        body ,html{
            margin: 0 !important;
            padding: 0 !important;
            height: 120px !important;

        }
        .header-div{height: 0!important;padding: 0 !important;;display: none !important;}

    </style>

    <script type="text/javascript">
        baseUrl = "https://widgets.cryptocompare.com/";
        var scripts = document.getElementsByTagName("script");
        var embedder = scripts[scripts.length - 1];
        var cccTheme = {
            "General": {
                "borderColor": "#fff",
                "borderRadius": "1px"
            },
            "Header": {
                "background": "#fff",
                "display":"none",
                "height":0
            },
            "Chart": {
                "animation": true,
                "fillColor": "rgb(255, 245, 230)",
                "borderColor": "rgba(255, 152, 0, 1)"
            }
        };
        (function() {
            var appName = encodeURIComponent(window.location.hostname);
            if (appName == "") {
                appName = "local";
            }
            var s = document.createElement("script");
            s.type = "text/javascript";
            s.async = true;
            var theUrl = baseUrl + 'serve/v1/coin/chart?fsym=BTC&tsym=USD';
            s.src = theUrl + (theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
            embedder.parentNode.appendChild(s);
        })();
    </script>


</div>
