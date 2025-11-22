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
        Schema::create('aging_a_r_progress', function (Blueprint $table) {
            $table->id();
            $table->string('account_name', 75);
            $table->string('project_name', 50);
            $table->string('proforma_number', 50);
            $table->string("branch",50);
            $table->string("period",10);
            $table->string("invoice_number", 50);
            $table->date("invoice_date");
            $table->text("invoice_notes");
            $table->date("due_date");
            $table->integer("invoice_amount");
            $table->integer("vat");
            $table->integer("pph");
            $table->integer("outstanding");
            $table->foreignId('category_id')->constrained('categories','id')->onUpdate('cascade');
            $table->timestamp('created_date');
            $table->integer('created_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aging_a_r_progress');
    }
};
