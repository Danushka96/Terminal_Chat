#!/usr/bin/php
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

//get username
$connectionAs = function(){
    fwrite(STDOUT, 'Connect as: ');
    return trim(fgets(STDIN));
};

$username=$connectionAs();

//get rooms name
fwrite(STDIN, 'join room: ');
$room=trim(fgets(STDIN));

$pid = pcntl_fork();

if($pid==-1){
    exit(1);
}elseif($pid){
    //
}else{
    $pubnub->subscribe($room, function ($payload){
        var_dump($payload);
        return true;
    });
}


