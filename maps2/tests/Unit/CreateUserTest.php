<?php


namespace Tests\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use App\Models\User;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;
    public function testCreateNewUser()
    {
        $userData = [
            'name' => 'khalil', 
            'email' => 'john150@example.com', 
            'password' => bcrypt('125helloword'),
        ];

        $user = User::create($userData);

        $this->assertNotNull($user);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('khalil', $user->name); 
        $this->assertEquals('john150@example.com', $user->email); 
    }
}
