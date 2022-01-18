<?php

namespace App\Repository\Admin;

use App\Contract\Admin\PickupInterface;
use App\Http\Resources\Admin\Pickup as PickupResource;
use App\Models\Admin\Language;
use App\Models\Admin\Product;
use App\Models\Admin\Pickup;
use App\Services\Admin\PickupDetailService;
use App\Traits\ApiResponser;
use Illuminate\Support\Collection;

class PickupRepository implements PickupInterface
{
    use ApiResponser;
    /**
     * @return Collection
     */
    public function all()
    {
        
        try {
            $pickup = new Pickup;
            if (isset($_GET['getDetail']) && $_GET['getDetail'] == '1') {
                $languageId = Language::defaultLanguage()->value('id');
                if (isset($_GET['language_id']) && $_GET['language_id'] != '') {
                    $language = Language::languageId($_GET['language_id'])->firstOrFail();
                    $languageId = $language->id;
                }
                $pickup = $pickup->GetPickupDetailByLanguageId($languageId);
            }
            if (isset($_GET['searchParameter']) && $_GET['searchParameter'] != '') {
                $pickup = $pickup->searchParameter($_GET['searchParameter']);
            }
            if (isset($_GET['limit']) && is_numeric($_GET['limit']) && $_GET['limit'] > 0) {
                $numOfResult = $_GET['limit'];
            } else {
                $numOfResult = 100;
            }
            $sortBy = ['id'];
            $sortType = ['ASC', 'DESC', 'asc', 'desc'];
            if (isset($_GET['sortBy']) && $_GET['sortBy'] != '' && isset($_GET['sortType']) && $_GET['sortType'] != '' && in_array($_GET['sortBy'], $sortBy) && in_array($_GET['sortType'], $sortType)) {
                $pickup = $pickup->orderBy($_GET['sortBy'], $_GET['sortType']);
            }

            $sortBy = ['name','is_active'];
            if (isset($_GET['getDetail']) && $_GET['getDetail'] == '1') {
                $pickupSortType = $pickupSortBy = '';
                if (isset($_GET['sortBy']) && $_GET['sortBy'] != '' && isset($_GET['sortType']) && $_GET['sortType'] != '' && in_array($_GET['sortBy'], $sortBy) && in_array($_GET['sortType'], $sortType)) {
                    $pickupSortType = $_GET['sortType'];
                    $pickupSortBy = $_GET['sortBy'];
                    $pickup = $pickup->sortByPickupDetail($pickupSortBy, $pickupSortType, $languageId);
                }
            }
            return $this->successResponse(PickupResource::collection($pickup->paginate($numOfResult)), 'Data Get Successfully!');
        } catch (Exception $e) {
            return $this->errorResponse();
        }
    }

    public function show($pickup)
    {
        try {
            if (isset($_GET['getDetail']) && $_GET['getDetail'] == '1') {
                // dd(new PickupResource(Pickup::with('detail')->PickupId($pickup->id)->firstOrFail()));
                return $this->successResponse(new PickupResource(Pickup::with('detail')->PickupId($pickup->id)->firstOrFail()), 'Data Get Successfully!');
            }

            return $this->successResponse(new PickupResource($pickup), 'Data Get Successfully!');
        } catch (Exception $e) {
            return $this->errorResponse();
        }
    }

    public function store(array $parms)
    {
        \DB::beginTransaction();
        try {
            $parms['created_by'] = \Auth::id();
            $sql = Pickup::create($parms);
        } catch (Exception $e) {
            \DB::rollback();
            return $this->errorResponse();
        }

        if ($sql) {
            $pickupDetailService = new PickupDetailService;
            $result = $pickupDetailService->store($parms, $sql->id);
        }

        if ($result) {
            \DB::commit();
            return $this->successResponse(new PickupResource($sql), 'Pickup Save Successfully!');
        } else {
            \DB::rollback();
            return $this->errorResponse();
        }
    }

    public function update(array $parms, $pickup)
    {
        // return $parms;
        \DB::beginTransaction();
        if (isset($parms['is_active'])) {
            $single['is_active'] = $parms['is_active'];
        } else {
            $single['is_active'] = 1;
        }
        try {
            $single['updated_by'] = \Auth::id();
            $pickup->update($single);
            if ($pickup) {
                $pickupDetailService = new PickupDetailService;
                $result = $pickupDetailService->update($parms, $pickup->id);
            }
        } catch (Exception $e) {
            \DB::rollback();
            return $this->errorResponse();
        }


        if ($result) {
            \DB::commit();
            return $this->successResponse(new PickupResource($pickup), 'Pickup Update Successfully!');
        } else {
            \DB::rollback();
            return $this->errorResponse();
        }
    }

    public function destroy($pickup)
    {
        try {
            $sql = Pickup::findOrFail($pickup);
            $sql->delete();
        } catch (Exception $e) {
            return $this->errorResponse();
        }

        if ($sql) {
            return $this->successResponse('', 'Pickup Delete Successfully!');
        } else {
            return $this->errorResponse();
        }
    }
}
