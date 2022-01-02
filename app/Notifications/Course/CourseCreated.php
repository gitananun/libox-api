<?php

namespace App\Notifications\Course;

use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use App\Notifications\AbstractDatabaseNotification;

class CourseCreated extends AbstractDatabaseNotification
{
    use Queueable;

    public function __construct(private Course $course)
    {}

    public function getTitle(): string
    {
        return __('mail.course_created.title', ['name' => $this->course->title]);
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
            ->subject(__('mail.course_created.subject'))
            ->greeting(__('mail.course_created.greeting'))
            ->line(__('mail.course_created.introduction', ['name' => $this->course->title]))
            ->action(__('mail.course_created.action'), url('/'))
            ->line(__('mail.course_created.gratitude', ['name' => $notifiable->name]))
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