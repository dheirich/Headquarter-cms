# Headquarter / ClanIntern – Pflichtenheft v0.9

**Version:** 0.9 · **Datum:** 13.11.2026
**Status:** Konsolidierter **Entwurf zur fachlichen Freigabe**, keine vollständige Whiteboard-Freigabe
**Produkt:** Headquarter · **Implementierungsname:** ClanIntern · **Domain:** `clanhq.org`

## Versionshistorie

| Version | Bedeutung |
|---|---|
| v0.6 | Historischer detaillierter Fachbestand (im PDF-v0.7-Anhang enthalten) |
| v0.7 | Historische Konsolidierung, Lizenz-/Slotregeln und inzwischen abgelöste Stack-Varianten |
| v0.8 | Fachbestand zusammengeführt, damaligen .NET-10-Stack übernommen, Konflikte/offene Punkte kenntlich gemacht |
| **v0.9** | .NET 11/PostgreSQL als Zielstack, Dashboard- und Plattformkontext, Alpha 0.1 und Mock-up-Abgleich ergänzt; Fachbestand erhalten |

## 0. Zweck, Quellen und Verbindlichkeit

Dieses Pflichtenheft beschreibt die fachlichen Ziele, Systemgrenzen, Geschäftsregeln, Sicherheitsanforderungen und Abnahmekriterien der Clan-Management-Plattform. Es ersetzt **technische Angaben** älterer Pflichtenheft-Versionen durch die Entscheidungen aus `ARCHITECTURE.md` und `DECISIONS.md` mit Entscheidungsstand 13.11.2026. Historische Fachanforderungen werden dadurch nicht aufgehoben.

**Quellenrang bei technischen Widersprüchen:** akzeptierte `DECISIONS.md` → `ARCHITECTURE.md` → diese v0.9. Bei fachlichen Widersprüchen gibt es **keinen automatischen Vorrang**: die konkrete Entscheidung ist zu dokumentieren. Das Whiteboard-Archiv mit 51 Nutzdateien liegt vor, wurde aber **noch nicht vollständig visuell ausgewertet**. Deshalb ist v0.9 ein umfassender Arbeitsentwurf, **keine bestätigte vollständige Übernahme aller Whiteboard-Policies**.

### Anforderungsstatus

- **Übernommen:** in v0.6/v0.7 oder vorhandenen Projektdateien konkret beschrieben.
- **Geplant:** als Funktionsbereich vorgesehen, aber noch nicht abschließend spezifiziert.
- **Offen:** vor Implementierung fachlich oder technisch zu entscheiden.
- **Historisch ersetzt:** frühere Technologieentscheidung, keine Streichung der Fachregel.

---

## 1. Ziel und Geltungsbereich

Headquarter (Implementierungsname **ClanIntern**) ist eine modulare Verwaltungs- und Kommunikationsplattform für Gaming-Clans. Eine Claninstanz verwaltet **genau einen Clan** mit mehreren Gaming-Teams. `clanhq.org` dient als öffentliche Plattform für Registrierung und perspektivisch Lizenzerwerb. Eine gemeinsame Multi-Tenant-Instanz für mehrere unabhängige Clans ist nicht beschlossen. Daten verschiedener Instanzen müssen getrennt bleiben.

Eine Plattformregistrierung gewährt weder automatisch Clanmitgliedschaft noch eine Rolle oder Lizenz. Ein registrierter Account ohne Clanmitgliedschaft darf gemäß historischem Fachstand öffentliche Foren nutzen und einen Newsletter abonnieren.

## 2. Verbindliche technische Rahmenbedingungen

Technische Entscheidungen folgen `ARCHITECTURE.md` und `DECISIONS.md` (13.11.2026), nicht den historischen Stack-Angaben im Pflichtenheft.

