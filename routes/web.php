<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ContaCliente;
use App\Http\Controllers\Pt;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\ContratoPagamento;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\ServicoController;
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
/*
/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
   // return view('auth/login');
   return view('admin.login');
});

Route::get('/novo', function () {
    // return view('auth/login');
    return view('layouts.template2');
 });

Route::post('/login',[UserController::class,'login'])->middleware('auth');

/*Route::get('/dashboard/user', function () {
    return view('user');
});*/

Route::get('/dashboard/user', [UserController::class,'index'])->middleware('auth');
Route::get('/dashboard/user/profile{id}', [UserController::class,'perfil'])->middleware('auth');
//rotas usuario
Route::post('/user/bloquear',[UserController::class,'bloquear'])->middleware('auth')->middleware('auth');
Route::post('/user/desbloquear',[UserController::class,'desbloquear'])->middleware('auth')->middleware('auth');
Route::delete('/user/delete',[UserController::class,'destroy'])->middleware('auth')->middleware('auth');
Route::put('/user/update/', [UserController::class,'update'])->middleware('auth');
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard/register', function () {
    return view('auth/register');
})->middleware(['auth'])->name('register');

Route::get('/user/register', function () {
    return view('auth/register');
})->middleware(['auth'])->name('register');
require __DIR__.'/auth.php';

Route::post('/user/registar',[RegisteredUserController::class,'store'])->middleware('auth');

//Rotas clientes
Route::get('/dashboard/clientes', [ClienteController::class,'index'])->middleware('auth');
Route::get('/dashboard/clientes.register', function () {
    return view('registercliente');
});
Route::post('/dashboard/clientes', [ClienteController::class,'store'])->middleware('auth');

//Rotas servicos
Route::get('/dashboard/servicos', [ServicoController::class,'index'])->middleware('auth');
Route::get('/dashboard/servicos/show/{id}', [ServicoController::class,'show'])->middleware('auth');
Route::post('/dashboard/servicos', [ServicoController::class,'store'])->middleware('auth');
Route::put('/servicos/update/{id}', [ServicoController::class,'update'])->middleware('auth');
Route::delete('/servicos/delete', [ServicoController::class,'destroy'])->middleware('auth');
//Rotas pts
Route::get('/dashboard/pts', [Pt::class,'index'])->middleware('auth');
Route::post('/dashboard/Pts/store', [Pt::class,'store'])->middleware('auth');
Route::get('/dashboard/Pts/show/{id}', [Pt::class,'show'])->middleware('auth');
Route::put('/dashboard/Pts/update', [Pt::class,'update'])->middleware('auth');
Route::delete('/dashboard/Pts/delete', [Pt::class,'destroy'])->middleware('auth');
//clientes
Route::get('/dashboard/clientes', [ClientesController::class,'index'])->middleware('auth');
Route::post('/dashboard/clientes/store', [ClientesController::class,'store'])->middleware('auth');

Route::get('/dashboard/clientesempresa', [ClientesController::class,'showEmpresa'])->middleware('auth');
Route::get('/dashboard/clientesParticular', [ClientesController::class,'showparticular'])->middleware('auth');
Route::delete('/dashboard/clientes/delete', [ClientesController::class,'destroy'])->middleware('auth');
Route::put('/dashboard/clientes/update', [ClientesController::class,'update'])->middleware('auth');
Route::get('/dashboard/clientes/show/{id}', [ClientesController::class,'show'])->middleware('auth');
Route::get('/dashboard/clientes/historico/{id}', [ClientesController::class,'historico'])->middleware('auth');
//contractos
Route::get('/dashboard/contratos', [ContratoController::class,'index'])->middleware('auth');
Route::post('/dashboard/contratos/store', [ContratoController::class,'store'])->middleware('auth');
Route::put('/dashboard/contratos/update', [ContratoController::class,'update'])->middleware('auth');
Route::get('/dashboard/contratos/show/{id}', [ContratoController::class,'show'])->middleware('auth');
Route::delete('/dashboard/contratos/delete', [ContratoController::class,'destroy'])->middleware('auth');
// gestão de contratos
Route::get('/dashboard/contratos-show/{id}', [ContratoController::class,'mostrarcontrato'])->middleware('auth');
Route::get('/dashboard/comprovativo-de-pagamento-contrato/{id}', [ContratoPagamento::class,'gerarcomprovativo'])->middleware('auth');
Route::put('/dashboard/contrato/aprovar', [ContratoPagamento::class,'aprovarpagamento'])->middleware('auth');
Route::get('/dashboard/contratos-pagamento/{id}', [ContratoPagamento::class,'buscarpagamento'])->middleware('auth');
Route::put('/dashboard/contrato-pagamento/update', [ContratoPagamento::class,'update'])->middleware('auth');
Route::get('/dashboard/gestao-contrato', [ContratoController::class,'gestaocontrato'])->middleware('auth');
Route::get('/dashboard/contratos-detalhes/{id}', [ContratoController::class,'detalhes'])->middleware('auth');

