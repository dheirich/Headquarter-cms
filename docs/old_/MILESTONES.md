# Headquarter – Entwicklungsmeilensteine

> Stand: 12.11.2026 · Status: in Entwicklung
> Migration der ursprünglichen Roadmap auf C# / ASP.NET Core / Blazor / EF Core.
> **Statusregel:** Nur nachweislich abgeschlossene Aufgaben werden als erledigt markiert. Bereits besprochener Code gilt nicht automatisch als getestet oder fertig.

## Projektziel
Entwicklung einer professionellen, sicheren und modularen Clan-Management-Plattform auf Basis des Headquarter-Pflichtenheftes.

## Arbeitsweise
Schrittweise Entwicklung mit Code-Reviews, Tests, Dokumentation und praktischen Lernbeispielen.

## Aktueller technischer Rahmen
- Sprache und Plattform: C# / .NET / ASP.NET Core
- Weboberfläche: Blazor Web App mit interaktivem Server-Rendering (`InteractiveServer`)
- Struktur: Domain, Application, Infrastructure und `ClanIntern.Web` (beobachtete Projektstruktur)
- Datenzugriff: Entity Framework Core; `UseSqlServer` ist im besprochenen Code vorhanden, daher SQL Server als **aktueller Arbeitsstand**, tatsächliche Laufzeitkonfiguration noch prüfen
- UI-Styling: Bootstrap 5.3.3 derzeit eingebunden; Tailwind CSS als geplante Umstellung
- Authentifizierung: ASP.NET Core Identity als geplante Implementierung; aktuelle `LoginForm` prüft nur Modellvalidierung
- Git / GitHub, Docker und GitHub Actions für Versionsverwaltung und spätere Auslieferung

## M1 – Infrastruktur, Git und Dokumentation
**Status: In Bearbeitung**

- [x] Projektverzeichnis Headquarter erstellen (Altstand)
- [x] Git initialisieren, `.gitignore` konfigurieren und ersten Commit erstellen (Altstand)
- [x] Privates GitHub-Repository und SSH-Remote einrichten (Altstand)
- [ ] Installierte .NET-SDK-Version, Git und Entwicklungswerkzeuge prüfen und dokumentieren
- [ ] Solution und Projekte `Domain`, `Application`, `Infrastructure`, `ClanIntern.Web` sowie Referenzrichtungen überprüfen
- [ ] Architekturprinzipien und Dependency-Injection-Konfiguration dokumentieren
- [ ] Projektdokumentation fertigstellen
- [ ] Pflichtenheft v0.6 und Whiteboard-Policies übernehmen
- [ ] Änderungen committen und pushen
- [ ] M1-Lern-PDF erstellen

**Abschlusskriterium:** Repository, .NET-Projektstruktur, Dokumentation und Projektgrundlage sind nachvollziehbar eingerichtet und versioniert.

## M2 – Frontend: Blazor-Grundlagen
**Status: In Bearbeitung (Lernstand; Umsetzung nicht vollständig verifiziert)**

- [ ] Blazor Web App und Razor-Komponenten vollständig verstehen und lokal startfähig prüfen
- [x] `_Imports.razor`, `App.razor` und `Routes.razor` im Lernreview besprochen
- [x] `LoginForm.razor` im Lernreview begonnen
- [ ] Komponenten, Parameter, Events, Datenbindung und Lifecycle vertiefen
- [ ] `EditForm`, Data Annotations und Validierungsanzeigen testen
- [ ] `InteractiveServer`, Verbindungsabbruch und `ReconnectModal` nachvollziehen und testen
- [ ] Tailwind CSS einrichten; Bootstrap-Abhängigkeiten prüfen und gegebenenfalls ablösen
- [ ] Bestehendes Headquarter-Login-Design übertragen
- [ ] Responsive Design und Barrierefreiheit umsetzen
- [ ] Blazor-Komponententests einführen (z. B. bUnit)
- [ ] M2-Lern-PDF erstellen

