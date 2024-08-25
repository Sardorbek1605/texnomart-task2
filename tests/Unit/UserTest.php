<?php


use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_user_list()
    {
        User::factory()->count(10)->create();

        $authUser = User::factory()->create();

        $token = JWTAuth::fromUser($authUser);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('/api/users');

        $response->assertStatus(200);
        $response->assertJsonCount(10, 'data');
    }

    public function test_unauthenticated_user_cannot_access_user_list()
    {
        $this->get('api/users')->assertUnauthorized();
    }

    public function test_show_user()
    {
        $user = User::factory()->create();
        $authUser = User::factory()->create();
        $token = JWTAuth::fromUser($authUser);
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('api/users/show/'.$user->id)
            ->assertOk()
            ->assertJsonStructure(['success', 'data', 'message'])
            ->assertJson([
                'success' => true,
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name
                ],
            ]);
    }
}