Route::get('/dashboard/testo', [PagamentoController::class,'diferencaMes'])->middleware('auth');
//pagamentos
Route::get('/dashboard/pagamentos', [PagamentoController::class,'index'])->middleware('auth');
Route::post('/dashboard/pagamentos/buscarCliente', [PagamentoController::class,'buscarCliente'])->middleware('auth'); 
Route::get('/dashboard/pagamentos/buscarCliente/{id}', [PagamentoController::class,'buscarclienteId'])->middleware('auth'); 
Route::post('/dashboard/pagamento', [PagamentoController::class,'pagamento'])->middleware('auth');
Route::post('/dashboard/pagamento/store', [PagamentoController::class,'store'])->middleware('auth');
Route::put('/pagamentos/aprovar', [PagamentoController::class,'aprovarPagamento'])->middleware('auth');
Route::get('/pagamentos/show{id}', [PagamentoController::class,'mostarpagameto'])->middleware('auth');
Route::put('/pagamentos/update', [PagamentoController::class,'update'])->middleware('auth');
Route::get('/dashboard/devedores', [PagamentoController::class,'devedores'])->middleware('auth');
Route::post('/dashboard/pagamentos/gerar-codigo-fatura', [PagamentoController::class,'salvarPagamento'])->middleware('auth');
Route::post('/dashboard/pagamentos/salvar-dados-pagamento', [PagamentoController::class,'salvardadosPagamento'])->middleware('auth');
//faturas e relatorios
Route::get('/pagamentos/recibo{id}', [PagamentoController::class,'gerarfatura'])->middleware('auth');
Route::get('/pagamentos/recibo', [PagamentoController::class,'teste'])->middleware('auth');
Route::get('/dashboard/recibos', [PagamentoController::class,'recibos'])->middleware('auth');
Route::get('/dashboard/pagamentos/{idpagamento}',[PagamentoController::class,'detalhes'])->middleware('auth');
Route::post('/dashboard/extratopagamento', [PagamentoController::class,'extratopagamento'])->middleware('auth');
Route::get('/dashboard/contrato{id}', [ContratoController::class,'gerarcontrato'])->middleware('auth');
Route::post('/dashboard/exportextratopagamentoexel', [PagamentoController::class,'exportextratopagamento'])->middleware('auth');
Route::post('/dashboard/extrato-de-divida', [PagamentoController::class,'extratodivida'])->middleware('auth');
//gestão de contratos
Route::get('/dashboard/gestao-de-contratos', [ContratoPagamento::class,'index'])->middleware('auth');
Route::post('/dashboard/pagar-contrato', [ContratoPagamento::class,'store'])->middleware('auth');


//contaclientes
Route::get('/dashboard/contas', [ContaCliente::class,'index'])->middleware('auth');
Route::post('/dashboard/contas/store', [ContaCliente::class,'store'])->middleware('auth');
Route::get('/dashboard/contas/detalhes/{id}', [ContaCliente::class,'detalhes'])->middleware('auth');