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
        Schema::table('settings', function (Blueprint $table) {
            $table->decimal('map_lat', 10, 8)->nullable()->after('tax');
            $table->decimal('map_lng', 11, 8)->nullable()->after('map_lat');
            $table->string('map_place_query', 255)->nullable()->after('map_lng')->comment('Nama tempat/alamat untuk pencarian peta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['map_lat', 'map_lng', 'map_place_query']);
        });
    }
};
