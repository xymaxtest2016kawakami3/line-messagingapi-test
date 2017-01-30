<?php
$accessToken = getenv('LINE_CHANNEL_ACCESS_TOKEN');


//���[�U�[����̃��b�Z�[�W�擾
$json_string = file_get_contents('php://input');
$jsonObj = json_decode($json_string);

$type = $jsonObj->{"events"}[0]->{"message"}->{"type"};
//���b�Z�[�W�擾
$text = $jsonObj->{"events"}[0]->{"message"}->{"text"};
//ReplyToken�擾
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};

//���b�Z�[�W�ȊO�̂Ƃ��͉����Ԃ����I��
//if($type != "text"){
//	exit;
//}

if ($type == "image" ) {
  $response_format_text = [
    "type" => "template",
    "altText" => "���ԏ�̉��΂̏C�U�ł�낵���ł��傤���H�i�͂��^�������j",
    "template" => [
        "type" => "confirm",
        "text" => "���ԏ�̉��΂̏C�U�ł�낵���ł��傤���H",
	"actions" => [
            [
              "type" => "message",
              "label" => "�͂�",
              "text" => "�͂��@"
            ],
            [
              "type" => "message",
              "label" => "������",
              "text" => "�������@"
            ]
        ]
     ]
  ];
} else if ($text == '�͂��@' ) {
  $response_format_text = [
        "type" => "text",
        "text" => "�Ώۂ̏ꏊ�������ĉ������B",
  ];
} else if ($text == '�k�����ԏ�') {
  $response_format_text = [
    "type" => "template",
    "altText" => "�k�����ԏ�̒��ԏ�̉��΂̏C�U�ł�낵���ł��傤���H�i�͂��^�������j",
    "template" => [
        "type" => "confirm",
        "text" => "�k�����ԏ�̒��ԏ�̉��΂̏C�U�ł�낵���ł��傤���H",
	"actions" => [
            [
              "type" => "message",
              "label" => "�͂�",
              "text" => "�͂��@�@"
            ],
            [
              "type" => "message",
              "label" => "������",
              "text" => "�������@�@"
            ]
        ]
    ]
  ];
}

