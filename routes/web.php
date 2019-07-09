<?php


Auth::routes();


Route::group(['middleware' => ['auth']], function () {

    // HistoriaClinica

    Route::get('HistoriaClinica/ListarHistoriaClinicaxPaciente', 'HistoriaClinicaController@ListarHistoriaClinicaxPaciente')->name('ListarHistoriaClinicaxPaciente');


    Route::get('HistoriaClinica/RegistrarHistoriaClinica', 'HistoriaClinicaController@create')->name('RegistrarHistoriaClinica');

    Route::post('HistoriaClinica/RegistrarHistoriaClinica', 'HistoriaClinicaController@guardar')->name('GuardarHistoriaClinica');    

    Route::post('CodigosCie/search', 'HistoriaClinicaController@searchcie10')->name('CodigosCie10search');

    Route::post('HistoriaClinica/HistoriasClinicasPaciente/search', 'HistoriaClinicaController@searchHistoriasPaciente')->name('searchHistoriasPaciente');
    

    Route::get('HistoriaClinica/HistoriasClinicasPaciente/Imprimir/{dni}/{correlativo}','HistoriaClinicaController@ImprimirHistoria');

     Route::get('HistoriaClinica/HistoriasClinicasPaciente/Ver/{dni}/{correlativo}','HistoriaClinicaController@VerHistoria');

     Route::get('HistoriaClinica/HistoriasClinicasPaciente/CambiarEstadoConsulta/{dni}/{correlativo}','HistoriaClinicaController@CambiarEstadoConsulta');

    // Fin de Historia Clinica

    // Pacientes 

        Route::get('Pacientes/ListarPacientes', 'PacienteController@index')->name('ListarPacientes');

        Route::get('Pacientes/RegistrarPacientes', 'PacienteController@create')->name('RegistrarPacientes');

        Route::post('Pacientes/GuardarPacientes', 'PacienteController@save')->name('GuardarPacientes');
        
        Route::post('Pacientes/search', 'PacienteController@search')->name('Pacientessearch');


        


       // Route::get('Pacientes/Editar/{id}', 'PacienteController@edit')->name('Pacientes.edit');

        Route::get('Pacientes/Editar/{id}',['as' => 'Pacientes.edit', 'uses' => 'PacienteController@edit']);

        Route::get('Pacientes/ImprimirFicha/{id}',['as' => 'Pacientes.ImprimirFicha', 'uses' => 'PacienteController@ImprimirFicha']);        


        Route::post('Pacientes/EditarPacientes', 'PacienteController@saveedit')->name('EditarPacientes');

    // Fin Rutas de Pacientes.


    // Home and account

    Route::post('/search', 'HomeController@search')->name('search');
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('account', 'AccountController@Account');
    Route::post('account', 'AccountController@update');

    // Product

    Route::get('/product/notaingreso', 'ProductController@notaingreso')->name('product.notaingreso');
    Route::post('/product/notaingreso', 'ProductController@postnotaingreso')->name('product.postnotaingreso');

    Route::get('/product/expired', 'ProductController@expired');
    Route::get('/product/outstock', 'ProductController@outstock');
    Route::get('product/pdf/{product}', 'ProductController@pdf')->name('product.pdf');
    Route::resource('product', 'ProductController');
    Route::post('/product/search', 'ProductController@search');
    Route::post('/product/sell', 'ProductController@sell');



    // Category

    Route::resource('category', 'CategoryController');
	Route::resource('subcategory', 'SubCategoryController');
    // Sales

    Route::get('sales/invoice/{product}', 'SalesController@getInvoice')->name('sales.invoice');
    Route::get('sales/pdf/{product}', 'SalesController@pdf')->name('sales.pdf');
    Route::get('sales/pdfmedicas/{product}', 'SalesController@pdfmedicas')->name('sales.pdfmedicas');
    Route::resource('sales', 'SalesController');
    Route::post('/sales/check', 'SalesController@check');
    Route::post('/sales/bk', 'SalesController@bk');
    Route::post('/sales/search', 'SalesController@search');
     Route::get('/sales/imprimir/{codigo}/{tipo}', 'SalesController@imprimir')->name('sales.imprimir');

    // Suppliers
	
	// Cotizaciones.
	
	Route::resource('cotizaciones', 'CotizacionController');
	
	Route::get('cotizaciones/invoice/{product}', 'CotizacionController@getInvoice')->name('sales.invoice');
	Route::get('cotizaciones/pdf/{product}', 'CotizacionController@pdf')->name('sales.pdf');
	Route::get('cotizaciones/pdfmedicas/{product}', 'CotizacionController@pdfmedicas')->name('sales.pdfmedicas');
	
	Route::post('/cotizaciones/check', 'CotizacionController@check');
	Route::post('/cotizaciones/bk', 'CotizacionController@bk');
	Route::post('/cotizaciones/search', 'CotizacionController@search');
	Route::get('/cotizaciones/imprimir/{codigo}/{tipo}', 'CotizacionController@imprimir')->name('sales.imprimir');
	
	// Fin de Cotizaciones.
	
	Route::resource('suppliers', 'SuppliersController');

    // Language

    Route::get('language/{locale}', 'LanguageController@index');

    // Customers
    // mestrada :
    Route::get('customers/pdf/{customers}', 'CustomersController@pdf')->name('customers.pdf');
    Route::resource('customers', 'CustomersController');
    Route::post('/customers/search', 'CustomersController@search');
     
    // Customers
    // Route::get('Cliente/CrearCliente', 'CustomersController@CrearPaciente')->name('customers.CrearPaciente');

    Route::get('Cliente/CrearCliente',['as' => 'Cliente/CrearCliente', 'uses' => 'CustomersController@CrearPaciente']);

    Route::post('customers/CrearPaciente', 'CustomersController@RegistrarPaciente')->name('customers.CrearPaciente');
    // Setting

    Route::get('setting/lt', 'SettingController@lt')->name('setting.lt');
    Route::get('setting/printer', 'SettingController@printer')->name('setting.printer');
    Route::get('setting/other', 'SettingController@other')->name('setting.other');
    Route::get('setting/series', 'SettingController@series')->name('setting.series');
    
    Route::post('/series/search', 'SettingController@search');
    Route::post('/series/listar_ajax/{id}', 'CustomersController@listarseriesajax');
    Route::post('/users/search', 'UsersController@search');

    Route::get('/series/agregar', 'SettingController@agregar')->name('series.agregar');
    Route::post('/series/guardarserie', 'SettingController@guardarserie')->name('series.guardarserie');

    Route::match(['PUT','PATCH'], 'setting/lt/{setting}', [
            'uses'  => 'SettingController@ltUpdate',
            'as'    =>    'setting.ltUpdate',
        ]);
    Route::match(['PUT','PATCH'], 'setting/printer/{setting}', [
            'uses'  => 'SettingController@printerUpdate',
            'as'    => 'setting.printerUpdate'
        ]);
    Route::match(['PUT','PATCH'], 'setting/other/{setting}', [
            'uses'  => 'SettingController@otherUpdate',
            'as'    => 'setting.otherUpdate'
        ]);


    // Tools

    Route::get('tools/discount', 'ToolsController@discount')->name('tools.discount');
    Route::get('tools/dsearch', 'ToolsController@dsearch')->name('tools.dsearch');
    Route::get('tools/note', 'ToolsController@note')->name('tools.note');
    Route::post('tools', [
        'uses'  => 'ToolsController@noteStore',
        'as'    => 'tools.noteStore'
    ]);
    Route::match(['PUT','PATCH'], 'tools/note/{note}', [
            'uses'  => 'ToolsController@noteUpdate',
            'as'    => 'tools.noteUpdate'
     ]);
    Route::delete('tools/note/{note}', 'ToolsController@noteDestroy')->name('tools.noteDestroy');

    //Backups
    Route::get('setting/backup/get/{filename}', [
    'as' => 'backup.download',
    'uses' => 'BackupController@backupDownload']);
    Route::get('setting/backup', 'BackupController@backup')->name('setting.backup');
    Route::post('setting', 'BackupController@backupStore')->name('setting.backupStore');
    Route::delete('setting/backups/{setting}', 'BackupController@backupDestroy')->name('setting.backupDestroy');

    // Users

    Route::resource('users', 'UsersController');

    // Analysis

    Route::get('analysis', 'AnalysisController@index');
    Route::get('analysis/sales', 'AnalysisController@sales');
    Route::get('analysis/purchases', 'AnalysisController@purchases');
    Route::get('analysis/customers', 'AnalysisController@customers');

    Route::get('analysis/reportes/medicas', 'AnalysisController@medicas');

    Route::get('analysis/reportes/preciosventa', 'AnalysisController@preciosventa');
    Route::get('analysis/reportes/stockmedicamentos', 'AnalysisController@stockmedicamentos');


    Route::get('analysis/stockmedicamentos/{id}', 'AnalysisController@pdfPrecioVenta');
    Route::get('analysis/stockmedicamentos/{id}', 'AnalysisController@pdfstockmedicamentos');
	Route::get('analysis/rptprecioventa/{id}', 'AnalysisController@pdfPrecioVenta');
    
    
    Route::get('analysis/reportes/movimientosalmacen', 'AnalysisController@movimientosalmacen');


    Route::get('analysis/reportes/VentasUsuario', 'AnalysisController@VentasUsuario');
    
    Route::post('analysis/reportes/VentasUsuario', 'AnalysisController@GenerarReporteVentasUsuario')->name('reportes.GenerarReporteVentasUsuario');

    Route::post('analysis/reportes/ReporteMovimientoAlmacen', 'AnalysisController@GenerarReporteReporteMovimientoAlmacen')->name('reportes.GenerarReporteReporteMovimientoAlmacen');

    // Historias Clinicas

    

    // Fin de Historias Clinicas.


});
