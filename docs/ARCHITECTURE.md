# ARCHITECTURE – Headquarter / ClanIntern v1.4

## Verbindlicher technischer Zielstand v1.4 (22.11.2026)

**Diese Festlegung hat bei technischen Widersprüchen Vorrang vor sämtlichen älteren Abschnitten.** Die Dokumentationsversion 1.4 ist keine Software-Release-Version. Sämtliche bestehenden fachlichen Regeln, IDs, Statusmodelle, Zahlen, Ausnahmen, Entscheidungen, offenen Punkte und Abnahmeanforderungen gelten unverändert fort. Frühere .NET-Angaben sind ausschließlich historische Architekturentscheidungen und keine aktuelle Implementierungsvorgabe.

| Bereich | Verbindlicher Zielstack |
|---|---|
| Sprache / Laufzeit | PHP 8.5 (lokale Entwicklungsumgebung; Kompatibilität der eingesetzten Laravel-Version prüfen) |
| Backend | Laravel (kompatible, beim Projektstart festzulegende Version) |
| UI / serverseitige Interaktion | Livewire, Blade |
| Kleine Browserinteraktionen | Alpine.js |
| Styling | Tailwind CSS |
| Datenbank | PostgreSQL |
| ORM / Schema | Eloquent ORM, Laravel-Migrationen |
| Authentifizierung | Laravel-Authentifizierung mit Sessions, Guards, Middleware; konkrete Starter- und MFA-Lösung gesondert festlegen |
| Berechtigungen | Laravel Policies/Gates plus projektspezifische Permission-, Scope-, Mitgliedschafts-, Lizenz- und Step-up-Prüfungen |
| Architektur | Modularer Laravel-Monolith mit fachlichen Modulgrenzen, Services/Actions, Domain-Regeln und Infrastrukturadaptern |
| Betrieb | Composer, Artisan, npm/Vite, Git/GitHub; Queue, Scheduler, CI/CD und Hosting gemäß offenen Entscheidungen |

**Architekturübersetzung:** Historische `Domain`, `Application`, `Infrastructure`, `Web` bezeichnen weiterhin logische Verantwortlichkeiten, jedoch **keine verpflichtenden vier .NET-Projekte**. Laravel-Module werden innerhalb einer Anwendung organisiert. Razor/Blazor-Komponenten werden durch Blade/Livewire ersetzt; Blazor-Circuits durch serverpersistierte Laravel-Sessions und Livewire-Requests; ASP.NET Identity durch Laravel-Authentifizierung; EF Core/Npgsql durch Eloquent/PostgreSQL und Laravel-Migrationen; .NET-DI durch den Laravel-Service-Container. Für die interne Livewire-Kommunikation ist kein gesondertes REST-Backend vorgeschrieben.

**Umsetzungsnachweis:** Die zuvor dokumentierten .NET-Login-/Datenbanktests sind historischer Altprojektstand und **kein Nachweis** für die neue Laravel-Anwendung. Laravel-Installation, Authentifizierung, Logout, PostgreSQL-Migrationen, Autorisierung, Tests und Alpha-0.1-Abnahme müssen für den neuen Stack separat belegt werden. Keine fachliche Anforderung wird durch einen Frameworkwechsel automatisch erfüllt.

**Dokumentationsschutz:** Der komplette Wortlaut der Ausgangsversion 1.3 bleibt im nachfolgenden historischen Originalbestand enthalten. Er wird nicht als aktuelle technische Vorgabe ausgelegt. Fachliche Entscheidungen bleiben maßgeblich, soweit sie nicht durch einen ausdrücklich später bestätigten Fachbeschluss ersetzt wurden.

---

## Vollständig erhaltener Ausgangsbestand v1.3 (historisches Original; technische Stack-Angaben abgelöst)

# ARCHITECTURE – Headquarter / ClanIntern v1.3

**Stand:** 22.11.2026 · **Dokumentationsversion:** 1.3 · **Produkt:** Headquarter / ClanIntern

