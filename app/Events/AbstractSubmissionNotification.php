<?php

namespace App\Events;

use App\Models\AbstractSubmission;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AbstractSubmissionNotification
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public AbstractSubmission $submission,
    ) {}
}
