<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('document_states', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs("causer");
            $table->nullableMorphs("document");
            $table->smallInteger("state")->default(0)->comment("0=saved; 1=submitted; 2=cancelled;");
            $table->text("properties")->nullable();
            $table->boolean("active");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('document_states');
    }
};
