# Ascoos OS - pure PHP Web 5.0 and WebAI Core

Welcome to **Ascoos OS**, an innovative PHP core that brings **Web 5.0** to reality and flirts with **WebAI**! 

---

![Ascoos](https://dl.ascoos.com/images/ascoos.png)

[![Ascoos OS: official website status](https://img.shields.io/website?url=https://www.ascoos.com&style=for-the-badge&labelColor=%234e555b&color=006400)](https://www.ascoos.com) 
[![License AGL](https://img.shields.io/badge/AGL-blue?style=for-the-badge&label=LICENSE&labelColor=%234e555b&color=873260)](https://github.com/ascoos/osblob/main/LICENSE_AGL.md)
[![Ascoos OS is under development](https://img.shields.io/badge/1.0.0%20alpha%2027-blue?style=for-the-badge&label=DEVELOPMENT%20EDITION&labelColor=041f60&color=034f84)](https://www.ascoos.com)

---

## Table of Contents

- [Overview](#overview)
- [Vision](#vision)
- [Where will you find it?](#where-will-you-find-it)
- [Getting Started](#getting-started)
- [Features](#features)
- [System Requirements](#system-requirements)
- [Installation](#installation)
- [Management of Optional Core Classes](#management-of-optional-core-classes)
- [DoBu Documentation](#dobu-documentation)
- [Usage Example](#usage-example)
- [Case Studies](#case-studies)
- [Links](#links)
- [Author](#author)

---

## Overview

With ~1,500 encrypted classes (in early 2028), Ascoos OS integrates Frameworks, CMS, IoT, and decentralized applications, delivering security, interoperability, and result synthesis. 

Explore how we redefine the future of the internet!

---

## Vision

Redefining web development with a secure, modular, AI-driven PHP kernel.

---

## Where will you find it?

Ascoos OS is still in development, so it is not available for public use. 

However, it is evolving very quickly!

Check out the [Roadmap](https://os.ascoos.com/docs/api/en/roadmap.html) to learn about our next milestones and journey toward **[Web 5.0](https://os.ascoos.com/docs/articles/ascoos-meets-web5-el.html)** and **[WebAI](https://github.com/ascoos/WebAI)**.

### **`Included in Ascoos Web Extended Studio 26 Pro`**: [![SourceForge Downloads](https://img.shields.io/sourceforge/dt/ascoos-web-extended-studio?label=Ascoos%20Web%20Extended%20Studio)](https://sourceforge.net/projects/ascoos-web-extended-studio/)

---

## Getting Started

- **Explore the documentation**: Check out the [Glossary](https://os.ascoos.com/docs/api/en/glossary.html), [Roadmap](https://os.ascoos.com/docs/api/en/roadmap.html), and [Case Studies](https://github.com/ascoos/os/blob/main/examples/case-studies/README.md).
- **See code examples**: Find code with examples and case studies in the [/examples/](https://github.com/ascoos/os/blob/main/examples/) folder.
- **Learn about connecting with Web 5.0**: Web 5.0 combines the convenience of Web 2.0 with the decentralization of Web 3.0, without blockchain complexity. Using Decentralized Identifiers (DIDs) and Decentralized Web Nodes (DWNs), Ascoos OS implements this vision through **CiC (Cms-in-Cms)** technology. Learn more at "[**The CiC Technology: Cross-Interpreter Communication – The Philosophy of Integration for Web 5.0**](https://os.ascoos.com/docs/articles/cic-technology.html)".
- **Learn about connecting to WebAI**: [WebAI](https://github.com/ascoos/WebAI) is an architecture where the web itself operates as an intelligent entity, rather than as a collection of artificial intelligence add-ons.

---

## Features

![PHP](https://img.shields.io/badge/8.3+-blue?style=for-the-badge&label=PHP&labelColor=041f60&color=034f84)
![IoT](https://img.shields.io/badge/Ready-blue?style=for-the-badge&label=IoT&labelColor=%234e555b&color=006400)
![AI](https://img.shields.io/badge/Enabled-blue?style=for-the-badge&label=AI%2FNLP%2FNeural&labelColor=%234e555b&color=3e8548)
![Static Badge](https://img.shields.io/badge/Enabled-blue?style=for-the-badge&label=Macro%20Engine%20with%20DSL%2FAST&labelColor=%234e555b&color=3e8548)
![WebSocket](https://img.shields.io/badge/Supported-blue?style=for-the-badge&label=Web%20Socket&labelColor=%234e555b&color=873260)
![HTTP/3](https://img.shields.io/badge/Supported-blue?style=for-the-badge&label=HTTP%2F2%20%7C%20HTTP%2F3&labelColor=%234e555b&color=873260)

- Dynamic loading of optional kernel classes
- Decentralized web and torrent management.
- Extensive **network** and **system** management.
- Native IoT support (Arduino, Raspberry Pi, GNSS).
- Native capabilities of Artificial Intelligence (**AI**), Natural Language Processing (**NLP**), and Neural Networks (**NeuralNet**).
- **[JSQLDB](https://github.com/ascoos/jsqldb)**: JSON-based database. A hybrid JSON SQL database engine focused on speed, and PHP-native SQL queries.
- **[JML](https://jml.ascoos.com)**: JSON-style Markup Language. A lightweight, readable markup format inspired by JSON and DSLs.
- **[WIC](https://github.com/ascoos/wic)**: Secure image transfer format.
- **jAscoos & [BootLib](https://github.com/ascoos/bootlib)**: JavaScript and UI frameworks.
- **LibIn**: Library management. Dynamic loading of optional third-party libraries
- **Macro Engine**: Natural language programming.
- **ASS** (Ascoos Security System): Multi-layered security.
- **[DoBu (Documentation Builder)](https://github.com/ascoos/dobu)**: A JML‑inspired Documentation DSL for multilingual docblocks.

---

## System Requirements

- PHP 8.3+ with extensions: IonCube loaders, JSON, cURL.
- MariaDB 11.4+ or MongoDB 8.0+ or JSQLDB 1.0+.
- Web Server: Apache 2.4+.
- Recommended Memory: 512MB+ RAM.

---

## Installation

#### Namespace

```php
use ASCOOS\OS\...;
```

### Installation Steps

- Download the commercial package, based on the license you have, from the Official Download Website.
- Extract to any folder you desire within your root.
- For configuration, you have three options:

  - ❤️ Prepend Autoload: If you have access to php.ini, configure the auto_prepend_file directive with the appropriate folder so that it automatically loads Ascoos OS on every request.
  ```php
    auto_prepend_file ="/root/.../aos/autoload.php"
  ```

  - ✔️ spl_autoload: You can dynamically load Ascoos OS using the SPL library.
  ```php
    spl_autoload_extensions('autoload.php');
    spl_autoload_register();
  ```

  - ✔️ require_once: You can load Ascoos OS within your PHP file using the "require_once" function.
  ```php
    require_once "root/.../aos/autoload.php";
  ```

---

### Management of Optional Core Classes

The **Ascoos OS** has two types of kernel classes: core kernels and optional ones. The former are loaded automatically when **Ascoos OS** runs, while the latter are loaded optionally based on the user's choices and needs.

To manage this functionality, we created an internal application in **Ascoos OS**, the **Extras Classes Manager** (see screenshot), through which these classes can be loaded dynamically.

![ASCOOS OS](https://s.ascoos.com/images/ascoos/tchc/ecm-01.png)

---

## DoBu Documentation

**Ascoos OS** includes as its official documentation a new documentation DSL standard called **[DoBu](https://github.com/ascoos/dobu)**.

It is docblocks inside `/* ... */` based on **[JML](https://jml.ascoos.com)**.

It is more oriented toward creating documentation files and less as immediate reference text. It has the capability for multilingual documentation and is an **agnostic metakeys docblock**.

Supports docblock for:

- the file with the class or the example file
- the class
- each method or function
- parameters
- return types
- exceptions
- multilingual descriptions
- mathematical formulas
- and much more.

#### Example of DoBu documentation for a file header

```php
/*
dobu {
    file:id(`1`),name(`create-my-project`) {
        ascoos {
            logo {`
                  __ _  ___  ___ ___   ___   ___     ___   ___
                 / _V |/  / / __/ _ \ / _ \ /  /    / _ \ /  /
                | (_| |\  \| (_| (_) | (_) |\  \   | (_) |\  \
                 \__,_|/__/ \___\___/ \___/ /__/    \___/ /__/
            `},
            name {`ASCOOS OS`},
            version {`1.0.0`},
            category {`Web OS`},
            subcategory {`Web5 / WebAI`},
            description {`A Web 5.0 and Web AI Kernel for decentralized web and IoT applications`},
            creator {`Drogidis Christos`},
            site {`https://www.ascoos.com`},
            issues {`https://issues.ascoos.com`},
            support {`support@ascoos.com`},
            license {`[Commercial] http://docs.ascoos.com/lics/ascoos/AGL.html`},
            copyright {`Copyright (c) 2007 - 2026, AlexSoft Software.`}
        },
        project {
            package:langs {
                en {`DoBu code sample`},
                el {`Δείγμα κώδικα DoBu`}
            },
            subpackage:langs {
                en {`DoBu code sample for classes and methods`},
                el {`Δείγμα κώδικα DoBu για κλάσεις και μεθόδους`}
            },
            category:langs {
                en {`Examples`},
                el {`Παραδείγματα`}
            },
            subcategory:langs {
                en {`DoBu for classes`},
                el {`DoBu για κλάσεις`}
            },
            source {`examples/create-my-project.php`},
            description:langs {
                en {`This file is a complete example of docblock writing and DoBu structure.`},
                el {`Το αρχείο αυτό αποτελεί ένα ολοκληρωμένο παράδειγμα σύνταξης docblock, δομής DoBu`}
            },
            fileNo {`1`},
            version {`1.0.0`},
            build {`1`},
            created {`2026-02-12 09:25:03`},
            updated {`2026-02-12 09:51:43`},
            author {`Author Name`},
            authorSite {`https://www.example.com`},
            support {`support@example.com`},
            license {`MIT`},
            since {`1.0.0`},
            sincePHP {`8.3.0+`}
        }
    }
}
*/
```

---

## Usage Example

```php
use ASCOOS\OS\Kernel\Net\TNetwork;

// Retrieve DNS information
$objNetwork = new TNetwork();
$dnsInfo = $objNetwork->getDNSInfo();
echo "Primary DNS: " . $dnsInfo[0];
if(key_exists(1, $dnsInfo)) echo "<br>"."Secondary DNS: " . $dnsInfo[1] . "<br>";

// Frees of the object
$objNetwork->Free($objNetwork);
?>
```

---

## Case Studies

See how Ascoos OS implements Web 5.0 through practical examples, such as integrating Joomla with torrents, monitoring IoT sensors, and audio processing. Explore them in [Case Studies](https://github.com/ascoos/os/blob/main/examples/case-studies/README.md).

---

## Links

![Ascoos OS: Forks](https://img.shields.io/github/forks/ascoos/os)
![Ascoos OS: Stars](https://img.shields.io/github/stars/ascoos/os)
![Ascoos OS: Watchers](https://img.shields.io/github/watchers/ascoos/os)
[![YouTube Channel Views](https://img.shields.io/youtube/channel/views/UCSXEgwKou_sV0D6ZWOaih5w)](https://www.youtube.com/@Ascoos)
[![X Follow](https://img.shields.io/twitter/follow/ascoos)](https://x.com/ascoos)

### Documentation

- [Web 5.0 and Ascoos OS](https://github.com/ascoos/os/blob/main/WEB5.md)
- [Glossary](https://os.ascoos.com/docs/api/en/glossary.html)
- [Roadmap](https://os.ascoos.com/docs/api/en/roadmap.html)
- [Case Studies](https://github.com/ascoos/os/blob/main/examples/case-studies/README.md)
- [Ascoos Meets Web 5.0](https://os.ascoos.com/docs/articles/ascoos-meets-web5.html)

### Tools & Libraries

- [JSQLDB](https://github.com/ascoos/jsqldb)
- [WIC](https://github.com/ascoos/wic)
- [BootLib](https://github.com/ascoos/bootlib)
- [BootLib Flex](https://bootlib.ascoos.com/examples/flex/)
- [phpBCL](https://github.com/ascoos/phpbcl8)
- [AWES](https://github.com/ascoos/awes)

### Community

- [YouTube](https://www.youtube.com/@Ascoos)
- [X](https://x.com/ascoos)

### Official Websites

- [Ascoos Projects Family](https://www.ascoos.com)
- [Ascoos Web Extended Studio (AWES)](https://awes.ascoos.com)
- [Ascoos OS (Under construction)](https://os.ascoos.com)
- [BootLib UI Framework (Under construction)](https://bootlib.ascoos.com)

---

## Author

**Drogidis Christos**  

ASCOOS OS Creator  

https://www.ascoos.com