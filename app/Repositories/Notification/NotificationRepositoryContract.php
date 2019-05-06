<?php
namespace App\Repositories\Notification;
interface NotificationRepositoryContract
{
    
    public function find($id);
    public function getAllNotification();
    public function create($requestData);
    public function update($id, $requestData);

}