**Geltung:** Diese Datei ersetzt die bisherige gleichnamige Projektdokumentation. Bestehende bestätigte Fachbeschlüsse bleiben erhalten. Wo ältere, im übernommenen Quelltext enthaltene Angaben abweichen, gelten die ausdrücklich bestätigten Beschlüsse vom 16.11.2026 und die nachfolgende v1.3-Fortschreibung. Die Dokumentationsversion ist keine Software-Release-Version.

**Nachweisgrenze:** Der Implementierungsstatus beruht auf dem gemeinsam besprochenen Entwicklungsstand, nicht auf einem vollständigen aktuellen Repository-, CI- oder Testlauf. Nicht nachgewiesene Funktionen sind als offen zu behandeln.

## v1.3 – Abgleich mit dem bisherigen Implementierungsstand

- **Solution:** modularer Monolith mit Domain, Application, Infrastructure, Web; technische Zielarchitektur bleibt unverändert.
- **Authentifizierung:** ASP.NET Core Identity, `ApplicationUser`, `SignInManager`, Cookie-Authentifizierung und formularbasierter Login-Endpunkt. Die lokale Passwortprüfung und Datenbankintegration wurden im Entwicklungsprozess geprüft.
- **Entwicklungsdaten:** Development-Seeding ist ausschließlich für `Development` vorgesehen. Seed-Passwörter gehören in User Secrets/geschützte Konfiguration; keine Klartextwerte, Hashes oder Secrets in Repository, Logs oder Dokumentation. Seeder muss idempotent sein.
- **Blazor/UI:** Interactive Server für interaktive Sidebar, `NavLink` für Navigation, modellgestützte Menüpunkte. Die gewünschte moderne Gaming-Oberfläche mit linksseitiger Navigation und transparenten Panels ist eine UI-Vorgabe, kein Autorisierungsmechanismus.
- **Sicherheitsgrenze:** Menüausblendung ersetzt niemals serverseitige Prüfung von Account, Mitgliedschaft, Rolle, Permission, Scope, Policy und Lizenzstatus.
- **Noch offen:** vollständig geprüfter Logout, Cookie-/Session-Handling, MFA, Step-up, Zugriffsschutz, CI-Tests und Produktionskonfiguration. Lokal beobachtete Funktionalität ist keine produktive Sicherheitsabnahme.

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

**Architekturkonsequenz:** Serverintegrationen als lesende Capability-Adapter; Permission-/Scope-Entscheidungen zentral serverseitig; Lizenzperioden und Mitgliedschaftsaktivierung transaktional; 30-Minuten-Recovery als gesonderter persistenter Wizard-Zustand.

---

## Übernommener Ausgangsstand (historische Metadaten beachten)

> **v1.0 – Konsolidierungsstand 15.11.2026:** Vorheriger v0.9-Fachbestand erhalten. Neue Lizenz-/Supportbeschlüsse sind als dokumentierte Zielanforderungen ergänzt, **nicht** als bereits implementiert. Die Originalformulierungen von LICENCE-038 bis 041 und LICENCE-054 bis 056 liegen hier nicht verlässlich vor; sie sind ausdrücklich zur Nachprüfung markiert. Vollständige Freigabe aller 56 Regeln ist deshalb noch ausstehend.

# ClanIntern – Softwarearchitektur

**Projekt:** ClanIntern / Headquarter
**Dokumentstand:** 13.11.2026 · **Revision:** 0.9 (Arbeitsfassung)
**Architekturstil:** Modularer Monolith mit vier .NET-Projekten

> **Revisionshinweis:** Beschlossener Zielstack ist .NET 11 / PostgreSQL / EF Core 11 / Npgsql. Die Ausgangsdokumente beschreiben noch .NET 11 / SQL Server; die tatsächliche Code- und Datenbankmigration ist nicht nachgewiesen. Zielarchitektur und Implementierungsstand werden getrennt ausgewiesen.

## 1. Architekturziel

ClanIntern soll modular, sicher, wartbar, erweiterbar und testbar sein.

Die Anwendung wird vollständig auf Basis des Microsoft-.NET-Ökosystems entwickelt.

