# Website Linguistic Analysis

This case study demonstrates how **Ascoos OS** analyzes website content linguistically, detects the language, and monitors system load during processing. The example fetches content from a website (e.g., https://example.com), identifies its language, performs NLP analysis, and generates a report while tracking CPU usage.

## Purpose
This example showcases the integration of multiple Ascoos OS components:
- **TWebsiteHandler**: Retrieves and cleans website HTML content.
- **TLanguageHandler**: Detects the language of the text using preconfigured alphabet and wordlist files.
- **TLinguisticAnalysisHandler**: Performs linguistic analysis based on the detected language.
- **TCoreSystemHandler**: Monitors system load and logs high CPU usage.
- **TFilesHandler**: Manages file operations, such as saving the analysis report.

## Structure
The case study is implemented in a single PHP file:
- [`website_linguistic_analysis.php`](./website_linguistic_analysis.php): Demonstrates the workflow of fetching content, language detection, linguistic analysis, and system monitoring.

## Prerequisites
1. Ensure Ascoos OS is installed (see the [main repository](https://github.com/ascoos/os)). If using the [`ASCOOS Web Extended Studio (AWES) 26`](https://awes.ascoos.com), Ascoos OS is preloaded.
2. A configured NLP database (e.g., MySQL) for `TLinguisticAnalysisHandler`. The database configuration is automatically set via the global `$conf['db']['mysqli']` array during Ascoos OS initialization.
3. Write permissions for the directories defined in `$AOS_LOGS_PATH` (logs) and `$AOS_TMP_DATA_PATH/reports/nlp/` (output files). These paths are automatically configured by Ascoos OS.
4. The configuration files `alphabets.json` and `wordlist.json` must be available at `$AOS_CONFIG_PATH/`.
5. The font file `Murecho-Regular.ttf` is preinstalled with Ascoos OS at `$AOS_FONTS_PATH/Murecho/Murecho-Regular.ttf`. Additional fonts can be added dynamically via the `LibIn` program using an Ajax form.
6. The global variables (`$conf`, `$AOS_LOGS_PATH`, `$AOS_TMP_DATA_PATH`, `$AOS_CONFIG_PATH`) are automatically set by Ascoos OS during initialization.
7. The [phpBCL8](https://github.com/ascoos/phpbcl8) library is preinstalled and loaded automatically by Ascoos OS without requiring Composer.

## Getting Started
1. Ensure the global variables (`$conf`, `$AOS_LOGS_PATH`, `$AOS_TMP_DATA_PATH`, `$AOS_CONFIG_PATH`) are available, as they are set by Ascoos OS during initialization.
2. Modify the `$url` variable in the script to target your desired website (default is `https://example.com`).
3. Execute the script via a web server, e.g., `https://localhost/aos/examples/case-studies/websites/linguistic_analysis/website_linguistic_analysis.php`.

## Example Usage
```php
use ASCOOS\OS\Kernel\{
    Systems\TCoreSystemHandler,
    Websites\TWebsiteHandler,
    Languages\TLanguageHandler,
    AI\TLinguisticAnalysisHandler,
    Files\TFilesHandler
};

global $conf, $AOS_LOGS_PATH, $AOS_TMP_DATA_PATH, $AOS_CONFIG_PATH;

// Initialize configuration
$properties = [
    'logs' => [
        'useLogger' => $conf['logs']['useLogger'] ?? true,
        'dir' => $conf['logs']['dir'] ?? $AOS_LOGS_PATH,
        'file' => 'sports_analysis.log'
    ],
    'file' => [
        'baseDir' => $AOS_TMP_DATA_PATH . 'reports/nlp/',
        'quotaSize' => 1000000000
    ],
    'nlp' => [
        'host' => $conf['db']['mysqli']['host'] ?? 'localhost',
        'user' => $conf['db']['mysqli']['user'] ?? 'root',
        'password' => $conf['db']['mysqli']['pass'] ?? 'root',
        'dbname' => $conf['db']['mysqli']['dbname'] ?? 'linguistics'
    ]
];

// Initialize ASCOOS classes
$system = new TCoreSystemHandler(['cpu_percent_warn' => 80]);
$website = new TWebsiteHandler();
$language = new TLanguageHandler([], [
    'alphabetsPath' => $AOS_CONFIG_PATH . '/alphabets.json',
    'wordListPath' => $AOS_CONFIG_PATH . '/wordlist.json'
]);
$nlp = new TLinguisticAnalysisHandler([], $properties['nlp']);
```

## Expected Output
The script generates a JSON report (`report.json`) with details about the website, detected language, CPU load, and linguistic analysis. Example output:
```json
{
    "url": "https://example.com",
    "language": "en",
    "cpu_load": 45.3,
    "analysis": {
        "sentiment": "neutral",
        "keywords": ["example", "test"]
    }
}
```

## Resources
- [Ascoos OS Documentation](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [Ascoos OS on LinkedIn](https://www.linkedin.com/in/ascoos)
- [Ascoos OS on X](https://www.x.com/ascoos)
- [Ascoos Web Extended Studio](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)

## Contributing
Want to contribute to this case study? Fork the repository, modify or add new features to `website_linguistic_analysis.php`, and submit a pull request. See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
This case study is licensed under the Ascoos General License (AGL). See [LICENSE](/LICENSE.md).
