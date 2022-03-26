<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsParentChildTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments_parent_child', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->index();
            $table->unsignedBigInteger('child_id')->index();

            # ALL CHANGES THAT HAPPENS CASCADE TO THE RECORD
            $table->foreign('parent_id')->references('id')->on('comments')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('child_id') ->references('id')->on('comments')->onUpdate('cascade')->onDelete('cascade');
            
            # PREVENTS DUPLICATE ENTRY
            $table->unique(['parent_id', 'child_id']);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments_parent_child');
    }
}