Die fachlichen Anforderungen aus dem Pflichtenheft und den vereinbarten Whiteboard-Policies bleiben unabhängig vom verwendeten Technologie-Stack bestehen.

## 2. Technologie-Stack

### Frontend

- .NET 11
- Blazor Web App
- Razor Components
- C#
- Interactive Server Render Mode
- Tailwind CSS 4 als verbindliches CSS-Ziel
- Bootstrap als vorübergehende Lösung während der Entwicklung

### Backend

- .NET 11
- ASP.NET Core
- C#
- ASP.NET Core Dependency Injection
- ASP.NET Core Identity für Authentifizierung und Accountverwaltung
- Serverseitige Anwendungslogik innerhalb der bestehenden Solution

### Datenbank

- PostgreSQL
- Entity Framework Core 11
- Npgsql (EF-Core-Provider für PostgreSQL)
- EF Core Migrations
- LINQ

### Entwicklung und Qualität

- .NET SDK 11
- NuGet
- Git und GitHub
- Unit- und Integrationstests
- Dokumentation mit Markdown
- Docker und CI/CD als vorgesehene Infrastrukturthemen

## 3. Architekturprinzipien

- SOLID
- DRY
- KISS
- YAGNI
- Separation of Concerns
- Dependency Injection
- Clean Architecture als Orientierung
- Klare Trennung fachlicher und technischer Verantwortlichkeiten

Die Architektur soll verständlich bleiben. Zusätzliche Abstraktionen werden nur eingeführt, wenn sie einen nachvollziehbaren Nutzen bieten.

## 4. Projektstruktur

Die bestehende Solution `ClanIntern` umfasst vier Projekte.

### ClanIntern.Domain

Enthält die fachlichen Kernmodelle, Geschäftsregeln und Invarianten.

Die Domain soll möglichst unabhängig von Datenbanken, Benutzeroberflächen und technischen Frameworks bleiben.

### ClanIntern.Application

Enthält die Anwendungsfälle, Anwendungsservices und Schnittstellen zur Umsetzung fachlicher Abläufe.

Die Application-Schicht koordiniert die benötigten Geschäftsprozesse.

### ClanIntern.Infrastructure

Enthält technische Implementierungen und Integrationen.

Dazu gehören insbesondere:

- Entity Framework Core
- PostgreSQL
- ASP.NET Core Identity
- Persistenz und Datenbankzugriff
- Implementierungen von Schnittstellen aus der Application-Schicht

### ClanIntern.Web

Enthält die Blazor-Benutzeroberfläche und den ASP.NET-Core-Anwendungseinstieg.

Dazu gehören insbesondere:

- Razor Components
- Pages und Layouts
- Formulare und Validierung
- Routing und Navigation
- Konfiguration und Dependency Injection in `Program.cs`
- Einbindung der Application- und Infrastructure-Dienste

### Projektabhängigkeiten

Die Abhängigkeiten sollen den fachlichen Kern schützen.

- Domain bleibt unabhängig von den anderen Projekten.
- Application verwendet Domain.
- Infrastructure implementiert technische Anforderungen der inneren Schichten.
- Web verwendet Application und registriert die benötigten Infrastructure-Dienste.

Die konkrete Abhängigkeitsstruktur wird über die jeweiligen `.csproj`-Dateien festgelegt.

## 5. Fachliche Architektur

ClanIntern wird nach fachlichen Domänen strukturiert.

Dazu gehören:

- MEMBER
- TEAM
- CONTENT
- FORUM
- CHAT
- FINANCE
- SERVER
- SECURITY
- CLAN_SETTINGS
- LICENCE
- WARPLANNER
- FILE_UPLOAD
- NOTIFICATIONS
- AUDIT_LOG

Diese fachlichen Domänen sind zunächst konzeptionelle Modulgrenzen.

Ihre spätere Implementierung innerhalb der bestehenden vier .NET-Projekte wird schrittweise festgelegt.

Eine zusätzliche Aufteilung in Microservices ist derzeit nicht vorgesehen.

### Dashboard und UI-Modularität (Zielbild)

