<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')
                ->nullable();
            $table->text('first_name')
                ->nullable();
            $table->text('last_name')
                ->nullable();
            $table->text('email')
                ->nullable();
            $table->text('sponsor_by')
                ->nullable();
            $table->text('merit_of')
                ->nullable();
            $table->text('show_on_app')
                ->nullable();
            $table->timestamp('completed_at')
                ->nullable();
            $table->longText('payment_vendor_response')
                ->nullable();
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
        Schema::dropIfExists('purchase_attempts');
    }
}
