<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

class PlataformaController extends AppController
{
    public function index()
    {
  
        $plants = $this->fetchTable('Plants')
            ->find()
            ->select(['id', 'name', 'description', 'price', 'image', 'stock'])
            ->orderBy(['Plants.name' => 'ASC'])
            ->toArray();

      
        $cartItems = $this->fetchTable('CartItems')->find('all', [
            'contain' => ['Plants']
        ])->toArray();

       
        $cartItemCount = 0;
        foreach ($cartItems as $item) {
            $cartItemCount += $item->quantity;
        }
     
        $this->set(compact('plants', 'cartItems', 'cartItemCount'));
    }
}