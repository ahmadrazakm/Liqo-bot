<?php

namespace App\Commands;

use App\Group;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class BaruCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "baru";

    /**
     * @var string Command Description
     */
    protected $description = "Buat grup liqo baru";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        $this->replyWithChatAction(['action' => Actions::TYPING]);
        $message = $this->getUpdate()->getMessage();

        // TODO cek group/user nya udah ada atau belum
        $group = new Group;
        $group->id = $message->getChat()->getId();
        // TODO cek arguments tidak boleh kosong
        $group->name = $arguments;

        $response = '';
        try {
             $group->save();
             $response .= sprintf('ok, berhasil membuat grup liqo baru dengan nama %s' . PHP_EOL, $group->name);
        } catch (\Exception $e) {
             $errorCode = $e->errorInfo[1];

             // unique constraint
             if($errorCode == 1062) {
                 $response .= sprintf('hmm, error. mungkin grup sudah terdaftar?' .PHP_EOL);
             }
        }

        $this->replyWithMessage(['text' => $response]);
    }
}