Die hochgeladenen Desktop- und Mobile-Mock-ups dienen als funktionale und responsive Referenz, nicht als verbindliche Festlegung von Hintergrundbild, Farben oder visueller Komposition.

- Die Anwendung besitzt eine gemeinsame, wiederverwendbare Dashboard-Shell für Navigation, Benutzerkontext, Benachrichtigungen und Inhaltsbereiche.
- Dashboard-Inhalte und Navigation werden anhand von **serverseitig geprüften** Rechten, Clanmitgliedschaft, Lizenz und Scope zusammengestellt.
- Leader erhalten Clanverwaltung sowie die ihnen vorbehaltene Plattform-/Lizenzverwaltung; Subleader, Moderatoren, Mitglieder und weitere berechtigte Funktionen erhalten jeweils begrenzte Ansichten.
- Ein Dashboard-Menüpunkt ist **keine** automatische fachliche Modulgrenze. Fachmodule kapseln Anwendungsfälle und Regeln; UI-Komponenten können Daten mehrerer Module darstellen.
- Responsive Desktop-/Mobilansichten sollen dieselben Autorisierungsregeln verwenden.
- Leere, ladende, fehlerhafte und nicht autorisierte Zustände werden explizit behandelt.
- Die Entscheidung, ob Leader ein integriertes Dashboard oder getrennte Plattform-/Clanbereiche erhalten, bleibt offen.

### Identität und organisatorische Zugehörigkeit (präzisierter Zielstand)

- Eine technische Login-Identität ist von einem **Recht auf Plattformverwaltung** zu unterscheiden. Auch reine Clanmitglieder benötigen eine authentifizierbare Identität.
- Im regulären Clanmodell ist **höchstens eine aktive Clanzugehörigkeit je Benutzer** vorgesehen; Mehrfachzugehörigkeit zu Teams desselben Clans bleibt zulässig.
- Nach der jüngsten fachlichen Klärung ist der Clan-Leader der reguläre Benutzer mit sowohl Clan- als auch Plattform-/Lizenzverwaltungszugriff. Privilegierter Supportzugriff ist davon getrennt zu modellieren.
- Clan-Gründung und Lizenzverwaltung sind gesondert autorisierte Anwendungsfälle; die Rolle allein ersetzt weder Scope- noch Lizenzprüfung.
- Bestehende Aussagen zu allgemeiner Plattformregistrierung und öffentlichen Gastfunktionen müssen im Pflichtenheft auf Vereinbarkeit mit dieser neuen Zugriffsregel geprüft werden.

### Mandanten- und Instanzgrenze (offen)

Das bisherige Pflichtenheft beschreibt eine Claninstanz pro Clan und trifft keine endgültige Entscheidung über eine gemeinsam gehostete Multi-Tenant-Plattform. Die technische Datenisolation, Bereitstellung und Zuordnung von Clan und Lizenz sind vor Implementierung festzulegen; keine implizite Multi-Tenant-Architektur annehmen.

## 6. Sicherheitsgrundsatz

Berechtigungen werden immer serverseitig überprüft.

Die folgenden Konzepte bleiben fachlich getrennt:

`ROLE != PERMISSION != SCOPE != POLICY`

`PLATFORM_ACCOUNT != CLAN_MEMBERSHIP != ROLE != LICENCE`

Zusätzlich gelten folgende Grundsätze:

- Niemand darf sich selbst zusätzliche Berechtigungen erteilen.
- Die Sichtbarkeit einer Blazor-Komponente ersetzt keine serverseitige Autorisierung.
- Privilegierte Rollen benötigen Multi-Faktor-Authentifizierung.
- Sicherheitskritische Aktionen erfordern Step-up-Authentifizierung.
- Sicherheitskritische Änderungen werden auditiert.
- Passwörter, Tokens und andere Secrets dürfen nicht im Klartext protokolliert werden.
- Clan-Sicherheitsrichtlinien dürfen die verbindliche Sicherheitsbaseline nicht abschwächen.
- Die fachlich vorgesehene Begrenzung auf maximal eine aktive Session pro Account muss ausdrücklich umgesetzt werden.

