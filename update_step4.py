target_path = r'C:\Hermes\vanzodev-vps-workspace\projects\hub-vanzodev\resources\views\index.blade.php'

with open(target_path, 'r', encoding='utf-8') as f:
    html = f.read()

# JS Tambahan: Calendar engine, Draggable persistent icons & Reset Grid, Dual Scope Todos
js_injection = '''
        // ==========================================
        // DUAL SCOPE TODOS (PUBLIC & JOVAN'S PRIVATE)
        // ==========================================
        let currentTodoScope = 'public';

        function switchTodoScope(scope) {
            currentTodoScope = scope;
            document.getElementById('tabPublicTodos').classList.toggle('is-active', scope === 'public');
            const privTab = document.getElementById('tabPrivateTodos');
            if (privTab) privTab.classList.toggle('is-active', scope === 'private');
            renderTasks(tasksData);
            playChime(520);
        }

        // ==========================================
        // MAC OS CALENDAR LOGIC
        // ==========================================
        let calCurrentDate = new Date();

        function renderCalendar() {
            const year = calCurrentDate.getFullYear();
            const month = calCurrentDate.getMonth();
            const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            
            const monthYearEl = document.getElementById('calMonthYear');
            if (monthYearEl) monthYearEl.textContent = `${monthNames[month]} ${year}`;

            const grid = document.getElementById('calGrid');
            if (!grid) return;
            while (grid.children.length > 7) {
                grid.removeChild(grid.lastChild);
            }

            let firstDay = new Date(year, month, 1).getDay();
            firstDay = (firstDay === 0) ? 6 : firstDay - 1;
            
            const totalDays = new Date(year, month + 1, 0).getDate();
            const today = new Date();

            for (let i = 0; i < firstDay; i++) {
                const emptyCell = document.createElement('div');
                emptyCell.className = 'cal-day is-empty';
                grid.appendChild(emptyCell);
            }

            for (let day = 1; day <= totalDays; day++) {
                const dayCell = document.createElement('div');
                dayCell.className = 'cal-day';
                dayCell.textContent = day;

                if (day === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                    dayCell.classList.add('is-today');
                }

                dayCell.onclick = () => {
                    document.querySelectorAll('.cal-day').forEach(d => d.style.outline = 'none');
                    dayCell.style.outline = '1px solid var(--accent-color)';
                    const selEl = document.getElementById('calSelectedDate');
                    if (selEl) selEl.textContent = `${monthNames[month]} ${day}, ${year}`;
                    playChime(450);
                };

                grid.appendChild(dayCell);
            }
        }

        function changeMonth(delta) {
            calCurrentDate.setMonth(calCurrentDate.getMonth() + delta);
            renderCalendar();
            playChime(500);
        }

        // ==========================================
        // DRAGGABLE DESKTOP ICONS WITH PERSISTENCE
        // ==========================================
        const DESKTOP_ICON_STORAGE_KEY = 'vanzo_icon_positions_v2';

        function getDefaultDesktopIconCoords() {
            const isNarrow = window.innerWidth < 768;
            const leftColX = isNarrow ? 14 : 28;
            const rightColX = isNarrow ? Math.max(leftColX + 96, window.innerWidth - 100) : Math.max(leftColX + 100, window.innerWidth - 114);

            return {
                'icon-projects': { x: leftColX, y: 52 },
                'icon-terminal': { x: leftColX, y: 148 },
                'icon-todos':    { x: leftColX, y: 244 },
                'icon-skills':   { x: leftColX, y: 340 },
                'icon-about':    { x: rightColX, y: 52 },
                'icon-calendar': { x: rightColX, y: 148 },
                'icon-contact':  { x: rightColX, y: 244 },
                'icon-admin':    { x: rightColX, y: 340 }
            };
        }

        function initDesktopIcons() {
            let saved = {};
            try {
                saved = JSON.parse(localStorage.getItem(DESKTOP_ICON_STORAGE_KEY)) || {};
            } catch(e) {
                saved = {};
            }

            const defaults = getDefaultDesktopIconCoords();
            const icons = document.querySelectorAll('.desktop-icon');

            icons.forEach(icon => {
                const id = icon.id;
                let pos = (saved && saved[id]) ? saved[id] : defaults[id];
                if (!pos) pos = { x: 28, y: 52 };

                const maxX = Math.max(10, window.innerWidth - (icon.offsetWidth || 86) - 10);
                const maxY = Math.max(36, window.innerHeight - (icon.offsetHeight || 80) - 72);

                const clampedX = Math.max(10, Math.min(pos.x, maxX));
                const clampedY = Math.max(36, Math.min(pos.y, maxY));

                icon.style.left = clampedX + 'px';
                icon.style.top = clampedY + 'px';

                setupDraggableIcon(icon);
            });
        }

        function resetDesktopIcons() {
            localStorage.removeItem(DESKTOP_ICON_STORAGE_KEY);
            const defaults = getDefaultDesktopIconCoords();
            document.querySelectorAll('.desktop-icon').forEach(icon => {
                const def = defaults[icon.id];
                if (def) {
                    icon.style.transition = 'left 0.28s cubic-bezier(0.16, 1, 0.3, 1), top 0.28s cubic-bezier(0.16, 1, 0.3, 1)';
                    icon.style.left = def.x + 'px';
                    icon.style.top = def.y + 'px';
                    setTimeout(() => { icon.style.transition = ''; }, 300);
                }
            });
            showToast('Desktop grid reset');
            playChime(550);
        }

        function setupDraggableIcon(icon) {
            let startPointerX = 0, startPointerY = 0;
            let startIconX = 0, startIconY = 0;
            let hasMoved = false;

            function onPointerDown(e) {
                if (e.type === 'mousedown' && e.button !== 0) return;
                const clientX = e.type.startsWith('touch') ? e.touches[0].clientX : e.clientX;
                const clientY = e.type.startsWith('touch') ? e.touches[0].clientY : e.clientY;

                startPointerX = clientX;
                startPointerY = clientY;
                hasMoved = false;

                startIconX = parseFloat(icon.style.left) || icon.offsetLeft;
                startIconY = parseFloat(icon.style.top) || icon.offsetTop;

                function onPointerMove(ev) {
                    const curX = ev.type.startsWith('touch') ? ev.touches[0].clientX : ev.clientX;
                    const curY = ev.type.startsWith('touch') ? ev.touches[0].clientY : ev.clientY;
                    const dx = curX - startPointerX;
                    const dy = curY - startPointerY;

                    if (!hasMoved && Math.hypot(dx, dy) > 4) {
                        hasMoved = true;
                        icon.classList.add('is-dragging');
                    }

                    if (hasMoved) {
                        let nextX = startIconX + dx;
                        let nextY = startIconY + dy;
                        const margin = 8;
                        const minTop = 34;
                        const maxTop = window.innerHeight - (icon.offsetHeight || 80) - 65;
                        const maxLeft = window.innerWidth - (icon.offsetWidth || 86) - margin;

                        nextX = Math.max(margin, Math.min(nextX, maxLeft));
                        nextY = Math.max(minTop, Math.min(nextY, maxTop));

                        icon.style.left = nextX + 'px';
                        icon.style.top = nextY + 'px';
                    }
                }

                function onPointerUp() {
                    window.removeEventListener('mousemove', onPointerMove);
                    window.removeEventListener('mouseup', onPointerUp);
                    window.removeEventListener('touchmove', onPointerMove);
                    window.removeEventListener('touchend', onPointerUp);

                    if (hasMoved) {
                        icon.classList.remove('is-dragging');
                        let saved = {};
                        try {
                            saved = JSON.parse(localStorage.getItem(DESKTOP_ICON_STORAGE_KEY)) || {};
                        } catch(e) {}
                        saved[icon.id] = {
                            x: parseFloat(icon.style.left),
                            y: parseFloat(icon.style.top)
                        };
                        localStorage.setItem(DESKTOP_ICON_STORAGE_KEY, JSON.stringify(saved));
                    }
                }

                window.addEventListener('mousemove', onPointerMove);
                window.addEventListener('mouseup', onPointerUp);
                window.addEventListener('touchmove', onPointerMove, { passive: false });
                window.addEventListener('touchend', onPointerUp);
            }

            icon.addEventListener('mousedown', onPointerDown);
            icon.addEventListener('touchstart', onPointerDown, { passive: true });
        }
'''

