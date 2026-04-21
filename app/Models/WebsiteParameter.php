<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteParameter extends Model
{
    use HasFactory;

    public function logo()
    {
        return $this->logo ?: 'logo.gif';
    }

    public function logo_alt()
    {
        return $this->logo_alt ?: 'logo.gif';
    }

    public function favicon()
    {
        return $this->favicon ?: 'favicon.ico';
    }


    public function about_img()
    {
        return $this->about_img ?: 'about_img.jpg';
    }

     public function eccomerce_img()
    {
        return $this->eccomerce_img ?: 'pharmacy_ccomerce.jpeg';
    }

    public function hospital_img()
    {
        return $this->hospital_img ?: 'hospital.jpeg';
    }

    public function ambulance_img()
    {
        return $this->ambulance_img ?: 'ambulance3.jpg';
    }

    public function doctor_img()
    {
        return $this->doctor_img ?: 'doctor.jpg';
    }

    public function diagnostic_img()
    {
        return $this->diagnostic_img ?: 'diagnostic.jpg';
    }
}
