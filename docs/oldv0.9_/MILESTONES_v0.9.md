# Headquarter – Entwicklungsmeilensteine

> Stand: 13.11.2026 · Version: 0.9 · Status: in Entwicklung
> Verbindlicher Zielstack: .NET 11 / C# / ASP.NET Core / Blazor Interactive Server / PostgreSQL / EF Core 11 / Npgsql.
> **Statusregel:** Nur nachweislich abgeschlossene Aufgaben werden als erledigt markiert. Bereits besprochener Code gilt nicht automatisch als getestet oder fertig.

## Projektziel
Entwicklung einer professionellen, sicheren und modularen Clan-Management-Plattform auf Basis des Headquarter-Pflichtenheftes.

## Arbeitsweise
Schrittweise Entwicklung mit Code-Reviews, Tests, Dokumentation und praktischen Lernbeispielen.

## Aktueller technischer Rahmen
- Sprache und Plattform: C# / .NET 11 / ASP.NET Core
- Weboberfläche: Blazor Web App mit interaktivem Server-Rendering (`InteractiveServer`)
- Struktur: Domain, Application, Infrastructure und `ClanIntern.Web` (beobachtete Projektstruktur)
- Datenzugriff: PostgreSQL mit EF Core 11 und Npgsql als **beschlossener Zielstack**. Historisches `UseSqlServer` im besprochenen Code muss überprüft und migriert werden; tatsächliche Umsetzung noch nicht verifiziert
- UI-Styling: Bootstrap 5.3.3 derzeit eingebunden; Tailwind CSS als geplante Umstellung
- Authentifizierung: ASP.NET Core Identity verbindlich bereits für Alpha 0.1; bisherige `LoginForm` prüft nach dokumentiertem Stand nur Modellvalidierung
- Git / GitHub, Docker und GitHub Actions für Versionsverwaltung und spätere Auslieferung

## Alpha 0.1 – Verbindliches erstes Lieferinkrement
**Status: Geplant / Implementierung nicht nachgewiesen**

Dieses Inkrement zieht die technisch notwendigen Teile aus M1, M2, M4 und M5 vor. Die späteren Meilensteine bleiben als Lern- und Ausbauphasen bestehen; erledigte Arbeiten werden dort nicht doppelt als offen behandelt.

- [ ] .NET-11-SDK, Solution-Build und Projekt-Referenzen verifizieren
- [ ] PostgreSQL, Npgsql, EF Core 11, Identity-Datenmodell und reproduzierbare Migration einrichten
- [ ] ASP.NET Core Identity mit echter Benutzeranmeldung und Abmeldung integrieren; keine simulierte Anmeldung
- [ ] Geschützte Dashboard-Route mit gemeinsamem Layout und minimaler berechtigungsabhängiger Navigation bereitstellen
- [ ] Identität, Clanmitgliedschaft, Clanrolle und Plattformverwaltungsrecht getrennt behandeln; Login allein verleiht keine Verwaltungsrechte
- [ ] Zugriff auf geschützte Seiten und Aktionen serverseitig prüfen; UI-Ausblendung allein reicht nicht
- [ ] Erfolgreichen/fehlgeschlagenen Login, Logout, anonymen Zugriff und unerlaubten Direktaufruf automatisiert oder nachvollziehbar testen
- [ ] Sicherheitsrelevante Login-Ereignisse ohne Klartext-Secrets protokollieren und Cookie-/CSRF-Schutz prüfen
- [ ] Releasegrenze für MFA, Step-up, Passwort-Reset und Ein-Session-Regel anhand des Pflichtenhefts explizit prüfen; nicht implementierte Baseline-Regeln verhindern eine ungesicherte produktive Freigabe
- [ ] Lokal startfähige Anwendung, Build, Datenbankmigration und Abnahmetests nachweisen und dokumentieren

**Abschlusskriterium:** Ein echter Account kann sich anmelden und abmelden, unberechtigte Personen erreichen weder geschützte Daten noch Aktionen, und das gemeinsame Dashboard zeigt nur erlaubte Funktionen. Der Nachweis erfolgt durch ausführbare Tests beziehungsweise dokumentierte Prüfschritte; das Inkrement ist keine produktive Sicherheitsfreigabe.

**Architekturregel:** Eine gemeinsame Dashboard-Struktur wird wiederverwendet. Plattform- und Clanverwaltung bleiben durch Zugriffsrechte und Kontext getrennt. Die konkrete Leader-Navigation ist noch offen und wird nicht vorweggenommen.

---

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

## M3 – Anwendungsservices und bei Bedarf HTTP-APIs mit ASP.NET Core
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

**Abschlusskriterium:** Erforderliche Anwendungsfälle sind über getestete Anwendungsservices erreichbar; HTTP-Endpunkte werden nur bei konkretem Bedarf bereitgestellt.

## M4 – Datenbank und Datenmodell
**Status: Geplant**

- [ ] PostgreSQL-Verbindung und Npgsql-Konfiguration einrichten; historische SQL-Server-Konfiguration entfernen oder bewusst migrieren
- [ ] Entity Framework Core und `DbContext` / `AddDbContextFactory` nachvollziehen
- [ ] Fachliches ER-Diagramm erstellen
- [ ] Entitäten, Schlüssel, Relationen und Constraints modellieren
- [ ] Plattform-Accounts und Clan-Mitgliedschaften getrennt modellieren
- [ ] EF-Core-Migrationen erstellen, anwenden und testen
- [ ] Transaktionen, Concurrency und Datenintegrität testen
- [ ] Geheimnisse und Connection Strings sicher verwalten
- [ ] M4-Lern-PDF erstellen

**Abschlusskriterium:** Die grundlegenden Datenmodelle sind dokumentiert, migriert und getestet.

## M5 – Authentifizierung und Sicherheit (Grundfunktionalität bereits in Alpha 0.1)
**Status: Geplant**

- [ ] ASP.NET Core Identity und benötigtes Account-Modell einrichten
- [ ] Registrierung und E-Mail-Verifikation
- [ ] Tatsächlichen Login und Logout implementieren (Pflicht bereits für Alpha 0.1; hier Erweiterung und Härtung)
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


## Abhängigkeiten und offene Festlegungen (Stand 13.11.2026)

- Die Reihenfolge M1–M10 ist eine Lern- und Themenstruktur, **keine** harte technische Sperre: Alpha 0.1 benötigt bereits Datenbank und Identity aus späteren Meilensteinen.
- Die vollständige Rollen-/Permission-/Scope-Matrix, Sonderzugriffe, Registrierung und Leader-Navigation sind vor den jeweiligen erweiterten Funktionen fachlich zu entscheiden.
- `DECISIONS.md` v0.9 und `REQUIREMENTS.md` v0.9 definieren die bestätigten Grundlagen. Der Repository-Code ist separat auf .NET 11, PostgreSQL und Npgsql zu migrieren.
- Bestehende Checklisten bleiben offen, solange keine Ausführung, Tests oder Commits nachgewiesen sind.
- Die Whiteboard-Policies und das Pflichtenheft v0.8 bleiben fachliche Referenzen; offene Konflikte sind vor Umsetzung zu klären.
