> **v1.0 – Konsolidierungsstand 15.11.2026:** Vorheriger v0.9-Fachbestand erhalten. Neue Lizenz-/Supportbeschlüsse sind als dokumentierte Zielanforderungen ergänzt, **nicht** als bereits implementiert. Die Originalformulierungen von LICENCE-038 bis 041 und LICENCE-054 bis 056 liegen hier nicht verlässlich vor; sie sind ausdrücklich zur Nachprüfung markiert. Vollständige Freigabe aller 56 Regeln ist deshalb noch ausstehend.

# ClanIntern / Headquarter

**Dokumentversion:** 1.0 · **Stand:** 13.11.2026 · **Status:** In Entwicklung

ClanIntern ist die geplante Full-Stack-.NET-Implementierung von **Headquarter**, einer modularen Plattform zur Verwaltung und Kommunikation von Gaming-Clans. `clanhq.org` bezeichnet den übergeordneten Plattformkontext. Der derzeitige Lieferumfang konzentriert sich auf die technische Grundlage und **Alpha 0.1**.

> **Wichtig:** Zielarchitektur und tatsächlicher Implementierungsstand sind getrennt. Die Entscheidung für .NET 11 und PostgreSQL bedeutet nicht, dass der vorhandene Code bereits migriert wurde.

## Projektziel und Umfang

Geplante fachliche Bereiche: Mitglieder und Teams, Einladungen, Rollen und Berechtigungen, Sicherheitsrichtlinien, Inhalte und Forum, Chat, War-/Matchplanung, Game-/Voice-Server-Statusintegration, Clankasse, Datei- und Medienuploads, Benachrichtigungen, Lizenz-/Slotverwaltung und Audit-Logs.

Plattform-Account, Clanmitgliedschaft, organisatorische Rolle, Permission, Scope, Policy und Lizenz sind unterschiedliche Konzepte. Ein registrierter Plattform-Account besitzt nicht automatisch eine Clanmitgliedschaft oder Verwaltungsrechte. Nach bisherigem Fachstand gehört ein Benutzer höchstens einem Clan an; eine Claninstanz verwaltet genau einen Clan. Ein gemeinsamer Multi-Tenant-Betrieb für mehrere Clans ist nicht beschlossen.

## Beschlossener Zielstack

| Bereich | Ziel |
|---|---|
| Sprache und Laufzeit | C# / .NET 11 |
| Benutzeroberfläche | Blazor Web App, Razor Components, Interactive Server |
| Backend | ASP.NET Core, modularer Monolith |
| Authentifizierung | ASP.NET Core Identity |
| Persistenz | PostgreSQL, Entity Framework Core 11, Npgsql, EF-Core-Migrationen |
| Styling | Tailwind CSS 4 als Ziel; Bootstrap derzeit als Übergang |
| Entwicklungsprozess | Git/GitHub, Tests, Markdown-Dokumentation |
| Infrastruktur | Docker, CI/CD und Hosting noch zu konkretisieren |

Historische Dokumentstände mit .NET 10 / SQL Server oder früheren JavaScript-/C++-Stacks sind keine aktuellen Technologieentscheidungen. Die Migration des Codes, der Pakete, der Connection Strings und der EF-Core-Migrationen ist separat zu prüfen.

## Architektur

Der modulare Monolith umfasst vier bestehende .NET-Projekte:

```text
ClanIntern/
├── src/
│   ├── ClanIntern.Domain/          # Fachliche Modelle, Regeln, Invarianten
│   ├── ClanIntern.Application/     # Anwendungsfälle, Services, Schnittstellen
│   ├── ClanIntern.Infrastructure/  # Persistenz, Identity, Integrationen
│   └── ClanIntern.Web/             # Blazor-UI, Routing, ASP.NET-Core-Einstieg
└── docs/                           # Dokumentation (Pfad im Repository prüfen)
```

Die Darstellung zeigt die beabsichtigte Struktur; die tatsächlichen Pfade sind im Repository zu verifizieren. Fachliche Module sind keine eigenen Microservices oder zwingend eigene .NET-Projekte. Domain bleibt unabhängig; Application verwendet Domain; Infrastructure implementiert technische Schnittstellen; Web bindet die benötigten Dienste ein. Für die interne Kommunikation mit Blazor Interactive Server ist kein separates REST-Backend vorgeschrieben; APIs können für konkrete externe Integrationen ergänzt werden.

## Identität, Dashboard und Berechtigungen

Ein **gemeinsames Dashboard-Shell** wird nach der Anmeldung verwendet. Navigation und Inhalte richten sich nach dem aktiven Plattform- bzw. Clan-Kontext und den jeweils ermittelten Berechtigungen. Es werden nicht für jede Rolle separate, fest verdrahtete Dashboards benötigt. Plattformverwaltung und Clanverwaltung bleiben fachlich getrennt.

Die Ausblendung von UI-Elementen ist keine Sicherheitsmaßnahme: Jede geschützte Aktion muss serverseitig auf Berechtigung, Scope, Mitgliedschaftsstatus, Policy und gegebenenfalls Lizenz geprüft werden. Weitere Grundsätze sind keine Selbstberechtigung, MFA für privilegierte Rollen, Step-up bei kritischen Aktionen, Auditierung und maximal eine aktive Session je Account. ASP.NET Core Identity stellt dafür Grundlagen bereit, setzt jedoch nicht alle projektspezifischen Regeln automatisch um.

