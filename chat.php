#!/usr/bin/php

                               _________
                              / ======= \
                             / __________\
                            | ___________ |
                            | | -       | |
                            | |         | |
                            | |_________| |________________________
                            \=____________/   Hello World          )
                            / """"""""""" \                       /
                            / ::::::::::::: \                  =D-'
                            (_________________)

                       Welcome to Secret Chat Service
                              (Chat like Pro)
                         

<?php

require('vendor/autoload.php');

//namespaces
use Pubnub\Pubnub;

//stable connection with the API
$pubnub=new Pubnub(
    'pub-c-6ca67687-c380-4a2d-b243-19b642156295',
    'sub-c-3cec0f24-7e09-11e8-8b52-920f603f170e',
    'sec-c-MGMwMjUzOGEtZWFjZi00MWNmLTgzMDAtNGM4NzQ1ODY5NTM5',
    false
);

//get rooms name
fwrite(STDIN, 'join room: ');
$room=trim(fgets(STDIN));

fwrite(STDOUT,"Please Wait While we are checking data from the Channel\n");

$herenow=$pubnub->herenow($room, false, true);


//get username
function connectAs(){
    global $herenow;

    fwrite(STDOUT, "\nConnect as: ");

    $username=trim(fgets(STDIN));

    foreach($herenow['uuids'] as $user){
        if($user['state']['username']===$username){
            fwrite(STDOUT,"username taken\n");
            $username=connectAs();
        }
    }

    return $username;
};

$username=connectAs();

$pubnub->setState($room, ['username'=>$username]);


fwrite(STDOUT, "Connected to '{$room}' as '{$username}'\n");

$pid = pcntl_fork();

if($pid==-1){
    exit(1);
}elseif($pid){
    
    fwrite(STDOUT, '>');

    while(true){
        
        $message=trim(fgets(STDIN));
        $pubnub->publish($room, [

            "body" => $message,
            "username" => $username,

        ]);
    }

    pcntl_wait($status);
}else{
    $pubnub->subscribe($room, function ($payload) use ($username){
        $timestamp=date('d-m-y H:i:s');

        if($username!=$payload['message']['username']){
            fwrite(STDOUT,"\r");
        }

        fwrite(STDOUT, "[{$timestamp}] <{$payload['message']['username']}> {$payload['message']['body']}\n");
        fwrite(STDOUT, "\r>");
        return true;
    });
}