- **.NET 11 / C#**, **Blazor Web App**, Razor Components, **Interactive Server**
- **ASP.NET Core** und **ASP.NET Core Identity** als technische Authentifizierungsgrundlage
- **PostgreSQL**, **Entity Framework Core 11 mit Npgsql**, LINQ und Migrationen
- **Tailwind CSS 4** als Ziel, Bootstrap vorübergehend
- **Modularer Monolith** mit `ClanIntern.Domain`, `.Application`, `.Infrastructure`, `.Web`
- Kein separates REST-Backend für die interne Blazor-Kommunikation; externe APIs bei nachgewiesenem Bedarf
- Git/GitHub, Tests, Dokumentation; Docker, CI/CD und Produktionshosting sind noch auszugestalten

Die folgenden fachlichen Anforderungen sind **nicht** allein durch die Wahl von ASP.NET Core Identity erfüllt.

## 3. Fachliche Module

| Modul | Zweck |
|---|---|
| MEMBER | Profile, Mitgliedschaften, Rollen- und Statusverwaltung |
| TEAM | Teams, Zuordnungen, Teamleiter, Genehmigungen |
| CONTENT | News, Ankündigungen, Umfragen, interne und öffentliche Inhalte |
| FORUM | Öffentliche, interne und teambezogene Foren |
| CHAT | Direkt-, Gruppen-, Clan-, Team- und Supportchat |
| FINANCE | Clankasse, Buchungen, Beiträge, Spenden und Belege |
| SERVER | Status- und Verbindungsintegration für Game-/Voice-Server |
| SECURITY | Accounts, Anmeldung, MFA, Sessions, Berechtigungen |
| CLAN_SETTINGS | Clanweite Aufnahme- und Sicherheitsrichtlinien |
| LICENCE | Lizenzen, Perioden, Slots und Freischaltungen |
| WARPLANNER | War-/Matchplanung |
| FILE_UPLOAD | Kontrollierte Datei- und Medienuploads |
| NOTIFICATIONS | System- und Sicherheitsbenachrichtigungen |
| AUDIT_LOG | Nachvollziehbarkeit kritischer Vorgänge |

Die Module sind **fachliche Grenzen**, keine Pflicht zu separaten .NET-Projekten oder Microservices.


## 3a. Plattformkontext, Clanmitgliedschaft und Dashboard

**Verbindliche Trennung:** Ein Plattformaccount, eine aktive Clanmitgliedschaft, eine Clanrolle, eine Permission und eine Lizenz sind eigenständige Konzepte. Pro Account ist höchstens eine aktive Clanmitgliedschaft vorgesehen; mehrere Teams desselben Clans sind zulässig. Die Claninstanz verwaltet genau einen Clan; eine gemeinsame Multi-Tenant-Architektur wird nicht stillschweigend vorausgesetzt.

**Clan-Gründung und Leitung:** Im regulären Rollenmodell ist die Gründung eines Clans dem Clanleader vorbehalten. Der Leader besitzt sowohl die erforderlichen Clanverwaltungsrechte als auch den vorgesehenen Plattformverwaltungszugriff. Subleader, Moderator, Member und Trial erhalten daraus keine Plattformverwaltungsrechte. Der bereits dokumentierte, besonders geschützte `SUPPORT_ADMIN` ist als separater Sonderfall zu behandeln; sein Recovery-Zugriff darf nicht als normale Clanrolle interpretiert werden.

**Dashboard-Grundsatz:** Die Anwendung bietet ein gemeinsames, responsives Dashboard-Layout. Navigation, Inhalte, Aktionen und Kennzahlen variieren nach Accountstatus, Mitgliedschaft, Rolle, Permission, Scope, Clan-Policy und Lizenz. Jede geschützte Aktion wird unabhängig von ihrer Sichtbarkeit serverseitig autorisiert. Ein Account ohne Clan erhält das allgemeine Plattform-Dashboard, nicht automatisch interne Clanbereiche.

**Funktionaler Mindestumfang der gezeigten Dashboard-Mock-ups (geplant, nicht bereits implementiert):**

