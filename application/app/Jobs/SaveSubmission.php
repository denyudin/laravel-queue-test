<?php
declare(strict_types=1);

namespace App\Jobs;

use App\Enums\SubmissionStatuses;
use App\Events\SubmissionSaved;
use App\Interfaces\Repositories\SubmissionRepositoryInterface;
use App\Models\Submission;
use App\Repositories\SubmissionRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class SaveSubmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    public array $data;
    protected $submissionRepository;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
        $this->submissionRepository = resolve(SubmissionRepository::class);
    }


    /**
     * @return void
     */
    public function handle(): void
    {
        $this->submissionRepository->create($this->data);
        $logData = [
            'status' => SubmissionStatuses::SUCCESS,
            'email' => $this->data['email']
        ];

        SubmissionSaved::dispatch($logData);
    }

    /**
     * @param Throwable $exception
     * @return void
     */
    public function failed(Throwable $exception): void
    {
        $logData = [
            'status' => SubmissionStatuses::FAIL,
            'email' => $this->data['email'],
            'reason' => $exception->getMessage()
        ];

        SubmissionSaved::dispatch($logData);
    }
}
