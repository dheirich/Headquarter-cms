> **v1.0 – Konsolidierungsstand 15.11.2026:** Vorheriger v0.9-Fachbestand erhalten. Neue Lizenz-/Supportbeschlüsse sind als dokumentierte Zielanforderungen ergänzt, **nicht** als bereits implementiert. Die Originalformulierungen von LICENCE-038 bis 041 und LICENCE-054 bis 056 liegen hier nicht verlässlich vor; sie sind ausdrücklich zur Nachprüfung markiert. Vollständige Freigabe aller 56 Regeln ist deshalb noch ausstehend.

# ClanIntern / Headquarter – REQUIREMENTS

**Stand:** 13.11.2026 · **Version:** 0.9 · **Status:** konsolidierter Entwurf zur fachlichen Prüfung
**Quellen:** Pflichtenheft v0.7 (inklusive v0.6-Anhang), bisherige REQUIREMENTS.md, ARCHITECTURE.md, DECISIONS.md, MILESTONES.md und README.md.
**Whiteboard-Status:** Das Archiv mit 51 Nutzdateien liegt vor. Die einzelnen Bildinhalte wurden für diese Fassung **nicht vollständig verifiziert**. Aussagen, die ausschließlich aus den Whiteboards stammen könnten, gelten daher nicht als abschließend abgeglichen.

## 1. Ziel und Geltungsbereich

Headquarter (Implementierungsname **ClanIntern**) ist eine modulare Verwaltungs- und Kommunikationsplattform für Gaming-Clans. Eine Claninstanz verwaltet **genau einen Clan** mit mehreren Gaming-Teams. `clanhq.org` dient als öffentliche Plattform für Registrierung und perspektivisch Lizenzerwerb. Eine gemeinsame Multi-Tenant-Instanz für mehrere unabhängige Clans ist nicht beschlossen. Daten verschiedener Instanzen müssen getrennt bleiben.

Eine Plattformregistrierung gewährt weder automatisch Clanmitgliedschaft noch eine Rolle oder Lizenz. Ein registrierter Account ohne Clanmitgliedschaft darf gemäß historischem Fachstand öffentliche Foren nutzen und einen Newsletter abonnieren.

## 2. Verbindliche technische Rahmenbedingungen

Technische Entscheidungen folgen `ARCHITECTURE.md` und `DECISIONS.md` (Entscheidungsstand 13.11.2026), nicht den historischen Stack-Angaben im Pflichtenheft.

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

**Quellenkonflikt:** Historische v0.7-PDF nennt C++23/Drogon/Angular/PostgreSQL; ältere Markdown-Dateien Next.js/NestJS/Prisma. **Aktuell maßgeblich** sind die akzeptierten .NET-11-/PostgreSQL-ADRs vom 13.11.2026. Der Wechsel betrifft die Implementierung, nicht die fachlichen Regeln.

**Whiteboard-Vorbehalt:** Das ZIP ist vorhanden, aber nicht vollständig inhaltlich geprüft. Diese Datei ist deshalb eine **konsolidierte Arbeitsfassung**, keine Behauptung vollständiger Whiteboard-Abdeckung. Unbestätigte Details dürfen nicht als abgeschlossen gelten.

## 14. Änderungsregel

Anforderungen werden nicht stillschweigend entfernt oder abgeschwächt. Konflikte und offene Punkte werden dokumentiert und vor Umsetzung entschieden. `REQUIREMENTS.md` beschreibt das **Was**, `ARCHITECTURE.md` und `DECISIONS.md` das **Wie**, `MILESTONES.md` die Reihenfolge.


## 15. Ergänzungen aus den bestätigten Architekturentscheidungen (13.11.2026)

Die folgenden Anforderungen ergänzen den bestehenden Fachbestand; alle bisherigen Anforderungen bleiben bestehen, sofern nicht ausdrücklich als überholt gekennzeichnet.

### REQ-AUTH-001 – Echte Anmeldung in Alpha 0.1

**Status:** Bestätigt · **Priorität:** Alpha 0.1

