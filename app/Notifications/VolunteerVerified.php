<?php

namespace App\Notifications;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class VolunteerVerified extends Notification
{
    use Queueable;

    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Volunteer Registration Confirmed')
            ->line('Your volunteer registration for the event "' . $this->event->title . '" has been confirmed.')
            ->line('Event Date: ' . $this->event->start_date->format('F j, Y, g:i A'))
            ->line('Location: ' . $this->event->location)
            ->action('View Event', route('people.volunteer.opportunities'))
            ->line('Thank you for volunteering!');
    }

    public function toArray($notifiable)
    {
        return [
            'event_id' => $this->event->id,
            'event_title' => $this->event->title,
            'message' => 'Your volunteer registration for "' . $this->event->title . '" has been confirmed.',
        ];
    }
}