## Alpha 0.1 – erstes Lieferziel

Alpha 0.1 soll eine echte, überprüfbare technische Basis liefern:

1. PostgreSQL-Anbindung und EF-Core-Datenmodell/Migrationen für die erforderliche Authentifizierung.
2. ASP.NET Core Identity mit tatsächlichem Login und Logout, nicht nur Formularvalidierung.
3. Geschützte Seiten und serverseitige Zugriffsprüfung.
4. Ein gemeinsames, nach Anmeldung erreichbares **allgemeines Plattform-Dashboard** als Einstieg; clanbezogene Module folgen schrittweise.
5. Tests für gültige/ungültige Anmeldung, Logout und unberechtigten Zugriff.

Der konkrete Umfang zusätzlicher Sicherheitsfunktionen in Alpha 0.1 und ihre Release-Gates wird in `MILESTONES.md` bzw. im Pflichtenheft abgestimmt. Eine Alpha-Demo darf nicht mit einer produktiv vollständig abgesicherten Freigabe verwechselt werden.

## Aktueller Implementierungsstand

Nach bisheriger Durchsicht existieren die vier Projekte, eine grundlegende Blazor-Anwendung, Routing und ein vorbereitetes Loginformular. **Ein produktiver Identity-Login, PostgreSQL-Migration und vollständige Sicherheitsfunktionen sind nicht als umgesetzt nachgewiesen.** Vorhandene ältere Code- und Dokumentstände können noch SQL Server/.NET 10 referenzieren. Der letzte bekannte Loginformular-Stand prüfte lediglich Eingaben.

## Lokale Entwicklung

Voraussetzungen für den **Zielstand**: .NET SDK 11, Git und eine konfigurierte PostgreSQL-Instanz. Ob der bestehende Code bereits mit diesem Stack baut, ist zu prüfen. Beispiel aus dem Repository-Stammverzeichnis:

```bash
dotnet --info
dotnet restore
dotnet build
dotnet run --project src/ClanIntern.Web --launch-profile https
```

Die konkrete Startkonfiguration ist anhand der `.csproj`-Dateien, `launchSettings.json`, Paketversionen und Datenbankkonfiguration zu validieren. Zugangsdaten gehören in User Secrets oder sichere Umgebungsvariablen, nicht ins Repository. Frühere lokale Kestrel-/TLS-Fehlerlogs belegen keine allgemeine Produktionsstörung und sind separat zu untersuchen.

## Dokumentation und Verbindlichkeit

- `REQUIREMENTS.md`: fachliche Anforderungen und offene Fragen.
- `DECISIONS.md`: akzeptierte und offene Architekturentscheidungen (ADRs).
- `ARCHITECTURE.md`: Zielarchitektur, Schichten und technische Leitplanken.
- `MILESTONES.md`: Entwicklungsreihenfolge, Status und Abnahmekriterien.
- `Pflichtenheft_v0.8.md`: bisheriger konsolidierter Fachentwurf; **v0.9 folgt**.
- Whiteboards/Mock-ups: Quellen für fachliche Prüfung; nicht jede dargestellte Funktion ist bereits freigegeben oder umgesetzt.

Bei Widersprüchen zwischen Dokumenten müssen Änderungen explizit abgestimmt werden. Die README ist ein Überblick und ersetzt keine fachliche Freigabe. Der vollständige Whiteboard-Abgleich und die Konsolidierung des Pflichtenhefts stehen noch aus.

## Lern- und Qualitätsprinzip

Schrittweise Entwicklung mit Code-Reviews, Tests, nachvollziehbaren Architekturentscheidungen und Dokumentation. Nach abgeschlossenen Meilensteinen sind Lern-PDFs vorgesehen; neue Konzepte werden mit Beschreibung, Begründung und dem Bauernhof-Beispiel mit Bauer Heinrich erklärt.

---

## Dokumentationsstand v1.0 (15.11.2026)
Diese Fassung konsolidiert den v0.9-Bestand mit den im Gespräch festgelegten Lizenz- und Supportprozessen. Neu im fachlichen Zielumfang sind unter anderem STANDARD/TRIAL-Slotgrenzen, UNLIMITED-Upgrades, Downgrade- und Zahlungsfristen, persistente Jobs, Backup/Restore und das eigenständige Modul `SUPPORT_TICKET`.

**Wichtig:** Dokumentationsversion v1.0 ist **keine Softwareversion 1.0** und kein Nachweis implementierter Funktionen. Alpha 0.1 bleibt das nächste technische Lieferziel. Der vollständige Wortlaut von acht der 56 besprochenen Regelnummern und die Einzelprüfung der Whiteboards sind noch offen.

Die fachlichen Detailregeln stehen im Pflichtenheft und im Regelregister der REQUIREMENTS; technische Konsequenzen in ARCHITECTURE/DECISIONS; Umsetzungsschritte in MILESTONES.
