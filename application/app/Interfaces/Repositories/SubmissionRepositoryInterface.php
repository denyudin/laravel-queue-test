<?php

namespace App\Interfaces\Repositories;

use App\Models\Submission;

interface SubmissionRepositoryInterface
{
    public function create(array $data);
}