| Oberfläche / Bereich | Fachliche Zuordnung und Mindestfunktionen |
|---|---|
| Übersicht | Begrüßung, berechtigungsgerechte Kennzahlen, aktuelle Aktivitäten, Schnellaktionen |
| Mitgliederverwaltung | Mitglied hinzufügen, bearbeiten, befördern, Trial-Mitglieder und gesperrte Mitglieder einsehen/verwalten |
| Forum / Board | Boards und Threads anlegen, interne/externe/taktische Bereiche, Smilies und Regeln verwalten |
| Dateien / Medien | Dateien, Videos und Bilder hochladen, externe Freigaben, Kategorienverwaltung |
| Server | Status, Einstellungen, Backup-Verwaltung, Logs, Wartung sowie Neustart/Herunterfahren als dargestellte Aktionen |
| Kommunikation | Freundesliste, Präsenzstatus, Nachrichten und Benachrichtigungen |
| Profil / Einstellungen | Profil, persönliche Einstellungen, Sprache, Hell-/Dunkelmodus, Abmeldung |

**Abgrenzung SERVER:** Das ursprüngliche Pflichtenheft v0.8 schließt die Administration externer Game-/Voice-Server ausdrücklich aus. Die neueren Dashboard-Mock-ups zeigen hingegen administrative Serveraktionen. Dieser **fachliche Konflikt ist offen (OFF-10)**: Die UI-Funktionen sind als Zielanforderung erfasst, aber tatsächliche Remote-Steuerung, Berechtigungen, Integrationsfähigkeiten und Sicherheitsfreigaben müssen vor Implementierung entschieden werden. Keine unbelegte Fernsteuerungsfähigkeit wird zugesagt.

**Designfreiheit:** Hintergrundbilder, Farben und konkrete visuelle Anordnung der Mock-ups sind nicht verbindlich. Funktionalität, responsive Nutzbarkeit, konsistentes Layout und Autorisierungsregeln sind maßgeblich.

**Offene UI-Entscheidung:** Ob Leader Plattform- und Clanverwaltung in einem integrierten Dashboard oder in zwei getrennten Bereichen nutzen, ist noch nicht beschlossen. Beide Varianten müssen dieselben serverseitigen Rechteprüfungen erfüllen.

## 4. Rollen, Berechtigungen und Scopes

**PLATFORM_ACCOUNT ≠ CLAN_MEMBERSHIP ≠ ROLE ≠ PERMISSION ≠ SCOPE ≠ POLICY ≠ LICENCE.**

- Jeder Benutzer hat nach bisherigem Fachstand genau **eine aktive organisatorische Rolle**, kann aber mehreren Teams angehören.
- **SUPPORT_ADMIN:** plattformweiter, stark abgesicherter Recovery-/Supportzugriff, vollständig auditiert.
- **ClanAdmin/Leader:** Clanverwaltung im Rahmen der Lizenz und Sicherheitsbaseline.
- **Subleader/Subadmin:** ausdrücklich zugewiesene clanweite Rechte, begrenzte Delegation.
- **Moderator:** definierte Content-/Kommunikationsrechte, keine generelle Clanleitung.
- **TeamLeader:** definierte Rechte im eigenen Team.
- **Member:** Basisrechte und freigegebene eigene Daten.
- Titel/Badges sind repräsentativ, keine Rechtequelle; maximal ein aktiver Titel, Titelhistorie vorgesehen.
- **Benutzung einer Permission bedeutet nicht Delegationsrecht.** Keine Selbstberechtigung, keine automatische Weitergabe, nicht delegierbare Rechte bleiben gesperrt.
- Jeder geschützte Anwendungsfall prüft Berechtigung **serverseitig**, einschließlich Scope, Mitgliedschaftsstatus, Policy und gegebenenfalls Lizenz. UI-Ausblendung allein schützt nicht.
- Nicht angemeldet: HTTP-401 bei API-Zugriff; angemeldet ohne Berechtigung: HTTP-403. Bei Blazor-Seiten entsprechende sichere Umleitung bzw. Zugriffsverweigerung.

