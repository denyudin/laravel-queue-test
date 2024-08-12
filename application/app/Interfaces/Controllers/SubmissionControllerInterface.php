<?php
declare(strict_types=1);

namespace App\Interfaces\Controllers;

use App\Http\Requests\SubmitRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

interface SubmissionControllerInterface
{
    /**
     * @param SubmitRequest $request
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function submit(SubmitRequest $request): \Illuminate\Foundation\Application|Response|Application|ResponseFactory;
}
