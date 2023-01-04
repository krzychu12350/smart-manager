<?php

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
        Schema::create('company_position', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('company_id')
                ->constrained('companies')
                ->cascadeOnUpdate('cascade')
                ->cascadeOnDelete('cascade');
            $table->foreignId('position_id')
                ->constrained('positions')
                ->cascadeOnUpdate('cascade')
                ->cascadeOnDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_position');
    }
};
