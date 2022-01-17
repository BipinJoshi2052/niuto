<?php

namespace App\Contract\Admin;

use Illuminate\Support\Collection;

interface PickupInterface
{
   public function all();

   public function show($pickup);

   public function store(array $parms);

   public function update(array $parms, $pickup);

   public function destroy($pickup);

}