<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('ticket', [TicketController::class, 'findTicket']);
Route::get('ticketClient', [TicketController::class, 'findTicketClient']);
Route::get('ticket/{id}', [TicketController::class, 'getTicketById']);
Route::post('addTicket', [TicketController::class, 'addTicket']);
Route::put('updateTicket/{id}', [TicketController::class, 'updateTicket']);
Route::delete('deleteTicket/{id}', [TicketController::class, 'deleteTicket']);




