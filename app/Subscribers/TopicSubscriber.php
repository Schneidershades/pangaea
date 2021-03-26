<?php

namespace App\Subscribers;

use GDGTangier\PubSub\Subscriber\SubscriberJob;
use GDGTangier\PubSub\Subscriber\Traits\JobHandler;

class TopicSubscriber
{
    use JobHandler;

    /**
     * @var mixed
     */
    public $payload;

    /**
     * @var \GDGTangier\PubSub\Subscriber\SubscriberJob
     */
    public $job;

    /**
     * TopicSubscriber constructor.
     *
     * @param \GDGTangier\PubSub\Subscriber\SubscriberJob $job
     * @param $payload
     */
    public function __construct(SubscriberJob $job, $payload)
    {
        $this->job = $job;
        $this->payload = $payload;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
