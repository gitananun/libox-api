<?php

return [
    'user_created' => [
        'subject' => 'Welcome',
        'greeting' => 'Welcome to Libox!',
        'action' => "Go to library",
        'introduction' => 'We are happy to see you in our library.',
        'gratitude' => 'Thank you for choosing us dear :name.',
    ],
    'user_deleted' => [
        'title' => 'You just deleted your account',
        'subject' => 'Account Deleted',
        'greeting' => 'You just deleted your account from our library. Please participate to survey. Your feedback is very important to us.',
        'action' => "Go to Survey",
        'introduction' => 'We are happy to help you anytime to get your desired education.',
        'gratitude' => 'Thank you for choosing us dear :name',
    ],
    'reported' => [
        'subject' => 'Request Reported',
        'greeting' => 'You just request a report. Please see the file under attachements.',
        'gratitude' => 'Thank you for choosing us dear :name',
    ],
    'course_created' => [
        'title' => 'You\'ve created :name course',
        'subject' => 'New Course by you',
        'greeting' => 'Welcome to Libox!',
        'action' => 'Go to library',
        'introduction' => 'You have just promoted a :name to our library! We will review and right back to you!',
        'gratitude' => 'Thank you for choosing us dear :name.',
    ],
    'course_submitted' => [
        'title' => 'New library request',
        'subject' => 'New Course Request by :name',
        'greeting' => 'Welcome to Libox Management!',
        'action' => 'Go to library',
        'introduction' => 'Just library got a request of :name course! We must review as fast as we can and right to :email back!',
        'gratitude' => 'Thank you for choosing our management system dear :name.',
    ],
];