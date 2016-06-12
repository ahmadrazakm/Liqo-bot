<?php

namespace App\Commands;

use App\Group;
use App\GroupUser;
use App\User;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class DaftarCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "daftar";

    /**
     * @var string Command Description
     */
    protected $description = "Buat daftar di suatu grup";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        $this->replyWithChatAction(['action' => Actions::TYPING]);
        $message = $this->getUpdate()->getMessage();

        // TODO cek group/user nya udah ada atau belum
        $group = Group::where('id', $message->getChat()->getId())->first();
        $user = User::firstOrCreate($message->getFrom()->getId());

        $groupUser = new GroupUser;
        $groupUser->group_id = $group->id;
        $groupUser->user_id = $user->id;

        $response = '';
        try {
             $groupUser->save();
             $response .= sprintf('ok, @%s berhasil mendaftar di grup liqo %s' . PHP_EOL, $message->getFrom()->getUsername(), $group->name);
        } catch (\Exception $e) {
             $errorCode = $e->errorInfo[1];

             // unique constraint
             if($errorCode == 1062) {
                 $response .= sprintf('hmm, error. mungkin @%s sudah terdaftar?' .PHP_EOL, $message->getFrom()->getUsername());
             }
        }

        $this->replyWithMessage(['text' => $response]);
    }
}
