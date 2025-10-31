<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->string('id_transaksi', 20)->primary();
            $table->unsignedBigInteger('id_pasien');
            $table->unsignedBigInteger('id_psikolog');
            $table->integer('harga');
            $table->string('status')->default('Belum dibayar');
            $table->string('snap_token')->nullable();
            $table->timestamps();

            $table->foreign('id_pasien')->references('model_id')->on('model_has_roles')
                ->where('model_type', 'App\Models\User')
                ->whereIn('role_id', function ($query) {
                    $query->select('id')->from('roles')->where('name', 'user');
                })->onDelete('cascade');

            $table->foreign('id_psikolog')->references('model_id')->on('model_has_roles')
                ->where('model_type', 'App\Models\User')
                ->whereIn('role_id', function ($query) {
                    $query->select('id')->from('roles')->where('name', 'psikolog');
                })->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};