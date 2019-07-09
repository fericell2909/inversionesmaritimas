<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;

use Greenter\Model\Client\Client;
use Greenter\Model\Company\Company;
use Greenter\Model\Company\Address;
use Greenter\Model\Sale\Document;
use Greenter\Model\Sale\Invoice;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Model\Sale\Legend;
use Greenter\Ws\Services\SunatEndpoints;
use App\Util;
use App\Orders;

class FacturacionElectronica extends Model
{
	
	
	

    public static function GeneraFacturaElectronica()
    {

    }

    public static function GeneraBoletaElectronica()
    {

    }

    public static function GeneraDocumentoElectro($datos,$codigo_generado)
    {
    	


    	//$a = new Util(); Util::getInstance()

    	$client = new Client();
		$client->setTipoDoc('6')
		    ->setNumDoc($datos['cDnicRuc']) // 20000000001
		    ->setRznSocial($datos['cliente']);

		// Emisor
		$address = new Address();
		$address->setUbigueo(Util::$emisor_setUbigueo)
		    ->setDepartamento(Util::$emisor_setDepartamento)
		    ->setProvincia(Util::$emisor_setProvincia)
		    ->setDistrito(Util::$emisor_setDistrito)
		    ->setUrbanizacion(Util::$emisor_setUrbanizacion)
		    ->setDireccion(Util::$emisor_setDireccion);

		$company = new Company();
		$company->setRuc(Util::$emisor_setRuc)
		    ->setRazonSocial(Util::$emisor_setRazonSocial)
		    ->setNombreComercial(Util::$emisor_setNombreComercial)
		    ->setAddress($address);


    	$util =  Util::getInstance();
		
		// Venta
		$invoice = new Invoice();
		$invoice
		    ->setFecVencimiento(new DateTime())
		    ->setTipoDoc('01')
		    ->setSerie($datos['cliente_serie_id'])
		    ->setCorrelativo('4563')
		    ->setFechaEmision(new DateTime())
		    ->setTipoMoneda('PEN')
		    ->setGuias([
		        (new Document())
		        ->setTipoDoc('09')
		        ->setNroDoc('001-213')
		    ])
		    ->setClient($client)
		    ->setMtoOperGravadas(200)
		    ->setMtoOperExoneradas(0)
		    ->setMtoOperInafectas(0)
		    ->setMtoIGV(36)
		    ->setMtoImpVenta(2236.43)
		    ->setCompany($company);

		$item1 = new SaleDetail();
		$item1->setCodProducto('C023')
		    ->setUnidad('NIU')
		    ->setCantidad(2)
		    ->setDescripcion('PROD 1')
		    ->setDescuento(1)
		    ->setIgv(18)
		    ->setTipAfeIgv('10')
		    ->setMtoValorVenta(100)
		    ->setMtoValorUnitario(50)
		    ->setMtoPrecioUnitario(56);
		$item2 = new SaleDetail();
		$item2->setCodProducto('C02')
		    ->setCodProdSunat('P21')
		    ->setUnidad('NIU')
		    ->setCantidad(2)
		    ->setDescripcion('PROD 1')
		    ->setIgv(18)
		    ->setTipAfeIgv('10')
		    ->setMtoValorVenta(100)
		    ->setMtoValorUnitario(50)
		    ->setMtoPrecioUnitario(56);
		$legend = new Legend();
		$legend->setCode('1000')
		    ->setValue('SON CIEN CON 00/100 SOLES');

		$invoice->setDetails([$item1, $item2])
		    ->setLegends([$legend]);
		

		// Envio a SUNAT.
		

		if (Util::$modo_facturacion == 0) {
			$cadena =  SunatEndpoints::FE_BETA;
		} else {
			$cadena =  SunatEndpoints::FE_PRODUCCION;
		}

		$see = $util->getSee($cadena);
		


		$res = $see->send($invoice);

		$util->writeXml($invoice, $see->getFactory()->getLastXml());
		
		if ($res->isSuccess()) {
		    /**@var $res \Greenter\Model\Response\BillResult*/
		    $cdr = $res->getCdrResponse();
		    $util->writeCdr($invoice, $res->getCdrZip());
		    echo $util->getResponseFromCdr($cdr);
		} else {
		    var_dump($res->getError());
		}
    }


	public static function GeneraDocumentoElectronico($datos,$codigo_generado)
	{

		if (FacturacionElectronica::$modo_facturacion == 0) {
			$cadena =  SunatEndpoints::FE_BETA;
		} else {
			$cadena =  SunatEndpoints::FE_PRODUCCION;
		}
		

		$see = new \Greenter\See();

		$see->setService($cadena);

		$see->setCertificate(file_get_contents(FacturacionElectronica::$ruta_certificado));
		$see->setCredentials(FacturacionElectronica::$usuario_certificado, FacturacionElectronica::$pass_certificado);


		// Cliente
		$client = new Client();
		$client->setTipoDoc('6')
		    ->setNumDoc($datos['cDnicRuc']) // 20000000001
		    ->setRznSocial($datos['cliente']);

		// Emisor
		$address = new Address();
		$address->setUbigueo(FacturacionElectronica::$emisor_setUbigueo)
		    ->setDepartamento(FacturacionElectronica::$emisor_setDepartamento)
		    ->setProvincia(FacturacionElectronica::$emisor_setProvincia)
		    ->setDistrito(FacturacionElectronica::$emisor_setDistrito)
		    ->setUrbanizacion(FacturacionElectronica::$emisor_setUrbanizacion)
		    ->setDireccion(FacturacionElectronica::$emisor_setDireccion);

		$company = new Company();
		$company->setRuc(FacturacionElectronica::$emisor_setRuc)
		    ->setRazonSocial(FacturacionElectronica::$emisor_setRazonSocial)
		    ->setNombreComercial(FacturacionElectronica::$emisor_setNombreComercial)
		    ->setAddress($address);

		// Venta
		$invoice = (new Invoice())
		    ->setTipoDoc('01')
		    ->setSerie('F001')
		    ->setCorrelativo('2')
		    ->setFechaEmision(new DateTime())
		    ->setTipoMoneda('PEN')
		    ->setClient($client)
		    ->setMtoOperGravadas(200.00)
		    ->setMtoOperExoneradas(0.00)
		    ->setMtoOperInafectas(0.00)
		    ->setMtoIGV(36.00)
		    ->setMtoImpVenta(236.00)
		    ->setCompany($company);

		$item = (new SaleDetail())
		    ->setCodProducto('P001')
		    ->setUnidad('NIU')
		    ->setCantidad(2)
		    ->setDescripcion('PRODUCTO 1')
		    ->setIgv(18.00)
		    ->setTipAfeIgv('10')
		    ->setMtoValorVenta(100.00)
		    ->setMtoValorUnitario(50.00)
		    ->setMtoPrecioUnitario(56.00);

		$legend = (new Legend())
		    ->setCode('1000')
		    ->setValue('SON DOSCIENTOS TREINTA Y SEIS CON 00/100 SOLES');

		$invoice->setDetails([$item])
		        ->setLegends([$legend]);

		$result = $see->send($invoice);

		
		var_dump($result);

		// CODIGO DE HASH.


		// if ($result->isSuccess()) {
		//     return  $result->getCdrResponse()->getDescription();
		// } else {
		//     var_dump($result->getError());
		// }
	}

}
