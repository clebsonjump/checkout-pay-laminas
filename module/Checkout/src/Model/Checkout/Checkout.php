<?php
namespace Checkout\Model\Checkout;

class Checkout
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $id_produto;

    /**
     * @var string
     */
    private $titulo;

    /**
     * @var string
     */
    private $descricao;

    /**
    * @var string
    */
    public $imagem;

        /**
    * @var string
    */
    private $valor;

    /**
    * @var string
    */
    public $item_aprendizado;

    /**
     * @param int|null $id
     * @param int|null $id_produto
     * @param string $titulo
     * @param string $descricao
     * @param string $imagem
     * @param string $valor
     * @param string $item_aprendizado
     */

    public function __construct($id = null, $id_produto, $titulo, $descricao, $imagem, $valor, $item_aprendizado)
    {
        $this->id = $id;
        $this->id_produto = $id_produto;
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->imagem = $imagem;
        $this->valor = $valor;
        $this->item_aprendizado = $item_aprendizado;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

     /**
     * @return int|null
     */
    public function getIdProduto()
    {
        return $this->id_produto;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @return string
     */
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
    * @return string
    */
    public function getitemAprendizado()
    {
        return $this->item_aprendizado;
    }
}