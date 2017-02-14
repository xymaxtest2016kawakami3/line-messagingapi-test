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
              "text" => "はい"
            ],
            [
              "type" => "message",
              "label" => "いいえ",
              "text" => "いいえ　"
            ]
        ]
     ]
  ];
} else if ($text == 'はい' ) {
  $response_format_text = [
        "type" => "text",
        "text" => "続けて、症状をご入力下さい。",
  ];
} else if ($text == '縁石がずれている' ) {
  $response_format_text = [
        "type" => "text",
        "text" => "最後に場所を教えて下さい。",
  ];
} else if ($text == '北側駐車場') {
  $response_format_text = [
    "type" => "template",
    "altText" => "依頼内容の復唱（はい／いいえ）",
    "template" => [
        "type" => "confirm",
        "text" => "以下のご依頼内容でよろしいでしょうか？依頼種別：修繕\n設備：駐車場の縁石\n症状：縁石がずれている\n場所：北側駐車場\n",
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
    "altText" => "すぐに修繕をご希望の方は修繕依頼を、お見積り取得されてから検討の方が見積依頼を押して下さい。（修繕依頼/見積依頼）",
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
    "altText" => "対象機器を写真で送るか、選択肢よりお選びください。（冷ケース/冷蔵/冷凍/空調/照明/次の選択肢へ）",
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
            "label" => "ここにはない",
            "text" => "ここにはない"
          ]
      ]
    ]
  ];
} else if ($text == 'ここにはない') {
  $response_format_text = [
    "type" => "template",
    "altText" => "こちらに対象はございますか？",
    "template" => [
      "type" => "buttons",
      "title" => "対象機器の選択２",
      "text" => "こちらに対象はございますか？",
      "actions" => [
          [
            "type" => "message",
            "label" => "ドア",
            "text" => "ドア"
          ],
          [
            "type" => "message",
            "label" => "トイレ",
            "text" => "トイレ"
          ],
          [
            "type" => "message",
            "label" => "その他（店内）壁・天井・床等",
            "text" => "その他（店内）壁・天井・床等"
          ],
          [
            "type" => "message",
            "label" => "その他（店外）外壁・駐車場・植栽等",
            "text" => "その他（店外）外壁・駐車場・植栽等"
          ]
      ]
    ]
  ];
} else if ($text == 'その他（店外）外壁・駐車場・植栽等' ) {
  $response_format_text = [
        "type" => "text",
        "text" => "具体的な対象を写真またはテキストでお送りください。",
  ];
} else if ($text == 'いいえ') {
  exit;
} else if ($text == '冷ケース/冷蔵/冷凍') {
  $response_format_text = [
    "type" => "template",
    "altText" => "選択肢から対象の機器をお選びください。（冷えない/ナイトカーテン破損/上記以外の症状）",
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
} else if ($text == '0312345678') {
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
} else if ($text == 'はい1' ) {
  $response_format_text = [
        "type" => "text",
        "text" => "ザイマックスマート 溜池山王店 様ご登録ありがとうございます。\n続けてお名前をご入力下さい。",
  ];
} else if ($text == '山田太郎' ) {
  $response_format_text = [
        "type" => "text",
        "text" => "山田太郎 様ご登録ありがとうございます。\nご依頼事項がある場合は、画面左下のボタンを押して頂き、「ご依頼はこちら」よりご登録下さい。",
  ];
} else if ($text == '進捗確認' ) {
  $response_format_text = [
        "type" => "text",
        "text" => "現在承っている案件は下記になります。\n1．受変電設備点検不備改修\n2．惣菜作業室 ファン更新\n3．消防設備点検不備改修\n4．ダクト消火設備休止対応\n5.畜産作業場フライヤー油循環不調修理\n6.スライサー動作不良修理\n\n進捗を確認されたい案件の番号をご入力下さい。",
  ];
} else if ($text == '2') {
  $response_format_text = [
    "type" => "template",
    "altText" => "案件情報と担当者からの連絡",
    "template" => [
        "type" => "confirm",
        "text" => "2．惣菜作業室 ファン更新　は作業予定日を調整中です。\n担当者からの連絡をご希望ですか？",
	"actions" => [
            [
              "type" => "message",
              "label" => "はい",
              "text" => "はい、希望します"
            ],
            [
              "type" => "message",
              "label" => "いいえ",
              "text" => "いいえ、希望しません"
            ]
        ]
    ]
  ];
} else if ($text == 'はい、希望します') {
  $response_format_text = [
    "type" => "template",
    "altText" => "担当者への追加連絡事項",
    "template" => [
        "type" => "confirm",
        "text" => "本案件に関して、担当者に先にお伝えしておきたい事はございますか？",
	"actions" => [
            [
              "type" => "message",
              "label" => "はい",
              "text" => "はい、あります"
            ],
            [
              "type" => "message",
              "label" => "いいえ",
              "text" => "いいえ、ありません"
            ]
        ]
    ]
  ];
} else if ($text == 'はい、あります' ) {
  $response_format_text = [
        "type" => "text",
        "text" => "ご伝達事項をご入力下さい。",
  ];
} else if ($text == '作業日はいつですか？' ) {
  $response_format_text = [
        "type" => "text",
        "text" => "内容を承りました、ありがとうございました。\n担当者からの連絡をお待ちください。",
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
