# FC Barcelona Sentiment Analysis

This case study demonstrates how **Ascoos OS** analyzes sports-related social media data, performs sentiment analysis using NLP, and visualizes the results with graphs. The example retrieves tweets about FC Barcelona from the X platform, analyzes their sentiment, generates a bar chart, and saves the results to a JSON file.

## Purpose
This example showcases the integration of multiple Ascoos OS components:
- **TTwitterAPIHandler**: Fetches tweets from the X platform.
- **TLinguisticAnalysisHandler**: Performs sentiment analysis on tweet texts.
- **TArrayGraphHandler**: Generates a bar chart to visualize sentiment distribution.
- **TFilesHandler**: Manages file operations, such as saving the report.
- **TCoreSystemHandler**: Monitors system resources and logs high CPU usage.

## Structure
The case study is implemented in a single PHP file:
- [`fcbarcelona_sentiment_analysis.php`](./fcbarcelona_sentiment_analysis.php): Demonstrates the full workflow of fetching tweets, analyzing sentiment, generating a graph, and saving results.

## Prerequisites
1. Ensure Ascoos OS is installed (see the [main repository](https://github.com/ascoos/os)). If using the [`ASCOOS Web Extended Studio (AWES) 26`](https://awes.ascoos.com), Ascoos OS is preloaded.
2. A valid X API OAuth token is required for `TTwitterAPIHandler`.
3. A configured NLP database (e.g., MySQL) for `TLinguisticAnalysisHandler`. The database configuration is automatically set via the global `$conf['db']['mysqli']` array during Ascoos OS initialization.
4. Write permissions for the directories defined in `$AOS_LOGS_PATH` (logs) and `$AOS_TMP_DATA_PATH/sports/` (output files). These paths are automatically configured by Ascoos OS.
5. The font file `Murecho-Regular.ttf` is preinstalled with Ascoos OS at `$AOS_FONTS_PATH/Murecho/Murecho-Regular.ttf`. Additional fonts can be added dynamically via the `LibIn` program using an Ajax form.
6. The global variables (`$conf`, `$AOS_TMP_DATA_PATH`, `$AOS_LOGS_PATH`, `$AOS_FONTS_PATH`) are automatically set by Ascoos OS during initialization.
7. The [`phpBCL8`](https://github.com/ascoos/phpbcl8) library is preinstalled and loaded automatically by Ascoos OS without requiring Composer.

## Getting Started
1. Configure the `$properties` array in the script with your X API OAuth token (if overriding the default configuration).
2. Execute the script via a web server, e.g., `https://localhost/aos/examples/case-studies/sports/sentiment_analysis/fcbarcelona_sentiment_analysis.php`.

## Example Usage
```php
use ASCOOS\OS\Kernel\API\TTwitterAPIHandler;
use ASCOOS\OS\Kernel\AI\TLinguisticAnalysisHandler;
use ASCOOS\OS\Kernel\Files\TFilesHandler;
use ASCOOS\OS\Kernel\Systems\TCoreSystemHandler;
use ASCOOS\OS\Extras\Arrays\Graphs\TArrayGraphHandler;

global $conf, $AOS_TMP_DATA_PATH, $AOS_FONTS_PATH, $AOS_LOGS_PATH;

// Initialize configuration
$properties = [
    'logs' => [
        'useLogger' => $conf['logs']['useLogger'] ?? true,
        'dir' => $conf['logs']['dir'] ?? $AOS_LOGS_PATH,
        'file' => 'sports_analysis.log'
    ],
    'file' => [
        'baseDir' => $AOS_TMP_DATA_PATH . '/sports/',
        'quotaSize' => 1000000000
    ],
    'nlp' => [
        'host' => $conf['db']['mysqli']['host'] ?? 'localhost',
        'user' => $conf['db']['mysqli']['user'] ?? 'root',
        'password' => $conf['db']['mysqli']['pass'] ?? 'root',
        'dbname' => $conf['db']['mysqli']['dbname'] ?? 'nlp'
    ]
];

// Initialize ASCOOS classes
$twitter = new TTwitterAPIHandler('https://api.x.com', 0, [], 'GET', $properties);
$twitter->setOAuthToken('your_oauth_token_here');
$tweets = $twitter->getTweets(['query' => 'from:FCBarcelona', 'max_results' => 10]);
```

## Expected Output
The script outputs a JSON report and generates a bar chart (`sentiment_trend.png`). Example JSON output:
```json
{
    "team": "FCBarcelona",
    "sentiments": {
        "positive": 7,
        "neutral": 2,
        "negative": 1
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
Want to contribute to this case study? Fork the repository, modify or add new features to `fcbarcelona_sentiment_analysis.php`, and submit a pull request. See [CONTRIBUTING.md](/CONTRIBUTING.md) for guidelines.

## License
This case study is licensed under the Ascoos General License (AGL). See [LICENSE](/LICENSE.md).
