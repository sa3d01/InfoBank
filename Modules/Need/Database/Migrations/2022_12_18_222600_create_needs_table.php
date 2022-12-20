<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('needs', function (Blueprint $table) {
            $table->id();
            $table->string('client_id')->nullable();
            $table->string('client_name')->nullable();
            $table->string('client_phone')->nullable();
            $table->foreignId('place_id')->nullable()->constrained('places')->onDelete('cascade');
            $table->foreignId('training_id')->nullable()->constrained('trainings')->onDelete('cascade');
            $table->foreignId('title_training_id')->nullable()->constrained('trainings')->onDelete('cascade');
            $table->enum("status",['binding','cancelled','rejected','approved','completed'])->default("binding");
            $table->json("news")->nullable();
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
        Schema::dropIfExists('needs');
    }
};
