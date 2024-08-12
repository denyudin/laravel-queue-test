<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use App\Http\Requests\SubmitRequest;
use Illuminate\Support\Facades\Validator;

class SubmissionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Queue::fake();
    }

    public function testSubmitEndpoint()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'Hello',
        ];

        $response = $this->postJson('/api/submit', $data);

        $response->assertStatus(200)
            ->assertSeeText('Submission request accepted');
    }

    public function testSubmitEndpointValidation()
    {
        $invalidData = [
            'name' => '',
            'email' => 'invalid-email',
            'message' => '',
        ];

        $response = $this->postJson('/api/submit', $invalidData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'message']);
    }

    public function testSubmitRequestValidationRules()
    {
        $request = new SubmitRequest();

        $validator = Validator::make(
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'message' => 'Hello',
            ],
            $request->rules()
        );

        $this->assertTrue($validator->passes());
    }
}
