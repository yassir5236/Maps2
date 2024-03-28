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
            'name' => 'khalil', // Mettre à jour le nom de l'utilisateur
            'email' => 'john150@example.com', // Mettre à jour l'e-mail de l'utilisateur
            'password' => bcrypt('125helloword'),
        ];

        $user = User::create($userData);

        $this->assertNotNull($user);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('khalil', $user->name); // Mettre à jour le nom attendu
        $this->assertEquals('john150@example.com', $user->email); // Mettre à jour l'e-mail attendu
    }
}
