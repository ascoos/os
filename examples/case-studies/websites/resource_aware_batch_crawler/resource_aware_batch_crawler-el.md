# Case Study: Resource-Aware Batch Web Crawler  
**Έξυπνος, ασφαλής και αυτο-ρυθμιζόμενος crawler που προσαρμόζει το βάθος σάρωσης ανάλογα με τους πόρους του συστήματος**

Αυτή η μελέτη περίπτωσης δείχνει πώς το **Ascoos OS** μπορεί να υλοποιήσει έναν παραγωγικό, scalable web crawler που **δεν καταστρέφει το server** ακόμα και όταν τρέχει σε shared hosting ή VPS με περιορισμένους πόρους. Το script παρακολουθεί real-time CPU + RAM, ενεργοποιεί “light mode” όταν χρειάζεται και αποθηκεύει αναφορές με quota control — όλα με 3 μόνο κλάσεις του kernel.

---
## Σκοπός
- Ευφυής διαχείριση πόρων συστήματος κατά το crawling  
- Αυτόματη εναλλαγή μεταξύ full και light mode  
- Ασφαλής εγγραφή αρχείων με quota (100 MB default)  
- Παραγωγή αναφορών JSON για Web5 indexing / AI training  
- Zero memory leaks (→ Free() calls)

---
## Κύριες Κλάσεις του Ascoos OS που Χρησιμοποιούνται
| Κλάση                        | Ρόλος                                                                 |
|------------------------------|-----------------------------------------------------------------------|
| **TCoreSystemHandler**       | Παρακολούθηση CPU load & memory usage σε real-time                    |
| **TWebsiteHandler**          | Έλεγχος διαθεσιμότητας, μέτρηση load time, λήψη HTML, εξαγωγή keywords |
| **TFilesHandler**            | Δημιουργία φακέλου, έλεγχος quota, ασφαλής εγγραφή JSON αναφορών       |
| **$utf8** (global helper)    | Ασφαλές UTF-8 substring για excerpts                                 |

---
## Δομή Αρχείων
```text
examples/
└── case-studies/
    └── websites/
        └── resource_aware_batch_crawler/
            └── resource_aware_batch_crawler.php   ← το αρχείο αυτής της μελέτης
```

Άμεσος σύνδεσμος:  
https://github.com/ascoos/os/blob/main/examples/case-studies/websites/resource_aware_batch_crawler/resource_aware_batch_crawler.php

---
## Προαπαιτούμενα
1. PHP ≥ 8.2  
2. Εγκατεστημένο **Ascoos OS 26** ή **AWES 26** (https://awes.ascoos.com)

---
## Ροή Εκτέλεσης (βήμα-βήμα)

1. Ορίζονται thresholds CPU 70 % και Memory 80 %.  
2. Για κάθε URL της λίστας:  
   - Υπολογίζεται τρέχον CPU + RAM load  
   - Αν κάποιο όριο ξεπεραστεί → ενεργοποιείται **light mode**  
3. Πάντα εκτελούνται:  
   - `checkAvailability()`  
   - `analyzeLoadTime()`  
4. Μόνο σε normal mode εκτελούνται:  
   - `getHTMLContent()`  
   - `extractKeywords()` (για sentiment/analysis)  
5. Αποθηκεύεται αναλυτικό report σε JSON με timestamp  
6. Αυτόματο cleanup με `Free()` για zero memory leaks

---
## Παράδειγμα Κώδικα (αποσπάσματα)

```php
$cpuLoad = $system->get_cpu_load(0);
$memLoad = $system->get_memory_stats()['percent'];

$lightMode = $cpuLoad > 70 || $memLoad > 80;

if (!$lightMode) {
    $content   = $website->getHTMLContent($url);
    $keywords  = $website->extractKeywords($url);
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
## Αναμενόμενο Αποτέλεσμα (παράδειγμα output)

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

→ Αποθηκεύεται ως `batch_crawl_20251127_142310.json` μέσα στο `/tmp/crawl_reports/`

---
## Πόροι
- Τεκμηρίωση Ascoos OS → https://docs.ascoos.com/os (Υπό κατασκευή) 
- Επίσημη ιστοσελίδα → https://os.ascoos.com (Υπό κατασκευή) 
- AWES Studio (online IDE) → https://awes.ascoos.com  
- GitHub Repository → https://github.com/ascoos/os

---
## Συνεισφορά
Μπορείτε να:
- προσθέσετε περισσότερους ελέγχους (π.χ. disk I/O)  
- προσθέσετε πολυνηματική εκτέλεση με `TThreadHandler`  
- ενσωματώσετε `TNeuralNetworkHandler` για semantic scoring URLs  

Οδηγίες → [CONTRIBUTING-GR.md](https://github.com/ascoos/os/blob/main/CONTRIBUTING-GR.md)

---
## Άδεια Χρήσης
Ascoos General License (AGL) — δείτε [LICENSE-GR.md](https://github.com/ascoos/os/blob/main/LICENSE-GR.md)
