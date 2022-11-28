<?php

namespace App\Controller\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SignInControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function pageCanBeRenderedForQuest(): void
    {
        $this->get(route('auth.sign-in'))
            ->assertOk();
    }

    /**
     * @test
     */
    public function pageCannotBeRenderedForAuthUser(): void
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->get(route('auth.sign-in'))
            ->assertRedirectToRoute('home');
    }

    /**
     * @test
     */
    public function questCanBeAuthorized(): void
    {
        $user = User::factory()
            ->create([
                'email' => 'maksym@gmail.com',
                'password' => bcrypt('test')
            ]);

        $params = [
            'email' => $user->email,
            'password' => 'test'
        ];

        $this->post(route('auth.sign-in.handle', $params))
            ->assertValid()
            ->assertRedirectToRoute('home');

        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     */
    public function authUserCannotBeAuthorized(): void
    {
        $user = User::factory(2)
            ->create();

        $params = [
            'email' => $user[0]->email,
            'password' => 'password'
        ];

        $this->actingAs($user[1])
            ->post(route('auth.sign-in.handle', $params))
            ->assertRedirectToRoute('home');

        $this->assertAuthenticatedAs($user[1]);
    }

    /**
     * @test
     * @dataProvider invalidData
     */
    public function errorIfInvalidData($data): void
    {
        $this->post(route('auth.sign-in.handle', $data))
            ->assertInvalid();
    }

    public function invalidData(): array
    {
        return [
            [
                'name' => '',
                'email' => 'example@gmail.com',
                'password' => 'password',
            ],
            [
                'name' => 'Maksym',
                'email' => '',
                'password' => 'password',
            ],
            [
                'name' => 'Maksym',
                'email' => 'example@gmail.com',
                'password' => '',
            ],
            [
                'name' => 'Maksym',
                'email' => 'maksym',
                'password' => 'password',
            ],
            [
                'name' => 'Maksym',
                'email' => 'sasd@saas.com',
                'password' => 'password',
            ],
            [
                'name' => '',
                'email' => '',
                'password' => '',
            ],
        ];
    }
}