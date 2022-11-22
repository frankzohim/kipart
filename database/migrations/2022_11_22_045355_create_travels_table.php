<?php

use App\Models\Agency;
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
        Schema::create('travels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->string('departure');
            $table->string('arrival');

            $table->foreignIdFor(Agency::class)
            ->constrained()
            ->restrictOnUpdate()
            ->restrictOnDelete();

            $table->string('class');
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
        Schema::dropIfExists('travels');
    }
};
