<?php

use App\Models\Duty;
use App\Models\Group;
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
        Schema::create('group_duties', function (Blueprint $table) {
            $table->foreignIdFor(Group::class)
            ->constrained()
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

        $table->foreignIdFor(Duty::class)
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
        Schema::dropIfExists('group_duties');
    }
};
