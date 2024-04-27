<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İşlem Başarılı</title>
    <meta name="author" content="Codeconvey">
    <link rel="stylesheet" href="{{ asset('css/successstyle.css') }}">
    <style>
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
            background-color: #8BC34A;
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
            background: #8bc34a;
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
                            <svg version="1.1" id="checkmark" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                xml:space="preserve">
                                <path
                                    d="M131.583,92.152l-0.026-0.041c-0.713-1.118-2.197-1.447-3.316-0.734l-31.782,20.257l-4.74-12.65 c-0.483-1.29-1.882-1.958-3.124-1.493l-0.045,0.017c-1.242,0.465-1.857,1.888-1.374,3.178l5.763,15.382 c0.131,0.351,0.334,0.65,0.579,0.898c0.028,0.029,0.06,0.052,0.089,0.08c0.08,0.073,0.159,0.147,0.246,0.209 c0.071,0.051,0.147,0.091,0.222,0.133c0.058,0.033,0.115,0.069,0.175,0.097c0.081,0.037,0.165,0.063,0.249,0.091 c0.065,0.022,0.128,0.047,0.195,0.063c0.079,0.019,0.159,0.026,0.239,0.037c0.074,0.01,0.147,0.024,0.221,0.027 c0.097,0.004,0.194-0.006,0.292-0.014c0.055-0.005,0.109-0.003,0.163-0.012c0.323-0.048,0.641-0.16,0.933-0.346l34.305-21.865 C131.967,94.755,132.296,93.271,131.583,92.152z">
                                </path>
                                <circle fill="none" stroke="#ffffff" stroke-width="5" stroke-miterlimit="10"
                                    cx="109.486" cy="104.353" r="32.53"></circle>
                            </svg>
                            <h3 id='status'>Başarılı</h3>
                        </div>
                        <div id='lower-side'>
                            <p id='message'>İşlemi başarıyla tamamladınız.</p> <a href="{{route('allcategory')}}" id="contBtn">Devam
                                Et</a>
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
            window.location.href = "http://127.0.0.1:8000/allcategory";
        },15000);
    </script>
</body>

</html>
