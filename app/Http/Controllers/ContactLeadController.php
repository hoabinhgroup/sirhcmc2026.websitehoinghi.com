<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactLeadController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'message' => ['required', 'string', 'max:2000'],
            'g-recaptcha-response' => ['required', 'string'],
        ]);

        $secretKey = (string) config('services.recaptcha.secret_key');

        if ($secretKey === '') {
            return back()->withErrors([
                'recaptcha' => 'Chua cau hinh RECAPTCHA_SECRET_KEY.',
            ])->withInput();
        }

        $verifyResponse = Http::asForm()
            ->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $secretKey,
                'response' => $validated['g-recaptcha-response'],
                'remoteip' => $request->ip(),
            ])
            ->json();

        if (! data_get($verifyResponse, 'success')) {
            return back()->withErrors([
                'recaptcha' => 'Xac minh reCAPTCHA khong hop le.',
            ])->withInput();
        }

        // TODO: xu ly du lieu contact (gui mail/luu DB) tai day.

        return back()->with('contact_success', 'Gui lien he thanh cong.');
    }
}
