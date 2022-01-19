<?php

namespace App\Notifications\Course;

use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use App\Notifications\AbstractDatabaseNotification;

class CourseSubmitted extends AbstractDatabaseNotification
{
    use Queueable;

    public function __construct(private Course $course)
    {}

    public function getTitle(): string
    {
        return __('mail.course_submitted.title', ['name' => $this->course->title]);
    }

    public function via(): array
    {
        return ['mail', 'database'];
    }

    /**
     * @param \App\Models\User $notifiable
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('mail.course_submitted.subject', ['name' => $notifiable->name]))
            ->greeting(__('mail.course_submitted.greeting'))
            ->line(__('mail.course_submitted.introduction', ['name' => $this->course->title, 'email' => $notifiable->email]))
            ->action(__('mail.course_submitted.action'), url('/'))
            ->line(__('mail.course_submitted.gratitude', ['name' => $notifiable->name]))
            ->salutation(__('quotes')[array_rand(__('quotes'))]);
    }

    /**
     * @param \App\Models\User $notifiable
     */
    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->getTitle(),
            'course' => [
                "title" => $this->course->title,
            ],
        ];
    }
}