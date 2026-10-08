target_path = r'C:\Hermes\vanzodev-vps-workspace\projects\hub-vanzodev\resources\views\index.blade.php'

with open(target_path, 'r', encoding='utf-8') as f:
    html = f.read()

# Ganti todo-window header & container untuk mendukung Tab: "Public Roadmap" dan "Jovan's Personal Tasks" (Private)
old_todo_content = '''                    <div class="roadmap-header-stats">
                        <span style="font-size: 12px; font-weight: 600;" id="roadmapCountText">0 / 0 Completed</span>
                        <div class="progress-bar-bg">
                            <div class="progress-bar-fill" id="roadmapProgressBar" style="width: 0%;"></div>
                        </div>
                        <span style="font-family: var(--font-mono); font-size: 12px; font-weight: 700;" id="roadmapPercentText">0%</span>
                    </div>

                    <!-- Quick Add Task (Visible when Admin) -->
                    <div id="quickAddTaskRow" style="display: none; gap: 8px;">
                        <input type="text" id="quickTaskInput" placeholder="Add a new roadmap task..." class="admin-input" style="flex: 1;" onkeydown="if(event.key==='Enter') submitQuickTask()">
                        <button class="btn-admin-primary" onclick="submitQuickTask()">Add</button>
                    </div>

                    <div class="task-list" id="taskListContainer">
                        <!-- Hydrated from /api/tasks -->
                    </div>'''

new_todo_content = '''                    <!-- Dual Task Tab Switcher -->
                    <div style="display: flex; gap: 8px; border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
                        <button class="finder-tab-btn is-active" id="tabPublicTodos" onclick="switchTodoScope('public')">Public Roadmap (Fun/General)</button>
                        <button class="finder-tab-btn" id="tabPrivateTodos" onclick="switchTodoScope('private')" style="display: none; border-color: var(--admin-accent); color: var(--admin-accent);">Jovan's Work Queue (Private)</button>
                    </div>

                    <div class="roadmap-header-stats">
                        <span style="font-size: 12px; font-weight: 600;" id="roadmapCountText">0 / 0 Completed</span>
                        <div class="progress-bar-bg">
                            <div class="progress-bar-fill" id="roadmapProgressBar" style="width: 0%;"></div>
                        </div>
                        <span style="font-family: var(--font-mono); font-size: 12px; font-weight: 700;" id="roadmapPercentText">0%</span>
                    </div>

                    <!-- Quick Add Task (Visible when Admin) -->
                    <div id="quickAddTaskRow" style="display: none; gap: 8px;">
                        <input type="text" id="quickTaskInput" placeholder="Add a new task..." class="admin-input" style="flex: 1;" onkeydown="if(event.key==='Enter') submitQuickTask()">
                        <select id="quickTaskScope" class="admin-select" style="width: 110px;">
                            <option value="private">Private</option>
                            <option value="public">Public</option>
                        </select>
                        <button class="btn-admin-primary" onclick="submitQuickTask()">Add</button>
                    </div>

                    <div class="task-list" id="taskListContainer">
                        <!-- Hydrated dynamically -->
                    </div>'''

if old_todo_content in html:
    html = html.replace(old_todo_content, new_todo_content)
    print("Roadmap window upgraded with Dual Todo scope tabs!")

with open(target_path, 'w', encoding='utf-8') as f:
    f.write(html)
