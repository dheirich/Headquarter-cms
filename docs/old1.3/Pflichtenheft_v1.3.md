# Pflichtenheft_v1.3 – Headquarter / ClanIntern v1.3

**Stand:** 22.11.2026 · **Dokumentationsversion:** 1.3 · **Produkt:** Headquarter / ClanIntern

**Geltung:** Diese Datei ersetzt die bisherige gleichnamige Projektdokumentation. Bestehende bestätigte Fachbeschlüsse bleiben erhalten. Wo ältere, im übernommenen Quelltext enthaltene Angaben abweichen, gelten die ausdrücklich bestätigten Beschlüsse vom 16.11.2026 und die nachfolgende v1.3-Fortschreibung. Die Dokumentationsversion ist keine Software-Release-Version.

**Nachweisgrenze:** Der Implementierungsstatus beruht auf dem gemeinsam besprochenen Entwicklungsstand, nicht auf einem vollständigen aktuellen Repository-, CI- oder Testlauf. Nicht nachgewiesene Funktionen sind als offen zu behandeln.

## v1.3 – Geltungsstand und Abnahme

Dieses Pflichtenheft enthält weiterhin die bereits bestätigten Zielanforderungen einschließlich der Entscheidungen zu Mitgliedschaft, Lizenzen, Sicherheit, Forum, Chat, Team, Finanzen, Warplanner und Serverintegration. v1.3 ändert diese Regeln nicht durch bloße Umnummerierung.

**Technischer Zwischenstand:** ASP.NET Core Identity und PostgreSQL wurden lokal verwendet, der Login wurde im Entwicklungsprozess manuell geprüft; Dashboard und Sidebar sind in Arbeit. Logout, vollständige Autorisierung, automatisierte Sicherheits-/Integrationstests und Alpha-0.1-Abnahme sind nicht vollständig nachgewiesen.

**Konsolidierungsbedarf:** Einzelne ältere Abschnitte des übernommenen Fachbestands tragen historische Versionsangaben und frühere Prüfvermerke. Bei Konflikten gelten ausdrücklich bestätigte neuere Beschlüsse. Die vollständige Permission-/Scope-Matrix, Lizenz-Zustands-/Aktionsmatrix, Datenschutz-/Retention-Details und abnahmefähige Tests bleiben technische Arbeitspakete; die fachliche Freigabe wird nicht vorgetäuscht.

---

## Konsolidierter bestehender Fach- und Architekturstand


**Stand: 16.11.2026 · Status: fachlich beschlossene Ergänzungen, technische Detailfreigabe teilweise offen.**

## Konsolidierungsbeschlüsse vom 16.11.2026 (Zielstand v1.2)

**Vorrang:** Die folgenden ausdrücklich bestätigten Beschlüsse ersetzen widersprechende ältere Entwurfsstellen. Ältere Versionsangaben im übernommenen Quelltext sind historisch und nicht der Versionskopf dieser Datei. Diese Fassung beschreibt **Soll-Anforderungen**, keine implementierten Funktionen.

- **Serverintegration (OFF-10):** Verbindlich sind lesende Statusinformationen, Spieler-/Benutzerlisten, Channels und Join-Links, soweit externe APIs dies erlauben. Neustart, Shutdown, Backup und sonstige Remote-Administration sind **nicht** Bestandteil von v1.2; als späteres Erweiterungsvorhaben dokumentieren.
- **Aufnahme:** Neue Clanmitgliedschaften benötigen die nicht abschaltbare Freigabe des Clanleaders. Eine vom Clanleader persönlich versandte Einladung gilt bereits als Freigabe; Annahme und serverseitige Lizenz-/Slot-/Sicherheitsprüfung bleiben Pflicht. Berechtigte andere Rollen dürfen Einladungen anstoßen, aber nicht abschließend genehmigen. Kein Self-Join.
- **Permission-Matrix:** Die vollständige Liste aus den Whiteboard-Einzelprotokollen ist als verbindlicher Spezifikationsumfang festgelegt, einschließlich individueller Permission-Codes, Scope (Plattform/Clan/Team/eigene Daten), delegierbarer Rollen, Step-up und Audit. Die **Einzelmatrix ist noch nicht vollständig in dieser Fassung ausformuliert**; keine pauschale Freigabe oder Implementierungsreife daraus ableiten.
- **Clan-Onboarding:** Bei Verbindungsabbruch kann ein noch nicht abgeschlossener Gründungsentwurf innerhalb von **30 Minuten** sicher wiederaufgenommen werden. Erneuter Abbruch startet eine neue Frist; expliziter Logout verwirft den Entwurf. Diese Frist ist unabhängig vom allgemeinen Session-Idle-Timeout (historischer Default 60 Minuten).
- **Sieben Lizenzkorrekturen:** `LICENCE-038–041` und `LICENCE-054–056` gelten fachlich als bestätigt. Der ausformulierte Wortlaut steht in der beigefügten `Pflichtenheft_v1.2.md` (aus der Korrekturfassung übernommen); andere Dokumente verweisen darauf, statt die Regeln zu verkürzen.
- **Trial:** Sieben Tage bleiben vollständig erhalten, auch bei vorheriger Bezahlung. Die bezahlte Periode beginnt erst nach Trial-Ende (`SCHEDULED` bis dahin).
- **Slots:** STANDARD und TRIAL höchstens 25 aktive Clanmitgliedschaften; UNLIMITED ohne Limit. Bei Downgrade gilt die 30-tägige Schonfrist erst ab tatsächlichem STANDARD-Wechsel. Einladungen trotz voller Slots möglich, Aktivierung nur unter 25 oder nach wirksamer UNLIMITED-Freischaltung. `PAYMENT_OVERDUE_LOCKED` ist eine eigenständige strengere Sperre.
- **Einladungen:** Ablauf 7/14/30 Kalendertage (Default 14), nur für neue Einladungen geänderte Policy; Resend-Default 24 Stunden und höchstens drei Wiederholungen zusätzlich zum Erstversand, ohne Verlängerung des ursprünglichen Ablaufs. Sichere konfigurierbare Grenzwerte sind noch zu definieren.
- **Wiederbeitritt:** `ALLOWED`, `APPROVAL_REQUIRED` (Default: Clanleader) oder `BLOCKED`; frühere Rollen/Rechte werden nicht automatisch wiederhergestellt.
- **Forum:** Sichtbarkeit von Kategorien und Beiträgen durch Clanleader oder ausdrücklich delegierten Subleader; Audit und sofortige Benachrichtigung betroffener Rollen. Teamleader sehen standardmäßig nur eigene Teambereiche.
- **Delegation:** Subleader dürfen delegierte Rechte nicht weiterdelegieren; Rechte können unbefristet oder befristet sein, sofort widerrufen werden, 24-Stunden-Vorwarnung vor Ablauf und Ablaufbenachrichtigung; serverseitige Neubewertung vor Abschluss kritischer Aktionen.
- **Inaktivität:** `DISABLED`, `WARN_ONLY` (Default) oder `AUTO_LOCK` mit vorheriger Warnung. Konkrete Fristen und Entsperrprozess bleiben offen.

