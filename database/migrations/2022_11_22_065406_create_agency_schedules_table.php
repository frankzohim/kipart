<?php

use App\Models\Agency;
use App\Models\Schedule;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agency_schedules', function (Blueprint $table) {
            $table->foreignIdFor(Agency::class)
            ->constrained()
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

        $table->foreignIdFor(Schedule::class)
            ->constrained()
            ->cascadeOnUpdate()
            ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agency_schedules');
    }
};
