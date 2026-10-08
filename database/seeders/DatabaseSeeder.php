<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use App\Models\Skill;
use App\Models\ProfileSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin User
        User::updateOrCreate(
            ['email' => 'admin@vanzodev.my.id'],
            [
                'name' => 'Jovan (VanzoDev)',
                'password' => Hash::make('VanzoDev#Secure2026!'),
            ]
        );

        // 2. Profile Settings
        ProfileSetting::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Jovan (VanzoDev)',
                'role' => 'Full-Stack & Systems Engineer',
                'headline' => 'Engineering with intent.',
                'bio_p1' => 'I am Jovan (VanzoDev), a software engineer with deep interest in resilient web systems, API design, and modern minimalist interfaces.',
                'bio_p2' => 'My core toolkit includes Next.js, React, Laravel, TypeScript, Tailwind CSS, and Linux VPS environments. I prioritize performance, clarity of architecture, and clean user experience.',
                'email' => 'jovansantosa08@gmail.com',
                'github_url' => 'https://github.com/JovanSantosa',
                'location' => 'Taichung, Taiwan / Indonesia',
                'status_text' => 'Online & Available for select engineering contracts',
            ]
        );

        // 3. Projects
        $projects = [
            [
                'title' => 'Yuni Counter V2',
                'slug' => 'yuni-counter-v2',
                'category' => 'Production App',
                'badge' => 'TAIWAN PRODUCTION',
                'summary' => 'Full-stack platform deployed in Taichung, Taiwan. Custom inventory & transaction system.',
                'description' => 'Full-stack platform in Taichung, Taiwan. Powered by Next.js 15, Laravel 11 API, MySQL. Optimized with dual cache layers, image pipeline intervention v4, and automated GitHub Actions CI/CD runner.',
                'tech_stack' => ['Next.js 15', 'Laravel 11', 'MySQL 8.0', 'TypeScript', 'Tailwind CSS', 'SWR'],
                'live_url' => 'https://yuni.vanzodev.my.id',
                'endpoint' => 'https://yuni.vanzodev.my.id',
                'env_badge' => 'Production',
                'order' => 1,
                'is_featured' => true,
            ],
            [
                'title' => 'Pulse Telemetry',
                'slug' => 'pulse-telemetry',
                'category' => 'Infrastructure Daemon',
                'badge' => 'REALTIME SSE',
                'summary' => 'Ultra-lightweight realtime SSE infrastructure & stack monitor on VPS.',
                'description' => 'Ultra-lightweight realtime Server-Sent Events daemon reporting memory pressure, swap usage, CPU load, and service statuses for 1GB RAM Ubuntu 22.04 node. Sub-millisecond polling without MySQL lockups.',
                'tech_stack' => ['Node.js', 'SSE', 'PM2', 'Linux Sysfs', 'Nginx Stream'],
                'live_url' => 'https://pulse.vanzodev.my.id',
                'endpoint' => 'https://pulse.vanzodev.my.id',
                'env_badge' => 'Production Daemon',
                'order' => 2,
                'is_featured' => true,
            ],
            [
                'title' => 'Kharisma AC Kwitansi',
                'slug' => 'kharisma-ac-kwitansi',
                'category' => 'Enterprise Accounting',
                'badge' => 'BUSINESS SUITE',
                'summary' => 'Digital receipts, multi-address customers, PDF & WhatsApp billing system.',
                'description' => 'Multi-branch enterprise billing platform for AC service management. Automated PDF invoice generation, WhatsApp Business notification integration, and robust customer ledger.',
                'tech_stack' => ['Laravel 11', 'Blade', 'Tailwind CSS', 'MySQL 8.0', 'DomPDF', 'WhatsApp API'],
                'live_url' => 'https://kharisma.vanzodev.my.id',
                'endpoint' => 'https://kharisma.vanzodev.my.id',
                'env_badge' => 'Production App',
                'order' => 3,
                'is_featured' => true,
            ],
            [
                'title' => 'VanzoDev Hub Gateway',
                'slug' => 'vanzodev-hub',
                'category' => 'OS Architecture',
                'badge' => 'ACTIVE PORTAL',
                'summary' => 'Minimalist desktop OS portal with Nginx reverse proxy architecture.',
                'description' => 'Interactive Web Desktop OS built with modern Raycast obsidian aesthetic, window manager, CLI terminal simulator, and adaptive mobile experience.',
                'tech_stack' => ['Laravel 11', 'SQLite', 'Sanctum', 'Tailwind CSS', 'Nginx'],
                'live_url' => 'https://portofolio.vanzodev.my.id',
                'endpoint' => 'https://portofolio.vanzodev.my.id',
                'env_badge' => 'Production',
                'order' => 4,
                'is_featured' => true,
            ],
            [
                'title' => 'Laboratory & AI Agent Pipeline',
                'slug' => 'lab-agent-pipeline',
                'category' => 'Experimental Lab',
                'badge' => 'EXPERIMENTAL',
                'summary' => 'Autonomous multi-agent orchestration, Hermes CLI agent runners, and LLM automation tools.',
                'description' => 'Advanced autonomous agent infrastructure experimenting with headless Chrome CDP automation, continuous learning protocols, and automated VPS sysadmin task pipelines.',
                'tech_stack' => ['Python', 'Hermes Agent', 'CDP', 'FastAPI', 'SQLite'],
                'live_url' => null,
                'endpoint' => 'Local Subsystem',
                'env_badge' => 'Lab Research',
                'order' => 5,
                'is_featured' => false,
            ],
        ];

        foreach ($projects as $proj) {
            Project::updateOrCreate(['slug' => $proj['slug']], $proj);
        }

        // 4. Tasks (Public Roadmap & Jovan's Private Queue)
        $tasks = [
            // Public Fun / Milestones
            [
                'title' => 'Deploy Yuni Counter V2 to live VPS',
                'status' => 'completed',
                'priority' => 'high',
                'target_quarter' => 'Q4 2026',
                'is_private' => false,
                'order' => 1,
            ],
            [
                'title' => 'Configure multi-subdomain SSL via Certbot',
                'status' => 'completed',
                'priority' => 'high',
                'target_quarter' => 'Q4 2026',
                'is_private' => false,
                'order' => 2,
            ],
            [
                'title' => 'Build minimalist desktop hub portfolio with Raycast aesthetic',
                'status' => 'completed',
                'priority' => 'medium',
                'target_quarter' => 'Q4 2026',
                'is_private' => false,
                'order' => 3,
            ],
            [
                'title' => 'Design next laboratory microservice prototype',
                'status' => 'in_progress',
                'priority' => 'medium',
                'target_quarter' => 'Q4 2026',
                'is_private' => false,
                'order' => 4,
            ],
            [
                'title' => 'Realtime SSE infrastructure telemetry monitor',
                'status' => 'completed',
                'priority' => 'high',
                'target_quarter' => 'Q4 2026',
                'is_private' => false,
                'order' => 5,
            ],

            // Jovan's Private Work Queue (Visible only after Admin Login)
            [
                'title' => 'Audit and rotate database secrets & SSH key backups',
                'status' => 'in_progress',
                'priority' => 'high',
                'target_quarter' => 'Q4 2026',
                'is_private' => true,
                'order' => 10,
            ],
            [
                'title' => 'Finish client invoicing module for Kharisma AC Kwitansi',
                'status' => 'in_progress',
                'priority' => 'high',
                'target_quarter' => 'Q4 2026',
                'is_private' => true,
                'order' => 11,
            ],
            [
                'title' => 'Fine-tune SQLite WAL mode & PRAGMA cache size on Ubuntu VPS',
                'status' => 'completed',
                'priority' => 'medium',
                'target_quarter' => 'Q4 2026',
                'is_private' => true,
                'order' => 12,
            ],
            [
                'title' => 'Develop Discord Bot remote sysadmin agent for VPS ops',
                'status' => 'pending',
                'priority' => 'high',
                'target_quarter' => 'Q4 2026',
                'is_private' => true,
                'order' => 13,
            ],
            [
                'title' => 'Review Taichung store POS transaction logs & latency',
                'status' => 'pending',
                'priority' => 'medium',
                'target_quarter' => 'Q4 2026',
                'is_private' => true,
                'order' => 14,
            ],
        ];

        foreach ($tasks as $task) {
            Task::updateOrCreate(['title' => $task['title']], $task);
        }

        // 5. Skills
        $skills = [
            // Frontend
            ['category' => 'Frontend Engineering', 'name' => 'Next.js 15 (App Router)', 'level' => 'Expert', 'icon' => 'layout', 'order' => 1],
            ['category' => 'Frontend Engineering', 'name' => 'React 19', 'level' => 'Expert', 'icon' => 'code', 'order' => 2],
            ['category' => 'Frontend Engineering', 'name' => 'TypeScript', 'level' => 'Advanced', 'icon' => 'file-code', 'order' => 3],
            ['category' => 'Frontend Engineering', 'name' => 'Tailwind CSS', 'level' => 'Expert', 'icon' => 'palette', 'order' => 4],
            ['category' => 'Frontend Engineering', 'name' => 'Framer Motion', 'level' => 'Proficient', 'icon' => 'activity', 'order' => 5],
            // Backend
            ['category' => 'Backend & APIs', 'name' => 'Laravel 11 / PHP 8.3', 'level' => 'Expert', 'icon' => 'server', 'order' => 6],
            ['category' => 'Backend & APIs', 'name' => 'RESTful API Design', 'level' => 'Expert', 'icon' => 'cpu', 'order' => 7],
            ['category' => 'Backend & APIs', 'name' => 'Sanctum Authentication', 'level' => 'Advanced', 'icon' => 'shield', 'order' => 8],
            ['category' => 'Backend & APIs', 'name' => 'MySQL & SQLite', 'level' => 'Expert', 'icon' => 'database', 'order' => 9],
            ['category' => 'Backend & APIs', 'name' => 'Node.js APIs', 'level' => 'Advanced', 'icon' => 'terminal', 'order' => 10],
            // DevOps
            ['category' => 'Infrastructure & DevOps', 'name' => 'Linux (Ubuntu 22.04)', 'level' => 'Advanced', 'icon' => 'hard-drive', 'order' => 11],
            ['category' => 'Infrastructure & DevOps', 'name' => 'Nginx Reverse Proxy', 'level' => 'Expert', 'icon' => 'git-branch', 'order' => 12],
            ['category' => 'Infrastructure & DevOps', 'name' => 'PM2 Process Manager', 'level' => 'Expert', 'icon' => 'zap', 'order' => 13],
            ['category' => 'Infrastructure & DevOps', 'name' => 'GitHub Actions CI/CD', 'level' => 'Advanced', 'icon' => 'check-circle', 'order' => 14],
            ['category' => 'Infrastructure & DevOps', 'name' => 'SSL / Certbot', 'level' => 'Expert', 'icon' => 'lock', 'order' => 15],
            ['category' => 'Infrastructure & DevOps', 'name' => 'VPS Performance Tuning', 'level' => 'Advanced', 'icon' => 'sliders', 'order' => 16],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(
                ['name' => $skill['name'], 'category' => $skill['category']],
                $skill
            );
        }
    }
}
