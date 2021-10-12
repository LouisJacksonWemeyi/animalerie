<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
	if(Auth::check()){    
        return redirect()->route('portal');
    }
    
    return redirect()->route('login');
})->name('/');

// Login user ===================================

Route::get('/login', [
	'as' => 'login',
	'uses' =>'UsersController@login']
);

Route::post('/login', [
	'as' => 'login',
	'uses' =>'UsersController@connect']
);

//jackson ajout début
Route::get('/forgot', [
	'as' => 'forgot',
	'uses' =>'UsersController@forgoter']
);
Route::post('/forgot', [
	'as' => 'forgot',
	'uses' =>'UsersController@forgotpost']
);
Route::get('/resetpassform', [
	'as' => 'resetpassform',
	'uses' =>'UsersController@itself']
);

Route::post('/resetpassform', [
	'as' => 'resetpassform',
	'uses' =>'UsersController@updatePassword']
);
// Jackson ajout fin

// !! Login user ================================


Route::group(['middleware' => 'auth'], function()
{

	//  Portal ========================================

	Route::get('/portal', [
		'as' => 'portal',
		'uses' =>'PortalController@index']
	);
	
	// !!  Portal =====================================

	//  Users ==========================================

	Route::get('/users', [
		'as' => 'users.index',
		'uses' =>'UsersController@index']
	);

	Route::get('/user/create', [
		'as' => 'user.create',
		'uses' =>'UsersController@create']
	);

	Route::post('/user/create', [
		'as' => 'user.create',
		'uses' =>'UsersController@store']
	);

	Route::get('/user', [
		'as' => 'user.itself',
		'uses' =>'UsersController@itself']
	);

	Route::post('/user', [
		'as' => 'user.itself',
		'uses' =>'UsersController@updatePassword']
	);

	Route::get('/user/{id}', [
		'as' => 'user.show',
		'uses' =>'UsersController@show']
	);

	Route::get('/user/edit/{id}', [
		'as' => 'user.edit',
		'uses' =>'UsersController@edit']
	);

	Route::post('/user/edit/{id}', [
		'as' => 'user.edit',
		'uses' =>'UsersController@update']
	);

	Route::get('/logout', [
		'as' => 'logout',
		'uses' =>'UsersController@logout']
	);

	Route::get('/user/activate/{id}', [
		'as' => 'user.activate',
		'uses' =>'UsersController@activate']
	);

	Route::get('/user/deactivate/{id}', [
		'as' => 'user.deactivate',
		'uses' =>'UsersController@deactivate']
	);

	Route::get('/user/destroy/{id}', [
		'as' => 'user.destroy',
		'uses' =>'UsersController@destroy']
	);

	// !! Users =====================================

	// Agrements ===================================


	Route::get('/agrements', [
		'as' => 'agrements.index',
		'uses' =>'AgrementsController@index']
	);

	Route::get('/agrements/export', [
		'as' => 'agrements.export',
		'uses' =>'AgrementsController@export']
	);
	
	Route::get('/agrement/create', [
		'as' => 'agrement.create',
		'uses' =>'AgrementsController@create']
	);

	Route::post('/agrement/create', [
		'as' => 'agrement.create',
		'uses' =>'AgrementsController@store']
	);

	Route::get('/agrement/edit/{id}', [
		'as' => 'agrement.edit',
		'uses' =>'AgrementsController@edit']
	);

	Route::post('/agrement/edit/{id}', [
		'as' => 'agrement.edit',
		'uses' =>'AgrementsController@update']
	);

	Route::get('/agrement/destroy/{id}', [
		'as' => 'agrement.destroy',
		'uses' =>'AgrementsController@destroy']
	);


	// !! Agrements ================================

	// Species ===================================


	Route::get('/species', [
		'as' => 'species.index',
		'uses' =>'SpeciesController@index']
	);

	Route::post('/species', [
		'as' => 'species.index',
		'uses' =>'SpeciesController@store']
	);

	Route::get('/specie/edit/{id}', [
		'as' => 'specie.edit',
		'uses' =>'SpeciesController@edit']
	);

	Route::post('/specie/edit/{id}', [
		'as' => 'specie.edit',
		'uses' =>'SpeciesController@update']
	);

	Route::get('/specie/destroy/{id}', [
		'as' => 'specie.destroy',
		'uses' =>'SpeciesController@destroy']
	);

	// !! Species ================================

	// Agrement species ===================================

	Route::get('/agrement_specie/create/{agrement_id}', [
		'as' => 'agrement_specie.create',
		'uses' =>'AgrementSpeciesController@create']
	);

	Route::post('/agrement_specie/create/{agrement_id}', [
		'as' => 'agrement_specie.create',
		'uses' =>'AgrementSpeciesController@store']
	);

	Route::get('/agrement_specie/edit/{id}', [
		'as' => 'agrement_specie.edit',
		'uses' =>'AgrementSpeciesController@edit']
	);

	Route::post('/agrement_specie/edit/{id}', [
		'as' => 'agrement_specie.edit',
		'uses' =>'AgrementSpeciesController@update']
	);

	Route::get('/agrement_specie/destroy/{id}', [
		'as' => 'agrement_specie.destroy',
		'uses' =>'AgrementSpeciesController@destroy']
	);


	// !! Agrement species ================================

	// Agrement users ===================================

	Route::get('/agrement_user/create/{agrement_id}', [
		'as' => 'agrement_user.create',
		'uses' =>'AgrementUsersController@create']
	);

	Route::post('/agrement_user/create/{agrement_id}', [
		'as' => 'agrement_user.create',
		'uses' =>'AgrementUsersController@store']
	);

	Route::get('/agrement_user/edit/{id}', [
		'as' => 'agrement_user.edit',
		'uses' =>'AgrementUsersController@edit']
	);

	Route::post('/agrement_user/edit/{id}', [
		'as' => 'agrement_user.edit',
		'uses' =>'AgrementUsersController@update']
	);

	Route::get('/agrement_user/destroy/{id}', [
		'as' => 'agrement_user.destroy',
		'uses' =>'AgrementUsersController@destroy']
	);

	// !! Agrement users ================================

	// Protocols ===================================

	Route::get('/protocols', [
		'as' => 'protocols.index',
		'uses' =>'EthicalProtocolsController@index']
	);

	Route::get('/protocols/export', [
		'as' => 'protocols.export',
		'uses' =>'EthicalProtocolsController@export']
	);

	Route::get('/protocol/create', [
		'as' => 'protocol.create',
		'uses' =>'EthicalProtocolsController@create']
	);

	Route::post('/protocol/create', [
		'as' => 'protocol.create',
		'uses' =>'EthicalProtocolsController@store']
	);

	Route::get('/protocol/edit/{id}', [
		'as' => 'protocol.edit',
		'uses' =>'EthicalProtocolsController@edit']
	);

	Route::post('/protocol/edit/{id}', [
		'as' => 'protocol.edit',
		'uses' =>'EthicalProtocolsController@update']
	);

	Route::get('/protocol/destroy/{id}', [
		'as' => 'protocol.destroy',
		'uses' =>'EthicalProtocolsController@destroy']
	);


	// !! Protocols ================================

	// Protocol archives ===================================

	Route::get('/archives/{protocol_id}', [
		'as' => 'protocol.archives.index',
		'uses' =>'EthicalProtocolArchivesController@index']
	);

	Route::get('/archive/create/{protocol_id}', [
		'as' => 'protocol.archive.create',
		'uses' =>'EthicalProtocolArchivesController@create']
	);

	Route::post('/archive/create/{protocol_id}', [
		'as' => 'protocol.archive.create',
		'uses' =>'EthicalProtocolArchivesController@store']
	);

	Route::get('/archive/edit/{id}', [
		'as' => 'protocol.archive.edit',
		'uses' =>'EthicalProtocolArchivesController@edit']
	);

	Route::post('/archive/edit/{id}', [
		'as' => 'protocol.archive.edit',
		'uses' =>'EthicalProtocolArchivesController@update']
	);

	Route::get('/archive/destroy/{id}', [
		'as' => 'protocol.archive.destroy',
		'uses' =>'EthicalProtocolArchivesController@destroy']
	);


	// !! Protocol archives ================================


	// Protocol users ===================================

	Route::get('/protocol_user/create/{agrement_id}', [
		'as' => 'protocol_user.create',
		'uses' =>'ProtocolUserController@create']
	);

	Route::post('/protocol_user/create/{agrement_id}', [
		'as' => 'protocol_user.create',
		'uses' =>'ProtocolUserController@store']
	);

	Route::get('/protocol_user/edit/{id}', [
		'as' => 'protocol_user.edit',
		'uses' =>'ProtocolUsersController@edit']
	);

	Route::post('/protocol_user/edit/{id}', [
		'as' => 'protocol_user.edit',
		'uses' =>'ProtocolUsersController@update']
	);

	Route::get('/protocol_user/destroy/{id}', [
		'as' => 'protocol_user.destroy',
		'uses' =>'ProtocolUsersController@destroy']
	);

	// !! Protocol users ================================

	// Domains ===================================


	Route::get('/domains', [
		'as' => 'domains.index',
		'uses' =>'ApplicationDomainsController@index']
	);

	Route::post('/domains', [
		'as' => 'domain.index',
		'uses' =>'ApplicationDomainsController@store']
	);

	Route::get('/domain/edit/{id}', [
		'as' => 'domain.edit',
		'uses' =>'ApplicationDomainsController@edit']
	);

	Route::post('/domain/edit/{id}', [
		'as' => 'domain.edit',
		'uses' =>'ApplicationDomainsController@update']
	);
	
	Route::get('/domain/destroy/{id}', [
		'as' => 'domain.destroy',
		'uses' =>'ApplicationDomainsController@destroy']
	);


	// !! Domains ================================


	// Experiences ===================================


	Route::get('/experiences/{protocol_id}', [
		'as' => 'experiences.index',
		'uses' =>'ExperiencesController@index']
	);

	Route::get('/experience/create/{protocol_id}', [
		'as' => 'experience.create',
		'uses' =>'ExperiencesController@create']
	);

	Route::post('/experience/create/{protocol_id}', [
		'as' => 'experience.create',
		'uses' =>'ExperiencesController@store']
	);

	Route::get('/experience/edit/{id}', [
		'as' => 'experience.edit',
		'uses' =>'ExperiencesController@edit']
	);

	Route::post('/experience/edit/{id}', [
		'as' => 'experience.edit',
		'uses' =>'ExperiencesController@update']
	);

	Route::get('/experience/destroy/{id}', [
		'as' => 'experience.destroy',
		'uses' =>'ExperiencesController@destroy']
	);


	// !! Experiences ================================


	// Cages ===================================

	Route::get('/cage/create/{experience_id}', [
		'as' => 'cage.create',
		'uses' =>'CagesController@create']
	);

	Route::post('/cage/create/{experience_id}', [
		'as' => 'cage.create',
		'uses' =>'CagesController@store']
	);

	Route::get('/cage/edit/{id}', [
		'as' => 'cage.edit',
		'uses' =>'CagesController@edit']
	);

	Route::post('/cage/edit/{id}', [
		'as' => 'cage.edit',
		'uses' =>'CagesController@update']
	);

	Route::get('/cage/destroy/{id}', [
		'as' => 'cage.destroy',
		'uses' =>'CagesController@destroy']
	);


	// !! Cages ================================
	// Cages ===================================


	Route::get('/cage_types', [
		'as' => 'cage.types.index',
		'uses' =>'CageTypesController@index']
	);

	Route::get('/cage_type/create', [
		'as' => 'cage.type.create',
		'uses' =>'CageTypesController@create']
	);

	Route::post('/cage_type/create', [
		'as' => 'cage.type.create',
		'uses' =>'CageTypesController@store']
	);

	Route::get('/cage_type/edit/{id}', [
		'as' => 'cage.type.edit',
		'uses' =>'CageTypesController@edit']
	);

	Route::post('/cage_type/edit/{id}', [
		'as' => 'cage.type.edit',
		'uses' =>'CageTypesController@update']
	);

	Route::get('/cage_type/destroy/{id}', [
		'as' => 'cage.type.destroy',
		'uses' =>'CageTypesController@destroy']
	);


	// !! Cages ================================

	// Supplies ===================================


	Route::get('/supplies', [
		'as' => 'supplies.index',
		'uses' =>'SuppliesController@index']
	);

	Route::get('/supply/create', [
		'as' => 'supply.create',
		'uses' =>'SuppliesController@create']
	);

	Route::post('/supply/create', [
		'as' => 'supply.create',
		'uses' =>'SuppliesController@store']
	);

	Route::get('/supply/edit/{id}', [
		'as' => 'supply.edit',
		'uses' =>'SuppliesController@edit']
	);

	Route::post('/supply/edit/{id}', [
		'as' => 'supply.edit',
		'uses' =>'SuppliesController@update']
	);

	Route::get('/supply/destroy/{id}', [
		'as' => 'supply.destroy',
		'uses' =>'SuppliesController@destroy']
	);


	// !! Supplies ================================

	// Suppliers ===================================


	Route::get('/suppliers', [
		'as' => 'suppliers.index',
		'uses' =>'SuppliersController@index']
	);

	Route::get('/supplier/create', [
		'as' => 'supplier.create',
		'uses' =>'SuppliersController@create']
	);

	Route::post('/supplier/create', [
		'as' => 'supplier.create',
		'uses' =>'SuppliersController@store']
	);

	Route::get('/supplier/edit/{id}', [
		'as' => 'supplier.edit',
		'uses' =>'SuppliersController@edit']
	);

	Route::post('/supplier/edit/{id}', [
		'as' => 'supplier.edit',
		'uses' =>'SuppliersController@update']
	);

	Route::get('/supplier/destroy/{id}', [
		'as' => 'supplier.destroy',
		'uses' =>'SuppliersController@destroy']
	);


	// !! Suppliers ================================

	// Stock registries ===================================


	Route::get('/stock_registries', [
		'as' => 'stock.registries.index',
		'uses' =>'StockRegistriesController@index']
	);

  /* Route::get('/stock_registry/create/{supply_id}', [
		'as' => 'stock.registry.stockupdate',
		'uses' =>'StockRegistriesController@stockupdate']
	); */

	/*Route::get('/stock_registry/create/{supply_id}', [
		'as' => 'stock.registry.create',
		'uses' =>'StockRegistriesController@create']
	);
	
	Route::post('/stock_registry/create/{supply_id}', [
		'as' => 'stock.registry.create',
		'uses' =>'StockRegistriesController@store']
	);*/

	 Route::post('/stock_registry/create', [
		'as' => 'stock.registry.create',
		'uses' =>'StockRegistriesController@store']
	);

	Route::get('/stock_registry/create', [
		'as' => 'stock.registry.create',
		'uses' =>'StockRegistriesController@create']
	); 

	Route::get('/stock_registry/edit/{id}', [
		'as' => 'stock.registry.edit',
		'uses' =>'StockRegistriesController@edit']
	);

	Route::post('/stock_registry/edit/{id}', [
		'as' => 'stock.registry.edit',
		'uses' =>'StockRegistriesController@update']
	);

	Route::get('/stock_registry/destroy/{id}', [
		'as' => 'stock.registry.destroy',
		'uses' =>'StockRegistriesController@destroy']
	);

	// !! Stock supplies ================================

	// Places ===================================

	Route::get('/places', [
		'as' => 'places.index',
		'uses' =>'PlacesController@index']
	);

	Route::post('/places', [
		'as' => 'places.index',
		'uses' =>'PlacesController@store']
	);

	Route::get('/place/edit/{id}', [
		'as' => 'place.edit',
		'uses' =>'PlacesController@edit']
	);

	Route::post('/place/edit/{id}', [
		'as' => 'place.edit',
		'uses' =>'PlacesController@update']
	);

	Route::get('/place/destroy/{id}', [
		'as' => 'place.destroy',
		'uses' =>'PlacesController@destroy']
	);

	// !! Places ================================

	// Info places ===================================

	Route::get('/info_places', [
		'as' => 'info.places.index',
		'uses' =>'InfoPlacesController@index']
	);

	Route::post('info_places', [
		'as' => 'info.place.index',
		'uses' =>'InfoPlacesController@store']
	);

	Route::get('/info_place/export', [
		'as' => 'info.place.export_by_date',
		'uses' =>'InfoPlacesController@exportByDate']
	);

	Route::get('/info_place/export/{place_id}', [
		'as' => 'info.place.export_by_place',
		'uses' =>'InfoPlacesController@exportByplace']
	);

	Route::get('/info_place/edit/{id}', [
		'as' => 'info.place.edit',
		'uses' =>'InfoPlacesController@edit']
	);

	Route::post('/info_place/edit/{id}', [
		'as' => 'info.place.edit',
		'uses' =>'InfoPlacesController@update']
	);

	Route::get('/info_place/destroy/{id}', [
		'as' => 'info.place.destroy',
		'uses' =>'InfoPlacesController@destroy']
	);

	// !! Info places ================================

	// Links ===================================

	Route::get('/links', [
		'as' => 'links.index',
		'uses' =>'LinksController@index']
	);

	Route::post('/links', [
		'as' => 'links.index',
		'uses' =>'LinksController@store']
	);

	Route::get('/link/edit/{id}', [
		'as' => 'link.edit',
		'uses' =>'LinksController@edit']
	);

	Route::post('/link/edit/{id}', [
		'as' => 'link.edit',
		'uses' =>'LinksController@update']
	);

	Route::get('/link/destroy/{id}', [
		'as' => 'link.destroy',
		'uses' =>'LinksController@destroy']
	);

	// !! Links ================================

	// Events ===================================

	Route::get('/events', [
		'as' => 'events.index',
		'uses' =>'EventsController@index']
	);

	Route::get('/event/create', [
		'as' => 'event.create',
		'uses' =>'EventsController@create']
	);

	Route::post('/event/create', [
		'as' => 'event.create',
		'uses' =>'EventsController@store']
	);

	Route::get('/event/edit/{id}', [
		'as' => 'event.edit',
		'uses' =>'EventsController@edit']
	);

	Route::post('/event/edit/{id}', [
		'as' => 'event.edit',
		'uses' =>'EventsController@update']
	);

	Route::get('/event/destroy/{id}', [
		'as' => 'event.destroy',
		'uses' =>'EventsController@destroy']
	);

	// !! Events ================================

	// Animals ==================================

	Route::get('/animals', [
		'as' => 'animals.index',
		'uses' =>'StockAnimalsController@index']
	);

	Route::get('/animal/create', [
		'as' => 'animal.create',
		'uses' =>'StockAnimalsController@create']
	);

	Route::post('/animal/create', [
		'as' => 'animal.create',
		'uses' =>'StockAnimalsController@store']
	);

	Route::get('/animal/edit/{id}', [
		'as' => 'animal.edit',
		'uses' =>'StockAnimalsController@edit']
	);

	Route::post('/animal/edit/{id}', [
		'as' => 'animal.edit',
		'uses' =>'StockAnimalsController@update']
	);

	Route::get('/animal/destroy/{id}', [
		'as' => 'animal.destroy',
		'uses' =>'StockAnimalsController@destroy']
	);

	// !! Animals ==============================

	// Registries ==============================

	Route::get('/registries/{agrement_id}/{specie_id}', [
		'as' => 'registries.index',
		'uses' =>'RegistriesController@index']
	);

	// !! Registries ================================
	
	// News ================================

	Route::get('/new/create', [
		'as' => 'new.create',
		'uses' =>'NewsController@create']
	);

	Route::post('/new/create', [
		'as' => 'new.create',
		'uses' =>'NewsController@store']
	);

	Route::get('/new/edit/{id}', [
		'as' => 'new.edit',
		'uses' =>'NewsController@edit']
	);

	Route::post('/new/edit/{id}', [
		'as' => 'new.edit',
		'uses' =>'NewsController@update']
	);

	Route::get('/new/destroy/{id}', [
		'as' => 'new.destroy',
		'uses' =>'NewsController@destroy']
	);

	// !! News ================================
	
	// Reservations ================================

	Route::get('/reservations', [
		'as' => 'reservations.index',
		'uses' =>'ReservationsController@index']
	);

	Route::get('/reservation/create', [
		'as' => 'reservation.create',
		'uses' =>'ReservationsController@create']
	);

	Route::post('/reservation/create', [
		'as' => 'reservation.create',
		'uses' =>'ReservationsController@store']
	);

	Route::get('/reservation/edit/{id}', [
		'as' => 'reservation.edit',
		'uses' =>'ReservationsController@edit']
	);

	Route::post('/reservation/edit/{id}', [
		'as' => 'reservation.edit',
		'uses' =>'ReservationsController@update']
	);

	Route::get('/reservation/destroy/{id}', [
		'as' => 'reservation.destroy',
		'uses' =>'ReservationsController@destroy']
	);

	// !! Reservations ================================	

	// Texts ================================

	Route::get('/text/edit/{id}', [
		'as' => 'text.edit',
		'uses' =>'TextsController@edit']
	);

	Route::post('/text/edit/{id}', [
		'as' => 'text.edit',
		'uses' =>'TextsController@update']
	);

	// !! Texts ================================

	// Contacts (&& categories) =================

	Route::get('/contacts', [
		'as' => 'contacts.index',
		'uses' =>'ContactsController@index']
	);

	Route::get('/contact/create/{category_id}', [
		'as' => 'contact.create',
		'uses' =>'ContactsController@create']
	);

	Route::post('/contact/create/{category_id}', [
		'as' => 'contact.create',
		'uses' =>'ContactsController@store']
	);

	Route::get('/contact/edit/{id}', [
		'as' => 'contact.edit',
		'uses' =>'ContactsController@edit']
	);

	Route::post('/contact/edit/{id}', [
		'as' => 'contact.edit',
		'uses' =>'ContactsController@update']
	);

	Route::get('/contact/destroy/{id}', [
		'as' => 'contact.destroy',
		'uses' =>'ContactsController@destroy']
	);

	// !! Contacts ===========================

	// Category_contacts ====================

	Route::get('/category_contact/create', [
		'as' => 'category_contact.create',
		'uses' =>'CategoryContactsController@create']
	);

	Route::post('/category_contact/create', [
		'as' => 'category_contact.create',
		'uses' =>'CategoryContactsController@store']
	);

	Route::get('/category_contact/edit/{id}', [
		'as' => 'category_contact.edit',
		'uses' =>'CategoryContactsController@edit']
	);

	Route::post('/category_contact/edit/{id}', [
		'as' => 'category_contact.edit',
		'uses' =>'CategoryContactsController@update']
	);

	Route::get('/category_contact/destroy/{id}', [
		'as' => 'category_contact.destroy',
		'uses' =>'CategoryContactsController@destroy']
	);

	// !! Category_contacts ===========================

	// Severities ==============================

	Route::get('/severities', [
		'as' => 'severities.index',
		'uses' =>'SeveritiesController@index']
	);

	Route::post('/severities', [
		'as' => 'severities.index',
		'uses' =>'SeveritiesController@store']
	);

	Route::get('/severity/edit/{id}', [
		'as' => 'severity.edit',
		'uses' =>'SeveritiesController@edit']
	);

	Route::post('/severity/edit/{id}', [
		'as' => 'severity.edit',
		'uses' =>'SeveritiesController@update']
	);

	Route::get('/severity/destroy/{id}', [
		'as' => 'severity.destroy',
		'uses' =>'SeveritiesController@destroy']
	);

	// !! Severities ===========================

	// Colors ==============================

	Route::get('/colors', [
		'as' => 'colors.index',
		'uses' =>'ColorsController@index']
	);

	Route::get('/color/create', [
		'as' => 'color.create',
		'uses' =>'ColorsController@create']
	);

	Route::post('/color/create', [
		'as' => 'color.create',
		'uses' =>'ColorsController@store']
	);

	Route::get('/color/edit/{id}', [
		'as' => 'color.edit',
		'uses' =>'ColorsController@edit']
	);

	Route::post('/color/edit/{id}', [
		'as' => 'color.edit',
		'uses' =>'ColorsController@update']
	);

	Route::get('/color/destroy/{id}', [
		'as' => 'color.destroy',
		'uses' =>'ColorsController@destroy']
	);

	// !! Colors ===========================

	// Units ==============================

	Route::get('/units', [
		'as' => 'units.index',
		'uses' =>'UnitsController@index']
	);

	Route::get('/unit/create', [
		'as' => 'unit.create',
		'uses' =>'UnitsController@create']
	);

	Route::post('/unit/create', [
		'as' => 'unit.create',
		'uses' =>'UnitsController@store']
	);

	Route::get('/unit/edit/{id}', [
		'as' => 'unit.edit',
		'uses' =>'UnitsController@edit']
	);

	Route::post('/unit/edit/{id}', [
		'as' => 'unit.edit',
		'uses' =>'UnitsController@update']
	);

	Route::get('/unit/destroy/{id}', [
		'as' => 'unit.destroy',
		'uses' =>'UnitsController@destroy']
	);

	// !! Units ===========================

	// Limits ====================

	Route::get('/limits', [
		'as' => 'limits.index',
		'uses' =>'LimitsController@index']
	);

	Route::get('/limit/edit/{id}', [
		'as' => 'limit.edit',
		'uses' =>'LimitsController@edit']
	);

	Route::post('/limit/edit/{id}', [
		'as' => 'limit.edit',
		'uses' =>'LimitsController@update']
	);


	// !! Limits ===========================

	// Ajax calls (returns JSON) ===========
	
	Route::post('/events/ajax', [
		'as' => 'events.json',
		'uses' =>'EventsController@list']
	);

	Route::post('/mails', [
		'as' => 'mails.global.send',
		'uses' =>'UsersController@globalMail']
	);
	// !! Ajax calls ========================

});