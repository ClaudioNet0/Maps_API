<?php

namespace Model;

class ImovelInfo{
    private $id;
    private $id_cidade;
    private $id_tipo_imovel;
    private $id_negocio_tipo;
    private $endereco;
    private $bairro;
    private $foto_exibicao;
    private $foto_grande;
    private $valor;
    private $titulo_imovel;
    private $msg;
    private $novo;
    private $destaque;
    private $ativo;
    private $longitude;
    private $latitude;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdCidade()
    {
        return $this->id_cidade;
    }

    /**
     * @param mixed $id_cidade
     */
    public function setIdCidade($id_cidade)
    {
        $this->id_cidade = $id_cidade;
    }

    /**
     * @return mixed
     */
    public function getIdTipoImovel()
    {
        return $this->id_tipo_imovel;
    }

    /**
     * @param mixed $id_tipo_imovel
     */
    public function setIdTipoImovel($id_tipo_imovel)
    {
        $this->id_tipo_imovel = $id_tipo_imovel;
    }

    /**
     * @return mixed
     */
    public function getIdNegocioTipo()
    {
        return $this->id_negocio_tipo;
    }

    /**
     * @param mixed $id_negocio_tipo
     */
    public function setIdNegocioTipo($id_negocio_tipo)
    {
        $this->id_negocio_tipo = $id_negocio_tipo;
    }

    /**
     * @return mixed
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @param mixed $endereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    /**
     * @return mixed
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * @param mixed $bairro
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    /**
     * @return mixed
     */
    public function getFotoExibicao()
    {
        return $this->foto_exibicao;
    }

    /**
     * @param mixed $foto_exibicao
     */
    public function setFotoExibicao($foto_exibicao)
    {
        $this->foto_exibicao = $foto_exibicao;
    }

    /**
     * @return mixed
     */
    public function getFotoGrande()
    {
        return $this->foto_grande;
    }

    /**
     * @param mixed $foto_grande
     */
    public function setFotoGrande($foto_grande)
    {
        $this->foto_grande = $foto_grande;
    }

    /**
     * @return mixed
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param mixed $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    /**
     * @return mixed
     */
    public function getTituloImovel()
    {
        return $this->titulo_imovel;
    }

    /**
     * @param mixed $titulo_imovel
     */
    public function setTituloImovel($titulo_imovel)
    {
        $this->titulo_imovel = $titulo_imovel;
    }

    /**
     * @return mixed
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @param mixed $msg
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;
    }

    /**
     * @return mixed
     */
    public function getNovo()
    {
        return $this->novo;
    }

    /**
     * @param mixed $novo
     */
    public function setNovo($novo)
    {
        $this->novo = $novo;
    }

    /**
     * @return mixed
     */
    public function getDestaque()
    {
        return $this->destaque;
    }

    /**
     * @param mixed $destaque
     */
    public function setDestaque($destaque)
    {
        $this->destaque = $destaque;
    }

    /**
     * @return mixed
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param mixed $ativo
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

}
