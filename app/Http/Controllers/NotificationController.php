<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use App\Http\Resources\PaginatorResource;
use App\Http\Resources\NotificationResource;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function __construct(private NotificationService $notificationService)
    {}

    public function index()
    {
        $this->authorize('email_verified');

        return response()->success(new PaginatorResource(
            NotificationResource::class,
            $this->notificationService->index(),
        ));
    }

    public function read(DatabaseNotification $notification)
    {
        $this->notificationService->read($notification);

        return response()->stored();
    }

    public function readAll()
    {
        $this->notificationService->readAll();

        return response()->stored();
    }
}