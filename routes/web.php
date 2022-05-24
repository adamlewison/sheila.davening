<?php

use App\Models\Item;
use App\Models\Prayer;
use App\Services\PayfastService;
use App\Services\PrayerService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/items/{item}', function (Item $item) {

    /*
    if (!$item->available()) {
        return redirect()->route('home');
    }
    */
    return view('item', compact('item'));
});

Route::post('/items/{item}', function (Item $item) {

    request()->validate([
        'email' => 'required|email'
    ]);

    if (!$item->available()) {
        return redirect()->back();
    }

    $item->update(['purchase_attempted_at' => Carbon::now()]);
    $purchaseAttempt = $item->purchaseAttempts()->create([
        'first_name'    => request()->first_name,
        'last_name'     => request()->last_name,
        'email'         => request()->email,
        'sponsor_by'    => request()->sponsor_by,
        'merit_of'      => request()->merit_of,
        'show_on_app'   => isset(request()->show_on_app) ? 'true' : 'false'
    ]);

    /*
     *

    $item_name = str_replace("'", "", $item->prayer->prayer) . " - nusach " . Item::NUSACH[$item->nusach];
    $p_id = "PA#" . $purchaseAttempt->id;
    $pf_form = PayfastService::form($item->price, $p_id, $item_name, request()->email, request()->first_name, request()->last_name);
    print("Redirecting to Payfast Payment Portal");
     */
    print("<p>You will now be redirected to the secure Walletdoc payment platform.
    It is your responsibility to ensure that you enter the full amount correctly (R" . $item->price . "). Your sponsorship will only
    be recognized once we have received this amount.</p>
    <p>Please click <a href='https://www.walletdoc.com/pay/Davening-Project'>here</a> to redirect to walletdoc payment portal</p>");
    // print('<div style="display: none"><form action="https://www.walletdoc.com/pay/Davening-Project"></form></div>');
    // print('<script type="text/javascript">document.getElementById("payfast-form").submit();</script>');
});

Route::post('donate', function () {

    request()->validate([
       'amount' => 'required|integer'
    ]);

    $p_id = "D#" . substr(Hash::make(time()), 20, 5);
    $pf_form = PayfastService::form(request()->amount, $p_id, 'Donation', request()->email, request()->first_name, request()->last_name);

    print("Redirecting to Payfast. If the page does not automatically redirect, please ensure you have javascript enabled and try again.");
    print('<div style="display: none">' . $pf_form . '</div>');
    print('<script type="text/javascript">document.getElementById("payfast-form").submit();</script>');
});
Route::get('thankyou/{item?}', function (Item $item = null) {
    return view('thank-you', compact('item'));
});

Route::post('payfast/go', function () {
    dd(request()->all());
});

Route::get('payfast/return', function () {
    dd(request());
});

Route::get('payfast/cancel', function () {

});

Route::post('payfast/notify', function () {
    PayfastService::notify();
});

Route::get('migrate-refresh', function () {
    Artisan::call('migrate:refresh');
});

Route::get('fill', function () {
    PrayerService::fill_tables();
});

Route::get('csv', function () {
    PrayerService::sponsor_info();
});


Route::get('/dashboard/{page?}', function ($page = 'main') {

    $cat = null;
    if ($page != 'main') {
        if (in_array(ucfirst($page), Prayer::categories())) {
            $cat = ucfirst($page);
        }
    }
    return view('dashboard')->with(['page' => $page, 'cat' => $cat]);
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('items/{item}/clear', [\App\Http\Controllers\ItemController::class, 'clear']);
});


require __DIR__.'/auth.php';
