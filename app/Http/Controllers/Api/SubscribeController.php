<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscribeFormRequest;
use Google\Cloud\PubSub\PubSubClient;
use Enqueue\Gps\GpsConnectionFactory;
use App\Subscribers\InitiateSubscriber;

class SubscribeController extends Controller
{
	public function store($topic, SubscribeFormRequest $request)
    {
        putenv('PUBSUB_EMULATOR_HOST=localhost:9000');

    	$pubsub = new PubSubClient([
        	'projectId' => config('queue.connections.pubsub.credentials.projectId'),
        	'keyFilePath' => config('queue.connections.pubsub.credentials.keyFilePath'),
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
