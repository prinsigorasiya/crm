<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CompanyController
 */
final class CompanyControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CompanyController::class,
            'store',
            \App\Http\Requests\CompanyStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $name = fake()->name();
        $owner_approval = fake()->randomElement(/** enum_attributes **/);
        $status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->post(route('companies.store'), [
            'name' => $name,
            'owner_approval' => $owner_approval,
            'status' => $status,
        ]);

        $companies = Company::query()
            ->where('name', $name)
            ->where('owner_approval', $owner_approval)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $companies);
        $company = $companies->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $company = Company::factory()->create();

        $response = $this->get(route('companies.show', $company));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CompanyController::class,
            'update',
            \App\Http\Requests\CompanyUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $company = Company::factory()->create();
        $name = fake()->name();
        $owner_approval = fake()->randomElement(/** enum_attributes **/);
        $status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->put(route('companies.update', $company), [
            'name' => $name,
            'owner_approval' => $owner_approval,
            'status' => $status,
        ]);

        $company->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $company->name);
        $this->assertEquals($owner_approval, $company->owner_approval);
        $this->assertEquals($status, $company->status);
    }
}
