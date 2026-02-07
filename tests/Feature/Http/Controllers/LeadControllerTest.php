<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\LeadController
 */
final class LeadControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LeadController::class,
            'store',
            \App\Http\Requests\LeadStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->post(route('leads.store'), [
            'status' => $status,
        ]);

        $leads = Lead::query()
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $leads);
        $lead = $leads->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $lead = Lead::factory()->create();

        $response = $this->get(route('leads.show', $lead));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LeadController::class,
            'update',
            \App\Http\Requests\LeadUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $lead = Lead::factory()->create();
        $status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->put(route('leads.update', $lead), [
            'status' => $status,
        ]);

        $lead->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($status, $lead->status);
    }
}
