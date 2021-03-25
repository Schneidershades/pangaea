<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Enqueue\Gps\GpsConnectionFactory;

class SubscribeController extends Controller
{
    public function store($topic)
    {
		$connectionFactory = new GpsConnectionFactory();

		$context = $connectionFactory->createContext();

		$fooTopic = $context->createTopic('foo');

		// $message = $context->createMessage('Hello world!');

		// $context->declareTopic($fooTopic);

		// $context->createProducer()->send($fooTopic, $message);
    }
}
