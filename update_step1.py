import re
import os

target_path = r'C:\Hermes\vanzodev-vps-workspace\projects\hub-vanzodev\resources\views\index.blade.php'

# Baca blade yang sekarang
with open(target_path, 'r', encoding='utf-8') as f:
    html = f.read()

# 1. Update Topbar: Hapus emoji berlebihan, sesuaikan dengan gaya vanzodev.my.id
old_topbar = '''        <header class="topbar">
            <div class="topbar-left">
                <span class="topbar-brand">
                    <span class="pulse-indicator" title="Pulse Telemetry: Node Active"></span>
                    <span>Vanzo OS</span>
                </span>
                <span class="admin-pill" id="adminPill" onclick="toggleWindow('adminWin')" title="Admin Mode Active">
                    <span>⚡ ADMIN</span>
                </span>
                <button class="topbar-btn" onclick="toggleSpotlight()" title="Search (Cmd+K)">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <span>Search</span>
                </button>
            </div>

            <div class="topbar-center">
                <span class="topbar-clock" id="digitalClock">12:00:00</span>
            </div>

            <div class="topbar-right">
                <button class="topbar-btn" id="soundToggleBtn" onclick="toggleSound()" title="Toggle UI Sound">
                    <span id="soundIcon">🔊</span>
                </button>
                <button class="topbar-btn" onclick="toggleTheme()" title="Toggle Dark/Light Mode">
                    <span id="themeIcon">🌙</span>
                </button>
                <button class="topbar-btn" onclick="cycleWallpaper()" title="Cycle Wallpaper">
                    <span>🖼️</span>
                </button>
            </div>
        </header>'''

new_topbar = '''        <header class="topbar">
            <div class="topbar-left">
                <span class="topbar-brand">VanzoDev</span>
                <button class="topbar-btn" onclick="toggleWindow('projectsWin')">Projects</button>
                <button class="topbar-btn" onclick="toggleWindow('calendarWin')">Calendar</button>
                <button class="topbar-btn" onclick="toggleWindow('skillsWin')">Skills</button>
                <button class="topbar-btn" onclick="toggleWindow('todoWin')">Todos</button>
                <button class="topbar-btn" onclick="toggleWindow('aboutWin')">About</button>
                <span class="admin-pill" id="adminPill" onclick="toggleWindow('adminWin')" title="Admin Mode Active">
                    <span>ADMIN</span>
                </span>
            </div>

            <div class="topbar-center">
                <span class="topbar-clock" id="digitalClock">12:00 PM</span>
            </div>

            <div class="topbar-right">
                <button class="topbar-btn" onclick="cycleWallpaper()">Wallpaper</button>
                <button class="topbar-btn" onclick="toggleTheme()">Theme</button>
                <button class="topbar-btn" onclick="resetDesktopIcons()" title="Reset icons to default grid">Reset Grid</button>
                <button class="topbar-btn" onclick="toggleSpotlight()">Search (Ctrl+K)</button>
            </div>
        </header>'''

if old_topbar in html:
    html = html.replace(old_topbar, new_topbar)
    print("Topbar updated to clean minimal nav")

with open(target_path, 'w', encoding='utf-8') as f:
    f.write(html)
print("Saved partial step 1")
