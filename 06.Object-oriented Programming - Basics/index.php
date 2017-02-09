<?php
declare(strict_types=1);
/**
 * Малка игричка, в която ще има двама играчи.
 * Играчите ще имат живот и атака.
 * При атака от един играч към друг, ще се отнема
 * съответното количество живот. Докато един от
 * играчите не падне на 0 или по-малко живот.
 */
/**
 * Играч
 *    - ИД (пореден номер)
 *    - Частен (private), Публичен (public), protected Име
 *    - private Живот
 *    - private Атака
 *
 *    ** Конструктор(Име, Живот и Атака)
 *    * Атакува(друг Играч)
 *    * !НамалиЖивот(живот)
 *    * !покажиМиАтакатаНаИграча()
 *    * ЖивЛиСъм()?
 */

require_once 'Player.php';
require_once 'Battle.php';

?>
<form>
    Player one name <input type="text" name="player_one_name" /><br/>
    Player two name <input type="text" name="player_two_name" /><br/>
    <input type="submit" name="start" value="Start Battle"/>
</form>
<?php
if (isset($_GET{'start'})) {
    $player1 = new Player($_GET['player_one_name']);
    $player2 = new Player($_GET['player_two_name']);
    $battle = new Battle($player1, $player2);
    $battle->start();

    if ($battle->getResult() === null) {
        echo "draw battle";
    } else {
        echo "Winner is: " . $battle->getResult()->getName();
    }
}





