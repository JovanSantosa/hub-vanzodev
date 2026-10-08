<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profile_settings', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('role');
            $table->string('headline')->nullable();
            $table->text('bio_p1')->nullable();
            $table->text('bio_p2')->nullable();
            $table->string('email')->nullable();
            $table->string('github_url')->nullable();
            $table->string('location')->nullable();
            $table->string('status_text')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_settings');
    }
};
