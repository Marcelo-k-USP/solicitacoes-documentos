<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArquivoSolicitacaoDocumentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arquivo_solicitacaodocumento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('arquivo_id')->constrained('arquivos')->onDelete('cascade');
            $table->foreignId('solicitacaodocumento_id')->constrained('solicitacoesdocumentos')->onDelete('cascade');

            $table->string('tipo', 100);
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
        Schema::dropIfExists('arquivo_solicitacaodocumento');
    }
}
