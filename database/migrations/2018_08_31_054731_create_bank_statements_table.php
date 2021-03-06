<?php

/*
 * This file is part of the Sulaeman Bank Statements package.
 *
 * (c) Sulaeman <me@sulaeman.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_statements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bank_account_id')->unsigned();
            $table->string('unique_id', 50)->unique();
            $table->date('transaction_date')->nullable();
            $table->text('description');
            $table->string('type');
            $table->decimal('amount', 30, 20);
            $table->timestamp('created_at')->nullable();
            
            $table->index(['bank_account_id']);
            $table->index(['unique_id']);
            $table->index(['bank_account_id', 'amount']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_statements');
    }
}
