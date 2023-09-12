<?php

namespace App\Exceptions;


use Exception;

class SomethingWentWrong extends Exception
{

    private \Throwable $th;
    /**
     * Create a new exception instance.
     *
     * @return void
     */
    public function __construct(\Throwable $th)
    {
        $this->th = $th;
    }

    public function render()
    {
            return response()->json(['status' => 'error', 'message' => 'Algo salió mal!!', 'file' => $this->th->getFile(), 'line' => $this->th->getLine(), 'trace' => $this->th->getMessage()], 500);

    }
}
