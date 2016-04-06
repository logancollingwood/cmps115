<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LoLStats</title>

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
            }

            #welcome {
                text-align: center;
                display: table-cell;
                background-color: #000000;

            }

            #welcome:before {
                content: ' ';
                display: block;
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                z-index: 1;
                opacity: 0.3;
                background-image: url({{ asset('/img/cover.png') }});
                background-repeat: no-repeat;
                background-position: 50% 0;
                -ms-background-size: cover;
                -o-background-size: cover;
                -moz-background-size: cover;
                -webkit-background-size: cover;
                background-size: cover;
            }

            .content {
                text-align: center;
                display: inline-block;
                margin-top: 10%;
            }
            .input-group {
              width: 70%;
              padding-left: 30%;
            }
            .title {
                color: #ffffff;
                font-size: 96px;
                opacity: 1;
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    </head>
    <body>
        <div id="welcome"></div>
    </body>

    
    <script src="https://fb.me/react-0.14.8.min.js"></script>
    <script src="https://fb.me/react-dom-0.14.8.min.js"></script>
    <script   src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    
    <!-- Built React -->
    <script src="{{ asset('/js/build/build.min.js') }}"></script>
</html>