# Update renderTasks agar memfilter berdasarkan currentTodoScope
old_render_tasks = '''        // Render Tasks
        function renderTasks(list) {
            const container = document.getElementById('taskListContainer');
            if (!container) return;
            const completedCount = list.filter(t => t.status === 'completed').length;
            const total = list.length;
            const percent = total > 0 ? Math.round((completedCount / total) * 100) : 0;

            document.getElementById('roadmapCountText').textContent = `${completedCount} / ${total} Completed`;
            document.getElementById('roadmapProgressBar').style.width = `${percent}%`;
            document.getElementById('roadmapPercentText').textContent = `${percent}%`;

            container.innerHTML = list.map(t => `
                <div class="task-item ${t.status === 'completed' ? 'is-completed' : ''}">
                    <div class="task-item-left">
                        <input type="checkbox" class="task-checkbox" ${t.status === 'completed' ? 'checked' : ''} onchange="toggleTaskStatus(${t.id}, this.checked)">
                        <span class="task-title">${t.title}</span>
                    </div>
                    <div class="task-meta">
                        <span class="task-status-pill task-status-${t.status}">${t.status.replace('_', ' ')}</span>
                        ${adminToken ? `<button class="btn-mini-admin" onclick="deleteAdminTask(${t.id})" style="color: #ef4444;">&times;</button>` : ''}
                    </div>
                </div>
            `).join('');
        }'''

