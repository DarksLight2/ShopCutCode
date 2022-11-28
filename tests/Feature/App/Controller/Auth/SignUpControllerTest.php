<?php

namespace App\Controller\Auth;

use App\Events\RegisterUserEvent;
use App\Listeners\SendEmailNewUserListener;
use App\Models\User;
use App\Notifications\NewUserNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class SignUpControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function pageCanBeRenderedForQuest(): void
    {
        $this->get(route('auth.sign-up'))
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
            ->get(route('auth.sign-up'))
            ->assertRedirectToRoute('home');
    }

    /**
     * @test
     */
    public function questCanBeRegistered(): void
    {
        Notification::fake();
        Event::fake();

        $params = [
            'email' => 'example@gmail.com',
            'name' => 'Example Example',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $this->assertDatabaseMissing('users', [
            'email' => $params['email'],
            'name' => $params['name'],
        ]);

        $this->post(route('auth.sign-up.handle'), $params)
            ->assertValid()
            ->assertRedirectToRoute('home');

        $this->assertDatabaseHas('users', [
            'email' => $params['email'],
            'name' => $params['name'],
        ]);

        $user = User::query()->where(['email' => $params['email']])->first();

        $this->assertAuthenticatedAs($user);

        Event::assertDispatched(RegisterUserEvent::class);
        Event::assertListening(RegisterUserEvent::class, SendEmailNewUserListener::class);

        (new SendEmailNewUserListener())
            ->handle(new RegisterUserEvent($user));

        Notification::assertSentTo($user, NewUserNotification::class);
    }

    /**
     * @test
     */
    public function authUserCannotBeRegistered(): void
    {
        Notification::fake();
        Event::fake();

        $user = User::factory()
            ->create();

        $params = [
            'email' => 'example@gmail.com',
            'name' => 'Example Example',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $this->actingAs($user)
            ->post(route('auth.sign-in.handle', $params))
            ->assertRedirectToRoute('home');

        $this->assertAuthenticatedAs($user);

        Event::assertNotDispatched(RegisterUserEvent::class);
        Notification::assertNothingSent();
    }

    /**
     * @test
     */
    public function errorWhenUserAlreadyExists(): void
    {
        $user = User::factory()
            ->create();

        $params = [
            'email' => $user->email,
            'name' => $user->name,
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $this->post(route('auth.sign-up.handle', $params))
            ->assertRedirectToRoute('auth.sign-up');
    }

    /**
     * @test
     * @dataProvider invalidData
     */
    public function errorIfInvalidData($data): void
    {
        $this->post(route('auth.sign-up.handle', $data))
            ->assertInvalid();
    }

    public function invalidData(): array
    {
        return [
            [
                'name' => '',
                'email' => 'example@gmail.com',
                'password' => 'password',
                'password_confirmation' => 'password',
            ],
            [
                'name' => 'Maksym',
                'email' => '',
                'password' => 'password',
                'password_confirmation' => 'password',
            ],
            [
                'name' => 'Maksym',
                'email' => 'example@gmail.com',
                'password' => '',
                'password_confirmation' => 'password',
            ],
            [
                'name' => 'Maksym',
                'email' => 'example@gmail.com',
                'password' => 'password',
                'password_confirmation' => '',
            ],
            [
                'name' => 'Maksym',
                'email' => 'maksym',
                'password' => 'password',
                'password_confirmation' => 'password',
            ],
            [
                'name' => 'Maksym',
                'email' => 'sasd@saas.com',
                'password' => 'password',
                'password_confirmation' => 'password',
            ],
            [
                'name' => '',
                'email' => '',
                'password' => '',
                'password_confirmation' => '',
            ],
        ];
    }
}