<div class="iframe_body">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Cantarell:wght@400;700&family=Inter:wght@300;400;500;600;700&family=Open+Sans:wght@400;600;700&family=Oxygen:wght@400;700&family=Roboto:wght@300;400;500;700&family=Ubuntu:wght@400;500;700&display=swap");

        canvas {
            height: 383px !important;
            width: 100% !important;
        }

        .iframe_body {
            position: relative;
            overflow: hidden
        }

        .iframe_body::after {
            position: absolute;
            bottom: -5px;
            left: 0;
            content: ' ';
            width: 100%;
            height: 30px;
            background-image: linear-gradient(180deg,#fff5e6, white);
        }

        .graph_header {
            position: absolute;
            top: 10px;
            left: 0;
            content: ' ';
            width: 100%;
            height: 35px;
            background: white;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            justify-content: flex-start
        }

        .graph_header img {
            width: 25px;
            margin-right: 10px
        }

        .graph_header p {
            font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
                Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
            color: #3d3c3c;
            font-size: 16px;
            margin: 0;
        }

        a {
            display: flex;
            flex-direction: column;
        }

        span {
            opacity: 0
        }

        a span {
            opacity: 1 !important;
            font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
                Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
        }

        a span:first-child {
            margin-top:5px;
            margin-bottom:5px;
            width: 100%
        }

        a span:last-child {
            width: 100%
        }

        .iframe_a body {
            margin: 0 !important;
        }

        body {
            margin: 0 !important;
            padding: 0 !important;

        }

    </style>
    <div class="graph_header">
        <img src="/assets/images/prices-btc.svg" alt="">
        <p>Bitcoin (BTC)</p>
    </div>

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
                "background": "#fff"
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
