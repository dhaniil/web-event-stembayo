namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class BrowserNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['broadcast'];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'title' => 'Notifikasi Browser',
            'message' => 'Ini adalah contoh notifikasi browser.',
        ]);
    }
}