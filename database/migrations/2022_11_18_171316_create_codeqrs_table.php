<?php

use App\Models\Token;
use App\Models\Travel;
use App\Models\User;
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
        Schema::create('codeqrs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->index();

            $table->foreignIdFor(Token::class)
                ->constrained()
                ->restrictOnUpdate()
                ->restrictOnUpdate();

            $table->foreignIdFor(User::class)
                ->constrained()
                ->restrictOnUpdate()
                ->restrictOnUpdate();

            $table->foreignIdFor(Travel::class)
                ->constrained()
                ->restrictOnUpdate()
                ->restrictOnDelete();

            $table->boolean('isVerified');
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
        Schema::dropIfExists('codeqrs');
    }
};
