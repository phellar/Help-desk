<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */


    public function index()
    {  
        // only admin can view all tickets

        $this->authorize('viewAny', Ticket::class);
    
        $tickets = Ticket::all();   

            if($tickets->count() > 0){
                return TicketResource::collection($tickets);
            }
            else{
                return response()->json([
                    'message'=> 'No Tickets Available'
                ],200);
            }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'subject' => 'required|string|max:255',
            'description'=> 'required|string|max:255',
            'priority' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:jpgs,pdf,png|max:1024',
        ]);

        $filepath = null;
        if($request->hasFile('file')){
            $filepath = $request->file('file')->store('product', 'public');
        }

        $ticket = Ticket::create([
            'subject' => $request->subject,
            'description'=> $request->description,
            'priority' => $request->priority,
            'department' =>$request->department,
            'file' =>$filepath,
            'status' => 'Open',
            'user_id'=> Auth()->id()
        ]);

        return response()->json([
                'message' => 'Ticket Created Successfully',
                'data' => new TicketResource($ticket)
        ],201);

    }

    /**
     * user can view the ticket they created
     */
    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);
       return new TicketResource($ticket);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);
    
        $request -> validate([
          'status' => 'required|string' 
        ]);

        $ticket->update([
            'status' => $request->status,
        ]);

        return response()->json([
                'message' => 'Ticket Status Updated Successfully',
                'data' => new TicketResource($ticket)
        ],200);

    }

    /**
     *only admin can delete a ticket
     */
    public function destroy(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);
        return $ticket->delete();
    }
}
