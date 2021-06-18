<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diarista extends Model
{
    use HasFactory;

    /**
     * Defini os campos que podem ser gravados
     *
     * @var array
     */
    protected $fillable = ['nome_completo', 'cpf', 'email', 'telefone', 'logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'cep', 'codigo_ibge', 'foto_usuario'];

    /**
     * define os campos que serao usados na serialização
     */


    protected $visible = ['nome_completo', 'cidade', 'foto_usuario', 'reputacao' ];

    /**
     * adiciona campos na reputacao
     *
     * @var array
     */
    protected $appends = ['reputacao'];

    /**
     * monta URL da imagem
     */

    public function getFotoUsuarioAttribute(string $valor )
    {

        return config('app.url') . '/' . $valor;
    }

    /**
     * retorna a reputacao rondonica
     *
     * @param [type] $valor
     * @return void
     */
    public function getReputacaoAttribute( $valor)
    {
        return mt_rand(1, 5);
    }

    /**
     * busca a diarista por codigo ibge
     */

    static public function buscaPorCodigoIbge( int $codigoIbge)
    {
        return self::where('codigo_ibge', $codigoIbge)->limit(6)->get();
    }

    /**
     * retorna a quantidade de diaristas
     */

    static public function quantidadePorCodigoIbge ( int $codigoIbge)
    {
        $quantidade =  self::where('codigo_ibge', $codigoIbge)->count();

        return $quantidade > 6 ? $quantidade - 6 : 0;
    }
}
