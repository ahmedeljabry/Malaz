<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'subject', 'message', 'status',
        'is_spam', 'spam_score', 'ip_address', 'user_agent', 'spam_reasons', 'spam_checked_at',
    ];

    protected $casts = [
        'is_spam' => 'boolean',
        'spam_score' => 'decimal:2',
        'spam_reasons' => 'array',
        'spam_checked_at' => 'datetime',
    ];

    /**
     * Check if the message is spam based on various criteria
     */
    public function checkForSpam(): void
    {
        $score = 0.0;
        $reasons = [];

        // Check for suspicious keywords
        $suspiciousKeywords = [
            'viagra', 'casino', 'lottery', 'winner', 'free money', 'urgent',
            'bitcoin', 'crypto', 'investment', 'millionaire', 'rich quick',
            'pharmacy', 'medication', 'prescription', 'discount'
        ];

        $messageContent = strtolower($this->message . ' ' . $this->subject);

        foreach ($suspiciousKeywords as $keyword) {
            if (str_contains($messageContent, $keyword)) {
                $score += 0.3;
                $reasons[] = "Contains suspicious keyword: {$keyword}";
            }
        }

        // Check for excessive URLs
        $urlCount = preg_match_all('/https?:\/\/[^\s]+/i', $this->message, $matches);
        if ($urlCount > 2) {
            $score += 0.4;
            $reasons[] = "Contains {$urlCount} URLs (suspicious)";
        }

        // Check for repetitive characters
        if (preg_match('/(.)\1{10,}/', $this->message)) {
            $score += 0.2;
            $reasons[] = "Contains repetitive characters";
        }

        // Check for all caps subject
        if ($this->subject && strtoupper($this->subject) === $this->subject && strlen($this->subject) > 5) {
            $score += 0.2;
            $reasons[] = "Subject is all caps";
        }

        // Check for very short messages
        if (strlen($this->message) < 10) {
            $score += 0.1;
            $reasons[] = "Message is very short";
        }

        // Check for missing phone number
        if (!$this->phone) {
            $score += 0.1;
            $reasons[] = "Missing phone number";
        }

        // Check email domain
        $emailDomain = substr(strrchr($this->email, "@"), 1);
        $suspiciousDomains = ['10minutemail.com', 'temp-mail.org', 'guerrillamail.com'];
        if (in_array(strtolower($emailDomain), $suspiciousDomains)) {
            $score += 0.5;
            $reasons[] = "Email from suspicious domain: {$emailDomain}";
        }

        $this->spam_score = min($score, 1.0);
        $this->is_spam = $score >= 0.6; // Threshold for marking as spam
        $this->spam_reasons = $reasons;
        $this->spam_checked_at = now();

        $this->save();
    }

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($message) {
            // Automatically check for spam when creating
            $message->ip_address = request()->ip();
            $message->user_agent = request()->userAgent();
            $message->checkForSpam();
        });
    }
}

