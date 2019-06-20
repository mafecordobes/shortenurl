<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Url; 

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'url' => 'required'
            ]);
    
            $short_url = Str::random(7);
    
            $url = new Url;
    
            $url->url = $request->input('url');
            $url->short_url = $short_url;
            $url->count = 0;
            $url->save();

            $response = [
                'success' => true, 
                'message' => 'Your short url for '.$request->input('url').' is '. "http://shortenurl.test/". $short_url,
                'data' => array(
                    'url' => $request->input('url'),
                    'short_url' => $short_url, 
                    'id' => $url->id
                )
            ];
    
            return response()->json($response, 200);

        } catch (BadResponseException $e) {
            throw new Exceptions\InvalidResponseException($e->getMessage());
        } catch (InvalidApiResponseException $e) {
            throw new Exceptions\InvalidResponseException($e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($short_url)
    {
        $shorten = Url::where('short_url', $short_url)->first();
        $shorten->increment('count');
        return redirect()->away($shorten->url);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
