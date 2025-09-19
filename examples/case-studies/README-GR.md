# Μελέτες Περίπτωσης

Αυτός ο φάκελος περιέχει μελέτες περίπτωσης που δείχνουν πραγματικές εφαρμογές του **Ascoos OS**, ενός Web 5.0 OS Kernel σχεδιασμένου για να αποτελεί τη βάση για απεριόριστες πλατφόρμες και frameworks.

## Διαθέσιμες Μελέτες Περίπτωσης
| Κατηγορία | Μελέτη Περίπτωσης | Περιγραφή | Φάκελος |
|-----------|-------------------|-----------|---------|
| AI / Macros | [Μηχανή Μακροεντολών με Προβλέψεις AI](./ai/macro_decision_engine/macro_decision_engine-GR.md) | Εκτελεί macros βάσει προβλέψεων AI, συνδυάζοντας λογιστική παλινδρόμηση με DSL (Domain-Specific Language). | [`ai/macro_decision_engine`](./ai/macro_decision_engine/) |
| AI / Neural | [Συνθέτης Ροής Μακροεντολών με Νευρωνικά Δίκτυα](./ai/neural/neural_workflow_composer/neural_workflow_composer-GR.md) | Εκτελεί μακροεντολές με βάση το ιστορικό του συστήματος, χρησιμοποιώντας νευρωνικά δίκτυα. | [`ai/neural/neural_workflow_composer`](./ai/neural/neural_workflow_composer/) |
| API | [Μαζικά API GET αιτήματα](./api/api_batch_orchestrator/api_batch_orchestrator-GR.md) | Εκτελεί μαζικά GET αιτήματα, αποθηκεύει αποκρίσεις στην cache, εκπέμπει γεγονότα επιτυχίας/αποτυχίας και καταγράφει δραστηριότητα. | [`api/api_batch_orchestrator`](./api/api_batch_orchestrator/) |
| IoT | [Παρακολούθηση Περιβαλλοντικών Αισθητήρων με Arduino](./iot/arduino/arduino_monitoring-GR.md) | Αναλύει δεδομένα θερμοκρασίας και υγρασίας μέσω Arduino, επικυρώνει τιμές, καταγράφει γεγονότα και δημιουργεί αναφορές. | [`iot/arduino`](./iot/arduino/) |
| UI | [Δέσμευση UI Συμβάντων](./ui/ui_event_binding/ui_event_binding-GR.md) | Δεσμεύει συμβάντα από το UI (π.χ. `onClick`), με λογική στον server. | [`ui/ui_event_binding`](./ui/ui_event_binding/) |
| Αθλητισμός | [Ανάλυση Συναισθήματος FC Barcelona](./sports/sentiment_analysis/fcbarcelona_sentiment_analysis-GR.md) | Αναλύει tweets σχετικά με την FC Barcelona από την πλατφόρμα X, εκτελεί ανάλυση συναισθήματος μέσω NLP και δημιουργεί ένα γράφημα ράβδων. | [`sports/sentiment_analysis`](./sports/sentiment_analysis/) |
| Αρχεία / Εικόνες | [Αρχειοθέτηση Εικόνων με Κρυπτογράφηση](./files/images/encrypted_image_archiver-GR.md) | Επεξεργάζεται εικόνες με αλλαγή μεγέθους και υδατογράφημα, τις κρυπτογραφεί, αναλύει τα μεγέθη και δημιουργεί οπτική αναφορά. | [`files/images`](./files/images/) |
| Αρχεία / Καθαρισμός | [Καθαρισμός Αρχείων με Έλεγχο Quota και Αναφορά Δραστηριότητας](./files/cleanup/quota_file_cleaner/quota_file_cleaner-GR.md) | Καθαρίζει παλιά αρχεία, ελέγχει το μέγεθος quota, καταγράφει γεγονότα και δημιουργεί αναφορά. | [`files/cleanup/quota_file_cleaner`](./files/cleanup/quota_file_cleaner/) |
| Αυτοματισμός / DevOps | [Μηχανή Εργασιών με Μακροεντολές](./automation/macros/macro_workflow_engine-GR.md) | Εκτελεί αλυσίδες ενεργειών με λογική FIFO, καθυστέρηση, προτεραιότητα και καταγραφή. | [`automation/macros`](./automation/macros/) |
| Γραμμικός Κώδικας | [Δημιουργία και Παρακολούθηση Barcode](./barcodes/creation/barcode_creation-GR.md) | Δημιουργεί barcode τύπου EAN-13 για προϊόντα, το αποθηκεύει ως PNG και παρακολουθεί τη χρήση CPU κατά τη διαδικασία. | [`barcodes/creation`](./barcodes/creation/) |
| Δίκτυο / Sockets | [WebSocket Server με Καταγραφή και Ενεργοποίηση Γεγονότων](./net/sockets/websocket_logger/websocket_logger-GR.md) | Καταγράφει εισερχόμενα μηνύματα και ενεργοποιεί σημασιολογικά γεγονότα. | [`net/sockets/websocket_logger`](./net/sockets/websocket_logger/) |
| Ηλεκτρονικά | [Σχεδιασμός και Επεξεργασία Σήματος με RLC Band-Pass Φίλτρο και Ψηφιακό FIR Φίλτρο](./electronics/audio_rlc_fir_processing/audio_rlc_fir_processing-GR.md) | Σχεδιασμός ενός αναλογικού RLC ζωνοπερατού φίλτρου και εφαρμογή ψηφιακού FIR φίλτρου σε σήμα ήχου. | [`electronics/audio_rlc_fir_processing`](./electronics/audio_rlc_fir_processing/) |
| Ιστοσελίδες | [Ανάλυση Περιεχομένου Ιστοσελίδας](./websites/linguistic_analysis/website_linguistic_analysis-GR.md) | Αναλύει το περιεχόμενο ιστοσελίδας με γλωσσική επεξεργασία, εντοπίζει τη γλώσσα, και παρακολουθεί τον φόρτο του συστήματος χρησιμοποιώντας εργαλεία NLP και παρακολούθησης. | [`websites/linguistic_analysis`](./websites/linguistic_analysis/) |
| Μακροεντολές | [Ενεργοποίηση Μακροεντολών βάσει NLP Ανάλυσης Συντακτικού Περιεχομένου](./macros/semantic_macro_trigger/semantic_macro_trigger-GR.md) | Εκτελεί μακροεντολές βάσει νοηματικής ανάλυσης συντακτικού περιεχομένου. | [`macros/semantic_macro_trigger`](./macros/semantic_macro_trigger/) |
| Μηχανική | [Υπολογισμός Δυνάμεων σε Κατασκευές](./engineering/forces/engineering_forces-GR.md) | Υπολογίζει δύναμη με βάση τη μάζα και την επιτάχυνση, αποθηκεύει τα αποτελέσματα και καταγράφει γεγονότα. | [`engineering/forces`](./engineering/forces/) |
| Τοποθεσία & Καιρός | [Συνδυασμός Γεωγραφικών και Μετεωρολογικών Δεδομένων](./location/weather/microapp_geo_weather-GR.md) | Λαμβάνει δεδομένα τοποθεσίας μέσω Google Maps και πρόγνωση καιρού μέσω OpenWeatherMap, τα επικυρώνει και τα αποθηκεύει κρυπτογραφημένα. | [`location/weather`](./location/weather/) |
| Σύστημα / Επικοινωνία | [Αποστολέας Ειδοποιήσεων με Νήματα](./system/communication/threaded_notification_dispatcher-GR.md) | Αποστέλλει ειδοποιήσεις Telegram σε πολλαπλούς παραλήπτες ταυτόχρονα μέσω νήματος και παρατηρητών. | [`system/communication`](./system/communication/) |
| Σύστημα | [Πίνακας Συναγερμών Συστήματος σε Πραγματικό Χρόνο](./system/dashboard/system_alert_dashboard-GR.md) | Παρακολουθεί CPU, RAM και Apache σε πραγματικό χρόνο, ενεργοποιεί ειδοποιήσεις, καταγράφει γεγονότα και δημιουργεί γραφήματα. | [`system/dashboard`](./system/dashboard/) |
| Σύστημα | [Παρακολούθηση Συστήματος και Backup](./system/monitoring/system_monitoring_backup-GR.md) | Παρακολουθεί πόρους συστήματος, δημιουργεί κρυπτογραφημένα snapshots και στέλνει ειδοποιήσεις μέσω Telegram. | [`system/monitoring`](./system/monitoring/) |
| Σύστημα / Υψηλής Απόδοσης | [Ισορροπιστής Φόρτου με Νήματα](./system/performance/thread_load_balancer-GR.md) | Κατανέμει εργασίες σε νήματα με βάση τον φόρτο CPU και RAM, παρακάμπτοντας νήματα όταν οι πόροι είναι υπερφορτωμένοι. | [`system/performance`](./system/performance/) |
| Υγεία | [Έξυπνος Προγραμματισμός Ραντεβού](./health/appointments/appointment_scheduler-GR.md) | Επικυρώνει αιτήματα ραντεβού, ελέγχει διαθεσιμότητα και καταγράφει σύγκρουση ή επιβεβαίωση. | [`health/appointments`](./health/appointments/) |
| Υγεία | [Διαχείριση Ιατρικών Δεδομένων και Ειδοποιήσεων](./health/medical/medical_data_management-GR.md) | Επικυρώνει δεδομένα ασθενών, επεξεργάζεται ιατρικές εικόνες, και αποθηκεύει κρυπτογραφημένα αρχεία με χρήση υδατογραφήματος και παρακολούθησης συμβάντων. | [`health/medical`](./health/medical/) |
| | *(Περισσότερες μελέτες περίπτωσης θα προστεθούν)* | | |

