<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleXMLElement;

class EbayController extends Controller
{
    public function addEbay(Request $request)
    {
        $amount = $request->input('amount');
        $category = $request->input('category');
        $name = $request->input('name');
        $urunId = $request->input('urunId');
        $aciklama = $request->input('aciklama');
        $resimSayi = $request->input('resimSayi');

        if ($request->input('allbedensayi')) {
            $allBedenSayi = $request->input('allbedensayi');
        } else {
            $allBedenSayi = "";
        }

        if ($request->input('bedenSayi')) {
            $bedenSayi = $request->input('bedenSayi');
        } else {
            $bedenSayi = "";
        }


        $renkSayi = $request->input('renkSayi');
        $p_price = (float) $request->input('p_price');

        //BÜTÜN BEDENLER
        $allbedens = "";
        for ($n = 0; $n < $allBedenSayi; $n++) {
            $allbedens .= $request->input('allbeden' . $n) . '<br>';
        }
        $allbedenArray = explode("<br>", $allbedens);
        //BÜTÜN BEDENLER SON 

        // ASIL ÜRÜN RESİMLERİ
        $resim = "";
        for ($i = 1; $i <= $resimSayi; $i++) {
            $resim .= $request->input('resim' . $i) . '<br>';
        }
        $resimArray = explode("<br>", $resim);
        // ASIL ÜRÜN RESİMLERİ SON

        // ASIL ÜRÜN BEDENLERİ
        if ($bedenSayi) {
            $beden = "";
            for ($l = 1; $l <= $bedenSayi; $l++) {
                $beden .= $request->input('beden' . $l) . '<br>';
            }
            $bedenArray = explode("<br>", $beden);
        } else {
            $bedenArray = "";
        }
        // ASIL ÜRÜN BEDENLERİ SON

        // ÜRÜNÜN RENKLERİ 
        $renk = "";
        $eklenenRenkler = array(); // Eklenen renkleri takip etmek için bir dizi oluşturun

        for ($k = 1; $k <= $renkSayi; $k++) {
            $colorName = $request->input('colorName' . $k);

            if (!in_array($colorName, $eklenenRenkler)) {
                $renk .= $colorName . '<br>';
                $eklenenRenkler[] = $colorName; // Eklenen renkleri takip etmek için diziye ekleyin
            }
        }
        $renkArray = explode("<br>", $renk);
        // ÜRÜNÜN RENKLERİ SON
        $renkSayiNew = count($renkArray);

        // ÜRÜNÜN DİĞER RENKLERİNİN RESİMİ
        for ($j = 1; $j <= $renkSayiNew; $j++) {
            $renkİmage[$renkArray[$j - 1]] = $request->input('otherColorİmage' . $j);
        }
        // ÜRÜNÜN DİĞER RENKLERİNİN RESİMİ SON

        // ÜRÜNÜN DİĞER RENKLERİNİN BEDENİ
        for ($h = 1; $h <= $renkSayiNew; $h++) {
            $inputName = 'otherColorSize' . $h;
            if ($request->has($inputName)) {
                $renkSİZE[$renkArray[$h - 1]] = $request->input($inputName);
            }
        }
        // ÜRÜNÜN DİĞER RENKLERİNİN BEDENİ SON




        //dd($amount,$category,$name,$aciklama,$urunId,$resimSayi,$renkSayi,$p_price,$name,$bedenSayi,$allbedenArray,$resimArray,$bedenArray,$renkArray,$renkİmage,$renkSİZE);

        set_time_limit(500);

        $url = 'https://api.ebay.com/ws/api.dll';


        // Yeni bir SimpleXMLElement oluşturun
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?>
<VerifyAddFixedPriceItemRequest xmlns="urn:ebay:apis:eBLBaseComponents"></VerifyAddFixedPriceItemRequest>');
        // RequesterCredentials öğesini ekleyin
        $requesterCredentials = $xml->addChild('RequesterCredentials');
        $requesterCredentials->addChild('eBayAuthToken', 'v^1.1#i^1#r^1#f^0#p^3#I^3#t^Ul4xMF85OjhGMkQwN0NBMUY2OTJGQUM3RjYwRjUwNjg0MTY5MTI3XzNfMSNFXjI2MA==');

        // ErrorLanguage, WarningLevel öğelerini ekleyin
        $xml->addChild('ErrorLanguage', 'en_US');
        $xml->addChild('WarningLevel', 'High');

        // Item öğesini ekleyin
        $item = $xml->addChild('Item');
        $item->addChild('Country', 'US');
        $item->addChild('Currency', 'USD');
        $item->addChild('ConditionID', '1000');
        $item->addChild('Description', $aciklama);
        $item->addChild('DispatchTimeMax', '3');
        $item->addChild('ListingDuration', 'GTC');
        $item->addChild('ListingType', 'FixedPriceItem');
        $item->addChild('PostalCode', '95125');

        // PrimaryCategory öğesini ekleyin
        $primaryCategory = $item->addChild('PrimaryCategory');
        $primaryCategory->addChild('CategoryID', $category);

        $item->addChild('Title', $name);

        // PictureDetails öğesini ekleyin
        $pictureDetails = $item->addChild('PictureDetails');
        foreach ($resimArray as $resim) {
            if (empty($resim)) {
                continue;
            }
            $pictureDetails->addChild('PictureURL', $resim);
        }

        // ReturnPolicy öğesini ekleyin
        $returnPolicy = $item->addChild('ReturnPolicy');
        $returnPolicy->addChild('ReturnsAcceptedOption', 'ReturnsAccepted');
        $returnPolicy->addChild('RefundOption', 'MoneyBack');
        $returnPolicy->addChild('ReturnsWithinOption', 'Days_30');
        $returnPolicy->addChild('ShippingCostPaidByOption', 'Buyer');

        // ShippingDetails öğesini ekleyin
        $shippingDetails = $item->addChild('ShippingDetails');
        $calculatedShippingRate = $shippingDetails->addChild('CalculatedShippingRate');
        $calculatedShippingRate->addChild('OriginatingPostalCode', '95125');




        $salesTax = $shippingDetails->addChild('SalesTax');
        $salesTax->addChild('SalesTaxPercent', '8.75');
        $salesTax->addChild('SalesTaxState', 'CA');

        $shippingServiceOptions1 = $shippingDetails->addChild('ShippingServiceOptions');
        $shippingServiceOptions1->addChild('FreeShipping', 'true');
        $shippingServiceOptions1->addChild('ShippingService', 'USPSPriority');
        $shippingServiceOptions1->addChild('ShippingServicePriority', '1');

        $shippingServiceOptions2 = $shippingDetails->addChild('ShippingServiceOptions');
        $shippingServiceOptions2->addChild('ShippingService', 'UPSGround');
        $shippingServiceOptions2->addChild('ShippingServicePriority', '2');

        $shippingServiceOptions3 = $shippingDetails->addChild('ShippingServiceOptions');
        $shippingServiceOptions3->addChild('ShippingService', 'UPSNextDay');
        $shippingServiceOptions3->addChild('ShippingServicePriority', '3');

        $shippingDetails->addChild('ShippingType', 'Calculated');
        $ShippingPackageDetails = $item->addChild('ShippingPackageDetails');
        $ShippingPackageDetails->addChild('MeasurementUnit', 'English');
        $ShippingPackageDetails->addChild('PackageDepth', '6');
        $ShippingPackageDetails->addChild('PackageLength', '7');
        $ShippingPackageDetails->addChild('PackageWidth', '7');
        $ShippingPackageDetails->addChild('ShippingPackage', 'PackageThickEnvelope');
        $ShippingPackageDetails->addChild('WeightMajor', '2');
        $ShippingPackageDetails->addChild('WeightMinor', '0');

        // ItemSpecifics öğesini ekleyin
        $itemSpecifics = $item->addChild('ItemSpecifics');

        $nameValueList1 = $itemSpecifics->addChild('NameValueList');
        $nameValueList1->addChild('Name', 'Occasion');
        $nameValueList1->addChild('Value', 'Casual');

        $nameValueList2 = $itemSpecifics->addChild('NameValueList');
        $nameValueList2->addChild('Name', 'Brand');
        $nameValueList2->addChild('Value', 'Storex');

        $nameValueList5 = $itemSpecifics->addChild('NameValueList');
        $nameValueList5->addChild('Name', 'Department');
        $nameValueList5->addChild('Value', 'Women');

        $nameValueList6 = $itemSpecifics->addChild('NameValueList');
        $nameValueList6->addChild('Name', 'Size Type');
        $nameValueList6->addChild('Value', 'Regular');


        $nameValueList7 = $itemSpecifics->addChild('NameValueList');
        $nameValueList7->addChild('Name', 'Type');
        $nameValueList7->addChild('Value', 'Top');

        $nameValueList8 = $itemSpecifics->addChild('NameValueList');
        $nameValueList8->addChild('Name', 'Product ID');
        $nameValueList8->addChild('Value', $urunId);

        $nameValueList9 = $itemSpecifics->addChild('NameValueList');
        $nameValueList9->addChild('Name', 'Dress Length');
        $nameValueList9->addChild('Value', '0');

        $nameValueList10 = $itemSpecifics->addChild('NameValueList');
        $nameValueList10->addChild('Name', 'Style');
        $nameValueList10->addChild('Value', '0');

        $nameValueList11 = $itemSpecifics->addChild('NameValueList');
        $nameValueList11->addChild('Name', 'Outer Shell Material');
        $nameValueList11->addChild('Value', '0');

        $nameValueList12 = $itemSpecifics->addChild('NameValueList');
        $nameValueList12->addChild('Name', 'Material');
        $nameValueList12->addChild('Value', '0');

        $nameValueList13 = $itemSpecifics->addChild('NameValueList');
        $nameValueList13->addChild('Name', 'Neckline');
        $nameValueList13->addChild('Value', '0');

        $nameValueList14 = $itemSpecifics->addChild('NameValueList');
        $nameValueList14->addChild('Name', 'Upper Material');
        $nameValueList14->addChild('Value', '0');

        $nameValueList15 = $itemSpecifics->addChild('NameValueList');
        $nameValueList15->addChild('Name', 'Colour');
        $nameValueList15->addChild('Value', '0');

        $nameValueList16 = $itemSpecifics->addChild('NameValueList');
        $nameValueList16->addChild('Name', 'Skirt Length');
        $nameValueList16->addChild('Value', '0');

        $nameValueList17 = $itemSpecifics->addChild('NameValueList');
        $nameValueList17->addChild('Name', 'Colour');
        $nameValueList17->addChild('Value', '0');


        // Variations öğesini ekleyin
        $variations = $item->addChild('Variations');

        $variationSpecificsSet = $variations->addChild('VariationSpecificsSet');
        $nameValueListSize = $variationSpecificsSet->addChild('NameValueList');
        $nameValueListSize->addChild('Name', 'Size');
        foreach ($allbedenArray as $beden) {
            if (empty($beden)) {
                continue;
            }
            $nameValueListSize->addChild('Value', $beden);

        }


        $nameValueListColor = $variationSpecificsSet->addChild('NameValueList');
        $nameValueListColor->addChild('Name', 'Color');
        foreach ($renkArray as $renk) {
            if (empty($renk)) {
                continue;
            }
            $nameValueListColor->addChild('Value', $renk);

        }



        foreach ($renkArray as $renk) {
            if (empty($renk)) {
                continue;
            }
            foreach ($renkSİZE[$renk] as $renksize) {
                $variationName = 'variation_' . uniqid(); // Benzersiz bir değişken adı oluşturun
                $variationSpecificsName = 'variationSpecifics_' . uniqid();
                $nameValueListName1 = 'nameValueList_' . uniqid();

                // Oluşturulan değişken adlarını kullanarak varyasyonları oluşturun
                $$variationName = $variations->addChild('Variation');
                //$$variationName->addChild('SKU', 'Modanisa_' . $renk . '_SK');
                $$variationName->addChild('StartPrice', $p_price);
                $$variationName->addChild('Quantity', $amount);

                $$variationSpecificsName = $$variationName->addChild('VariationSpecifics');

                // Color
                $$nameValueListName1 = $$variationSpecificsName->addChild('NameValueList');
                $$nameValueListName1->addChild('Name', 'Color');
                $$nameValueListName1->addChild('Value', $renk);

                // Size
                $$nameValueListName1 = $$variationSpecificsName->addChild('NameValueList');
                $$nameValueListName1->addChild('Name', 'Size');
                $$nameValueListName1->addChild('Value', $renksize);
            }
        }


        $pictures = $variations->addChild('Pictures');
        $pictures->addChild('VariationSpecificName', 'Color');



        foreach ($renkArray as $renk) {
            if (empty($renk)) {
                continue;
            }

            $variationSpecificPictureSet1 = 'variationSpecificPictureSet_' . uniqid();
            $$variationSpecificPictureSet1 = $pictures->addChild('VariationSpecificPictureSet');
            $$variationSpecificPictureSet1->addChild('VariationSpecificValue', $renk);
            foreach ($renkİmage[$renk] as $renkimage) {
                if (empty($renkimage)) {
                    continue;
                }
                $$variationSpecificPictureSet1->addChild('PictureURL', $renkimage);
            }
        }


        // Düzenlenmiş XML çıktısını al
        $xml_content = $xml->asXML();
        /*
        print_r($xml_content);
        print_r('<br>');
        print_r('<br>');
        print_r('<br>');
        print_r('<br>');
        print_r('<br>');
        print_r('<br>');
        */


        // Düzenlenmiş XML çıktısını ekranda görüntüleme
        $headers = array(
            'X-EBAY-API-SITEID:0',
            // Örnek başlık
            'X-EBAY-API-COMPATIBILITY-LEVEL:967',
            // Örnek başlık
            'X-EBAY-API-CALL-NAME:VerifyAddFixedPriceItem',
            // Örnek başlık
        ); // İçeriğin XML olduğunu belirtiyoruz



        // cURL kullanarak HTTP isteği gönderme
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); // POST isteği
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_content); // İstek gövdesini ayarla
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Başlıkları ayarla
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // İstek gönderme ve yanıtı alma
        $response = curl_exec($ch);

        // cURL oturumunu kapatma
        curl_close($ch);

        dd($response);
        $simpleXml = new SimpleXMLElement($response);


        if (isset($simpleXml->Fees->Fee)) {
            foreach ($simpleXml->Fees->Fee as $status) {
                if ($status->Name == "AuctionLengthFee") {
                    return view('status.success');
                } else {
                    return view('status.danger');
                }

            }
        } else {

            if (isset($simpleXml->Errors[2]->LongMessage) && strpos($simpleXml->Errors[2]->LongMessage, "This listing would cause you ") !== false) {
                // İfade bulundu
                $errMessage = $simpleXml->Errors[2]->LongMessage;
                return view('status.danger', compact("errMessage"));
            } else {
                $errMessage = "Ebaydan Kaynaklı Hata";
                return view('status.danger', compact("errMessage"));
            }

        }
    }
}