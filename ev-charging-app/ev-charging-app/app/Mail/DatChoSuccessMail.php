<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\DatCho;
use Illuminate\Support\Facades\Auth;

class DatChoSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $datCho;
    public $user;
    public $sotien;

    public function __construct(DatCho $datCho)
    {
        $this->datCho = $datCho;
        $this->user = Auth::user(); // ✅ lấy user hiện tại
        $this->sotien = $datCho->thanhtoan?->sotien ?? 0; // ✅ tránh null
    }

    public function build()
    {
        return $this->subject('Xác nhận đặt chỗ thành công')
                    ->view('emails.datcho_success')
                    ->with([
                        'datCho' => $this->datCho,
                        'user' => $this->user,
                        'sotien' => $this->sotien,
                    ]);
    }
}
