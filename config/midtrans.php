<?php

return [
    'serverKey' => env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-mKNXN54jqD77z5ae2tp7lTXi'),
    'isSandbox' => env('MIDTRANS_IS_PRODUCTION', false),
    'isSanitized' => env('MIDTRANS_IS_SANITIZED', true),
    'is3ds' => env('MIDTRANS_IS_3DS', true),
];
