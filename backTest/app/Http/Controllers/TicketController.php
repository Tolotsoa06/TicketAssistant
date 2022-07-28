<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{

    //find ticket list
     public function findTicketClient()
     {
         return response()->json(Ticket::where('user_type', '=', 'Client')->get(), 200);
     }

     public function findTicket()
     {
         return response()->json(Ticket::all(), 200);
     }

    //get Ticket by id
     public function getTicketById($id)
     {
        $ticket = Ticket::find($id);
        if(is_null($ticket)){   
            return response()->json(['message' => 'Ticket introvable'], 404);
        }
        return response()->json(Ticket::find($id), 200);
     }

     //add new ticket
    public function addTicket(Request $request)
    {
        if ($request->id && $request->id != 'undefined') {
            info('aaaaaa');
            $ticket = Ticket::find($request->id);
        }else{
            $ticket = new Ticket;
        }
        if($request->file('file') != null){
            $file = $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs('ticket', $file, 'public');
            $image_final = 'storage/ticket/'.$file;
        }else{
            $image_final = 'img/default.jpg';
        }
        info($request);
        $ticket->tickets_name = $request->tickets_name;
        $ticket->nombre = $request->nombre;
        $ticket->prix = $request->prix;
        $ticket->file = $image_final;
        $ticket->user_type = $request->user_type;
        $reponse = $ticket->save();
       // $response = Ticket::create($request->all());
        return response($reponse, 201);

    }

    public function updateTicket(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        if(is_null($ticket)){
            return response()->json(['message' => 'Ticket inéxistant'], 404);
        }   
        $ticket->update($request->all());
        return response($ticket, 200);
    }

    public function deleteTicket(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        if(is_null($ticket)){
            return response()->json(['message' => 'Ticket inéxistant'], 404);
        }   
        $ticket->delete();
        return response(null, 204);
    }

}