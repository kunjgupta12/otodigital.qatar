<?php
    // Update the path below to your autoload.php,
    // see https://getcomposer.org/doc/01-basic-usage.md
    require_once '/path/to/vendor/autoload.php';
    use Twilio\Rest\Client;

    $sid    = "ACf450e96b59d0d9b204ac92430974067f";
    $token  = "[AuthToken]";
    $twilio = new Client($sid, $token);

    $message = $twilio->messages
      ->create("whatsapp:+917004612170", // to
        array(
          "from" => "whatsapp:+14155238886",
          "body" => Your Yummy Cupcakes Company order of 1 dozen frosted cupcakes has shipped and should be delivered on July 10, 2019. Details: http://www.yummycupcakes.com/
        )
      );

print($message->sid);




201 - CREATED - The request was successful. We created a new resource and the response body contains the representation.
{
  "body": "Your Yummy Cupcakes Company order of 1 dozen frosted cupcakes has shipped and should be delivered on July 10, 2019. Details: http://www.yummycupcakes.com/",
  "num_segments": "1",
  "direction": "outbound-api",
  "from": "whatsapp:+14155238886",
  "date_updated": "Tue, 12 Dec 2023 06:02:15 +0000",
  "price": null,
  "error_message": null,
  "uri": "/2010-04-01/Accounts/ACf450e96b59d0d9b204ac92430974067f/Messages/SM368be03b377e65584c6a26f0bf804805.json",
  "account_sid": "ACf450e96b59d0d9b204ac92430974067f",
  "num_media": "0",
  "to": "whatsapp:+917004612170",
  "date_created": "Tue, 12 Dec 2023 06:02:15 +0000",
  "status": "queued",
  "sid": "SM368be03b377e65584c6a26f0bf804805",
  "date_sent": null,
  "messaging_service_sid": null,
  "error_code": null,
  "price_unit": null,
  "api_version": "2010-04-01",
  "subresource_uris": {
    "media": "/2010-04-01/Accounts/ACf450e96b59d0d9b204ac92430974067f/Messages/SM368be03b377e65584c6a26f0bf804805/Media.json"
  }
}




<?php
    // Update the path below to your autoload.php,
    // see https://getcomposer.org/doc/01-basic-usage.md
    require_once '/path/to/vendor/autoload.php';
    use Twilio\Rest\Client;

    $sid    = "ACf450e96b59d0d9b204ac92430974067f";
    $token  = "[AuthToken]";
    $twilio = new Client($sid, $token);

    $message = $twilio->messages
      ->create("whatsapp:+917004612170", // to
        array(
          "from" => "whatsapp:+14155238886",
          "body" => "Your Message"
        )
      );

print($message->sid);