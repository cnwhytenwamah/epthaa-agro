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
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Relations
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->unsignedBigInteger('order_id')->nullable()->index();

            // Stripe identifiers
            $table->string('stripe_session_id')->nullable()->index();
            $table->string('stripe_payment_intent')->nullable()->index();
            $table->string('stripe_charge_id')->nullable()->index();

            // Amount & Currency
            $table->unsignedBigInteger('amount')->comment('amount in cents');
            $table->string('currency', 10)->default('usd');
            $table->string('status')->default('pending')->index();
            $table->json('metadata')->nullable();
            $table->longText('raw_event')->nullable();
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
