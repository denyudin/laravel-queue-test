<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Submission;
use App\Repositories\SubmissionRepository;
use App\Exceptions\ModelSaveException;
use Mockery;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubmissionRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testCreateMethodCreatesSubmission()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'Hello',
        ];

        $submission = Mockery::mock(Submission::class);
        $submission->shouldReceive('create')
            ->with($data)
            ->andReturn((object) $data);

        $repository = new SubmissionRepository($submission);
        $result = $repository->create($data);

        $this->assertEquals((object) $data, $result);
    }

    public function testCreateMethodThrowsModelSaveException()
    {
        $this->expectException(ModelSaveException::class);

        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'Hello',
        ];

        $submission = Mockery::mock(Submission::class);
        $submission->shouldReceive('create')
            ->with($data)
            ->andThrow(new \Exception('Database error'));

        $repository = new SubmissionRepository($submission);
        $repository->create($data);
    }
}
