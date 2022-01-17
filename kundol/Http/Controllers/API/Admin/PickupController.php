<?php

namespace App\Http\Controllers\API\Admin;

use App\Contract\Admin\PickupInterface;
use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\PickupRequest;
use App\Models\Admin\Pickup;
use App\Repository\Admin\PickupRepository;
use App\Traits\ApiResponser;

class PickupController extends Controller
{
    use ApiResponser;
    private $PickupRepository;

    public function __construct(PickupInterface $PickupRepository)
    {
        $this->PickupRepository = $PickupRepository;
    }

    public function index()
    {
        return $this->PickupRepository->all();
    }

    public function show(Pickup $pickup)
    {
        return $this->PickupRepository->show($pickup);
    }

    public function store(PickupRequest $request)
    {
        $parms = $request->all();
        return $this->PickupRepository->store($parms);
    }

    public function update(PickupRequest $request, Pickup $pickup)
    {
        $parms = $request->all();

        return $this->PickupRepository->update($parms, $pickup);

    }

    public function destroy($id)
    {
        return $this->PickupRepository->destroy($id);
    }

}
