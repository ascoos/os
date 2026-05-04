# ASCOOS OS – Changelog for 1.0.0a30

Date: **2026-05-02 07:00:00**

Build: **17716**

State: **Alpha-30**


---

## Classes

### **TCoreTrait**

**Changes:**
- Transfer Extended PHPDoc docblocks to DoBu docblocks

**Methods:**

- **`getServerMemoryUsage()`** : Provides memory usage statistics in percentage or structured form.


---

### **TCoreHandler**

**Changes:**
- Transfer Extended PHPDoc docblocks to DoBu docblocks


---

### **TError**

**Changes:**
- Transfer Extended PHPDoc docblocks to DoBu docblocks


---

### **THandler**

**Changes:**
- Transfer Extended PHPDoc docblocks to DoBu docblocks


---

### **TMathHandler**

**Changes:**
- Transfer Extended PHPDoc docblocks to DoBu docblocks

**Methods:**

- **`hermiteInterpolate()`** : Evaluates the solution of an ODE at an arbitrary time using cubic Hermite interpolation between RK4 sample points.
- **`hermiteInterpolateVector()`** : Evaluates the solution of a vector-valued ODE system at an arbitrary time using cubic Hermite interpolation between adaptive RKF45 sample points.
- **`rk4()`** : The Runge-Kutta 4th Order (RK4) method is the gold standard for numerical integration of ordinary differential equations (ODEs). It provides a robust framework for simulating dynamic systems where an analytical solution is difficult or impossible to obtain.
- **`rkf45`** : RKF45 is an adaptive numerical method for solving ODEs that dynamically adjusts the step size to control the approximation error.
- **`rkf45_sys()`** : The Runge–Kutta–Fehlberg (RKF45) method extended to systems of coupled differential equations.


---

### **TObject**

**Changes:**
- Transfer Extended PHPDoc docblocks to DoBu docblocks

**Methods:**

- **`throwException()`** : Throws specified exception type with code/message.


---

### **TStringList**

TStringList is a core utility class of the ASCOOS OS Kernel designed to represent a linear, ordered list of string values. It offers essential list operations such as adding, inserting, deleting and searching strings, as well as helper features like text serialization and key-value parsing. Unlike Delphi's TStringList, this implementation is purely PHP-oriented and integrates with the ASCOOS TObject property system for configurable behavior.

**Methods:**

- **`__construct()`** : Initializes the class with an array, and optional properties.
- **`getInstance()`** : We see if the object is already loaded, otherwise we create a new load of the object.
- **`add()`** : Adds a new string to the end of the list and returns its index.
- **`clear()`** : Clears all strings from the list.
- **`contains()`** : Checks whether the list contains the specified string.
- **`count()`** : Returns the number of strings stored in the list.
- **`delete()`** : Deletes the string at the specified index and reindexes the list.
- **`first()`** : Returns the first string in the list.
- **`fromKeyValueArray()`** : Loads the list from an associative array of key-value pairs.
- **`get()`** : Returns the string stored at the specified index.
- **`getDelimitedText()`** : Returns all list items joined into a single delimited UTF‑8 safe string.
- **`getText()`** : Returns all list items as a multi-line UTF‑8 safe string.
- **`getValue()`** : Retrieves the value associated with the specified key.
- **`indexOf()`** : Returns the index of the specified string or -1 if not found.
- **`indexOfKey()`** : Returns the index of the entry whose key matches the specified name.
- **`insert()`** : Inserts a string at the specified index and shifts the remaining items.
- **`last()`** : Returns the last string in the list.
- **`loadFromFile()`** : Loads text from a file, handling missing-file conditions based on system mode.
- **`loadFromKeyValueText()`** : Loads key-value formatted text into the list.
- **`lower()`** : Converts all list items to lowercase (values only for key=value entries).
- **`reverse()`** : Reverses the order of the list.
- **`saveToFile()`** : Saves the list to a file, handling empty-list conditions based on system mode.
- **`set()`** : Replaces the string at the specified index.
- **`setDelimitedText()`** : Parses a delimited string and loads its parts into the list.
- **`setKeyValue()`** : Sets or updates the value associated with the specified key.
- **`setText()`** : Splits a UTF‑8 text block into lines and loads them into the list.
- **`setValue()`** : Sets or updates the value associated with the specified key.
- **`sort()`** : Sorts the list in ascending or descending UTF‑8 order.
- **`sortDesc()`** : Sorts the list in descending UTF‑8 order.
- **`toArray()`** : Returns the internal list as a native PHP array.
- **`toKeyValueArray()`** : Converts the list into an associative array of key-value pairs.
- **`ucwordsList()`** : Capitalizes the first letter of each word (values only for key=value entries).
- **`unique()`** : Removes duplicate strings from the list.
- **`upper()`** : Converts all list items to uppercase (values only for key=value entries).


---

### **TUTF8**

**Changes:**
- Transfer Extended PHPDoc docblocks to DoBu docblocks

**Methods:**

- **`grapheme_strrev()`** : Reverses a string using Unicode grapheme clusters to ensure visually correct character order.
- **`slugify()`** : UTF‑8 safe slug generator using transliteration and normalization


---

## Functions

### **Global Functions**

- **`getNiceFileSize()`** : Converts a byte value into a human‑readable file size string.
- **`humanizeKey()`** : Converts a key-like string to human-readable title case.
- **`print_stats()`** : Outputs execution statistics such as runtime, memory usage, and peak memory consumption.
- **`vn()`** : Returns the name(s) of global variables whose value matches the given input.
- **`writeln()`** : Writes a string followed by one or more newline characters.

