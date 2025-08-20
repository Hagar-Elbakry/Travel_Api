<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TravelResource;
use App\Models\Travel;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    public function index() {
        $publicTravels = Travel::query()->where('is_public',1)->paginate(10);
        return TravelResource::collection($publicTravels);
    }
}