**Restpunkte für technische Abnahme:** Vollständige Permission-/Scope-Matrix aus den Bildprotokollen, Lizenz-Zustands-/Aktionsmatrix einschließlich aller sieben Korrekturtexte in Tests, konfigurierbare Grenzen, Datenaufbewahrung, Inaktivitätsdetails, Abnahmefälle und fehlende historische Quellen. Die 50 Bilder wurden in Einzelprotokollen behandelt; dies ersetzt keine regelweise Freigabe aller Implementierungsdetails.

---

## Übernommener Ausgangsstand (historische Metadaten beachten)

> **v1.0 – Konsolidierungsstand 15.11.2026:** Vorheriger v0.9-Fachbestand erhalten. Neue Lizenz-/Supportbeschlüsse sind als dokumentierte Zielanforderungen ergänzt, **nicht** als bereits implementiert. Die sieben bislang offenen Regelpositionen LICENCE-038 bis 041 und LICENCE-054 bis 056 wurden anhand der dokumentierten Gesprächsbeschlüsse als fachliche Korrekturfassung ergänzt. Wortlautabgleich mit einem vollständigen Originaltranskript und Whiteboard-Vollprüfung stehen noch aus; keine formale Endfreigabe.

# Headquarter / ClanIntern – Pflichtenheft v1.0

**Version:** 1.0 · **Datum:** 15.11.2026
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

**Noch fachlich zu entscheiden bzw. abzugleichen:** vollständige Permission-Matrix, Rollen-/Delegationsgrenzen, detaillierte Statusautomaten, über LICENCE-001–056 hinausgehende Lizenz- und Zahlungsdetails, Lock-Ausnahmezugriffe, sonstige Aufbewahrung/Datenschutz, Details für Warplanner/Uploads/Notifications/Audit. Die bestätigten Refund- und Supportregeln LICENCE-038–056 sind nicht mehr pauschal offen.

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
| OFF-03 | Trial-Laufzeit und Refund-Grundregeln durch LICENCE-001–056 ergänzt; verbleibende Anbieter-/Integrationsdetails | Teilweise geklärt |
| OFF-04 | Ausnahmen im Zustand `SLOT_LIMIT_LOCKED` | Offen |
| OFF-05 | Definition einer aktiven Mitgliedschaft und Grace-Period-Reaktivierung | Offen |
| OFF-06 | Ticketanhanglöschung durch LICENCE-051–053 geregelt; übrige Datenschutz-, Audit-/Finanzaufbewahrung offen | Teilweise geklärt |
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

**Ende des übernommenen v0.9-Fachbestands; Ergänzungen v1.0 folgen.**

---

## v1.0 – Lizenz-, Zahlungs- und Supportregelwerk
Die nachfolgenden Regeln ergänzen den historischen Fachbestand. Bei Abweichungen ist eine ausdrückliche Fachentscheidung erforderlich; keine stillschweigende Löschung historischer Anforderungen.

### Lizenz und Mitgliedergrenzen
STANDARD und TRIAL: höchstens 25 ACTIVE-Mitglieder einschließlich Leader. Einladungen dürfen darüber hinaus vorgemerkt werden; Aktivierungen sind gesperrt, bis ein Slot frei ist. UNLIMITED ist erst nach bestätigter Zahlung aktiv. Ein Downgrade mit Überschreitung erhält 30 Kalendertage Schonfrist und führt andernfalls zu `SLOT_LIMIT_LOCKED`, ohne automatische Mitgliedslöschung.

### Trial und Datenlebenszyklus
Sieben Kalendertage Trial; nach Ablauf fünf Werktage Antwortfrist auf eine Bestätigungsmail, anschließend 14 Kalendertage Löschfenster. Rechtzeitige Bestätigung verhindert Löschung, verlängert jedoch keine Nutzungslizenz. Vor Löschung sämtliche Voraussetzungen und ein vollständiges verschlüsseltes Backup prüfen. Backups grundsätzlich höchstens 30 Kalendertage aufbewahren; Restore nur mit Identitätsprüfung, ausdrücklicher Adminfreigabe und abschließender Integritätsprüfung.

### Zahlung und Benachrichtigungen
Bei fehlgeschlagener Verlängerung sieben Kalendertage Schonfrist; anschließend `PAYMENT_OVERDUE_LOCKED`, bis eine verifizierte Zahlung vorliegt. Keine Verzugsgebühren. Benachrichtigungen über erlaubte Kanäle mit dokumentierten Versuchen. Doppelte oder widersprüchliche Zahlungsvorgänge werden überprüft und gegebenenfalls als HIGH-Supportfall behandelt.

