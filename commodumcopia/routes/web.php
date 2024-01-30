<?php

/*
titel: Routes Web.
beschrijving: Het script waar de routes van de website bijgehouden worden.
auteur: Pascal Thomasse Mol
versie: 16
aanmaakdatum: 18 jun 2023
laatste wijzigingsdatum: 29 aug 2023
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\SubCategoryController;



// De homepage
Route::get('/home', [HomeController::class, 'index'])->name('home');
// De doorverdingen van de root "/" naar de homepage. 
// Dit is om met mogelijke afscherming van de root bij shared hosting te kunnen werken. 
Route::redirect('/', '/home');

// Admin routes. Dit zijn de routes waar alleen administratoren bij mogen. 
// Deze zijn in een groep geplaats en de hele groep is met de admin middleware afgeschermd tegen ongeautoriseerde bezoekers. 
Route::middleware('admin')->group(function () {
    // De Admin homepage
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin.index');

    // Admin user routes. Deze routes zijn nodig om als administrator gebruikers te beheren. 
    Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users/store', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{post}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');

    // Products. Deze routes zijn nodig om als administrator de producten te beheren. 
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
   

    //Posts. Deze routes zijn nodig om als administrator de blogposts te beheren. 
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

    //Promotions. Deze routes zijn nodig om als administrator de promoties te beheren. 
    Route::get('/promotions/create', [PromotionController::class, 'create'])->name('promotions.create');
    Route::post('/promotions/store', [PromotionController::class, 'store'])->name('promotions.store');
    Route::get('/promotions/{id}/edit', [PromotionController::class, 'edit'])->name('promotions.edit');
    Route::put('/promotions/{post}', [PromotionController::class, 'update'])->name('promotions.update');
    Route::delete('/promotions/{id}', [PromotionController::class, 'destroy'])->name('promotions.destroy');
    Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions.index');

    //Admin Orders. De pagina's waar beheerders klantorders in kunnen zien.
    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/admin/orders/users/{user}', [AdminOrderController::class, 'userOrders'])->name('admin.orders.user');
    Route::get('/admin/orders/users/{user}/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
});




// Non Admin routes. 
// Voor de rest van de routes zijn geen administatorrechten nodig. 

//Products. Deze route is nodig om een product te tonen. 
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
// Posts. Deze route is nodig om een blogpost te tonen. 
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
// Promotion/ Deze route is nodig om een promotie te tonen. 
Route::get('/promotions/{id}', [PromotionController::class, 'show'])->name('promotions.show');
//search. Deze route is nodig om een de resultaten van een zoekopdracht te tonen. 
Route::get('/search', [SearchController::class, 'index'])->name('search.index');

//Auth. Dit zijn de routes die nodig zijn voor het inloogen en registreren. 
Route::get('/register', [AuthController::class, 'create'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.submit');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

//Categories. De routes om bestaande categorieën met bijbehorende sub-categorieën en producten te tonen. 
Route::get('/categories' , [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

// Subcategories.  De routes om bestaande sub-categorieën met bijbehorende producten te tonen. 
Route::get('/subcategories/{id}', [SubCategoryController::class, 'show'])->name('subcategories.show');

// Winkelmandje. De routes met betrekking tot het winkelmandje. Zoals het toevoegen en verwijderen van producten en het tonen van de producten. 
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::middleware('auth')->group(function () {
    Route::patch('/cart/update/{cartItem}', [CartController::class, 'updateCartItem'])->name('cart.update');
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'removeCartItem'])->name('cart.remove');
    Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
    Route::post('/decrease-quantity/{cartItemId}', [CartController::class, 'decreaseQuantity'])->name('decreaseQuantity');
    Route::post('/increase-quantity/{cartItemId}', [CartController::class, 'increaseQuantity'])->name('increaseQuantity');
});


// Profile. De route voor het tonen van de profielpagina.  
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index')->middleware('auth');

// Orders. De routes met betrekking tot het plaatsen van orders op basis van de producten in het winkelmandje. 
Route::middleware('auth')->group(function () {
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
});


// Shipping. De routes met betrekking tot het ingeven van verzendgegevens. 
Route::middleware('auth')->group(function () {
    Route::post('shipping' , [ShippingController::class, 'store'])->name('shipping.store');
    Route::get('/shipping', [ShippingController::class, 'create'])->name('shipping.create');
});

// Address. De routes met betrekking tot het aanamken, aanpassen en tonen van adresgegevens. 
Route::middleware('auth')->group(function () {
    Route::get('/address/{id}', [AddressController::class, 'edit'])->name('address.edit');
    Route::post('/address/store', [AddressController::class, 'store'])->name('address.store');
    Route::put('/address/{id}', [AddressController::class, 'update'])->name('address.update');
});

// De routess die de views van de footerpages ophalen. 
Route::prefix('/footer')->group(function () {
    Route::get('/about-us', function () { return view('footerpages.about');
    })->name('about');
    Route::get('/mailinglist', function () { return view('footerpages.mailinglist');
    })->name('mailingList');
    Route::get('/faq', function() { return view('footerpages.faq');
    })->name('faq');
    Route::get('/terms' , function() { return view('footerpages.terms');
    })->name('terms');
    Route::get('/delivery' , function() {  return view('footerpages.delivery');
    })->name('delivery');
    Route::get('/privacy' , function() { return view('footerpages.privacy');
    })->name('privacy');
});

// De route voor het verzenden van de welkomsmail
Route::post('/send-email', [MailController::class, 'sendEmail'])->name('sendEmail');

// De route naar de pagina die de video toont. 
Route::get('/show_video', function () {
    return view('videos.show');
})->name('video.show');

// Fallback route: not-found 
// Als een url niet gevonden is wordt de fallback route geactiveerd die de gebruiker naar de not-found pagina doorstuurd. 
Route::fallback(function () {
    return view('not-found');
});