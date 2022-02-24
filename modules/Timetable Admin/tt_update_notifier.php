<?php

use Gibbon\Domain\System\SettingGateway;
use Gibbon\Services\Format;
use Gibbon\Comms\NotificationEvent;
use Gibbon\Comms\NotificationSender;
use Gibbon\Forms\CustomFieldHandler;
use Gibbon\Domain\System\NotificationGateway;
use Gibbon\Domain\Students\StudentNoteGateway;
use Gibbon\Domain\IndividualNeeds\INAssistantGateway;
use Gibbon\Data\Validator;

$URL = $session->get('absoluteURL').'/index.php?q=/modules/Timetable Admin/tt.php';

$notificationGateway = new NotificationGateway($pdo);
$notificationSender = new NotificationSender($notificationGateway, $gibbon->session);

// Raise a new notification event
$event = new NotificationEvent('Timetable', 'Updated Timetable Subscriber');

            $actionLink = "/index.php?q=/modules/Timetable/tt_manage_subscription.php";

            $notificationText = sprintf(('The timetable has been updated, to update your timetable click the action header').'<br/><br/>');

// Add event listeners to the notification sender
$event->pushNotifications($notificationGateway, $notificationSender);

            // Add event listeners to the notification sender
            $event->pushNotifications($notificationGateway, $notificationSender);
// Send all notifications
$notificationSender->sendNotifications();

$URL .= "&return=success0"; //TODO: IF THE NOTIFICATION ERRORS, WE MIGHT NOT WANT TO THROW A SUCCESS MESSAGE
header("Location: {$URL}");
?>

 ?>