### Support
Eigenständiges Modul `SUPPORT_TICKET`; zugänglich auch unter Lizenzsperren. Ein Ticket je Sachverhalt, wiedereröffnen statt duplizieren. HIGH-Tickets: qualifizierte menschliche Erstreaktion innerhalb drei Werktagen. Abschlussbestätigung mit sicherem Link und Erinnerungs-/Klärungsprozess. Maximal zehn Anhänge à 25 MB, grundsätzlich Löschung 14 Tage nach Upload, Ankündigung 24 Stunden vorher, Löschmetadaten im Verlauf.

### Detaillierte Beschlüsse und Prüflücken
## Lizenz- und Support-Regelregister (v1.0)

- **LICENCE-001** — STANDARD: maximal 25 aktive Clanmitgliedschaften einschließlich Leader; mehrere Teams zählen einmal.
- **LICENCE-002** — Nur Mitgliedschaften mit Status ACTIVE verbrauchen einen Slot.
- **LICENCE-003** — Austritt/Deaktivierung gibt Slot sofort frei; Reaktivierung prüft Limit erneut.
- **LICENCE-004** — Einladungen bei vollem Limit erlaubt; Aktivierung bis freiem Slot blockiert, transaktional abgesichert.
- **LICENCE-005** — UNLIMITED→STANDARD am Periodenende; bei mehr als 25 ACTIVE 30 Kalendertage Schonfrist, keine neuen Aktivierungen, keine automatische Entfernung.
- **LICENCE-006** — Nach Schonfrist bei Überschreitung SLOT_LIMIT_LOCKED; Leader darf Slots/Lizenz verwalten, Daten bleiben erhalten.
- **LICENCE-007** — STANDARD→UNLIMITED erst nach serverseitig bestätigter Zahlung aktivieren.
- **LICENCE-008** — TRIAL sieben Kalendertage, höchstens 25 ACTIVE; danach E-Mail mit Bestätigungslink, fünf Werktage Antwortfrist, anschließend 14 Kalendertage Löschfenster.
- **LICENCE-009** — Rechtzeitige Bestätigung stoppt Löschung, verlängert aber Trial nicht; ohne bezahlte Lizenz nur eingeschränkte Verwaltung.
- **LICENCE-010** — Nach Clanlöschung Plattformaccount des Leaders 90 Kalendertage behalten; Login/Rückmeldung verhindert automatische Deaktivierung.
- **LICENCE-011** — Werktage: Montag–Freitag außer bundeseinheitlichen Feiertagen in Deutschland, Zeitzone Europe/Berlin.
- **LICENCE-012** — Wesentliche Lizenzzustandswechsel auditieren, keine Secrets protokollieren.
- **LICENCE-013** — Persistenter PostgreSQL-Job-Scheduler im Fünf-Minuten-Takt, idempotent und auditierbar.
- **LICENCE-014** — Fehlgeschlagene Jobs maximal drei Wiederholungen; Benachrichtigungsfehler dürfen keine vorzeitige Löschung auslösen.
- **LICENCE-015** — Wiederholungen nach 5 Minuten, 1 Stunde und 24 Stunden.
- **LICENCE-016** — Dauerhaft fehlgeschlagene kritische Jobs FAILED_REQUIRES_REVIEW; manueller Neustart nur autorisiert, geprüft und auditiert.
- **LICENCE-017** — Kritische Jobfehler im Admin-Dashboard, per E-Mail und bei verifizierter Nummer per SMS melden.
- **LICENCE-018** — Nicht bearbeitete kritische Fehler nach 24 Stunden eskalieren.
- **LICENCE-019** — Unmittelbar vor irreversibler Clanlöschung sämtliche Fristen, Bestätigungen, Zahlungen, Sperren und Incidents erneut prüfen.
- **LICENCE-020** — Clanlöschung nur nach vollständigem, integritätsgeprüftem Backup.
- **LICENCE-021** — Löschbackup verschlüsselt und zugriffsgeschützt, grundsätzlich höchstens 30 Kalendertage aufbewahren.
- **LICENCE-022** — Wiederherstellung nur nach dokumentierter Anfrage des ursprünglichen Leaders und ausdrücklicher Adminfreigabe; keine automatische Lizenzwiederherstellung.
- **LICENCE-023** — Während Restore RESTORING; Normalbetrieb erst nach vollständiger Validierung.
- **LICENCE-024** — Maximal ein gleichzeitiger Restore je Clan; Duplikate zusammenführen, Wiederanlauf nach Review.
- **LICENCE-025** — Restore validiert Relationen, Mitgliedschaften, Rollen, Rechte, Lizenz und Duplikate.
- **LICENCE-026** — Bei fehlgeschlagener automatischer Verlängerungszahlung sieben Kalendertage Zahlungsfrist mit bestehender Nutzung.
- **LICENCE-027** — Nach sieben Tagen ohne bestätigte Zahlung PAYMENT_OVERDUE_LOCKED; Daten erhalten, Lizenz-/Zahlungsverwaltung zugänglich.
- **LICENCE-028** — Während PAYMENT_OVERDUE_LOCKED Einladungen und Aktivierungen blockieren; Deaktivierung erlaubt.
- **LICENCE-029** — Vor Ende der Zahlungsfrist mindestens eine Warn-E-Mail.
- **LICENCE-030** — Am vorletzten Tag der Zahlungsfrist zusätzliche Erinnerung.
- **LICENCE-031** — Bei Zahlungsproblemen E-Mail, SMS und rechtlich zulässiges WhatsApp; verifizierte E-Mail und erreichbare verifizierte Mobilnummer verpflichtend, WhatsApp nur mit erforderlicher Einwilligung.
- **LICENCE-032** — Bei PAYMENT_OVERDUE_LOCKED keine externen Turnier-/Matchanmeldungen.
- **LICENCE-033** — Bestätigte Zahlung hebt Zahlungssperre nur für die Zukunft auf, andere Sperren bleiben unabhängig.
- **LICENCE-034** — Widersprüchliche Zahlungsbestätigungen: kein automatisches Entsperren, Adminprüfung.
- **LICENCE-035** — Keine Verzugszinsen oder Mahngebühren nach aktuellem Beschluss.
- **LICENCE-036** — Idempotente Zahlungsreferenzen gegen Doppelabbuchung; Verdachtsfall erzeugt HIGH-Supportticket; separates Fachmodul SUPPORT_TICKET, unter Lizenzsperren erreichbar.
- **LICENCE-037** — Erste qualifizierte menschliche Antwort auf HIGH-Zahlungsticket binnen drei Werktagen, sonst Eskalation.
- **LICENCE-038** — HIGH-Zahlungsticket: Fehlt binnen drei Werktagen eine qualifizierte menschliche Erstreaktion, automatische Eskalation an die Plattformadministration und Benachrichtigung des Leaders über verifizierte Kanäle ohne vertrauliche Ticketdetails; Audit. Die Frist betrifft die Erstreaktion, nicht die Lösung.
- **LICENCE-039** — Für HIGH-Zahlungstickets ist innerhalb von sieben Werktagen eine abschließende Entscheidung vorgesehen. Bei Fristüberschreitung automatische Eskalation und Benachrichtigung des Leaders ohne vertrauliche Details; Audit.
- **LICENCE-040** — Bei Zahlungsproblemen verpflichtend im Dashboard und per E-Mail vor parallelen bzw. erneuten Zahlungsversuchen warnen; Versand und Anzeige auditieren.
- **LICENCE-041** — Jeder abgeschlossene Zahlungssupportfall erhält eine verpflichtende, datensparsame Ergebnis-/Abschlusszusammenfassung; Bereitstellung und Kenntnisnahme-/Bestätigungsstatus werden nachvollziehbar erfasst.
- **LICENCE-042** — Ticketabschluss per E-Mail mit sicherem einmaligem zeitbegrenztem Bestätigungslink; fehlende Bestätigung bedeutet keine Zustimmung.
- **LICENCE-043** — Bestätigungsfrist 24 Stunden; Erinnerungen nach 24 und 48 Stunden; nach 72 Stunden Klärungsfall ohne fingierte Zustimmung.
- **LICENCE-044** — Klärungsfall nach 72 Stunden automatisch HIGH.
- **LICENCE-045** — Auf HIGH-Klärungsfall erste qualifizierte Antwort binnen drei Werktagen, sonst Eskalation.
- **LICENCE-046** — Leader darf offene Tickets um Nachrichten und sichere Anhänge ergänzen.
- **LICENCE-047** — Maximal 25 MB pro Ticketanhang.
- **LICENCE-048** — Genau ein Ticket pro Sachverhalt; bei Klärungsfall dasselbe Ticket wieder öffnen, nicht duplizieren.
- **LICENCE-049** — Neue Rückfrage zu gleichem Sachverhalt öffnet geschlossenes Ticket erneut.
- **LICENCE-050** — Maximal zehn Anhänge pro Ticket.
- **LICENCE-051** — Jeden Ticketanhang 14 Kalendertage nach Upload automatisch löschen, vorbehaltlich rechtmäßiger Aufbewahrung/Beweissicherung.
- **LICENCE-052** — Leader 24 Stunden vor Anhanglöschung über zulässige Kanäle benachrichtigen.
- **LICENCE-053** — Anhanglöschung im Ticketverlauf mit Dateiname, Uploadzeitpunkt, Löschzeitpunkt und Grund dokumentieren.
- **LICENCE-054** — Nach vom Zahlungsanbieter bestätigter vollständiger Rückerstattung die betroffene Lizenz automatisch einschränken; Clan-Daten erhalten, Lizenzverwaltung und Support weiter zugänglich lassen, keine automatische Löschung; Zustandswechsel auditieren.
- **LICENCE-055** — Eine bestätigte teilweise Rückerstattung verändert den Lizenzstatus nicht; Rückerstattung mit der Zahlung verknüpfen und auditieren. Bei Widersprüchen Supportfall im bestehenden Sachverhalts-Ticket eröffnen bzw. wiederaufnehmen; nur vollständige Rückerstattung löst LICENCE-054 aus.
- **LICENCE-056** — Bei technisch fehlgeschlagener oder unklarer Rückerstattung bleibt der Lizenzstatus unverändert, bis der Anbieter die Rückerstattung bestätigt. Automatisch einen HIGH-Supportfall im sachverhaltsbezogenen Ticket anlegen bzw. wiederöffnen; Leader sieht Status, Support wird benachrichtigt; Audit und Idempotenz verhindern doppelte Rückerstattungen und Lizenzübergänge.

