# 📘 Ascoos OS – Technology Glossary

This document includes definitions, examples, and timelines for the core technologies used or developed within the Ascoos OS framework.

The name **ASCOOS** stands for **`Alexsoft Software Content Object-Oriented System`**, referring to an object-oriented content management system developed by AlexSoft Software.

---

## Table of Contents
- [Annotations](#annotations)
- [Web 5.0](#web5)
- [Core & Architecture](#core--architecture)
- [Security, Authentication, and Validation](#security-authentication-and-validation)
- [Interpretation & Integration](#interpretation--integration)
- [CMS & UI Technologies](#cms--ui-technologies)
- [Community & Support](#community--support)
- [References](#references)

## Annotations
- 🔹 Legacy/Upgraded technologies and features
- 💠 New technologies and features

---

## Web5
Web 5.0 is a vision for a user-centric internet that combines the convenience of Web 2.0 with the decentralization of Web 3.0, without blockchain complexity. Introduced by TBD (Block Inc.), it relies on Decentralized Identifiers (DIDs), Decentralized Web Nodes (DWNs), Verifiable Credentials, and Decentralized Web Applications (DWAs). Ascoos OS implements this philosophy through CiC technology, enabling decentralization, interoperability, and result synthesis. Learn more at [Ascoos Meets Web 5.0](https://os.ascoos.com/docs/articles/ascoos-meets-web5.html).

---

## Core & Architecture

### 💠 OTA (One To All)
A technology that implements a single Ascoos OS core for all domains/subdomains of a user or server.
- **Purpose**: Unified management and resource allocation.
- **Example**: A server with 5 domains and 12 subdomains uses a single shared core for all.

---

## Security, Authentication, and Validation

### 🔹 ASS (Ascoos Security System) – [2010 → 2026]
Protection against XSS, SQL Injection, DDoS, buffer overflows, VPN/Proxy/IP/Mac/Email filters, AI-based request validation, counterattacks, phishing, CSP, CORS, OAuth2, TLS 1.3, CSRF, and more.

### 🔹 DSAP (Dedicated Secret Administration Path) – [2010 → 2026]
A unique, hidden, and protected administration path for each website. The administration section is located in a hidden path defined by the cPanel administrator during installation and can be changed at any time by the cPanel administrator through the website’s configuration program in the administration section.

### 🔹 DSCP (Dedicated Secret Configuration Path) – [2010 → 2026]
A unique, hidden, and protected path for storing the encrypted configuration file of each website.

The file containing the website’s configuration and operational information is encrypted, ensuring that even a server administrator with physical access to the website’s data cannot read its contents. Data reading, management, and storage are handled through a dedicated program in the administration section.

### 🔹 DSHP (Dedicated Secret Cache Path) – [2010 → 2026]
A unique, hidden, and protected path for storing temporary files of each website. All temporary data files are stored in a hidden path defined by the cPanel administrator during installation, which can be changed at any time through the website’s configuration program in the administration section.

### 🔹 DSLP (Dedicated Secret Log Path) – [2010 → 2026]
A unique, hidden, and protected path for storing website log files. Logs containing website activity reports are stored in a unique, protected path per website to minimize remote access.

### 🔹 DSMP (Dedicated Secret Member Path) – [2010 → 2026]
A unique, hidden, and protected path for storing member information for each website. The file containing essential internal user information is stored in a unique path per website, minimizing the risk of remote access by anyone outside the ASCOOS CMS.

### 🔹 DSS (Dedicated Secret Session) – [2010 → 2026]
Each website has its own exclusive secret user sessions. Session storage and management occur within the website itself, in a unique secret path for each website, rather than the server’s default storage location. This avoids even the slightest risk of sharing session cache information.

### 🔹 DUAL (Dynamic User Access Level) – [2010 → 2026]
DUAL (Dynamic User Access Level) is a method for managing user and group access levels, where all Ascoos elements interact regarding access permissions.

For example, you can assign specific access rights to a user, users, or user groups for a particular article, module, application, etc.

### 🔹 oCoS (One Cookie of Session) – [2010 → 2026]
User or visitor identification by the ASCOOS CMS is done with a single cookie containing the identifier name. All other user settings, permissions, and preferences are developed, stored, and managed internally by the ASCOOS CMS on the server, following the `DSS` standards.

### 🔹 S.O.R.K. (Ascoos Archiving System) – [2010 → 2026]
S.O.R.K. implements a category organization system with unlimited subcategory depth.

Additionally, an element can include a secondary archiving system using tags, allowing a combination of both archiving methods.

### 🔹 TRU (Temporary Registration User) – [2010 → 2026]
TRU (Temporary Registration User) is a system for temporary user registration that protects the website from unwanted registrations.

Developed by Alexsoft Software, this technology temporarily registers users in a separate table from regular users. Through various validation parameters, it ensures that a user’s registration is only completed if they genuinely intend to register.

This keeps the main user table “clean” and optimized.

TRU’s security measures include permanently blocking the IP and email of spam users, preventing their reuse in the future.

---

## Interpretation & Integration

### 💠 CiC (Cms-in-Cms) – Cross-Interpreter Communication
CiC is not just a development standard—it’s a **philosophy of unification**, where every CMS, API, or language becomes an interpreter within a unified semantic core.
- **Not just integration**. It’s **interpretation**.
- Each CMS (WordPress, Joomla, Drupal) becomes an **interpreter** capable of executing, translating, and exchanging logic.
- Ascoos OS doesn’t just connect them—it **composes** them.

### 💠 LiL (Language-in-Language) – Languages Cross-Interpreter  
**Scheduled for Q4 2028**

A technology that interprets web syntax into other programming languages and converts them into executable PHP commands.
- **Purpose**: Transforming UI into a programmatic interface.
- **Example**:
  ```html
  <button onclick="run:macro('deploy')">Deploy</button>
  ```
  Translated to:
  ```php
  $macroHandler->runMacro('deploy');
  ```
- **Support**: HTML, JS, Delphi, Pascal, Python, C++, and more.

---

## CMS & UI Technologies

### 🔹 ASCOOS CMS – [2010 → Oxyzen]
ASCOOS CMS is a commercial content management system (CMS) with a desktop-like appearance and an operating system-like user experience, distributed under the AGL license.

### 💠 Oxyzen – [Q4 2026]
A next-generation CMS (successor to `Ascoos CMS 10`) with a desktop-like appearance and AI support.
- **Purpose**: Operating system-like user experience.
- **Features**: Drag & drop, macro scripting, AI modules.

---

## Community & Support

### 🔹 Comfor – [2010 → 2026]
The official Ascoos OS community forum.
- **Purpose**: Discussion, support, and idea exchange.
- **Integration**: GitHub, Discord, official websites.

---

## References

- For usage examples: [examples/](./examples/)
- For contribution: [CONTRIBUTING.md](./CONTRIBUTING.md)
- Contact: [support@ascoos.com](mailto:support@ascoos.com)

---

> For the timeline of technology evolution, see [ROADMAP.md](./ROADMAP.md)
