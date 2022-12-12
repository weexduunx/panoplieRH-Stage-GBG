<?php

use App\Http\Controllers\Admin\ChecklistController;
use App\Http\Controllers\Admin\ChecklistGroupController;
use App\Http\Controllers\Admin\TacheController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', 'welcome')->name('home')->middleware(['auth']);


Route::group(['middleware' => ['auth', 'save_last_action_timestamp']], function(){
	Route::get('welcome', [App\Http\Controllers\PageController::class, 'welcome'])->name('welcome');
	Route::get('consultation', [App\Http\Controllers\PageController::class, 'consultation'])->name('consultation');
	Route::get('checklists/{checklist}', [App\Http\Controllers\User\ChecklistController::class, 'show'])->name('users.checklists.show');
	Route::get('tasklist/{list_type}', [App\Http\Controllers\User\ChecklistController::class, 'tasklist'])->name('users.tasklist');

	Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware' => 'is_admin'], function(){

		// Utilisateur routes
		Route::controller(UserController::class)->name('users.')->group(function () {
			Route::get('/users', 'index')->name('index');
			Route::post('/users', 'store')->name('store');
			Route::get('/users/create', 'create')->name('create');
			Route::get('/users/{user}/edit', 'edit')->name('edit');
			Route::put('/users/{user}/update', 'update')->name('update');
			Route::delete('/users/{user}/delete', 'delete')->name('delete');
		});

		// ImageController
			Route::post('images', [App\Http\Controllers\Admin\ImageController::class, 'store'])->name('images.store');

		// Tache routes 
		Route::controller(TacheController::class)->group(function () {
			Route::get('checklists/{checklist}/taches/{tach}/edit', 'edit')->name('edit');
			Route::delete('checklists/{checklist}/taches/{tach}', 'destroy')->name('destroy');
			Route::put('checklists/{checklist}/taches', 'update')->name('update');
			Route::get('checklists/{checklist}/taches/create', 'create')->name('create');
			Route::get('checklists/{checklist}/taches', 'index')->name('index');
			Route::post('checklists/{checklist}/taches', 'store')->name('store');
		
		});

		// Page routes
		Route::controller(App\Http\Controllers\Admin\PageController::class)->group(function () {
			Route::get('pages/{page}/edit', 'edit')->name('pageEdit');
			Route::put('pages/{page}', 'update')->name('pageUpdate');
		});

		// Checklist routes
		Route::resource('checklist_groups', ChecklistGroupController::class,);
		Route::resource('checklist_groups.checklists', ChecklistController::class);

		//Agenda Route
		Route::get('/agenda', function () {
			return view('agenda.index');
		})->name('agenda')->middleware(['auth']);
		
		// Livewire Todo Application Routes
		Route::get('/todo', function(){
			return view('todo.index'); 
		})->name('todo')->middleware(['auth']);
		
	});
});







require 'auth.php';
