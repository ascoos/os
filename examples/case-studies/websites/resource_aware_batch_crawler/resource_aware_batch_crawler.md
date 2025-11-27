# Case Study: Resource-Aware Batch Web Crawler  
**Intelligent, safe, and self-adjusting crawler that dynamically adapts crawl depth based on available system resources**

This case study demonstrates how **Ascoos OS** can implement a production-grade, highly scalable web crawler that **never kills the server** — even when running on shared hosting or low-resource VPS. The script monitors CPU + RAM usage in real time, automatically switches to “light mode” when needed, and stores reports with built-in quota control — using only **three core kernel classes**.

---
## Purpose
- Intelligent system resource management during crawling  
- Automatic switching between full and light mode  
- Safe file writing with storage quota (100 MB default)  
- JSON report generation for Web5 indexing / AI training pipelines  
- Zero memory leaks thanks to explicit `Free()` calls

---
## Core Ascoos OS Classes Used

| Class                      | Role                                                                      |
|----------------------------|---------------------------------------------------------------------------|
| **TCoreSystemHandler**     | Real-time CPU load & memory usage monitoring                              |
| **TWebsiteHandler**        | Availability check, load-time analysis, HTML fetching, keyword extraction |
| **TFilesHandler**          | Folder creation, quota enforcement, safe JSON report writing              |
| **$utf8** (global helper)  | Safe UTF-8 substring handling for content excerpts                        |

---
## File Structure
```text
examples/
└── case-studies/
    └── websites/
        └── resource_aware_batch_crawler/
            └── resource_aware_batch_crawler.php   ← this case study file
```

Direct link:  
https://github.com/ascoos/os/blob/main/examples/case-studies/websites/resource_aware_batch_crawler/resource_aware_batch_crawler.php

---
## Requirements
1. PHP ≥ 8.2
2. Ascoos OS 26 or AWES 26 installed → https://awes.ascoos.com

---
## Execution Flow (step-by-step)

1. CPU threshold set to 70 % and memory threshold to 80 %.  
2. For each URL in the batch:  
   - Current CPU + RAM load is measured  
   - If any threshold is exceeded → **light mode** is activated  
3. Always executed:  
   - `checkAvailability()`  
   - `analyzeLoadTime()`  
4. Executed only in normal (non-light) mode:  
   - `getHTMLContent()`  
   - `extractKeywords()` (sentiment / topic analysis)  
5. Full report saved as timestamped JSON  
6. Automatic cleanup with `Free()` → zero memory leaks

---
## Code Highlights

```php
$cpuLoad = $system->get_cpu_load(0);
$memLoad = $system->get_memory_stats()['percent'];
$lightMode = $cpuLoad > 70 || $memLoad > 80;

if (!$lightMode) {
    $content  = $website->getHTMLContent($url);
    $keywords = $website->extractKeywords($url);
} else {
    $content = ['light_mode' => true, 'basic' => $loadTime];
}
```

```php
$files->writeToFileWithCheck(
    json_encode($reports, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
    $reportFile
);
```

---
## Expected Output (sample JSON report)

```json
[
  {
    "url": "https://ascoos.com",
    "cpu_load": 34.5,
    "mem_load": 62.1,
    "light_mode": false,
    "availability": true,
    "load_time": 0.842,
    "content_excerpt": "<!DOCTYPE html><html lang=\"el\">..."
  },
  {
    "url": "https://example.com",
    "cpu_load": 88.2,
    "mem_load": 91.4,
    "light_mode": true,
    "availability": true,
    "load_time": 0.317,
    "content_excerpt": { "light_mode": true, "basic": 0.317 }
  }
]
```

Saved as `batch_crawl_20251127_142310.json` inside `/tmp/crawl_reports/`

---
## Resources
- Ascoos OS Documentation → https://docs.ascoos.com/os (under construction)  
- Official website → https://os.ascoos.com (under construction)  
- AWES Studio (online IDE) → https://awes.ascoos.com  
- GitHub Repository → https://github.com/ascoos/os

---
## Contributing
Feel free to extend the crawler with:
- Additional metrics (disk I/O, network bandwidth)  
- Multi-threading via `TThreadHandler`  
- AI-driven URL prioritization using `TNeuralNetworkHandler`

Guidelines → [CONTRIBUTING.md](https://github.com/ascoos/os/blob/main/CONTRIBUTING.md)  
Greek version → [CONTRIBUTING-GR.md](https://github.com/ascoos/os/blob/main/CONTRIBUTING-GR.md)

---
## License
Ascoos General License (AGL) — see [LICENSE.md](https://github.com/ascoos/os/blob/main/LICENSE.md)  
Greek version → [LICENSE-GR.md](https://github.com/ascoos/os/blob/main/LICENSE-GR.md)
