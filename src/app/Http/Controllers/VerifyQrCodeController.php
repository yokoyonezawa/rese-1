<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class VerifyQrCodeController extends Controller
{

    public function generate(Request $request)
    {
        // 利用者のIDや情報を取得
        $userId = $request->user()->id; // ログインユーザーのIDを使用

        // QRコードの生成
        $qrCode = QrCode::size(300)->generate(route('qr.verify', ['user_id' => $userId])); // ユーザーIDをQRコードに埋め込む

        return view('qr_code', ['qrCode' => $qrCode]);
    }


    public function verify(Request $request)
    {
        $userId = $request->input('user_id'); // QRコードから取得したユーザーID

        // ユーザーの存在を確認
        $user = User::find($userId);

        if ($user) {
            // 照合成功の処理
            return response()->json(['message' => 'ユーザー確認成功', 'user' => $user]);
        } else {
            // 照合失敗の処理
            return response()->json(['message' => 'ユーザー確認失敗'], 404);
        }
    }
}
