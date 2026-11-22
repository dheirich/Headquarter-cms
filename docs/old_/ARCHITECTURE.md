# ClanIntern – Softwarearchitektur

**Projekt:** ClanIntern / Headquarter
**Technologiestand:** 12.11.2026
**Architekturstil:** Modularer Monolith mit vier .NET-Projekten

## 1. Architekturziel

ClanIntern soll modular, sicher, wartbar, erweiterbar und testbar sein.

Die Anwendung wird vollständig auf Basis des Microsoft-.NET-Ökosystems entwickelt.

Die fachlichen Anforderungen aus dem Pflichtenheft und den vereinbarten Whiteboard-Policies bleiben unabhängig vom verwendeten Technologie-Stack bestehen.

## 2. Technologie-Stack

### Frontend

- .NET 10
- Blazor Web App
- Razor Components
- C#
- Interactive Server Render Mode
- Tailwind CSS 4 als verbindliches CSS-Ziel
- Bootstrap als vorübergehende Lösung während der Entwicklung

### Backend

- .NET 10
- ASP.NET Core
- C#
- ASP.NET Core Dependency Injection
- ASP.NET Core Identity für Authentifizierung und Accountverwaltung
- Serverseitige Anwendungslogik innerhalb der bestehenden Solution

### Datenbank

- Microsoft SQL Server
- Entity Framework Core 10
- EF Core SQL Server Provider
- EF Core Migrations
- LINQ

### Entwicklung und Qualität

- .NET SDK 10
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
- Microsoft SQL Server
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

Der Datenzugriff erfolgt über Entity Framework Core und Microsoft SQL Server.

Die technische Datenbankimplementierung gehört in `ClanIntern.Infrastructure`.

Fachliche Geschäftsregeln dürfen nicht ausschließlich in der Benutzeroberfläche oder in Datenbankzugriffskomponenten umgesetzt werden.

Datenbankmigrationen, Transaktionen, Constraints und Indizes werden entsprechend den fachlichen Anforderungen eingesetzt.

## 9. Dokumentation und Architekturentscheidungen

Wichtige technische Entscheidungen werden in `DECISIONS.md` dokumentiert.

Die Entwicklungsreihenfolge wird in `MILESTONES.md` festgehalten.

Die fachlichen Anforderungen werden durch `REQUIREMENTS.md`, das Pflichtenheft und die vereinbarten Whiteboard-Policies beschrieben.

Offene oder widersprüchliche Anforderungen werden ausdrücklich gekennzeichnet und nicht stillschweigend verändert oder entfernt.

## 10. Aktueller Entwicklungsstand

Die vier Projekte der .NET-Solution sind angelegt.

Die grundlegende Blazor-Anwendung, das Routing und ein Loginformular wurden bereits vorbereitet und im Code-Review besprochen.

Das Loginformular enthält bislang Eingabevalidierung, jedoch noch keine vollständige produktive Anmeldung über ASP.NET Core Identity.

Tailwind CSS 4 ist weiterhin vorgesehen, während aktuell Bootstrap verwendet wird.

Die vollständige Implementierung der fachlichen Domänen, Sicherheitsrichtlinien und Datenbankmodelle erfolgt in späteren Entwicklungsschritten.