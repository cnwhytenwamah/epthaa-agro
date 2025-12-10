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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->nullable()->after('name');
            $table->string('phone_number')->nullable()->after('email');
            $table->string('avatar')->nullable()->after('phone_number'); 
            $table->text('bio')->nullable()->after('avatar');
            $table->date('date_of_birth')->nullable()->after('bio');
            $table->string('address')->nullable()->after('date_of_birth');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'username',
                'phone_number',
                'avatar',
                'bio',
                'date_of_birth',
                'address',
            ]);
        });
    }
};
