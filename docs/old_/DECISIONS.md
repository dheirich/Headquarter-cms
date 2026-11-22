# ClanIntern – Architekturentscheidungen

**Projekt:** ClanIntern / Headquarter
**Stand:** 12.11.2026
**Technologie:** .NET 10 · C# · Blazor · ASP.NET Core · Entity Framework Core · SQL Server

## Allgemeines

Dieses Dokument hält wichtige technische und architektonische Entscheidungen für ClanIntern fest.

Die Entscheidungen werden als Architecture Decision Records (ADR) dokumentiert.

Jede Entscheidung beschreibt ihren Status, die gewählte Lösung und die wesentlichen Gründe.

Die aktuelle .NET-10-Architektur ersetzt frühere Technologieentscheidungen zu TypeScript, Next.js, React, NestJS, Node.js, PostgreSQL, Prisma sowie C++23, Drogon und Angular.

Die fachlichen Anforderungen aus dem Pflichtenheft und den vereinbarten Whiteboard-Policies bleiben grundsätzlich bestehen.

---

## ADR-001 – C# als gemeinsame Programmiersprache

**Status:** Akzeptiert

**Entscheidung:**

ClanIntern verwendet C# als primäre Programmiersprache für Benutzeroberfläche, Anwendungslogik, Domänenmodelle und Infrastruktur.

**Warum:**

- Einheitliche Programmiersprache innerhalb der Solution
- Statische Typprüfung
- Gute Wartbarkeit und Erweiterbarkeit
- Gemeinsame Nutzung von Modellen und Schnittstellen
- Integration in das .NET-Ökosystem

Razor Components verwenden zusätzlich Razor-Markup sowie HTML und CSS. JavaScript wird bei Bedarf für browserseitige Funktionen eingesetzt.

---

## ADR-002 – Blazor als Benutzeroberfläche

**Status:** Akzeptiert

**Entscheidung:**

Die Benutzeroberfläche wird mit einer Blazor Web App auf Basis von .NET 10 entwickelt.

Die UI besteht aus Razor Components.

**Warum:**

- Komponentenbasierte Entwicklung
- Verwendung von C# für interaktive Benutzeroberflächen
- Integriertes Routing und Layoutsystem
- Unterstützung für Formulare und Validierung
- Enge Integration mit ASP.NET Core
- Keine separate React- oder Angular-Anwendung erforderlich

---

## ADR-003 – ASP.NET Core als Web- und Anwendungsplattform

**Status:** Akzeptiert

**Entscheidung:**

ClanIntern verwendet ASP.NET Core auf .NET 10.

Die Anwendung wird als modularer Monolith entwickelt.

Ein separates REST-Backend für die Kommunikation zwischen der Blazor-Oberfläche und der Anwendungslogik ist nicht vorgesehen.

**Warum:**

- Gemeinsame Laufzeit für Webanwendung und serverseitige Logik
- Integrierte Dependency Injection
- Unterstützung für Authentifizierung und Autorisierung
- Integriertes Logging und Konfigurationssystem
- Klare Trennung der Verantwortlichkeiten über mehrere Projekte

HTTP-APIs können später ergänzt werden, wenn externe Anwendungen oder Integrationen diese benötigen.

---

## ADR-004 – Microsoft SQL Server und Entity Framework Core

**Status:** Akzeptiert

**Entscheidung:**

Microsoft SQL Server wird als relationale Datenbank verwendet.

Der Datenzugriff erfolgt über Entity Framework Core 10 mit dem SQL-Server-Provider.

**Warum:**

- Relationale Datenmodellierung
- Unterstützung für Transaktionen und Datenintegrität
- Primär- und Fremdschlüssel
- LINQ für Datenbankabfragen
- EF Core Migrations zur Weiterentwicklung des Datenbankschemas
- Integration mit ASP.NET Core Identity

Die konkrete Datenbankimplementierung gehört in `ClanIntern.Infrastructure`.

---

## ADR-005 – Gemeinsames Repository und .NET-Solution

**Status:** Akzeptiert

**Entscheidung:**

Alle Projekte der Anwendung werden in einem gemeinsamen Git-Repository und einer .NET-Solution verwaltet.

Die Solution besteht aus:

- `ClanIntern.Domain`
- `ClanIntern.Application`
- `ClanIntern.Infrastructure`
- `ClanIntern.Web`

