<?php

namespace Tests\Feature;

use App\Mail\ContactFormMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SiteTest extends TestCase
{
    /**
     * Test home page returns 200.
     */
    public function test_home_page_is_accessible(): void
    {
        $response = $this->get(route('home'));
        $response->assertStatus(200);
        $response->assertViewIs('home');
    }

    /**
     * Test services page returns 200.
     */
    public function test_services_page_is_accessible(): void
    {
        $response = $this->get(route('services'));
        $response->assertStatus(200);
        $response->assertViewIs('services');
    }

    /**
     * Test gallery page returns 200.
     */
    public function test_gallery_page_is_accessible(): void
    {
        $response = $this->get(route('gallery'));
        $response->assertStatus(200);
        $response->assertViewIs('gallery');
    }

    /**
     * Test contactus page returns 200.
     */
    public function test_contactus_page_is_accessible(): void
    {
        $response = $this->get(route('contactus'));
        $response->assertStatus(200);
        $response->assertViewIs('contactus');
    }

    /**
     * Test contact form validation.
     */
    public function test_contact_form_validation_errors(): void
    {
        $response = $this->post(route('contactus.send'), []);

        $response->assertSessionHasErrors(['name', 'email', 'subject', 'message']);
    }

    /**
     * Test contact form submission.
     */
    public function test_contact_form_sends_email(): void
    {
        Mail::fake();

        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'subject' => 'Test Subject',
            'message' => 'This is a test message.',
        ];

        $response = $this->post(route('contactus.send'), $data);

        $response->assertSessionHas('success');
        
        Mail::assertSent(ContactFormMail::class, function ($mail) use ($data) {
            return $mail->contactData['email'] === $data['email'] &&
                   $mail->contactData['message'] === $data['message'];
        });
    }
}
