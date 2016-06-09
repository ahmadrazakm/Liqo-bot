<?php

namespace App\Commands;

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
        $this->replyWithMessage(['text' => 'sip, laporan diterima :)']);
        $this->replyWithChatAction(['action' => Actions::TYPING]);
        $this->replyWithMessage(['text' => 'ngga ding, ini cuma buat contoh doang, laporannya ga dicatet :P']);
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $message = $this->getUpdate()->getMessage();
        $this->replyWithMessage(['text' => '=====']);
        $response = '';
        $response .= 'messageId: ' . $message->getMessageId() . PHP_EOL;
        $response .= 'chatId: ' . $message->getChat()->getId() . PHP_EOL;
        $response .= 'form: ' . $message->getFrom()->getUsername() . PHP_EOL;
        $date = new \DateTime();
        $date->setTimeStamp($message->getDate());
        $date->setTimeZone(new \DateTimeZone('Asia/Jakarta'));
        $response .= 'at: ' . $date->format('Y-m-d H:i:s') . PHP_EOL;
        $response .= 'arguments:' . PHP_EOL;
        $args = explode(' ', $arguments);
        foreach ($args as $key => $value) {
            $response .= sprintf('%s => %s' . PHP_EOL, $key, $value);
        }
        $this->replyWithMessage(['text' => $response]);
        $this->replyWithMessage(['text' => '=====']);
    }
}