**Warum:**

- Gemeinsame Versionsverwaltung
- Übersichtliche Projektstruktur
- Klare Verantwortlichkeiten
- Einheitlicher Build-Prozess
- Einfachere Zusammenarbeit zwischen Entwicklungsumgebungen

Eine separate Frontend-/Backend-Monorepo-Struktur mit `apps/web`, `apps/api` und `packages` wird nicht verwendet.

---

## ADR-006 – Fachliche Domänentrennung

**Status:** Akzeptiert

**Entscheidung:**

Geschäftsregeln werden fachlichen Domänen zugeordnet und möglichst unabhängig von Frameworks und Datenbanken gehalten.

Die technische Struktur orientiert sich an Clean Architecture.

**Warum:**

- Testbarkeit
- Wartbarkeit
- Klare Verantwortlichkeiten
- Geringere technische Kopplung
- Erweiterbarkeit

Die vier Projekte übernehmen folgende Aufgaben:

- **Domain:** Fachliche Modelle, Regeln und Invarianten
- **Application:** Anwendungsfälle, Services und Schnittstellen
- **Infrastructure:** Datenbankzugriff und technische Implementierungen
- **Web:** Blazor-Oberfläche und ASP.NET-Core-Anwendungseinstieg

Die fachlichen Domänen wie MEMBER, TEAM, SECURITY, LICENCE, FINANCE, CHAT und FORUM bleiben unabhängig von dieser technischen Projektaufteilung bestehen.

---

## ADR-007 – Sicherheit und Berechtigungen

**Status:** Akzeptiert

**Entscheidung:**

Rollen, Permissions, Scopes und Policies werden fachlich getrennt behandelt.

Jede geschützte Aktion muss serverseitig autorisiert werden.

**Warum:**

- Schutz vor unberechtigten Zugriffen
- Verhinderung von Rechteausweitung
- Nachvollziehbare Sicherheitsentscheidungen
- Durchsetzung fachlicher Sicherheitsrichtlinien

Es gelten insbesondere folgende Grundsätze:

`ROLE != PERMISSION != SCOPE != POLICY`

`PLATFORM_ACCOUNT != CLAN_MEMBERSHIP != ROLE != LICENCE`

Zusätzlich gelten die Sicherheitsanforderungen des Pflichtenhefts:

- Keine Selbstberechtigung
- MFA-Pflicht für privilegierte Rollen
- Step-up-Authentifizierung bei kritischen Aktionen
- Maximal eine aktive Session pro Account
- Auditierung sicherheitskritischer Aktionen
- Keine Speicherung von Secrets im Klartext in Audit-Logs
- Keine Abschwächung der verbindlichen Sicherheitsbaseline durch Clan-Policies

Diese Regeln müssen in der Anwendungslogik umgesetzt werden. Die Sichtbarkeit oder Unsichtbarkeit von Blazor-Komponenten ist keine ausreichende Autorisierung.

---

## ADR-008 – Git und GitHub

**Status:** Akzeptiert

**Entscheidung:**

Git wird für die lokale Versionsverwaltung verwendet.

Ein privates GitHub-Repository dient der zentralen Versionsverwaltung und der Zusammenarbeit zwischen macOS und Windows.

**Warum:**

- Nachvollziehbare Änderungen
- Versionshistorie
- Plattformübergreifende Entwicklung
- Sicherung und Austausch des Quellcodes
- Unterstützung für spätere automatisierte Build- und Testprozesse

Secrets, lokale Zugangsdaten und generierte Build-Artefakte dürfen nicht in das Repository übernommen werden.

---

## ADR-009 – Blazor Interactive Server

**Status:** Akzeptiert

**Entscheidung:**

Interaktive Razor Components verwenden den Interactive Server Render Mode.

**Warum:**

- Interaktive Komponenten werden serverseitig ausgeführt.
- Die Benutzeroberfläche kommuniziert über eine bestehende Blazor-Verbindung mit dem Server.
- Anwendungsservices können serverseitig eingebunden werden.
- Für die grundlegende UI-Kommunikation ist keine separate REST-API erforderlich.

**Technische Konsequenzen:**

