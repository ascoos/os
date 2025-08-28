<?php
declare(strict_types=1);

/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 *
 * @desc <English> Smart Appointment Scheduler
 * @desc <Greek> Έξυπνος Προγραμματισμός Ραντεβού
 *
 * @since PHP 8.2.0
 */

use ASCOOS\OS\Kernel\Dates\TDatesHandler;
use ASCOOS\OS\Extras\Validation\X\TXValidationHandler;
use ASCOOS\OS\Kernel\Arrays\Events\TEventHandler;

global $AOS_LOGS_PATH;

$properties = [
    'logs' => [
        'useLogger' => true,
        'dir' => $AOS_LOGS_PATH . '/',
        'file' => 'appointments.log'
    ]
];

$datesHandler = new TDatesHandler('Europe/Athens', $properties);
$validator = new TXValidationHandler();
$eventHandler = new TEventHandler([], $properties);
$validator->setEventHandler($eventHandler);

// Καταχώριση γεγονότων
$eventHandler->register('appointments', 'conflict', fn($data) => error_log("Conflict detected: " . json_encode($data)));
$eventHandler->register('appointments', 'scheduled', fn($data) => error_log("Appointment scheduled: " . json_encode($data)));

// Δείγμα αιτήματος ραντεβού
$request = [
    'patient_id' => 'P1001',
    'name' => 'Maria Papadopoulou',
    'requested_date' => '2025-09-01',
    'requested_time' => '10:00'
];

// Κανόνες επικύρωσης
$rules = [
    'patient_id' => 'required|string|min:5|max:10',
    'name' => 'required|string|max:100',
    'requested_date' => 'required|date',
    'requested_time' => 'required|string|regex:/^\d{2}:\d{2}$/'
];

if (!$validator->validate($request, $rules)) {
    $eventHandler->trigger('appointments', 'conflict', ['errors' => $validator->getErrors()]);
    exit("Validation failed.");
}

// Υποθετική διαθεσιμότητα
$existingAppointments = [
    '2025-09-01 10:00',
    '2025-09-01 11:00'
];

$requestedSlot = $request['requested_date'] . ' ' . $request['requested_time'];

if (in_array($requestedSlot, $existingAppointments)) {
    $eventHandler->trigger('appointments', 'conflict', ['slot' => $requestedSlot]);
    exit("Time slot unavailable.");
}

$request['confirmed'] = true;
$request['scheduled_at'] = $datesHandler->getCurrentDate('Y-m-d H:i:s');
$eventHandler->trigger('appointments', 'scheduled', $request);

echo json_encode($request, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

// Απελευθέρωση πόρων
$datesHandler->Free($datesHandler);
$validator->Free($validator);
$eventHandler->Free($eventHandler);
