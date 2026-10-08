<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>VanzoDev — Minimalist Desktop OS & Portfolio</title>
    <meta name="description" content="Personal dynamic desktop OS portfolio of Jovan (VanzoDev). Full Stack & Systems Engineer.">
    <meta name="theme-color" content="#101114">

    <!-- Google Fonts: Montserrat + Instrument Serif + JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=JetBrains+Mono:wght@400;500;600;700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">

    <style>
        /* Fluid Interactive Canvas Background */
        #fluidCanvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
            z-index: 0;
            opacity: 0.85;
            display: none;
            transition: opacity 0.5s ease;
        }

        [data-wallpaper="fluid"] #fluidCanvas {
            display: block !important;
        }

        [data-wallpaper="fluid"] {
            background-color: #050608 !important;
            background-image: radial-gradient(circle at 50% 50%, rgba(59, 130, 246, 0.08), transparent 70%) !important;
        }

        /* ===== MODERN MINIMALIST OBSIDIAN & RAYCAST PALETTE ===== */
        :root {
            --desk-bg: #0a0a0c;
            --desk-pattern: rgba(255, 255, 255, 0.04);
            --win-bg: #121316;
            --win-surface: #18191e;
            --win-header: #0e0f12;
            --win-sidebar: #0d0e11;
            --border-color: rgba(255, 255, 255, 0.08);
            --border-active: rgba(255, 255, 255, 0.22);
            --text-main: #f4f4f6;
            --text-muted: #8c8e98;
            --accent-color: #3b82f6;
            --accent-glow: rgba(59, 130, 246, 0.35);
            --accent-bg: rgba(59, 130, 246, 0.12);
            --dock-bg: rgba(18, 19, 22, 0.82);
            --admin-accent: #f97316;
            --admin-glow: rgba(249, 115, 22, 0.25);
            --success-color: #10b981;
            --font-sans: 'Montserrat', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            --font-serif: 'Instrument Serif', Georgia, serif;
            --font-mono: 'JetBrains Mono', monospace;
        }

        [data-theme="light"] {
            --desk-bg: #f5f5f3;
            --desk-pattern: rgba(0, 0, 0, 0.04);
            --win-bg: #ffffff;
            --win-surface: #f7f7f5;
            --win-header: #fafaf8;
            --win-sidebar: #f2f2f0;
            --border-color: rgba(0, 0, 0, 0.08);
            --border-active: rgba(0, 0, 0, 0.22);
            --text-main: #121214;
            --text-muted: #6e7078;
            --accent-color: #2563eb;
            --accent-glow: rgba(37, 99, 235, 0.2);
            --accent-bg: rgba(37, 99, 235, 0.08);
            --dock-bg: rgba(255, 255, 255, 0.85);
            --admin-accent: #ea580c;
        }

        /* Wallpaper styles */
        [data-wallpaper="dots"] {
            background-image: radial-gradient(var(--desk-pattern) 1.5px, transparent 1.6px) !important;
            background-size: 24px 24px !important;
            background-color: var(--desk-bg) !important;
        }

        [data-wallpaper="grid"] {
            background-image: 
                linear-gradient(to right, var(--desk-pattern) 1px, transparent 1px),
                linear-gradient(to bottom, var(--desk-pattern) 1px, transparent 1px) !important;
            background-size: 32px 32px !important;
            background-color: var(--desk-bg) !important;
        }

        [data-wallpaper="circuit"] {
            background-image: 
                radial-gradient(circle at 50% 50%, rgba(59, 130, 246, 0.03) 0%, transparent 60%),
                linear-gradient(to right, var(--desk-pattern) 1px, transparent 1px),
                linear-gradient(to bottom, var(--desk-pattern) 1px, transparent 1px) !important;
            background-size: 100% 100%, 48px 48px, 48px 48px !important;
            background-color: var(--desk-bg) !important;
        }

        [data-wallpaper="solid"] {
            background: var(--desk-bg) !important;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 9999px;
            transition: background 0.2s ease;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }
        [data-theme="light"] ::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.15);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            -webkit-tap-highlight-color: transparent;
        }

        body, html {
            width: 100vw;
            height: 100vh;
            overflow: hidden;
            background-color: var(--desk-bg);
            color: var(--text-main);
            position: relative;
            font-family: var(--font-sans);
            transition: background-color 0.25s ease, color 0.25s ease;
        }

        .desktop-container {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        /* ===== TOP STATUS / MENU BAR ===== */
        .topbar {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 16px;
            background: color-mix(in oklab, var(--win-bg) 80%, transparent);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border-color);
            z-index: 9998;
            font-size: 12px;
            font-weight: 500;
        }

        .topbar-left, .topbar-right {
            display: flex;
            align-items: center;
            gap: 14px;
            flex: 1;
        }

        .topbar-right {
            justify-content: flex-end;
        }

        .topbar-center {
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            pointer-events: none;
        }

        .topbar-clock {
            font-family: var(--font-mono);
            font-size: 12px;
            font-weight: 600;
            color: var(--text-main);
            letter-spacing: 0.04em;
        }

        .topbar-btn {
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 500;
            font-family: var(--font-sans);
            transition: color 0.15s ease;
            padding: 4px 6px;
            border-radius: 6px;
        }

        .topbar-btn:hover {
            color: var(--text-main);
            background: var(--border-color);
        }

        .topbar-brand {
            font-family: var(--font-sans);
            font-weight: 700;
            color: var(--text-main);
            letter-spacing: -0.01em;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .pulse-indicator {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            box-shadow: 0 0 8px #10b981;
            animation: pulse-ring 2s infinite;
        }

        @keyframes pulse-ring {
            0% { transform: scale(0.95); opacity: 0.8; }
            50% { transform: scale(1.15); opacity: 1; }
            100% { transform: scale(0.95); opacity: 0.8; }
        }

        .admin-pill {
            display: none;
            align-items: center;
            gap: 6px;
            font-family: var(--font-mono);
            font-size: 10px;
            font-weight: 700;
            color: #fff;
            background: var(--admin-accent);
            padding: 2px 8px;
            border-radius: 9999px;
            box-shadow: 0 0 10px var(--admin-glow);
            letter-spacing: 0.05em;
            cursor: pointer;
        }

        .admin-pill.is-active {
            display: inline-flex;
        }

        /* ===== DESKTOP WATERMARK ===== */
        .desktop-watermark {
            position: absolute;
            left: 50%;
            top: 48%;
            transform: translate(-50%, -50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            pointer-events: none;
            text-align: center;
            white-space: nowrap;
            z-index: 1;
            opacity: 0.88;
            user-select: none;
        }

        .watermark-sub {
            font-family: var(--font-mono);
            font-size: 12px;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        .watermark-title {
            font-family: var(--font-serif);
            font-style: italic;
            font-weight: 400;
            font-size: clamp(54px, 11vw, 140px);
            line-height: 0.95;
            letter-spacing: -0.04em;
            color: var(--text-main);
            opacity: 0.95;
        }

        .watermark-tagline {
            font-family: var(--font-sans);
            font-size: 12px;
            font-weight: 500;
            color: var(--text-muted);
            margin-top: 12px;
            letter-spacing: 0.05em;
        }

        /* ===== DESKTOP SHORTCUT ICONS ===== */
        .desktop-icon {
            position: absolute;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            width: 86px;
            cursor: grab;
            user-select: none;
            -webkit-user-select: none;
            touch-action: none;
            z-index: 3;
            transition: transform 0.18s cubic-bezier(0.2, 0.9, 0.3, 1.2), box-shadow 0.18s ease;
            color: inherit;
        }

        .desktop-icon:hover {
            transform: translateY(-3px);
        }

        .desktop-icon.is-dragging {
            cursor: grabbing !important;
            z-index: 90 !important;
            transition: none !important;
            transform: scale(1.06) !important;
            opacity: 0.88;
        }

        .desktop-icon-art {
            position: relative;
            display: grid;
            place-items: center;
            width: 58px;
            height: 52px;
            border-radius: 12px;
            background: color-mix(in oklab, var(--win-bg) 75%, transparent);
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: all 0.2s ease;
        }

        .desktop-icon:hover .desktop-icon-art {
            border-color: var(--border-active);
            box-shadow: 0 6px 18px rgba(0,0,0,0.22);
            background: color-mix(in oklab, var(--win-bg) 90%, transparent);
        }

        .desktop-icon-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: #10b981;
            color: #fff;
            font-size: 8px;
            font-weight: 700;
            padding: 1px 5px;
            border-radius: 4px;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            box-shadow: 0 2px 6px rgba(0,0,0,0.4);
            pointer-events: none;
        }

        .desktop-icon-badge.admin-badge-indicator {
            background: var(--admin-accent);
        }

        .desktop-icon-label {
            font-family: var(--font-sans);
            font-size: 11px;
            font-weight: 500;
            padding: 2px 7px;
            border-radius: 5px;
            line-height: 1.3;
            max-width: 92px;
            text-align: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            background: color-mix(in oklab, var(--win-bg) 80%, transparent);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            letter-spacing: -0.01em;
            pointer-events: none;
        }

        /* ===== RETRO-MODERN FLOATING WINDOWS ===== */
        .window {
            position: absolute;
            display: flex;
            flex-direction: column;
            background: var(--win-bg);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 0 0 1px var(--border-color), 0 16px 40px -10px rgba(0,0,0,0.5), 0 30px 60px -20px rgba(0,0,0,0.6);
            transition: opacity 0.2s cubic-bezier(0.2, 0.9, 0.3, 1), transform 0.2s cubic-bezier(0.2, 0.9, 0.3, 1);
            z-index: 10;
        }

        .window.is-hidden {
            display: none !important;
        }

        .window.is-top {
            box-shadow: 0 0 0 1px var(--border-active), 0 20px 48px -8px rgba(0,0,0,0.6), 0 40px 80px -15px rgba(0,0,0,0.7);
        }

        .window-bar {
            position: relative;
            display: flex;
            align-items: center;
            height: 36px;
            padding: 0 14px;
            background: var(--win-header);
            border-bottom: 1px solid var(--border-color);
            cursor: move;
            user-select: none;
            -webkit-user-select: none;
            flex-shrink: 0;
        }

        .window-lights {
            display: flex;
            align-items: center;
            gap: 7px;
            z-index: 2;
        }

        .window-light {
            width: 11px;
            height: 11px;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            padding: 0;
            outline: none;
            transition: opacity 0.15s ease;
        }

        .window-light:hover {
            filter: brightness(1.15);
        }

        .window-light-close { background: #ff5f57; box-shadow: 0 0 4px rgba(255, 95, 87, 0.5); }
        .window-light-min { background: #febc2e; box-shadow: 0 0 4px rgba(254, 188, 46, 0.5); }
        .window-light-max { background: #28c840; box-shadow: 0 0 4px rgba(40, 200, 64, 0.5); }

        .window-title {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            letter-spacing: -0.01em;
            pointer-events: none;
            white-space: nowrap;
        }

        .window.is-top .window-title {
            color: var(--text-main);
        }

        .window-actions {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 8px;
            z-index: 2;
        }

        .window-content {
            flex: 1;
            overflow-y: auto;
            position: relative;
            display: flex;
            flex-direction: column;
            background: var(--win-bg);
        }

        /* ===== FINDER (PROJECTS) STYLES ===== */
        .finder-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 10px 16px;
            border-bottom: 1px solid var(--border-color);
            background: var(--win-surface);
            flex-wrap: wrap;
        }

        .finder-filter-group {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .finder-tab-btn {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            font-size: 11px;
            font-weight: 500;
            padding: 4px 10px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .finder-tab-btn:hover, .finder-tab-btn.is-active {
            background: var(--accent-bg);
            border-color: var(--accent-color);
            color: var(--text-main);
        }

        .finder-search {
            position: relative;
            display: flex;
            align-items: center;
        }

        .finder-search input {
            background: var(--win-header);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            padding: 5px 10px 5px 28px;
            border-radius: 6px;
            font-size: 11px;
            outline: none;
            width: 150px;
            transition: width 0.2s ease, border-color 0.2s ease;
        }

        .finder-search input:focus {
            width: 190px;
            border-color: var(--accent-color);
        }

        .finder-search svg {
            position: absolute;
            left: 8px;
            color: var(--text-muted);
            pointer-events: none;
        }

        .finder-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 12px;
            padding: 16px;
        }

        .project-card {
            background: var(--win-surface);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 14px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.2, 0.9, 0.3, 1.2);
            position: relative;
        }

        .project-card:hover {
            transform: translateY(-2px);
            border-color: var(--border-active);
            box-shadow: 0 8px 24px rgba(0,0,0,0.3);
        }

        .project-card-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 8px;
        }

        .project-card-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-main);
            letter-spacing: -0.01em;
        }

        .project-badge {
            font-family: var(--font-mono);
            font-size: 9px;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 4px;
            background: var(--accent-bg);
            color: var(--accent-color);
            border: 1px solid var(--accent-color);
            letter-spacing: 0.04em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .project-card-desc {
            font-size: 11px;
            line-height: 1.5;
            color: var(--text-muted);
            flex: 1;
        }

        .project-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
        }

        .project-tag {
            font-family: var(--font-mono);
            font-size: 9px;
            padding: 2px 6px;
            border-radius: 4px;
            background: color-mix(in oklab, var(--win-bg) 80%, transparent);
            border: 1px solid var(--border-color);
            color: var(--text-muted);
        }

        .project-admin-actions {
            display: none;
            gap: 6px;
            margin-top: 6px;
            padding-top: 8px;
            border-top: 1px dashed var(--border-color);
        }

        body.is-admin .project-admin-actions {
            display: flex;
        }

        .btn-mini-admin {
            font-size: 10px;
            padding: 3px 8px;
            border-radius: 4px;
            border: 1px solid var(--border-color);
            background: transparent;
            color: var(--text-muted);
            cursor: pointer;
            font-family: var(--font-mono);
            transition: all 0.15s ease;
        }

        .btn-mini-admin:hover {
            color: #fff;
            border-color: var(--admin-accent);
            background: var(--admin-accent);
        }

        /* ===== TERMINAL CLI STYLES ===== */
        .terminal-container {
            display: flex;
            flex-direction: column;
            height: 100%;
            background: #08090b;
            font-family: var(--font-mono);
            font-size: 12px;
            line-height: 1.6;
            color: #e2e8f0;
            position: relative;
        }

        .terminal-output {
            flex: 1;
            padding: 14px;
            overflow-y: auto;
            white-space: pre-wrap;
            word-break: break-word;
        }

        .terminal-line {
            margin-bottom: 6px;
        }

        .terminal-prompt-row {
            display: flex;
            align-items: center;
            padding: 8px 14px;
            background: #0c0d10;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            gap: 8px;
        }

        .terminal-prompt-label {
            color: #10b981;
            font-weight: 700;
            white-space: nowrap;
        }

        .terminal-input {
            flex: 1;
            background: transparent;
            border: none;
            outline: none;
            color: #fff;
            font-family: var(--font-mono);
            font-size: 12px;
        }

        .matrix-canvas {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 5;
            background: rgba(0, 0, 0, 0.92);
        }

        /* ===== ROADMAP / SPRINT BOARD STYLES ===== */
        .roadmap-container {
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .roadmap-header-stats {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--win-surface);
            padding: 12px 16px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }

        .progress-bar-bg {
            flex: 1;
            height: 6px;
            background: var(--border-color);
            border-radius: 9999px;
            overflow: hidden;
            margin: 0 16px;
        }

        .progress-bar-fill {
            height: 100%;
            background: #10b981;
            border-radius: 9999px;
            transition: width 0.3s ease;
        }

        .task-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .task-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 14px;
            background: var(--win-surface);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            gap: 12px;
            transition: border-color 0.15s ease;
        }

        .task-item:hover {
            border-color: var(--border-active);
        }

        .task-item.is-completed {
            opacity: 0.65;
        }

        .task-item-left {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
        }

        .task-checkbox {
            appearance: none;
            width: 16px;
            height: 16px;
            border: 1.5px solid var(--text-muted);
            border-radius: 4px;
            outline: none;
            cursor: pointer;
            position: relative;
            background: transparent;
            transition: all 0.15s ease;
        }

        .task-checkbox:checked {
            background: #10b981;
            border-color: #10b981;
        }

        .task-checkbox:checked::after {
            content: '✓';
            position: absolute;
            color: #fff;
            font-size: 10px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-weight: 700;
        }

        .task-title {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-main);
        }

        .task-item.is-completed .task-title {
            text-decoration: line-through;
            color: var(--text-muted);
        }

        .task-meta {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .task-status-pill {
            font-family: var(--font-mono);
            font-size: 9px;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 4px;
            text-transform: uppercase;
        }

        .task-status-completed { background: rgba(16, 185, 129, 0.15); color: #10b981; }
        .task-status-in_progress { background: rgba(59, 130, 246, 0.15); color: #3b82f6; }
        .task-status-pending { background: rgba(156, 163, 175, 0.15); color: #9ca3af; }

        /* ===== IN-OS ADMIN CONTROL CENTER ===== */
        .admin-center-container {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .admin-nav {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: var(--win-surface);
            border-bottom: 1px solid var(--border-color);
        }

        .admin-nav-tab {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            font-size: 11px;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .admin-nav-tab.is-active, .admin-nav-tab:hover {
            background: var(--admin-glow);
            border-color: var(--admin-accent);
            color: #fff;
        }

        .admin-body {
            flex: 1;
            padding: 16px;
            overflow-y: auto;
        }

        .admin-form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 12px;
        }

        .admin-form-label {
            font-size: 11px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .admin-input, .admin-textarea, .admin-select {
            background: var(--win-header);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 12px;
            outline: none;
            font-family: inherit;
        }

        .admin-input:focus, .admin-textarea:focus, .admin-select:focus {
            border-color: var(--admin-accent);
        }

        .btn-admin-primary {
            background: var(--admin-accent);
            border: none;
            color: #fff;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.15s ease;
        }

        .btn-admin-primary:hover {
            opacity: 0.9;
        }

        /* ===== BOTTOM DOCK BAR ===== */
        .dock-wrapper {
            position: absolute;
            bottom: 12px;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: center;
            pointer-events: none;
            z-index: 9990;
        }

        .dock {
            pointer-events: auto;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            background: var(--dock-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            box-shadow: 0 10px 30px -5px rgba(0,0,0,0.5), 0 0 0 1px rgba(255,255,255,0.05);
            transition: transform 0.2s cubic-bezier(0.2, 0.9, 0.3, 1.2);
        }

        .dock-btn {
            position: relative;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 6px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            color: var(--text-main);
            transition: transform 0.15s cubic-bezier(0.2, 0.9, 0.3, 1.3), background 0.15s ease;
        }

        .dock-btn:hover {
            transform: translateY(-5px) scale(1.15);
            background: rgba(255, 255, 255, 0.08);
        }

        .dock-tip {
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--win-surface);
            color: var(--text-main);
            font-size: 10px;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 6px;
            border: 1px solid var(--border-color);
            white-space: nowrap;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.15s ease;
        }

        .dock-btn:hover .dock-tip {
            opacity: 1;
        }

        .dock-sep {
            width: 1px;
            height: 24px;
            background: var(--border-color);
            margin: 0 4px;
        }

        /* ===== MODAL POPUPS ===== */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.65);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease;
        }

        .modal-overlay.is-open {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-box {
            background: var(--win-bg);
            border: 1px solid var(--border-active);
            border-radius: 14px;
            width: min(540px, 92vw);
            max-height: 85vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 25px 60px rgba(0,0,0,0.6);
            overflow: hidden;
            transform: scale(0.95);
            transition: transform 0.2s cubic-bezier(0.2, 0.9, 0.3, 1.2);
        }

        .modal-overlay.is-open .modal-box {
            transform: scale(1);
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 18px;
            border-bottom: 1px solid var(--border-color);
            background: var(--win-header);
        }

        .modal-title {
            font-size: 15px;
            font-weight: 700;
        }

        .modal-close {
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 20px;
            cursor: pointer;
            line-height: 1;
        }

        .modal-body {
            padding: 18px;
            overflow-y: auto;
            font-size: 13px;
            line-height: 1.6;
            color: var(--text-muted);
        }

        .modal-preview {
            margin-top: 14px;
            background: var(--win-surface);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 12px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .modal-preview-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
        }

        .modal-preview-label {
            color: var(--text-muted);
            font-weight: 500;
        }

        .modal-preview-value {
            font-weight: 600;
            font-family: var(--font-mono);
        }

        .modal-actions {
            padding: 12px 18px;
            background: var(--win-header);
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .chip {
            padding: 6px 14px;
            border-radius: 6px;
            border: 1px solid var(--border-color);
            background: transparent;
            color: var(--text-main);
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.15s ease;
        }

        .chip-primary {
            background: var(--accent-color);
            border-color: var(--accent-color);
            color: #fff;
        }

        /* ===== SPOTLIGHT SEARCH ===== */
        .spotlight-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.55);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            z-index: 10005;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding-top: 14vh;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease;
        }

        .spotlight-overlay.is-open {
            opacity: 1;
            pointer-events: auto;
        }

        .spotlight-box {
            background: var(--win-bg);
            border: 1px solid var(--border-active);
            border-radius: 12px;
            width: min(580px, 92vw);
            box-shadow: 0 25px 60px rgba(0,0,0,0.7);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .spotlight-input {
            display: flex;
            align-items: center;
            padding: 14px 18px;
            gap: 12px;
            border-bottom: 1px solid var(--border-color);
        }

        .spotlight-input input {
            flex: 1;
            background: transparent;
            border: none;
            outline: none;
            font-size: 15px;
            color: var(--text-main);
            font-family: inherit;
        }

        .spotlight-list {
            max-height: 320px;
            overflow-y: auto;
            padding: 6px;
        }

        .spotlight-item {
            padding: 10px 14px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 13px;
            cursor: pointer;
            transition: background 0.15s ease;
        }

        .spotlight-item:hover, .spotlight-item.is-active {
            background: var(--accent-bg);
            color: var(--accent-color);
        }

        /* ===== TOAST NOTIFICATIONS ===== */
        .toast-container {
            position: fixed;
            top: 48px;
            right: 18px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            z-index: 10010;
            pointer-events: none;
        }

        .toast-msg {
            background: var(--win-surface);
            border: 1px solid var(--border-active);
            color: var(--text-main);
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.4);
            backdrop-filter: blur(12px);
            pointer-events: auto;
            animation: toast-in 0.25s ease;
        }

        @keyframes toast-in {
            from { transform: translateY(-10px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* ===== ADAPTIVE MOBILE & TABLET OS (< 768px) ===== */
        @media (max-width: 768px) {
            .desktop-watermark {
                top: 42%;
            }

            .watermark-title {
                font-size: 58px;
            }

            .desktop-icon {
                width: 72px;
            }

            .desktop-icon-art {
                width: 50px;
                height: 46px;
            }

            .desktop-icon-label {
                font-size: 10px;
                max-width: 76px;
            }

            /* Responsive floating window becomes full-screen sheet */
            .window {
                left: 0 !important;
                top: 34px !important;
                width: 100vw !important;
                height: calc(100vh - 34px - 64px) !important;
                border-radius: 16px 16px 0 0 !important;
                box-shadow: 0 -8px 30px rgba(0,0,0,0.6) !important;
                transform: translateY(0);
                transition: transform 0.25s cubic-bezier(0.1, 0.9, 0.2, 1) !important;
            }

            .window.is-hidden {
                display: flex !important;
                transform: translateY(110%) !important;
                pointer-events: none;
            }

            .mobile-drag-indicator {
                display: block;
                width: 38px;
                height: 4px;
                background: rgba(255, 255, 255, 0.2);
                border-radius: 9999px;
                margin: 6px auto;
            }

            .window-bar {
                cursor: default;
                height: 40px;
            }

            .dock-wrapper {
                bottom: 8px;
            }

            .dock {
                padding: 6px 10px;
                gap: 6px;
                border-radius: 16px;
            }

            .dock-btn {
                padding: 5px;
            }

            .dock-btn svg {
                width: 18px;
                height: 18px;
            }

            .finder-grid {
                grid-template-columns: 1fr;
            }
        }

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

    </style>
</head>
<body data-theme="dark" data-wallpaper="dots">
    <div class="desktop-container" id="desktop">
        <!-- Fluid Interactive Background Canvas -->
        <canvas id="fluidCanvas"></canvas>


        <!-- ===== TOP STATUS BAR ===== -->
        <header class="topbar">
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
        </header>

        <!-- ===== DESKTOP WATERMARK ===== -->
        <div class="desktop-watermark">
            <div class="watermark-sub">Full Stack & Systems Engineer</div>
            <h1 class="watermark-title">VanzoDev</h1>
            <div class="watermark-tagline">Taichung, Taiwan ✕ Indonesia</div>
        </div>

        <!-- ===== DESKTOP ICONS ===== -->
        <div class="desktop-icon" id="icon-projects" data-target="projectsWin" style="left: 24px; top: 54px;">
            <div class="desktop-icon-art">
                <span class="desktop-icon-badge" id="iconProjectsCount">5</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="3" width="20" height="14" rx="2"></rect>
                    <line x1="8" y1="21" x2="16" y2="21"></line>
                    <line x1="12" y1="17" x2="12" y2="21"></line>
                </svg>
            </div>
            <span class="desktop-icon-label">Projects</span>
        </div>

        <div class="desktop-icon" id="icon-terminal" data-target="terminalWin" style="left: 24px; top: 144px;">
            <div class="desktop-icon-art">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="4 17 10 11 4 5"></polyline>
                    <line x1="12" y1="19" x2="20" y2="19"></line>
                </svg>
            </div>
            <span class="desktop-icon-label">Terminal</span>
        </div>

        <div class="desktop-icon" id="icon-todos" data-target="todoWin" style="left: 24px; top: 234px;">
            <div class="desktop-icon-art">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 11l3 3L22 4"></path>
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                </svg>
            </div>
            <span class="desktop-icon-label">Roadmap</span>
        </div>

        <div class="desktop-icon" id="icon-skills" data-target="skillsWin" style="left: 24px; top: 324px;">
            <div class="desktop-icon-art">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                    <polyline points="2 17 12 22 22 17"></polyline>
                    <polyline points="2 12 12 17 22 12"></polyline>
                </svg>
            </div>
            <span class="desktop-icon-label">Skills</span>
        </div>

        <div class="desktop-icon" id="icon-about" data-target="aboutWin" style="left: 24px; top: 414px;">
            <div class="desktop-icon-art">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                </svg>
            </div>
            <span class="desktop-icon-label">About</span>
        </div>

        <div class="desktop-icon" id="icon-contact" data-target="contactWin" style="left: 24px; top: 504px;">
            <div class="desktop-icon-art">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
            </div>
            <span class="desktop-icon-label">Contact</span>
        </div>

        <div class="desktop-icon" id="icon-calendar" data-target="calendarWin" style="left: 120px; top: 144px;">
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


        <!-- PROJECT SHORTCUT ICONS -->
        <div class="desktop-icon" id="icon-proj-yuni" data-action="project-modal" data-slug="yuni-counter-v2" title="Yuni Counter V2 (Taiwan)">
            <div class="desktop-icon-art">
                <span class="desktop-icon-badge">LIVE</span>
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                </svg>
            </div>
            <span class="desktop-icon-label">yuni.app</span>
        </div>

        <div class="desktop-icon" id="icon-proj-pulse" data-action="project-modal" data-slug="pulse-telemetry" title="Pulse Telemetry (SSE)">
            <div class="desktop-icon-art">
                <span class="desktop-icon-badge">LIVE</span>
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                </svg>
            </div>
            <span class="desktop-icon-label">pulse.app</span>
        </div>

        <div class="desktop-icon" id="icon-proj-kwitansi" data-action="project-modal" data-slug="kharisma-ac-kwitansi" title="Kharisma AC Kwitansi">
            <div class="desktop-icon-art">
                <span class="desktop-icon-badge">BIZ</span>
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2">
                    <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                    <line x1="2" y1="10" x2="22" y2="10"></line>
                </svg>
            </div>
            <span class="desktop-icon-label">kwitansi.app</span>
        </div>

        <div class="desktop-icon" id="icon-proj-hub" data-action="project-modal" data-slug="vanzodev-hub" title="VanzoDev Hub OS Gateway">
            <div class="desktop-icon-art">
                <span class="desktop-icon-badge">OS</span>
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2">
                    <rect x="2" y="3" width="20" height="14" rx="2"></rect>
                    <line x1="8" y1="21" x2="16" y2="21"></line>
                    <line x1="12" y1="17" x2="12" y2="21"></line>
                </svg>
            </div>
            <span class="desktop-icon-label">hub.app</span>
        </div>

        <div class="desktop-icon" id="icon-proj-lab" data-action="project-modal" data-slug="lab-agent-pipeline" title="AI Agent Lab Pipeline">
            <div class="desktop-icon-art">
                <span class="desktop-icon-badge" style="background: #a855f7;">LAB</span>
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#a855f7" stroke-width="2">
                    <path d="M10 2v7.31L4.69 18.5a2 2 0 0 0 1.62 3.5h11.38a2 2 0 0 0 1.62-3.5L14 9.31V2"></path>
                </svg>
            </div>
            <span class="desktop-icon-label">lab.app</span>
        </div>

        <div class="desktop-icon" id="icon-admin" data-target="adminWin" style="left: 120px; top: 54px;">
            <div class="desktop-icon-art">
                <span class="desktop-icon-badge admin-badge-indicator">CMS</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--admin-accent)" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
            </div>
            <span class="desktop-icon-label">Control Center</span>
        </div>

        <!-- ============================================================== -->
        <!-- FLOATING WINDOWS                                               -->
        <!-- ============================================================== -->

        <!-- 1. PROJECTS FINDER WINDOW -->
        <div class="window is-hidden" id="projectsWin" style="left: 14%; top: 8%; width: 720px; height: 500px;">
            <div class="window-bar" onmousedown="dragWindow(event, 'projectsWin')">
                <div class="window-lights">
                    <button class="window-light window-light-close" onclick="toggleWindow('projectsWin')"></button>
                    <button class="window-light window-light-min" onclick="toggleWindow('projectsWin')"></button>
                    <button class="window-light window-light-max" onclick="maximizeWindow('projectsWin')"></button>
                </div>
                <span class="window-title">Finder — Work Directory</span>
                <div class="window-actions">
                    <button class="btn-mini-admin" id="btnAddProjectQuick" onclick="openAdminCreateProject()" style="display: none;">+ Add Project</button>
                </div>
            </div>
            <div class="window-content">
                <div class="finder-toolbar">
                    <div class="finder-filter-group" id="projectFilterGroup">
                        <button class="finder-tab-btn is-active" onclick="filterProjects('all')">All</button>
                        <button class="finder-tab-btn" onclick="filterProjects('Production App')">Production</button>
                        <button class="finder-tab-btn" onclick="filterProjects('Infrastructure Daemon')">Infrastructure</button>
                        <button class="finder-tab-btn" onclick="filterProjects('Enterprise Accounting')">Enterprise</button>
                    </div>
                    <div class="finder-search">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <input type="text" id="projectSearchInput" placeholder="Filter projects..." oninput="handleProjectSearch(this.value)">
                    </div>
                </div>
                <div class="finder-grid" id="projectCardsGrid">
                    <!-- Dynamic Hydration from /api/projects -->
                    <div style="grid-column: 1/-1; text-align: center; padding: 40px; color: var(--text-muted);">
                        Loading dynamic projects...
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. TERMINAL CLI WINDOW -->
        <div class="window is-hidden" id="terminalWin" style="left: 20%; top: 12%; width: 660px; height: 420px;">
            <div class="window-bar" onmousedown="dragWindow(event, 'terminalWin')">
                <div class="window-lights">
                    <button class="window-light window-light-close" onclick="toggleWindow('terminalWin')"></button>
                    <button class="window-light window-light-min" onclick="toggleWindow('terminalWin')"></button>
                    <button class="window-light window-light-max" onclick="maximizeWindow('terminalWin')"></button>
                </div>
                <span class="window-title">vanzo@hub:~ (bash)</span>
            </div>
            <div class="window-content">
                <div class="terminal-container">
                    <canvas class="matrix-canvas" id="matrixCanvas"></canvas>
                    <div class="terminal-output" id="terminalOutput">
                        <div class="terminal-line" style="color: #10b981;">VanzoDev Shell [Version 2.4.0-release]</div>
                        <div class="terminal-line" style="color: #94a3b8;">Type <span style="color: #38bdf8;">'help'</span> or <span style="color: #38bdf8;">'vanzofetch'</span> to explore commands.</div>
                        <div class="terminal-line">----------------------------------------------------</div>
                    </div>
                    <div class="terminal-prompt-row">
                        <span class="terminal-prompt-label">vanzo@hub:~$</span>
                        <input type="text" class="terminal-input" id="terminalInput" autofocus spellcheck="false" autocomplete="off" onkeydown="handleTerminalKey(event)">
                    </div>
                </div>
            </div>
        </div>

        <!-- 2.5 CALENDAR WINDOW -->
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

        <!-- 3. ROADMAP & TASKS WINDOW -->
        <div class="window is-hidden" id="todoWin" style="left: 26%; top: 15%; width: 560px; height: 460px;">
            <div class="window-bar" onmousedown="dragWindow(event, 'todoWin')">
                <div class="window-lights">
                    <button class="window-light window-light-close" onclick="toggleWindow('todoWin')"></button>
                    <button class="window-light window-light-min" onclick="toggleWindow('todoWin')"></button>
                    <button class="window-light window-light-max" onclick="maximizeWindow('todoWin')"></button>
                </div>
                <span class="window-title">todos.md — Roadmap</span>
            </div>
            <div class="window-content">
                <div class="roadmap-container">
                    <!-- Dual Task Tab Switcher -->
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
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. SKILLS & CAPABILITIES WINDOW -->
        <div class="window is-hidden" id="skillsWin" style="left: 28%; top: 14%; width: 540px; height: 440px;">
            <div class="window-bar" onmousedown="dragWindow(event, 'skillsWin')">
                <div class="window-lights">
                    <button class="window-light window-light-close" onclick="toggleWindow('skillsWin')"></button>
                    <button class="window-light window-light-min" onclick="toggleWindow('skillsWin')"></button>
                    <button class="window-light window-light-max" onclick="maximizeWindow('skillsWin')"></button>
                </div>
                <span class="window-title">Skills & Capabilities</span>
            </div>
            <div class="window-content" style="padding: 16px;" id="skillsContentContainer">
                <!-- Dynamically loaded from /api/skills -->
            </div>
        </div>

        <!-- 5. ABOUT WINDOW -->
        <div class="window is-hidden" id="aboutWin" style="left: 22%; top: 16%; width: 520px; height: 400px;">
            <div class="window-bar" onmousedown="dragWindow(event, 'aboutWin')">
                <div class="window-lights">
                    <button class="window-light window-light-close" onclick="toggleWindow('aboutWin')"></button>
                    <button class="window-light window-light-min" onclick="toggleWindow('aboutWin')"></button>
                    <button class="window-light window-light-max" onclick="maximizeWindow('aboutWin')"></button>
                </div>
                <span class="window-title">about.txt</span>
            </div>
            <div class="window-content" style="padding: 20px; font-size: 13px; line-height: 1.7; color: var(--text-muted);" id="aboutContent">
                <h3 style="color: var(--text-main); margin-bottom: 8px; font-size: 16px;" id="aboutHeadline">Engineering with intent.</h3>
                <p id="aboutBioP1" style="margin-bottom: 12px;">I am Jovan (VanzoDev), a software engineer with deep interest in resilient web systems, API design, and modern minimalist interfaces.</p>
                <p id="aboutBioP2" style="margin-bottom: 16px;">My core toolkit includes Next.js, React, Laravel, TypeScript, Tailwind CSS, and Linux VPS environments. I prioritize performance, clarity of architecture, and clean user experience.</p>
                <div style="background: var(--win-surface); border: 1px solid var(--border-color); border-radius: 8px; padding: 12px; display: flex; align-items: center; justify-content: space-between;">
                    <span style="font-family: var(--font-mono); font-size: 12px; color: var(--text-main);" id="aboutEmail">jovansantosa08@gmail.com</span>
                    <button class="chip" onclick="copyEmail()">Copy Email</button>
                </div>
            </div>
        </div>

        <!-- 6. CONTACT WINDOW -->
        <div class="window is-hidden" id="contactWin" style="left: 32%; top: 18%; width: 480px; height: 430px;">
            <div class="window-bar" onmousedown="dragWindow(event, 'contactWin')">
                <div class="window-lights">
                    <button class="window-light window-light-close" onclick="toggleWindow('contactWin')"></button>
                    <button class="window-light window-light-min" onclick="toggleWindow('contactWin')"></button>
                    <button class="window-light window-light-max" onclick="maximizeWindow('contactWin')"></button>
                </div>
                <span class="window-title">contact.eml</span>
            </div>
            <div class="window-content" style="padding: 18px;">
                <form id="contactForm" onsubmit="submitContactForm(event)" style="display: flex; flex-direction: column; gap: 10px;">
                    <div class="admin-form-group">
                        <label class="admin-form-label">Your Name</label>
                        <input type="text" class="admin-input" id="contactName" required placeholder="Alice">
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Email Address</label>
                        <input type="email" class="admin-input" id="contactEmail" required placeholder="alice@example.com">
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Message</label>
                        <textarea class="admin-textarea" id="contactMessage" rows="4" required placeholder="Hi Jovan, let's build something..."></textarea>
                    </div>
                    <button type="submit" class="chip chip-primary" style="justify-content: center; padding: 10px;">
                        <span>Send Message ↗</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- 7. IN-OS ADMIN CONTROL CENTER WINDOW -->
        <div class="window is-hidden" id="adminWin" style="left: 25%; top: 10%; width: 680px; height: 520px;">
            <div class="window-bar" onmousedown="dragWindow(event, 'adminWin')" style="background: color-mix(in oklab, var(--admin-accent) 15%, var(--win-header));">
                <div class="window-lights">
                    <button class="window-light window-light-close" onclick="toggleWindow('adminWin')"></button>
                    <button class="window-light window-light-min" onclick="toggleWindow('adminWin')"></button>
                    <button class="window-light window-light-max" onclick="maximizeWindow('adminWin')"></button>
                </div>
                <span class="window-title" style="color: #fff;">Vanzo OS Admin & CMS</span>
            </div>
            <div class="window-content">
                <!-- Unauthenticated: Login View -->
                <div id="adminLoginView" style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; padding: 24px;">
                    <div style="background: var(--win-surface); border: 1px solid var(--border-active); border-radius: 12px; padding: 24px; width: min(380px, 92vw);">
                        <div style="text-align: center; margin-bottom: 18px;">
                            <div style="font-size: 24px; margin-bottom: 6px;">⚡</div>
                            <h3 style="font-size: 16px; font-weight: 700;">Admin Control Panel</h3>
                            <p style="font-size: 11px; color: var(--text-muted); margin-top: 4px;">Sign in to manage projects & database</p>
                        </div>
                        <form onsubmit="handleAdminLogin(event)" style="display: flex; flex-direction: column; gap: 12px;">
                            <div class="admin-form-group">
                                <label class="admin-form-label">Email</label>
                                <input type="email" class="admin-input" id="adminLoginEmail" required value="admin@vanzodev.my.id">
                            </div>
                            <div class="admin-form-group">
                                <label class="admin-form-label">Password</label>
                                <input type="password" class="admin-input" id="adminLoginPassword" required placeholder="••••••••••••">
                            </div>
                            <button type="submit" class="btn-admin-primary" style="padding: 10px; width: 100%;">Authenticate Session</button>
                        </form>
                    </div>
                </div>

                <!-- Authenticated: Dashboard View -->
                <div id="adminDashboardView" style="display: none; flex-direction: column; height: 100%;">
                    <div class="admin-nav">
                        <button class="admin-nav-tab is-active" onclick="switchAdminTab('projects')">Projects</button>
                        <button class="admin-nav-tab" onclick="switchAdminTab('roadmap')">Roadmap</button>
                        <button class="admin-nav-tab" onclick="switchAdminTab('inbox')">Inbox</button>
                        <button class="admin-nav-tab" onclick="switchAdminTab('profile')">Profile</button>
                        <button class="btn-mini-admin" onclick="handleAdminLogout()" style="margin-left: auto;">Sign Out</button>
                    </div>
                    <div class="admin-body">
                        <!-- Tab 1: Projects CMS -->
                        <div id="adminTabProjects">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
                                <h4 style="font-size: 13px;">Manage Portfolio Projects</h4>
                                <button class="btn-admin-primary" onclick="openAdminCreateProject()">+ New Project</button>
                            </div>
                            <div id="adminProjectsList" style="display: flex; flex-direction: column; gap: 8px;">
                                <!-- Rendered dynamically -->
                            </div>
                        </div>

                        <!-- Tab 2: Roadmap CMS -->
                        <div id="adminTabRoadmap" style="display: none;">
                            <h4 style="font-size: 13px; margin-bottom: 12px;">Manage Roadmap Items</h4>
                            <div id="adminRoadmapList" style="display: flex; flex-direction: column; gap: 8px;">
                                <!-- Rendered dynamically -->
                            </div>
                        </div>

                        <!-- Tab 3: Inbox Messages -->
                        <div id="adminTabInbox" style="display: none;">
                            <h4 style="font-size: 13px; margin-bottom: 12px;">Contact Inquiries</h4>
                            <div id="adminInboxList" style="display: flex; flex-direction: column; gap: 8px;">
                                <!-- Rendered dynamically -->
                            </div>
                        </div>

                        <!-- Tab 4: Profile Editor -->
                        <div id="adminTabProfile" style="display: none;">
                            <form onsubmit="handleSaveProfile(event)" style="display: flex; flex-direction: column; gap: 12px;">
                                <div class="admin-form-group">
                                    <label class="admin-form-label">Headline</label>
                                    <input type="text" class="admin-input" id="adminProfileHeadline" required>
                                </div>
                                <div class="admin-form-group">
                                    <label class="admin-form-label">Bio Paragraph 1</label>
                                    <textarea class="admin-textarea" id="adminProfileBio1" rows="3"></textarea>
                                </div>
                                <div class="admin-form-group">
                                    <label class="admin-form-label">Bio Paragraph 2</label>
                                    <textarea class="admin-textarea" id="adminProfileBio2" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn-admin-primary">Save Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- BOTTOM APP DOCK                                                -->
        <!-- ============================================================== -->
        <div class="dock-wrapper">
            <nav class="dock" role="navigation">
                <button class="dock-btn" onclick="toggleWindow('projectsWin')" aria-label="Projects">
                    <span class="dock-tip">Projects</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="3" width="20" height="14" rx="2"></rect>
                        <line x1="8" y1="21" x2="16" y2="21"></line>
                        <line x1="12" y1="17" x2="12" y2="21"></line>
                    </svg>
                </button>

                <button class="dock-btn" onclick="toggleWindow('terminalWin')" aria-label="Terminal">
                    <span class="dock-tip">Terminal</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="4 17 10 11 4 5"></polyline>
                        <line x1="12" y1="19" x2="20" y2="19"></line>
                    </svg>
                </button>

                <button class="dock-btn" onclick="toggleWindow('todoWin')" aria-label="Roadmap">
                    <span class="dock-tip">Roadmap</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 11l3 3L22 4"></path>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                </button>

                <button class="dock-btn" onclick="toggleWindow('skillsWin')" aria-label="Skills">
                    <span class="dock-tip">Skills</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                        <polyline points="2 17 12 22 22 17"></polyline>
                        <polyline points="2 12 12 17 22 12"></polyline>
                    </svg>
                </button>

                <button class="dock-btn" onclick="toggleWindow('aboutWin')" aria-label="About">
                    <span class="dock-tip">About</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                    </svg>
                </button>

                <button class="dock-btn" onclick="toggleWindow('contactWin')" aria-label="Contact">
                    <span class="dock-tip">Contact</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </button>

                <button class="dock-btn" onclick="toggleWindow('adminWin')" aria-label="Control Center">
                    <span class="dock-tip">CMS / Admin</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--admin-accent)" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                </button>

                <div class="dock-sep"></div>

                <button class="dock-btn" onclick="window.open('https://github.com/JovanSantosa', '_blank')" aria-label="GitHub">
                    <span class="dock-tip">GitHub</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                    </svg>
                </button>
            </nav>
        </div>

    </div>

    <!-- ============================================================== -->
    <!-- MODALS & OVERLAYS                                              -->
    <!-- ============================================================== -->

    <!-- Universal Project Preview Modal -->
    <div class="modal-overlay" id="projectModal" onclick="if(event.target===this) closeModal('projectModal')">
        <div class="modal-box">
            <div class="modal-header">
                <span class="modal-title" id="modalProjectTitle">Project Details</span>
                <button class="modal-close" onclick="closeModal('projectModal')">&times;</button>
            </div>
            <div class="modal-body">
                <p id="modalProjectDesc">Description text</p>
                <div class="modal-preview">
                    <div class="modal-preview-row">
                        <span class="modal-preview-label">Category / Status</span>
                        <span class="modal-preview-value" id="modalProjectCategory" style="color: var(--accent-color);">Production</span>
                    </div>
                    <div class="modal-preview-row">
                        <span class="modal-preview-label">Tech Stack</span>
                        <span class="modal-preview-value" id="modalProjectStack" style="color: var(--text-main);">Next.js, Laravel</span>
                    </div>
                    <div class="modal-preview-row">
                        <span class="modal-preview-label">Endpoint</span>
                        <span class="modal-preview-value" id="modalProjectEndpoint" style="color: var(--text-muted); font-size: 11px;">https://yuni.vanzodev.my.id</span>
                    </div>
                </div>
            </div>
            <div class="modal-actions">
                <button class="chip" onclick="closeModal('projectModal')">Dismiss</button>
                <a class="chip chip-primary" id="modalProjectLink" href="#" target="_blank" rel="noreferrer">Open Live ↗</a>
            </div>
        </div>
    </div>

    <!-- Admin Project Form Modal (Create / Edit) -->
    <div class="modal-overlay" id="adminProjectModal" onclick="if(event.target===this) closeModal('adminProjectModal')">
        <div class="modal-box">
            <div class="modal-header">
                <span class="modal-title" id="adminProjectModalTitle">Project Editor</span>
                <button class="modal-close" onclick="closeModal('adminProjectModal')">&times;</button>
            </div>
            <div class="modal-body">
                <form id="adminProjectForm" onsubmit="submitAdminProjectForm(event)">
                    <input type="hidden" id="editProjectId">
                    <div class="admin-form-group">
                        <label class="admin-form-label">Project Title</label>
                        <input type="text" class="admin-input" id="formProjectTitle" required>
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Category</label>
                        <input type="text" class="admin-input" id="formProjectCategory" placeholder="e.g. Production App, Infrastructure">
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Badge</label>
                        <input type="text" class="admin-input" id="formProjectBadge" placeholder="e.g. LIVE, PRODUCTION">
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Summary</label>
                        <input type="text" class="admin-input" id="formProjectSummary" required>
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Description</label>
                        <textarea class="admin-textarea" id="formProjectDescription" rows="3"></textarea>
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Tech Stack (comma separated)</label>
                        <input type="text" class="admin-input" id="formProjectTechStack" placeholder="Next.js 15, Laravel 11, SQLite">
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Live URL</label>
                        <input type="text" class="admin-input" id="formProjectLiveUrl" placeholder="https://...">
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Repo URL</label>
                        <input type="text" class="admin-input" id="formProjectRepoUrl" placeholder="https://github.com/...">
                    </div>
                    <div style="display: flex; justify-content: flex-end; gap: 8px; margin-top: 10px;">
                        <button type="button" class="chip" onclick="closeModal('adminProjectModal')">Cancel</button>
                        <button type="submit" class="btn-admin-primary">Save to Database</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Spotlight Search Overlay -->
    <div class="spotlight-overlay" id="spotlightOverlay" onclick="if(event.target===this) toggleSpotlight()">
        <div class="spotlight-box">
            <div class="spotlight-input">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" id="spotlightQuery" placeholder="Search projects, apps, commands..." oninput="handleSpotlightInput(this.value)">
            </div>
            <div class="spotlight-list" id="spotlightResults">
                <!-- Hydrated dynamically -->
            </div>
        </div>
    </div>

    <!-- Toast Notifications Container -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- ============================================================== -->
    <!-- CORE SCRIPTS & HYDRATION                                       -->
    <!-- ============================================================== -->
    <script>
        // State Store
        let projectsData = [];
        let tasksData = [];
        let skillsData = {};
        let profileData = {};
        let soundEnabled = true;
        let adminToken = localStorage.getItem('vanzo_admin_token') || null;

        // Web Audio Synthesizer (Zero asset latency)
        const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
        function playChime(freq = 440, type = 'sine', duration = 0.08) {
            if (!soundEnabled || !audioCtx) return;
            try {
                if (audioCtx.state === 'suspended') audioCtx.resume();
                const osc = audioCtx.createOscillator();
                const gain = audioCtx.createGain();
                osc.type = type;
                osc.frequency.setValueAtTime(freq, audioCtx.currentTime);
                gain.gain.setValueAtTime(0.06, audioCtx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + duration);
                osc.connect(gain);
                gain.connect(audioCtx.destination);
                osc.start();
                osc.stop(audioCtx.currentTime + duration);
            } catch(e) {}
        }

        function toggleSound() {
            soundEnabled = !soundEnabled;
            document.getElementById('soundIcon').textContent = soundEnabled ? '🔊' : '🔇';
            showToast(soundEnabled ? 'UI Sound Enabled' : 'UI Sound Muted');
            if (soundEnabled) playChime(660);
        }

        // Digital Clock
        function updateClock() {
            const now = new Date();
            document.getElementById('digitalClock').textContent = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Theme & Wallpaper
        function toggleTheme() {
            const body = document.body;
            const current = body.getAttribute('data-theme');
            const next = current === 'dark' ? 'light' : 'dark';
            body.setAttribute('data-theme', next);
            document.getElementById('themeIcon').textContent = next === 'dark' ? '🌙' : '☀️';
            playChime(520);
        }

        const wallpapers = ['dots', 'grid', 'circuit', 'fluid', 'solid'];
        function cycleWallpaper() {
            const current = document.body.getAttribute('data-wallpaper') || 'dots';
            const nextIdx = (wallpapers.indexOf(current) + 1) % wallpapers.length;
            document.body.setAttribute('data-wallpaper', wallpapers[nextIdx]);
            showToast('Wallpaper: ' + wallpapers[nextIdx]);
            playChime(580);
        }

        // Layering & Window Drag
        let topZ = 100;
        function bringToFront(winId) {
            const win = document.getElementById(winId);
            if (!win) return;
            topZ++;
            win.style.zIndex = topZ;
            document.querySelectorAll('.window').forEach(w => w.classList.remove('is-top'));
            win.classList.add('is-top');
        }

        function toggleWindow(winId) {
            const win = document.getElementById(winId);
            if (!win) return;
            const isHidden = win.classList.contains('is-hidden');
            if (isHidden) {
                win.classList.remove('is-hidden');
                bringToFront(winId);
                playChime(600, 'sine', 0.1);
            } else {
                win.classList.add('is-hidden');
                playChime(350, 'sine', 0.08);
            }
        }

        function maximizeWindow(winId) {
            const win = document.getElementById(winId);
            if (!win) return;
            if (win.dataset.maximized === 'true') {
                win.style.left = win.dataset.prevLeft;
                win.style.top = win.dataset.prevTop;
                win.style.width = win.dataset.prevWidth;
                win.style.height = win.dataset.prevHeight;
                win.dataset.maximized = 'false';
            } else {
                win.dataset.prevLeft = win.style.left;
                win.dataset.prevTop = win.style.top;
                win.dataset.prevWidth = win.style.width;
                win.dataset.prevHeight = win.style.height;
                win.style.left = '4px';
                win.style.top = '38px';
                win.style.width = 'calc(100vw - 8px)';
                win.style.height = 'calc(100vh - 100px)';
                win.dataset.maximized = 'true';
            }
            playChime(480);
        }

        let dragObj = null;
        function dragWindow(e, winId) {
            if (window.innerWidth <= 768) return; // Disabled on mobile sheets
            bringToFront(winId);
            const win = document.getElementById(winId);
            const startX = e.clientX;
            const startY = e.clientY;
            const rect = win.getBoundingClientRect();
            const offX = startX - rect.left;
            const offY = startY - rect.top;

            function onMouseMove(ev) {
                win.style.left = `${ev.clientX - offX}px`;
                win.style.top = `${ev.clientY - offY}px`;
            }
            function onMouseUp() {
                window.removeEventListener('mousemove', onMouseMove);
                window.removeEventListener('mouseup', onMouseUp);
            }
            window.addEventListener('mousemove', onMouseMove);
            window.addEventListener('mouseup', onMouseUp);
        }

        // Desktop Icons click (Clean Click vs Drag Distinction)
        document.querySelectorAll('.desktop-icon').forEach(icon => {
            icon.addEventListener('click', (e) => {
                if (icon.dataset.dragged === 'true') {
                    // Mencegah trigger action bila baru selesai di-drag
                    icon.dataset.dragged = 'false';
                    e.preventDefault();
                    e.stopPropagation();
                    return;
                }
                const action = icon.getAttribute('data-action');
                if (action === 'project-modal') {
                    const slug = icon.getAttribute('data-slug');
                    const proj = projectsData.find(p => p.slug === slug);
                    if (proj) openProjectModal(proj.id);
                    return;
                }
                const target = icon.getAttribute('data-target');
                if (target) toggleWindow(target);
            });
        });

        // Toast Helper
        function showToast(msg) {
            const container = document.getElementById('toastContainer');
            const t = document.createElement('div');
            t.className = 'toast-msg';
            t.textContent = msg;
            container.appendChild(t);
            setTimeout(() => {
                t.style.opacity = '0';
                t.style.transition = 'opacity 0.3s ease';
                setTimeout(() => t.remove(), 300);
            }, 3000);
        }

        // ==========================================
        // DYNAMIC API HYDRATION
        // ==========================================
        async function fetchAllData() {
            try {
                // 1. Projects
                const resProjects = await fetch('/api/projects');
                if (resProjects.ok) {
                    projectsData = await resProjects.json();
                    renderProjects(projectsData);
                    document.getElementById('iconProjectsCount').textContent = projectsData.length;
                }

                // 2. Tasks
                const resTasks = await fetch('/api/tasks');
                if (resTasks.ok) {
                    tasksData = await resTasks.json();
                    renderTasks(tasksData);
                }

                // 3. Skills
                const resSkills = await fetch('/api/skills');
                if (resSkills.ok) {
                    skillsData = await resSkills.json();
                    renderSkills(skillsData);
                }

                // 4. Profile
                const resProfile = await fetch('/api/profile');
                if (resProfile.ok) {
                    profileData = await resProfile.json();
                    renderProfile(profileData);
                }
            } catch (err) {
                console.error("API hydration error:", err);
            }
        }

        // Render Projects
        function renderProjects(list) {
            const grid = document.getElementById('projectCardsGrid');
            if (!grid) return;
            if (!list || list.length === 0) {
                grid.innerHTML = '<div style="grid-column: 1/-1; text-align: center; padding: 40px; color: var(--text-muted);">No projects found.</div>';
                return;
            }

            grid.innerHTML = list.map(p => `
                <div class="project-card" onclick="openProjectModal(${p.id})">
                    <div class="project-card-header">
                        <span class="project-card-title">${p.title}</span>
                        <span class="project-badge">${p.badge || p.category || 'LIVE'}</span>
                    </div>
                    <div class="project-card-desc">${p.summary}</div>
                    <div class="project-tags">
                        ${(p.tech_stack || []).map(t => `<span class="project-tag">${t}</span>`).join('')}
                    </div>
                    <div class="project-admin-actions" onclick="event.stopPropagation()">
                        <button class="btn-mini-admin" onclick="openAdminEditProject(${p.id})">Edit</button>
                        <button class="btn-mini-admin" onclick="deleteAdminProject(${p.id})" style="color: #ef4444;">Delete</button>
                    </div>
                </div>
            `).join('');
        }

        function filterProjects(cat) {
            document.querySelectorAll('#projectFilterGroup .finder-tab-btn').forEach(b => b.classList.remove('is-active'));
            event.target.classList.add('is-active');
            if (cat === 'all') {
                renderProjects(projectsData);
            } else {
                renderProjects(projectsData.filter(p => p.category === cat));
            }
            playChime(500);
        }

        function handleProjectSearch(query) {
            const q = query.toLowerCase();
            const filtered = projectsData.filter(p => 
                p.title.toLowerCase().includes(q) || 
                (p.summary && p.summary.toLowerCase().includes(q)) ||
                (p.tech_stack && p.tech_stack.some(t => t.toLowerCase().includes(q)))
            );
            renderProjects(filtered);
        }

        function openProjectModal(id) {
            const p = projectsData.find(x => x.id === id);
            if (!p) return;
            document.getElementById('modalProjectTitle').textContent = p.title;
            document.getElementById('modalProjectDesc').textContent = p.description || p.summary;
            document.getElementById('modalProjectCategory').textContent = `${p.category} (${p.badge || 'PROD'})`;
            document.getElementById('modalProjectStack').textContent = (p.tech_stack || []).join(', ');
            document.getElementById('modalProjectEndpoint').textContent = p.endpoint || p.live_url || 'Active System';
            
            const linkBtn = document.getElementById('modalProjectLink');
            if (p.live_url) {
                linkBtn.href = p.live_url;
                linkBtn.style.display = 'inline-flex';
            } else {
                linkBtn.style.display = 'none';
            }

            document.getElementById('projectModal').classList.add('is-open');
            playChime(650);
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('is-open');
            playChime(380);
        }

        // Render Tasks with Dual Scope Filter
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
        }

        async function toggleTaskStatus(id, isCompleted) {
            if (!adminToken) {
                showToast('Authentication required to update tasks');
                renderTasks(tasksData); // revert
                return;
            }
            try {
                const nextStatus = isCompleted ? 'completed' : 'in_progress';
                const res = await fetch(`/api/admin/tasks/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${adminToken}`
                    },
                    body: JSON.stringify({ status: nextStatus })
                });
                if (res.ok) {
                    showToast('Roadmap updated');
                    fetchAllData();
                    playChime(700);
                }
            } catch(e) {
                showToast('Failed to update task');
            }
        }

        async function submitQuickTask() {
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
                });
                if (res.ok) {
                    input.value = '';
                    showToast('Task added to roadmap');
                    fetchAllData();
                    playChime(680);
                }
            } catch(e) {}
        }

        // Render Skills
        function renderSkills(categories) {
            const container = document.getElementById('skillsContentContainer');
            if (!container) return;
            let html = '';
            for (const [cat, skills] of Object.entries(categories)) {
                html += `
                    <div style="margin-bottom: 18px;">
                        <h4 style="font-size: 12px; font-weight: 700; color: var(--accent-color); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em;">${cat}</h4>
                        <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                            ${skills.map(s => `
                                <div style="background: var(--win-surface); border: 1px solid var(--border-color); border-radius: 6px; padding: 6px 10px; font-size: 11px; display: flex; align-items: center; gap: 6px;">
                                    <span style="font-weight: 600; color: var(--text-main);">${s.name}</span>
                                    <span style="font-family: var(--font-mono); font-size: 9px; color: var(--text-muted); background: var(--border-color); padding: 1px 4px; border-radius: 4px;">${s.level}</span>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                `;
            }
            container.innerHTML = html;
        }

        // Render Profile
        function renderProfile(p) {
            if (!p) return;
            if (p.headline) document.getElementById('aboutHeadline').textContent = p.headline;
            if (p.bio_p1) document.getElementById('aboutBioP1').textContent = p.bio_p1;
            if (p.bio_p2) document.getElementById('aboutBioP2').textContent = p.bio_p2;
            if (p.email) document.getElementById('aboutEmail').textContent = p.email;
        }

        function copyEmail() {
            const email = document.getElementById('aboutEmail').textContent;
            navigator.clipboard.writeText(email);
            showToast('Email copied to clipboard!');
            playChime(800);
        }

        // Contact Form Submission
        async function submitContactForm(e) {
            e.preventDefault();
            const btn = e.target.querySelector('button[type="submit"]');
            btn.disabled = true;
            btn.innerText = 'Sending...';

            const payload = {
                name: document.getElementById('contactName').value,
                email: document.getElementById('contactEmail').value,
                message: document.getElementById('contactMessage').value,
            };

            try {
                const res = await fetch('/api/contact', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });
                const data = await res.json();
                if (res.ok) {
                    showToast('Message sent! Jovan will review it shortly.');
                    document.getElementById('contactForm').reset();
                    toggleWindow('contactWin');
                    playChime(750, 'sine', 0.2);
                } else {
                    showToast(data.message || 'Error sending message');
                }
            } catch (err) {
                showToast('Failed to connect to backend server');
            } finally {
                btn.disabled = false;
                btn.innerText = 'Send Message ↗';
            }
        }


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

            const midColX = isNarrow ? Math.max(leftColX + 80, window.innerWidth - 180) : leftColX + 96;
            return {
                // Kolom Kiri: Core Windows
                'icon-projects': { x: leftColX, y: 52 },
                'icon-terminal': { x: leftColX, y: 148 },
                'icon-todos':    { x: leftColX, y: 244 },
                'icon-skills':   { x: leftColX, y: 340 },
                'icon-about':    { x: leftColX, y: 436 },

                // Kolom Tengah: Project Direct Shortcuts
                'icon-proj-yuni':     { x: midColX, y: 52 },
                'icon-proj-pulse':    { x: midColX, y: 148 },
                'icon-proj-kwitansi': { x: midColX, y: 244 },
                'icon-proj-hub':      { x: midColX, y: 340 },
                'icon-proj-lab':      { x: midColX, y: 436 },

                // Kolom Kanan: System & Utilities
                'icon-calendar': { x: rightColX, y: 52 },
                'icon-contact':  { x: rightColX, y: 148 },
                'icon-admin':    { x: rightColX, y: 244 }
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
                        icon.dataset.dragged = 'true';
                        setTimeout(() => { icon.dataset.dragged = 'false'; }, 250);

                        let saved = {};
                        try {
                            saved = JSON.parse(localStorage.getItem(DESKTOP_ICON_STORAGE_KEY)) || {};
                        } catch(e) {}
                        saved[icon.id] = {
                            x: parseFloat(icon.style.left),
                            y: parseFloat(icon.style.top)
                        };
                        localStorage.setItem(DESKTOP_ICON_STORAGE_KEY, JSON.stringify(saved));
                    } else {
                        icon.dataset.dragged = 'false';
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

        // ==========================================
        // TERMINAL CLI EMULATOR
        // ==========================================
        const terminalOutput = document.getElementById('terminalOutput');
        const terminalInput = document.getElementById('terminalInput');

        function printTerminal(text, color = '#e2e8f0') {
            const line = document.createElement('div');
            line.className = 'terminal-line';
            line.style.color = color;
            line.innerHTML = text;
            terminalOutput.appendChild(line);
            terminalOutput.scrollTop = terminalOutput.scrollHeight;
        }

        function handleTerminalKey(e) {
            if (e.key === 'Enter') {
                const cmd = terminalInput.value.trim();
                terminalInput.value = '';
                if (!cmd) return;
                playChime(420, 'sine', 0.05);
                printTerminal(`vanzo@hub:~$ ${cmd}`, '#10b981');
                executeTerminalCommand(cmd);
            }
        }

        function executeTerminalCommand(fullCmd) {
            const parts = fullCmd.split(' ');
            const cmd = parts[0].toLowerCase();
            const args = parts.slice(1);

            switch (cmd) {
                case 'help':
                    printTerminal('Available Commands:');
                    printTerminal('  <span style="color:#38bdf8">projects</span>        List live production projects');
                    printTerminal('  <span style="color:#38bdf8">skills</span>          Display tech stack matrix');
                    printTerminal('  <span style="color:#38bdf8">tasks</span>           Print sprint board items');
                    printTerminal('  <span style="color:#38bdf8">about</span>           Display bio & engineer overview');
                    printTerminal('  <span style="color:#38bdf8">vanzofetch</span>      Display server specifications & node info');
                    printTerminal('  <span style="color:#38bdf8">matrix</span>          Toggle matrix digital rain visualizer');
                    printTerminal('  <span style="color:#38bdf8">theme [dark|light]</span> Toggle desktop theme');
                    printTerminal('  <span style="color:#38bdf8">sound [on|off]</span>  Toggle audio sound effects');
                    printTerminal('  <span style="color:#38bdf8">sudo login</span>      Open Admin Authentication prompt');
                    printTerminal('  <span style="color:#38bdf8">clear</span>          Clear terminal screen');
                    break;
                case 'projects':
                    printTerminal('=== PRODUCTION & DEPLOYED PLATFORMS ===', '#f59e0b');
                    projectsData.forEach(p => {
                        printTerminal(`• <b>${p.title}</b> [${p.badge || 'LIVE'}] - ${p.summary}`);
                        if (p.live_url) printTerminal(`  URL: <a href="${p.live_url}" target="_blank" style="color:#38bdf8">${p.live_url}</a>`);
                    });
                    break;
                case 'skills':
                    printTerminal('=== TECHNICAL STACK & CAPABILITIES ===', '#3b82f6');
                    for (const [cat, sList] of Object.entries(skillsData)) {
                        printTerminal(`[${cat}]: ${sList.map(s => s.name).join(', ')}`);
                    }
                    break;
                case 'tasks':
                    printTerminal('=== ROADMAP & TASKS ===', '#10b981');
                    tasksData.forEach(t => {
                        const mark = t.status === 'completed' ? '✓' : '•';
                        printTerminal(`[${mark}] ${t.title} (${t.status})`);
                    });
                    break;
                case 'about':
                    printTerminal(`${profileData.name || 'Jovan (VanzoDev)'} — ${profileData.role || 'Full Stack Engineer'}`);
                    printTerminal(`${profileData.bio_p1 || ''}`);
                    break;
                case 'vanzofetch':
                    printTerminal(`
  __     __                   ____             
  \\ \\   / /_ _ _ __  _______ |  _ \\  _____   __
   \\ \\ / / _\` | '_ \\|_  / _ \\| | | |/ _ \\ \\ / /
    \\ V / (_| | | | |/ / (_) | |_| |  __/\\ V / 
     \\_/ \\__,_|_| |_/___\\___/|____/ \\___| \\_/  
                    `, '#38bdf8');
                    printTerminal('OS: Ubuntu 22.04 LTS x86_64');
                    printTerminal('Host: 203.175.11.150 (server1.jovan.com)');
                    printTerminal('Kernel: 5.15.0-generic');
                    printTerminal('Memory: 1 GB RAM + 2 GB Swap (Low Footprint)');
                    printTerminal('Engine: PHP 8.3 FPM + SQLite3 + Nginx');
                    printTerminal('Domain: portofolio.vanzodev.my.id (SSL Active)');
                    break;
                case 'matrix':
                    toggleMatrixRain();
                    break;
                case 'clear':
                    terminalOutput.innerHTML = '';
                    break;
                case 'theme':
                    if (args[0] === 'light' || args[0] === 'dark') {
                        document.body.setAttribute('data-theme', args[0]);
                    } else {
                        toggleTheme();
                    }
                    printTerminal(`Theme set to ${document.body.getAttribute('data-theme')}`);
                    break;
                case 'sound':
                    if (args[0] === 'off') soundEnabled = false;
                    else if (args[0] === 'on') soundEnabled = true;
                    else soundEnabled = !soundEnabled;
                    printTerminal(`Sound: ${soundEnabled ? 'ENABLED' : 'MUTED'}`);
                    break;
                case 'sudo':
                    if (args[0] === 'login') {
                        toggleWindow('adminWin');
                        printTerminal('Admin authentication modal launched.', '#f59e0b');
                    } else {
                        printTerminal('sudo: command not found or permission denied');
                    }
                    break;
                default:
                    printTerminal(`bash: command not found: ${cmd}. Type 'help' for available commands.`, '#ef4444');
            }
        }

        // Matrix Rain Canvas
        let matrixInterval = null;
        function toggleMatrixRain() {
            const canvas = document.getElementById('matrixCanvas');
            if (canvas.style.display === 'block') {
                canvas.style.display = 'none';
                clearInterval(matrixInterval);
                printTerminal('Matrix mode disabled.');
            } else {
                canvas.style.display = 'block';
                const ctx = canvas.getContext('2d');
                canvas.width = canvas.parentElement.offsetWidth;
                canvas.height = canvas.parentElement.offsetHeight;
                const chars = '0123456789ABCDEFVANZODEV';
                const fontSize = 13;
                const columns = Math.floor(canvas.width / fontSize);
                const drops = Array(columns).fill(1);

                matrixInterval = setInterval(() => {
                    ctx.fillStyle = 'rgba(0, 0, 0, 0.05)';
                    ctx.fillRect(0, 0, canvas.width, canvas.height);
                    ctx.fillStyle = '#0f0';
                    ctx.font = `${fontSize}px monospace`;
                    for (let i = 0; i < drops.length; i++) {
                        const txt = chars[Math.floor(Math.random() * chars.length)];
                        ctx.fillText(txt, i * fontSize, drops[i] * fontSize);
                        if (drops[i] * fontSize > canvas.height && Math.random() > 0.975) drops[i] = 0;
                        drops[i]++;
                    }
                }, 33);
                printTerminal('Matrix rain active! Type "matrix" again to disable.', '#10b981');
            }
        }

        // ==========================================
        // ADMIN CONTROL PANEL & AUTH
        // ==========================================
        function checkAdminSession() {
            if (adminToken) {
                document.body.classList.add('is-admin');
                document.getElementById('adminPill').classList.add('is-active');
                document.getElementById('adminLoginView').style.display = 'none';
                document.getElementById('adminDashboardView').style.display = 'flex';
                document.getElementById('quickAddTaskRow').style.display = 'flex';
                const privTab = document.getElementById('tabPrivateTodos');
                if (privTab) privTab.style.display = 'inline-block';
                document.getElementById('btnAddProjectQuick').style.display = 'inline-block';
                renderAdminProjects();
                renderAdminRoadmap();
                fetchAdminInbox();
            } else {
                document.body.classList.remove('is-admin');
                document.getElementById('adminPill').classList.remove('is-active');
                document.getElementById('adminLoginView').style.display = 'flex';
                document.getElementById('adminDashboardView').style.display = 'none';
                document.getElementById('quickAddTaskRow').style.display = 'none';
                document.getElementById('btnAddProjectQuick').style.display = 'none';
            }
        }

        async function handleAdminLogin(e) {
            e.preventDefault();
            const email = document.getElementById('adminLoginEmail').value;
            const password = document.getElementById('adminLoginPassword').value;

            try {
                const res = await fetch('/api/auth/login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email, password })
                });
                const data = await res.json();
                if (res.ok && data.token) {
                    adminToken = data.token;
                    localStorage.setItem('vanzo_admin_token', adminToken);
                    checkAdminSession();
                    showToast('Authenticated as Admin!');
                    playChime(750);
                } else {
                    showToast(data.message || 'Authentication failed');
                }
            } catch (err) {
                showToast('Login error: Check server connection');
            }
        }

        async function handleAdminLogout() {
            if (adminToken) {
                try {
                    await fetch('/api/auth/logout', {
                        method: 'POST',
                        headers: { 'Authorization': `Bearer ${adminToken}` }
                    });
                } catch(e) {}
            }
            adminToken = null;
            localStorage.removeItem('vanzo_admin_token');
            checkAdminSession();
            showToast('Logged out of Admin session');
            playChime(350);
        }

        function switchAdminTab(tab) {
            document.querySelectorAll('.admin-nav-tab').forEach(b => b.classList.remove('is-active'));
            event.target.classList.add('is-active');
            document.getElementById('adminTabProjects').style.display = tab === 'projects' ? 'block' : 'none';
            document.getElementById('adminTabRoadmap').style.display = tab === 'roadmap' ? 'block' : 'none';
            document.getElementById('adminTabInbox').style.display = tab === 'inbox' ? 'block' : 'none';
            document.getElementById('adminTabProfile').style.display = tab === 'profile' ? 'block' : 'none';
            playChime(500);
        }

        function renderAdminProjects() {
            const list = document.getElementById('adminProjectsList');
            if (!list) return;
            list.innerHTML = projectsData.map(p => `
                <div style="background: var(--win-surface); border: 1px solid var(--border-color); border-radius: 8px; padding: 10px 14px; display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <b style="font-size: 13px;">${p.title}</b>
                        <span style="font-size: 11px; color: var(--text-muted); margin-left: 8px;">(${p.category})</span>
                    </div>
                    <div style="display: flex; gap: 6px;">
                        <button class="btn-mini-admin" onclick="openAdminEditProject(${p.id})">Edit</button>
                        <button class="btn-mini-admin" onclick="deleteAdminProject(${p.id})" style="color: #ef4444;">Delete</button>
                    </div>
                </div>
            `).join('');
        }

        function openAdminCreateProject() {
            document.getElementById('adminProjectModalTitle').textContent = 'Add New Project';
            document.getElementById('adminProjectForm').reset();
            document.getElementById('editProjectId').value = '';
            document.getElementById('adminProjectModal').classList.add('is-open');
        }

        function openAdminEditProject(id) {
            const p = projectsData.find(x => x.id === id);
            if (!p) return;
            document.getElementById('adminProjectModalTitle').textContent = `Edit Project — ${p.title}`;
            document.getElementById('editProjectId').value = p.id;
            document.getElementById('formProjectTitle').value = p.title;
            document.getElementById('formProjectCategory').value = p.category || '';
            document.getElementById('formProjectBadge').value = p.badge || '';
            document.getElementById('formProjectSummary').value = p.summary || '';
            document.getElementById('formProjectDescription').value = p.description || '';
            document.getElementById('formProjectTechStack').value = (p.tech_stack || []).join(', ');
            document.getElementById('formProjectLiveUrl').value = p.live_url || '';
            document.getElementById('formProjectRepoUrl').value = p.repo_url || '';
            document.getElementById('adminProjectModal').classList.add('is-open');
        }

        async function submitAdminProjectForm(e) {
            e.preventDefault();
            const editId = document.getElementById('editProjectId').value;
            const techStr = document.getElementById('formProjectTechStack').value;
            const techStack = techStr ? techStr.split(',').map(s => s.trim()) : [];

            const payload = {
                title: document.getElementById('formProjectTitle').value,
                category: document.getElementById('formProjectCategory').value,
                badge: document.getElementById('formProjectBadge').value,
                summary: document.getElementById('formProjectSummary').value,
                description: document.getElementById('formProjectDescription').value,
                tech_stack: techStack,
                live_url: document.getElementById('formProjectLiveUrl').value,
                repo_url: document.getElementById('formProjectRepoUrl').value,
            };

            const url = editId ? `/api/admin/projects/${editId}` : '/api/admin/projects';
            const method = editId ? 'PUT' : 'POST';

            try {
                const res = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${adminToken}`
                    },
                    body: JSON.stringify(payload)
                });
                if (res.ok) {
                    showToast(editId ? 'Project updated' : 'Project created');
                    closeModal('adminProjectModal');
                    fetchAllData().then(() => renderAdminProjects());
                    playChime(700);
                } else {
                    showToast('Failed to save project');
                }
            } catch(e) {
                showToast('API request failed');
            }
        }

        async function deleteAdminProject(id) {
            if (!confirm('Are you sure you want to delete this project?')) return;
            try {
                const res = await fetch(`/api/admin/projects/${id}`, {
                    method: 'DELETE',
                    headers: { 'Authorization': `Bearer ${adminToken}` }
                });
                if (res.ok) {
                    showToast('Project deleted');
                    fetchAllData().then(() => renderAdminProjects());
                }
            } catch(e) {}
        }

        function renderAdminRoadmap() {
            const list = document.getElementById('adminRoadmapList');
            if (!list) return;
            list.innerHTML = tasksData.map(t => `
                <div style="background: var(--win-surface); border: 1px solid var(--border-color); border-radius: 8px; padding: 10px 14px; display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <span style="font-size: 13px;">${t.title}</span>
                        <span class="task-status-pill task-status-${t.status}" style="margin-left: 8px;">${t.status}</span>
                    </div>
                    <button class="btn-mini-admin" onclick="deleteAdminTask(${t.id})" style="color: #ef4444;">Delete</button>
                </div>
            `).join('');
        }

        async function deleteAdminTask(id) {
            try {
                const res = await fetch(`/api/admin/tasks/${id}`, {
                    method: 'DELETE',
                    headers: { 'Authorization': `Bearer ${adminToken}` }
                });
                if (res.ok) {
                    showToast('Task removed');
                    fetchAllData().then(() => renderAdminRoadmap());
                }
            } catch(e) {}
        }

        async function fetchAdminInbox() {
            try {
                const res = await fetch('/api/admin/messages', {
                    headers: { 'Authorization': `Bearer ${adminToken}` }
                });
                if (res.ok) {
                    const messages = await res.json();
                    const list = document.getElementById('adminInboxList');
                    if (!list) return;
                    if (messages.length === 0) {
                        list.innerHTML = '<div style="color: var(--text-muted); font-size: 12px;">No incoming messages.</div>';
                        return;
                    }
                    list.innerHTML = messages.map(m => `
                        <div style="background: var(--win-surface); border: 1px solid var(--border-color); border-radius: 8px; padding: 12px; display: flex; flex-direction: column; gap: 6px;">
                            <div style="display: flex; justify-content: space-between; font-size: 12px;">
                                <b>${m.name}</b> (${m.email})
                                <button class="btn-mini-admin" onclick="deleteAdminMessage(${m.id})" style="color: #ef4444;">Delete</button>
                            </div>
                            <div style="font-size: 12px; color: var(--text-muted);">${m.message}</div>
                        </div>
                    `).join('');
                }
            } catch(e) {}
        }

        async function deleteAdminMessage(id) {
            try {
                const res = await fetch(`/api/admin/messages/${id}`, {
                    method: 'DELETE',
                    headers: { 'Authorization': `Bearer ${adminToken}` }
                });
                if (res.ok) {
                    showToast('Message deleted');
                    fetchAdminInbox();
                }
            } catch(e) {}
        }

        async function handleSaveProfile(e) {
            e.preventDefault();
            const payload = {
                headline: document.getElementById('adminProfileHeadline').value,
                bio_p1: document.getElementById('adminProfileBio1').value,
                bio_p2: document.getElementById('adminProfileBio2').value,
            };
            try {
                const res = await fetch('/api/admin/profile', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${adminToken}`
                    },
                    body: JSON.stringify(payload)
                });
                if (res.ok) {
                    showToast('Profile updated');
                    fetchAllData();
                }
            } catch(e) {}
        }

        // ==========================================
        // SPOTLIGHT SEARCH (CMD+K / CTRL+K)
        // ==========================================
        function toggleSpotlight() {
            const overlay = document.getElementById('spotlightOverlay');
            overlay.classList.toggle('is-open');
            if (overlay.classList.contains('is-open')) {
                document.getElementById('spotlightQuery').value = '';
                handleSpotlightInput('');
                document.getElementById('spotlightQuery').focus();
                playChime(620);
            }
        }

        document.addEventListener('keydown', (e) => {
            if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
                e.preventDefault();
                toggleSpotlight();
            }
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal-overlay').forEach(m => m.classList.remove('is-open'));
                document.getElementById('spotlightOverlay').classList.remove('is-open');
            }
        });

        function handleSpotlightInput(query) {
            const resultsBox = document.getElementById('spotlightResults');
            const q = query.toLowerCase();

            const appMatches = [
                { title: 'Projects Finder', desc: 'Browse live software platforms', win: 'projectsWin' },
                { title: 'Terminal (CLI)', desc: 'Interactive developer console', win: 'terminalWin' },
                { title: 'Roadmap & Tasks', desc: 'Sprint board and milestones', win: 'todoWin' },
                { title: 'Skills & Capabilities', desc: 'Tech stack matrix', win: 'skillsWin' },
                { title: 'About Jovan', desc: 'Systems engineering overview', win: 'aboutWin' },
                { title: 'Contact Messenger', desc: 'Direct inquiry form', win: 'contactWin' },
                { title: 'Admin Control Center', desc: 'CMS & database manager', win: 'adminWin' },
            ].filter(a => a.title.toLowerCase().includes(q) || a.desc.toLowerCase().includes(q));

            const projMatches = projectsData.filter(p => 
                p.title.toLowerCase().includes(q) || (p.summary && p.summary.toLowerCase().includes(q))
            );

            let html = '';
            appMatches.forEach(a => {
                html += `
                    <div class="spotlight-item" onclick="toggleWindow('${a.win}'); toggleSpotlight();">
                        <div>
                            <b>${a.title}</b>
                            <div style="font-size: 11px; color: var(--text-muted);">${a.desc}</div>
                        </div>
                        <span style="font-family: var(--font-mono); font-size: 10px; color: var(--accent-color);">APP</span>
                    </div>
                `;
            });

            projMatches.forEach(p => {
                html += `
                    <div class="spotlight-item" onclick="openProjectModal(${p.id}); toggleSpotlight();">
                        <div>
                            <b>${p.title}</b>
                            <div style="font-size: 11px; color: var(--text-muted);">${p.summary}</div>
                        </div>
                        <span style="font-family: var(--font-mono); font-size: 10px; color: #10b981;">PROJECT</span>
                    </div>
                `;
            });

            if (!html) {
                html = '<div style="padding: 16px; text-align: center; color: var(--text-muted); font-size: 12px;">No matching results</div>';
            }

            resultsBox.innerHTML = html;
        }

        // Initialize on load
        window.addEventListener('DOMContentLoaded', () => {
            fetchAllData();
            checkAdminSession();
            renderCalendar();
            initDesktopIcons();
            initFluidSystem();
            if (window.innerWidth > 768) {
                setTimeout(() => toggleWindow('projectsWin'), 300);
            }
        });
    
        // ==========================================
        // FLUID PARTICLE MOUSE INTERACTIVE ENGINE
        // ==========================================
        const fluidCanvas = document.getElementById('fluidCanvas');
        const fCtx = fluidCanvas ? fluidCanvas.getContext('2d') : null;
        let particles = [];
        let mouseX = window.innerWidth / 2;
        let mouseY = window.innerHeight / 2;
        let isMouseMoving = false;
        let mouseTimer = null;

        class FluidParticle {
            constructor(x, y) {
                this.x = x || Math.random() * window.innerWidth;
                this.y = y || Math.random() * window.innerHeight;
                this.vx = (Math.random() - 0.5) * 1.5;
                this.vy = (Math.random() - 0.5) * 1.5;
                this.size = Math.random() * 2.5 + 1.2;
                this.baseAlpha = Math.random() * 0.45 + 0.15;
                this.color = Math.random() > 0.6 ? '#3b82f6' : (Math.random() > 0.5 ? '#10b981' : '#f97316');
            }

            update() {
                // Jarak ke kursor mouse
                const dx = mouseX - this.x;
                const dy = mouseY - this.y;
                const dist = Math.hypot(dx, dy);

                if (dist < 160) {
                    // Gaya dorong fluid interaktif saat mouse mendekat
                    const force = (160 - dist) / 160;
                    const angle = Math.atan2(dy, dx);
                    this.vx -= Math.cos(angle) * force * 1.2;
                    this.vy -= Math.sin(angle) * force * 1.2;
                }

                this.x += this.vx;
                this.y += this.vy;

                // Friction damping
                this.vx *= 0.96;
                this.vy *= 0.96;

                // Batas layar bouncing
                if (this.x < 0) this.x = window.innerWidth;
                if (this.x > window.innerWidth) this.x = 0;
                if (this.y < 0) this.y = window.innerHeight;
                if (this.y > window.innerHeight) this.y = 0;
            }

            draw() {
                if (!fCtx) return;
                fCtx.fillStyle = this.color;
                fCtx.globalAlpha = this.baseAlpha;
                fCtx.beginPath();
                fCtx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                fCtx.fill();
            }
        }

        function initFluidSystem() {
            if (!fluidCanvas || !fCtx) return;
            fluidCanvas.width = window.innerWidth;
            fluidCanvas.height = window.innerHeight;
            particles = [];
            const count = Math.min(85, Math.floor(window.innerWidth / 16));
            for (let i = 0; i < count; i++) {
                particles.push(new FluidParticle());
            }
        }

        function animateFluid() {
            if (document.body.getAttribute('data-wallpaper') === 'fluid' && fCtx) {
                fCtx.clearRect(0, 0, fluidCanvas.width, fluidCanvas.height);

                // Garis koneksi antar partikel (Fluid mesh)
                for (let i = 0; i < particles.length; i++) {
                    particles[i].update();
                    particles[i].draw();

                    for (let j = i + 1; j < particles.length; j++) {
                        const dx = particles[i].x - particles[j].x;
                        const dy = particles[i].y - particles[j].y;
                        const dist = Math.hypot(dx, dy);
                        if (dist < 90) {
                            fCtx.strokeStyle = 'rgba(59, 130, 246, ' + (0.18 * (1 - dist / 90)) + ')';
                            fCtx.lineWidth = 0.8;
                            fCtx.beginPath();
                            fCtx.moveTo(particles[i].x, particles[i].y);
                            fCtx.lineTo(particles[j].x, particles[j].y);
                            fCtx.stroke();
                        }
                    }
                }
            }
            requestAnimationFrame(animateFluid);
        }

        window.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
            // Spawn splash particle ringan saat gerak cepat
            if (document.body.getAttribute('data-wallpaper') === 'fluid' && Math.random() > 0.8 && particles.length < 110) {
                const splash = new FluidParticle(mouseX + (Math.random() - 0.5) * 10, mouseY + (Math.random() - 0.5) * 10);
                splash.vx = (Math.random() - 0.5) * 3;
                splash.vy = (Math.random() - 0.5) * 3;
                particles.push(splash);
                if (particles.length > 100) particles.shift();
            }
        });

        window.addEventListener('resize', () => {
            if (fluidCanvas) {
                fluidCanvas.width = window.innerWidth;
                fluidCanvas.height = window.innerHeight;
            }
        });

        initFluidSystem();
        requestAnimationFrame(animateFluid);

    </script>
</body>
</html>
