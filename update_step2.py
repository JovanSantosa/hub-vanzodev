target_path = r'C:\Hermes\vanzodev-vps-workspace\projects\hub-vanzodev\resources\views\index.blade.php'

with open(target_path, 'r', encoding='utf-8') as f:
    html = f.read()

# CSS untuk Calendar
calendar_css = '''
        /* ===== MAC OS STYLE CALENDAR WINDOW ===== */
        .calendar-wrapper {
            padding: 18px 20px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .cal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .cal-month-year {
            font-size: 16px;
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--text-main);
        }

        .cal-nav {
            display: flex;
            gap: 6px;
        }

        .cal-btn {
            background: var(--win-surface);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            width: 26px;
            height: 26px;
            border-radius: 6px;
            display: grid;
            place-items: center;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.15s ease;
        }

        .cal-btn:hover {
            border-color: var(--border-active);
        }

        .cal-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 4px;
            text-align: center;
        }

        .cal-dow {
            font-family: var(--font-mono);
            font-size: 10px;
            font-weight: 600;
            color: var(--text-muted);
            padding-bottom: 6px;
            text-transform: uppercase;
        }

        .cal-day {
            aspect-ratio: 1;
            display: grid;
            place-items: center;
            border-radius: 6px;
            font-size: 12px;
            font-family: var(--font-mono);
            color: var(--text-main);
            cursor: pointer;
            transition: background 0.15s;
        }

        .cal-day:hover:not(.is-empty) {
            background: var(--win-surface);
        }

        .cal-day.is-today {
            background: var(--accent-color);
            color: #fff;
            font-weight: 700;
        }

        .cal-day.is-empty {
            cursor: default;
            opacity: 0;
        }

        .cal-footer {
            padding-top: 10px;
            border-top: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 11px;
            color: var(--text-muted);
        }

        .cal-status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #22c55e;
            display: inline-block;
            margin-right: 6px;
            box-shadow: 0 0 6px #22c55e;
        }
'''

# Tambah CSS sebelum </style>
html = html.replace('    </style>', calendar_css + '\n    </style>')

# Tambah Calendar Window HTML sebelum <!-- 3. ROADMAP & TASKS WINDOW -->
calendar_win_html = '''        <!-- 2.5 CALENDAR WINDOW -->
        <div class="window is-hidden" id="calendarWin" style="left: 30%; top: 14%; width: 340px; height: 395px;">
            <div class="window-bar" onmousedown="dragWindow(event, 'calendarWin')">
                <div class="window-lights">
                    <button class="window-light window-light-close" onclick="toggleWindow('calendarWin')"></button>
                    <button class="window-light window-light-min" onclick="toggleWindow('calendarWin')"></button>
                    <button class="window-light window-light-max" onclick="maximizeWindow('calendarWin')"></button>
                </div>
                <span class="window-title">Calendar</span>
            </div>
            <div class="window-content calendar-wrapper" style="overflow-y: hidden;">
                <div class="cal-header">
                    <span class="cal-month-year" id="calMonthYear">October 2026</span>
                    <div class="cal-nav">
                        <button class="cal-btn" onclick="changeMonth(-1)">‹</button>
                        <button class="cal-btn" onclick="changeMonth(1)">›</button>
                    </div>
                </div>
                <div class="cal-grid" id="calGrid">
                    <div class="cal-dow">Mo</div>
                    <div class="cal-dow">Tu</div>
                    <div class="cal-dow">We</div>
                    <div class="cal-dow">Th</div>
                    <div class="cal-dow">Fr</div>
                    <div class="cal-dow">Sa</div>
                    <div class="cal-dow">Su</div>
                </div>
                <div class="cal-footer">
                    <div>
                        <span class="cal-status-dot"></span>
                        <span>Open for contracts</span>
                    </div>
                    <span id="calSelectedDate">Today</span>
                </div>
            </div>
        </div>
'''

html = html.replace('        <!-- 3. ROADMAP & TASKS WINDOW -->', calendar_win_html + '\n        <!-- 3. ROADMAP & TASKS WINDOW -->')

# Tambahkan ikon Calendar ke Desktop icons
calendar_icon_html = '''        <div class="desktop-icon" id="icon-calendar" data-target="calendarWin" style="left: 120px; top: 144px;">
            <div class="desktop-icon-art">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
            </div>
            <span class="desktop-icon-label">Calendar</span>
        </div>
'''
html = html.replace('        <div class="desktop-icon" id="icon-admin"', calendar_icon_html + '\n        <div class="desktop-icon" id="icon-admin"')

# Update email di about/contact ke jovansantosa08@gmail.com
html = html.replace('jovan@vanzodev.my.id', 'jovansantosa08@gmail.com')

# Simpan perubahan step 2
with open(target_path, 'w', encoding='utf-8') as f:
    f.write(html)

print("Step 2 completed: Calendar Window, CSS, and Email updated")