## Ξεκινώντας
1. Βεβαιωθείτε ότι το Ascoos OS είναι εγκατεστημένο (δείτε το [κύριο repository](https://github.com/ascoos/os)). Αν χρησιμοποιείτε το [`ASCOOS Web Extended Studio (AWES) 26`](https://awes.ascoos.com), το Ascoos OS είναι προεγκατεστημένο.
2. Πλοηγηθείτε στους φακέλους των μελετών περίπτωσης (π.χ., `/examples/case-studies/websites/linguistic_analysis/`).
3. Ακολουθήστε τις οδηγίες και πληροφορίες της κάθε μελέτης περίπτωσης διαβάζοντας τα αντίστοιχα markdown αρχεία.

## Πόροι
- [Τεκμηρίωση Ascoos OS](/docs/)
- [GitHub Repository](https://github.com/ascoos/os)
- [Ascoos OS στο LinkedIn](https://www.linkedin.com/in/ascoos)
- [Ascoos OS στο X](https://www.x.com/ascoos)
- [Ascoos Web Extended Studio](https://awes.ascoos.com)
- [BootLib](https://github.com/ascoos/bootlib)

## Συνεισφορά
Θέλετε να συνεισφέρετε μια νέα μελέτη περίπτωσης; Κάντε fork το repository, δημιουργήστε έναν νέο φάκελο κάτω από το `/examples/case-studies/`, και υποβάλετε pull request. Δείτε το [CONTRIBUTING.md](/CONTRIBUTING.md) για οδηγίες.

## Άδεια
Αυτές οι μελέτες περίπτωσης καλύπτονται από την Ascoos General License (AGL). Δείτε το [LICENSE](/LICENSE.md).
