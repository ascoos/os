<?php
/**
 * @ASCOOS-NAME        : Ascoos OS
 * @ASCOOS-VERSION     : 26.0.0
 * @ASCOOS-SUPPORT     : support@ascoos.com
 * @ASCOOS-BUGS        : https://issues.ascoos.com
 * 
 * @desc <English> Dynamically distributes tasks across threads based on current CPU and memory load.
 * @desc <Greek> Κατανέμει δυναμικά εργασίες σε νήματα με βάση τον τρέχοντα φόρτο CPU και μνήμης.
 * 
 * @since PHP 8.2.0
 */
declare(strict_types=1);

use ASCOOS\OS\Kernel\Threads\TThreadHandler;
use ASCOOS\OS\Kernel\Systems\TCoreSystemHandler;

global $AOS_LOGS_PATH;

// <English> Define configuration for logging and thresholds
// <Greek> Ορισμός ρυθμίσεων για καταγραφή και όρια φόρτου
$properties = [
    'logs' => [
        'useLogger' => true,
        'dir' => $AOS_LOGS_PATH . '/',
        'file' => 'thread_balancer.log'
    ],
    'thresholds' => [
        'cpu_max' => 80,     // Max CPU load before skipping thread
        'memory_max' => 85   // Max memory usage before skipping thread
    ]
];

// <English> Initialize system and thread handlers
// <Greek> Αρχικοποίηση χειριστών συστήματος και νημάτων
$systemHandler = new TCoreSystemHandler($properties);
$threadHandler = new TThreadHandler($properties);

// <English> Define a pool of tasks
// <Greek> Ορισμός λίστας εργασιών
$tasks = [
    fn() => sleep(1),
    fn() => file_put_contents('/tmp/task1.txt', 'Task 1 completed'),
    fn() => file_put_contents('/tmp/task2.txt', 'Task 2 completed'),
    fn() => sleep(2),
    fn() => file_put_contents('/tmp/task3.txt', 'Task 3 completed')
];

// <English> Iterate through tasks and assign to threads based on system load
// <Greek> Επανάληψη εργασιών και κατανομή σε νήματα βάσει φόρτου συστήματος
foreach ($tasks as $index => $task) {
    $cpuLoad = $systemHandler->get_cpu_load();
    $memoryStats = $systemHandler->get_memory_stats();
    $memoryLoad = $memoryStats['percent'];

    if ($cpuLoad < $properties['thresholds']['cpu_max'] && $memoryLoad < $properties['thresholds']['memory_max']) {
        $threadHandler->startThread("task_$index", $task);
        error_log("Thread task_$index started (CPU: $cpuLoad%, Memory: $memoryLoad%)");
    } else {
        error_log("Thread task_$index skipped due to high load (CPU: $cpuLoad%, Memory: $memoryLoad%)");
    }
}

// <English> Monitor and clean up threads
// <Greek> Παρακολούθηση και καθαρισμός νημάτων
$threadHandler->monitorThreads();

// <English> Free resources
// <Greek> Απελευθέρωση πόρων
$systemHandler->Free($systemHandler);
$threadHandler->Free($threadHandler);
