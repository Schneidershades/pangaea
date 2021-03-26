<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscribeFormRequest;
use Google\Cloud\PubSub\PubSubClient;

class SubscribeController extends Controller
{
	public function store($topic, SubscribeFormRequest $request)
    {
    	$pubsub = new PubSubClient([
        	'projectId' => 'upbeat-element-308823',
        	'keyFilePath' => 'C:\Users\SchneiderShades\Projects\Laravel\pub\upbeat-element-308823-6ea8c52f15db.json',
    	]);

        $item = $pubsub->createTopic($topic);
        $subscription = $item->subscription($topic);
	    $subscription->create([
	        'pushConfig' => ['pushEndpoint' => $request->url]
	    ]);

	    return [
	    	'url' => $request->url,
			'topic' => $topic
	    ];

	    return $this->showMessage($data);
    }
}