**Abschlusskriterium:** Das Login-Design ist responsiv umgesetzt, die Blazor-Anwendung startet lokal und die wesentlichen Komponenten sind getestet.

## M3 – Backend und HTTP-API mit ASP.NET Core
**Status: Geplant**

- [ ] Verantwortlichkeiten von Domain, Application, Infrastructure und Web festlegen
- [ ] ASP.NET-Core-Endpunkte über Controller oder Minimal APIs bewusst auswählen
- [ ] Services, Interfaces und Dependency Injection verstehen und anwenden
- [ ] HTTP-/REST-Endpunkte für benötigte externe Zugriffe entwickeln
- [ ] Request-/Response-DTOs und serverseitige Eingabevalidierung einführen
- [ ] Fehlerbehandlung, ProblemDetails und strukturiertes Logging einrichten
- [ ] Authentifizierung und Autorisierung an Endpunkten berücksichtigen
- [ ] Unit- und Integrationstests schreiben
- [ ] M3-Lern-PDF erstellen

**Abschlusskriterium:** Erforderliche Anwendungsfälle sind über getestete ASP.NET-Core-Endpunkte erreichbar. Eine separate REST-API ist nur dort Pflicht, wo die Architektur sie benötigt.

## M4 – Datenbank und Datenmodell
**Status: Geplant**

- [ ] SQL-Server-Verbindung und Konfiguration überprüfen
- [ ] Entity Framework Core und `DbContext` / `AddDbContextFactory` nachvollziehen
- [ ] Fachliches ER-Diagramm erstellen
- [ ] Entitäten, Schlüssel, Relationen und Constraints modellieren
- [ ] Plattform-Accounts und Clan-Mitgliedschaften getrennt modellieren
- [ ] EF-Core-Migrationen erstellen, anwenden und testen
- [ ] Transaktionen, Concurrency und Datenintegrität testen
- [ ] Geheimnisse und Connection Strings sicher verwalten
- [ ] M4-Lern-PDF erstellen

**Abschlusskriterium:** Die grundlegenden Datenmodelle sind dokumentiert, migriert und getestet.

## M5 – Authentifizierung und Sicherheit
**Status: Geplant**

- [ ] ASP.NET Core Identity und benötigtes Account-Modell einrichten
- [ ] Registrierung und E-Mail-Verifikation
- [ ] Tatsächlichen Login und Logout implementieren (nicht nur Formularvalidierung)
- [ ] Passwort-Hashing und Passwort-Reset
- [ ] Sichere Cookie-basierte Sessions und Schutz vor CSRF
- [ ] Rollen, Permissions, Scopes und Policies
- [ ] Serverseitige Autorisierung in Komponenten, Services und Endpunkten
- [ ] MFA und Step-up-Authentifizierung gemäß Pflichtenheft
- [ ] Rate Limiting und Account-Lockout
- [ ] Sicherheitsrelevante Audit-Logs
- [ ] Sicherheits- und Autorisierungstests
- [ ] M5-Lern-PDF erstellen

**Abschlusskriterium:** Der grundlegende Account- und Sicherheitsprozess funktioniert gemäß Pflichtenheft.

## M6 – Mitglieder, Teams und Onboarding
**Status: Geplant**

- [ ] Mitgliederverwaltung
- [ ] Clan-Einladungen und Aufnahmefreigaben
- [ ] Teamverwaltung und Teamzugehörigkeiten
- [ ] Delegierbare Berechtigungen
- [ ] Titel und Badges
- [ ] Clan-Einstellungen und Security-Policies
- [ ] Domain-/Application-Logik und Blazor-Oberflächen implementieren und testen
- [ ] M6-Lern-PDF erstellen

**Abschlusskriterium:** Mitglieder und Teams können regelkonform verwaltet werden.

## M7 – Kommunikation und Inhalte
**Status: Geplant**

