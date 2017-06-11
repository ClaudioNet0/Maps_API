<?php
namespace BLL;

use DAL\ImovelDAL;
use Model\ImovelInfo;
use stdClass;
class ImovelBLL{
    /**
     *@return ImovelInfo[]
     */
    public function  listarImoveisMapa(){
        $dal = new ImovelDAL();
        return $dal->listarImoveisMapa();
    }

    /**
     * @param ImovelInfo[] $imoveis
     * @return stdClass[]
     */
    public function listarMapaToJson($imoveis){
        $retorno = array();

        foreach ($imoveis as $imovel){
            if ($imovel->getLongitude() != "0" && $imovel->getLatitude() != "0" && !is_null($imovel->getLatitude()) && !is_null($imovel->getLongitude())) {
                $novoImovel = new stdClass();
                $novoImovel->id = $imovel->getId();
                $novoImovel->titulo = $imovel->getTituloImovel();
                $novoImovel->foto = $imovel->getFotoExibicao();
                $novoImovel->latitude = $imovel->getLatitude();
                $novoImovel->longitude = $imovel->getLongitude();
                $novoImovel->msg = $imovel->getMsg();
                $novoImovel->endereco = $imovel->getEndereco();
                $retorno[] = $novoImovel;
            }
        }
        return $retorno;
    }
}