- Anmeldung und Abmeldung müssen tatsächlich über ASP.NET Core Identity funktionieren. Ein Formular mit ausschließlich lokaler Eingabevalidierung ist nicht ausreichend.
- Anonyme Benutzer dürfen geschützte Dashboard-Routen und Daten nicht aufrufen.
- Angemeldete Benutzer ohne die erforderliche Berechtigung dürfen geschützte Aktionen auch bei direktem Aufruf nicht ausführen.
- Der grundlegende Authentifizierungszustand muss nach Anmeldung, Abmeldung und Seitenneuladen korrekt berücksichtigt werden.
- Die Alpha-0.1-Abnahme muss mindestens einen erfolgreichen und einen fehlgeschlagenen Login, Logout sowie verweigerte anonyme und unberechtigte Zugriffe nachweisen.
- Die übrigen verbindlichen Sicherheitsregeln aus Abschnitt 5 bleiben bestehen. Ihre vollständige Release-Zuordnung (insbesondere MFA, Step-up und Ein-Session-Regel) ist noch gesondert zu konkretisieren; eine produktive Freigabe ohne erforderliche Sicherheitskontrollen wird dadurch nicht erlaubt.

### REQ-ACCESS-001 – Identität ist keine Plattformverwaltungsberechtigung

**Status:** Bestätigter Grundsatz · **Priorität:** Grundlage des Berechtigungsmodells

- Die technische Benutzeridentität, Clanmitgliedschaft, organisatorische Rolle, Permission, Scope, Policy und Lizenz müssen fachlich unterscheidbar bleiben.
- Eine erfolgreiche Authentifizierung allein gewährt weder Clanmitgliedschaft noch Plattform- oder Lizenzverwaltungsrechte.
- Im regulären Clanmodell ist die Gründung eines Clans dem Leader vorbehalten. Der Leader besitzt den vorgesehenen Zugang zur Clan- und Plattformverwaltung.
- Subleader, Moderator, Member und Trial erhalten durch ihre Clanrolle keinen Plattformverwaltungszugang. Sonderzugriff für SUPPORT_ADMIN ist separat und streng abgesichert zu behandeln.
- Ein Benutzer darf höchstens eine **aktive Clanmitgliedschaft** besitzen; Mitgliedschaften in mehreren Teams desselben Clans sind möglich.
- Historische Anforderungen zu Registrierung ohne Clanmitgliedschaft, öffentlichen Foren und Newsletter bleiben bis zum ausdrücklichen fachlichen Abgleich erhalten. Sie sind nicht mit Plattformverwaltungsrechten gleichzusetzen.

**Abnahmebeispiele:** Ein Member kann keine Lizenzverwaltung aufrufen; ein berechtigter Leader kann seine vorgesehenen Verwaltungsfunktionen aufrufen; eine zweite gleichzeitig aktive Clanmitgliedschaft wird abgelehnt.

### REQ-UI-001 – Gemeinsame Dashboard-Struktur, differenzierte Funktionen

**Status:** Bestätigter Grundsatz · **Priorität:** Alpha 0.1 (Grundgerüst)

- Die Dashboard-Oberflächen sollen auf einer gemeinsamen, wiederverwendbaren Struktur aufbauen. Es werden nicht für jede Clanrolle eigenständige, vollständig getrennte Dashboards vorausgesetzt.
- Sichtbare Navigation, Module, Aktionen und Inhalte richten sich nach dem **tatsächlichen Zugriffskontext** und den serverseitig geprüften Berechtigungen.
- Plattformverwaltungsfunktionen und Clan-Funktionen müssen in ihrer Zugriffsberechtigung klar getrennt bleiben, auch wenn sie dasselbe UI-Layout nutzen.
- Nicht sichtbare Bedienelemente gelten nicht als Sicherheitsmaßnahme: Direktaufrufe und serverseitige Aktionen müssen unabhängig davon geschützt sein.
- Die bereitgestellten Login- und Dashboard-Mock-ups dienen als gestalterische und funktionale Orientierung, nicht als pixelgenaue Vorgabe. Responsive Verhalten ist zu berücksichtigen.
- Ob der Leader Plattform- und Clanverwaltung innerhalb einer integrierten Navigation oder in getrennten Bereichen aufruft, bleibt offen; daraus wird noch keine zusätzliche Festlegung abgeleitet.

**Abnahmebeispiele:** Zwei Clanrollen sehen dieselbe grundlegende Dashboard-Struktur, aber nur erlaubte Aktionen; manipulierte Routen/Requests eröffnen keine zusätzlichen Rechte.

