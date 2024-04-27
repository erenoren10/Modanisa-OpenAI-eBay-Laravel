<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modanisa | Düzenle/Ekle</title>
     
   <!-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="ckeditor/plugins/codesnippet/lib/highlight/styles/monokai.css">
    <script src="ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js" type="text/javascript"></script>-->
    <script>
        hljs.initHighlightingOnLoad();
    </script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

    <link href="library/bootstrap-5/bootstrap.min.css" rel="stylesheet" />
    <script src="library/bootstrap-5/bootstrap.bundle.min.js"></script>
    <script src="library/dselect.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        img {
            padding: 10px;
            width: 10.7rem;
        }

        .table-content {
            margin-top: 55px;
        }

        .head-title a {
            color: black;
            text-decoration: none;
        }

        h1[itemprop="name"] {
            font-size: 18px;

        }


        /* Genel sayfa stilleri */
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .head-title {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Form stilleri */
        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Diğer stiller */
        .form-check {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 4px;
        }

        .gallery_l {
            display: flex;
            justify-content: center;
        }

        .labelForm {
            display: flex;
            justify-content: center;
        }

        .selectcategory {
            min-height: 43px;
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        hr.rounded {
            border-top: 8px solid black;
            border-radius: 5px;
        }

        .titleVar {
            display: flex;
        }

        a.text-change{
            display: inline-block;
            padding: 10px 15px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        a.text-change:hover{
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="head-title">
            <a href="{{ route('allcategory') }}">
                <h1> Modanisa - Düzenle/Ekle </span></h1>
            </a>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('ekle.ebay') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="labelForm" for="nameForm">İsim</label>
                        <input type="name" name="name" class="form-control" id="nameForm"
                            value='{{ $seftextName }}'>
                    </div>
                    <div class="form-group">
                        <label class="labelForm" for="exampleFormControlSelect1">Resimler</label>
                        <input type="hidden" name="resimSayi" value="<?php echo count($imageSrcs); ?>">
                        <?php for ($l = 0; $l < count($imageSrcs); $l++): ?>
                        <img width="165px" src=" <?php echo $imageSrcs[$l]; ?>">
                        <input type="hidden" name="resim<?php echo $l + 1; ?>" value="<?php echo $imageSrcs[$l]; ?>">
                        <?php endfor ?>
                    </div>

                    <div class="form-group">

                        <a class="text-change" onclick="changeText()">
                            Açıklamayı tekrar yazdır
                        </a>

                        <label class="labelForm" for="editor">Açıklama</label>
                        <textarea class="ck-editor__editable form-control aciklama" id="editor" name="aciklama" rows="5"
                            cols="40"><?php echo $text1; ?></textarea>
                    </div>

                    <div class="form-group">
                        @if (isset($valueSize))
                            <label class="labelForm" for="sizeForm"> Beden </label>
                            <input type="hidden" name="bedenSayi" value="{{ count($valueSize) }}">
                            @for ($r = 0; $r < count($valueSize); $r++)
                                <input type="text" name="beden<?php echo $r + 1; ?>" class="form-control"
                                    id="sizeForm" value='<?php echo $valueSize[$r]; ?>'>
                            @endfor
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="labelForm" for="colorForm"> Variations </label>
                        <input type="hidden" name="renkSayi" value="<?php echo count($colors) - 1; ?>">
                        <ul>
                            <?php for ($k = 0; $k < count($colors) - 1; $k++): ?>
                            <li>
                                <div class="titleVar">
                                    <input type="text" name="colorName<?php echo $k + 1; ?>" class="form-control"
                                        id="colorForm" value='<?php echo $colors[$k]; ?>'>
                                    <button onclick="removeItem(this)">Sil</button>
                                </div>
                                <?php foreach ($dizi[$colors[$k] . 'imagesrc'] as $value): ?>
                                <img src="<?php echo $value; ?>" alt="">
                                <input type="hidden" name="otherColorİmage<?php echo $k + 1; ?>[]"
                                    value="<?php echo $value; ?>">
                                <?php endforeach; ?>
                                <h5>BEDEN:</h5>
                                <ul>
                                    <?php foreach ($sizeNoSef[$colors[$k] . 'Sizesr'] as $values): ?>
                                    <?php if (empty($values)) {
                                        continue;
                                    } ?>
                                    <li>
                                        <?php echo $values; ?>
                                    </li>
                                    <input type="hidden" name="otherColorSize<?php echo $k + 1; ?>[]"
                                        value="<?php echo $values; ?>">
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <hr class="rounded">

                            <?php endfor ?>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label class="labelForm" for="priceForm"> Fiyat </label>
                        <input type="price" class="form-control" id="priceForm" value='<?php echo $price;
                        $newPrice = (float) $price + ((float) $price[1][0] * (float) $rate) / 100; ?>' readonly>
                    </div>
                    <div class="form-group">
                        <label class="labelForm" for="kdv" id="addkdv"> Kâr Marjı(%
                            <?php echo max(0, $rate); ?>)
                        </label>
                        <input type="number" class="form-control" id="kdv" placeholder='%<?php echo max(0, $rate); ?>'>
                    </div>
                    <div class="form-group">
                        <label class="labelForm" for="newpriceForm"> Son Fiyat </label>
                        <input type="newprice" class="form-control" name="p_price" id="newpriceForm"
                            value='<?php echo $newPrice; ?> USD'>
                    </div>
                    <div class="form-group">
                        <label class="labelForm" for="amount"> Miktar </label>
                        <input type="number" class="form-control" id="amount" name="amount"
                            placeholder='Ürün Miktarı...' required>
                    </div>
                    <div class="form-group">
                        <label class="labelForm" for="categorySelect"> Kategori Seç </label>
                        <select id="categorySelect" class="selectcategory" required>
                            <option value="0"></option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->categoryID }}">{{ $cat->categoryName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" id="kategori1" style="display: none;">
                        <label class="labelForm" for="sub_category1"> Kategori Seç </label>
                        <select id="sub_category1" class="selectcategory">
                            <option value="0"></option>
                        </select>
                    </div>
                    <div class="form-group" id="kategori2" style="display: none;">
                        <label class="labelForm" for="sub_category2"> Kategori Seç </label>
                        <select id="sub_category2" class="selectcategory">
                            <option value="0"></option>
                        </select>
                    </div>
                    <div class="form-group" id="kategori3" style="display: none;">
                        <label class="labelForm" for="sub_category3"> Kategori Seç </label>
                        <select id="sub_category3" class="selectcategory">
                            <option value="0"></option>
                        </select>
                    </div>
                    <div class="form-group" id="kategori4" style="display: none;">
                        <label class="labelForm" for="sub_category4"> Kategori Seç </label>
                        <select id="sub_category4" class="selectcategory">
                            <option value="0"></option>
                        </select>
                    </div>
                    <div class="form-group" id="kategori5" style="display: none;">
                        <label class="labelForm" for="sub_category5"> Kategori Seç </label>
                        <select id="sub_category5" class="selectcategory">
                            <option value="0"></option>
                        </select>
                    </div>
                    <div class="form-group" id="kategori6" style="display: none;">
                        <label class="labelForm" for="sub_category6"> Kategori Seç </label>
                        <select id="sub_category6" class="selectcategory">
                            <option value="0"></option>
                        </select>
                    </div>
                    <input type="hidden" name="allbedensayi" value='<?php echo count($allValueSize); ?>'>
                    <?php for ($n = 0; $n < count($allValueSize); $n++): ?>
                    <input type="hidden" name="allbeden<?php echo $n; ?>" value='<?php echo $allValueSize[$n]; ?>'>
                    <?php endfor ?>
                    <input type="hidden" name="urunId" value='<?php echo $number; ?>'>
                    <input type="hidden" name="category" id="categoryInput">
                    <button type="submit" class="urun_link"> Ebay'a Ekle </button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        CKEDITOR.replace('editor');
        var lasttext = document.getElementById('edito');
        var eskiyazi= CKEDITOR.instances.editor.getData();

        function changeText() {
            var settings = {
                "url": "https://api.openai.com/v1/chat/completions",
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "Content-Type": "application/json",
                    "Authorization": "!! enter Openai key !!",
                },
                "data": JSON.stringify({
                    "model": "gpt-3.5-turbo",
                    "messages": [{
                        "role": "user",
                        "content": eskiyazi + " bu yazıyı yeniden düzgün bir şekilde ingilizce olarak yazmaya çalış en az 500 karakter olsun ve ürünün özelliklerini anlatsın"
                    }],
                    "temperature": 0.8,
                    "max_tokens": 256
                }),
            };

            $.ajax(settings).done(function(response) { 
                CKEDITOR.instances.editor.setData(response.choices[0].message.content);
                console.log(response.choices[0].message.content);
            });
        }
    </script>
    <script>
        function removeItem(button) {
            button.parentElement.parentElement.remove();
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            var price = document.getElementById('priceForm');
            var kdv = document.getElementById('kdv');
            var newpriceForm = document.getElementById('newpriceForm');
            var addkdv = document.getElementById('addkdv');
            var val_price = parseFloat(price.value);

            kdv.addEventListener('keydown', function(event) {
                if (event.keyCode === 13) {

                    event.preventDefault();

                    var kdvtutar = parseFloat(this.value);
                    addkdv.innerHTML = `Kâr Marjı(%${kdvtutar})`;

                    if (kdvtutar >= 0) {
                        var komisyon = (val_price + (val_price * kdvtutar) / 100).toFixed(2);

                        newpriceForm.value = komisyon + " USD";
                        console.log(kdvtutar);
                        console.log(komisyon);
                        console.log(val_price);
                    } else {
                        console.log("KDV 0'ın altında olduğu için işlem yapılmadı.");
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            var catInput = document.getElementById("catId");
            var catValue = catInput.value;

            // Parantezleri ve boşlukları kaldırın
            var catArrayString = catValue.replace(/[\(\)\[\]\s]/g, '');

            // Metni virgül ile bölelim ve her öğeyi sayıya dönüştürelim
            var catArray = catArrayString.split(',').map(function(item) {
                return parseInt(item, 10);
            });

            console.log(catValue);



            var catName = document.getElementById('catName');
            console.log(catName);
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Üst kategori seçildiğinde tetiklenecek fonksiyon
            document.getElementById('categorySelect').addEventListener('change', function() {
                var categoryId = this.value; // Seçilen üst kategori ID'si // Seçilen üst kategori ID'si

                // Ajax isteği gönderme
                axios.get('/get-subcategoriesindex/' + categoryId)
                    .then(function(response) {
                        var subCategories = response.data.subCategories;
                        // Alt kategorilerin seçeneklerini oluşturma ve güncelleme
                        var subCategorySelect = document.getElementById('sub_category1');
                        subCategorySelect.innerHTML = '<option value="">-- Seçiniz --</option>';
                        subCategories.forEach(function(subCat) {
                            subCategorySelect.innerHTML += '<option value="' + subCat
                                .categoryID +
                                '">' + subCat.categoryName + '</option>';

                        });
                        if (subCategories.length > 0) {
                            document.getElementById('kategori1').style.display = 'block';
                        } else {
                            document.getElementById('kategori1').style.display = 'none';
                        }
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            });
            document.getElementById('sub_category1').addEventListener('change', function() {
                var categoryId = this.value; // Seçilen üst kategori ID'si // Seçilen üst kategori ID'si
                var categoryInput = document.getElementById('categoryInput');
                categoryInput.value = categoryId;
                // Ajax isteği gönderme
                axios.get('/get-subcategoriesindex/' + categoryId)
                    .then(function(response) {
                        var subCategories = response.data.subCategories;
                        // Alt kategorilerin seçeneklerini oluşturma ve güncelleme
                        var subCategorySelect = document.getElementById('sub_category2');
                        subCategorySelect.innerHTML = '<option value="">-- Seçiniz --</option>';
                        subCategories.forEach(function(subCat) {
                            subCategorySelect.innerHTML += '<option value="' + subCat
                                .categoryID +
                                '">' + subCat.categoryName + '</option>';

                        });

                        if (subCategories.length > 0) {
                            document.getElementById('kategori2').style.display = 'block';
                        } else {
                            document.getElementById('kategori2').style.display = 'none';
                        }
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            });
            document.getElementById('sub_category2').addEventListener('change', function() {
                var categoryId = this.value; // Seçilen üst kategori ID'si // Seçilen üst kategori ID'si
                var categoryInput = document.getElementById('categoryInput');
                categoryInput.value = categoryId;
                // Ajax isteği gönderme
                axios.get('/get-subcategoriesindex/' + categoryId)
                    .then(function(response) {
                        var subCategories = response.data.subCategories;
                        // Alt kategorilerin seçeneklerini oluşturma ve güncelleme
                        var subCategorySelect = document.getElementById('sub_category3');
                        subCategorySelect.innerHTML = '<option value="">-- Seçiniz --</option>';
                        subCategories.forEach(function(subCat) {
                            subCategorySelect.innerHTML += '<option value="' + subCat
                                .categoryID +
                                '">' + subCat.categoryName + '</option>';

                        });

                        if (subCategories.length > 0) {
                            document.getElementById('kategori3').style.display = 'block';
                        } else {
                            document.getElementById('kategori3').style.display = 'none';
                        }
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            });
            document.getElementById('sub_category3').addEventListener('change', function() {
                var categoryId = this.value; // Seçilen üst kategori ID'si // Seçilen üst kategori ID'si
                var categoryInput = document.getElementById('categoryInput');
                categoryInput.value = categoryId;
                // Ajax isteği gönderme
                axios.get('/get-subcategoriesindex/' + categoryId)
                    .then(function(response) {
                        var subCategories = response.data.subCategories;
                        // Alt kategorilerin seçeneklerini oluşturma ve güncelleme
                        var subCategorySelect = document.getElementById('sub_category4');
                        subCategorySelect.innerHTML = '<option value="">-- Seçiniz --</option>';
                        subCategories.forEach(function(subCat) {
                            subCategorySelect.innerHTML += '<option value="' + subCat
                                .categoryID +
                                '">' + subCat.categoryName + '</option>';


                        });

                        if (subCategories.length > 0) {
                            document.getElementById('kategori4').style.display = 'block';
                        } else {
                            document.getElementById('kategori4').style.display = 'none';
                        }

                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            });
            document.getElementById('sub_category4').addEventListener('change', function() {
                var categoryId = this.value; // Seçilen üst kategori ID'si // Seçilen üst kategori ID'si
                var categoryInput = document.getElementById('categoryInput');
                categoryInput.value = categoryId;
                // Ajax isteği gönderme
                axios.get('/get-subcategoriesindex/' + categoryId)
                    .then(function(response) {
                        var subCategories = response.data.subCategories;
                        // Alt kategorilerin seçeneklerini oluşturma ve güncelleme
                        var subCategorySelect = document.getElementById('sub_category5');
                        subCategorySelect.innerHTML = '<option value="">-- Seçiniz --</option>';
                        subCategories.forEach(function(subCat) {
                            subCategorySelect.innerHTML += '<option value="' + subCat
                                .categoryID +
                                '">' + subCat.categoryName + '</option>';

                        });
                        if (subCategories.length > 0) {
                            document.getElementById('kategori5').style.display = 'block';
                        } else {
                            document.getElementById('kategori5').style.display = 'none';
                        }
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            });

        });
    </script>
</body>

</html>