**Prüfvermerk (Korrekturfassung):** Alle 56 Regelpositionen besitzen nun einen inhaltlichen Eintrag; sieben zuvor offene Positionen (038–041, 054–056) sind aus dem dokumentierten Gesprächsstand rekonstruiert. Das frühere Prüfergebnis „48 / acht offen“ war mit den sieben tatsächlich markierten Positionen unvereinbar. Eine wortgetreue Verifikation der sieben Positionen gegen das vollständige Originalprotokoll sowie die Whiteboard-Einzelbildprüfung bleiben ausstehend. Keine automatische fachliche Endfreigabe.


### Korrekturvermerk 15.11.2026

Die Regeln LICENCE-038–041 und LICENCE-054–056 wurden inhaltlich ergänzt. Die Kurzfassungen LICENCE-001–037 und LICENCE-042–053 bleiben unverändert; ihre Wortlauttreue zum Originalgespräch wurde hier nicht erneut bestätigt. Die fachlichen Aussagen des übernommenen v0.9-Teils zu noch offenen Refunds, Trial-Laufzeit und Ticketanhangfristen werden durch die konkreten Regeln des v1.0-Registers präzisiert. Andere offene Projektentscheidungen bleiben offen.

---

## v1.2 – verbindliche Fortschreibung vom 16.11.2026


### Verbindliche Konsolidierungsregeln (Beschlussstand 16.11.2026)

