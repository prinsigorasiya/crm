<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\FacebookPage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\FacebookPageController
 */
final class FacebookPageControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FacebookPageController::class,
            'store',
            \App\Http\Requests\FacebookPageStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->post(route('facebook-pages.store'), [
            'status' => $status,
        ]);

        $facebookPages = FacebookPage::query()
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $facebookPages);
        $facebookPage = $facebookPages->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $facebookPage = FacebookPage::factory()->create();

        $response = $this->get(route('facebook-pages.show', $facebookPage));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FacebookPageController::class,
            'update',
            \App\Http\Requests\FacebookPageUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $facebookPage = FacebookPage::factory()->create();
        $status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->put(route('facebook-pages.update', $facebookPage), [
            'status' => $status,
        ]);

        $facebookPage->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($status, $facebookPage->status);
    }
}
