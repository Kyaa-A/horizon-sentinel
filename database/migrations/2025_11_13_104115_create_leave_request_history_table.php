<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leave_request_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leave_request_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->enum('action', [
                'submitted',
                'approved',
                'denied',
                'cancelled',
                'updated',
            ]);
            $table->foreignId('performed_by_user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->text('notes')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index('leave_request_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_request_history');
    }
};