- Interaktive Funktionen benötigen eine funktionierende Serververbindung.
- Verbindungsabbrüche müssen angemessen behandelt werden.
- Die Anwendung berücksichtigt Wiederverbindungsversuche und mögliche Sitzungsverluste.
- Skalierung und Betrieb müssen die Anforderungen serverseitiger Blazor-Verbindungen berücksichtigen.

---

## ADR-010 – ASP.NET Core Identity

**Status:** Akzeptiert

**Entscheidung:**

ASP.NET Core Identity wird als technische Grundlage für die Authentifizierung und Accountverwaltung verwendet.

Die Integration erfolgt über die Infrastructure-Schicht.

**Warum:**

- Etablierte Integration in ASP.NET Core
- Unterstützung für Benutzer- und Passwortverwaltung
- Passwort-Hashing
- Account-Lockout
- Sicherheits-Token
- Unterstützung für Multi-Faktor-Authentifizierung
- Integration mit Entity Framework Core

**Wichtige Einschränkung:**

ASP.NET Core Identity erfüllt nicht automatisch alle projektspezifischen Sicherheitsanforderungen.

Insbesondere die Begrenzung auf eine aktive Session, das fachliche Berechtigungsmodell, Step-up-Authentifizierung und spezielle Sicherheitsrichtlinien müssen gesondert umgesetzt beziehungsweise angepasst werden.

---

## ADR-011 – Tailwind CSS 4 als verbindliches UI-Ziel

**Status:** Akzeptiert

**Entscheidung:**

Tailwind CSS 4 wird als verbindliche CSS-Lösung für die zukünftige Benutzeroberfläche verwendet.

Bootstrap dient derzeit als vorübergehende Lösung während der Entwicklung.

**Warum:**

- Konsistente Gestaltung
- Wiederverwendbare Utility-Klassen
- Responsive Design
- Flexible Anpassung an das ClanIntern-Design
- Einheitliche Gestaltung von Komponenten

**Technische Konsequenz:**

Die bestehende Bootstrap-Oberfläche wird schrittweise auf Tailwind CSS 4 umgestellt.

Die Tailwind-Integration und der konkrete Build-Prozess werden im entsprechenden Entwicklungsmeilenstein eingerichtet.

---

## ADR-012 – Dependency Injection und Konfiguration

**Status:** Akzeptiert

**Entscheidung:**

ClanIntern verwendet das integrierte Dependency-Injection-System von ASP.NET Core.

Services werden zentral registriert und über Konstruktoren beziehungsweise die vorgesehenen Blazor-Mechanismen bereitgestellt.

Die Infrastructure-Schicht stellt eine eigene Registrierungsfunktion bereit.

**Warum:**

- Geringere Kopplung
- Bessere Testbarkeit
- Klare Abhängigkeiten
- Austauschbarkeit technischer Implementierungen
- Zentrale Verwaltung von Service-Lebensdauern

Die Anwendung verwendet das integrierte .NET-Konfigurationssystem.

Dazu gehören insbesondere:

- `appsettings.json`
- `appsettings.Development.json`
- Umgebungsvariablen
- .NET User Secrets für lokale Entwicklungsgeheimnisse

Produktive Secrets dürfen nicht ungeschützt im Quellcode oder Repository gespeichert werden.

---

## Historische Technologieentscheidungen

Frühere Planungen verwendeten unter anderem:

- TypeScript für Frontend und Backend
- Next.js und React
- NestJS und Node.js
- PostgreSQL und Prisma
- C++23 und Drogon
- Angular

Diese Technologien gehören nicht mehr zum verbindlichen Zielstack von ClanIntern.

Die früheren Entscheidungen werden durch die aktuellen ADRs ersetzt.

Der Wechsel betrifft die technische Umsetzung, nicht automatisch die fachlichen Anforderungen.

## Noch offene technische Entscheidungen

Folgende Themen werden bei Bedarf gesondert entschieden und dokumentiert:

- Konkrete Testframeworks und Teststrategie
- Produktionshosting und Deployment
- Docker-Konfiguration
- CI/CD mit GitHub Actions
- E-Mail- und Zahlungsanbieter
- Konkrete MFA- und Step-up-Abläufe
- Implementierung der aktiven Session-Begrenzung
- Monitoring und Backup-/Recovery-Konzept
- Skalierungsstrategie für Blazor Interactive Server

Offene Entscheidungen gelten nicht als bereits umgesetzt oder verbindlich festgelegt.