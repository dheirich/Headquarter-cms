# ClanIntern – Architekturentscheidungen

**Projekt:** ClanIntern / Headquarter
**Stand:** 13.11.2026 · **Revision:** 0.9 (Arbeitsfassung)
**Technologie:** .NET 11 · C# · Blazor · ASP.NET Core · Entity Framework Core · PostgreSQL / Npgsql

## Allgemeines

Dieses Dokument hält wichtige technische und architektonische Entscheidungen für ClanIntern fest.

Die Entscheidungen werden als Architecture Decision Records (ADR) dokumentiert.

Jede Entscheidung beschreibt ihren Status, die gewählte Lösung und die wesentlichen Gründe.

Die aktuelle .NET-11-Architektur ersetzt frühere Frontend-/Backend-Stacks (TypeScript, Next.js, React, NestJS, Node.js, C++23, Drogon und Angular). PostgreSQL ist erneut verbindlich, jedoch mit EF Core und Npgsql statt Prisma.

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

Die Benutzeroberfläche wird mit einer Blazor Web App auf Basis von .NET 11 entwickelt.

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

ClanIntern verwendet ASP.NET Core auf .NET 11.

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

## ADR-004 – PostgreSQL und Entity Framework Core

**Status:** Akzeptiert

**Entscheidung:**

PostgreSQL wird als relationale Datenbank verwendet.

Der Datenzugriff erfolgt über Entity Framework Core 11 mit dem Npgsql-Provider.

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
- PostgreSQL mit Prisma
- C++23 und Drogon
- Angular

Die früheren Framework-Kombinationen gehören nicht mehr zum verbindlichen Zielstack von ClanIntern. PostgreSQL wird im aktuellen Stack mit Npgsql verwendet.

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

---

## ADR-013 – Verbindlicher Stackwechsel auf .NET 11 und PostgreSQL

**Status:** Akzeptiert · **Entscheidung:** 13.11.2026

ClanIntern wird verbindlich auf **.NET 11** mit **PostgreSQL** entwickelt. Der Datenzugriff erfolgt über **Entity Framework Core 11** und den **Npgsql EF-Core-Provider**. C#, ASP.NET Core, Blazor Interactive Server, ASP.NET Core Identity und der modulare Monolith mit vier Projekten bleiben bestehen.

Diese Entscheidung **ersetzt die bisherigen .NET-10-/SQL-Server-Festlegungen** in ADR-002, ADR-003 und ADR-004 sowie allen davon abgeleiteten Dokumenten. Die Versionsangaben in diesen ADRs wurden entsprechend konsolidiert. Das frühere PostgreSQL-/Prisma-Konzept wird **nicht** wieder eingeführt.

**Umsetzung und Nachweis:** SDK/TargetFramework, NuGet-Pakete, Providerregistrierung, Connection Strings, Migrationen und Testdatenbank müssen im Repository überprüft und angepasst werden. Die Entscheidung bestätigt den Zielstack, **nicht** die bereits abgeschlossene Migration.

## ADR-014 – Identität, Clanmitgliedschaft und Plattformverwaltung

**Status:** Fachlich bestätigt; Details der Registrierung noch offen · **Stand:** 13.11.2026

Die technische Authentifizierungsidentität ist von der Berechtigung zur Plattform- und Lizenzverwaltung zu unterscheiden. Im regulären Clanmodell besitzt der Leader sowohl Clan- als auch Plattformverwaltungszugriff und darf einen Clan gründen. Andere Clanrollen erhalten keinen automatischen Plattformverwaltungszugriff. Pro Benutzer ist höchstens eine aktive Clanzugehörigkeit vorgesehen; mehrere Teamzugehörigkeiten innerhalb desselben Clans bleiben möglich.

Die öffentliche Plattformregistrierung und Gastfunktionen aus älteren Anforderungen sind **noch mit dieser Entscheidung abzugleichen**, statt sie ungeprüft zu streichen. Privilegierter Supportzugriff bleibt eine gesonderte Sicherheitsfunktion.

## ADR-015 – Berechtigungsabhängige Dashboards

**Status:** Grundsatz akzeptiert; Leader-Navigation offen · **Stand:** 13.11.2026

Die Anwendung rendert Dashboard-Navigation und Inhalte entsprechend der serverseitig geprüften Rolle, Permission, Scope, Mitgliedschaft und Lizenz. Die Mock-ups sind funktionale und responsive Orientierung, keine starre Designvorgabe. Versteckte UI-Elemente ersetzen keine serverseitige Autorisierung.

**Offen:** Ob Leader Lizenz- und Clanverwaltung in einem integrierten Dashboard oder in getrennten Bereichen verwenden, ist noch zu entscheiden.

## ADR-016 – Echte Authentifizierung als Alpha-0.1-Ziel

**Status:** Akzeptiert · **Stand:** 13.11.2026

Alpha 0.1 umfasst eine tatsächliche Anmeldung und Abmeldung mit ASP.NET Core Identity sowie geschützte Dashboard-Routen und die grundlegende berechtigungsabhängige Darstellung. Ein Loginformular mit bloßer Eingabevalidierung oder ein simuliertes Benutzerprofil genügt nicht. Weitere Sicherheitsanforderungen und ihre Release-Zuordnung sind in REQUIREMENTS, MILESTONES und Pflichtenheft konsistent zu dokumentieren.
