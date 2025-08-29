<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Dispatches notifications to multiple recipients concurrently using threads and Telegram API.
 * @desc <Greek> Αποστέλλει ειδοποιήσεις σε πολλαπλούς παραλήπτες ταυτόχρονα μέσω νήματος και Telegram API.
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);

use ASCOOS\OS\Kernel\{
    Threads\TThreadHandler,
    API\TTelegramAPIHandler,
    Observers\TObserverHandler,
    Interfaces\Observer
};
global $AOS_LOGS_PATH;

class SystemObserver implements Observer {
    public function update($subject, $data = null): void {
        error_log("System event observed: " . json_encode($data));
    }
}

// <English> Define configuration for logging and Telegram
// <Greek> Ορισμός ρυθμίσεων για καταγραφή και Telegram
$properties = [
    'logs' => [
        'useLogger' => true,
        'dir' => $AOS_LOGS_PATH . '/',
        'file' => 'notification_dispatcher.log'
    ],
    'telegram' => [
        'bot_token' => 'your_bot_token'
    ]
];

// <English> Define recipients and message
// <Greek> Ορισμός παραληπτών και μηνύματος
$recipients = [
    '123456789', // Chat ID 1
    '987654321', // Chat ID 2
    '112233445'  // Chat ID 3
];
$message = "🚨 Alert: System threshold exceeded at " . date('Y-m-d H:i:s');

// <English> Create observer to track dispatch status
// <Greek> Δημιουργία παρατηρητή για παρακολούθηση κατάστασης αποστολής
$observerHandler =  TObserverHandler::getInstance([$properties['logs']]);

// Προσθήκη παρατηρητή
$observerHandler->attach(new SystemObserver(), 10);

// <English> Create thread handler
// <Greek> Δημιουργία χειριστή νήματος
$threadHandler = new TThreadHandler($properties);

// <English> Define threaded job for each recipient
// <Greek> Ορισμός και ταυτόχρονη εκτέλεση εργασίας νήματος για κάθε παραλήπτη
foreach ($recipients as $chat_id) {
    $threadHandler->startThread('task_chat_id_'.$chat_id, function () use ($chat_id, $message, $properties, $observerHandler) {
        $telegram = new TTelegramAPIHandler(
            url: 'https://api.telegram.org',
            type: 0,
            options: ['bot_token' => $properties['telegram']['bot_token']],
            method: 'POST',
            properties: [],
            cacheHandler: null
        );

        $data = [
            'chat_id' => $chat_id,
            'text' => $message
        ];

        try {
            $response = $telegram->sendMessage($data);
            if (isset($response['ok']) && $response['ok']) {
                $observerHandler->triggerEvent('telegram.sent', ['chat_id' => $chat_id]);
            } else {
                $observerHandler->triggerEvent('telegram.failed', ['chat_id' => $chat_id]);
            }
        } catch (Exception $e) {
            $observerHandler->triggerEvent('telegram.failed', ['chat_id' => $chat_id, 'error' => $e->getMessage()]);
        }

        $telegram->Free($telegram);
    });
}

// <English> Monitors active threads and clears completed ones.
// <Greek> Παρακολουθεί ενεργά νήματα και καθαρίζει τα ολοκληρωμένα.
$threadHandler->monitorThreads();

// <English> Free resources
// <Greek> Απελευθέρωση πόρων
$threadHandler->Free($threadHandler);
$observerHandler->Free($observerHandler);
