<?php

namespace App\Services;

use App\Models\EmailLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class EmailLogService
{
    public function logSent(
        Model $owner,
        string $templateKey,
        string $recipientEmail,
        string $subject,
    ): EmailLog {
        return EmailLog::query()->create([
            'owner_type' => $owner->getMorphClass(),
            'owner_id' => $owner->getKey(),
            'template_key' => $templateKey,
            'recipient_email' => $recipientEmail,
            'subject' => $subject,
            'status' => 'sent',
            'sent_at' => now(),
        ]);
    }

    public function logFailed(
        Model $owner,
        string $templateKey,
        string $recipientEmail,
        string $subject,
        string $errorMessage,
    ): EmailLog {
        Log::error('Email send failed', [
            'template' => $templateKey,
            'recipient' => $recipientEmail,
            'error' => $errorMessage,
        ]);

        return EmailLog::query()->create([
            'owner_type' => $owner->getMorphClass(),
            'owner_id' => $owner->getKey(),
            'template_key' => $templateKey,
            'recipient_email' => $recipientEmail,
            'subject' => $subject,
            'status' => 'failed',
            'error_message' => $errorMessage,
        ]);
    }
}
