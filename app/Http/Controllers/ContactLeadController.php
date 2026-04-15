<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class ContactLeadController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'message' => ['required', 'string', 'max:2000'],
            // 'g-recaptcha-response' => ['required', 'string'],
        ]);

        // $secretKey = (string) config('services.recaptcha.secret_key');

        // if ($secretKey === '') {
        //     return back()->withErrors([
        //         'recaptcha' => 'Chua cau hinh RECAPTCHA_SECRET_KEY.',
        //     ])->withInput();
        // }

        // $verifyResponse = Http::asForm()
        //     ->post('https://www.google.com/recaptcha/api/siteverify', [
        //         'secret' => $secretKey,
        //         'response' => $validated['g-recaptcha-response'],
        //         'remoteip' => $request->ip(),
        //     ])
        //     ->json();

        // if (! data_get($verifyResponse, 'success')) {
        //     return back()->withErrors([
        //         'recaptcha' => 'Xac minh reCAPTCHA khong hop le.',
        //     ])->withInput();
        // }

        $recipient = 'dh.qt2@hoabinh-group.com';
        $fromAddress = (string) config('mail.from.address', 'noreply@localhost');
        $fromName = (string) config('mail.from.name', config('app.name', 'Website'));

        try {
            Mail::raw(
                "New contact lead from homepage form.\n\n".
                "Sender email: {$validated['email']}\n\n".
                "Message:\n{$validated['message']}\n",
                function ($message) use ($recipient, $validated, $fromAddress, $fromName): void {
                    $message
                        ->to($recipient)
                        ->from($fromAddress, $fromName)
                        ->replyTo($validated['email'])
                        ->subject('Homepage Contact Lead');
                }
            );
        } catch (\Throwable $exception) {
            report($exception);

            return back()->withErrors([
                'email' => 'Không thể gửi thông tin liên hệ, vui lòng thử lại sau',
            ])->withInput();
        }

        return back()->with('contact_success', 'Gửi thông tin liên hệ thành công');
    }
}
