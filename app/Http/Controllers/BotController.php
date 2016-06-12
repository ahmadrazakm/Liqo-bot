<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Requests;
use App\Group;
use App\User;
use App\Report;
use Telegram;

class BotController extends Controller
{
    public function me()
    {
        $response = Telegram::getMe();

        $botId = $response->getId();
        $firstName = $response->getFirstName();
        $username = $response->getUsername();

        var_dump($botId);
        var_dump($firstName);
        var_dump($username);
    }

    public function setWebhook()
    {
        $response = Telegram::setWebhook(['url' => 'https://liqo-bot.herokuapp.com/<token>/webhook']);
        var_dump($response);
    }

    public function stats($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        $result = array();
        foreach ($user->reports as $report) {
            if (!array_key_exists($report->group->name, $result)) {
                $result[$report->group->name] = array();
            }
            array_push($result[$report->group->name], $report->date->format('Y-m-d'));
        }
        return $result;
    }

    public function test()
    {
        // $res = User::find(1);
        // dd($res->groups);

        // $res = Group::find(1);
        // dd($res->users);

        // $res = Report::find(1);
        // dd($res->user);
        // dd($res->group);

        // $group = new Group;
        // $group->name = 'liqo yang lain';
        // $group->save();

        // $user = new User;
        // $user->username = 'yanglain';
        // $user->save();

        // $report = new Report;
        // $report->user_id = 2;
        // $report->group_id = 2;
        // $time = Carbon::createFromTimestamp(time(), 'Asia/Jakarta');
        // $report->date = $time;
        // $report->time = $time;
        //
        // try {
        //      $report->save();
        // } catch (\Exception $e) {
        //      $errorCode = $e->errorInfo[1];
        //
        //   // unique constraint
        //      if($errorCode == 1062){
        //
        //   }
        // }

        return 'ok';
    }
}
