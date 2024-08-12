<?php
declare(strict_types=1);

namespace App\Services;

use App\Interfaces\Services\SubmissionServiceInterface;
use App\Jobs\SaveSubmission;

class SubmissionService implements SubmissionServiceInterface
{
    /**
     * @param array $data
     * @return void
     */
    public function submit(array $data): void
    {
        SaveSubmission::dispatch($data);
    }
}
