<?php
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnuncioController;
use App\Http\Controllers\AuthController;
use App\Models\Annuncio;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\ChatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('/', [FrontendController::class, 'index'])->name('index');

Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::get('/search/photos', [SearchController::class, 'showPhotos'])->name('search.showPhotos');  // Modifica il nome della route
Route::get('/search/{id}', [SearchController::class, 'showAnnuncio'])->name('search.showAnnuncio');


Route::get('/search/filtri', [SearchController::class, 'showFiltri'])->name('search.filtri');

Route::get('/sell', [SellController::class, 'index'])->name('sell.index');
Route::post('/sell', [AnnuncioController::class, 'store'])->name('sell.store');
Route::get('/foto', [AnnuncioController::class, 'visualizzaFoto'])->name('foto.index');


Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');


Route::get('/account', [AccountController::class, 'index'])->name('account.index');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/annunci/{annuncio}', [AnnuncioController::class, 'show'])->name('annunci.show');



Route::get('/foto/crea', [FotoController::class, 'crea'])->name('foto.crea');
Route::post('/foto/salva', [FotoController::class, 'salva'])->name('foto.salva');


Route::get('/chat/elenco_utenti', [ChatController::class, 'elencoUtenti'])->name('chat.elenco_utenti');
Route::middleware(['auth'])->group(function () {
    Route::get('/chat/{receiver}/{annuncio}', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/{receiver}/{annuncio}', [ChatController::class, 'store'])->name('chat.store');

Route::delete('/annunci/{annuncio}', [AnnuncioController::class, 'destroy'])->name('annunci.destroy');
Route::get('/annunci/{id}/modifica', [AnnuncioController::class, 'edit'])->name('annunci.edit');
Route::put('/annunci/{annuncio}', [AnnuncioController::class, 'update'])->name('annunci.update');
});
// routes/web.php
Route::post('/delete-account', [AccountController::class, 'deleteAccount'])->name('delete.account');

Route::get('/change-password', [AccountController::class, 'showChangePasswordForm'])->name('account.change-password');
Route::post('/change-password', [ChangePasswordController::class, 'changePassword'])->name('account.change-password');


Route::get('/messaggio/{receiver}/{annuncio}', [ChatController::class, 'showMessaggioForm'])->name('chat.messaggio-form');