## 5. SECURITY – Accounts, Login, Sessions

### Registrierung und Aufnahme
- Plattformregistrierung mit Benutzername, E-Mail und Passwort; E-Mail-Verifikation.
- Kein Self-Join und keine zentrale Suche/Beitrittsanfrage für bestehende Clans.
- Clanaufnahme durch ClanAdmin oder berechtigten Subleader; TeamLeader darf Aufnahme beantragen, aber nicht selbst abschließend freigeben.
- Einladung → Annahme → gegebenenfalls `PENDING_APPROVAL` → `ACTIVE`; Standardrolle `MEMBER`; Teamzuordnung optional.
- Accountstatus: `PENDING_EMAIL_VERIFICATION`, `ACTIVE`, `LOCKED`, `SUSPENDED`, `DEACTIVATED`.
- Mitgliedschaftsstatus: `INVITED`, `PENDING_APPROVAL`, `ACTIVE`, `REJECTED`, `LEFT`, `REMOVED`; zusätzlich historisch genannte Einladungsschritte sind im Datenmodell zu präzisieren.
- Entfernte Mitglieder benötigen erneute Freigabe.

### Anmeldung und Sicherheitsbaseline
- Login per E-Mail/Passwort; sichere Passwort-Hashes; Login, Logout, Passwort-Reset.
- MFA **verpflichtend** für ClanAdmin, Subleader, Moderator und TeamLeader; für Member optional oder per Clan-Policy verpflichtend.
- Step-up-Authentifizierung bei kritischen Aktionen, insbesondere Rollen/Rechte, Bank-/Finanzdaten, Lizenz und Supportzugriff.
- **Maximal eine aktive Session pro Account**, serverseitig widerrufbar, auch geräteübergreifend.
- Sicherheitsereignisse und relevante Geräte-/Loginmerkmale datenschutzgerecht erfassen; neue Geräte und verdächtige Standorte prüfen; verpflichtende Warnungen und Rate-Limits.
- Cookies mit `HttpOnly`, `Secure` und geeignetem `SameSite`; CSRF-Schutz für zustandsändernde Vorgänge.
- Reset-Token kurzlebig und einmalig; nach **drei fehlgeschlagenen Resetversuchen 15 Minuten Sperre**; nach erfolgreichem Reset bestehende Sessions beenden.
- Recovery-Codes nur einmal verwendbar, nicht im Klartext speichern.
- Geheimnisse, Passwörter, Tokens, Session-IDs und MFA-Secrets nicht im Klartext loggen.

### Clan-Sicherheitsrichtlinien
- `MEMBER_MFA_POLICY`: OPTIONAL / REQUIRED.
- `ACCOUNT_LOCK_AFTER_FAILED_LOGINS`: Default 5; `ACCOUNT_LOCK_DURATION_MINUTES`: Default 30; `FAILED_LOGIN_WINDOW_MINUTES`: Default 15.
- `NEW_DEVICE_ADDITIONAL_CHALLENGE`: Default ON; `SUSPICIOUS_LOCATION_ADDITIONAL_CHALLENGE`: Default ON.
- `SESSION_IDLE_TIMEOUT_MINUTES`: Default 60.
- Nicht abschaltbar: `MAX_ACTIVE_SESSIONS=1`, privilegierte MFA, Sicherheitsbenachrichtigungen, Reset-Rate-Limit, Einmal-Recovery-Codes, Step-up und Security-Audit.
- Clan-Policies dürfen die Plattformbaseline nur verschärfen. Policy-Änderungen erfordern Permission, Grenzprüfung, Step-up und `SECURITY_POLICY_CHANGED`-Audit (Akteur, Clan, alter/neuer Wert, Zeit, Step-up-Status).
- **Wichtig:** Die Sperre nach drei Fehlversuchen betrifft den **Passwort-Reset**; der Standardwert fünf betrifft **fehlgeschlagene Logins**. Dies sind verschiedene Regeln.

