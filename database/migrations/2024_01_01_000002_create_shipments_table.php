<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_number')->unique();
            $table->string('sender_name');
            $table->text('sender_address');
            $table->string('sender_phone')->nullable();
            $table->string('receiver_name');
            $table->text('receiver_address');
            $table->string('receiver_phone')->nullable();
            $table->string('description')->nullable();
            $table->decimal('weight', 8, 2)->default(0); // kg
            $table->string('origin_city');
            $table->string('destination_city');
            $table->enum('status', ['pending', 'picked_up', 'in_transit', 'out_for_delivery', 'delivered', 'failed', 'returned'])
                  ->default('pending');
            $table->date('estimated_delivery')->nullable();
            $table->timestamp('actual_delivery')->nullable();
            $table->text('notes')->nullable();
            $table->decimal('shipping_cost', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
