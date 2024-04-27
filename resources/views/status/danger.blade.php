<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İşlem Başarısız</title>
    <meta name="author" content="Codeconvey">
    <link rel="stylesheet" href="{{ asset('css/successstyle.css') }}">
    <style type="text/css">
        #upper-side,
        #contBtn {
            background-color: #ff0000;
        }
      
        body {
            background: #1488EA;
        }

        #card {
            position: relative;
            width: 320px;
            display: block;
            margin: 40px auto;
            text-align: center;
            font-family: 'Source Sans Pro', sans-serif;
        }

        #upper-side {
            padding: 2em;
            background-color: #ff0000;
            display: block;
            color: #fff;
            border-top-right-radius: 8px;
            border-top-left-radius: 8px;
        }

        #checkmark {
            font-weight: lighter;
            fill: #fff;
            margin: -3.5em auto auto 20px;
        }

        #status {
            font-weight: lighter;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 1em;
            margin-top: -.2em;
            margin-bottom: 0;
        }

        #lower-side {
            padding: 2em 2em 5em 2em;
            background: #fff;
            display: block;
            border-bottom-right-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        #message {
            margin-top: -.5em;
            color: #757575;
            letter-spacing: 1px;
        }

        #contBtn {
            position: relative;
            top: 1.5em;
            text-decoration: none;
            background: #ff0000;
            color: #fff;
            margin: auto;
            padding: .8em 3em;
            -webkit-box-shadow: 0px 15px 30px rgba(50, 50, 50, 0.21);
            -moz-box-shadow: 0px 15px 30px rgba(50, 50, 50, 0.21);
            box-shadow: 0px 15px 30px rgba(50, 50, 50, 0.21);
            border-radius: 25px;
            -webkit-transition: all .4s ease;
            -moz-transition: all .4s ease;
            -o-transition: all .4s ease;
            transition: all .4s ease;
        }

        #contBtn:hover {
            -webkit-box-shadow: 0px 15px 30px rgba(50, 50, 50, 0.41);
            -moz-box-shadow: 0px 15px 30px rgba(50, 50, 50, 0.41);
            box-shadow: 0px 15px 30px rgba(50, 50, 50, 0.41);
            -webkit-transition: all .4s ease;
            -moz-transition: all .4s ease;
            -o-transition: all .4s ease;
            transition: all .4s ease;
        }

        /* ******************************************************
            Author URI: https://codeconvey.com/
            Demo Purpose Only - May not require to add.
            font-family: "Raleway",sans-serif;
        *********************************************************/

        @import url('https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900');



        html {
            box-sizing: border-box;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        article,
        header,
        section,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        main,
        nav,
        section,
        summary {
            display: block;
        }

        body {
            background: #e5e5e5 none repeat scroll 0 0;
            color: #222;
            font-size: 100%;
            line-height: 24px;
            margin: 0;
            padding: 0;
            font-family: "Raleway", sans-serif;
        }

        a {
            font-family: "Raleway", sans-serif;
            text-decoration: none;
            outline: none;
        }

        a:hover,
        a:focus {
            color: #373e18;
        }

        section {
            float: left;
            width: 100%;
            padding-bottom: 3em;
        }

        h2 {
            color: #1a0e0e;
            font-size: 26px;
            font-weight: 700;
            margin: 0;
            line-height: normal;
            text-transform: uppercase;
        }

        h2 span {
            display: block;
            padding: 0;
            font-size: 18px;
            opacity: 0.7;
            margin-top: 5px;
            text-transform: uppercase;
        }

        #float-right {
            float: right;
        }

        /* ******************************************************
            Script Top
        *********************************************************/

        .ScriptTop {
            background: #fff none repeat scroll 0 0;
            float: left;
            font-size: 0.69em;
            font-weight: 600;
            line-height: 2.2;
            padding: 12px 0;
            text-transform: uppercase;
            width: 100%;
        }

        /* To Navigation Style 1*/
        .ScriptTop ul {
            margin: 24px 0;
            padding: 0;
            text-align: left;
        }

        .ScriptTop li {
            list-style: none;
            display: inline-block;
        }

        .ScriptTop li a {
            background: #6a4aed none repeat scroll 0 0;
            color: #fff;
            display: inline-block;
            font-size: 14px;
            font-weight: 600;
            padding: 5px 18px;
            text-decoration: none;
            text-transform: capitalize;
        }

        .ScriptTop li a:hover {
            background: #000;
            color: #fff;
        }

        /* ******************************************************
            Script Header
        *********************************************************/

        .ScriptHeader {
            float: left;
            width: 100%;
            padding: 2em 0;
        }

        .rt-heading {
            margin: 0 auto;
            text-align: center;
        }

        .Scriptcontent {
            line-height: 28px;
        }

        .ScriptHeader h1 {
            font-family: "brandon-grotesque", "Brandon Grotesque", "Source Sans Pro", "Segoe UI", Frutiger, "Frutiger Linotype", "Dejavu Sans", "Helvetica Neue", Arial, sans-serif;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            color: #6a4aed;
            font-size: 26px;
            font-weight: 700;
            margin: 0;
            line-height: normal;

        }

        .ScriptHeader h2 {
            color: #312c8f;
            font-size: 20px;
            font-weight: 400;
            margin: 5px 0 0;
            line-height: normal;

        }

        .ScriptHeader h1 span {
            display: block;
            padding: 0;
            font-size: 22px;
            opacity: 0.7;
            margin-top: 5px;

        }

        .ScriptHeader span {
            display: block;
            padding: 0;
            font-size: 22px;
            opacity: 0.7;
            margin-top: 5px;
        }




        /* ******************************************************
            Live Demo
        *********************************************************/





        /* ******************************************************
            Responsive Grids
        *********************************************************/

        .rt-container {
            margin: 0 auto;
            padding-left: 12px;
            padding-right: 12px;
        }

        .rt-row:before,
        .rt-row:after {
            display: table;
            line-height: 0;
            content: "";
        }

        .rt-row:after {
            clear: both;
        }

        [class^="col-rt-"] {
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            -o-box-sizing: border-box;
            -ms-box-sizing: border-box;
            padding: 0 15px;
            min-height: 1px;
            position: relative;
        }


        @media (min-width: 768px) {
            .rt-container {
                width: 750px;
            }

            [class^="col-rt-"] {
                float: left;
                width: 49.9999999999%;
            }

            .col-rt-6,
            .col-rt-12 {
                width: 100%;
            }

        }

        @media (min-width: 1200px) {
            .rt-container {
                width: 1170px;
            }

            .col-rt-1 {
                width: 16.6%;
            }

            .col-rt-2 {
                width: 30.33%;
            }

            .col-rt-3 {
                width: 50%;
            }

            .col-rt-4 {
                width: 67.664%;
            }

            .col-rt-5 {
                width: 83.33%;
            }


        }

        @media only screen and (min-width:240px) and (max-width: 768px) {

            .ScriptTop h1,
            .ScriptTop ul {
                text-align: center;
            }

            .ScriptTop h1 {
                margin-top: 0;
                margin-bottom: 15px;
            }

            .ScriptTop ul {
                margin-top: 12px;
            }

            .ScriptHeader h1,
            .ScriptHeader h2,
            .scriptnav ul {
                text-align: center;
            }

            .scriptnav ul {
                margin-top: 12px;
            }

            #float-right {
                float: none;
            }

        }
    </style>

