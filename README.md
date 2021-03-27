## Pangaea PubSub HTTP Notification

Creating a HTTP notification system. A server (or set of servers) will keep track of topics subscribers where a topic is a string and a subscriber is an HTTP endpoint. When a message is published on a topic, it
should be forwarded to all subscriber endpoints.

## Publisher Server Endpoints

Create a subscription

POST /subscribe/{topic}

Expected Body
{ url: string }

Success Response

{url: string, topic: string }

Example Request / Response

Pangaea Take-home assignment


POST /subscribe/topic1
Body
{ url: "http://mysubscriber.test" }

Response:
{ url: "http://mysubscriber.test", topic: "topic1"}

Publish message to topic

POST /publish/{topic}


## Steps
- clone the project https://github.com/Schneidershades/pangaea.git
- Go to the directory of the project via your nodejs/command line directory and type "Composer Install"
- Run "php artisan serve"
- Download **[Cloud SDK installer](https://dl.google.com/dl/cloudsdk/channels/rapid/GoogleCloudSDKInstaller.exe)** and install
- Open the app and type gcloud components install pubsub-emulator gcloud components update to install components
- gcloud beta emulators pubsub start --project=upbeat-element-308823 --host-port=127.0.0.1:9000
- begin hitting your end point via the route of your project

## Expected Response

Should give a meaningful HTTP response code based on whether the publish was successful or not

Payload sent to subscribers
{
topic: string
data: object // whatever data was sent in the publish body
}

Full Examples:
./start-server.sh
curl -X POST -H "Content-Type: application/json" -d '{ "url": "http://localhost:9000/test1"}' http://localhost:8000/subscribe/topic1
curl -X POST -H "Content-Type: application/json" -d '{ "url": "http://localhost:9000/test2"}' http://localhost:8000/subscribe/topic1
curl -X POST -H "Content-Type: application/json" -d '{"message": "hello"}' http://localhost:8000/publish/topic1

The above example assumes that the start-server.sh script starts the publisher server on port 8000 and another
server is running on port 9000 (subscriber). The subscriber will be getting data forwarded to it when its
corresponding topic is published, which it will then receive and print the data to verify everything is working at the
test1 and test2 endpoints.

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
