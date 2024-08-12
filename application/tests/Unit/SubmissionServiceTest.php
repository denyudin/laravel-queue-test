<?php

namespace Tests\Unit;

use App\Jobs\SaveSubmission;
use App\Services\SubmissionService;
use Illuminate\Support\Facades\Queue;
use Mockery;
use Tests\TestCase;

class SubmissionServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Queue::fake();
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testSubmitMethodDispatchesSaveSubmissionJob()
    {
        $data = ['name' => 'John Doe', 'email' => 'john@example.com', 'message' => 'Hello'];

        $submissionService = new SubmissionService();
        $submissionService->submit($data);

        Queue::assertPushed(SaveSubmission::class, function ($job) use ($data) {
            return $job->data === $data;
        });
    }
}
