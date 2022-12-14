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

Route::post('/login',[UserController::class,'login']);

/*Route::get('/dashboard/user', function () {
    return view('user');
});*/

Route::get('/dashboard/user', [UserController::class,'index']);
Route::get('/dashboard/user/profile{id}', [UserController::class,'perfil']);
//rotas usuario
Route::post('/user/bloquear',[UserController::class,'bloquear'])->middleware('auth');
Route::post('/user/desbloquear',[UserController::class,'desbloquear'])->middleware('auth');
Route::delete('/user/delete',[UserController::class,'destroy'])->middleware('auth');
Route::put('/user/update/', [UserController::class,'update']);
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
Route::get('/dashboard/clientes', [ClienteController::class,'index']);
Route::get('/dashboard/clientes.register', function () {
    return view('registercliente');
});
Route::post('/dashboard/clientes', [ClienteController::class,'store']);

//Rotas servicos
Route::get('/dashboard/servicos', [ServicoController::class,'index']);
Route::get('/dashboard/servicos/show/{id}', [ServicoController::class,'show']);
Route::post('/dashboard/servicos', [ServicoController::class,'store']);
Route::put('/servicos/update/{id}', [ServicoController::class,'update']);
Route::delete('/servicos/delete', [ServicoController::class,'destroy']);
//Rotas pts
Route::get('/dashboard/pts', [Pt::class,'index']);
Route::post('/dashboard/Pts/store', [Pt::class,'store']);
Route::get('/dashboard/Pts/show/{id}', [Pt::class,'show']);
Route::put('/dashboard/Pts/update', [Pt::class,'update']);
Route::delete('/dashboard/Pts/delete', [Pt::class,'destroy']);
//clientes
Route::get('/dashboard/clientes', [ClientesController::class,'index']);
Route::post('/dashboard/clientes/store', [ClientesController::class,'store']);

Route::get('/dashboard/clientesempresa', [ClientesController::class,'showEmpresa']);
Route::get('/dashboard/clientesParticular', [ClientesController::class,'showparticular']);
Route::delete('/dashboard/clientes/delete', [ClientesController::class,'destroy']);
Route::put('/dashboard/clientes/update', [ClientesController::class,'update']);
Route::get('/dashboard/clientes/show/{id}', [ClientesController::class,'show']);
Route::get('/dashboard/clientes/historico/{id}', [ClientesController::class,'historico']);
//contractos
Route::get('/dashboard/contratos', [ContratoController::class,'index']);
Route::post('/dashboard/contratos/store', [ContratoController::class,'store']);
Route::put('/dashboard/contratos/update', [ContratoController::class,'update']);
Route::get('/dashboard/contratos/show/{id}', [ContratoController::class,'show']);
Route::delete('/dashboard/contratos/delete', [ContratoController::class,'destroy']);
// gest??o de contratos
Route::get('/dashboard/contratos-show/{id}', [ContratoController::class,'mostrarcontrato']);
Route::get('/dashboard/comprovativo-de-pagamento-contrato/{id}', [ContratoPagamento::class,'gerarcomprovativo']);
Route::put('/dashboard/contrato/aprovar', [ContratoPagamento::class,'aprovarpagamento']);
Route::get('/dashboard/contratos-pagamento/{id}', [ContratoPagamento::class,'buscarpagamento']);
Route::put('/dashboard/contrato-pagamento/update', [ContratoPagamento::class,'update']);
Route::get('/dashboard/gestao-contrato', [ContratoController::class,'gestaocontrato']);
Route::get('/dashboard/contratos-detalhes/{id}', [ContratoController::class,'detalhes']);

Route::get('/dashboard/testo', [PagamentoController::class,'diferencaMes']);
//pagamentos
Route::get('/dashboard/pagamentos', [PagamentoController::class,'index']);
Route::post('/dashboard/pagamentos/buscarCliente', [PagamentoController::class,'buscarCliente']); 
Route::get('/dashboard/pagamentos/buscarCliente/{id}', [PagamentoController::class,'buscarclienteId']); 
Route::post('/dashboard/pagamento', [PagamentoController::class,'pagamento']);
Route::post('/dashboard/pagamento/store', [PagamentoController::class,'store']);
Route::put('/pagamentos/aprovar', [PagamentoController::class,'aprovarPagamento']);
Route::get('/pagamentos/show{id}', [PagamentoController::class,'mostarpagameto']);
Route::put('/pagamentos/update', [PagamentoController::class,'update']);
Route::get('/dashboard/devedores', [PagamentoController::class,'devedores']);
Route::post('/dashboard/pagamentos/gerar-codigo-fatura', [PagamentoController::class,'salvarPagamento']);
Route::post('/dashboard/pagamentos/salvar-dados-pagamento', [PagamentoController::class,'salvardadosPagamento']);
//faturas e relatorios
Route::get('/pagamentos/recibo{id}', [PagamentoController::class,'gerarfatura']);
Route::get('/pagamentos/recibo', [PagamentoController::class,'teste']);
Route::get('/dashboard/recibos', [PagamentoController::class,'recibos']);
Route::get('/dashboard/pagamentos/{idpagamento}',[PagamentoController::class,'detalhes']);
Route::post('/dashboard/extratopagamento', [PagamentoController::class,'extratopagamento']);
Route::get('/dashboard/contrato{id}', [ContratoController::class,'gerarcontrato']);
Route::post('/dashboard/exportextratopagamentoexel', [PagamentoController::class,'exportextratopagamento']);
Route::post('/dashboard/extrato-de-divida', [PagamentoController::class,'extratodivida']);
//gest??o de contratos
Route::get('/dashboard/gestao-de-contratos', [ContratoPagamento::class,'index']);
Route::post('/dashboard/pagar-contrato', [ContratoPagamento::class,'store']);


//contaclientes
Route::get('/dashboard/contas', [ContaCliente::class,'index']);
Route::post('/dashboard/contas/store', [ContaCliente::class,'store']);
Route::get('/dashboard/contas/detalhes/{id}', [ContaCliente::class,'detalhes']);