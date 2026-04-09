<?php

use App\Http\Controllers\ContactLeadController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home.index')->name('home');

Route::view('/about', 'pages.about.index')->name('about');
Route::view('/about/organizing-committee', 'pages.about.organizing-committee')->name('about.organizing-committee');
Route::view('/about/venue', 'pages.about.venue')->name('about.venue');

Route::view('/speakers', 'pages.speaker.index')->name('speakers');

Route::view('/schedule', 'pages.schedule.index')->name('schedule');

Route::view('/faculty', 'pages.faculty.index')->name('faculty');

Route::view('/registration', 'pages.registration.index')->name('registration');
Route::view('/registration/delegate-registration', 'pages.registration.delegate-registration')->name('registration.delegate-registration');
Route::view('/registration/abstract-submission', 'pages.registration.abstract-submission')->name('registration.abstract-submission');

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
