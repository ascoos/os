# Smart Appointment Scheduler

This case study demonstrates how **Ascoos OS** can be used to validate and schedule appointments with intelligent conflict detection. The example validates the request data, checks time slot availability, and logs the result as an event.

## Purpose
This example uses the following Ascoos OS classes:
- **TDatesHandler**: Manages date and time operations.
- **TXValidationHandler**: Validates appointment request using rules.
- **TEventHandler**: Logs events (conflict or confirmation).

## Structure
The case study is implemented in a single PHP file:
- [`appointment_scheduler.php`](./appointment_scheduler.php): Includes validation, availability check, and event logging.

## Prerequisites
1. Install Ascoos OS ([main repository](https://github.com/ascoos/os)). If you're using [`Ascoos Web Extended Studio 26`](https://awes.ascoos.com), it's already preinstalled.
2. Write permissions for the `$AOS_LOGS_PATH` directory.
3. Global variables (`$conf`, `$AOS_TMP_DATA_PATH`, `$AOS_LOGS_PATH`) are automatically set by Ascoos OS.
4. The [phpBCL8](https://github.com/ascoos/phpbcl8) library is preinstalled and auto-loaded.

## Getting Started
1. Run the script via a web server:
   ```
   https://localhost/aos/examples/case-studies/health/appointments/appointment_scheduler.php
   ```

## Example Usage
```php
// Validation rules
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

// Availability check
$requestedSlot = $request['requested_date'] . ' ' . $request['requested_time'];
if (in_array($requestedSlot, $existingAppointments)) {
    $eventHandler->trigger('appointments', 'conflict', ['slot' => $requestedSlot]);
    exit("Time slot unavailable.");
}
```

## Expected Output
The script returns a JSON object with the confirmed appointment details. Example output:
```json
{
    "patient_id": "P1001",
    "name": "Maria Papadopoulou",
    "requested_date": "2025-09-01",
    "requested_time": "10:00",
    "confirmed": true,
    "scheduled_at": "2025-08-28 22:22:00"
}
```

## Resources
- [Ascoos OS Documentation](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [AWES](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Contributing
Want to contribute to this case study? Fork the repository, modify or extend `appointment_scheduler.php`, and submit a pull request. See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
This case study is licensed under the Ascoos General License (AGL). See [LICENSE](/LICENSE.md).