ASP.NET Core Identity stellt technische Grundlagen bereit. Die vollständige Umsetzung der projektspezifischen Sicherheitsregeln ist eine eigenständige Entwicklungsaufgabe.

## 7. Kommunikation und Laufzeit

Die Blazor Web App verwendet aktuell Interactive Server.

Interaktive Komponenten werden serverseitig ausgeführt und kommunizieren über die Blazor-Verbindung mit dem Browser.

Die Anwendungslogik wird über die vorgesehenen Services und Schichten aufgerufen.

Ein separates REST-Backend ist für die grundlegende Kommunikation zwischen Blazor-Oberfläche und Anwendungslogik nicht erforderlich.

HTTP-APIs können später ergänzt werden, wenn konkrete Integrationen oder externe Clients dies benötigen.

## 8. Datenzugriff

Der geplante Datenzugriff erfolgt über Entity Framework Core 11 und PostgreSQL mit Npgsql. Bestehende SQL-Server-Implementierungen gelten als Migrationsbestand, nicht als Zielarchitektur.

Die technische Datenbankimplementierung gehört in `ClanIntern.Infrastructure`.

Fachliche Geschäftsregeln dürfen nicht ausschließlich in der Benutzeroberfläche oder in Datenbankzugriffskomponenten umgesetzt werden.

Datenbankmigrationen, Transaktionen, Constraints und Indizes werden entsprechend den fachlichen Anforderungen eingesetzt.

## 9. Dokumentation und Architekturentscheidungen

Wichtige technische Entscheidungen werden in `DECISIONS.md` dokumentiert.

Die Entwicklungsreihenfolge wird in `MILESTONES.md` festgehalten.

Die fachlichen Anforderungen werden durch `REQUIREMENTS.md`, das Pflichtenheft und die vereinbarten Whiteboard-Policies beschrieben.

Offene oder widersprüchliche Anforderungen werden ausdrücklich gekennzeichnet und nicht stillschweigend verändert oder entfernt.

## 10. Dashboard, Identität und Autorisierung

Ein gemeinsames Blazor-Dashboard-Shell dient als Layout für angemeldete Benutzer. Plattform- und Clan-Kontext sind fachlich getrennt; Navigation und Inhalte werden aus dem aktiven Kontext und serverseitig geprüften Berechtigungen abgeleitet. Ein Login allein verleiht keine Clanmitgliedschaft und keine Plattformverwaltungsrechte.

Die Trennung `PLATFORM_ACCOUNT != CLAN_MEMBERSHIP != ROLE != PERMISSION != SCOPE != POLICY != LICENCE` bleibt verbindlich. Berechtigungen werden bei jeder geschützten Aktion im Application-/Service-Kontext durchgesetzt; ausgeblendete UI-Elemente ersetzen keine Autorisierung. Die konkrete Rollen-/Permission-Matrix und Leader-Navigation bleiben offen.

## 11. Alpha 0.1 – Architekturziel

Alpha 0.1 verlangt **echte Authentifizierung mit ASP.NET Core Identity**, sichere Anmeldung und Abmeldung, geschützte Navigation und ein rollen-/berechtigungsabhängiges Dashboard-Grundgerüst. Ein bloß validiertes Loginformular oder ein simuliertes Benutzerprofil erfüllen dieses Ziel nicht.

Die späteren Fachmodule dürfen im Dashboard als konzeptionelle Navigation oder ausdrücklich gekennzeichnete Platzhalter erscheinen, sind dadurch aber nicht als implementiert anzusehen. Die vollständige Sicherheitsbaseline aus dem Pflichtenheft bleibt verbindlich für produktive Freigaben; ihr Alpha-Umfang ist in MILESTONES und REQUIREMENTS explizit zu markieren.

## 12. Offene Abgleiche und Nachweise

