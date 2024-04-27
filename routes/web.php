<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EbayController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware('auth')->group(function () {
    Route::get('/', [PageController::class, 'index'])->name('index');
    Route::get('/allcategory', [PageController::class, 'allcategory'])->name('allcategory');
    Route::get('/category', [PageController::class, 'category'])->name('category');
    Route::get('/urundetay', [PageController::class, 'urundetay'])->name('urundetay');
    Route::get('/urungüncelle', [PageController::class, 'updateProducts'])->name('update.products');
    Route::post('/urunekle', [EbayController::class, 'addEbay'])->name('ekle.ebay');
    Route::post('/ebayapi', [PageController::class, 'updateApi'])->name('update.api');
    Route::post('/firstprompt', [PageController::class, 'updateFirstPrompt'])->name('update.first-prompt');
    Route::post('/secondprompt', [PageController::class, 'updateSecondPrompt'])->name('update.second-prompt');
    Route::post('/titleprompt', [PageController::class, 'updateTitlePrompt'])->name('update.title-prompt');

    Route::get('/get-subcategoriesindex/{categoryId}', [CategoryController::class, 'getSubCategories']);

    Route::get('/arama', [SearchController::class, 'search'])->name('arama');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';
