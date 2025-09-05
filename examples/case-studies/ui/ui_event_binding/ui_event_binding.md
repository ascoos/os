# UI Event Binding with TEventHandler

This case study demonstrates how **Ascoos OS** can bind client-side UI events to server-side logic using the `TEventHandler` class. It enables modular event registration, logging, and execution — ideal for integrating with BootLib UI components, Ajax flows, or DSL macros.

## Purpose
This example uses the following Ascoos OS class:
- **TEventHandler**: Registers and triggers events, logs activity, and executes logic via callbacks or functions.

## Structure
The case study is implemented in a single PHP file:
- [`ui_event_binding.php`](./ui_event_binding.php): Includes event registration, triggering, logging, and callback execution.

## Prerequisites
1. Install Ascoos OS ([main repository](https://github.com/ascoos/os)).
2. Ensure write permissions for `$AOS_LOGS_PATH/tmp/logs/`.

## Getting Started
1. Run the script via web server:
   ```
   https://localhost/aos/examples/case-studies/ui/ui_event_binding/ui_event_binding.php
   ```

2. Trigger the event using JavaScript:
   ```javascript
   fetch('/aos/examples/case-studies/ui/ui_event_binding/ui_event_binding.php', {
     method: 'POST',
     body: JSON.stringify({ event: 'ui.onClick', elementId: 'submitButton' }),
     headers: { 'Content-Type': 'application/json' }
   });
   ```

3. Or use jQuery for form submission:
   ```html
   <button id="submitButton">Submit</button>
   <script>
     $('#submitButton').on('click', function() {
       $.ajax({
         url: 'server.php',
         type: 'POST',
         data: {
           target: 'ui',
           eventType: 'onClick',
           elementId: 'submitButton',
           formData: { name: 'User', email: 'user@example.com' }
         },
         success: function(response) {
           console.log(response);
         }
       });
     });
   </script>
   ```

## Example Usage
```php
$eventHandler->register('ui', 'onClick', fn($params) => processForm($params));
$eventHandler->trigger('ui', 'onClick', $data);
```

## Expected Output
The script logs the event and returns:
```plaintext
Received data: Name = User, Email = user@example.com
```

## Resources
- [Ascoos OS Documentation](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [BootLib UI Framework](https://github.com/ascoos/bootlib)
- [AWES](https://awes.ascoos.com)
- [phpBCL8](https://github.com/ascoos/phpbcl8)

## Contributing
Want to contribute to this case study? Fork the repository, modify or extend `ui_event_binding.php`, and submit a pull request. See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
This case study is licensed under the Ascoos General License (AGL). See [LICENSE](/LICENSE.md).
