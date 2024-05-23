<?php

namespace Tests\Unit;

use App\Http\Controllers\UserController;
use App\Models\User;
use App\Models\Departament;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test para creacion de Usuarios
     *
     * @return void
     */
    public function testStore()
    {
        $request = Request::create('/admin/users', 'POST', [
            'name' => 'Test User',
            'departament_id' => '1',
            'email' => 'test@example.com',
            'password' => 'Password123',
        ]);

        $controller = new UserController();
        $response = $controller->store($request);
        $this->assertEquals(302, $response->status());
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
    }

    /**
     * Test para la Actulizacion de Usuarios
     *
     * @return void
     */
    public function testUpdate()
    {
        $user = User::factory()->create();
        $departament = Departament::factory()->create();
        $request = Request::create('/admin/users/' . $user->id, 'PUT', [
            'name' => 'Updated User',
            'departament_id' =>$departament->id,
            'email' => 'updated@example.com',
        ]);
        $controller = new UserController();
        $response = $controller->update($request, $user);
        $this->assertEquals(302, $response->status());
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => 'updated@example.com',
            'name' => 'Updated User',
            'departament_id' => $departament->id,
        ]);
    }

    /**
     * Test para la Eliminacion de Usuarios
     *
     * @return void
     */
    public function testDestroy()
    {
        $user = User::factory()->create();
        $response = $this->delete('/admin/users/' . $user->id);
        $this->assertEquals(302, $response->status());
        $this->assertNotSoftDeleted($user);
    }
}