1. **Stackmigration:** Historische Dokumente und Code können noch .NET 10 / SQL Server enthalten. Ziel ist .NET 11 / PostgreSQL / EF Core 11 / Npgsql; `.csproj`, Pakete, `UseSqlServer`, Connection Strings und Migrationen sind vor Implementierungsfreigabe zu prüfen und umzustellen.
2. **Dashboard-Routing:** Gemeinsames Dashboard-Shell mit kontext- und berechtigungsabhängiger Navigation beschlossen; konkrete Leader-Navigation und Routen noch offen.
3. **Plattformidentität:** Frühere öffentliche Plattformregistrierung versus Leader-exklusiver Plattformverwaltungszugriff fachlich präzisieren.
4. **Betriebsmodell:** Eine Claninstanz je Clan versus gemeinsam gehostete Multi-Tenant-Lösung ausdrücklich entscheiden.
5. **Quellenabgleich:** Nicht vollständig geprüfte Whiteboard-Policies und Mock-up-Details als noch nicht abschließend verifiziert behandeln.

## 13. Aktueller Entwicklungsstand

Die vier Projekte der .NET-Solution sind angelegt.

Die grundlegende Blazor-Anwendung, das Routing und ein Loginformular wurden bereits vorbereitet und im Code-Review besprochen.

Das Loginformular enthält bislang Eingabevalidierung, jedoch noch keine vollständige produktive Anmeldung über ASP.NET Core Identity.

Tailwind CSS 4 ist weiterhin vorgesehen, während aktuell Bootstrap verwendet wird.

Die vollständige Implementierung der fachlichen Domänen, Sicherheitsrichtlinien und Datenbankmodelle erfolgt in späteren Entwicklungsschritten.

---

## v1.0 – Ergänzende fachliche Architektur
Die Fachmodule `LICENCE`, `SUPPORT_TICKET`, `NOTIFICATIONS`, `AUDIT_LOG` und `FILE_UPLOAD` bilden zusammen die Lizenz- und Supportprozesse ab. Sie bleiben Module innerhalb der vier bestehenden .NET-Projekte, keine neuen Microservices.

- **Domain:** Lizenzstatus, Slotgrenzen, Fristen, Ticketstatus, Invarianten.
- **Application:** transaktionale Mitgliedschaftsaktivierung, Zahlungsbestätigungen, Eskalationen, Lösch-/Restore-Orchestrierung.
- **Infrastructure:** PostgreSQL-Persistenz, Scheduler/Outbox, Zahlungsprovider-Adapter, verschlüsselte Backups, Benachrichtigungskanäle und sicherer Dateispeicher.
- **Web:** berechtigungsgeprüfte Leader- und Support-Dashboards, inklusive eingeschränkter Nutzung unter Lizenzsperren.

**Zustandsmodell:** `TRIAL`, `STANDARD`, `UNLIMITED` sind Lizenzformen; `PENDING_ACTIVATION`, `SLOT_LIMIT_LOCKED`, `PAYMENT_OVERDUE_LOCKED`, `RESTORING` sind getrennt zu modellierende Prozess-/Sperrzustände. Eine aufgehobene Zahlungssperre darf andere Sperren nicht implizit aufheben.

**Konsistenz:** Slotprüfungen, Zahlungen und Jobwirkungen transaktional/idempotent behandeln; vor irreversibler Löschung Voraussetzungen und Backupintegrität erneut prüfen. Ein Anbieter-Webhook allein ist kein unkritisch vertrauenswürdiger Zahlungsnachweis.

**Sicherheit:** Ticketzugriff scoped auf Leader bzw. autorisierten Support; Uploads auf Größe, Typ und Inhalt prüfen; Benachrichtigungen ohne vertrauliche Inhalte; privilegierte Aktionen mit Step-up und Audit.

**Offen:** Konkreter Zahlungsprovider, Backup-Storage, Scheduler-Bibliothek, WhatsApp-Anbieter, Betriebs-/Mandantengrenze und datenschutzrechtliche Ausgestaltung.

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

### Architekturelle Umsetzung
- Domain: Zustandsautomaten und Invarianten für Membership, LicencePeriod, Match und FinanceLedger.
- Application: autorisierte Use Cases und getrennte Permission/Scope-Policies; kein Sicherheitsvertrauen in Blazor-UI.
- Infrastructure: PostgreSQL-Constraints und Transaktionen, Identity, Outbox/Idempotency, Secret-Management, Audit, Hintergrundjobs und Backup/Restore.
- Web: gemeinsames berechtigungsabhängiges Dashboard, serverseitiger Onboarding-Draft und nutzerbezogene Zeitzonendarstellung.

