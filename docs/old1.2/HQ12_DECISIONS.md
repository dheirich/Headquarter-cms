# DECISIONS.md – konsolidierte Arbeitsfassung v1.2

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

**Entscheidungsregister:** Die konsolidierten D-01 bis D-14 sind im beiliegenden `Entscheidungsprotokoll_v1.2.md` im Detail dokumentiert; ältere Nummerierungen sind nicht ohne Zuordnung identisch.

---

## Übernommener Ausgangsstand (historische Metadaten beachten)

> **v1.0 – Konsolidierungsstand 15.11.2026:** Vorheriger v0.9-Fachbestand erhalten. Neue Lizenz-/Supportbeschlüsse sind als dokumentierte Zielanforderungen ergänzt, **nicht** als bereits implementiert. Die Originalformulierungen von LICENCE-038 bis 041 und LICENCE-054 bis 056 liegen hier nicht verlässlich vor; sie sind ausdrücklich zur Nachprüfung markiert. Vollständige Freigabe aller 56 Regeln ist deshalb noch ausstehend.

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

---

## ADR-013 – Lizenzzustände, Slots und Fristen
**Status:** Fachlich beschlossen; technische Umsetzung ausstehend.
STANDARD und TRIAL erlauben jeweils maximal 25 ACTIVE-Mitgliedschaften; Slotkontrolle ist transaktional. Downgrade- und Zahlungsfristen, Sperrzustände und Reaktivierung folgen dem LICENCE-Regelregister.

## ADR-014 – Persistente Hintergrundverarbeitung
**Status:** Fachlich beschlossen; Implementierung ausstehend.
PostgreSQL-gestützte Jobpersistenz, fünfminütiger Scheduler, idempotente Verarbeitung, definierte Retries, manuelle Fehlerprüfung und Vorbedingungen für Lösch-/Restorejobs.

## ADR-015 – Support-Ticket als eigenständiges Fachmodul
**Status:** Fachlich beschlossen; Implementierung ausstehend.
`SUPPORT_TICKET` kapselt Tickets, Nachrichten, Status, Prioritäten, Fristen, Anhänge und Eskalationen. Es ist unabhängig von allgemeinen Chatfunktionen; Lizenzsperren dürfen erforderlichen Supportzugriff nicht verhindern.

## ADR-016 – Zahlungssicherheit und Wiederherstellung
**Status:** Fachlich beschlossen; technische/gesetzliche Prüfung ausstehend.
Zahlungsbestätigung nur serverseitig verifiziert, Idempotenz gegen Doppelbelastung, kein automatisches Entsperren bei Widerspruch. Clanlöschung nur nach geprüften Fristen und Backup; Restore mit Freigabe, Step-up und Integritätsprüfung.

## ADR-017 – Kommunikationskanäle und Aufbewahrung
**Status:** Fachlich beschlossen; rechtliche Prüfung ausstehend.
E-Mail, SMS und gegebenenfalls WhatsApp sind kanalbezogen rechtlich und technisch zu prüfen. Ticketanhänge haben grundsätzlich eine 14-Tage-Löschfrist und eine Vorabbenachrichtigung; gesetzliche Aufbewahrungs-/Beweissicherungspflichten gehen vor.

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
