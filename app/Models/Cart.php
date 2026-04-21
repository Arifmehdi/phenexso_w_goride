<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'session_id',
        'user_id',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    


    public static function cartCount(): int
    {
        return self::when(auth()->check(), function ($query) {
            return $query->where('user_id', auth()->id());
        })
        ->when(!auth()->check(), function ($query) {
            return $query->where('session_id', session('session_id'));
        })
        ->count();
    }

    public static function getCartItems()
    {
        return self::when(auth()->check(), function ($query) {
                    return $query->where('user_id', auth()->id());
                })
                ->when(!auth()->check(), function ($query) {
                    return $query->where('session_id', session('session_id'));
                })
                ->with('product') // যদি cart table এ product_id থাকে এবং relation define থাকে
                ->get();
    }

    public static function CartItemsCount()
    {
        return self::query()
            ->when(auth()->check(), function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->when(!auth()->check(), function ($query) {
                $query->where('session_id', session('session_id'));
            })
            ->with('product') // optional, শুধু relation access করতে চাইলে
            ->count();
    }

    public static function totalCartPrice(): float
    {
        return self::with('product')
            ->when(auth()->check(), fn($q) => $q->where('user_id', auth()->id()))
            ->when(!auth()->check(), fn($q) => $q->where('session_id', session('session_id')))
            ->get()
            ->sum(function ($cart) {
                return $cart->quantity * ($cart->product->final_price ?? 0);
            });
    }


    public static function totalDiscountAmount()
    {
        $query = self::query();

        if (Auth::check()) {
            $query->where('user_id', Auth::id());
        } else {
            $query->where('session_id', Session::get('session_id'));
        }

        $total_price = 0;

        foreach ($query->get() as $cart) {
            if ($cart->product) {
                $total_price += $cart->product->discount * $cart->quantity;
            }
        }

        return $total_price;
    }


  

}