## 6. MEMBER und TEAM

- Mitgliederprofile verwalten, lesen, ändern, administrativ deaktivieren/reaktivieren sowie Rollen ändern – jeweils mit passenden Permissions und Scopes.
- Rollenänderungen sind Step-up- und Audit-pflichtig.
- Mehrfach-Teammitgliedschaft zulässig; jedes Team hat genau **einen Teamleiter**.
- Teamnamen und Team-Mitgliederlimits werden durch Anträge und Genehmigungen geändert.
- Teamlogos sind eine gesondert berechtigte administrative Aktion.
- TeamLeader kann Teammitgliedschaften innerhalb des zulässigen Scopes bearbeiten; neue Clanaccounts nur per Antrag/Einladung.
- Warplanner/Organisator kann Teams zugewiesen werden.
- Titelvergabe mit Vergeber, Zeitpunkt und optionalem Grund; TeamLeader nur für eigene Teammitglieder.

## 7. CONTENT, FORUM und CHAT

- Interne und öffentliche News, Ankündigungen, Umfragen, Statusmeldungen; extern auch Changelog/Serverupdates.
- Erstellen und Veröffentlichen sind getrennte Rechte. Workflow: `DRAFT → SUBMITTED → APPROVED/REJECTED → PUBLISHED`; direkte Veröffentlichung nur mit besonderer Permission.
- Forum: öffentlich lesbare Bereiche; Schreibrechte für registrierte Gäste/berechtigte Mitglieder; interne und teamspezifische Bereiche strikt getrennt.
- Moderationsmodi `IMMEDIATE`, `DELAYED`, `APPROVAL_REQUIRED`; Wortfilter, Maskierung, Quarantäne, Spam-Schutz.
- Chat: 1:1, Gruppen-, Clan-, Team- und geschützter Supportchat; eigene Nachrichten bearbeiten, Moderation, Stummschaltung, Soft Delete/Wiederherstellung.
- Keine ungefilterte HTML-/JavaScript-Ausführung in Nutzerinhalten.
- Uploads: serverseitige MIME-, Dateisignatur-, Größen- und Speicherortprüfung; Bilder PNG/WebP/GIF/JPEG, Videos zunächst MP4; AVI später bewerten.

## 8. FINANCE

- Clankasse mit Einnahmen, Ausgaben, Mitgliedsbeiträgen, Spenden, Kategorien und Belegen.
- Bankinformationen (IBAN, BIC, Kontoinhaber) geschützt; verifizierter Kontostand und internes Ledger getrennt.
- Zahlungsstatus `PENDING → CONFIRMED/CANCELLED/FAILED`; Bestätigung erst nach **serverseitig verifiziertem** Zahlungsnachweis.
- Angedachte Zahlungswege (abhängig von Provider): PayPal, Skrill, Überweisung, Kreditkarte, Apple Pay, Google Pay und weitere historisch genannte Verfahren; **keine Anbieterentscheidung getroffen**.
- Bestätigte Buchungen nicht still überschreiben/löschen; Korrektur-/Stornobuchungen mit Audit.
- Kritische Finanzaktionen und Bankdatenänderungen: Step-up, Permission und Audit.
- Belege/Zahlungsbestätigungen als PDF vorgesehen; Aufbewahrungsfristen offen.

## 9. SERVER

- Integration und Statusanzeige, **keine Administration externer Game-/Voice-Server**.
- Beispiele: TeamSpeak, Discord, Mumble, Counter-Strike 2, soweit Schnittstellen vorhanden.
- Capabilities je Integration: STATUS, PLAYER_COUNT, PLAYER_LIST, CURRENT_MAP, USER_LIST, CHANNEL_LIST, JOIN.
- Join per URI/Deep-Link, sonst Verbindungsinformationen.
- Clanweite Sichtbarkeit für feste Clanmitglieder; Verwaltung über gesonderte Permissions.
- API-Schlüssel/Tokens geschützt; zentraler Statuscache und Scheduler, vorgesehener Standardpoll **60 Sekunden**.

