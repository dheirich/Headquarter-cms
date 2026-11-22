# Headquarter / ClanIntern – Entscheidungsbackup
Stand: 16.11.2026. Gesprächs-Sicherung, kein finales Pflichtenheft und keine Sicherung sämtlicher Originaldateien.

## Projektbasis
Headquarter / ClanIntern: Fullstack C#/.NET 11, Blazor Interactive Server, ASP.NET Core Identity, PostgreSQL/EF Core 11/Npgsql, Tailwind CSS 4; modularer Monolith (Domain, Application, Infrastructure, Web). Eine Claninstanz pro Clan; ein Account höchstens eine aktive Clanmitgliedschaft; genau ein Clanleader. Gemeinsames Dashboard, serverseitige Permission-/Scope-Prüfung. Alpha 0.1: echter Login/Logout, Datenbank, geschütztes Dashboard, Tests. Umsetzung dieser Ziele noch nicht nachgewiesen.

## Verbindliche Entscheidungen aus dem Gespräch
- Trial 7 Tage; während Trial bezahlte und bestätigte Lizenz wird SCHEDULED und startet erst nach Trialende.
- STANDARD/TRIAL maximal 25 ACTIVE inklusive Leader, UNLIMITED unbegrenzt. Downgrade UNLIMITED→STANDARD zum Ende der bezahlten Periode; bei Überhang 30 Tage Grace ab Wechsel; keine automatische Entfernung. SLOT_LIMIT_LOCKED: Einladungen/Annahmen möglich, Aktivierung erst bei freiem Slot oder Unlimited; PAYMENT_OVERDUE_LOCKED: keine neuen Einladungen/Aktivierungen.
- Endgültige Mitgliedsfreigabe nur Clanleader, verpflichtend; Leader-Einladung vorab genehmigt, weiterhin Sicherheits-/Slotprüfung.
- Einladung 7/14/30 Tage, Standard 14, Frist bei Erstellung fixiert; Änderungen nur für neue Einladungen. Erneute Zustellung maximal dreimal, verlängert Frist nicht. **Neu bestätigt 16.11.:** konfigurierbarer Resend-Cooldown 12/24/48/72 Stunden, Standard 24; abgelaufene Einladung nie reaktivieren, sondern neue Einladung mit neuem Token/Frist.
- Wiederbeitritt entfernter Mitglieder ALLOWED / APPROVAL_REQUIRED (Standard) / BLOCKED; keine automatische Rollen-/Teamwiederherstellung.
- Forumssichtbarkeit von Kategorien/Posts durch Leader oder ausdrücklich delegierten Subleader; Audit/Benachrichtigung. Teamleader standardmäßig nur eigenes Teamforum.
- Subleader-Rechte ausdrücklich delegiert, keine Weiterdelegation, befristet oder unbefristet, sofort widerrufbar und serverseitig vor Commit geprüft; Audit, Benachrichtigung bei Widerruf/Verlängerung, 24h Ablaufwarnung. **Neu bestätigt 16.11.:** abgelaufene Delegation automatisch deaktiviert; erneute Vergabe nur mit ausdrücklicher Leader-Bestätigung und Audit.
- Inaktivität DISABLED / WARN_ONLY (Standard) / AUTO_LOCK. Relevante Aktivität: erfolgreicher Login und echte Nutzeraktionen (Forum, Chat, Profil, Team, Inhalte, Warplanner, Finanzen, Server-Join); keine Hintergrundjobs, Polling, Token-Refresh, Keepalive oder automatische Refreshes.
- **Neu bestätigt im SRT:** Inaktivitätsschwelle Standard 90 Tage, konfigurierbar 30–365 Tage; Vorwarnung Standard 10 Tage, ebenfalls konfigurierbar. Dies aktualisiert frühere Auswahl 30/60/90/180. AUTO_LOCK sperrt interne Clanaktionen, nicht Accountzugang/Entsperrinformation; Mitgliedschaft und Slot bleiben bestehen. Entsperrung nur manuell durch Leader oder berechtigten Subleader; Admin- und Inaktivitätssperren getrennt; Audit.
- Sicherheitsbaseline: MFA verpflichtend Leader/Subleader/Moderator/Teamleader, Member optional oder clanweit verpflichtend; maximal eine Session; Step-up für kritische Aktionen; 5 Loginfehlversuche/15 Minuten → 30 Minuten Sperre; Passwortreset 3 Fehlversuche → 15 Minuten Cooldown; Geräte-/Standortprüfung und Sicherheitsbenachrichtigungen.
- Gründungswizard: 30 Minuten Recovery nach Disconnect, neuer Disconnect setzt Frist neu; expliziter Logout verwirft Entwurf; separater 60-Minuten-Session-Idle.
- SERVER v1.2 nur Status, Spieler, Kanäle, Join; keine Remote-Restarts, Shutdowns oder Backups.
- 50 eindeutige Whiteboard-Bilder, 49 HEIC und 1 JPG; sieben LICENCE-038–041 und 054–056 Korrekturtexte separat vorhanden, endgültige Zusammenführung noch offen.
- Originaldokumente unverändert erhalten; finale Dokumentations-ZIP erst nach offenen Fachentscheidungen und vollständiger Konsolidierung.