- **Status:** Die folgenden Punkte sind **beschlossene Zielanforderungen**, keine Implementierungsnachweise. Ein abgeschlossenes Alpha 0.1 ist nicht belegt.
- **Autorisierung:** Jede geschützte Aktion prüft serverseitig Account, aktuelle Mitgliedschaft, Rolle, Permission, Scope, Policy und Lizenz. Widerrufe wirken sofort, auch bei offenen Dashboards; Exporte und Downloads erfordern dieselbe Autorisierung. Teamleader ist eine teambezogene Funktion, keine eigenständige organisatorische Rolle. Genau ein Clanleader; Subleader dürfen delegierte Rechte nicht weiterdelegieren.
- **Aufnahme:** Nur Clanleader erteilt die finale Mitgliedsfreigabe. Direkt vom Leader initiierte Einladungen gelten als vorab freigegeben, bleiben aber an Sicherheits- und Slotprüfung gebunden. Einladung 7/14/30 Tage (Standard 14), höchstens drei Resends, Cooldown 12/24/48/72 Stunden (Standard 24), ohne Fristverlängerung. Wiederbeitritt ALLOWED/APPROVAL_REQUIRED (Standard)/BLOCKED, ohne automatische Rollenrückgabe.
- **Inaktivität:** DISABLED/WARN_ONLY (Standard)/AUTO_LOCK, Schwelle Standard 90 Tage und 30–365 konfigurierbar, Vorwarnung Standard 10 Tage. Nur echte Benutzeraktivität zählt. Gesperrte Mitglieder bleiben ACTIVE und belegen einen Slot. Entsperrantrag im eingeschränkten Dashboard, genau einer offen, 24 Stunden Cooldown; Freigabe Leader oder delegierter Subleader, Audit und neue Aktivitätsfrist.
- **Sicherheit:** Privilegierte Rollen und Teamleader MFA-pflichtig, normale Mitglieder optional oder per Clanregel verpflichtend; TOTP plus Einmal-Recovery-Codes, SMS nicht allein. Maximal eine aktive Session; Step-up für kritische Aktionen. 5 fehlgeschlagene Logins in 15 Minuten führen zu 30 Minuten Sperre; 3 fehlgeschlagene Resetversuche in 15 Minuten zu 15 Minuten Cooldown. Reset als gesicherter Selfservice ohne pauschale Leader-Freigabe; risikobasierte Geräte-/Standort-Challenges; obligatorische Sicherheitswarnungen. Passwörter, MFA-Secrets und Zahlungsgeheimnisse niemals in Audits speichern.
- **Lizenz:** 7 Tage Trial einmal je Account; STANDARD/TRIAL 25 ACTIVE-Mitglieder einschließlich Leader; UNLIMITED unbegrenzt. Bezahlte Laufzeiten 30/90/180/360 Tage, nur nach serverseitig verifizierter Zahlung. Kauf während Trial wird SCHEDULED und startet nach Trialende; Renewal nach aktueller Paid-Periode. STANDARD→UNLIMITED hebt Slotlimit unmittelbar auf ohne Verlängerung des bisherigen Ablaufs. UNLIMITED→STANDARD erst zum Periodenende; bei >25 Mitgliedern 30 Tage Schonfrist, danach SLOT_LIMIT_LOCKED; keine automatische Löschung. SLOT_LIMIT_LOCKED lässt Einladungen und Annahmen zu, blockiert Aktivierung; PAYMENT_OVERDUE_LOCKED blockiert neue Einladungen und Aktivierungen. EXPIRED ermöglicht Account-/Zahlungs-/Support-/Exportfunktionen, sperrt Clanaktionen. Lizenzperioden getrennt speichern, Providerereignisse idempotent, parallele Slotbelegung transaktional absichern.
- **Onboarding:** Clangründung nur nach verifizierter Lizenz. 30 Minuten serverseitig gesicherte Wiederaufnahme nach Verbindungsabbruch, bei neuem Abbruch neuer Fristbeginn, expliziter Logout verwirft Entwurf; Session-Idle separat 60 Minuten. Ein unvollständiger Entwurf ist kein gegründeter Clan.
- **Clan-Sichtbarkeit:** PUBLIC/INTERNAL/HIDDEN pro Feld; allgemeine Stammdaten standardmäßig PUBLIC, Member-/Team-/Serverlisten INTERNAL, Kontakt-E-Mail HIDDEN; persönliche Privatsphäre hat Vorrang. Zehn separate Clan-Settings-Update-Permissions; sensible Änderungen mit Step-up/Audit, Theme-Änderung mit Audit ohne Step-up; Links und Kontakt separat autorisieren.
- **Content/Kommunikation:** Erstellen/Veröffentlichen trennen; Freigabe/Ablehnung von News begründen; optional Vier-Augen-Freigabe für sensible Publikationen. Forum- und Chat-Scope einschließlich Teamgrenzen serverseitig prüfen; Moderation auditieren, Soft-Delete und Restore. Umfragen mit Start/Ende, Wahlmodus vor Veröffentlichung fixiert und getrennten Create/Publish/Close/Evaluate-Rechten. Sicherheitsbenachrichtigungen verpflichtend, optionale nach Kanal/Kategorie; Zustellung persistent, begrenzte Retries ohne Duplikataktionen, sensible Daten nicht in E-Mail-Vorschauen.
- **Finanzen:** Beiträge, Spenden, sonstige Einnahmen und Ausgaben getrennt; Belegupload bestätigt keine Zahlung. Bestätigte Ledgerbuchungen nur durch Gegenbuchung korrigieren, unzugeordnete Zahlungen manuell prüfen; internes Ledger ist kein verifizierter Bankkontostand. Bankdaten nur Leader/autorisiertem Finanz-Subleader mit Step-up/Audit; separate Berechtigungen für Saldo, Transaktionen, Bestätigung, Belege, Bank und Auszahlung. Auszahlungen über konfigurierbarer Schwelle mit zweiter Freigabe. PDF-Belege mit Clan, Zahler, Empfänger, Betrag, Währung, Zeit, Kategorie, Status und Referenz.
- **Warplanner:** Match DRAFT→PLANNED→CONFIRMED→COMPLETED oder CANCELLED mit validierten Übergängen; RSVP YES/MAYBE/NO und Deadline. Matchdaten umfassen Spiel, Teams, Gegner, Termin/Zeitzone, Organisator. Änderungen nach RSVP-Deadline erfordern Organisatorfreigabe; wesentliche Änderungen werden protokolliert und gemeldet. Historie nach Retention-Policy erhalten.
- **SERVER v1.2:** Nur Status, Spieler, Kanäle, Join; kein Remote-Restart, Shutdown oder Backup. Serververwaltung Leader/delegierter Subleader. Secrets geschützt, keine Klartext-Logs.
- **Datenschutz/Betrieb:** Eigene personenbezogene Daten exportierbar; Leader nur berechtigte Clan-Stammdaten. Löschung berücksichtigt Aufbewahrung, Verpflichtungen, Mitgliedschaft und Leader-Transfer; getrennte Retention für Chat, Forum, Audit, Finanzen, Uploads. Backups dürfen gelöschte Daten nicht unbeabsichtigt wiederherstellen. Malware-Scan und Quoten für Uploads; kritische Jobs mit Retry-Limits und manuellem Prüfpfad; Restore-Tests, Monitoring, Secret-Management, vorgetestete Migrationen und Security-/Permission-/Integrationstests als Produktions-Gates.

