<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Ebay;
use App\Models\Openai;
use App\Models\Products;
use Illuminate\Http\Request;
use SimpleXMLElement;

class PageController extends Controller
{
    public function index()
    {
        /*
        $urlebay = 'https://auth.ebay.com/oauth2/authorize?client_id=erenren-ileriaja-PRD-b72a98ced-720195b0&response_type=code&redirect_uri=eren_ren-erenren-ileriaj-ofupfolj&scope=https://api.ebay.com/oauth/api_scope';
        return redirect($urlebay);*/

        return redirect('allcategory');
    }

    public function updateApi(Request $request)
    {
        $api = $request->input('api');
        $ebay = Ebay::find(1);

        if ($ebay) {
            $ebay->api = $api;
            $ebay->save();
            return redirect('allcategory');
        } else {
            Ebay::create(["api" => $api]);
            return redirect('allcategory');
        }

    }

    public function updateFirstPrompt(Request $request)
    {
        $prompt = $request->input('firstprompt');
        $openai = Openai::find(1);

        if ($openai) {
            $openai->firstprompt = $prompt;
            $openai->save();
            return redirect('allcategory');
        } else {
            Openai::create(["firstprompt" => $prompt]);
            return redirect('allcategory');
        }

    }
    public function updateSecondPrompt(Request $request)
    {
        $prompt = $request->input('secondprompt');
        $openai = Openai::find(1);

        if ($openai) {
            $openai->secondprompt = $prompt;
            $openai->save();
            return redirect('allcategory');
        } else {
            Openai::create(["secondprompt" => $prompt]);
            return redirect('allcategory');
        }


    }
    public function updateTitlePrompt(Request $request)
    {
        $prompt = $request->input('titleprompt');
        $openai = Openai::find(1);

        if ($openai) {
            $openai->title = $prompt;
            $openai->save();
            return redirect('allcategory');
        } else {
            Openai::create(["title" => $prompt]);
            return redirect('allcategory');
        }


    }


    public function allcategory()
    {
        include_once(app_path('simple_html_dom.php'));

        $url = 'https://www.modanisa.com/';


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $headers = ['Cookie: user_shipping_data=%7B%22currency%22%3A%22USD%22%2C%22country_id%22%3A38%2C%22country_code%22%3A%22US%22%2C%22ip_welcome%22%3A%22%22%2C%22ip_country_id%22%3A%221%22%2C%22ip_country_code%22%3A%22TR%22%2C%22customer_language%22%3A%22EN%22%7D;'];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        $ebay = Ebay::pluck("api")->first();

        $openai = Openai::get()->first();

        $html = str_get_html($response);
        $i = 0;

        return view('allcategory', compact('i', 'html', 'ebay','openai'));
    }



    public function category(Request $request)
    {

        $name = $request->input('name');
        $catname = $request->input('catname');
        $products = Products::where('categoryName', $name)->simplepaginate(20);
        return view('category', compact('name', 'products', 'catname'));

    }

    public function updateProducts(Request $request)
    {
        include_once(app_path('simple_html_dom.php'));
        set_time_limit(0);
        $name = $request->input('name');
        $catname = $request->input('catname');
        if (strpos($catname, 'https://www.modanisa.com') !== false) {
            $urlParts = parse_url($catname);
            $path = isset($urlParts['path']) ? $urlParts['path'] : '';
            $query = isset($urlParts['query']) ? '?' . $urlParts['query'] : '';
            if ($path !== '') {
                $result = $path . $query; // Path ve query'i birleştir
            } else {
                echo "URL hatalı veya eksik.";
            }
        } else {
            $result = $catname;
        }



        $url = 'https://www.modanisa.com' . $result;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $headers = ['Cookie: user_shipping_data=%7B%22currency%22%3A%22USD%22%2C%22country_id%22%3A38%2C%22country_code%22%3A%22US%22%2C%22ip_welcome%22%3A%22%22%2C%22ip_country_id%22%3A%221%22%2C%22ip_country_code%22%3A%22TR%22%2C%22customer_language%22%3A%22EN%22%7D;'];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);


