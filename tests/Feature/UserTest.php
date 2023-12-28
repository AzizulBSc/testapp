<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testUserCanBeCreated()
    {
        $user = new User;

        $user->name = 'John Doe';
        $user->email = 'johndoe@example.com';
        $user->password = 'password';

        $user->save();

        $this->assertTrue($user->exists);
    }

    /**
     * Test that a user can be logged in.
     */
    public function testUserCanLogin()
    {
        $user = factory(User::class)->create();

        $this->assertTrue(auth()->attempt(['email' => $user->email, 'password' => $user->password]));
    }
}
