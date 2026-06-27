<?php

use App\Http\Controllers\AbstractSubmissionController;
use App\Http\Controllers\ContactLeadController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\RegistrationFileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home.index')->name('home');

Route::view('/about', 'pages.about.index')->name('about');
Route::view('/about/organizing-committee', 'pages.about.organizing-committee')->name('about.organizing-committee');
Route::view('/about/venue', 'pages.about.venue')->name('about.venue');

Route::view('/speakers', 'pages.speaker.index')->name('speakers');

Route::view('/schedule', 'pages.schedule.index')->name('schedule');

Route::view('/faculty', 'pages.faculty.index')->name('faculty');

Route::view('/registration', 'pages.registration.index')->name('registration');
Route::get('/registration/delegate-registration', [RegistrationController::class, 'form'])->name('registration.delegate-registration');
Route::get('/registration/international-registration', [RegistrationController::class, 'formInternational'])->name('registration.international-registration');
Route::post('/registration/submit', [RegistrationController::class, 'submit'])->name('registration.submit');
Route::get('/registration/payment/callback', [RegistrationController::class, 'paymentCallback'])->name('registration.payment.callback');
Route::get('/registration/dr', [RegistrationController::class, 'paymentCallback'])->name('payment.registration.dr');
Route::get('/registration/payment/success/{registration?}', [RegistrationController::class, 'paymentSuccess'])->name('registration.payment.success');
Route::get('/registration/payment/cancel/{registration?}', [RegistrationController::class, 'paymentCancel'])->name('registration.payment.cancel');
Route::get('/registration/payment/error/{registration?}', [RegistrationController::class, 'paymentError'])->name('registration.payment.error');
Route::get('/registration/closed', [RegistrationController::class, 'closed'])->name('registration.closed');
Route::middleware('auth')->group(function () {
    Route::get('/registration/files/{registration}/degree', [RegistrationFileController::class, 'degree'])
        ->name('registration.files.degree');
});
Route::get('/registration/abstract-submission', [AbstractSubmissionController::class, 'form'])->name('registration.abstract-submission');
Route::get('/registration/abstract-submission/international', [AbstractSubmissionController::class, 'formInternational'])->name('registration.abstract-submission.international');
Route::post('/registration/abstract-submission/submit', [AbstractSubmissionController::class, 'submit'])->name('registration.abstract-submission.submit');
Route::get('/registration/abstract-submission/closed', [AbstractSubmissionController::class, 'closed'])->name('registration.abstract-submission.closed');

Route::view('/travel-support', 'pages.travel-support.index')->name('travel-support');
Route::view('/travel-support/vietnam-visa', 'pages.travel-support.vietnam-visa')->name('travel-support.vietnam-visa');
Route::view('/travel-support/transportation', 'pages.travel-support.transportation')->name('travel-support.transportation');

Route::view('/sponsor', 'pages.sponsor.index')->name('sponsor');

Route::view('/blog', 'pages.blog.index')->name('blog');

Route::get('/blog/{slug}', function (string $slug) {
    return view('pages.blog.detail', compact('slug'));
})->name('blog.show');

Route::view('/contact', 'pages.contact.index')->name('contact');
Route::post('/contact-lead', [ContactLeadController::class, 'store'])->name('contact-lead.store');
