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
    "altText" => "駐車場の縁石の修繕でよろしいでしょうか？（はい／いいえ）",
    "template" => [
        "type" => "confirm",
        "text" => "駐車場の縁石の修繕でよろしいでしょうか？",
	"actions" => [
            [
              "type" => "message",
              "label" => "はい",
              "text" => "はい、駐車場の縁石の修繕です"
            ],
            [
              "type" => "message",
              "label" => "いいえ",
              "text" => "いいえ　"
            ]
        ]
     ]
  ];
} else if ($text == 'はい、駐車場の縁石の修繕です' ) {
  $response_format_text = [
        "type" => "text",
        "text" => "症状を教えて下さい。",
  ];
} else if ($text == '縁石がずれている' ) {
  $response_format_text = [
        "type" => "text",
        "text" => "場所を教えて下さい。",
  ];
} else if ($text == '北側駐車場') {
  $response_format_text = [
    "type" => "template",
    "altText" => "依頼内容の復唱（はい／いいえ）",
    "template" => [
        "type" => "confirm",
        "text" => "依頼種別：修繕\n設備：駐車場の縁石\n症状：縁石がずれている\n場所：北側駐車場\n以上のご依頼でよろしいでしょうか？",
	"actions" => [
            [
              "type" => "message",
              "label" => "はい",
              "text" => "はい、そうです"
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
else if ($text == '修繕依頼・見積依頼') {
  $response_format_text = [
    "type" => "template",
    "altText" => "すぐに修繕をご希望の方は修繕依頼を、お見積り取得されてから検討の方が見積依頼を押して下さい。",
    "template" => [
      "type" => "confirm",
      "title" => "修繕依頼・見積依頼",
      "text" => "すぐに修繕をご希望の方は修繕依頼を、お見積り取得されてから検討の方が見積依頼を押して下さい。",
      "actions" => [
          [
            "type" => "message",
            "label" => "修繕依頼",
            "text" => "修繕依頼"
          ],
          [
            "type" => "message",
            "label" => "見積依頼",
            "text" => "見積依頼"
          ]
      ]
    ]
  ];
} else if ($text == '修繕依頼') {
  $response_format_text = [
    "type" => "template",
    "altText" => "対象機器を写真で送るか、選択肢よりお選びください。",
    "template" => [
      "type" => "buttons",
      "title" => "対象機器の選択",
      "text" => "対象機器を写真で送るか、選択肢よりお選びください。",
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
            "label" => "次の選択肢へ",
            "text" => "次の選択肢へ"
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
              "text" => "はい、行いました"
            ],
            [
              "type" => "message",
              "label" => "いいえ",
              "text" => "いいえ、行っていません"
            ]
        ]
    ]
  ];
} else if ($text == 'はい、行いました' ) {
  $response_format_text = [
        "type" => "text",
        "text" => "対象の機器の設置場所を教えて下さい。",
  ];
} else if ($text == '鮮魚コーナー' ) {
  $response_format_text = [
    "type" => "template",
    "altText" => "依頼内容の復唱（はい／いいえ）",
    "template" => [
        "type" => "confirm",
        "text" => "依頼種別：修繕\n設備：冷ケース平台\n症状：冷えない\n霜取り：済\n場所：鮮魚コーナー\n以上のご依頼でよろしいでしょうか？",
	"actions" => [
            [
              "type" => "message",
              "label" => "はい",
              "text" => "はい、そうです"
            ],
            [
              "type" => "message",
              "label" => "いいえ",
              "text" => "いいえ、違います"
            ]
        ]
    ]
  ];
} else if ($text == 'はい、そうです' ) {
  $response_format_text = [
        "type" => "text",
        "text" => "お問合せを受付ました、ありがとうございました。\n確認後、ご連絡させて頂きますので、お待ち下さい。\nその他の伝達事項がある場合は続けてご入力下さい。",
  ];
} else if ($text == '03-1234-5678') {
  $response_format_text = [
    "type" => "template",
    "altText" => "こちらの店舗でよろしいでしょうか？（はい／いいえ）",
    "template" => [
        "type" => "confirm",
        "text" => "ザイマックスマート 溜池山王店 様でよろしいでしょうか？",
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
        "text" => "ザイマックスマート 溜池山王店 様ご登録ありがとうございます。\n続けてお名前をご入力下さい。",
  ];
} else if ($text == '財満太郎' ) {
  $response_format_text = [
        "type" => "text",
        "text" => "財満太郎 様ご登録ありがとうございます。\nご依頼事項がある場合は、画面左下のボタンを押して頂き、「お問合せ」よりご登録下さい。",
  ];
} else if ($text == '進捗確認') {
  $response_format_text = [
    "type" => "template",
    "altText" => "確認したい案件の状況を選択して下さい。",
    "template" => [
      "type" => "buttons",
      "title" => "案件状態の選択",
      "text" => "確認したい案件の状況を選択して下さい。",
      "actions" => [
          [
            "type" => "message",
            "label" => "見積作成中",
            "text" => "見積作成中"
          ],
          [
            "type" => "message",
            "label" => "お客様確認中",
            "text" => "お客様確認中"
          ],
          [
            "type" => "message",
            "label" => "作業日調整中・確定",
            "text" => "作業日調整中・確定"
          ],
          [
            "type" => "message",
            "label" => "ひとまず上記全部",
            "text" => "ひとまず上記全部"
          ]
      ]
    ]
  ];
} else if ($text == '見積作成中') {
  $response_format_text = [
    "type" => "template",
    "altText" => "見積作成中の案件一覧。",
    "template" => [
      "type" => "confirm",
      "text" => "見積作成中の案件一覧はこちらです。\n1．受変電設備点検不備改修…12/12\n2．惣菜作業室 ファン更新…12/13\n3．消防設備点検不備改修…12/14\n4．ダクト消火設備休止対応…12/15\n\n以上で確認を終える場合は下記「確認完了」を、さらに詳細を確認したい場合は「詳細確認」を選択ください。",
      "actions" => [
          [
            "type" => "message",
            "label" => "確認完了",
            "text" => "確認完了"
          ],
	  [
            "type" => "message",
            "label" => "詳細問合せ",
            "text" => "詳細問合せ"
          ]
      ]
    ]
  ];
} else if ($text == '詳細問合せ' ) {
  $response_format_text = [
        "type" => "text",
        "text" => "案件の番号を入力下さい。",
  ];
} else if ($text == '1' ) {
  $response_format_text = [
        "type" => "text",
        "text" => "問合せ内容をご入力下さい。",
  ];
} else if ($text == '進捗を教えて下さい' ) {
  $response_format_text = [
        "type" => "text",
        "text" => "お問合せを受付ました、ありがとうございました。\n確認後、ご連絡させて頂きますので、お待ち下さい。",
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
