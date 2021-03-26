<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Google\Cloud\PubSub\PubSubClient;
use App\Http\Requests\PublishFormRequest;

class PublishController extends Controller
{
    public function store($topic, PublishFormRequest $request)
    {
    	$pubsub = new PubSubClient([
        	'projectId' => 'upbeat-element-308823',
        	'keyFilePath' => 'C:\Users\SchneiderShades\Projects\Laravel\pub\upbeat-element-308823-6ea8c52f15db.json',
    	]);

	    $pubsub->topic($topic)->publish([
            'data' => base64_encode($request->message),
        ]);

		return [
	    	'topic' => $request->topic,
			'data' => $request->message
	    ];
    }
}
