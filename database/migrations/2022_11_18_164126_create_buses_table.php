<?php

use App\Models\Agency;
use App\Models\Travel;
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
        Schema::disableForeignKeyConstraints();
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('registration')->unique();
            $table->integer('number_of_places');
            $table->foreignIdFor(Agency::class)
                ->constrained()
                ->restrictOnUpdate()
                ->restrictOnUpdate();
            //$table->string('type');
            $table->string("plan");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buses');
    }
};
