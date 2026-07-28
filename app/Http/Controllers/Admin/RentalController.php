<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RentalBooking;
use App\Models\RentalCar;
use Illuminate\Http\Request;

/**
 * Web admin for Rent a Car — the rental fleet and the bookings customers make.
 */
class RentalController extends Controller
{
    // ───────────────────────────── Fleet ─────────────────────────────

    public function cars()
    {
        if (function_exists('menuSubmenu')) menuSubmenu('rental', 'rentalCars');

        $cars = RentalCar::withCount(['bookings as active_bookings' => fn ($q) => $q->active()])
            ->orderBy('name')->get();

        return view('admin.rental.cars', compact('cars'));
    }

    public function saveCar(Request $request)
    {
        $data = $request->validate([
            'id'                => 'nullable|exists:rental_cars,id',
            'name'              => 'required|string|max:120',
            'type'              => 'nullable|string|max:40',
            'image'             => 'nullable|string|max:255',
            'seats'             => 'nullable|integer|min:1|max:60',
            'transmission'      => 'nullable|string|max:30',
            'fuel'              => 'nullable|string|max:30',
            'plate_number'      => 'nullable|string|max:40',
            'price_one_way'     => 'required|numeric|min:0',
            'price_with_return' => 'required|numeric|min:0',
            'features'          => 'nullable|string|max:500',
        ]);

        // An unchecked checkbox isn't submitted at all, so read it explicitly.
        $data['is_available'] = $request->boolean('is_available');

        RentalCar::updateOrCreate(['id' => $data['id'] ?? null], $data);

        return back()->with('success', 'Car saved.');
    }

    public function deleteCar($id)
    {
        $car = RentalCar::findOrFail($id);

        if ($car->bookings()->active()->exists()) {
            return back()->with('error', 'This car has active bookings — mark it unavailable instead.');
        }

        $car->delete();

        return back()->with('success', 'Car removed.');
    }

    public function toggleCar($id)
    {
        $car = RentalCar::findOrFail($id);
        $car->update(['is_available' => !$car->is_available]);

        return back()->with('success', 'Car marked ' . ($car->is_available ? 'available' : 'unavailable') . '.');
    }

    // ─────────────────────────── Bookings ───────────────────────────

    public function bookings(Request $request)
    {
        if (function_exists('menuSubmenu')) menuSubmenu('rental', 'rentalBookings');

        $query = RentalBooking::with('car')->orderByDesc('created_at');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->paginate(20)->withQueryString();

        // Resolve each customer from their own table (4 separate guards).
        $bookings->getCollection()->transform(function ($b) {
            $owner = $b->owner();
            $b->customer_name  = $owner->name ?? 'Unknown';
            $b->customer_phone = $owner->mobile ?? $b->contact_phone;
            return $b;
        });

        $stats = [
            'total'     => RentalBooking::count(),
            'pending'   => RentalBooking::where('status', 'pending')->count(),
            'ongoing'   => RentalBooking::whereIn('status', ['confirmed', 'ongoing'])->count(),
            'revenue'   => (float) RentalBooking::where('status', 'completed')->sum('total_price'),
        ];

        return view('admin.rental.bookings', compact('bookings', 'stats'));
    }

    public function updateBookingStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', RentalBooking::STATUSES),
        ]);

        RentalBooking::findOrFail($id)->update(['status' => $request->status]);

        return back()->with('success', 'Booking status updated.');
    }
}
