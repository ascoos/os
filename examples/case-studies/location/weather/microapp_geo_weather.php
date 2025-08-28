<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Microapplication for Geolocation and Weather Data
 * @desc <Greek> Μικροεφαρμογή για Γεωγραφικά και Μετεωρολογικά Δεδομένα
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);

use ASCOOS\OS\{
    Kernel\API\TGoogleMapsHandler,
    Kernel\API\TOpenWeatherMapHandler,
    Kernel\Files\TFilesHandler,
    Kernel\Arrays\Events\TEventHandler,
    Kernel\Dates\TDatesHandler,
    Extras\Validation\X\TXValidationHandler
};

global $conf, $AOS_LOGS_PATH, $AOS_TMP_DATA_PATH;

/**
 * <English> Initialize ASCOOS classes for geolocation and weather data processing.
 * <Greek> Αρχικοποίηση κλάσεων ASCOOS για επεξεργασία γεωγραφικών και μετεωρολογικών δεδομένων.
 */
$properties = [
    'file' => [
        'dataDir' => $AOS_TMP_DATA_PATH . '/microapp_data',
        'quotaSize' => 1000000 // 1MB quota
    ],
    'google_maps' => [
        'url' => 'https://maps.googleapis.com/maps/api',
        'api_key' => 'your_google_maps_api_key',
        'options' => [
            'CURLOPT_RETURNTRANSFER' => true,
            'CURLOPT_HTTPHEADER' => ['Accept: application/json']
        ]
    ],
    'open_weather' => [
        'url' => 'http://api.openweathermap.org/data/2.5',
        'api_key' => 'your_openweathermap_api_key',
        'options' => [
            'CURLOPT_RETURNTRANSFER' => true,
            'CURLOPT_HTTPHEADER' => ['Accept: application/json']
        ]
    ],
    'logs' => [
        'useLogger' => $conf['logs']['useLogger'] ?? true,
        'dir' => $conf['logs']['dir'] ?? $AOS_LOGS_PATH . '/',
        'file' => 'microapp.log'
    ]    
];

$googleMapsHandler = new TGoogleMapsHandler($properties['google_maps']['url'], 0, $properties['google_maps']['options'], 'GET', $properties);
$weatherHandler = new TOpenWeatherMapHandler($properties['open_weather']['url'], 0, $properties['open_weather']['options'], 'GET', $properties);
$validator = new TXValidationHandler($properties);
$filesHandler = new TFilesHandler([], $properties['file']);
$eventHandler = new TEventHandler([], $properties);
$datesHandler = new TDatesHandler('Europe/Athens', $properties);

// <English> Register events for validation and data storage.
// <Greek> Καταχώριση γεγονότων για επικύρωση και αποθήκευση δεδομένων.
$eventHandler->register('microapp', 'validation.success', fn($data) => error_log("Data validated: " . json_encode($data)));
$eventHandler->register('microapp', 'validation.failed', fn($data, $errors) => error_log("Validation failed: " . json_encode($errors)));
$eventHandler->register('microapp', 'data.stored', fn($path) => error_log("Data stored: $path"));
$validator->setEventHandler($eventHandler);

// <English> Define validation rules for geolocation and weather data.
// <Greek> Ορισμός κανόνων επικύρωσης για γεωγραφικά και μετεωρολογικά δεδομένα.
$geoRules = [
    'lat' => 'required|numeric|min:-90|max:90',
    'lng' => 'required|numeric|min:-180|max:180',
    'formatted_address' => 'required|string|max:255'
];
$weatherRules = [
    'temp' => 'required|numeric|min:-50|max:50',
    'weather' => 'required|string|max:100',
    'timestamp' => 'required|date'
];

// <English> Fetch geolocation data for a given address.
// <Greek> Λήψη γεωγραφικών δεδομένων για μια δεδομένη διεύθυνση.
$address = 'Athens, Greece';
$geoResponse = $googleMapsHandler->geocode(['address' => $address, 'key' => $properties['google_maps']['api_key']]);
$geoData = json_decode($geoResponse['data'], true)['results'][0]['geometry']['location'] ?? null;

if (!$geoData || !$validator->validate($geoData, $geoRules)) {
    $eventHandler->trigger('microapp', 'validation.failed', $geoData, $validator->getErrors());
    exit("Geolocation data validation failed.");
}
$eventHandler->trigger('microapp', 'validation.success', $geoData);

// <English> Fetch weather data for the geolocation.
// <Greek> Λήψη μετεωρολογικών δεδομένων για τη γεωγραφική τοποθεσία.
$weatherResponse = $weatherHandler->getWeather([
    'lat' => $geoData['lat'],
    'lon' => $geoData['lng'],
    'appid' => $properties['open_weather']['api_key']
]);
$weatherData = [
    'temp' => $weatherResponse['data']['main']['temp'] ?? null,
    'weather' => $weatherResponse['data']['weather'][0]['description'] ?? null,
    'timestamp' => date('Y-m-d H:i:s', $weatherResponse['data']['dt'] ?? time())
];

if (!$validator->validate($weatherData, $weatherRules)) {
    $eventHandler->trigger('microapp', 'validation.failed', $weatherData, $validator->getErrors());
    exit("Weather data validation failed.");
}
$eventHandler->trigger('microapp', 'validation.success', $weatherData);

// <English> Combine and store data with encryption.
// <Greek> Συνδυασμός και αποθήκευση δεδομένων με κρυπτογράφηση.
$combinedData = [
    'location' => [
        'address' => $address,
        'coordinates' => $geoData
    ],
    'weather' => $weatherData,
    'processed_at' => $datesHandler->getCurrentDate('Y-m-d H:i:s')
];

$dataFolder = $properties['file']['dataDir'];
$rawFile = "$dataFolder/microapp_data_" . date('Ymd_His') . ".json";
$encryptedFile = "$dataFolder/microapp_data_" . date('Ymd_His') . ".enc";

$filesHandler->createFolder($dataFolder);
if (!$filesHandler->isQuotaExceeded($dataFolder)) {
    $filesHandler->writeToFileWithCheck(json_encode($combinedData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), $rawFile);
    $filesHandler->encryptFile($rawFile, $encryptedFile, $fileHandler->getDeepProperty(['security','keys','files_secret_key'], $conf) ?? "Hi! I'm Ascoos OS");
    $eventHandler->trigger('microapp', 'data.stored', $encryptedFile);
} else {
    error_log("Quota exceeded for microapp data storage.");
}

// <English> Log processing completion.
// <Greek> Καταγραφή ολοκλήρωσης επεξεργασίας.
$filesHandler->logger?->log("Microapp data processed and encrypted: $encryptedFile", $filesHandler::DEBUG_LEVEL_INFO);

// <English> Free resources.
// <Greek> Απελευθέρωση πόρων.
$googleMapsHandler->Free($googleMapsHandler);
$weatherHandler->Free($weatherHandler);
$validator->Free($validator);
$filesHandler->Free($filesHandler);
$eventHandler->Free($eventHandler);
$datesHandler->Free($datesHandler);
?>