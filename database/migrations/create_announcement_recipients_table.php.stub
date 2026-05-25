<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcement_recipients', function (Blueprint $table) {
            $table->id();

            $table->foreignId('announcement_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->morphs('recipient');
            $table->timestamp('dismissed_at')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('announcement_recipients');
    }
};
