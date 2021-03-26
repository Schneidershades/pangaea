<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Enqueue\Gps\GpsConnectionFactory;

class SubscribeController extends Controller
{
    public function store($topic)
    {
		// $connectionFactory = new GpsConnectionFactory();

		// $context = $connectionFactory->createContext();

		// $context->createTopic('foo1');

		// $context->declareTopic('foo1');

		// $ine = $context->createProducer()->send($fooTopic, 'cenicnei');

		// dd($ine);

		// $message = $context->createMessage('Hello world!');

		// $context->declareTopic($fooTopic);

		// $context->createProducer()->send($fooTopic, $message);
		//
		$context = (new GpsConnectionFactory(
			// "gps:"
			[
	    		'projectId'   => "upbeat-element-308823",
	    		'keyFilePath' => "C:\Users\SchneiderShades\Projects\Laravel\pub\key57139e419a13.json",
	    		'retries'     => 3,
	    		'scopes'      => "Scopes to be used for the request.",
	    		// 'emulatorHost' => "http://localhost:9000",
	    		'lazy'        => "",
	  		]
	  	))->createContext();

		$fooTopic = $context->createTopic('foo');
		$message = $context->createMessage('Hello world!');

		$context->declareTopic($fooTopic);

		$rr = $context->createProducer()->send($fooTopic, $message);

		dd($rr);
    }
}
