<?php

namespace App\Console\Commands;

use App\Models\Customer;
use App\Mail\LoginNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-email {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a test login notification email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email') ?? 'reveliowalker22@gmail.com';

        // Create a test customer or use existing one
        $customer = Customer::first() ?? Customer::create([
            'name' => 'Test Customer',
            'email' => $email,
            'password' => bcrypt('password'),
            'phone' => '123456789',
            'address' => 'Test Address',
            'total_points' => 0,
            'membership_level' => Customer::MEMBERSHIP_REGULAR,
        ]);

        $this->info("Sending test email to: {$email}");

        try {
            Mail::to($email)->send(new LoginNotification($customer));
            $this->info('Test email sent successfully!');
        } catch (\Exception $e) {
            $this->error('Failed to send email: ' . $e->getMessage());
        }
    }
}