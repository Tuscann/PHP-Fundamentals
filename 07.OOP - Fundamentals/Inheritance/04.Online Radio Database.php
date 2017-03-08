<?php

namespace RadioDatabase;


class Song
{
    private $artistName;
    private $songName;
    private $hours;
    private $minutes;
    private $seconds;
    private $total;
    public static $counter = 0;

    public function __construct(string $artistName, string $songName, int $minutes, int $seconds)
    {
        $this->setArtistName($artistName);
        $this->setSongName($songName);
        $this->setSongDuration($minutes, $seconds);
        self::$counter++;
    }

    //Setters
    private function setSongName(string $songName)
    {

        try {
            if ($songName < 3 && $songName > 20) {
                throw new \Exception("Song name should be between 3 and 30 symbols." . PHP_EOL);
            }

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $this->songName = $songName;

    }

    private function setArtistName(string $artistName)
    {

        try {
            if ($artistName < 3 && $artistName > 20) {
                throw new \Exception("Artist name should be between 3 and 20 symbols." . PHP_EOL);

            }

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        $this->artistName = $artistName;
    }


    private function setSongDuration(int $minutes, int $seconds)
    {
        try {
            if ($seconds < 0 || $seconds > (14 * 60 + 59)) {
                throw new \Exception("Invalid song length." . PHP_EOL);
            }

            if ($minutes < 0 || $minutes > 14) {
                throw new \Exception("Song minutes should be between 0 and 14." . PHP_EOL);
            }
            if ($seconds < 0 || $seconds > 59) {
                throw new \Exception("Song seconds should be between 0 and 59." . PHP_EOL);
            }

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $this->minutes = $minutes;
        $this->seconds = $seconds;
        $this->total = $this->minutes * 60 + ($this->seconds);
    }

    //Getters

    public function getArtistName()
    {
        return $this->artistName;
    }

    public function getSongName()
    {
        return $this->songName;
    }

    public function getDuration(): int
    {
        return $this->total;
    }

    function __toString()
    {
        return "Songs added: " . Song::$counter . PHP_EOL;
    }
}

$totalSongsDuration = 0;

$count = intval(trim(fgets(STDIN)));

for ($i = 0; $i < $count; $i++) {
    $delimiter = explode(";", trim(fgets(STDIN)));


    $artistName = $delimiter[0];
    $songName = $delimiter[1];
    $time = explode(":", $delimiter[2]);
    $minutes = intval($time[0]);
    $seconds = intval($time[1]);

    try {
        if (count($delimiter) != 3) {
            throw new \Exception("Invalid song.");
        }


    } catch (\Exception $e) {
        echo $e->getMessage();
    }

    $song = new Song($artistName, $songName, $minutes, $seconds);


    $totalSongsDuration += $song->getDuration();


    print "Song added." . PHP_EOL;

}
echo $song;

$hours = floor(floor($totalSongsDuration / 60) / 60);
$minutes = str_pad(floor($totalSongsDuration / 60) % 60, 2, "0", STR_PAD_LEFT);
$seconds = str_pad($totalSongsDuration % 60, 2, "0", STR_PAD_LEFT);

print "Playlist length: " . "{$hours}h {$minutes}m {$seconds}s";