</head>

<body>
    <section>
        <div class="rt-container">
            <div class="col-rt-12">
                <div class="Scriptcontent"> <!-- partial:index.partial.html -->
                    <div id='card' class="animated fadeIn">
                        <div id='upper-side'>
                            <!-- Generator: Adobe Illustrator 17.1.0, SVG Export Plug-In . SVG Version: 6.00 Build 0) -->
                            <!DOCTYPE svg
                                PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                            <svg style="width: 35%;height: 60px;" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px"
                                y="0px" viewbox="0 0 512.001 512.001"
                                style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve" width="512px"
                                height="512px">
                                <g>
                                    <g>
                                        <path
                                            d="M503.839,395.379l-195.7-338.962C297.257,37.569,277.766,26.315,256,26.315c-21.765,0-41.257,11.254-52.139,30.102 L8.162,395.378c-10.883,18.85-10.883,41.356,0,60.205c10.883,18.849,30.373,30.102,52.139,30.102h391.398 c21.765,0,41.256-11.254,52.14-30.101C514.722,436.734,514.722,414.228,503.839,395.379z M477.861,440.586 c-5.461,9.458-15.241,15.104-26.162,15.104H60.301c-10.922,0-20.702-5.646-26.162-15.104c-5.46-9.458-5.46-20.75,0-30.208 L229.84,71.416c5.46-9.458,15.24-15.104,26.161-15.104c10.92,0,20.701,5.646,26.161,15.104l195.7,338.962 C483.321,419.836,483.321,431.128,477.861,440.586z"
                                            fill="#FFFFFF"></path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="241.001" y="176.01" width="29.996" height="149.982"
                                            fill="#FFFFFF"></rect>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M256,355.99c-11.027,0-19.998,8.971-19.998,19.998s8.971,19.998,19.998,19.998c11.026,0,19.998-8.971,19.998-19.998 S267.027,355.99,256,355.99z"
                                            fill="#FFFFFF"></path>
                                    </g>
                                </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                            </svg>
                            <h3 id='status'>Hata</h3>
                        </div>
                        <div id='lower-side'>
                            <p id='message'>İşlem tamamlanamadı.</p> <a href='{{route('allcategory')}}' id="contBtn">Tekrar
                                Dene</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        /*
       setTimeout(function() {
            // Anasayfaya yönlendir
            window.location.href="http://127.0.0.1:8000/allcategory";
        }, 15000);
    </script>
</body>

</html>
