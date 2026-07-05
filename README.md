

### **SECR4483/SCSR4483 Secure Programming - Final Examination (Alternative Assessment)**

## 📌 Student Information

* **Name:** SEPRIYANDI BIN AGUSR


* **Matric No.:** SX211697ECRHF04


* **Year/Course:** 2025/2026-II/SECRH


* **Section:** UTMSPACE


* **Lecturer Name:** DR. MOHD KUFAISAL BIN MOHD SIDIK


* **GitHub Link:** [https://github.com/sepz36/SECR4483_SCSR4483-Secure-Programming-Final-Examination-Alternative-Assessment-](https://www.google.com/search?q=https://github.com/sepz36/SECR4483_SCSR4483-Secure-Programming-Final-Examination-Alternative-Assessment-) *(Derived from the provided repository setup screenshot)*
* **YouTube Link:** `[Insert your YouTube Link here]`


---

## 📖 Project Overview

This repository contains the forensic code review and secure refactoring implementation for the **MediChain HealthVault-API**. The assessment focuses on identifying and remediating critical architectural vulnerabilities, mapping defects to the Malaysian Personal Data Protection Act (PDPA) 2010, and disrupting systemic exploit chains across three main artifacts:

1. `search.php`

2. `auth.php`

3. `crypto_vault.php`


---

## 🛡️ Vulnerability Analysis & Secure Refactoring

### 1. `search.php` (SQL Injection & Reflected XSS)



* **Vulnerability:** Unparameterised SQL concatenation allowed the data plane to collapse into the command plane, while unescaped HTML reflection enabled script execution.


* **Remediation:**
* Implemented PDO `prepare()` and `bindValue()` to structurally isolate data from the SQL command plane.


* Applied `htmlspecialchars(ENT_QUOTES)` for context-aware output encoding to neutralize novel payloads and HTML metacharacters.





### 2. `auth.php` (Bound Constraint Failure & Obsolete Cryptography)



* **Vulnerability:** A byte-length validation mismatch (using `strlen`) created resource-exhaustion risks, and the use of fast, unsalted MD5 hashes enabled rapid offline credential reversal.


* **Remediation:**
* Replaced `strlen()` with `mb_strlen('UTF-8')` for semantic, charset-aware boundary checks.


* Migrated to memory-hard and time-hard **Argon2id** (`PASSWORD_ARGON2ID`) for secure credential hashing, effectively mitigating scale-out cracking.





### 3. `crypto_vault.php` (ECB Pattern Leakage & Hardcoded Key)



* **Vulnerability:** AES-128-ECB encryption leaked plaintext structural patterns (allowing patient re-identification), lacked integrity authentication, and relied on a hardcoded cryptographic key.


* **Remediation:**
* Upgraded to **AES-256-GCM (AEAD)** to ensure both confidentiality and bit-level integrity (GHASH), generating dynamic IVs via `random_bytes(12)`.


* Externalized the cryptographic key using a dotenv loader (`getenv('VAULT_AES_KEY')`), removing the secret from version control.





---

## 🔗 Exploit-Chain Disruption & Architectural Synthesis



The vulnerabilities across these modules formed a causal chain where an initial input-validation defect cascaded into the compromise of unrelated systems. The secure refactoring implementation breaks this chain structurally:

* **Stage 1 & 2 Disruption:** Closing the SQL Injection vector in `search.php` removes the delivery mechanism that exposed the legacy MD5 credential store.


* **Stage 3 Disruption:** The Argon2id migration in `auth.php` provides defense-in-depth, preventing offline reversal into valid credentials.


* **Stage 4 Disruption:** The AES-256-GCM migration in `crypto_vault.php` secures data-at-rest against targeted dosage tampering and diagnosis pattern leakage, neutralizing the final stage of the breach.