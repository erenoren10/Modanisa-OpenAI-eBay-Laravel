<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
{
    $query = $request->input('q'); // Arama sorgusu

    // Veritabanında arama işlemi yapın veya başka bir kaynakta arama yapın
    $results = Products::where('title', 'like', '%' . $query . '%')
    ->orWhere('categoryName', 'like', '%' . $query . '%')
    ->orWhere('dataId', 'like', '%' . $query . '%')
    ->simplepaginate(20);
    $name ="Arama";
    return view('search', compact('results','name','query'));
}
}