**Vollständige Entscheidungsdetails und Ausnahmen:** `ENTSCHEIDUNGSBACKUP_VOLLSTAENDIG.md`. Die vorstehenden Regeln ersetzen ältere widersprechende Aussagen. Historische Abschnitte bleiben als Quellenbestand erhalten; sie sind bei Widerspruch nicht mehr normativ.

## Anlage: überlieferte Korrekturfassung LICENCE-038–041 und 054–056

> **v1.0 – Konsolidierungsstand 15.11.2026:** Vorheriger v0.9-Fachbestand erhalten. Neue Lizenz-/Supportbeschlüsse sind als dokumentierte Zielanforderungen ergänzt, **nicht** als bereits implementiert. Die sieben bislang offenen Regelpositionen LICENCE-038 bis 041 und LICENCE-054 bis 056 wurden anhand der dokumentierten Gesprächsbeschlüsse als fachliche Korrekturfassung ergänzt. Wortlautabgleich mit einem vollständigen Originaltranskript und Whiteboard-Vollprüfung stehen noch aus; keine formale Endfreigabe.

# Headquarter / ClanIntern – Pflichtenheft v1.0

**Version:** 1.0 · **Datum:** 15.11.2026
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

**Noch fachlich zu entscheiden bzw. abzugleichen:** vollständige Permission-Matrix, Rollen-/Delegationsgrenzen, detaillierte Statusautomaten, über LICENCE-001–056 hinausgehende Lizenz- und Zahlungsdetails, Lock-Ausnahmezugriffe, sonstige Aufbewahrung/Datenschutz, Details für Warplanner/Uploads/Notifications/Audit. Die bestätigten Refund- und Supportregeln LICENCE-038–056 sind nicht mehr pauschal offen.

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
| OFF-03 | Trial-Laufzeit und Refund-Grundregeln durch LICENCE-001–056 ergänzt; verbleibende Anbieter-/Integrationsdetails | Teilweise geklärt |
| OFF-04 | Ausnahmen im Zustand `SLOT_LIMIT_LOCKED` | Offen |
| OFF-05 | Definition einer aktiven Mitgliedschaft und Grace-Period-Reaktivierung | Offen |
| OFF-06 | Ticketanhanglöschung durch LICENCE-051–053 geregelt; übrige Datenschutz-, Audit-/Finanzaufbewahrung offen | Teilweise geklärt |
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

**Ende des übernommenen v0.9-Fachbestands; Ergänzungen v1.0 folgen.**

---

## v1.0 – Lizenz-, Zahlungs- und Supportregelwerk
Die nachfolgenden Regeln ergänzen den historischen Fachbestand. Bei Abweichungen ist eine ausdrückliche Fachentscheidung erforderlich; keine stillschweigende Löschung historischer Anforderungen.

### Lizenz und Mitgliedergrenzen
STANDARD und TRIAL: höchstens 25 ACTIVE-Mitglieder einschließlich Leader. Einladungen dürfen darüber hinaus vorgemerkt werden; Aktivierungen sind gesperrt, bis ein Slot frei ist. UNLIMITED ist erst nach bestätigter Zahlung aktiv. Ein Downgrade mit Überschreitung erhält 30 Kalendertage Schonfrist und führt andernfalls zu `SLOT_LIMIT_LOCKED`, ohne automatische Mitgliedslöschung.

### Trial und Datenlebenszyklus
Sieben Kalendertage Trial; nach Ablauf fünf Werktage Antwortfrist auf eine Bestätigungsmail, anschließend 14 Kalendertage Löschfenster. Rechtzeitige Bestätigung verhindert Löschung, verlängert jedoch keine Nutzungslizenz. Vor Löschung sämtliche Voraussetzungen und ein vollständiges verschlüsseltes Backup prüfen. Backups grundsätzlich höchstens 30 Kalendertage aufbewahren; Restore nur mit Identitätsprüfung, ausdrücklicher Adminfreigabe und abschließender Integritätsprüfung.

### Zahlung und Benachrichtigungen
Bei fehlgeschlagener Verlängerung sieben Kalendertage Schonfrist; anschließend `PAYMENT_OVERDUE_LOCKED`, bis eine verifizierte Zahlung vorliegt. Keine Verzugsgebühren. Benachrichtigungen über erlaubte Kanäle mit dokumentierten Versuchen. Doppelte oder widersprüchliche Zahlungsvorgänge werden überprüft und gegebenenfalls als HIGH-Supportfall behandelt.

