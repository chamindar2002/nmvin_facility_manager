<?php
CMSMS::sendMessage('0', 'Test message');

class CMSMS
{
  static public function buildMessageXml($recipient, $message) {
    $xml = new SimpleXMLElement('<MESSAGES/>');

    $authentication = $xml->addChild('AUTHENTICATION');
    $authentication->addChild('PRODUCTTOKEN', 'de7c7df3-81ca-4d1e-863d-95a252120321');

    $msg = $xml->addChild('MSG');
    $msg->addChild('FROM', 'My company');
    $msg->addChild('TO', $recipient);
    $msg->addChild('BODY', $message);

    return $xml->asXML();
  }

  static public function sendMessage($recipient, $message) {
    $xml = self::buildMessageXml($recipient, $message);

    $ch = curl_init(); // cURL v7.18.1+ and OpenSSL 0.9.8j+ are required
    curl_setopt_array($ch, array(
        CURLOPT_URL            => 'https://sgw01.cm.nl/gateway.ashx',
        CURLOPT_HTTPHEADER     => array('Content-Type: application/xml'),
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $xml,
        CURLOPT_RETURNTRANSFER => true
      )
    );

    $response = curl_exec($ch);

    curl_close($ch);

    return $response;
  }
}
?>
