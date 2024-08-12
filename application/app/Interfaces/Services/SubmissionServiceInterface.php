<?php
declare(strict_types=1);

namespace App\Interfaces\Services;

interface SubmissionServiceInterface
{
    /**
     * @param array $data
     * @return void
     */
    public function submit(array $data): void;
}
