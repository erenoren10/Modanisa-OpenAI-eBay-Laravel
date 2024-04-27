<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modanisa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .table-content {
            margin-top: 55px;
        }

        @import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css");
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap');

        * {
            margin: 0 20px 0 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            /*background: #5c7185;*/
            /* min-height: 100vh; */
        }

        ul {
            list-style: none;
        }

        .accordion-menu {
            margin: 50px auto 20px;
            /*background: #242d41;*/
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px #000;
        }

        .accordion-menu li:last-child .dropdown {
            border-bottom: 0;
        }

        .accordion-menu li.active .dropdown {
            color: black;
        }

        .accordion-menu li.active .dropdown .fa-chevron-down {
            transform: rotate(180deg);
        }

        .dropdown {
            cursor: pointer;
            display: block;
            padding: 15px 15px 15px 45px;
            font-size: 18px;
            border-bottom: 2px solid wheat;
            color: black;
            position: relative;
            transition: all 0.4s ease-out;
        }

        .dropdown:hover {
            background: wheat;
            /* fallback colour */
            background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(solid), to(solid));
        }

        .dropdown i {
            position: absolute;
            top: 17px;
            left: 16px;
        }

        .dropdown .fa-chevron-down {
            right: 12px;
            left: auto;
            transition: transform 0.2s ease-in-out;
        }

        .submenuItems {
            display: none;
            background: gray;
            ;
            transition: all 2s ease-in-out;
        }

        .accordion-menu li.active .submenuItems {
            display: block;
        }

        .submenuItems button {
            width: 100%;
            background-color: gray;
            border: none;
            outline: none;
            display: block;
            color: wheat;
            font-weight: 600;
            padding: 12px 12px 12px 45px;
            transition: all 0.2s ease-out;
            text-decoration: none;
        }

        .submenuItems button:hover {
            background-color: wheat;
            color: black;
        }

        #box {
            max-width: 300px;
            position: relative;
        }

        #box .fa-search {
            position: absolute;
            top: 14px;
            left: 12px;
            font-size: 20px;
            color: cornflowerblue;
        }

        .search-bar {
            display: flex;
            justify-content: center;
        }

        #search {
            width: 100px;
            box-sizing: border-box;
            border: 2px solid cornflowerblue;
            border-radius: 4px;
            font-size: 18px;
            padding: 12px 20px 12px 40px;
            -moz-transition: width 0.4s ease-in-out;
            -o-transition: width 0.4s ease-in-out;
            -webkit-transition: width 0.4s ease-in-out;
            transition: width 0.4s ease-in-out;
        }

        #search:focus {
            width: 100%;
        }

        .apiUpdate {
            max-width: 600px;
            margin: 20px auto;
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
/*
        .apiUpdate label {
            display: block;
            margin-bottom: 10px;
        }

        .apiUpdate input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .apiUpdate input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }*/



        .chatgpt-prompt {
            max-width: 600px;
            margin: 20px auto;
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Form stili */
        form {
            display: flex;
            flex-direction: column;
        }

        /* Etiket stili */
        label {
            margin-bottom: 8px;
            font-weight: bold;
        }

        /* Giriş kutusu stili */
        input {
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
    </style>


</head>

<body>

    <div class="container">
        <div class="head-title">
            <h1 style="    margin-top: 30px;
            display: flex;
            justify-content: center;"> Modanisa
            </h1>
            <div class="search-bar">
                <form method="GET" action="{{ route('arama') }}">
                    @csrf
                    <div id="box">
                        <input type="text" id="search" name="q" placeholder="Ara..">
                        <i class="fa fa-search"></i>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col">
                    <div class="apiUpdate" style="background-color: #dc3545; color:#f5f5f5">
                        <form method="POST" action="{{ route('update.api') }}">
                            @csrf
                            <label for="ebayapi">OpenAI APİ : </label>
                            <input type="text" id="ebayapi" name="api" value="{{ $ebay ?? '' }}">
                        </form>
                    </div>
                    <div class="chatgpt-prompt">
                        <form method="POST" action="{{ route('update.title-prompt') }}">
                            @csrf
                            <label for="openai-title">OpenAI başlık prompt : </label>
                            <input type="text" id="openai-title" name="titleprompt" value="{{ $openai->title ?? '' }}">
                        </form>
                    </div>
                </div>
                <div class="col">
                    <div class="chatgpt-prompt">
                        <form method="post" action="{{ route('update.first-prompt') }}">
                            @csrf
                            <label for="openai-prompt">OpenAI açıklama 1.Prompt: </label>
                            <input type="text" id="openai-prompt" name="firstprompt"
                                value="{{ $openai->firstprompt ?? '' }}">
                        </form>
                    </div>
                    <div class="chatgpt-prompt">
                        <form method="post" action="{{ route('update.second-prompt') }}">
                            @csrf
                            <label for="openai-prompt2">OpenAI açıklama 2.Prompt: </label>
                            <input type="text" id="openai-prompt2" name="secondprompt"
                                value="{{ $openai->secondprompt ?? '' }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--
        <div class="table-content">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">İşlem</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                   foreach($html->find('a.mainHeader') as $element) : 
                    if ($element->plaintext == "New") {
                        continue;
                    }
                   ?>
                    <tr>
                        <th scope="row">
                            <?php $index = 1 + $i++;
                            echo $index; ?>
                        </th>
                        <td><?php echo $element->plaintext; ?></td>
                        <td>
                            <form action="{{ route('category') }}" method="post">
                                @csrf
                                <input type="hidden" name="name" value="<?php echo $element->plaintext; ?>">
                                <input type="hidden" name="catname" value="<?php echo $element->href; ?>">
                                <button type="submit" class="urun_link">Sayfaya Git</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

        </div>
        -->


        <div class="container">
            <ul class="accordion-menu">
                @foreach ($html->find('li.rootItem') as $element)
                    @php
                        $mainHeader = $element->find('a.mainHeader', 0);
                    @endphp

                    <li class="link">
                        <div class="dropdown">
                            {!! $mainHeader->plaintext !!}
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        </div>
                        <ul class="submenuItems">
                            @foreach ($element->find('a.item') as $items)
                                @if ($items->plaintext != 'NEW')
                                    <li>
                                        <form action="{{ route('category') }}" method="get">
                                            <input type="hidden" name="name" value="<?php echo $items->plaintext; ?>">
                                            <input type="hidden" name="catname" value="<?php echo $items->href; ?>">
                                            <button type="submit" class="urun_link">{!! $items->plaintext !!}</button>
                                        </form>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endforeach
                <!--
                <li class="link">
                    <div class="dropdown">
                        <i class="fa-brands fa-node-js"></i>
                        Node-JS
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    </div>
                    <ul class="submenuItems">
                        <li><a href="#">Node-JS Level 1</a></li>
                        <li><a href="#">Node-JS Level 2</a></li>
                        <li><a href="#">Node-JS Level 3</a></li>
                    </ul>
                </li>
                <li class="link">
                    <div class="dropdown">
                        <i class="fa-brands fa-react"></i>
                        React
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    </div>
                    <ul class="submenuItems">
                        <li><a href="#">React Level 1</a></li>
                        <li><a href="#">React Level 2</a></li>
                        <li><a href="#">React Level 3</a></li>
                    </ul>
                </li>
                <li class="link">
                    <div class="dropdown">
                        <i class="fa-brands fa-bootstrap"></i>
                        Bootstrap
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    </div>
                    <ul class="submenuItems">
                        <li><a href="#">Bootstrap Level 1</a></li>
                        <li><a href="#">Bootstrap Level 2</a></li>
                        <li><a href="#">Bootstrap Level 3</a></li>
                    </ul>
                </li>
                -->
            </ul>

        </div>
    </div>

    <script>
        let listElements = document.querySelectorAll('.link');

        listElements.forEach(listElement => {
            listElement.addEventListener('click', () => {
                if (listElement.classList.contains('active')) {
                    listElement.classList.remove('active');
                } else {
                    listElements.forEach(listE => {
                        listE.classList.remove('active');
                    })
                    listElement.classList.toggle('active');
                }
            })
        });
    </script>
</body>

</html>
