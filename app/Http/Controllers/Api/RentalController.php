<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RentalBooking;
use App\Models\RentalCar;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    // ─────────────────────────── Customer ───────────────────────────

    /**
     * GET /api/rental/cars — cars available for the requested dates.
     *
     * Query: with_return (0|1), pickup_date, return_date
     * Excludes anything already held by an active booking that overlaps.
     */
    public function cars(Request $request)
    {
        $withReturn = $request->boolean('with_return');
        $pickup = $request->input('pickup_date');
        $return = $request->input('return_date') ?: $pickup;

        $query = RentalCar::where('is_available', true);

        // Drop cars whose existing bookings overlap the requested window.
        if ($pickup) {
            $taken = RentalBooking::active()
                ->whereNotNull('rental_car_id')
                ->where(function ($q) use ($pickup, $return) {
                    $q->whereBetween('pickup_date', [$pickup, $return])
                      ->orWhereBetween('return_date', [$pickup, $return])
                      ->orWhere(function ($qq) use ($pickup, $return) {
                          $qq->where('pickup_date', '<=', $pickup)
                             ->where('return_date', '>=', $return);
                      });
                })
                ->pluck('rental_car_id')->unique()->all();

            if ($taken) $query->whereNotIn('id', $taken);
        }

        $cars = $query->orderBy('price_one_way')->get()->map(fn ($c) => [
            'id'           => $c->id,
            'name'         => $c->name,
            'type'         => $c->type,
            'image'        => $c->image,
            'seats'        => $c->seats,
            'transmission' => $c->transmission,
            'fuel'         => $c->fuel,
            'price'        => $c->priceFor($withReturn),
            'features'     => array_values(array_filter(
                array_map('trim', explode(',', (string) $c->features))
            )),
        ]);

        return response()->json(['success' => true, 'cars' => $cars]);
    }

    /** POST /api/rental/bookings — place a rental booking. */
    public function book(Request $request)
    {
        $data = $request->validate([
            'rental_car_id'   => 'required|exists:rental_cars,id',
            'with_return'     => 'nullable|boolean',
            'pickup_date'     => 'required|date',
            'pickup_time'     => 'nullable|string|max:20',
            'return_date'     => 'nullable|date|after_or_equal:pickup_date',
            'pickup_district' => 'nullable|string|max:100',
            'pickup_thana'    => 'nullable|string|max:100',
            'dest_district'   => 'nullable|string|max:100',
            'dest_thana'      => 'nullable|string|max:100',
            'contact_name'    => 'nullable|string|max:100',
            'contact_phone'   => 'nullable|string|max:30',
            'note'            => 'nullable|string|max:500',
        ]);

        $user = auth()->user();
        $car  = RentalCar::findOrFail($data['rental_car_id']);
        $withReturn = (bool) ($data['with_return'] ?? false);

        if (!$car->is_available) {
            return response()->json([
                'success' => false, 'message' => 'That car is no longer available.',
            ], 422);
        }

        // Price is taken from the SERVER, never from the app, so a tampered
        // request can't book a car for the wrong amount.
        $booking = RentalBooking::create([
            'user_id'         => $user->id,
            'owner_type'      => notificationAudience($user),
            'rental_car_id'   => $car->id,
            'with_return'     => $withReturn,
            'pickup_date'     => $data['pickup_date'],
            'pickup_time'     => $data['pickup_time'] ?? null,
            'return_date'     => $withReturn ? ($data['return_date'] ?? null) : null,
            'pickup_district' => $data['pickup_district'] ?? null,
            'pickup_thana'    => $data['pickup_thana'] ?? null,
            'dest_district'   => $data['dest_district'] ?? null,
            'dest_thana'      => $data['dest_thana'] ?? null,
            'contact_name'    => $data['contact_name'] ?? $user->name,
            'contact_phone'   => $data['contact_phone'] ?? ($user->mobile ?? null),
            'total_price'     => $car->priceFor($withReturn),
            'status'          => 'pending',
            'note'            => $data['note'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Rental booked. We will confirm shortly.',
            'booking' => $this->shape($booking->load('car')),
        ], 201);
    }

    /** GET /api/rental/bookings — the signed-in customer's rentals. */
    public function myBookings()
    {
        $user = auth()->user();

        $bookings = RentalBooking::with('car')
            ->where('user_id', $user->id)
            ->where('owner_type', notificationAudience($user))
            ->orderByDesc('created_at')
            ->get()
            ->map(fn ($b) => $this->shape($b));

        return response()->json(['success' => true, 'bookings' => $bookings]);
    }

    /** POST /api/rental/bookings/{id}/cancel — customer cancels their own. */
    public function cancel($id)
    {
        $user = auth()->user();

        $booking = RentalBooking::where('id', $id)
            ->where('user_id', $user->id)
            ->where('owner_type', notificationAudience($user))
            ->first();

        if (!$booking) {
            return response()->json(['success' => false, 'message' => 'Booking not found'], 404);
        }
        if (in_array($booking->status, ['completed', 'cancelled'], true)) {
            return response()->json([
                'success' => false, 'message' => 'This booking can no longer be cancelled.',
            ], 422);
        }

        $booking->update(['status' => 'cancelled']);

        return response()->json(['success' => true, 'message' => 'Booking cancelled']);
    }

    // ──────────────────────────── Admin ────────────────────────────

    /** GET /api/admin/rental/bookings — every rental, newest first. */
    public function adminBookings(Request $request)
    {
        $query = RentalBooking::with('car')->orderByDesc('created_at');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->take(200)->get()->map(function ($b) {
            $row = $this->shape($b);
            $owner = $b->owner();
            $row['customer'] = $owner->name ?? 'Unknown';
            $row['customer_phone'] = $owner->mobile ?? $b->contact_phone;
            $row['customer_type'] = $b->owner_type;
            return $row;
        });

        return response()->json(['success' => true, 'bookings' => $bookings]);
    }

    /** POST /api/admin/rental/bookings/{id}/status */
    public function adminUpdateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', RentalBooking::STATUSES),
        ]);

        $booking = RentalBooking::findOrFail($id);
        $booking->update(['status' => $request->status]);

        return response()->json(['success' => true, 'message' => 'Status updated']);
    }

    /** GET /api/admin/rental/cars — the whole fleet (incl. unavailable). */
    public function adminCars()
    {
        return response()->json([
            'success' => true,
            'cars' => RentalCar::orderBy('name')->get(),
        ]);
    }

    /** POST /api/admin/rental/cars — create or update a car. */
    public function adminSaveCar(Request $request)
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
            'is_available'      => 'nullable|boolean',
        ]);

        $car = RentalCar::updateOrCreate(['id' => $data['id'] ?? null], $data);

        return response()->json(['success' => true, 'car' => $car]);
    }

    /** DELETE /api/admin/rental/cars/{id} */
    public function adminDeleteCar($id)
    {
        $car = RentalCar::findOrFail($id);

        if ($car->bookings()->active()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'This car has active bookings — mark it unavailable instead.',
            ], 422);
        }

        $car->delete();

        return response()->json(['success' => true, 'message' => 'Car removed']);
    }

    /** One consistent JSON shape for a booking. */
    private function shape(RentalBooking $b): array
    {
        return [
            'id'              => $b->id,
            'car_id'          => $b->rental_car_id,
            'car_name'        => $b->car->name ?? 'Car removed',
            'car_image'       => $b->car->image ?? null,
            'with_return'     => (bool) $b->with_return,
            'pickup_date'     => optional($b->pickup_date)->toDateString(),
            'pickup_time'     => $b->pickup_time,
            'return_date'     => optional($b->return_date)->toDateString(),
            'pickup_district' => $b->pickup_district,
            'pickup_thana'    => $b->pickup_thana,
            'dest_district'   => $b->dest_district,
            'dest_thana'      => $b->dest_thana,
            'contact_name'    => $b->contact_name,
            'contact_phone'   => $b->contact_phone,
            'total_price'     => (float) $b->total_price,
            'status'          => $b->status,
            'note'            => $b->note,
            'created_at'      => optional($b->created_at)->toDateTimeString(),
        ];
    }
}