//�ԐM�f�[�^�쐬
else if ($text == '�C�U�˗��E���ψ˗�') {
  $response_format_text = [
    "type" => "template",
    "altText" => "�����ɏC�U������]�̕��͏C�U�˗����A�����ς�擾����Ă��猟���̕������ψ˗��������ĉ������B",
    "template" => [
      "type" => "confirm",
      "title" => "�C�U�˗��E���ψ˗�",
      "text" => "�����ɏC�U������]�̕��͏C�U�˗����A�����ς�擾����Ă��猟���̕������ψ˗��������ĉ������B",
      "actions" => [
          [
            "type" => "message",
            "label" => "�C�U�˗�",
            "text" => "�C�U�˗�"
          ],
          [
            "type" => "message",
            "label" => "���ψ˗�",
            "text" => "���ψ˗�"
          ]
      ]
    ]
  ];
} else if ($text == '�C�U�˗�') {
  $response_format_text = [
    "type" => "template",
    "altText" => "�Ώۋ@����ʐ^�ő��邩�A�I������肨�I�т��������B",
    "template" => [
      "type" => "buttons",
      "title" => "�Ώۋ@��̑I��",
      "text" => "�Ώۋ@����ʐ^�ő��邩�A�I������肨�I�т��������B",
      "actions" => [
          [
            "type" => "message",
            "label" => "��P�[�X/�①/�Ⓚ",
            "text" => "��P�[�X/�①/�Ⓚ"
          ],
          [
            "type" => "message",
            "label" => "��",
            "text" => "��"
          ],
          [
            "type" => "message",
            "label" => "�Ɩ�",
            "text" => "�Ɩ�"
          ],
          [
            "type" => "message",
            "label" => "���̑I������",
            "text" => "���̑I������"
          ]
      ]
    ]
  ];
} else if ($text == '������') {
  exit;
} else if ($text == '��P�[�X/�①/�Ⓚ') {
  $response_format_text = [
    "type" => "template",
    "altText" => "�I��������Ώۂ̋@������I�т��������B",
    "template" => [
      "type" => "carousel",
      "columns" => [
          [
            "thumbnailImageUrl" => "https://" . $_SERVER['SERVER_NAME'] . "/img2-1.jpg",
            "title" => "��P�[�X�@����^",
            "text" => "�Ώۋ@�킪�u��P�[�X����^�v�̏ꍇ�͉��L�Ǐ󂩂炨�I�щ�����",
            "actions" => [
              [
                  "type" => "message",
                  "label" => "�₦�Ȃ�",
                  "text" => "��P�[�X���䂪�₦�܂���"
              ],
              [
                  "type" => "message",
                  "label" => "�i�C�g�J�[�e���j��",
                  "text" => "��P�[�X���䂪�i�C�g�J�[�e���j��"
              ],
              [
                  "type" => "message",
                  "label" => "��L�ȊO�̏Ǐ�",
                  "text" => "��P�[�X���䂪�ʂ̏Ǐ�"
              ]
            ]
          ],
          [
            "thumbnailImageUrl" => "https://" . $_SERVER['SERVER_NAME'] . "/img2-2.jpg",
            "title" => "��P�[�X�@���i�^",
            "text" => "�Ώۋ@�킪�u��P�[�X���i�^�v�̏ꍇ�͉��L�Ǐ󂩂炨�I�щ�����",
            "actions" => [
              [
                  "type" => "message",
                  "label" => "�₦�Ȃ�",
                  "text" => "��P�[�X���i���₦�܂���"
              ],
              [
                  "type" => "message",
                  "label" => "�i�C�g�J�[�e���j��",
                  "text" => "��P�[�X���i���i�C�g�J�[�e���j��"
              ],
              [
                  "type" => "message",
                  "label" => "��L�ȊO�̏Ǐ�",
                  "text" => "��P�[�X���i���ʂ̏Ǐ�"
              ]
            ]
          ],
          [
            "thumbnailImageUrl" => "https://" . $_SERVER['SERVER_NAME'] . "/img2-3.jpg",
            "title" => "��P�[�X�@���[�`�C���^",
            "text" => "�Ώۋ@�킪�u��P�[�X���[�`�C���^�v�̏ꍇ�͉��L�Ǐ󂩂炨�I�щ�����",
            "actions" => [
              [
                  "type" => "message",
                  "label" => "�₦�Ȃ�",
                  "text" => "��P�[�X���[�`�C�����₦�܂���"
              ],
              [
                  "type" => "message",
                  "label" => "�i�C�g�J�[�e���j��",
                  "text" => "��P�[�X���[�`�C�����i�C�g�J�[�e���j��"
              ],
              [
                  "type" => "message",
                  "label" => "��L�ȊO�̏Ǐ�",
                  "text" => "��P�[�X���[�`�C�����ʂ̏Ǐ�"
              ]
            ]
          ]
      ]
    ]
  ];
} else if ($text == '��P�[�X���䂪�₦�܂���') {
  $response_format_text = [
    "type" => "template",
    "altText" => "�����͍s���܂������H�i�͂��^�������j",
    "template" => [
        "type" => "confirm",
        "text" => "�����͍s���܂������H",
	"actions" => [
            [
              "type" => "message",
              "label" => "�͂�",
              "text" => "�͂��A�s���܂����B"
            ],
            [
              "type" => "message",
              "label" => "������",
              "text" => "�������A�s���Ă��܂���B"
            ]
        ]
    ]
  ];
} else if ($text == '�͂��A�s���܂����B' ) {
  $response_format_text = [
        "type" => "text",
        "text" => "�Ώۂ̋@��̐ݒu�ꏊ�������ĉ������B",
  ];
} else if ($text == '�N���R�[�i�[' ) {
  $response_format_text = [
    "type" => "template",
    "altText" => "�N���R�[�i�[�̗�P�[�X���䂪�₦�Ȃ��Ǐ�̑Ή��ł�낵���ł��傤���H�i�͂��^�������j",
    "template" => [
        "type" => "confirm",
        "text" => "�N���R�[�i�[�̗�P�[�X���䂪�₦�Ȃ��Ǐ�̑Ή��ł�낵���ł��傤���H",
	"actions" => [
            [
              "type" => "message",
              "label" => "�͂�",
              "text" => "�͂��A�����ł��B"
            ],
            [
              "type" => "message",
              "label" => "������",
              "text" => "�������A�Ⴂ�܂��B"
            ]
        ]
    ]
  ];
} else if ($text == '�͂��A�����ł��B' ) {
  $response_format_text = [
        "type" => "text",
        "text" => "���⍇������t�܂����A���肪�Ƃ��������܂����B\n�m�F��A���A�������Ē����܂��̂ŁA���҂��������B\n���̑��̓`�B����������ꍇ�͑����Ă����͉������B",
  ];
} else if ($text == '03-1234-5678') {
  $response_format_text = [
    "type" => "template",
    "altText" => "������̓X�܂ł�낵���ł��傤���H�i�͂��^�������j",
    "template" => [
        "type" => "confirm",
        "text" => "�U�C�}�b�N�X�}�[�g ���r�R���X �l�ł�낵���ł��傤���H",
	"actions" => [
            [
              "type" => "message",
              "label" => "�͂�",
              "text" => "�͂�"
            ],
            [
              "type" => "message",
              "label" => "������",
              "text" => "������"
            ]
        ]
    ]
  ];
} else if ($text == '�͂�' ) {
  $response_format_text = [
        "type" => "text",
        "text" => "�U�C�}�b�N�X�}�[�g ���r�R���X �l���o�^���肪�Ƃ��������܂��B\n�����Ă����O�������͉������B",
  ];
} else if ($text == '�������Y' ) {
  $response_format_text = [
        "type" => "text",
        "text" => "�������Y �l���o�^���肪�Ƃ��������܂��B\n���˗�����������ꍇ�́A��ʍ����̃{�^���������Ē����A�u���⍇���v��育�o�^�������B",
  ];
} else if ($text == '�i���m�F') {
  $response_format_text = [
    "type" => "template",
    "altText" => "�m�F�������Č��̏󋵂�I�����ĉ������B",
    "template" => [
      "type" => "buttons",
      "title" => "�Č���Ԃ̑I��",
      "text" => "�m�F�������Č��̏󋵂�I�����ĉ������B",
      "actions" => [
          [
            "type" => "message",
            "label" => "���ύ쐬��",
            "text" => "���ύ쐬��"
          ],
          [
            "type" => "message",
            "label" => "���q�l�m�F��",
            "text" => "���q�l�m�F��"
          ],
          [
            "type" => "message",
            "label" => "��Ɠ��������E�m��",
            "text" => "��Ɠ��������E�m��"
          ],
          [
            "type" => "message",
            "label" => "�ЂƂ܂���L�S��",
            "text" => "�ЂƂ܂���L�S��"
          ]
      ]
    ]
  ];
} else if ($text == '���ύ쐬��') {
  $response_format_text = [
    "type" => "template",
    "altText" => "���ύ쐬���̈Č��ꗗ�B",
    "template" => [
      "type" => "confirm",
      "text" => "���ύ쐬���̈Č��ꗗ�͂�����ł��B\n1�D��ϓd�ݔ��_���s�����C�c12/12\n2�D�y�؍�Ǝ� �t�@���X�V�c12/13\n3�D���h�ݔ��_���s�����C�c12/14\n4�D�_�N�g���ΐݔ��x�~�Ή��c12/15\n\n�ȏ�Ŋm�F���I����ꍇ�͉��L�u�m�F�����v���A����ɏڍׂ��m�F�������ꍇ�́u�ڍ׊m�F�v��I�����������B",
      "actions" => [
          [
            "type" => "message",
            "label" => "�m�F����",
            "text" => "�m�F����"
          ],
	  [
            "type" => "message",
            "label" => "�ڍ׊m�F",
            "text" => "�ڍ׊m�F"
          ]
      ]
    ]
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
