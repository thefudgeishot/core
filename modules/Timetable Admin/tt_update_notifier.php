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


// Send notification once called with | php /modules/Timetable Admin/tt_update_notifier.php
          //  $dataDetail = array('gibbonSchoolYearID' => $session->get('gibbonSchoolYearID'), 'gibbonPersonID' => $gibbonPersonID);
          //  $sqlDetail = 'SELECT gibbonYearGroupID FROM gibbonFormGroup JOIN gibbonStudentEnrolment ON (gibbonStudentEnrolment.gibbonFormGroupID=gibbonFormGroup.gibbonFormGroupID) JOIN gibbonPerson ON (gibbonStudentEnrolment.gibbonPersonID=gibbonPerson.gibbonPersonID) WHERE gibbonStudentEnrolment.gibbonSchoolYearID=:gibbonSchoolYearID AND gibbonStudentEnrolment.gibbonPersonID=:gibbonPersonID';
          //  $resultDetail = $connection2->prepare($sqlDetail);
          //  $resultDetail->execute($dataDetail);
        // if ($resultDetail->rowCount() == 1) {
          // $rowDetail = $resultDetail->fetch();

            // Initialize the notification sender & gateway objects
            $notificationGateway = new NotificationGateway($pdo);
            $notificationSender = new NotificationSender($notificationGateway, $gibbon->session);

            // Raise a new notification event
            $event = new NotificationEvent('Timetable', 'Updated Timetable Subscriber');

            $notificationText = sprintf(('The timetable has been updated, to update your downloaded calendar please <a href="/index.php?q=/modules/Timetable/tt_manage_subscription.php">download</a> it here again.').'<br/><br/>');

            $event->setNotificationText($notificationText);

            // Add event listeners to the notification sender
            $event->pushNotifications($notificationGateway, $notificationSender);

            // Send all notifications
            $notificationSender->sendNotifications();
 ?>
