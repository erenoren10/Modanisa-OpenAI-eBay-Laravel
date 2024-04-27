<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use SimpleXMLElement;

class CategoryController extends Controller
{
    public function addCategories()
    {
        $cha = curl_init();

        curl_setopt_array(
            $cha,
            array(
                CURLOPT_URL => 'https://api.ebay.com/ws/api.dll',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '<?xml version="1.0" encoding="utf-8"?>
        <GetCategoriesRequest xmlns="urn:ebay:apis:eBLBaseComponents">
            <RequesterCredentials>
                <eBayAuthToken>v^1.1#i^1#r^1#f^0#p^3#I^3#t^Ul4xMF85OjhGMkQwN0NBMUY2OTJGQUM3RjYwRjUwNjg0MTY5MTI3XzNfMSNFXjI2MA==</eBayAuthToken>
            </RequesterCredentials>
            <ErrorLanguage>en_US</ErrorLanguage>
            <WarningLevel>High</WarningLevel>
            <DetailLevel>ReturnAll</DetailLevel>
            <ViewAllNodes>true</ViewAllNodes>
        </GetCategoriesRequest>',
        CURLOPT_HTTPHEADER => array(
        'X-EBAY-API-SITEID: 0',
        'X-EBAY-API-COMPATIBILITY-LEVEL: 967',
        'X-EBAY-API-CALL-NAME: GetCategories',
        ),
        )
        );

        $responsed = curl_exec($cha);

        curl_close($cha);

        $xml = new SimpleXMLElement($responsed);


        foreach ($xml->CategoryArray->Category as $category) {
        Categories::create([
        'categoryID' => (string)$category->CategoryID,
        'categoryParentID' => (string)$category->CategoryParentID,
        'categoryName'=>(string)$category->CategoryName,
        'categorylevel' => (string)$category->CategoryLevel,
        ]);
        }
    }

    public function getSubcategories($categoryId)
    {
        $subCategories = Categories::where('categoryParentID', $categoryId)->get();

        return response()->json(['subCategories'=>$subCategories]);
    }
}
