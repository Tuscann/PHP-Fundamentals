<?php

class RadioSong
{
    private $artistName;
    private $songName;
    private $songDuration;
    private $totalMinute;

    function __construct($artistName, $songName, $songDuration)
    {
        $this->setArtistName($artistName);
        $this->setSongName($songName);
        $this->setSongDuration($songDuration);
    }

    private function setArtistName($artistName)
    {
        if (strlen($artistName) < 3 || strlen($artistName) > 20) {
            throw new Exception("Artist name should be between 3 and 20 symbols.\n");
        }
        $this->artistName = $artistName;
    }

    private function setSongName($songName)
    {
        if (strlen($songName) < 3 || strlen($songName) > 30) {
            throw new Exception("Song name should be between 3 and 30 symbols.\n");
        }
        $this->songName = $songName;
    }

    private function setSongDuration($songDuration)
    {
        $long = explode(':', $songDuration);
        $min = intval($long[0]);
        $sec = intval($long[1]);

        $songLenght = $min * 60 + $sec;

        if ($this->checkMinute($min) && $this->checkSec($sec)) {
            $this->songDuration = $songLenght;
            $this->totalMinute += $songLenght;
        }
    }

    private function checkMinute($min)
    {
        if ($min < 15 && $min >= 0) {
            return true;
        } else {
            throw new Exception("Song minutes should be between 0 and 14.\n");
        }
    }

    private function checkSec($sec)
    {
        if ($sec <= 59 && $sec >= 0) {
            return true;
        } else {
            throw new Exception("Song seconds should be between 0 and 59.\n");
        }
    }

    function getTotalMinute()
    {
        return $this->getTotalMinute();
    }

    public function getTotalHour($sum)
    {
        $hours = floor(floor($sum / 60) / 60);
        $minutes = str_pad(floor($sum / 60) % 60, 2, "0", STR_PAD_LEFT);
        $seconds = str_pad($sum % 60, 2, "0", STR_PAD_LEFT);

        print "Playlist length: " . "{$hours}h {$minutes}m {$seconds}s";
    }

    public function getArtistName()
    {
        return $this->artistName;
    }

    public function getSongName()
    {
        return $this->songName;
    }

    public function getSongDuration()
    {
        return $this->songDuration;
    }

}

$numOfSong = intval(fgets(STDIN));

$addedSong = [];

for ($i = 0; $i < $numOfSong; $i++) {
    $input = explode(';', trim(fgets(STDIN)));
    if(count($input) != 3){
        echo "Invalid song.\n";
    }
    if (count($input) == 3) {
        $songSinger = $input[0];
        $songName = $input[1];
        $songDuration = intval($input[2]);
        try {
            $song = new RadioSong($songSinger, $songName, $songDuration);
            $addedSong[] = $song;
            echo "Song added.\n";
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}

if (count($addedSong) > 0) {
    $sum = 0;
    echo "Songs added: " . count($addedSong) . PHP_EOL;
    foreach ($addedSong as $song) {
        $sum += $song->getSongDuration();
    }
    echo $addedSong[0]->getTotalHour($sum);
} else {
    echo "Songs added: 0\n";
    echo "Playlist length: 0h 00m 00s";
}