## Nächste offene Entscheidungen
Passwortreset-Selbstservice vs Adminfreigabe; risikobasierte Auslands-IP-Prüfung; Profil- und Clan-Sichtbarkeit; Namens-/Avataränderungen; Teamleader-Rollenmodell; vollständige Permission-Matrix; Lizenzlaufzeiten/Upgrade-Zeitachse; Finanz-/Audit-Retention; Upload-/Warplanner-Details; Hosting/CI/CD/Monitoring.

## Wiederaufnahme
Bitte nach einem Chatabbruch dieses Backup hochladen und sagen: „Setze die Headquarter-Entscheidungsrunde fort, in Dreierblöcken, ohne bestätigte Fragen zu wiederholen.“ 


---

## Fortschreibung – 16.11.2026, ca. 17:40 Uhr (Europe/Berlin)

**Quelle:** Vom Nutzer bereitgestelltes SRT-Gespräch. Diese Fortschreibung ergänzt den früheren Checkpoint und dokumentiert ausdrücklich bestätigte Entscheidungen. Sie ist kein vollständiges Originaldatei-/Whiteboard-Archiv und keine endgültige Dokumentationsfreigabe.

### Bestätigter 15er-Block – Team, Content, Forum und Chat
Der Nutzer bestätigte alle 15 Punkte ausdrücklich mit „Ja, bitte alle übernehmen“:

1. Teamleader ist eine zusätzliche Teamfunktion, keine zweite organisatorische Clanrolle.
2. Ein Mitglied kann mehrere Teams leiten, ausschließlich nach ausdrücklicher Leader-Freigabe.
3. Teamleader-Wechsel werden auditiert; jedes Team hat genau einen aktiven Teamleader.
4. Änderungen an Teamname, Teamlimit oder Teamlogo benötigen Clanleader- oder berechtigte Subleader-Freigabe.
5. Teamleader dürfen Mitglieder aus dem eigenen Team, nicht aus dem Clan entfernen.
6. Inhalte erstellen/bearbeiten und veröffentlichen sind getrennte Berechtigungen.
7. Einreichungen werden begründet genehmigt/abgelehnt und protokolliert.
8. Veröffentlichte Ankündigungen erhalten eine nachvollziehbare Versionshistorie.
9. Interne Informationen dürfen nur mit gesonderter Freigabe öffentlich werden.
10. Umfragen: eine Stimme pro berechtigtem Mitglied, außer ausdrücklich vorgesehener Mehrfachauswahl.
11. Moderation nur in ausdrücklich freigegebenen Foren/Chats.
12. Löschen per Soft-Delete; Wiederherstellung nur mit Berechtigung.
13. Eigene Nachrichten bearbeitbar, Änderungen nachvollziehbar.
14. Stummschaltungen können befristet sein, sind auditierbar und enden automatisch.
15. Serverseitiger, nicht umgehbarer Spam-Schutz.

