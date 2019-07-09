<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Impresion de Ficha de Filiacion</title>
	<style type="text/css">
		table { vertical-align: top; }
		tr    { vertical-align: top; }
		td    { vertical-align: top; }
		.midnight-blue{
			background:#2c3e50;
			padding: 4px 4px 4px;
			color:white;
			font-weight:bold;
			font-size:12px;
		}
		.silver{
			background:white;
			padding: 3px 4px 3px;
		}
		.clouds{
			background:#ecf0f1;
			padding: 3px 4px 3px;
		}
		.border-top{
			border-top: solid 1px #bdc3c7;
			
		}
		.border-left{
			border-left: solid 1px #bdc3c7;
		}
		.border-right{
			border-right: solid 1px #bdc3c7;
		}
		.border-bottom{
			border-bottom: solid 1px #bdc3c7;
		}
		table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
	</style>
</head>
<body id="print">

    <table cellspacing="0" style="width: 100%;">
        <tr>

			<td style="width: 75%; color: #34495e;font-size:12px;text-align:center">
                <span style="color: #34495e;font-size:14px;font-weight:bold">{{$empresas[0]->ph_name}}</span>
               <!--  <br> {{$empresas[0]->ph_caracteristicas}} -->
            </td>
			
        </tr>
    </table>
    <br>
    <h3 style ="text-align: center">FICHA DE FILIACION</h3>

    <p><label for="" style="font-weight: bold">CATEGORIA : </label> IIE <label for=""  style="font-weight: bold">CODIGO RENIPRESS : </label> 0010475 <label for=""  style="font-weight: bold">Nª HISTORIA CLINICA : HC - {{$pacientes[0]->dni}}</label></p>
	<p><label for="" style="font-weight: bold">NOMBRES Y APELLIDOS DEL PACIENTE : </label> {{$pacientes[0]->nombres}} {{$pacientes[0]->apellido_paterno}} {{$pacientes[0]->apellido_materno}}</p>
	<p><label for="" style="font-weight: bold">EDAD : </label> {{$pacientes[0]->edad}} <label for=""  style="font-weight: bold">SEXO : </label> {{$pacientes[0]->sexo}} <label for=""  style="font-weight: bold">ESTADO CIVIL : {{$pacientes[0]->nombre_estado_civil}} <label for="" style="font-weight: bold">DNI : </label> {{$pacientes[0]->dni}}</label></p>

	<p><label for="" style="font-weight: bold">CARNET DE EXTRANJERIA : </label> {{$pacientes[0]->CarnetExtranjeria}}</p>

	<p><label for="" style="font-weight: bold">DOMICILIO ACTUAL : </label> {{$pacientes[0]->DomicilioActual}}</p>
	<p><label for="" style="font-weight: bold">DOMICILIO DE PROCEDENCIA : </label> {{$pacientes[0]->DomicilioProcedencia}}</p>
	<p><label for="" style="font-weight: bold">GRADO DE INSTRUCCION : </label> {{$pacientes[0]->GradoInstruccion}} <label for=""  style="font-weight: bold">TELEFONO FIJO: </label> {{$pacientes[0]->telefono}} <label for=""  style="font-weight: bold">TELEF.  CELULAR  {{$pacientes[0]->celular}}</label></p>
	<p><label for="" style="font-weight: bold">OCUPACION : </label> {{$pacientes[0]->Ocupacion}} <label for=""  style="font-weight: bold">RELIGION: </label> {{$pacientes[0]->Religion}}</p>
	
	<p><label for="" style="font-weight: bold">ACOMPAÑANTE : </label> {{$pacientes[0]->NombreAcompanante}}</p>
	<p><label for="" style="font-weight: bold">PARENTESCO : </label> {{$pacientes[0]->GradoParentesco}}</p>
    <p><label for="" style="font-weight: bold">DOMICILIO ACOMPAÑANTE : </label> {{$pacientes[0]->DomicilioAcompanante}}</p>
    

	<br>
</body>
</html>