new_render_tasks = '''        // Render Tasks with Dual Scope Filter
        function renderTasks(list) {
            const container = document.getElementById('taskListContainer');
            if (!container) return;

            // Filter berdasarkan current scope: public (is_private == false) atau private (is_private == true)
            const filtered = list.filter(t => {
                if (currentTodoScope === 'private') return t.is_private === true;
                return !t.is_private; // public
            });

            const completedCount = filtered.filter(t => t.status === 'completed').length;
            const total = filtered.length;
            const percent = total > 0 ? Math.round((completedCount / total) * 100) : 0;

            document.getElementById('roadmapCountText').textContent = `${completedCount} / ${total} Completed`;
            document.getElementById('roadmapProgressBar').style.width = `${percent}%`;
            document.getElementById('roadmapPercentText').textContent = `${percent}%`;

            if (filtered.length === 0) {
                container.innerHTML = '<div style="padding: 20px; text-align: center; color: var(--text-muted); font-size: 12px;">No tasks in this list.</div>';
                return;
            }

            container.innerHTML = filtered.map(t => `
                <div class="task-item ${t.status === 'completed' ? 'is-completed' : ''}">
                    <div class="task-item-left">
                        <input type="checkbox" class="task-checkbox" ${t.status === 'completed' ? 'checked' : ''} onchange="toggleTaskStatus(${t.id}, this.checked)">
                        <span class="task-title">${t.title}</span>
                    </div>
                    <div class="task-meta">
                        <span class="task-status-pill task-status-${t.status}">${t.status.replace('_', ' ')}</span>
                        ${adminToken ? `<button class="btn-mini-admin" onclick="deleteAdminTask(${t.id})" style="color: #ef4444;">&times;</button>` : ''}
                    </div>
                </div>
            `).join('');
        }'''

html = html.replace(old_render_tasks, new_render_tasks)

# Sisipkan JS functions baru
html = html.replace('        // ==========================================\n        // TERMINAL CLI EMULATOR', js_injection + '\n        // ==========================================\n        // TERMINAL CLI EMULATOR')

# Update checkAdminSession untuk menampilkan Tab Private Todo saat login
old_check_admin = '''                document.getElementById('adminLoginView').style.display = 'none';
                document.getElementById('adminDashboardView').style.display = 'flex';
                document.getElementById('quickAddTaskRow').style.display = 'flex';'''

new_check_admin = '''                document.getElementById('adminLoginView').style.display = 'none';
                document.getElementById('adminDashboardView').style.display = 'flex';
                document.getElementById('quickAddTaskRow').style.display = 'flex';
                const privTab = document.getElementById('tabPrivateTodos');
                if (privTab) privTab.style.display = 'inline-block';'''

html = html.replace(old_check_admin, new_check_admin)

# Update submitQuickTask untuk menyertakan is_private
old_submit_task = '''        async function submitQuickTask() {
            const input = document.getElementById('quickTaskInput');
            const title = input.value.trim();
            if (!title) return;
            if (!adminToken) {
                showToast('Admin login required');
                return;
            }
            try {
                const res = await fetch('/api/admin/tasks', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${adminToken}`
                    },
                    body: JSON.stringify({ title: title, status: 'in_progress' })
                });'''

new_submit_task = '''        async function submitQuickTask() {
            const input = document.getElementById('quickTaskInput');
            const scopeSelect = document.getElementById('quickTaskScope');
            const isPrivate = scopeSelect ? (scopeSelect.value === 'private') : false;
            const title = input.value.trim();
            if (!title) return;
            if (!adminToken) {
                showToast('Admin login required');
                return;
            }
            try {
                const res = await fetch('/api/admin/tasks', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${adminToken}`
                    },
                    body: JSON.stringify({ title: title, status: 'in_progress', is_private: isPrivate })
                });'''

html = html.replace(old_submit_task, new_submit_task)

# Update DOMContentLoaded untuk inisialisasi icons & calendar
old_init = '''        window.addEventListener('DOMContentLoaded', () => {
            fetchAllData();
            checkAdminSession();
            // Automatically open Projects Finder on desktop start
            if (window.innerWidth > 768) {
                setTimeout(() => toggleWindow('projectsWin'), 300);
            }
        });'''

new_init = '''        window.addEventListener('DOMContentLoaded', () => {
            fetchAllData();
            checkAdminSession();
            renderCalendar();
            initDesktopIcons();
            if (window.innerWidth > 768) {
                setTimeout(() => toggleWindow('projectsWin'), 300);
            }
        });'''

html = html.replace(old_init, new_init)

# Sync ke public/index.html juga
with open(target_path, 'w', encoding='utf-8') as f:
    f.write(html)

public_path = r'C:\Hermes\vanzodev-vps-workspace\projects\hub-vanzodev\public\index.html'
with open(public_path, 'w', encoding='utf-8') as f:
    f.write(html)

print("Step 4 complete: Calendar, Draggable Icons, Dual Todos, and Reset Grid installed cleanly!")
