
namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    // ...existing code...

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (Throwable $e) {
            if ($this->isHttpException($e)) {
                $statusCode = $e->getStatusCode();
                
                if (view()->exists("errors.{$statusCode}")) {
                    return response()->view("errors.{$statusCode}", [], $statusCode);
                }
            }
            return null;
        });
    }
}