### Support
Eigenständiges Modul `SUPPORT_TICKET`; zugänglich auch unter Lizenzsperren. Ein Ticket je Sachverhalt, wiedereröffnen statt duplizieren. HIGH-Tickets: qualifizierte menschliche Erstreaktion innerhalb drei Werktagen. Abschlussbestätigung mit sicherem Link und Erinnerungs-/Klärungsprozess. Maximal zehn Anhänge à 25 MB, grundsätzlich Löschung 14 Tage nach Upload, Ankündigung 24 Stunden vorher, Löschmetadaten im Verlauf.

### Detaillierte Beschlüsse und Prüflücken
## Lizenz- und Support-Regelregister (v1.0)

- **LICENCE-001** — STANDARD: maximal 25 aktive Clanmitgliedschaften einschließlich Leader; mehrere Teams zählen einmal.
- **LICENCE-002** — Nur Mitgliedschaften mit Status ACTIVE verbrauchen einen Slot.
- **LICENCE-003** — Austritt/Deaktivierung gibt Slot sofort frei; Reaktivierung prüft Limit erneut.
- **LICENCE-004** — Einladungen bei vollem Limit erlaubt; Aktivierung bis freiem Slot blockiert, transaktional abgesichert.
- **LICENCE-005** — UNLIMITED→STANDARD am Periodenende; bei mehr als 25 ACTIVE 30 Kalendertage Schonfrist, keine neuen Aktivierungen, keine automatische Entfernung.
- **LICENCE-006** — Nach Schonfrist bei Überschreitung SLOT_LIMIT_LOCKED; Leader darf Slots/Lizenz verwalten, Daten bleiben erhalten.
- **LICENCE-007** — STANDARD→UNLIMITED erst nach serverseitig bestätigter Zahlung aktivieren.
- **LICENCE-008** — TRIAL sieben Kalendertage, höchstens 25 ACTIVE; danach E-Mail mit Bestätigungslink, fünf Werktage Antwortfrist, anschließend 14 Kalendertage Löschfenster.
- **LICENCE-009** — Rechtzeitige Bestätigung stoppt Löschung, verlängert aber Trial nicht; ohne bezahlte Lizenz nur eingeschränkte Verwaltung.
- **LICENCE-010** — Nach Clanlöschung Plattformaccount des Leaders 90 Kalendertage behalten; Login/Rückmeldung verhindert automatische Deaktivierung.
- **LICENCE-011** — Werktage: Montag–Freitag außer bundeseinheitlichen Feiertagen in Deutschland, Zeitzone Europe/Berlin.
- **LICENCE-012** — Wesentliche Lizenzzustandswechsel auditieren, keine Secrets protokollieren.
- **LICENCE-013** — Persistenter PostgreSQL-Job-Scheduler im Fünf-Minuten-Takt, idempotent und auditierbar.
- **LICENCE-014** — Fehlgeschlagene Jobs maximal drei Wiederholungen; Benachrichtigungsfehler dürfen keine vorzeitige Löschung auslösen.
- **LICENCE-015** — Wiederholungen nach 5 Minuten, 1 Stunde und 24 Stunden.
- **LICENCE-016** — Dauerhaft fehlgeschlagene kritische Jobs FAILED_REQUIRES_REVIEW; manueller Neustart nur autorisiert, geprüft und auditiert.
- **LICENCE-017** — Kritische Jobfehler im Admin-Dashboard, per E-Mail und bei verifizierter Nummer per SMS melden.
- **LICENCE-018** — Nicht bearbeitete kritische Fehler nach 24 Stunden eskalieren.
- **LICENCE-019** — Unmittelbar vor irreversibler Clanlöschung sämtliche Fristen, Bestätigungen, Zahlungen, Sperren und Incidents erneut prüfen.
- **LICENCE-020** — Clanlöschung nur nach vollständigem, integritätsgeprüftem Backup.
- **LICENCE-021** — Löschbackup verschlüsselt und zugriffsgeschützt, grundsätzlich höchstens 30 Kalendertage aufbewahren.
- **LICENCE-022** — Wiederherstellung nur nach dokumentierter Anfrage des ursprünglichen Leaders und ausdrücklicher Adminfreigabe; keine automatische Lizenzwiederherstellung.
- **LICENCE-023** — Während Restore RESTORING; Normalbetrieb erst nach vollständiger Validierung.
- **LICENCE-024** — Maximal ein gleichzeitiger Restore je Clan; Duplikate zusammenführen, Wiederanlauf nach Review.
- **LICENCE-025** — Restore validiert Relationen, Mitgliedschaften, Rollen, Rechte, Lizenz und Duplikate.
- **LICENCE-026** — Bei fehlgeschlagener automatischer Verlängerungszahlung sieben Kalendertage Zahlungsfrist mit bestehender Nutzung.
- **LICENCE-027** — Nach sieben Tagen ohne bestätigte Zahlung PAYMENT_OVERDUE_LOCKED; Daten erhalten, Lizenz-/Zahlungsverwaltung zugänglich.
- **LICENCE-028** — Während PAYMENT_OVERDUE_LOCKED Einladungen und Aktivierungen blockieren; Deaktivierung erlaubt.
- **LICENCE-029** — Vor Ende der Zahlungsfrist mindestens eine Warn-E-Mail.
- **LICENCE-030** — Am vorletzten Tag der Zahlungsfrist zusätzliche Erinnerung.
- **LICENCE-031** — Bei Zahlungsproblemen E-Mail, SMS und rechtlich zulässiges WhatsApp; verifizierte E-Mail und erreichbare verifizierte Mobilnummer verpflichtend, WhatsApp nur mit erforderlicher Einwilligung.
- **LICENCE-032** — Bei PAYMENT_OVERDUE_LOCKED keine externen Turnier-/Matchanmeldungen.
- **LICENCE-033** — Bestätigte Zahlung hebt Zahlungssperre nur für die Zukunft auf, andere Sperren bleiben unabhängig.
- **LICENCE-034** — Widersprüchliche Zahlungsbestätigungen: kein automatisches Entsperren, Adminprüfung.
- **LICENCE-035** — Keine Verzugszinsen oder Mahngebühren nach aktuellem Beschluss.
- **LICENCE-036** — Idempotente Zahlungsreferenzen gegen Doppelabbuchung; Verdachtsfall erzeugt HIGH-Supportticket; separates Fachmodul SUPPORT_TICKET, unter Lizenzsperren erreichbar.
- **LICENCE-037** — Erste qualifizierte menschliche Antwort auf HIGH-Zahlungsticket binnen drei Werktagen, sonst Eskalation.
- **LICENCE-038** — HIGH-Zahlungsticket: Fehlt binnen drei Werktagen eine qualifizierte menschliche Erstreaktion, automatische Eskalation an die Plattformadministration und Benachrichtigung des Leaders über verifizierte Kanäle ohne vertrauliche Ticketdetails; Audit. Die Frist betrifft die Erstreaktion, nicht die Lösung.
- **LICENCE-039** — Für HIGH-Zahlungstickets ist innerhalb von sieben Werktagen eine abschließende Entscheidung vorgesehen. Bei Fristüberschreitung automatische Eskalation und Benachrichtigung des Leaders ohne vertrauliche Details; Audit.
- **LICENCE-040** — Bei Zahlungsproblemen verpflichtend im Dashboard und per E-Mail vor parallelen bzw. erneuten Zahlungsversuchen warnen; Versand und Anzeige auditieren.
- **LICENCE-041** — Jeder abgeschlossene Zahlungssupportfall erhält eine verpflichtende, datensparsame Ergebnis-/Abschlusszusammenfassung; Bereitstellung und Kenntnisnahme-/Bestätigungsstatus werden nachvollziehbar erfasst.
- **LICENCE-042** — Ticketabschluss per E-Mail mit sicherem einmaligem zeitbegrenztem Bestätigungslink; fehlende Bestätigung bedeutet keine Zustimmung.
- **LICENCE-043** — Bestätigungsfrist 24 Stunden; Erinnerungen nach 24 und 48 Stunden; nach 72 Stunden Klärungsfall ohne fingierte Zustimmung.
- **LICENCE-044** — Klärungsfall nach 72 Stunden automatisch HIGH.
- **LICENCE-045** — Auf HIGH-Klärungsfall erste qualifizierte Antwort binnen drei Werktagen, sonst Eskalation.
- **LICENCE-046** — Leader darf offene Tickets um Nachrichten und sichere Anhänge ergänzen.
- **LICENCE-047** — Maximal 25 MB pro Ticketanhang.
- **LICENCE-048** — Genau ein Ticket pro Sachverhalt; bei Klärungsfall dasselbe Ticket wieder öffnen, nicht duplizieren.
- **LICENCE-049** — Neue Rückfrage zu gleichem Sachverhalt öffnet geschlossenes Ticket erneut.
- **LICENCE-050** — Maximal zehn Anhänge pro Ticket.
- **LICENCE-051** — Jeden Ticketanhang 14 Kalendertage nach Upload automatisch löschen, vorbehaltlich rechtmäßiger Aufbewahrung/Beweissicherung.
- **LICENCE-052** — Leader 24 Stunden vor Anhanglöschung über zulässige Kanäle benachrichtigen.
- **LICENCE-053** — Anhanglöschung im Ticketverlauf mit Dateiname, Uploadzeitpunkt, Löschzeitpunkt und Grund dokumentieren.
- **LICENCE-054** — Nach vom Zahlungsanbieter bestätigter vollständiger Rückerstattung die betroffene Lizenz automatisch einschränken; Clan-Daten erhalten, Lizenzverwaltung und Support weiter zugänglich lassen, keine automatische Löschung; Zustandswechsel auditieren.
- **LICENCE-055** — Eine bestätigte teilweise Rückerstattung verändert den Lizenzstatus nicht; Rückerstattung mit der Zahlung verknüpfen und auditieren. Bei Widersprüchen Supportfall im bestehenden Sachverhalts-Ticket eröffnen bzw. wiederaufnehmen; nur vollständige Rückerstattung löst LICENCE-054 aus.
- **LICENCE-056** — Bei technisch fehlgeschlagener oder unklarer Rückerstattung bleibt der Lizenzstatus unverändert, bis der Anbieter die Rückerstattung bestätigt. Automatisch einen HIGH-Supportfall im sachverhaltsbezogenen Ticket anlegen bzw. wiederöffnen; Leader sieht Status, Support wird benachrichtigt; Audit und Idempotenz verhindern doppelte Rückerstattungen und Lizenzübergänge.

**Prüfvermerk (Korrekturfassung):** Alle 56 Regelpositionen besitzen nun einen inhaltlichen Eintrag; sieben zuvor offene Positionen (038–041, 054–056) sind aus dem dokumentierten Gesprächsstand rekonstruiert. Das frühere Prüfergebnis „48 / acht offen“ war mit den sieben tatsächlich markierten Positionen unvereinbar. Eine wortgetreue Verifikation der sieben Positionen gegen das vollständige Originalprotokoll sowie die Whiteboard-Einzelbildprüfung bleiben ausstehend. Keine automatische fachliche Endfreigabe.


### Korrekturvermerk 15.11.2026

Die Regeln LICENCE-038–041 und LICENCE-054–056 wurden inhaltlich ergänzt. Die Kurzfassungen LICENCE-001–037 und LICENCE-042–053 bleiben unverändert; ihre Wortlauttreue zum Originalgespräch wurde hier nicht erneut bestätigt. Die fachlichen Aussagen des übernommenen v0.9-Teils zu noch offenen Refunds, Trial-Laufzeit und Ticketanhangfristen werden durch die konkreten Regeln des v1.0-Registers präzisiert. Andere offene Projektentscheidungen bleiben offen.

