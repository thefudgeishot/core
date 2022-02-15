<?php

use Gibbon\Services\Format;
use Gibbon\Domain\System\NotificationGateway;

// Send notification once called with | php /modules/Timetable Admin/tt_update_notifier.php
            $dataDetail = array('gibbonSchoolYearID' => $session->get('gibbonSchoolYearID'), 'gibbonPersonID' => $gibbonPersonID);
            $sqlDetail = 'SELECT gibbonYearGroupID FROM gibbonFormGroup JOIN gibbonStudentEnrolment ON (gibbonStudentEnrolment.gibbonFormGroupID=gibbonFormGroup.gibbonFormGroupID) JOIN gibbonPerson ON (gibbonStudentEnrolment.gibbonPersonID=gibbonPerson.gibbonPersonID) WHERE gibbonStudentEnrolment.gibbonSchoolYearID=:gibbonSchoolYearID AND gibbonStudentEnrolment.gibbonPersonID=:gibbonPersonID';
            $resultDetail = $connection2->prepare($sqlDetail);
            $resultDetail->execute($dataDetail);
        if ($resultDetail->rowCount() == 1) {
            $rowDetail = $resultDetail->fetch();

            // Initialize the notification sender & gateway objects
            $notificationGateway = new NotificationGateway($pdo);
            $notificationSender = new NotificationSender($notificationGateway, $gibbon->session);

            // Raise a new notification event
            $event = new NotificationEvent('Timetable', 'Updated Timetable Subscriber');

            $staffName = Format::name('', $session->get('preferredName'), $session->get('surname'), 'Staff', false, true);
            $studentName = Format::name('', $row2['preferredName'], $row2['surname'], 'Student', false);
            $actionLink = "/index.php?q=/modules/Timetable/tt_manage_subscription.php";

            $notificationText = sprintf(__('The timetable has been updated, to update your downloaded calendar please 'Format::link($actionLink, 'download')' it here again.').'<br/><br/>';

            $event->setNotificationText($notificationText);
            $event->setActionLink($actionLink);

            $event->addScope('gibbonPersonIDStudent', $gibbonPersonID);
            $event->addScope('gibbonYearGroupID', $rowDetail['gibbonYearGroupID']);

            // Add event listeners to the notification sender
            $event->pushNotifications($notificationGateway, $notificationSender);

            // Send all notifications
            $notificationSender->sendNotifications();
        }

 ?>
