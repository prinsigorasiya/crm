<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Created;
use App\Models\Role;
use App\Models\User;
use App\Models\Users;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\UsersController
 */
final class UsersControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UsersController::class,
            'store',
            \App\Http\Requests\UsersStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $name = fake()->name();
        $mobile = fake()->word();
        $owner_approval = fake()->randomElement(/** enum_attributes **/);
        $role = Role::factory()->create();
        $status = fake()->randomElement(/** enum_attributes **/);
        $created = Created::factory()->create();

        $response = $this->post(route('users.store'), [
            'name' => $name,
            'mobile' => $mobile,
            'owner_approval' => $owner_approval,
            'role_id' => $role->id,
            'status' => $status,
            'created_id' => $created->id,
        ]);

        $users = User::query()
            ->where('name', $name)
            ->where('mobile', $mobile)
            ->where('owner_approval', $owner_approval)
            ->where('role_id', $role->id)
            ->where('status', $status)
            ->where('created_id', $created->id)
            ->get();
        $this->assertCount(1, $users);
        $user = $users->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $user = Users::factory()->create();

        $response = $this->get(route('users.show', $user));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UsersController::class,
            'update',
            \App\Http\Requests\UsersUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $user = Users::factory()->create();
        $name = fake()->name();
        $mobile = fake()->word();
        $owner_approval = fake()->randomElement(/** enum_attributes **/);
        $role = Role::factory()->create();
        $status = fake()->randomElement(/** enum_attributes **/);
        $created = Created::factory()->create();

        $response = $this->put(route('users.update', $user), [
            'name' => $name,
            'mobile' => $mobile,
            'owner_approval' => $owner_approval,
            'role_id' => $role->id,
            'status' => $status,
            'created_id' => $created->id,
        ]);

        $user->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $user->name);
        $this->assertEquals($mobile, $user->mobile);
        $this->assertEquals($owner_approval, $user->owner_approval);
        $this->assertEquals($role->id, $user->role_id);
        $this->assertEquals($status, $user->status);
        $this->assertEquals($created->id, $user->created_id);
    }
}