### Bestätigter 10er-Block – Foren, Finanzen, Warplanner und Zugriffe bei Lizenzablauf
Der Nutzer bestätigte alle 10 Punkte mit „Ja“:

1. Forenbereiche und Sichtbarkeit nur durch Leader oder ausdrücklich berechtigte Subleader.
2. Vertrauliche Bereiche bleiben auch bei öffentlichen anderen Bereichen geschützt.
3. Rollen-/Team-Chat-Einladungen folgen nachvollziehbaren Regeln und Protokollierung.
4. News nur nach Freigabe veröffentlichen; Entwürfe intern.
5. Finanztransaktionen nur Leader/delegierte Finanzrolle, immer auditiert.
6. Unveränderliche Buchungen; Korrektur ausschließlich durch Gegenbuchung.
7. Änderungen an bestätigten Warplanner-Einträgen mit Begründung und Protokoll.
8. Persönlicher Datenexport bleibt auch bei Lizenzablauf verfügbar.
9. Support und Rechnungen bleiben bei Lizenzablauf zugänglich.
10. Sicherheits-Audits unveränderlich und nur für ausdrücklich Berechtigte lesbar.

### Zuletzt bestätigter 10er-Block – Clan-Stammdaten, Sichtbarkeit, Design und Zahlungsbelege
Der Nutzer bestätigte diese **zehn**, nicht fünfzehn, mit „Ja“ und verlangte danach ein Backup:

1. Je Clan-Stammdatenfeld Sichtbarkeit PUBLIC / INTERNAL / HIDDEN.
2. Standard: Clanname, Tag, Logo, Beschreibung und Region PUBLIC; Mitglieder-, Team- und Serverlisten INTERNAL; Kontakt-E-Mail HIDDEN.
3. Sichtbarkeit nur durch Clanleader/ausdrücklich berechtigte Subleader ändern; Audit.
4. Clan-Einstellungen dürfen persönliche Datenschutzpräferenzen nicht abschwächen.
5. Sensible Clan-Stammdatenänderungen benötigen Step-up.
6. Clanleader setzt Standarddesign; Mitglieder wählen persönlichen Hell-/Dunkelmodus.
7. Designänderungen ohne Step-up, aber mit Audit.
8. Website, Social Links und Kontakte: getrennte Lese- und Änderungsrechte.
9. Zahlungs-PDF: Clanname, Zahler, Datum, Betrag, Transaktions-ID, Empfänger, Kategorie, Zahlungsstatus.
10. Beiträge und Spenden getrennt ausweisen.

**Wichtige Abgrenzung:** Die danach in einer anderen Antwort zusätzlich genannten Punkte „Bankdatenzugriff“, „zehnjährige Aufbewahrung“, „Warplanner-Statusmodell“, „Teilnahmestatus“ und „Benachrichtigungskategorien“ wurden in diesem letzten SRT-Abschnitt **nicht** bestätigt. Sie bleiben für die weitere Entscheidungsrunde offen, sofern nicht andernorts separat beschlossen.

### Fortsetzung
Nächste Runde: ausschließlich noch nicht bestätigte Regeln behandeln, z. B. Bankdaten-/Finanzrollen-Zugriff und Aufbewahrung, Warplanner-Status und Teilnahme, Notification-Präferenzen. Bei widersprüchlichen historischen Whiteboards neuere explizite Nutzerbeschlüsse priorisieren und Konflikte dokumentieren. Originaldateien unverändert lassen. Finale konsolidierte ZIP erst nach Abschluss der Entscheidungen.