## 10. LICENCE

- `STANDARD`: **25 aktive Clanmitgliedschaften**; `UNLIMITED`: keine Slotgrenze.
- Jede aktive Mitgliedschaft zählt unabhängig von der Rolle; Trial nach historischem Whiteboard-Verweis ebenfalls maximal 25 Slots; Dauer/Leistungsumfang offen.
- Upgrade `STANDARD → UNLIMITED`: `PENDING_ACTIVATION`, Aktivierung **erst nach bestätigter Zahlung**.
- Downgrade `UNLIMITED → STANDARD`: `SCHEDULED`, wirksam erst am Ende der bezahlten Unlimited-Periode.
- Bei Downgrade und mehr als 25 aktiven Mitgliedern: **30 Tage Grace Period**; bestehende Mitglieder bleiben nutzbar, neue Aktivierungen gesperrt; Admin erhält Fristwarnung.
- Nach Frist und weiterhin über 25: `SLOT_LIMIT_LOCKED`; Entsperrung durch bestätigtes Upgrade oder Reduktion auf höchstens 25.
- **Keine automatische Löschung oder willkürliche Deaktivierung** beim Downgrade.
- Aktivierung und Slotprüfung müssen transaktional und gegen parallele Anfragen geschützt sein.
- Ausnahmen im Lock, Trial-Zustände, Zahlungsverzug, Refunds und Definition „aktiv“ bleiben offen.

## 11. WARPLANNER, FILE_UPLOAD, NOTIFICATIONS, AUDIT_LOG

- **WARPLANNER:** Match-/Warplanung, Organisation und Teamzuständigkeiten; Detailworkflows noch zu spezifizieren.
- **FILE_UPLOAD:** sichere Speicherung, Dateityp-/Größenkontrolle, Zugriff nach Scope, Schutz vor ausführbarem Inhalt; Limits und Aufbewahrung offen.
- **NOTIFICATIONS:** Benachrichtigungen zu fachlichen Abläufen; Security-Pflichtbenachrichtigungen nicht abschaltbar; Kanäle offen.
- **AUDIT_LOG:** unverfälschte Nachvollziehbarkeit kritischer Aktionen mit Akteur, Aktion, Zeitpunkt, Objekt/Scope und geeignetem Ergebnis; keine Secrets im Klartext; Aufbewahrungsregeln offen.

## 12. Übergreifende Qualitäts- und Abnahmeanforderungen

- Domainregeln unabhängig von UI und Datenbank; serverseitige Statusvalidierung.
- Relationale Datenbank-Constraints, Transaktionen und geeignete Indizes; reproduzierbare EF-Core-Migrationen.
- Unit-Tests für Invarianten, Integrationstests für Auth/Permissions/Sessions/Lizenzen/Transaktionen, E2E-Tests für kritische Abläufe.
- Beispiel-Abnahmefälle: anonyme geschützte API-Anfrage 401; unberechtigte 403; 26. Aktivierung unter STANDARD abgelehnt; Grace Period deterministisch; bestätigtes Upgrade hebt Slotblockade auf; keine Fremdteam-/Fremdinstanz-Datenlecks.
- Logging/Monitoring, Backups, Restore-Tests, sichere Konfiguration und Secret-Management; konkrete Betriebs-SLAs und Grenzwerte noch offen.
- Blazor Interactive Server: Wiederverbindung, Sitzungszustand und Serververbindung im Betrieb berücksichtigen.

## 13. Offene Punkte und Quellenabgleich

**Noch fachlich zu entscheiden:** vollständige Permission-Matrix, Rollen-/Delegationsgrenzen, detaillierte Statusautomaten, exakte Trial-/Lizenzperioden, Zahlungsfehler/Refunds, Lock-Ausnahmezugriffe, Aufbewahrung/Datenschutz, Details für Warplanner/Uploads/Notifications/Audit.

