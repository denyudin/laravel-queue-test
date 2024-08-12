<?php

namespace App\Repositories;

use App\Exceptions\ModelSaveException;
use App\Interfaces\Repositories\SubmissionRepositoryInterface;
use App\Models\Submission;

class SubmissionRepository implements SubmissionRepositoryInterface
{
    protected Submission $model;

    public function __construct(Submission $submission)
    {
        $this->model = $submission;
    }


    /**
     * @param array $data
     * @return mixed
     * @throws ModelSaveException
     */
    public function create(array $data): mixed
    {
        try {
            return $this->model->create($data);
        } catch (\Exception $e) {
            throw new ModelSaveException("Failed to create submission: " . $e->getMessage());
        }
    }
}
