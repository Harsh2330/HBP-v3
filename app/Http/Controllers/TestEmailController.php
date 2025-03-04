<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class TestEmailController extends Controller
{
    public function sendTestEmail()
    {
        try {
            Mail::raw('This is a test email.', function ($message) {
                $message->to('your_test_email@example.com')
                        ->subject('Test Email');
            });

            Log::info('Test email sent successfully.');
            return 'Test email sent successfully.';
        } catch (\Exception $e) {
            Log::error('Error sending test email: ' . $e->getMessage());
            return 'Failed to send test email. Please check the logs for more details.';
        }
    }
}