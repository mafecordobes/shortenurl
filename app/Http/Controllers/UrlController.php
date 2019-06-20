<?php

namespace App\Http\Controllers;

use App\Url;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Validators\UrlValidator;
use App\Http\Resources\Url as UrlResource;
use App\Http\Resources\Urls as UrlResourceCollection;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$top = Url::orderBy('count', 'desc')->limit(100)->get();

        return new UrlResourceCollection($top);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

		$data = $request->all();
		$validator = UrlValidator::storeValidator($data);
		
		if ($validator->fails()) {

			$response = [
				'code' => 400,
				'success' => false,
				'message' => 'Validation Fails',
				'data' => $data
			];
			
			return response()->json($response, 400); 
		}

        try {
    
			$short_url = Str::random(7);
			
			$title = explode('/', $request->input('url'));

            $url = new Url;
    
            $url->url = $request->input('url');
			$url->short_url = $short_url;
			$url->title = $title[2];
            $url->count = 0;
            $url->save();

            $response = [
				'code' => 200,
                'success' => true, 
                'message' => 'Your short url for '.$request->input('url').' is '. env('APP_URL') .'/'. $short_url,
                'data' => array(
                    'url' => $request->input('url'),
					'short_url' => $short_url, 
					'title' => $title[2],
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
