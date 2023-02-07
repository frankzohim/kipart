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
        Schema::create('sub_agencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('localisation');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone');
            $table->foreignIdFor(Agency::class)
                    ->constrained()
                    ->restrictOnUpdate()
                    ->restrictOnDelete();
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
        Schema::dropIfExists('sub_agencies');
    }
};