---

### **Openssl**

- **`openssl_bundle_create()`** : Creates a unified PEM bundle containing certificate, private key, and optional chain.
- **`openssl_ca_backup()`** : Creates a compressed backup of the entire CA directory structure.
- **`openssl_ca_init()`** : Initializes a full CA directory structure compatible with OpenSSL.
- **`openssl_ca_restore()`** : Restores a CA directory from a .tar.gz backup.
- **`openssl_cert_chain()`** : Creates a full certificate chain (fullchain.pem) by concatenating certificates.
- **`openssl_cert_chain_dump()`** : Returns a structured dump of every certificate in a chain file.
- **`openssl_cert_chain_verify()`** : Verifies a certificate against a CA bundle and optional CRL.
- **`openssl_cert_chain_verify_detailed()`** : Performs a full chain verification and returns detailed error information.
- **`openssl_cert_compare()`** : Compares two certificates and returns a structured diff of their fields.
- **`openssl_cert_days_left()`** : Returns how many days remain before a certificate expires.
- **`openssl_cert_dump()`** : Returns a complete structured dump of all certificate fields.
- **`openssl_cert_fingerprint()`** : Returns the fingerprint of a certificate using the specified hash algorithm.
- **`openssl_cert_from_der()`** : Converts a DER certificate to PEM format.
- **`openssl_cert_info()`** : Extracts detailed information from an X.509 certificate (PEM or DER).
- **`openssl_cert_init()`** : Generates an OpenSSL .cnf file for domain or wildcard certificate requests.
- **`openssl_cert_is_expired()`** : Checks whether a certificate is expired.
- **`openssl_cert_issuer()`** : Extracts the certificate issuer as a structured associative array.
- **`openssl_cert_key_match()`** : Checks whether a private key matches a certificate.
- **`openssl_cert_public_key()`** : Extracts the public key from a certificate in PEM format.
- **`openssl_cert_purpose()`** : Returns which purposes a certificate is valid for (server, client, email, code-signing, etc.).
- **`openssl_cert_read()`** : Reads a certificate file and returns its raw encoded contents.
- **`openssl_cert_renew()`** : Renews an existing certificate by generating a new CSR and signing it with the CA.
- **`openssl_cert_request()`** : Generates a CSR (Certificate Signing Request) using a config file and private key.
- **`openssl_cert_revoke()`** : Revokes a certificate using the CA configuration and private key.
- **`openssl_cert_san_list()`** : Extracts all Subject Alternative Names (SAN) from a certificate.
- **`openssl_cert_selfsign()`** : Generates a self-signed certificate using a private key and a .cnf configuration file.
- **`openssl_cert_serial()`** : Extracts the certificate serial number in normalized uppercase hex format.
- **`openssl_cert_sign()`** : Signs a CSR using the CA certificate and private key, producing a signed certificate.
- **`openssl_cert_signature_algorithm()`** : Extracts the signature algorithm of a certificate.
- **`openssl_cert_subject()`** : Extracts the certificate subject as a structured associative array.
- **`openssl_cert_to_der()`** : Converts a PEM certificate to DER format.
- **`openssl_cert_to_json()`** : Converts a certificate into a structured JSON object containing all key fields.
- **`openssl_cert_validity()`** : Returns the notBefore and notAfter fields of a certificate.
- **`openssl_cert_verify()`** : Verifies a certificate against a CA certificate and optionally a CRL.
- **`openssl_crl_export()`** : Exports a CRL file in PEM or DER format.
- **`openssl_crl_new()`** : Generates a new Certificate Revocation List (CRL) using the OpenSSL CLI.
- **`openssl_crl_read()`** : Reads a CRL file (PEM or DER) and returns its PEM representation.
- **`openssl_crl_revoke()`** : Revokes a certificate using the OpenSSL CLI and updates the CA index.
- **`openssl_crl_update()`** : Generates a new CRL using the CA configuration and private key.
- **`openssl_crl_verify()`** : Verifies a CRL against a CA certificate using OpenSSL.
- **`openssl_key_compare()`** : Compares two private keys and returns a structured diff of their properties.
- **`openssl_key_convert()`** : Converts private keys between formats (PKCS#1, PKCS#8), adds or removes encryption.
- **`openssl_key_decrypt()`** : Removes password protection from an encrypted private key.
- **`openssl_key_encrypt()`** : Encrypts a private key using PKCS#8 with a password.
- **`openssl_key_generate()`** : Generates a private key (RSA, EC, or Ed25519) using OpenSSL.
- **`openssl_key_info()`** : Returns detailed information about a private key (RSA, EC, Ed25519).
- **`openssl_ocsp_sign()`** : Signs a CSR to produce an OCSP responder certificate with correct extensions.
- **`openssl_ocsp_verify()`** : Verifies an OCSP response using the issuer certificate and OCSP responder certificate.
- **`openssl_pkcs12_exports()`** : Creates a PKCS#12 (.p12/.pfx) bundle containing certificate, private key, and optional chain.
- **`openssl_pkcs12_import()`** : Imports a PKCS#12 (.p12/.pfx) file and extracts certificate, private key, and optional chain.

---

### **Mbstring**

- **`mb_strcasecmp()`** : Multibyte binary safe case-insensitive string comparison.
- **`mb_strcmp()`** :  Multibyte safe string comparison
- **`mb_strncmp()`** : Multibyte binary safe string comparison of the first n characters
- **`mb_strtr()`** : Multibyte safe translate characters or replace substrings

---
