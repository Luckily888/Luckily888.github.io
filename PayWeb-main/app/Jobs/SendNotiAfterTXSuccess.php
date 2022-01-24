<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\AndroidConfig;
use Kreait\Firebase\Messaging\ApnsConfig;
use Kreait\Firebase\Messaging\CloudMessage;
use Log;
use MrShan0\PHPFirestore\FirestoreClient;

class SendNotiAfterTXSuccess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $title;
    protected $body;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $title, $body)
    {
        $this->email = $email;
        $this->title = $title;
        $this->body = $body;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $userEmail = $this->email;

        $data = [
            'balance_update'=>1,
            "click_action"=> "FLUTTER_NOTIFICATION_CLICK",
        ];
        try{
            $factory = (new Factory())
                ->withServiceAccount(storage_path('multicompany-5eda2-firebase-adminsdk-iyqsp-bb6b898167.json'));

            // project-id => multicompany-5eda2
            // api-id => AIzaSyAiDZetNg52jlzCfhAW1yBzJQqFQOE7NOk
            $firestoreClient = new FirestoreClient('multicompany-5eda2', 'AIzaSyAiDZetNg52jlzCfhAW1yBzJQqFQOE7NOk', [
                'database' => '(default)',
            ]);
            $dtDocuments = $firestoreClient->listDocuments('device_tokens');
            $userDevice = null;
            foreach ($dtDocuments['documents'] as $dtDocument){
                $dtDocumentArr = $dtDocument->toArray();
                if ($dtDocumentArr['email'] == $userEmail){
                    $userDevice = $dtDocumentArr;
                }
            }

            if (is_null($userDevice)){
                Log::info('not_found_user_token email:'.$userEmail);
                return;
            }

            // check if user mobile is android use android config
            if (strtolower($userDevice['platform']) == 'android'){
                $messaging = $factory->createMessaging();
                $message = CloudMessage::withTarget('token', $userDevice['token'])
                    ->withData($data);
                $config = AndroidConfig::fromArray([
                    'ttl' => '3600s',
                    'priority' => 'normal',
                    'notification' => [
                        'title' => $this->title,
                        'body' => $this->body,
                        'color' => '#f45342',
                        "click_action"=> "FLUTTER_NOTIFICATION_CLICK",
                        'notification_count' =>1
                    ],
                ]);
                $message = $message->withAndroidConfig($config);
                $messaging->send($message);
            }
            // if ios
            elseif(strtolower($userDevice['platform']) == 'ios'){
                $messaging = $factory->createMessaging();
                // ปัญหาของ ios คือ notification จะไม่ได้อยู่ใน {data: { balance_update:1 } } ดังนั้นต้องเช็คใน mobile แบบไม่มี data
                // {from: 781290381418, click_action: FLUTTER_NOTIFICATION_CLICK, balance_update: 1}
                $message = CloudMessage::withTarget('token', $userDevice['token'])
                    ->withData($data);
                $config = ApnsConfig::fromArray([
                    'headers' => [
                        'apns-priority' => '10',
                    ],
                    'payload' => [
                        'aps' => [
                            'alert' => [
                                'title' => $this->title,
                                'body' => $this->body,
                            ],
                            'badge' => 1,
                        ],
                    ],
                ]);
                $message = $message->withApnsConfig($config);
                $messaging->send($message);
            }
        }catch (\Exception $e){
            Log::info('SendNotiAfterTXSuccess failed ' . $e->getMessage(), $data);
        }

    }
}
