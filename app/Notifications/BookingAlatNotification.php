<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\BookingAlat;

class BookingAlatNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(BookingAlat $book)
    {
        $this->book = $book;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)

        ->greeting('Hai 👋, '.$this->book->name)
        ->line('Selamat pesanan anda berhasil dibuat 🎉.')
        ->line('')
        ->line('berikut adalah detail dari pesanan anda : ')
        ->line('Nama Alat : '.$this->book->instrument_name)
        ->line('Harga Sewa Alat : '.$this->book->total)
        ->line('Tanggal Sewa : '.$this->book->date)
        ->line('Durasi (dalam satuan hari) : '.$this->book->duration)
        ->line('')
        ->line('Silahkan lakukan pembayaran melalui e-wallet dibawah ini atau Pembayaran Langsung ditempat')
        ->line('Gopay - A.n Synpchonic (083147120547)')
        ->line('DANA - A.n Synpchonic (083147120547)')
        ->line('OVO - A.n Synpchonic (083147120547)')
        ->line('')
        ->line('')
        ->line('Silahkan cek dashboard anda untuk melihat status penyewaan ')
        ->line('')
        ->line('⛔ Denda akan dikenakan apabila terlambat dalam mengembalikan alat ⛔');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
