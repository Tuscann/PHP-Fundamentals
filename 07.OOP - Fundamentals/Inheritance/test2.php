<?php
class Song
{
    private $artistName;
    private $songName;
    private $songMinutes;
    private $songSeconds;

    public function __construct(string $artistName, string $songName, int $minutes, int $seconds)
    {
        $this->setArtistName($artistName);
        $this->setSongName($songName);
        $this->setSongMinutes($minutes);
        $this->setSongSeconds($seconds);
    }
    // SETTERS
    protected function setArtistName(string $artistName)
    {
        if(strlen($artistName) < 3 || strlen($artistName) > 20){
            throw new Exception("Artist name should be between 3 and 20 symbols.");
        }
        $this->artistName = $artistName;
    }

    protected function setSongName( string $songName)
    {
        if(strlen($songName) < 3 || strlen($songName) > 20){
            throw new Exception("Song name should be between 3 and 30 symbols.");
        }
        $this->songName = $songName;
    }

    protected function setSongMinutes(int $songMinutes)
    {
        if($songMinutes < 0 || $songMinutes > 14){
            throw new Exception("Song minutes should be between 0 and 14.");
        }
        $this->songMinutes = $songMinutes;
    }

    protected function setSongSeconds(int $songSeconds)
    {
        if($songSeconds < 0 || $songSeconds > 59){
            throw new Exception("Song seconds should be between 0 and 59.");
        }
        $this->songSeconds = $songSeconds;
    }

    // GETTERS
    public function getArtistName():string
    {
        return $this->artistName;
    }

    public function getSongMinutes():int
    {
        return $this->songMinutes;
    }

    public function getSongName():int
    {
        return $this->songName;
    }

    public function getSongSeconds(): int
    {
        return $this->songSeconds;
    }
}

$inputCount = intval(trim(fgets(STDIN)));
$songCounter = 0;
$playlistSecounds = 0;

while($inputCount--){
    $songInfo = preg_split("/[;:]/", trim(fgets(STDIN)));
    list($artistName, $songName, $minutes, $seconds) =
        [$songInfo[0], $songInfo[1], intval($songInfo[2]), intval($songInfo[3])];

    try{
        $song = new Song($artistName, $songName, $minutes, $seconds);
        $songCounter++;

        $playlistSecounds += $minutes*60;
        $playlistSecounds += $seconds;

        echo "Song added." . PHP_EOL;

    } catch (Exception $e){
        echo $e->getMessage() . PHP_EOL;
    }
}
echo 'Songs added: ' . $songCounter . PHP_EOL;

$hours = floor(floor($playlistSecounds / 60) / 60);
$minutes = str_pad(floor($playlistSecounds / 60) % 60, 2, "0", STR_PAD_LEFT);
$seconds = str_pad($playlistSecounds % 60, 2, "0", STR_PAD_LEFT);

print "Playlist length: " . "{$hours}h {$minutes}m {$seconds}s";