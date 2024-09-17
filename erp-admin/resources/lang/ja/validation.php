<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages.
    |
    */
    'accepted'        => ':attributeを承認してください。',
    'active_url'      => ':attributeは、有効なURLではありません。',
    'after'           => ':attributeには、:dateより後の日付を指定してください。',
    'after_or_equal'  => ':attributeには、:date以降の日付を指定してください。',
    'alpha'           => ':attributeには、アルファベッドのみ使用できます。',
    'alpha_dash'      => ":attributeには、英数字('A-Z','a-z','0-9')とハイフンと下線('-','_')が使用できます。",
    'alpha_num'       => ":attributeには、英数字('A-Z','a-z','0-9')が使用できます。",
    'array'           => ':attributeには、配列を指定してください。',
    'before'          => ':attributeには、:dateより前の日付を指定してください。',
    'before_or_equal' => ':attributeには、:date以前の日付を指定してください。',
    'between'         => [
        'numeric' => ':attributeには、:minから、:maxまでの数字を指定してください。',
        'file'    => ':attributeには、:min KBから:max KBまでのサイズのファイルを指定してください。',
        'string'  => ':attributeは、:min文字から:max文字にしてください。',
        'array'   => ':attributeの項目は、:min個から:max個にしてください。',
    ],
    'boolean'              => ":attributeには、'true'か'false'を指定してください。",
    'confirmed'            => ':attributeと:attribute確認が一致しません。',
    'date'                 => ':attributeは、正しい日付ではありません。',
    'date_equals'          => ':attributeは:dateに等しい日付でなければなりません。',
    'date_format'          => ":attributeの形式は、':format'と合いません。",
    'different'            => ':attributeと:otherには、異なるものを指定してください。',
    'digits'               => ':attributeは、:digits桁にしてください。',
    'digits_between'       => ':attributeは、:min桁から:max桁にしてください。',
    'dimensions'           => ':attributeの画像サイズが無効です',
    'distinct'             => ':attributeの値が重複しています。',
    'email'                => ':attributeは、有効なメールアドレス形式で指定してください。',
    'exists'               => '選択された:attributeは、有効ではありません。',
    'file'                 => ':attributeはファイルでなければいけません。',
    'filled'               => ':attributeは必須です。',
    'gt'                   => [
        'numeric' => ':attributeは、:valueより大きくなければなりません。',
        'file'    => ':attributeは、:value KBより大きくなければなりません。',
        'string'  => ':attributeは、:value文字より大きくなければなりません。',
        'array'   => ':attributeの項目数は、:value個より大きくなければなりません。',
    ],
    'gte'                  => [
        'numeric' => ':attributeは、:value以上で入力してください。',
        'file'    => ':attributeは、:value KB以上を選択してください。',
        'string'  => ':attributeは、:value文字以上で入力してください。',
        'array'   => ':attributeの項目数は、:value個以上で選択してください。',
    ],
    'image'                => ':attributeには、画像を指定してください。',
    'in'                   => '選択された:attributeは、有効ではありません。',
    'in_array'             => ':attributeが:otherに存在しません。',
    'integer'              => ':attributeには、整数を指定してください。',
    'ip'                   => ':attributeには、有効なIPアドレスを指定してください。',
    'ipv4'                 => ':attributeはIPv4アドレスを指定してください。',
    'ipv6'                 => ':attributeはIPv6アドレスを指定してください。',
    'json'                 => ':attributeには、有効なJSON文字列を指定してください。',
    'lt'                   => [
        'numeric' => ':attributeは、:valueより小さくなければなりません。',
        'file'    => ':attributeは、:value KBより小さくなければなりません。',
        'string'  => ':attributeは、:value文字より小さくなければなりません。',
        'array'   => ':attributeの項目数は、:value個より小さくなければなりません。',
    ],
    'lte'                  => [
        'numeric' => ':attributeは、:value以下でなければなりません。',
        'file'    => ':attributeは、:value KB以下でなければなりません。',
        'string'  => ':attributeは、:value文字以下でなければなりません。',
        'array'   => ':attributeの項目数は、:value個以下でなければなりません。',
    ],
    'max'                  => [
        'numeric' => ':attributeには、:max以下の数字を指定してください。',
        'file'    => ':attributeには、:max KB以下のファイルを指定してください。',
        'string'  => ':attributeは、:max文字以下にしてください。',
        'array'   => ':attributeの項目は、:max個以下にしてください。',
    ],
    'mimes'                => ':attributeには、:valuesタイプのファイルを指定してください。',
    'mimetypes'            => ':attributeには、:valuesタイプのファイルを指定してください。',
    'min'                  => [
        'numeric' => ':attributeには、:min以上の数字を指定してください。',
        'file'    => ':attributeには、:min KB以上のファイルを指定してください。',
        'string'  => ':attributeは、:min文字以上にしてください。',
        'array'   => ':attributeの項目は、:min個以上にしてください。',
    ],
    'not_in'               => '選択された:attributeは、有効ではありません。',
    'not_regex'            => ':attributeの形式が無効です。',
    'numeric'              => ':attributeには、数字を指定してください。',
    'present'              => ':attributeが存在している必要があります。',
    'regex'                => ':attributeには、有効な正規表現を指定してください。',
    'required'             => ':attributeは、必ず指定してください。',
    'required_if'          => ':otherが:valueの場合、:attributeを指定してください。',
    'required_unless'      => ':otherが:values以外の場合、:attributeを指定してください。',
    'required_with'        => ':valuesが指定されている場合、:attributeも指定してください。',
    'required_with_all'    => ':valuesが全て指定されている場合、:attributeも指定してください。',
    'required_without'     => ':valuesが指定されていない場合、:attributeを指定してください。',
    'required_without_all' => ':valuesが全て指定されていない場合、:attributeを指定してください。',
    'same'                 => ':attributeと:otherが一致しません。',
    'size'                 => [
        'numeric' => ':attributeには、:sizeを指定してください。',
        'file'    => ':attributeには、:size KBのファイルを指定してください。',
        'string'  => ':attributeは、:size文字にしてください。',
        'array'   => ':attributeの項目は、:size個にしてください。',
    ],
    'starts_with'          => ':attributeは、次のいずれかで始まる必要があります。:values',
    'string'               => ':attributeには、文字を指定してください。',
    'timezone'             => ':attributeには、有効なタイムゾーンを指定してください。',
    'unique'               => '指定の:attributeは既に使用されています。',
    'uploaded'             => ':attributeのアップロードに失敗しました。',
    'url'                  => ':attributeは、有効なURL形式で指定してください。',
    'uuid'                 => ':attributeは、有効なUUIDでなければなりません。',
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */
    'custom' => [
        'please_confirm' => ':attributeの送信内容を確認してください。',
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'email_string' => ':attributeを正しく入力してください',
        'date_format' => '日付が正しくありません',
        'possession_qualification' => ':attributeを正しく入力してください',
        'id_check' => [
            'required' => '対象がありません',
            'integer' => '想定していないリクエストです',
        ],
        'fare' => [
            'comfirm' => '既に確定している月の申請は出来ません',
            'date_check' => ':attributeが申請可能期間では有りません',
            'commuter_pass_required_if' => '定期の場合は、写真の添付が必須です。諸事情により添付できない場合は、備考欄へ記入してください'
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => [
        'uuid' => 'ID',
        'erpid' => '従業員ID',
        'lastname' => '苗字',
        'firstname' => '名字',
        'lastnameKana' =>'苗字カナ',
        'firstnameKana' => '名字カナ',
        'birthday' => '生年月日',
        'gender' => '性別',
        'birthplace' => '出身地',
        'spouse' => '配偶者',
        'postalCode' => '郵便番号',
        'prefectural' =>'県',
        'address' => '住所',
        'nearestStation' => '最寄り駅',
        'enducationalBackground' => '最終学歴',
        'contactNumber' => '連絡先',
        'emergencyContactNumber' => '緊急連絡先',
        'recruitmentClassification' => '採用区分',
        'belongId' => '所属',
        'affiliationDeptId' => '所属部門',
        'positionId' => '役職',
        'employeeDivId' => '従業員区分',
        'businessDivId' => '業務区分',
        'joinedAt' => '入社日',
        'retirementAt' => '退職日',
        'operationDestinationName' => '稼働先名称',
        'operationDestination' => '稼働先',
        'possessionQualification' => '保有資格',
        'note' => '備考',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'password_confirmation' => 'パスワード（確認）',
        'name' => 'ユーザー名',
        'username' => config('app.USERNAME.NAME'),
        'targetDate' => '対象日付',
        'targetMonth' => '対象月',
        'destination' => '目的地',
        'pointOfDeparture' => '出発地',
        'arrival' => '到着地',
        'route' => '往復か片道か',
        'transportation' => '交通手段',
        'amountOfMoney' => '金額',
        'routeDiv' => '経路区分',
        'receipt' => '領収書',
        'remarks' => '備考欄',
        'adminRemarks' => '管理者記入欄'
    ],
];
