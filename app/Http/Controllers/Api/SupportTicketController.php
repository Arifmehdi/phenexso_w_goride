<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use App\Models\SupportTicketReply;
use Illuminate\Http\Request;

class SupportTicketController extends Controller
{
    /**
     * POST /api/support-tickets — create a ticket.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject'          => 'required|string|max:255',
            'message'          => 'required|string|max:2000',
            'category'         => 'nullable|string|max:50',
            'ride_request_id'  => 'nullable|integer',
        ]);

        $user = auth()->user();
        $ticket = SupportTicket::create([
            'user_id'         => $user->id,
            'owner_type'      => notificationAudience($user),
            'subject'         => $request->subject,
            'message'         => $request->message,
            'category'        => $request->category,
            'ride_request_id' => $request->ride_request_id,
            'status'          => 'open',
            'priority'        => 'normal',
        ]);

        return response()->json(['success' => true, 'ticket' => $ticket], 201);
    }

    /**
     * GET /api/support-tickets — the authenticated entity's own tickets.
     */
    public function index()
    {
        $user = auth()->user();
        $tickets = SupportTicket::where('user_id', $user->id)
            ->where('owner_type', notificationAudience($user))
            ->withCount('replies')
            ->orderByDesc('created_at')
            ->paginate(20);

        return response()->json(['success' => true, 'tickets' => $tickets]);
    }

    /**
     * GET /api/support-tickets/{id} — ticket + full reply thread.
     */
    public function show(SupportTicket $ticket)
    {
        $this->authorizeAccess($ticket);
        $ticket->load('replies');
        return response()->json(['success' => true, 'ticket' => $ticket]);
    }

    /**
     * POST /api/support-tickets/{id}/reply — owner or admin adds a reply.
     */
    public function reply(Request $request, SupportTicket $ticket)
    {
        $request->validate(['message' => 'required|string|max:2000']);

        $user = auth()->user();
        $isAdmin = $user instanceof \App\Models\Admin;
        if (!$isAdmin) {
            $this->authorizeAccess($ticket);
        }

        $reply = SupportTicketReply::create([
            'ticket_id'   => $ticket->id,
            'sender_id'   => $user->id,
            'sender_type' => $isAdmin ? 'admin' : notificationAudience($user),
            'message'     => $request->message,
        ]);

        // Reopen a resolved/closed ticket if the customer replies again.
        if (!$isAdmin && in_array($ticket->status, ['resolved', 'closed'])) {
            $ticket->update(['status' => 'open']);
        }
        // Mark in_progress once an admin responds to an open ticket.
        if ($isAdmin && $ticket->status === 'open') {
            $ticket->update(['status' => 'in_progress']);
        }

        return response()->json(['success' => true, 'reply' => $reply], 201);
    }

    /**
     * PATCH /api/admin/support-tickets/{id} — admin updates status/priority.
     */
    public function adminUpdate(Request $request, SupportTicket $ticket)
    {
        $request->validate([
            'status'   => 'nullable|in:open,in_progress,resolved,closed',
            'priority' => 'nullable|in:low,normal,high,urgent',
        ]);

        $ticket->update($request->only(['status', 'priority']));

        return response()->json(['success' => true, 'ticket' => $ticket]);
    }

    /**
     * GET /api/admin/support-tickets — admin list, all tickets.
     */
    public function adminIndex(Request $request)
    {
        $query = SupportTicket::withCount('replies')->orderByDesc('created_at');
        if ($request->filled('status')) $query->where('status', $request->status);
        if ($request->filled('priority')) $query->where('priority', $request->priority);

        return response()->json(['success' => true, 'tickets' => $query->paginate(20)]);
    }

    private function authorizeAccess(SupportTicket $ticket): void
    {
        $user = auth()->user();
        if ($ticket->user_id !== $user->id || $ticket->owner_type !== notificationAudience($user)) {
            abort(403, 'Unauthorized');
        }
    }
}
