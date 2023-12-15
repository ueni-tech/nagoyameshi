<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('number_of_people_in_reservations', function (Blueprint $table) {
            DB::statement('ALTER TABLE reservations CHANGE number_of_peoole number_of_people INTEGER');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('number_of_people_in_reservations', function (Blueprint $table) {
            DB::statement('ALTER TABLE reservations CHANGE number_of_people number_of_peoole INTEGER');
        });
    }
};
