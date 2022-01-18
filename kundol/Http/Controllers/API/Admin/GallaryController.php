<?php

namespace App\Http\Controllers\API\Admin;

use App\Contract\Admin\GallaryInterface;
use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\GallaryDeleteRequest;
use App\Http\Requests\GallaryRequest;
use App\Http\Requests\GallaryTagRequest;
use App\Http\Requests\SingleGallaryRequest;
use App\Models\Admin\Gallary;
use App\Models\Admin\ProductGallaryDetail;
use Illuminate\Http\Request;

class GallaryController extends Controller
{
    private $gallaryRepository;

    public function __construct(GallaryInterface $gallaryRepository)
    {
        $this->gallaryRepository = $gallaryRepository;
    }

    public function index()
    {
        return $this->gallaryRepository->all();
    }

    public function show($gallary)
    {
        return $this->gallaryRepository->show($gallary);
    }

    public function store(GallaryRequest $request)
    {
        return $this->gallaryRepository->store($request->file('file'), $request->all());
    }

    public function update(GallaryTagRequest $request, Gallary $gallary)
    {
        return $this->gallaryRepository->update($request->all(), $gallary);
    }

    public function destroy(GallaryDeleteRequest $request)
    {
        return $this->gallaryRepository->destroy($request->id);
    }

    public function resizeSingleImage(SingleGallaryRequest $request)
    {
        return $this->gallaryRepository->resizeSingleImage($request->all());
    }

    public function regenrateAllImages()
    {
        return $this->gallaryRepository->regenrateAllImages();
    }

    public function deleteSingleImage(Request $request){
        $result = ProductGallaryDetail::where([
            'product_id' => $request['product_id'],
            'gallary_id' => $request['gallary_id']
        ])->delete();
        if($result){
            return response()->json([
                'success' => 'successfully deleted',
            ]);
        }
        return response()->json([
            'error' => 'error',
        ]);
    }
}
