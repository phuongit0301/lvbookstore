<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Tag;
use App\Http\Models\Category;
use App\Http\Models\Story;
use App\Helpers\Common;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class StoryController extends Controller
{
    public function index()
    {
      $stories = Story::with('categories', 'tags')->paginate(30);
      return view('backend.story.index', compact('stories'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
   public function create()
   {
      //
   }
   /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
   public function store()
   {
      //
   }
   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
   public function show($id)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
   public function edit($id)
   {
      //
   }
   /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
   public function update($id)
   {
      //
   }
   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
   public function destroy($id)
   {
      //
   }

}
