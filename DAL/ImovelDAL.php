<?php
namespace DAL;

use Model\ImovelInfo;


class ImovelDAL
{
    /**
     * @return string
     */
    public function query(){
        return "
            SELECT	imoveis.id,
                imoveis.id_cidade,
                imoveis.id_tipo_imovel,
                imoveis.id_negocio_tipo,
                imoveis.endereco,
                imoveis.bairro,
                imoveis.foto_exibicao,
                imoveis.foto_grande,
                imoveis.valor,
                imoveis.titulo_imovel,
                imoveis.msg,
                imoveis.novo,
                imoveis.destaque,
                imoveis.ativo,
                imoveis.longitude,
                imoveis.latitude
                FROM imoveis
        ";
    }

    /**
     * @return ImovelInfo[]
     */
    public function listarImoveisMapa(){
        $query = $this->query();
        $db = Cnn::getCnn()->prepare($query);
        $db->execute();
        return Cnn::getValue($db, "\\Model\\ImovelInfo");
    }
}