**Noch technisch zu entscheiden:** Hosting, CI/CD, Testframeworks, MFA- und Step-up-Flows, Durchsetzung einer Session, Mail-/Payment-Anbieter, Monitoring und Recovery-Ziele.

**Quellenkonflikt:** Historische v0.7-PDF nennt C++23/Drogon/Angular/PostgreSQL; ältere Markdown-Dateien Next.js/NestJS/Prisma. **Aktuell maßgeblich** sind die akzeptierten .NET-ADRs mit Entscheidungsstand 13.11.2026. Der Wechsel betrifft die Implementierung, nicht die fachlichen Regeln.

**Whiteboard-Vorbehalt:** Das ZIP ist vorhanden, aber nicht vollständig inhaltlich geprüft. Diese Datei ist deshalb eine **konsolidierte Arbeitsfassung**, keine Behauptung vollständiger Whiteboard-Abdeckung. Unbestätigte Details dürfen nicht als abgeschlossen gelten.


## 14. Erstes Lieferziel und Abnahme

### Alpha 0.1 – Anmeldung und geschütztes Plattform-Dashboard

**Ziel:** Eine nachvollziehbare, getestete Anmeldung und ein allgemeines Plattform-Dashboard mit geschützten, kontext- und berechtigungsabhängigen Bereichen. Eine vollständige Umsetzung aller Clanmodule ist nicht Bestandteil von Alpha 0.1. Die bestehende Loginformular-Validierung allein erfüllt dieses Ziel noch nicht.

**Abnahmeszenarien:**
1. Ein gültiger Account kann sich über ASP.NET Core Identity tatsächlich anmelden und wieder abmelden; die Session wird serverseitig geprüft.
2. Ungültige Anmeldedaten führen nicht zu einer Anmeldung; Fehler geben keine Geheimnisse preis.
3. Ein anonymer Benutzer erreicht keine geschützten Daten oder Aktionen; ein angemeldeter Account ohne Clanmitgliedschaft kann die vorgesehenen allgemeinen Plattformfunktionen aufrufen.
4. Eine angemeldete Person ohne Berechtigung erreicht keine geschützten Use Cases, auch nicht durch manipulierte Requests.
5. Ein Passwort-Reset verwendet einen kurzlebigen Einmal-Token; bestehende Sessions werden nach erfolgreichem Reset beendet.
6. Die Begrenzung auf eine aktive Session pro Account wird gesondert implementiert und getestet.
7. Sicherheitsrelevante Vorgänge werden ohne Klartext-Secrets protokolliert.
8. Kritische Aktionen werden erst nach erforderlicher Step-up-Prüfung ausgeführt.
9. Das Dashboard verwendet ein gemeinsames responsives Layout; Navigation und Aktionen respektieren den tatsächlichen Berechtigungskontext.
10. Noch nicht implementierte Clanmodule werden nicht als produktiv nutzbar dargestellt.

**Hinweis:** Welche Teilmenge der vollständigen MFA-/Step-up-/Lizenzregeln bereits in Alpha 0.1 geliefert werden muss, ist im Releaseplan ausdrücklich zu markieren; die Sicherheitsbaseline darf für produktive Freigaben nicht als „später optional“ behandelt werden.

### Weitere überprüfbare Beispiele

- Unter STANDARD wird die **26. aktive Mitgliedschaft** verhindert, auch bei parallelen Aktivierungen.
- Ein bestätigtes Upgrade auf UNLIMITED hebt eine lizenzbedingte Slotblockade auf.
- Nach einem geplanten Downgrade beginnt bei mehr als 25 aktiven Mitgliedern die 30-Tage-Frist; es erfolgt keine automatische Löschung.
- Nach Ablauf der Frist bleibt ein überbelegter Clan gesperrt, soweit nicht ausdrücklich definierte Recovery-Ausnahmen greifen.
- Teambezogene Daten werden nur innerhalb des berechtigten Scopes ausgegeben.
- Eine bestätigte Finanzbuchung wird ausschließlich durch nachvollziehbare Korrektur berichtigt.
- Änderungen der Clan-Sicherheitsrichtlinien können die unveränderliche Baseline nicht unterschreiten.