---

## Fortschreibung 17.11.2026 – Sitzungs- und Inaktivitäts-Policies

**Geltung:** Diese bestätigten fachlichen Vorgaben haben bei Widersprüchen Vorrang vor älteren Aussagen zum Sitzungsmanagement. Sie sind **Soll-Anforderungen**, kein Nachweis bereits implementierter Funktionen.

- **SEC-SESSION-001 – Eine Sitzung:** Pro Plattformaccount ist zu jedem Zeitpunkt höchstens **eine aktive authentifizierte Sitzung** erlaubt (`MAX_ACTIVE_SESSIONS = 1`, nicht deaktivierbar). Die Durchsetzung erfolgt serverseitig und geräte-/browserübergreifend. Ein zweiter erfolgreicher Login muss atomar eine eindeutige aktive Sitzung bestimmen und die bisherige Sitzung widerrufen; konkurrierende Logins dürfen nicht zu zwei gültigen Sitzungen führen.
- **SEC-SESSION-002 – Wirksamer Widerruf:** Eine widerrufene Sitzung darf trotz vorhandenen Identity-Cookies oder offener Blazor-Interactive-Server-Verbindung keine geschützten Daten oder Aktionen mehr erhalten. Sitzungszustand und Berechtigungen werden serverseitig geprüft. Logout und sicherheitsrelevante Account-Ereignisse invalidieren die jeweils betroffenen Sitzungen.
- **SEC-IDLE-001 – Session-Idle-Policy:** Für authentifizierte Sitzungen sind als konfigurierbare Inaktivitätsgrenzen **15, 30 oder 45 Minuten** vorgesehen. Vor dem automatischen Sitzungsende wird **30 Sekunden** vorher gewarnt. Der endgültige Ablauf ist serverseitig durchzusetzen; die Browserwarnung allein ist keine Sicherheitskontrolle.
- **SEC-IDLE-002 – Policy-Änderungen:** Wird die Inaktivitätsgrenze administrativ geändert, gilt die neue Regel unmittelbar für bestehende aktive Sitzungen; deren Inaktivitätszähler beginnt mit dem wirksamen Änderungszeitpunkt neu. Änderungen benötigen geeignete Permission, Step-up und Audit. Ein bereits abgelaufener oder widerrufener Zugang darf dadurch nicht reaktiviert werden.
- **SEC-IDLE-003 – Aktivität:** Nur überprüfbare echte Benutzeraktivität zählt; automatische Polling-, Heartbeat- oder Blazor-Verbindungsereignisse dürfen den Timeout nicht unbegrenzt verlängern. Die genaue serverseitig verifizierbare Aktivitätsdefinition ist vor Umsetzung festzulegen.
- **Abgrenzung:** Session-Idle (Minuten), Clanmitglieds-Inaktivität (30–365 Tage, Default 90 Tage; `DISABLED`/`WARN_ONLY`/`AUTO_LOCK`) und Onboarding-Wiederaufnahme (30 Minuten nach Verbindungsabbruch) sind **drei unabhängige Regelwerke**.
- **Offene technische Präzisierungen:** Default der neuen 15/30/45-Minuten-Auswahl (historisch 60 Minuten), Warnungs-/Reconnection-Verhalten, Ablauf bei parallelen Anmeldungen und genaue Prüfintervalle. Keine stillschweigende Default-Festlegung.

**Verbindliche Abnahmefälle:** Zweiter Login widerruft ersten; zwei parallele Logins erzeugen höchstens eine aktive Sitzung; ein widerrufenes Cookie und ein offener Blazor-Circuit ermöglichen keinen Zugriff; Warnung erfolgt 30 Sekunden vor Timeout; Änderung der Idle-Policy wirkt sofort und startet den Zähler neu; Hintergrund-Polling verlängert keine Sitzung; Clanmitglieds-Inaktivität und Onboarding-Frist bleiben unabhängig.
