<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modanisa</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
        integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        .table-content {
            margin-top: 55px;
        }

        .head-title a {
            color: black;
            text-decoration: none;
        }

        nav {
            display: flex;
            justify-content: center;
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
        .search-bar{
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
    </style>
</head>

<body>

    <div class="container">
        <div class="head-title">
            <a href="{{route('allcategory')}}">
                <h1> Modanisa - <span style="font-size:30px">
                {{$name}} </span></h1>
            </a>
            <div class="choose_rate">
                <label> Kâr Marjı : (%)</label>
                <input name="rate" id="rateSelect">
            </div>
            <div class="search-bar">
                <form method="GET" action="{{ route('arama') }}">
                    <div id="box" >
                        <input type="text" id="search"  name="q" placeholder="Ara..">
                        <i class="fa fa-search"></i>
                        
                    </div>
                </form>
            </div>
        </div>

        <div class="btn">
            <form action="{{ route('update.products')}}" method="get">
            <input type="hidden" name="name" value="{{$name}}">
            <input type="hidden" name="catname" value="{{$catname}}">
            <button type="submit">Ürünleri güncelle</button>  
            </form> 
        </div>


        <div class="table-content">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Görsel</th>
                        <th scope="col">Başlık</th>

                        <th scope="col">İşlem</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                        <tr>
                            <th scope="row">
                                {{ $loop->iteration }}
                            </th>
                            <td>
                                {{ $product->categoryName }}
                            </td>
                            <td><a href="{{ $product->image }}" target="blank"><img width="150px"
                                        src="{{ $product->image }}" alt=""></a></td>
                            <td>
                                {{ $product->title }}
                            </td>


                            <td class="islem">
                                @php
                                    $metin = $product->productLink;
                                    $yeniLink = str_replace('"', '', $metin);
                                @endphp
                                <form action="{{ route('urundetay') }}" method="get">
                                    @csrf
                                    <input id="gosterRate" type="hidden" name="rate">
                                    <input type="hidden" name="link" value="{{ $yeniLink }}">
                                    <input type="hidden" name="catname" value="{{ $product->categoryName }}">
                                    <button type="submit" class="urun_link">Ürüne Git</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $products->appends(['name' => $name, 'catname' => $catname])->links() }}
        </div>
    </div>
    <script>
        var url = window.location.href;
        var cleanURL = url.split("/").slice(0, -1).join("/");
        console.log(cleanURL);
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            var rate = document.getElementById('rateSelect');
            var uruneGitLink = document.querySelectorAll('.islem');

            rate.addEventListener('input', () => {
                var selectedRate = rate.value;
                console.log(selectedRate);

                uruneGitLink.forEach(function(linkElement) {
                    var gosterRateInput = linkElement.querySelector('input[name="rate"]');
                    gosterRateInput.value = selectedRate;
                });
            });

        });
    </script>
</body>

</html>
