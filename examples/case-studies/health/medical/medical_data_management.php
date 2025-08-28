<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 *
 * @desc <English> Medical Data Management and Notifications
 *       <Greek> Διαχείριση Ιατρικών Δεδομένων και Ειδοποιήσεων
 * @since PHP 8.2.0
 */
declare(strict_types=1);

use ASCOOS\OS\{
    Kernel\Images\TImagesHandler,
    Kernel\Dates\TDatesHandler,
    Extras\Validation\X\TXValidationHandler,
    Kernel\Files\TFilesHandler,
    Kernel\Arrays\Events\TEventHandler
};

global $AOS_LOGS_PATH, $AOS_TMP_DATA_PATH;

/**
 * <English> Initialize ASCOOS classes for medical data management.
 * <Greek> Αρχικοποίηση κλάσεων ASCOOS για διαχείριση ιατρικών δεδομένων.
 */
$properties = [
    'file' => [
        'dataDir' => $AOS_TMP_DATA_PATH . '/medical',
        'quotaSize' => 2000000 // 2MB quota
    ],
    'logs' => [
        'useLogger' => true,
        'dir' => $AOS_LOGS_PATH . '/',
        'file' => 'medical_processing.log'
    ]
];

$imagesHandler = new TImagesHandler($properties);
$datesHandler = new TDatesHandler('Europe/Athens', $properties);
$validator = new TXValidationHandler($properties);
$filesHandler = new TFilesHandler([], $properties['file']);
$eventHandler = new TEventHandler([], $properties);

// <English> Register events for validation and image processing.
// <Greek> Καταχώριση γεγονότων για επικύρωση και επεξεργασία εικόνων.
$eventHandler->register('medical', 'validation.success', fn($data) => error_log("Medical data validated: " . json_encode($data)));
$eventHandler->register('medical', 'validation.failed', fn($data, $errors) => error_log("Validation failed: " . json_encode($errors)));
$eventHandler->register('medical', 'image.processed', fn($path) => error_log("Medical image processed: $path"));
$validator->setEventHandler($eventHandler);

// <English> Sample patient data with appointment and image.
// <Greek> Δείγμα δεδομένων ασθενών με ραντεβού και εικόνα.
$patientData = [
    'patient_id' => 'P12345',
    'name' => 'John Doe',
    'appointment_date' => '2025-08-15',
    'xray_image' => $AOS_TMP_DATA_PATH . '/xray_input.jpg'
];

// <English> Define validation rules for patient data.
// <Greek> Ορισμός κανόνων επικύρωσης για δεδομένα ασθενών.
$rules = [
    'patient_id' => 'required|string|min:5|max:10',
    'name' => 'required|string|max:100',
    'appointment_date' => 'required|date',
    'xray_image' => 'required|string|file_exists'
];

// <English> Validate patient data and schedule follow-up.
// <Greek> Επικύρωση δεδομένων ασθενών και προγραμματισμός παρακολούθησης.
if ($validator->validate($patientData, $rules)) {
    $patientData['follow_up_date'] = $datesHandler->addDays($patientData['appointment_date'], 7, 'Y-m-d');
    $eventHandler->trigger('medical', 'validation.success', $patientData);
} else {
    $eventHandler->trigger('medical', 'validation.failed', $patientData, $validator->getErrors());
    exit("Validation failed for patient data.");
}

// <English> Process medical image (resize and add watermark).
// <Greek> Επεξεργασία ιατρικής εικόνας (αλλαγή μεγέθους και προσθήκη υδατογραφήματος).
$imagePath = $patientData['xray_image'];
$watermarkPath = $AOS_TMP_DATA_PATH . '/watermark.png';
$outputImagePath = $AOS_TMP_DATA_PATH . "/xray_processed_" . date('Ymd_His') . ".jpg";

$imageData = $imagesHandler->loadFromFile($imagePath);
$watermarkData = $imagesHandler->loadFromFile($watermarkPath);
$processedImage = $imagesHandler->resize($imageData, 800, 600);
$processedImage = $imagesHandler->addWatermark($processedImage, $watermarkData, 10, 10, 0.5);
$imagesHandler->saveToFile($processedImage, $outputImagePath);
$eventHandler->trigger('medical', 'image.processed', $outputImagePath);

// <English> Save patient data and image info to encrypted file.
// <Greek> Αποθήκευση δεδομένων ασθενών και πληροφοριών εικόνας σε κρυπτογραφημένο αρχείο.
$medicalRecord = [
    'patient_id' => $patientData['patient_id'],
    'name' => $patientData['name'],
    'appointment_date' => $patientData['appointment_date'],
    'follow_up_date' => $patientData['follow_up_date'],
    'processed_image' => $outputImagePath,
    'processed_at' => $datesHandler->getCurrentDate('Y-m-d H:i:s')
];

$recordFolder = $properties['file']['dataDir'];
$rawFile = "$recordFolder/medical_record_" . date('Ymd_His') . ".json";
$encryptedFile = "$recordFolder/medical_record_" . date('Ymd_His') . ".enc";

$filesHandler->createFolder($recordFolder);
if (!$filesHandler->isQuotaExceeded($recordFolder)) {
    $filesHandler->writeToFileWithCheck(json_encode($medicalRecord, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), $rawFile);
    $filesHandler->encryptFile($rawFile, $encryptedFile, 'supersecretkey123');
} else {
    error_log("Quota exceeded for medical data storage.");
}

// <English> Log processing completion.
// <Greek> Καταγραφή ολοκλήρωσης επεξεργασίας.
$filesHandler->logger?->log("Medical record processed and encrypted: $encryptedFile", $filesHandler::DEBUG_LEVEL_INFO);

// <English> Free resources.
// <Greek> Απελευθέρωση πόρων.
$imagesHandler->Free($imagesHandler);
$datesHandler->Free($datesHandler);
$validator->Free($validator);
$filesHandler->Free($filesHandler);
$eventHandler->Free($eventHandler);
?>