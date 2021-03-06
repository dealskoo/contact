<?php

namespace Dealskoo\Contact\Tests\Feature;

use Dealskoo\Contact\Events\ContactCreated;
use Dealskoo\Contact\Mail\ContactMail;
use Dealskoo\Contact\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;

class ContactControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_handle()
    {
        Event::fake();
        Mail::fake();
        $first_name = 'test';
        $last_name = 't';
        $email = 'test@test.com';
        $title = 'test title';
        $message = 'test message';
        $response = $this->post(route('contact.inbox'), [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'title' => $title,
            'message' => $message
        ]);

        $response->assertStatus(302);
        Mail::assertSent(ContactMail::class);
        Event::assertDispatched(ContactCreated::class);
    }

    public function test_handle_ajax()
    {
        Event::fake();
        Mail::fake();
        $first_name = 'test';
        $last_name = 't';
        $email = 'test@test.com';
        $title = 'test title';
        $message = 'test message';
        $response = $this->post(route('contact.inbox'), [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'title' => $title,
            'message' => $message
        ], [
            'HTTP_X-Requested-With' => 'XMLHttpRequest'
        ]);

        $response->assertStatus(200);
        Mail::assertSent(ContactMail::class);
        Event::assertDispatched(ContactCreated::class);
    }
}
