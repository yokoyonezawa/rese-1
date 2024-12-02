<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class VerifyQrCodeController extends Controller
{

    public function generate(Request $request, $reservation_id)
    {
        // ログイン中のユーザーの予約情報を取得
        $reservation = $request->user()->reservations()->find($reservation_id);

        if (!$reservation) {
            abort(404, 'Reservation not found');
        }

        // QRコードの生成 (予約IDを埋め込む)
        $qrCode = QrCode::size(300)->generate(route('qr.verify', ['reservation_id' => $reservation->id]));

        return view('qr_code', ['qrCode' => $qrCode]);
    }


    public function verify(Request $request)
    {
        $reservationId = $request->input('reservation_id'); // QRコードから取得した予約ID

        // 予約情報の確認
        $reservation = \App\Models\Reservation::find($reservationId);

        if ($reservation && $reservation->user_id === $request->user()->id) {
            // 照合成功
            return response()->json(['message' => '予約確認成功', 'reservation' => $reservation]);
        } else {
            // 照合失敗
            return response()->json(['message' => '予約確認失敗'], 404);
        }
    }

}