- [ ] News, Ankündigungen und Umfragen
- [ ] Freigabe- und Veröffentlichungsworkflows
- [ ] Öffentliches, internes und teamspezifisches Forum
- [ ] Direkt-, Gruppen-, Clan- und Teamchat
- [ ] Echtzeitkommunikation im ASP.NET-Core-Umfeld evaluieren (z. B. SignalR); Blazor-Circuit nicht mit Chat-Infrastruktur gleichsetzen
- [ ] Moderation, Wortfilter und Spam-Schutz
- [ ] Benachrichtigungen
- [ ] M7-Lern-PDF erstellen

**Abschlusskriterium:** Inhalte und Kommunikation funktionieren gemäß Rollen und Sichtbarkeitsregeln.

## M8 – Clan-Funktionen und Integrationen
**Status: Geplant**

- [ ] Warplaner und Matchorganisation
- [ ] Game- und Voice-Server-Integrationen
- [ ] Sichere Datei- und Medienuploads
- [ ] Clankasse, Transaktionen und Belege
- [ ] Externe Integrationen über geeignete Infrastructure-Adapter anbinden
- [ ] M8-Lern-PDF erstellen

**Abschlusskriterium:** Kernfunktionen und Integrationen sind sicher nutzbar und getestet.

## M9 – Plattform, Lizenzen und Administration
**Status: Geplant**

- [ ] Lizenzmodelle und Lizenzperioden
- [ ] Trial, Verlängerung und Reaktivierung
- [ ] Standard- und Unlimited-Slots
- [ ] Lizenzbasierte Funktionsfreischaltung
- [ ] Plattformadministration und kontrollierter Support-Zugriff
- [ ] Vollständige Auditierung
- [ ] M9-Lern-PDF erstellen

**Abschlusskriterium:** Lizenz- und Administrationsregeln werden serverseitig zuverlässig durchgesetzt.

## M10 – Qualität, Deployment und Release
**Status: Geplant**

- [ ] Docker-Umgebung für ASP.NET Core und Datenbank vervollständigen
- [ ] CI/CD mit GitHub Actions und `dotnet`-Build-/Test-/Publish-Schritten
- [ ] Automatisierte Tests, Dependency- und Security-Checks
- [ ] Performance, Monitoring, Logs und Health Checks
- [ ] Backup- und Recovery-Konzept
- [ ] HTTPS, Secrets und produktive Konfiguration absichern
- [ ] Deployment und Release-Vorbereitung
- [ ] M10-Lern-PDF erstellen

**Abschlusskriterium:** Headquarter kann reproduzierbar, überwacht und sicher bereitgestellt werden.

---

## Lern- und Dokumentationsregeln
Nach jedem abgeschlossenen Meilenstein wird eine Lern-PDF erstellt. Jeder relevante Terminalbefehl und jedes wichtige neue Konzept wird nach diesem Schema erklärt:

1. **Befehl / Konzept:** Bezeichnung
2. **Beschreibung:** Was bedeutet es und was passiert technisch?
3. **Warum:** Weshalb benötigen wir es?
4. **Anwendungsbeispiel Bauernhof:** Anschauliches Beispiel aus dem Alltag von Bauer Heinrich.

Zusätzlich dokumentieren wir Architekturentscheidungen, Änderungen an Anforderungen und wichtige Erkenntnisse in Markdown-Dateien.

## Grundsatz
Die Meilensteine definieren die Reihenfolge der Entwicklung, nicht den vollständigen Funktionsumfang. Maßgeblich bleiben das Pflichtenheft und die vereinbarten Whiteboard-Policies. Offene Anforderungen werden nicht stillschweigend gestrichen; sie werden vor ihrer Umsetzung fachlich konkretisiert.

## Migrationshinweis
Diese Fassung ersetzt technologiespezifische Aufgaben aus der ursprünglichen Next.js-/NestJS-/Prisma-/PostgreSQL-Planung. Fachliche Ziele und Meilensteinreihenfolge bleiben erhalten. Nicht vorliegende Architektur- und Entscheidungsdokumente werden nicht als bereits geprüft ausgegeben.
