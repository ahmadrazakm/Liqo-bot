<?php

namespace App\Commands;

use App\Group;
use App\Report;
use App\User;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class LaporCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "lapor";

    /**
     * @var string Command Description
     */
    protected $description = "Buat Ngelapor";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        $this->replyWithChatAction(['action' => Actions::TYPING]);
        $message = $this->getUpdate()->getMessage();

        // TODO cek group/user nya udah ada atau belum
        $group = Group::where('id', $message->getChat()->getId())->first();
        $user = User::where('id', $message->getFrom()->getId())->first();

        $report = new Report;
        $report->user_id = $group->id;
        $report->group_id = $user->id;
        $time = Carbon::createFromTimestamp($message->getDate(), 'Asia/Jakarta');
        $report->date = $time;
        $report->time = $time;

        $response = '';
        try {
             $report->save();
             $response .= sprintf('ok, laporan @%s diterima pada %s di grup liqo %s' . PHP_EOL, $message->getFrom()->getUsername(), $time->toDateTimeString(), $group->name);
        } catch (\Exception $e) {
             $errorCode = $e->errorInfo[1];

             // unique constraint
             if($errorCode == 1062) {
                 $response .= sprintf('hmm, error. mungkin @%s sudah lapor hari ini?' .PHP_EOL, $message->getFrom()->getUsername());
             }
        }

        $this->replyWithMessage(['text' => $response]);
    }
}
