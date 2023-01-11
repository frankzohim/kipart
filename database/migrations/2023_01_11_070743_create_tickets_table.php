<?php

use App\Models\User;
use App\Models\Travel;
use App\Models\Passenger;
use App\Models\SubAgency;
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
        Schema::disableForeignKeyConstraints();
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                    ->constrained()
                    ->restrictOnUpdate()
                    ->restrictOnDelete();

            $table->foreignIdFor(SubAgency::class)
                    ->constrained()
                    ->restrictOnUpdate()
                    ->restrictOnDelete();

            $table->foreignIdFor(Travel::class)
                    ->constrained()
                    ->restrictOnUpdate()
                    ->restrictOnDelete();

            $table->foreignIdFor(Passenger::class)
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
        Schema::dropIfExists('tickets');
    }
};
