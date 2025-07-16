<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvitationController extends Controller
{
    /**
     * Display the invitation page
     */
    public function index()
    {
        $data = [
            'birthday_girl' => 'Marlu',
            'event_date' => '2025-08-02',
            'ceremony_time' => '18:00',
            'party_time' => '18:00',
            'email' => 'joelale_18@outlook.com',
            'ceremony_location' => [
                'name' => 'Parroquia San José',
                'address' => 'Calle Principal #123, Centro, Rioverde, S.L.P.',
                'maps_url' => 'https://maps.google.com/?q=Parroquia+San+Jose+Rioverde'
            ],
            'party_location' => [
                'name' => 'Finca El Palmar',
                'address' => 'Boulevar universitario Puente del carmen, 79617 Rioverde, S.L.P.',
                'maps_url' => 'https://maps.app.goo.gl/AEhEjHhtg8qanAtc7'
            ],
            'hotels' => [
                [
                    'name' => 'Hotel Plaza',
                    'location' => 'Centro Histórico',
                    'phone' => '487-123-4567'
                ],
                [
                    'name' => 'Hotel Colonial',
                    'location' => 'Zona Centro',
                    'phone' => '487-234-5678'
                ],
                [
                    'name' => 'Hotel Ejecutivo',
                    'location' => 'Boulevard Principal',
                    'phone' => '487-345-6789'
                ]
            ],
            'gallery_images' => [
                'gallery-31.jpg',
                'gallery-2.jpg',
                'gallery-3.jpg',
                'gallery-5.jpg',
                'gallery-6.jpg',
                'gallery-9.jpg',
                'gallery-10.jpg',
                'gallery-11.JPG',
                'gallery-12.JPG',
                'gallery-13.jpg',
                'gallery-16.jpg',
                'gallery-17.jpg',
                'gallery-18.JPG',
                'gallery-19.JPG',
                'gallery-20.jpg',
                'gallery-21.jpg',
                'gallery-22.jpg',
                'gallery-24.jpg',
                'gallery-25.jpg',
                'gallery-26.jpg',
                'gallery-27.jpg',
                'gallery-29.JPG',
                'gallery-30.JPG',
                'gallery-32.jpg',
                'gallery-33.jpg',
                'gallery-34.jpg',
                'gallery-35.jpg',
                'gallery-36.jpg'
            ]
        ];

        return view('invitation.index', $data);
    }
}