        preg_match_all('@<div class="page-button-text l-font-sans l-text-xs l-font-medium l-text-center l-text-black">(.*?)</div>@si', $response, $lastpage);
        if (isset($lastpage[1][4])) {
            $page_value_int = (int) $lastpage[1][4];
        } else if (isset($lastpage[1][3])) {
            $page_value_int = (int) $lastpage[1][3];
        } else if (isset($lastpage[1][2])) {
            $page_value_int = (int) $lastpage[1][2];
        } else if (isset($lastpage[1][1])) {
            $page_value_int = (int) $lastpage[1][1];
        } else if (isset($lastpage[1][0])) {
            $page_value_int = (int) $lastpage[1][0];
        }

        if (isset($page_value_int)) {
        } else {
            $htmll = str_get_html($response);
            $element = $htmll->find('div.page-button-text', 0);
            if ($element) {
                $sayi = $element->plaintext;
                $page_value_int = (int) $sayi;
            }
        }

        $image = [];
        $title = [];
        $price = [];
        $link = [];
        $dataId = [];
        for ($l = 1; $l <= $page_value_int; $l++) {
            $urla = 'https://www.modanisa.com' . $result . '?page=' . $l;

            $cha = curl_init($urla);
            curl_setopt($cha, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($cha, CURLOPT_SSL_VERIFYPEER, false);
            $headers = ['Cookie: user_shipping_data=%7B%22currency%22%3A%22USD%22%2C%22country_id%22%3A38%2C%22country_code%22%3A%22US%22%2C%22ip_welcome%22%3A%22%22%2C%22ip_country_id%22%3A%221%22%2C%22ip_country_code%22%3A%22TR%22%2C%22customer_language%22%3A%22EN%22%7D;'];
            curl_setopt($cha, CURLOPT_HTTPHEADER, $headers);
            $responsed = curl_exec($cha);
            curl_close($cha);
            preg_match_all('@<div data-testid="listing-product" data-product-id="(.*?)"@', $responsed, $idMatches);

            $dataId = array_merge($dataId, $idMatches[1]);


            preg_match_all('@<div class="l-relative">(.*?)<a href=(.*?) data-testid="listing-product-link"><img src="(.*?)" data-testid="(.*?)" alt="(.*?)"@si', $responsed, $matches);
            $link = array_merge($link, $matches[2]);
            $image = array_merge($image, $matches[3]);
            $title = array_merge($title, $matches[5]);

            preg_match_all('@<div data-testid="listing-product-price" class="(.*?)">(.*?)</div>@si', $responsed, $price_matches);
            $price = array_merge($price, $price_matches[0]);
        }

        $uruncount = count($link);

        for ($i = 0; $i < $uruncount; $i++) {
            $existingProduct = Products::where('dataId', $dataId[$i])->first();

            // Aynı ID'ye sahip ürün henüz eklenmemişse, ekleyin
            if (!$existingProduct) {
                Products::create([
                    'categoryName' => $name,
                    'title' => $title[$i],
                    'image' => $image[$i],
                    'productLink' => $link[$i],
                    'dataId' => $dataId[$i]
                ]);
            } else {
                // Aynı ID'ye sahip ürün varsa, verileri güncelleyin
                $existingProduct->update([
                    'categoryName' => $name,
                    'title' => $title[$i],
                    'image' => $image[$i],
                    'productLink' => $link[$i]
                ]);
            }
        }



        $products = Products::where('categoryName', $name)->simplepaginate(20);

        return view('category', compact('name', 'catname', 'products'));

    }







