<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SubmitRequest;
use App\Interfaces\Controllers\SubmissionControllerInterface;
use App\Services\SubmissionService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class SubmissionController extends Controller implements SubmissionControllerInterface
{
    /**
     * @param SubmissionService $submissionService
     */
    public function __construct(
        protected SubmissionService $submissionService
    ){}


    /**
     * @param SubmitRequest $request
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function submit(SubmitRequest $request): \Illuminate\Foundation\Application|Response|Application|ResponseFactory
    {
        $data = $request->validated();
        $this->submissionService->submit($data);

        return response([
            'message' => 'Submission request accepted'
        ],200);
    }
}
