<?php
$accessToken = getenv('LINE_CHANNEL_ACCESS_TOKEN');


//ユーザーからのメッセージ取得
$json_string = file_get_contents('php://input');
$jsonObj = json_decode($json_string);

$type = $jsonObj->{"events"}[0]->{"message"}->{"type"};
//メッセージ取得
$text = $jsonObj->{"events"}[0]->{"message"}->{"text"};
//ReplyToken取得
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};

//メッセージ以外のときは何も返さず終了
//if($type != "text"){
//	exit;
//}

if ($type == "image" ) {
  $response_format_text = [
    "type" => "template",
    "altText" => "誘導灯ですね？（はい／いいえ）",
    "template" => [
        "type" => "confirm",
        "text" => "誘導灯でよろしいでしょうか？",
	"actions" => [
            [
              "type" => "message",
              "label" => "はい",
              "text" => "はい"
            ],
            [
              "type" => "message",
              "label" => "いいえ",
              "text" => "いいえ"
            ]
        ]
     ]
  ];
}

//返信データ作成
else if ($text == '修繕依頼') {
  $response_format_text = [
    "type" => "template",
    "altText" => "対象機器を写真で送るか、選択肢からお選びください。",
    "template" => [
      "type" => "buttons",
      "title" => "対象機器の選択",
      "text" => "対象機器を写真で送るか、選択肢からお選びください。",
      "actions" => [
          [
            "type" => "message",
            "label" => "冷ケース/冷蔵/冷凍",
            "text" => "冷ケース/冷蔵/冷凍"
          ],
          [
            "type" => "message",
            "label" => "空調",
            "text" => "空調"
          ],
          [
            "type" => "message",
            "label" => "照明",
            "text" => "照明"
          ],
          [
            "type" => "message",
            "label" => "ここには無い",
            "text" => "ここには無い"
          ]
      ]
    ]
  ];
} else if ($text == 'いいえ') {
  exit;
} else if ($text == '冷ケース/冷蔵/冷凍') {
  $response_format_text = [
    "type" => "template",
    "altText" => "選択肢から対象の機器をお選びください。",
    "template" => [
      "type" => "carousel",
      "columns" => [
          [
            "thumbnailImageUrl" => "https://" . $_SERVER['SERVER_NAME'] . "/img2-1.jpg",
            "title" => "冷ケース　平台型",
            "text" => "対象機器が「冷ケース平台型」の場合は下記症状からお選び下さい",
            "actions" => [
              [
                  "type" => "message",
                  "label" => "冷えない",
                  "text" => "冷ケース平台が冷えません"
              ],
              [
                  "type" => "message",
                  "label" => "ナイトカーテン破損",
                  "text" => "冷ケース平台がナイトカーテン破損"
              ],
              [
                  "type" => "message",
                  "label" => "上記以外の症状",
                  "text" => "冷ケース平台が別の症状"
              ]
            ]
          ],
          [
            "thumbnailImageUrl" => "https://" . $_SERVER['SERVER_NAME'] . "/img2-2.jpg",
            "title" => "冷ケース　多段型",
            "text" => "対象機器が「冷ケース多段型」の場合は下記症状からお選び下さい",
            "actions" => [
              [
                  "type" => "message",
                  "label" => "冷えない",
                  "text" => "冷ケース多段が冷えません"
              ],
              [
                  "type" => "message",
                  "label" => "ナイトカーテン破損",
                  "text" => "冷ケース多段がナイトカーテン破損"
              ],
              [
                  "type" => "message",
                  "label" => "上記以外の症状",
                  "text" => "冷ケース多段が別の症状"
              ]
            ]
          ],
          [
            "thumbnailImageUrl" => "https://" . $_SERVER['SERVER_NAME'] . "/img2-3.jpg",
            "title" => "冷ケース　リーチイン型",
            "text" => "対象機器が「冷ケースリーチイン型」の場合は下記症状からお選び下さい",
            "actions" => [
              [
                  "type" => "message",
                  "label" => "冷えない",
                  "text" => "冷ケースリーチインが冷えません"
              ],
              [
                  "type" => "message",
                  "label" => "ナイトカーテン破損",
                  "text" => "冷ケースリーチインがナイトカーテン破損"
              ],
              [
                  "type" => "message",
                  "label" => "上記以外の症状",
                  "text" => "冷ケースリーチインが別の症状"
              ]
            ]
          ]
      ]
    ]
  ];
} else if ($text == '冷ケース平台が冷えません') {
  $response_format_text = [
    "type" => "template",
    "altText" => "霜取りは行いましたか？（はい／いいえ）",
    "template" => [
        "type" => "confirm",
        "text" => "霜取りは行いましたか？",
	"actions" => [
            [
              "type" => "message",
              "label" => "はい",
              "text" => "はい、行いました。"
            ],
            [
              "type" => "message",
              "label" => "いいえ",
              "text" => "いいえ、行っていません。"
            ]
        ]
    ]
  ];
} else if ($text == 'はい、行いました。' ) {
  $response_format_text = [
        "type" => "text",
        "text" => "対象の機器の設置場所を教えて下さい。",
  ];
} else if ($text == '鮮魚コーナー' ) {
  $response_format_text = [
    "type" => "template",
    "altText" => "鮮魚コーナーの冷ケース平台が冷えない症状の対応でよろしいでしょうか？（はい／いいえ）",
    "template" => [
        "type" => "confirm",
        "text" => "鮮魚コーナーの冷ケース平台が冷えない症状の対応でよろしいでしょうか？",
	"actions" => [
            [
              "type" => "message",
              "label" => "はい",
              "text" => "はい、そうです。"
            ],
            [
              "type" => "message",
              "label" => "いいえ",
              "text" => "いいえ、違います。"
            ]
        ]
    ]
  ];
} else if ($text == 'はい、そうです。' ) {
  $response_format_text = [
        "type" => "text",
        "text" => "お問合せを受付ました、ありがとうございました。\n確認後、ご連絡させて頂きますので、お待ち下さい。\nその他の伝達事項がある場合は続けてご入力下さい。",
  ];
} else if ($text == '03-5544-6630') {
  $response_format_text = [
    "type" => "template",
    "altText" => "こちらの店舗でよろしいでしょうか？（はい／いいえ）",
    "template" => [
        "type" => "confirm",
        "text" => "カワカミマート 溜池山王店 様でよろしいでしょうか？",
	"actions" => [
            [
              "type" => "message",
              "label" => "はい",
              "text" => "はい"
            ],
            [
              "type" => "message",
              "label" => "いいえ",
              "text" => "いいえ"
            ]
        ]
    ]
  ];
} else if ($text == 'はい' ) {
  $response_format_text = [
        "type" => "text",
        "text" => "カワカミマート 溜池山王店 様ご登録ありがとうございます。\n続けてお名前をご入力下さい。",
  ];
} else if ($text == '川上智也' ) {
  $response_format_text = [
        "type" => "text",
        "text" => "川上智也 様ご登録ありがとうございます。\nご依頼事項がある場合は、「お問合せ」よりご登録下さい。",
  ];
} 


$post_data = [
	"replyToken" => $replyToken,
	"messages" => [$response_format_text]
	];

$ch = curl_init("https://api.line.me/v2/bot/message/reply");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json; charser=UTF-8',
    'Authorization: Bearer ' . $accessToken
    ));
$result = curl_exec($ch);
curl_close($ch);