    public function urundetay(Request $request)
    {

        $link = $request->input('link');
        $catname = $request->input('catname');
        if ($request->input('rate')) {
            $rate = $request->input('rate');
        } else {
            $rate = 0;
        }

        include_once(app_path('simple_html_dom.php'));
        set_time_limit(500);

        $url = 'https://www.modanisa.com' . $link;

        // CURL ile isteği oluşturun
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $headers = ['Cookie: user_shipping_data=%7B%22currency%22%3A%22USD%22%2C%22country_id%22%3A38%2C%22country_code%22%3A%22US%22%2C%22ip_welcome%22%3A%22%22%2C%22ip_country_id%22%3A%221%22%2C%22ip_country_code%22%3A%22TR%22%2C%22customer_language%22%3A%22EN%22%7D;'];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        // CURL hata kontrolü
        if ($response === false) {
            echo 'CURL error: ' . curl_error($ch);
        } else {
            // URUN ID CEKME
            $html = str_get_html($response);
            $productDetails = $html->find('div.right strong', 0);
            if ($productDetails) {
                $number = $productDetails->innertext;
            }
            // URUN ID CEKME SON

            // RESİMLERİ ÇEKME
            /*
                preg_match('@<div class="gallery_l">(.*?)</div>@si', $response, $galleryMatches);
                
                if (!empty($galleryMatches[1])) {
                    $galleryContent = $galleryMatches[1];
                    preg_match_all('@<img src="(.*?)"@si', $galleryContent, $images);
                    foreach ($images[1] as $image) {
                        $modifiedİmage = preg_replace('/u/', 'z', $image, 1);
                        $imageSrcs[] = $modifiedİmage;
                    }
                }
            */

            $allgallery = $html->find('div.gallery_l', 0);

            foreach ($allgallery->find('a') as $gallery) {
                $imageSrcs[] = $gallery->href;
            }

            // RESİMLERİ ÇEKME SON

            // AÇIKLAMA ÇEKME
            /*
            preg_match_all('@<p>(<strong>.*?<\/strong>)?(.*?)<\/p>@si', $response, $notes);
            if (isset($notes[0][5]) && $notes[0][5] !== null) {
            } else {
                $notes[0][5] = '';
            }
            dd($notes);
            $combinedText = $notes[0][2] . $notes[0][3] . $notes[0][4] . $notes[0][5];
            $ilk = str_replace('<p>', '', $combinedText);
            $ikinci = str_replace('</p>', '', $ilk);
            $ucuncu = str_replace('<strong>', '', $ikinci);
            $not = str_replace('</strong>', '', $ucuncu);
            */
            $productInfo = $html->find('.product-info-container p');
            $not = "";
            foreach ($productInfo as $note) {
                $not .= $note->plaintext;
            }

            // AÇIKLAMA ÇEKME SON

            // İSİM/BAŞLIK ÇEKME
            //preg_match_all('@<h1[^>]*>(.*?)<\/h1>@si', $response, $name);
            $nametag = $html->find('div.title.clearfix', 0);
            $name = $nametag->plaintext;

            // İSİM/BAŞLIK ÇEKME SON

            // KATEGORİ İSMİ ÇEKME
            /*
            preg_match_all('@data-product-category="(.*?)"(.*?)@si', $response, $category_name);
            */
            // KATEGORİ İSMİ ÇEKME SON

            // FİYAT ÇEKME
            //preg_match_all('@<div class="productPriceInfo-alternatePrice"> <bdi>(.*?)</bdi>@si', $response, $price);
            $pricetag = $html->find('div.productPriceInfo-alternatePrice bdi', 0);
            $price = $pricetag->innertext;
            // FİYAT ÇEKME SON

            // RENKLERİ ÇEKME
            /*
            preg_match_all('@<div id="other-color-products-container".*?data-product-id="(.*?)".*?data-brand-id="(.*?)".*?data-provider-code="(.*?)".*?data-color="(.*?)".*?data-category="(.*?)"><\/div>@si', $response, $prinfo);
            */
            $prinfotag = $html->find('#other-color-products-container', 0);
            $prinfo = $prinfotag->getAllAttributes();
            $urlrenk = 'https://www.modanisa.com/en/api/other_colors.php?ck=' . $prinfo['data-product-id'] . '-38-en-USD-werf&productId=' . $prinfo['data-product-id'] . '&brandId=' . $prinfo['data-brand-id'] . '&providerCode=' . $prinfo['data-provider-code'] . '&category=' . $prinfo['data-category'] . '&productNewPage=1';
            $sefurlcolors = str_replace(' ', '', $urlrenk);


            $chb = curl_init($sefurlcolors);
            curl_setopt($chb, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($chb, CURLOPT_SSL_VERIFYPEER, false);
            $headers = ['Cookie: user_shipping_data=%7B%22currency%22%3A%22USD%22%2C%22country_id%22%3A38%2C%22country_code%22%3A%22US%22%2C%22ip_welcome%22%3A%22%22%2C%22ip_country_id%22%3A%221%22%2C%22ip_country_code%22%3A%22TR%22%2C%22customer_language%22%3A%22EN%22%7D;'];
            curl_setopt($chb, CURLOPT_HTTPHEADER, $headers);
            $file = curl_exec($chb);
            curl_close($chb);

            $data = json_encode($file, true);
            $jsondata = json_decode($data, true);

            preg_match_all('@"color":"(.*?)"@si', $jsondata, $color);
            $renk = '';
            foreach ($color[1] as $key => $prcolor) {
                if ($prcolor === '') {
                    continue; // İlk VE son yinelmeyi atla
                }
                $renk .= $prcolor . '<br>';
            }
            $colors = explode('<br>', $renk);


            preg_match_all('@"href":"(.*?)"@si', $jsondata, $colorlink);

            $cllink = [];
            foreach ($colorlink[1] as $prcolorlink) {
                if (empty($prcolorlink)) {
                    continue;
                }
                $cllink[] = $prcolorlink;
            }
            // RENKLERİ ÇEKME SON

            // BEDENLERİ ÇEKME
            if ($catname != 'HIJABS') {
                $link1 = str_replace('/', '', $link);
                $link2 = str_replace('.html', '', $link1);

                $urlbedensub = '/api/product_variants.php?ck=' . $prinfo['data-product-id'] . '-38-en-USD-axcv&productId=' . $prinfo['data-product-id'] . '&productSef=' . $link2 . '&beden=';
                $sefurlbeden = str_replace(' ', '', $urlbedensub);
                $sefurlbedenson = str_replace('en', '', $sefurlbeden);
                $urlson = 'https://www.modanisa.com/en' . $sefurlbedenson;

                $chc = curl_init($urlson);
                curl_setopt($chc, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($chc, CURLOPT_SSL_VERIFYPEER, false);
                $headers = ['Cookie: user_shipping_data=%7B%22currency%22%3A%22USD%22%2C%22country_id%22%3A38%2C%22country_code%22%3A%22US%22%2C%22ip_welcome%22%3A%22%22%2C%22ip_country_id%22%3A%221%22%2C%22ip_country_code%22%3A%22TR%22%2C%22customer_language%22%3A%22EN%22%7D;'];
                curl_setopt($chc, CURLOPT_HTTPHEADER, $headers);
                $files = curl_exec($chc);
                curl_close($chc);

                $bedensayfa = str_get_html($files);

                if ($bedensayfa->find('div.productSizeBoxes-tabContent-us', 0)) {
                    $div = $bedensayfa->find('div.productSizeBoxes-tabContent-us', 0);
                    $select = $div->find('select.productSizeSelect-type1', 0);
                    $options = $select->find('option');
                } else if ($bedensayfa->find('select.productSizeSelect-type1', 0)) {
                    $select = $bedensayfa->find('select.productSizeSelect-type1', 0);
                    $options = $select->find('option');
                } else {
                    $options = ["Standart"];
                }
                $valueSize = [];
                $allValueSize = [];

                if (count($options) > 1) {
                    foreach ($options as $option) {
                        if ($option->plaintext == 'Choose Size') {
                            continue;
                        }
                        $allValueSize[] = $option->plaintext;
                        if (strpos($option->class, 'disabled') !== false) {
                            continue;
                        }

                        $valueSize[] = $option->plaintext;
                    }
                } else {
                    $allValueSize[] = "Standart";
                    $valueSize[] = "Standart";
                }

                $bedensayfa->clear();
            } else {
                $allValueSize[] = "Standart";
                $valueSize[] = "Standart";
            }
            // BEDENLERİ ÇEKME SON

            $lastIndex = count($cllink); // SON İNDEKS SAYISI

            $urlcolorsize = '';

            // RENKLERİN BEDENLERİNİ ÇEKME
            for ($r = 0; $r <= count($cllink); $r++) {
                if ($r == $lastIndex) {
                    continue; // İlk VE son yinelmeyi atla.
                }
                $urlcolorsize = 'https://www.modanisa.com/en/' . $cllink[$r];
                // CURL ile isteği oluşturun.

                $chs = curl_init($urlcolorsize);
                curl_setopt($chs, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($chs, CURLOPT_SSL_VERIFYPEER, false);
                $headers = ['Cookie: user_shipping_data=%7B%22currency%22%3A%22USD%22%2C%22country_id%22%3A38%2C%22country_code%22%3A%22US%22%2C%22ip_welcome%22%3A%22%22%2C%22ip_country_id%22%3A%221%22%2C%22ip_country_code%22%3A%22TR%22%2C%22customer_language%22%3A%22EN%22%7D;'];
                curl_setopt($chs, CURLOPT_HTTPHEADER, $headers);
                $responsesize = curl_exec($chs);
                curl_close($chs);

                $resimsayfahref = str_get_html($responsesize);

                // RESİMLERİ ÇEKME
                /*
                preg_match('@<div class="gallery_l">(.*?)</div>@si', $responsesize, $galleryMatches);
                if (!empty($galleryMatches[1])) {
                    $galleryContent = $galleryMatches[1];
                    preg_match_all('@<img src="(.*?)"@si', $galleryContent, $images);

                    foreach ($images[1] as $image) {
                        $modifiedİmage = preg_replace('/u/', 'z', $image, 1);
                        $imagesrc[] = $modifiedİmage;
                    }
                    $dizi[$colors[$r] . 'imagesrc'] = $imagesrc;
                    
                    $imagesrc = [];
                }*/




                if ($resimsayfahref->find('div.gallery_l', 0)) {

                    $allgallerys = $resimsayfahref->find('div.gallery_l', 0);
                    $imagesrc = [];
                    foreach ($allgallerys->find('a') as $gallerys) {
                        $imagesrc[] = $gallerys->href;
                        $dizi[$colors[$r] . 'imagesrc'] = $imagesrc;
                    }
                } else {
                    preg_match('@<div class="gallery_l">(.*?)</div>@si', $responsesize, $galleryMatches);
                    if (!empty($galleryMatches[1])) {
                        $galleryContent = $galleryMatches[1];
                        preg_match_all('@<img src="(.*?)"@si', $galleryContent, $images);

                        foreach ($images[1] as $image) {
                            $modifiedİmage = preg_replace('/u/', 'z', $image, 1);
                            $imagesrc[] = $modifiedİmage;
                        }
                        $dizi[$colors[$r] . 'imagesrc'] = $imagesrc;

                        $imagesrc = [];
                    }
                }



                // RESİMLERİ ÇEKME SON

                if ($catname != 'HIJABS') {
                    preg_match_all('@<div id="other-color-products-container".*?data-product-id="(.*?)".*?data-brand-id="(.*?)".*?data-provider-code="(.*?)".*?data-color="(.*?)".*?data-category="(.*?)"><\/div>@si', $responsesize, $prinfos);

                    // RENK BEDENLERİ ÇEKME
                    $link1 = str_replace('/', '', $cllink[$r]);
                    $link2 = str_replace('.html', '', $link1);

                    foreach ($prinfos[1] as $infono) {
                        $urlbedensub = '/api/product_variants.php?ck=' . $infono . '-38-en-USD-axcv&productId=' . $infono . '&productSef=' . $link2 . '&beden=';
                    }

                    $sefurlbeden = str_replace(' ', '', $urlbedensub);
                    $sefurlbedenson = str_replace('en', '', $sefurlbeden);
                    $urlson = 'https://www.modanisa.com/en' . $sefurlbedenson;

                    $chr = curl_init($urlson);
                    curl_setopt($chr, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($chr, CURLOPT_SSL_VERIFYPEER, false);
                    $headers = ['Cookie: user_shipping_data=%7B%22currency%22%3A%22USD%22%2C%22country_id%22%3A38%2C%22country_code%22%3A%22US%22%2C%22ip_welcome%22%3A%22%22%2C%22ip_country_id%22%3A%221%22%2C%22ip_country_code%22%3A%22TR%22%2C%22customer_language%22%3A%22EN%22%7D;'];
                    curl_setopt($chr, CURLOPT_HTTPHEADER, $headers);
                    $filessize = curl_exec($chr);
                    curl_close($chr);

                    $bedensayfasize = str_get_html($filessize);

                    if ($bedensayfasize->find('div.productSizeBoxes-tabContent-us', 0)) {
                        $div = $bedensayfasize->find('div.productSizeBoxes-tabContent-us', 0);
                        $select = $div->find('select.productSizeSelect-type1', 0);
                        $optionss = $select->find('option');
                    } else if ($bedensayfasize->find('select.productSizeSelect-type1', 0)) {
                        $select = $bedensayfasize->find('select.productSizeSelect-type1', 0);
                        $optionss = $select->find('option');
                    } else {
                        $optionss = ["Standart"];
                    }

                    $sizeNo = '';

                    if (count($optionss) > 1) {
                        foreach ($optionss as $option) {
                            if (strpos($option->class, 'disabled') !== false) {
                                continue;
                            }
                            if ($option->plaintext == 'Choose Size' || $option->plaintext == '') {
                                continue;
                            }
                            $sizeNo .= $option->plaintext . '<br>';
                        }

                        $sizeNoSef[$colors[$r] . 'Sizesr'] = explode('<br>', $sizeNo);

                        if ($sizeNoSef[$colors[$r] . 'Sizesr'][0] == '') {

                            $sizeNoSef[$colors[$r] . 'Sizesr'][0] = '';
                        }

                        $bedensayfasize->clear();
                    } else {
                        $sizeNoSef[$colors[$r] . 'Sizesr'][0] = 'Standart';
                    }
                } else {
                    $sizeNoSef[$colors[$r] . 'Sizesr'][0] = 'Standart';
                }

                // RENK BEDENLERİ ÇEKME SON
            }
            if (empty($allValueSize)) {
                $allValueSize[] = 'Standart';
            }
            // RENKLERİN BEDENLERİNİ ÇEKME SON

        }


        // CHAT-GPT İŞLEMİ

        $ebayapi = Ebay::pluck("api")->first();

        $yeninot = ' e ticarette açıklama için 3 başlık belirle çıktın sadece json formatında ve anahtar kelime ile dönmeli?';
        $data = '{
            "model" : "gpt-3.5-turbo",
            "messages" : [{"role": "user", "content": "' . $yeninot . '"}],
            "temperature" : 0.8,
            "max_tokens" : 256
        }';


        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.openai.com/v1/chat/completions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $ebayapi . '', 'Content-Type: application/json'],
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response);
        if (isset($response->error->message)) {
            $errMessage = $response->error->message;
            return view("status.dangerchatgpt", compact('errMessage'));
        }


        $text = $response->choices[0]->message->content;

        $yeninots = $text . '" Bu başlıkları ve anahtar kelimeleri kullanarak "' . $not . '"bu nota göre açıklama çıkar ingilizce olsun en az 500 karakter olsun açıklamada tamamen ingilizce olsun';
        $sefyeninot = str_replace("{", "", $yeninots);
        $sefyeninot2 = str_replace("}", "", $sefyeninot);
        $sefyeninot3 = str_replace('"', "'", $sefyeninot2);


        $data = [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                ["role" => "user", "content" => $sefyeninot3]
            ],
            "temperature" => 0.8,
            "max_tokens" => 500
        ];
        $jsonData = json_encode($data);
        $curl1 = curl_init();

        curl_setopt_array($curl1, [
            CURLOPT_URL => 'https://api.openai.com/v1/chat/completions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $jsonData,
            CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $ebayapi . '', 'Content-Type: application/json'],
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $responsea = curl_exec($curl1);

        curl_close($curl1);

        $responsea = json_decode($responsea);
        if (isset($responsea->error->message)) {
            $errMessage = $responsea->error->message;
            return view("status.dangerchatgpt", compact('errMessage'));
        }

        $text2 = $responsea->choices[0]->message->content;

        $text1 = "Product: " . $number . '<br>' . $text2;
        //CHAT-GPT SON


        //CHAT-GPT İSİM 
        $isimPromt = "eBay'da " . $catname . " kategorisinde yeni bir ürün listeleyeceğim, bu ürün için dikkat çeken ürünün özelliklerine değinen ve müşterileri satın almaya teşvik edecek 80 karakteri aşmayan ancak 80 karaktere en yakın uzunlukta İngilizce bir başlık yaz. Mevcut ürünün başlığı ise şu şekilde " . $name . ".";

        $dataName = '{
            "model" : "gpt-3.5-turbo",
            "messages" : [{"role": "user", "content": "' . $isimPromt . '"}],
            "temperature" : 0.8,
            "max_tokens" : 256
        }';

        $curlName = curl_init();

        curl_setopt_array($curlName, [
            CURLOPT_URL => 'https://api.openai.com/v1/chat/completions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $dataName,
            CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $ebayapi . '', 'Content-Type: application/json'],
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $responseName = curl_exec($curlName);

        curl_close($curlName);

        $responseName = json_decode($responseName);

        $textName = $responseName->choices[0]->message->content;
        $seftextName = str_replace('"', "", $textName);
        //dd($textName,$name,$isimPromt);

        //CHAT-GPT İSİM SON



        $categories = Categories::where('categorylevel', '1')->get();

        return view('urundetay', compact('number', 'imageSrcs', 'not', 'seftextName', 'price', 'cllink', 'valueSize', 'imagesrc', 'sizeNoSef', 'allValueSize', 'text1', 'catname', 'colors', 'dizi', 'rate', 'categories'));

    }



}
