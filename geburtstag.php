<?php
require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;
use ThibaudDauce\Mattermost\Mattermost;
use ThibaudDauce\Mattermost\Message;
use ThibaudDauce\Mattermost\Attachment;

# config START
$mmWebhookUrl = 'https://YOUR_URL/hooks/YOUR_WEBHOOK_ID';
$mmChannel = 'YOUR_CHANNEL';
$mmUserName = 'YOUT_BOT_NAME';
$mmIcon = 'https://www.proudsourcing.de/images/stromberg2.jpeg';

$people['Hubert'] = '05.02.1998';
$people['Elfriede'] = '22.03.1991';
$people['Hans'] = '22.05.1985';
$people['Evi'] = '12.01.1980';
# config END

foreach($people as $name => $date) {
	$date2 = explode('.', $date);
	$date3 = $date2[0].$date2[1];
	if(date('dm') == $date3) {
		$mattermost = new Mattermost(new Client, $mmWebhookUrl);
		$message = (new Message)
			->text('')
			->channel($mmChannel)
			->username($mmUserName)
			->iconUrl($mmIcon)
			->attachment(function (Attachment $attachment) {
				global $name;
					$attachment->info()->text(':partying_face:  Happy Birthday **'.$name.'**  :partying_face:');
			});

		$mattermost->send($message);
	}
}