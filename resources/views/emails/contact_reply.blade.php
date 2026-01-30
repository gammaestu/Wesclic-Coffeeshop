<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Balasan Pesan - Wesclic Coffee Shop</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background-color: #f7f7f2; padding: 24px;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.06);">
        <tr>
            <td style="background: linear-gradient(135deg, #A3B18A, #B08968); padding: 20px 24px; color: #ffffff;">
                <h1 style="margin: 0; font-size: 20px; font-weight: 700;">Balasan dari Wesclic Coffee Shop</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 24px;">
                <p style="margin: 0 0 12px; font-size: 14px; color: #3a3a3a;">
                    Halo {{ $messageModel->name }},
                </p>
                <p style="margin: 0 0 16px; font-size: 14px; color: #3a3a3a;">
                    Terima kasih sudah menghubungi Wesclic Coffee Shop. Berikut ini balasan dari kami untuk pesan yang Anda kirimkan:
                </p>

                <p style="margin: 0 0 8px; font-size: 13px; color: #3a3a3a; font-weight: 600;">
                    Pesan Anda:
                </p>
                <div style="margin: 0 0 16px; padding: 12px 14px; background-color: #f8faf5; border-radius: 8px; border: 1px solid #e0e4d9; font-size: 13px; color: #3a3a3a; white-space: pre-line;">
                    {{ $messageModel->message }}
                </div>

                <p style="margin: 0 0 8px; font-size: 13px; color: #3a3a3a; font-weight: 600;">
                    Balasan dari kami:
                </p>
                <div style="margin: 0 0 20px; padding: 12px 14px; background-color: #ffffff; border-radius: 8px; border: 1px solid #e0e4d9; font-size: 13px; color: #3a3a3a; white-space: pre-line;">
                    {{ $messageModel->admin_reply }}
                </div>

                <p style="margin: 0 0 4px; font-size: 12px; color: #777777;">
                    Jika Anda masih memiliki pertanyaan lain, silakan balas email ini atau kunjungi langsung kedai kami.
                </p>
            </td>
        </tr>
        <tr>
            <td style="padding: 16px 24px; background-color: #f8faf5; border-top: 1px solid #e0e4d9;">
                <p style="margin: 0; font-size: 11px; color: #666666;">
                    Wesclic Coffee Shop<br>
                    Cobongan, Ngestiharjo, Kasihan, Bantul
                </p>
            </td>
        </tr>
    </table>
</body>
</html>

