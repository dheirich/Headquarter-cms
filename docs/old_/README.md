# ClanIntern / Headquarter

**ClanIntern** ist die .NET-Implementierung der Clan-Management-Plattform **Headquarter** (`clanhq.org`). Ziel ist eine sichere, modular erweiterbare Anwendung für die Verwaltung und Kommunikation eines Gaming-Clans mit mehreren Teams.

> **Stand 12.11.2026:** In Entwicklung. Die vier .NET-Projekte, eine grundlegende Blazor-Anwendung, Routing und ein Loginformular sind vorbereitet. Das Formular enthält bislang Eingabevalidierung, **keine vollständige produktive Anmeldung**.

## Geplanter Funktionsumfang

Mitglieder und Teams; Einladungen und Onboarding; Rollen, Permissions, Scopes und Sicherheitsrichtlinien; News, Forum und Chat; War-/Matchplanung; Game- und Voice-Server-Status; Clankasse; Uploads; Benachrichtigungen; Lizenz- und Slotverwaltung; Audit-Logs.

Eine Claninstanz verwaltet genau einen Clan. Plattform-Account, Clanmitgliedschaft, Rolle und Lizenz sind voneinander getrennt.

## Technologie

| Bereich | Festlegung |
|---|---|
| Sprache und Laufzeit | C#, .NET 10 |
| UI | Blazor Web App, Razor Components, Interactive Server |
| Web-/Anwendungsplattform | ASP.NET Core |
| Accounts | ASP.NET Core Identity als technische Basis |
| Persistenz | Microsoft SQL Server, Entity Framework Core 10 |
| Styling | Tailwind CSS 4 (Ziel), Bootstrap (vorübergehend) |
| Architektur | Modularer Monolith mit vier .NET-Projekten |
| Versionsverwaltung | Git und privates GitHub-Repository |
| Qualität und Betrieb | Tests, Dokumentation; Docker und CI/CD geplant |

Frühere Angaben zu Next.js, NestJS, Prisma, Angular oder C++/Drogon sind historische Planungsstände und gehören nicht zum aktuellen Zielstack.

## Solution-Aufbau

```text
ClanIntern/
├── ClanIntern.Domain/          # Fachliche Modelle, Regeln, Invarianten
├── ClanIntern.Application/     # Anwendungsfälle, Services, Schnittstellen
├── ClanIntern.Infrastructure/  # EF Core, SQL Server, Identity, Integrationen
├── ClanIntern.Web/             # Blazor UI und ASP.NET-Core-Einstieg
└── docs/                       # Dokumentation (sofern im Repository angelegt)
```

Die Darstellung ist eine **konzeptionelle Übersicht**; der tatsächliche Verzeichnisbaum ist im Repository zu prüfen. Domain bleibt unabhängig; Application verwendet Domain; Infrastructure implementiert technische Schnittstellen; Web bindet die Dienste ein. Ein separates REST-Backend ist für Blazor Interactive Server nicht erforderlich.

## Lokale Entwicklung

Voraussetzungen: .NET SDK 10, Git und eine passende SQL-Server-Entwicklungsumgebung, **sobald die Datenbankintegration benötigt wird**. Details zu Connection Strings, Migrationen und Startprofilen richten sich nach dem tatsächlichen Repository.

Beispielbefehle aus dem Solution-Verzeichnis:

```bash
dotnet --info
dotnet restore
dotnet build
dotnet run --project ClanIntern.Web
```

Die Befehle setzen voraus, dass die Solution und das Web-Projekt unter diesen Namen vorliegen. Eine vollständig eingerichtete SQL-Server-/Identity-Integration ist noch nicht bestätigt. Zugangsdaten gehören in User Secrets oder sichere Umgebungsvariablen, niemals ins Repository.

## Sicherheitsprinzipien

- Jede geschützte Aktion wird **serverseitig** autorisiert.
- `ROLE != PERMISSION != SCOPE != POLICY`
- `PLATFORM_ACCOUNT != CLAN_MEMBERSHIP != ROLE != LICENCE`
- Keine Selbstberechtigung; MFA für privilegierte Rollen; Step-up bei kritischen Aktionen.
- Maximal eine aktive Session pro Account; kritische Aktionen auditieren.
- Keine Secrets im Klartext protokollieren; Clan-Policies dürfen die Sicherheitsbaseline nicht abschwächen.

**ASP.NET Core Identity setzt diese projektspezifischen Regeln nicht automatisch vollständig um.**

## Entwicklungsstand und nächste Schritte

1. Dokumentation und fachliche Anforderungen konsolidieren.
2. Login und ASP.NET Core Identity integrieren; serverseitige Autorisierung, Sessionregeln und Sicherheitstests.
3. Datenmodell und EF-Core-Migrationen; anschließend fachliche Module iterativ umsetzen.
4. Tailwind CSS 4 integrieren und Bootstrap schrittweise ablösen.

Die verbindliche Reihenfolge steht in `MILESTONES.md`; dort können noch historische Technologien stehen, bis die Datei ebenfalls überarbeitet wird. **Nicht** aus der Reihenfolge auf bereits fertiggestellte Funktionen schließen.

## Dokumentation

- `REQUIREMENTS.md`: fachliche Anforderungen, offene Fragen und Abnahmeregeln
- `ARCHITECTURE.md`: Architektur und technische Schichten
- `DECISIONS.md`: akzeptierte Architekturentscheidungen (ADR)
- `MILESTONES.md`: Entwicklungsreihenfolge und Lernregeln
- `Pflichtenheft_v0.8.md`: konsolidierter Pflichtenheft-Entwurf

## Lern- und Dokumentationsprinzip

Schrittweise Umsetzung mit Code-Reviews, Tests und Dokumentation. Nach jedem abgeschlossenen Meilenstein wird eine Lern-PDF erstellt. Neue Befehle und Konzepte werden erklärt anhand von **Beschreibung**, **Warum** und **Bauernhof-Beispiel mit Bauer Heinrich**.

## Stand der Quellenprüfung

Das Pflichtenheft v0.7 inklusive v0.6-Anhang und die vorhandenen Markdown-Dokumente wurden berücksichtigt. Das Whiteboard-ZIP liegt vor, die **vollständige Sichtprüfung seiner 51 Nutzdateien steht noch aus**. Fachliche Regeln werden bis zur Klärung nicht stillschweigend gestrichen.
