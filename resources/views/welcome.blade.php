<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
                background-image: url({{ asset('/img/cover.png') }});
                background-position: cover;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                color: #ffffff;
                font-size: 96px;
                text-shadow: 0 1px 0 #ccc,
                   0 2px 0 #c9c9c9,
                   0 3px 0 #bbb,
                   0 4px 0 #b9b9b9,
                   0 5px 0 #aaa,
                   0 6px 1px rgba(0,0,0,.1),
                   0 0 5px rgba(0,0,0,.1),
                   0 1px 3px rgba(0,0,0,.3),
                   0 3px 5px rgba(0,0,0,.2),
                   0 5px 10px rgba(0,0,0,.25),
                   0 10px 10px rgba(0,0,0,.2),
                   0 20px 20px rgba(0,0,0,.15);
            }
        </style>
    </head>
    <body>
        <div id="welcome"></div>
    </body>

    
    <script src="https://fb.me/react-0.14.8.min.js"></script>
    <script src="https://fb.me/react-dom-0.14.8.min.js"></script>

    <!-- Built React -->
    <script src="{{ asset('/js/build/build.min.js') }}"></script>
</html>
