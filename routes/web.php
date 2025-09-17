<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\Common;
use App\Http\Controllers\Ngo;
use App\Http\Controllers\People;
use App\Http\Controllers\Website;
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
// For authentication routes
require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('auth')->group(function () {

    Route::get('/switch-to-ngo/{ngo_id}', [Auth\SettingController::class, 'switchToNgo'])->middleware('role:2')->name('switch.to.ngo');
    Route::get('/switch-back', [Auth\SettingController::class, 'switchBack'])->name('switch.back');

    Route::middleware('role:0')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    });

    // NGO routes
    Route::middleware('role:1')->prefix('ngo')->group(function () {

        Route::get('/profile', [Ngo\NgoController::class, 'show'])->name('ngo.profile');
        Route::get('/profile/edit', [Ngo\NgoController::class, 'edit'])->name('ngo.profile.edit');
        Route::put('/profile', [Ngo\NgoController::class, 'update'])->name('ngo.profile.update');

        Route::get('/events', [Ngo\EventController::class, 'events'])->name('ngo.events');
        Route::get('/events/create', [Ngo\EventController::class, 'createEvent'])->name('ngo.events.create');
        Route::post('/events', [Ngo\EventController::class, 'storeEvent'])->name('ngo.events.store');

        Route::get('/volunteers', [Ngo\VolunteerController::class, 'volunteers'])->name('ngo.volunteers');
        Route::post('/volunteers/{eventId}/{userId}/verify', [Ngo\VolunteerController::class, 'verifyVolunteer'])->name('ngo.volunteers.verify');

        Route::get('/donations', [Ngo\DonationController::class, 'donations'])->name('ngo.donations');
        Route::get('/notifications', [Ngo\NgoController::class, 'notifications'])->name('ngo.notifications');

        Route::get('/dashboard', function () {
            return view('ngo.dashboard');
        })->name('dashboard');
    });

    // People routes
    Route::middleware('role:2')->prefix('people')->group(function () {
        // User Profile Routes
        Route::get('/profile', [People\ProfileController::class, 'show'])->name('people.profile');
        Route::get('/profile/edit', [People\ProfileController::class, 'edit'])->name('people.profile.edit');
        Route::put('/profile', [People\ProfileController::class, 'update'])->name('people.profile.update');

        // NGO Search Routes
        Route::get('/ngos/search', [People\NgoSearchController::class, 'index'])->name('people.ngo.search');

        // Newsfeed Routes
        Route::get('/newsfeed', [People\NewsfeedController::class, 'index'])->name('people.newsfeed');

        // Volunteer Opportunities Routes
        Route::get('/volunteer/opportunities', [People\VolunteerController::class, 'index'])->name('people.volunteer.opportunities');
        Route::post('/volunteer/apply', [People\VolunteerController::class, 'apply'])->name('people.volunteer.apply');

        // Donations Routes
        Route::get('/donations', [People\DonationController::class, 'index'])->name('people.donations');
        Route::post('/donate/payment', [People\DonationController::class, 'showPaymentForm'])->name('donations.payment.request');
        Route::get('/donation/payment/success', [People\DonationController::class, 'paymentSuccess'])->name('payment.success');
        Route::get('/donation/payment/fail', [People\DonationController::class, 'paymentFail'])->name('payment.fail');

        // Notifications Routes
        Route::get('/notifications', [People\NotificationController::class, 'index'])->name('people.notifications');
        Route::post('/notifications/{id}/read', [People\NotificationController::class, 'markAsRead'])->name('people.notifications.read');

        // NGO Profile Routes
        Route::get('/ngo/{id}', [People\NgoProfileController::class, 'show'])->name('people.ngo.profile');
        Route::post('/ngo/{id}/favorite', [People\NgoProfileController::class, 'toggleFavorite'])->name('people.ngo.favorite');
    });

    // Shared routes (ngo and people, role_id=1,2)
    Route::middleware('role:1,2')->group(function () {
        Route::get('/feed', [Common\FeedController::class, 'index'])->name('common.feed');
        Route::post('/feed/like', [Common\FeedController::class, 'like'])->name('common.feed.like');
        Route::post('/feed/comment', [Common\FeedController::class, 'comment'])->name('common.feed.comment');
        Route::post('/feed', [Common\FeedController::class, 'create'])->name('common.feed.create');
    });
});

Route::get('/privacy', [Website\StaticPageController::class, 'privacy'])->name('privacy');
Route::get('/terms', [Website\StaticPageController::class, 'terms'])->name('terms');
Route::get('/advertising', [Website\StaticPageController::class, 'advertising'])->name('advertising');
Route::get('/cookies', [Website\StaticPageController::class, 'cookies'])->name('cookies');
Route::get('/more', [Website\StaticPageController::class, 'more'])->name('more');
