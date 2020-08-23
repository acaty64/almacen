<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('facultad_id');
            $table->integer('sede_id');
            $table->integer('tdoc_id');
            $table->string('numero', 120);
            $table->string('descripcion', 255);
            $table->integer('new_doc_id')->nullable();
            $table->integer('old_doc_id')->nullable();
            $table->integer('status_id');
            $table->string('attach', 255)->nullable();
            $table->string('filename', 255)->nullable();
            $table->string('file_id', 255)->nullable();
            $table->datetime('fecha');
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
        Schema::dropIfExists('docs');
    }
}
