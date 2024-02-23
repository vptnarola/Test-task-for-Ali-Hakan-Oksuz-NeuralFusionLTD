<?php

namespace App\Http\Controllers;

use App\Enum\AdsensePosition;
use App\Http\Requests\AddAdsenseRequest;
use App\Models\Adsense;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdsenseController extends Controller
{
    public function index( Request $request ): View | JsonResponse
    {
        $adsenses = Adsense::query()
            ->when($request->q, function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    return $query->where('name', 'LIKE', "%{$request->q}%")
                        ->orWhere('banner_width', 'LIKE', "%{$request->q}%")
                        ->orWhere('banner_height', 'LIKE', "%{$request->q}%");
                });
            })
            ->latest()
            ->paginate(1);

        if ( $request->ajax() ) {
            $data = [
                'status' => true,
                'data' => [
                    'links' => $adsenses->links('pagination::bootstrap-5')->render(),
                    'view' => view('panel.adsense.item', compact('adsenses'))->render(),
                ],
            ];

            return response()->json($data, 200);
        }

        return view('panel.adsense.index', compact('adsenses'));
    }

    public function adsenseAddOrUpdate(?string $id = null): View
    {
        $adsense = Adsense::find($id);        
        // $positions = AdsensePosition::options();

        return view('panel.adsense.form', compact('adsense'));
    }

    public function adsenseDelete(?string $id = null)
    {
        $record = Adsense::where('id', $id)->firstOrFail();
        $record->delete();
        return back()->with(['message' => 'Deleted Successfully', 'type' => 'success']);
    }

    public function adsenseAddOrUpdateSave( AddAdsenseRequest $request )
    {
        $record = null;
        try {
            DB::beginTransaction();

            $data = $request->validated();

            if ($request->hasFile('banner_image')) {
                $path = 'upload/ads_images/';

                $image = $request->file('banner_image');

                $image_name = str()->random(4) . '-'. str()->slug($data['name']) . '-image.' . $image->getClientOriginalExtension();
                $image->move($path, $image_name);
                $data['banner_image'] = $image_name;
            }


            if ($request->adsense_id != 'undefined') {
                $record = Adsense::where('id', $request->adsense_id)->firstOrFail();
                $record->update($data);
                $record->refresh();
            } else {
                $record = Adsense::create($data);
            }

            DB::commit();

            $response = [
                'status' => true,
                'data' => [
                    'record' => $record,
                ],
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            DB::rollback();
            $data = array(
                'errors' => ['Something went wrong, please try after sometime.'],
            );
            return response()->json($data, 419);
        }

    }
}
