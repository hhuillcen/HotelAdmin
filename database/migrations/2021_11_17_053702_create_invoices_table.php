<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->enum('status', ['PENDIENTE', 'COMPLETADO'])->default('PENDIENTE');
            $table->text('description')->nullable();
            $table->decimal('price', 6, 2)->default(0);
            $table->dateTime('entry_time');
            $table->dateTime('exit_time');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
