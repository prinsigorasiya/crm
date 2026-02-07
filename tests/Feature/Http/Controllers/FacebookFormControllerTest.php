<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\FacebookForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\FacebookFormController
 */
final class FacebookFormControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FacebookFormController::class,
            'store',
            \App\Http\Requests\FacebookFormStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->post(route('facebook-forms.store'), [
            'status' => $status,
        ]);

        $facebookForms = FacebookForm::query()
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $facebookForms);
        $facebookForm = $facebookForms->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $facebookForm = FacebookForm::factory()->create();

        $response = $this->get(route('facebook-forms.show', $facebookForm));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FacebookFormController::class,
            'update',
            \App\Http\Requests\FacebookFormUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $facebookForm = FacebookForm::factory()->create();
        $status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->put(route('facebook-forms.update', $facebookForm), [
            'status' => $status,
        ]);

        $facebookForm->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($status, $facebookForm->status);
    }
}
