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