<?php
declare(strict_types=1);

namespace App\Listeners;

use App\Enums\SubmissionStatuses;
use App\Events\SubmissionSaved;
use Illuminate\Support\Facades\Log;

class SubmissionLog
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }


    /**
     * @param SubmissionSaved $event
     * @return void
     */
    public function handle(SubmissionSaved $event): void
    {
        $data = $event->data;

        $message = match ($data['status']) {
            SubmissionStatuses::SUCCESS => "\nSubmission succeed for ${data['email']} \n\n",
            SubmissionStatuses::FAIL => "\nSubmission failed for ${data['email']} \n REASON: ${data['reason']}\n\n"
        };

        Log::info($message);
    }
}
