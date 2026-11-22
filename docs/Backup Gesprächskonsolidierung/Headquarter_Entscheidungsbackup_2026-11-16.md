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
