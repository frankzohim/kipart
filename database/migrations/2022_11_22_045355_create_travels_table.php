<?php

use App\Models\Agency;
use App\Models\Bus;
use App\Models\Path;
use App\Models\Schedule;
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
        Schema::create('travel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('date');

            $table->foreignIdFor(Bus::class)
            ->constrained()
            ->restrictOnUpdate()
            ->restrictOnDelete();

            $table->foreignIdFor(Path::class)
                ->constrained()
                ->restrictOnUpdate()
                ->restrictOnDelete();

            $table->foreignIdFor(Schedule::class)
                ->constrained()
                ->restrictOnUpdate()
                ->restrictOnDelete();

            $table->double('price');
            $table->string('classe');
            $table->boolean('state');
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
        Schema::dropIfExists('travel');
    }
};