### REQ-TECH-001 – Verbindlicher Zielstack und Migrationsnachweis

**Status:** Bestätigt · **Priorität:** Vor produktiver Datenbankintegration

- Zielstack ist .NET 11, C#, ASP.NET Core, Blazor Interactive Server, ASP.NET Core Identity, PostgreSQL, EF Core 11 und Npgsql.
- Die vier bestehenden .NET-Projekte und die modular-monolithische Architektur bleiben erhalten.
- Projektdateien, Pakete, Providerregistrierung, Konfiguration, Connection Strings und Migrationen sind auf den Zielstack abzugleichen.
- Der beschlossene Zielstack ist **nicht** gleichbedeutend mit einer bereits durchgeführten Repository-Migration. Abschluss erst nach Build, Migration und Integrationstest dokumentieren.
- Historische SQL-Server- und .NET-10-Angaben sind technisch überholt, ohne die fachlichen Regeln zu streichen.

### Noch offene Konkretisierungen

1. Vollständige Permission-/Scope-Matrix einschließlich Sonderrollen und Delegation.
2. Konkrete Registrierung und Zugangswege für Gäste sowie für Clanaccounts im Verhältnis zum Leader- und Plattformverwaltungsmodell.
3. Leader-Navigation zwischen Clan und Plattformverwaltung.
4. Releasegenaue Umsetzung der Sicherheitsbaseline und Testmatrix für Alpha 0.1.
5. Vollständiger Abgleich der Whiteboard-Policies; die bestehenden fachlichen Vorbehalte gelten weiterhin.

---

## v1.0 – Verbindliche zusätzliche Anforderungen und Akzeptanzkriterien
- **REQ-LIC-01:** STANDARD/TRIAL überschreiten niemals 25 ACTIVE-Mitgliedschaften; parallele Aktivierungsversuche werden sicher begrenzt.
- **REQ-LIC-02:** Downgrade über 25 ACTIVE führt nach 30 Tagen zu `SLOT_LIMIT_LOCKED`, ohne Mitgliederdaten zu löschen.
- **REQ-LIC-03:** Zahlungsfehler führen nach sieben Tagen zu `PAYMENT_OVERDUE_LOCKED`, sofern keine bestätigte Zahlung vorliegt.
- **REQ-LIC-04:** Ein bestätigtes Upgrade/Payment hebt nur die dafür einschlägigen Sperren auf; Widersprüche erzeugen Review.
- **REQ-LIC-05:** Trialablauf, Bestätigung, Werktage und Löschfristen werden mit Europe/Berlin korrekt berechnet und getestet.
- **REQ-JOB-01:** Jobs laufen persistent und idempotent; Retryabstände und Eskalation sind testbar.
- **REQ-DEL-01:** Ohne vollständige erneute Frist-/Rechteprüfung und gültiges Backup findet keine Clanlöschung statt.
- **REQ-RESTORE-01:** Restore nur nach autorisierter Freigabe und vollständiger Integritätsprüfung; bei Fehlern bleibt Zugriff gesperrt.
- **REQ-SUP-01:** Leader können auch unter Lizenzsperren ihre Tickets einsehen und bearbeiten; andere Clans haben keinen Zugriff.
- **REQ-SUP-02:** HIGH-Zahlungs- und Klärungstickets erhalten binnen drei Werktagen qualifizierte menschliche Erstreaktion.
- **REQ-SUP-03:** Pro Sachverhalt genau ein Ticket, das bei Nachfragen wieder geöffnet wird.
- **REQ-SUP-04:** Maximal zehn Anhänge zu je höchstens 25 MB; Ablehnung verwirft keine Nachricht.
- **REQ-SUP-05:** Anhänge nach 14 Tagen löschen, 24 Stunden zuvor informieren und Metadaten des Löschvorgangs auditieren.
- **REQ-COM-01:** Benachrichtigungen nutzen nur zulässige, konfigurierte Kanäle; Zustellversuche und Fehler werden nachvollziehbar protokolliert.

**Abnahme:** Zu jeder Anforderung automatisierte Grenzwert-, Statuswechsel-, Concurrency-, Autorisierungs- und Fehlerpfadtests anlegen. Unbestätigte Regeln 038–041 und 054–056 bleiben ausdrücklich ohne Abnahmefreigabe.
