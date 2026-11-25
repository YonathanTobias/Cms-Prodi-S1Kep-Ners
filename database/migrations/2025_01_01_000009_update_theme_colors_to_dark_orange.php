<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('settings')->updateOrInsert(
            ['key' => 'theme_primary_color'],
            ['value' => '#c2410c']
        );

        DB::table('settings')->updateOrInsert(
            ['key' => 'theme_secondary_color'],
            ['value' => '#9a3412']
        );

        Setting::clearCache();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('settings')->updateOrInsert(
            ['key' => 'theme_primary_color'],
            ['value' => '#0284c7']
        );

        DB::table('settings')->updateOrInsert(
            ['key' => 'theme_secondary_color'],
            ['value' => '#0369a1']
        );

        Setting::clearCache();
    }
};