## 15. Anforderungen an die weitere Spezifikation

Vor der Umsetzung der jeweiligen Domäne werden mindestens die benötigten **Datenmodelle**, **Permission-/Scope-Matrix**, **Statusübergänge**, **Fehlerfälle**, **Testfälle** und **Audit-Ereignisse** präzisiert. Als nächste fachliche Artefakte sind insbesondere vorgesehen:

- Rollen-/Permission-Matrix und Delegationsregeln
- Lizenz-Zustandsautomat mit Trial, Zahlungen, Downgrades und Recovery
- ER-Diagramm mit Account, Mitgliedschaft, Team, Session, Lizenz und Audit
- Threat Model und Sicherheits-/Datenschutzkonzept
- Workflows für Warplanner, Benachrichtigungen und Datei-Uploads
- Abnahme- und Testmatrix sowie Betriebs-/Backup-Konzept

## 16. Nachverfolgung und offene Entscheidungen

| Kennung | Frage | Status |
|---|---|---|
| OFF-01 | Whiteboard-Policies aus 49 HEIC, 1 JPG und 1 PDF vollständig abgleichen | Offen |
| OFF-02 | Rollen-/Permission-Matrix, Delegationsgrenzen und Support-Ausnahmen | Offen |
| OFF-03 | Trial-Laufzeit, Lizenzperioden, Zahlungsfehler und Refunds | Offen |
| OFF-04 | Ausnahmen im Zustand `SLOT_LIMIT_LOCKED` | Offen |
| OFF-05 | Definition einer aktiven Mitgliedschaft und Grace-Period-Reaktivierung | Offen |
| OFF-06 | Datenschutz, Audit-/Finanzaufbewahrung und Löschfristen | Offen |
| OFF-07 | Konkrete MFA-, Step-up- und Ein-Session-Implementierung | Offen |
| OFF-08 | Hosting, Testframeworks, CI/CD, Monitoring, Backup-Ziele | Offen |
| OFF-09 | Detailabnahme für Warplanner, Uploads, Notifications und Audit | Offen |
| OFF-10 | Konflikt SERVER: reine Statusintegration vs. administrative Aktionen im Dashboard-Mock-up | Offen |
| OFF-11 | Leader-Navigation: integrierter oder getrennter Plattform-/Clanbereich | Offen |
| OFF-12 | Vollständige Abnahme- und Berechtigungsmatrix für Dashboard-Aktionen, externe Dateifreigaben und Freundes-/Präsenzfunktionen | Offen |

**Dokumentationsregel:** Keine fachliche Anforderung wird ohne dokumentierte Entscheidung gestrichen oder stillschweigend verändert. Jede Klärung aktualisiert die betroffenen Dokumente und wird bei Architekturbezug in `DECISIONS.md` festgehalten.

## 17. Referenzdokumente

- `Pflichtenheft_v0.7_Cpp_Drogon_Angular.pdf`, inklusive vollständigem historischen v0.6-Anhang
- bisherige `REQUIREMENTS.md`
- `ARCHITECTURE.md` und `DECISIONS.md` (Stand 12.11.2026)
- `README.md` und `MILESTONES.md` als Projekt- und Planungsreferenzen
- `ScreenshotsClanIntern(1).zip` – **inhaltliche Vollprüfung ausstehend**

**Änderungshinweis v0.9:** Alle bisherigen Fachabschnitte bleiben erhalten. Die ergänzten Dashboard-Funktionen sind Zielumfang, nicht Nachweis der Implementierung. Die Whiteboard-Vollprüfung und offene Konfliktentscheidungen bleiben ausdrücklich ausstehend.

**Ende Pflichtenheft v0.9 – Entwurf.**
