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
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('status',['accepted', 'in progress', 'rejected']);
            $table->timestamps();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate('cascade')
                ->cascadeOnDelete('cascade');
            $table->foreignId('company_id')
                ->constrained('companies')
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
        Schema::dropIfExists('applications');
    }
};
