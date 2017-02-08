<form method="GET">

    ВЪВЕДЕТЕ ГОДИНА/след 1800г./ <input type="number" name="year" placeholder="1800">

    <input type="submit" name="submit" value="SUBMIT">

</form>

<?php

if (isset($_GET['submit']) AND $_GET['year'] > 1799) {

    $year = $_GET['year'];

    echo $year;

    $start = mktime(0, 0, 0, 1, 1, $year);//timestamp

    $dayMonth = cal_days_in_month(0, 1, $year); //дни в месеца

    $dayweek = date("w", $start); //ден от седмицата за първо число на месеца в цифров формат от 0/неделя/до 6

    if ($dayweek == '0') {

        $dayweek = 7;

    } //ако първи е неделя, правим нулата на седмица, защото в таблицата неделята ни е последната колона

    $d = 1; //брояч на дните в месеца

    echo "<table border='1'";

    echo "<tr><td colspan='7' align='center' bgcolor='aqua'>ЯНУАРИ</td></tr>";

    echo "<tr>";

    echo "<td width='20' height='20'> п </td>";

    echo "<td width='20' height='20'> в </td>";

    echo "<td width='20' height='20'> с </td>";

    echo "<td width='20' height='20'> ч </td>";

    echo "<td width='20' height='20'> п </td>";

    echo "<td width='20' height='20'> с </td>";

    echo "<td width='20' height='20' bgcolor='red'> н </td>";

    echo "</tr>";

    echo "<tr>";

    $x = 1; //брояч на първата седмица в цикала, който изкарва празните клетки до първо число

    $counter = 1;//брояч на итерациите на първия цикъл, който после продължава и във втория, служи за да прехвърляме на нови редове

    $color = 'white';//бял цвят, който само за неделите става червен

    while ($x <= 6) {

        if ($x < "$dayweek") {

            echo "<td width='20' height='20' bgcolor='$color'></td>";

            $counter++;

        } else {

            break;

        }

        $x++;

    }//този цикъл завършва докато цикълът не прескочи празните дни, ако 1-ви е петък, този цикъл ще върти пет пъти

    if ($x == 7) { //ако първи е неделя и цикълът е стигнал до там, задаваме цвят червен, защото иначе ще излезе бял

        $color = 'red';

    }

    while ($d <= $dayMonth) { //започваме да изреждаме дните от месеца

        echo "<td width='20' height='20' bgcolor='$color'> $d</td>";

        if ($counter == 6 or $counter == 13 or $counter == 20 or $counter == 27 or $counter == 34) {

            $color = 'red';

        } else {

            $color = 'white';

        }

        //прехвърляне на нов ред

        if ($counter == 7 or $counter == 14 or $counter == 21 or $counter == 28 or $counter == 35) {

            echo "</tr><tr>";

        }

        $d++;

        $counter++;

    }

    echo "</tr>";

    echo "</table>";


    $start = mktime(0, 0, 0, 2, 1, $year);//timestamp

    $dayMonth = cal_days_in_month(0, 2, $year); //дни в месеца

    $dayweek = date("w", $start); //ден от седмицата за първо число на месеца в цифров формат от 0/неделя/до 6

    if ($dayweek == '0') {

        $dayweek = 7;

    } //ако първи е неделя, правим нулата на седмица, защото в таблицата неделята ни е последната колона

    $d = 1; //брояч на дните в месеца

    echo "<table border='1'";

    echo "<tr><td colspan='7' align='center' bgcolor='aqua'>ФЕВРУАРИ</td></tr>";

    echo "<tr>";

    echo "<td width='20' height='20'> п </td>";

    echo "<td width='20' height='20'> в </td>";

    echo "<td width='20' height='20'> с </td>";

    echo "<td width='20' height='20'> ч </td>";

    echo "<td width='20' height='20'> п </td>";

    echo "<td width='20' height='20'> с </td>";

    echo "<td width='20' height='20' bgcolor='red'> н </td>";

    echo "</tr>";

    echo "<tr>";

    $x = 1; //брояч на първата седмица в цикъла, който изкарва празните клетки до първо число

    $counter = 1;//брояч на итерациите на първия цикъл, който после продължава и във втория, служи за да прехвърляме на нови редове

    $color = 'white';//бял цвят, който само за неделите става червен

    while ($x <= 6) {

        if ($x < "$dayweek") {

            echo "<td width='20' height='20' bgcolor='$color'></td>";

            $counter++;

        } else {

            break;

        }

        $x++;

    }//този цикъл завършва докато цикълът не прескочи празните дни, ако 1-ви е петък, този цикъл ще върти пет пъти

    if ($x == 7) { //ако първи е неделя и цикълът е стигнал до там, задаваме цвят червен, защото иначе ще излезе бял

        $color = 'red';

    }

    while ($d <= $dayMonth) { //започваме да изреждаме дните от месеца

        echo "<td width='20' height='20' bgcolor='$color'> $d</td>";

        if ($counter == 6 or $counter == 13 or $counter == 20 or $counter == 27 or $counter == 34) {

            $color = 'red';

        } else {

            $color = 'white';

        }

        //прехвърляне на нов ред

        if ($counter == 7 or $counter == 14 or $counter == 21 or $counter == 28 or $counter == 35) {

            echo "</tr><tr>";

        }

        $d++;

        $counter++;

    }

    echo "</tr>";

    echo "</table>";


    $start = mktime(0, 0, 0, 3, 1, $year);//timestamp за първо число от месеца

    $dayMonth = cal_days_in_month(0, 3, $year); //дни в месеца

    $dayweek = date("w", $start); //ден от седмицата за първо число на месеца в цифров формат от 0/неделя/до 6

    if ($dayweek == '0') {

        $dayweek = 7;

    } //ако първи е неделя, правим нулата на седмица, защото в таблицата неделята ни е последната колона

    $d = 1; //брояч на дните в месеца

    echo "<table border='1'";

    echo "<tr><td colspan='7' align='center' bgcolor='aqua'>МАРТ</td></tr>";

    echo "<tr>";

    echo "<td width='20' height='20'> п </td>";

    echo "<td width='20' height='20'> в </td>";

    echo "<td width='20' height='20'> с </td>";

    echo "<td width='20' height='20'> ч </td>";

    echo "<td width='20' height='20'> п </td>";

    echo "<td width='20' height='20'> с </td>";

    echo "<td width='20' height='20' bgcolor='red'> н </td>";

    echo "</tr>";

    echo "<tr>";

    $x = 1; //брояч на първата седмица в цикала, който изкарва празните клетки до първо число

    $counter = 1;//брояч на итерациите на първия цикъл, който после продължава и във втория, служи за да прехвърляме на нови редове

    $color = 'white';//бял цвят, който само за неделите става червен

    while ($x <= 6) {

        if ($x < "$dayweek") {

            echo "<td width='20' height='20' bgcolor='$color'></td>";

            $counter++;

        } else {

            break;

        }

        $x++;

    }//този цикъл завършва докато цикълът не прескочи празните дни, ако 1-ви е петък, този цикъл ще върти пет пъти

    if ($x == 7) { //ако първи е неделя и цикълът е стигнал до там, задаваме цвят червен, защото иначе ще излезе бял

        $color = 'red';

    }

    while ($d <= $dayMonth) { //започваме да изреждаме дните от месеца

        echo "<td width='20' height='20' bgcolor='$color'> $d</td>";

        if ($counter == 6 or $counter == 13 or $counter == 20 or $counter == 27 or $counter == 34) {

            $color = 'red';

        } else {

            $color = 'white';

        }

        //прехвърляне на нов ред

        if ($counter == 7 or $counter == 14 or $counter == 21 or $counter == 28 or $counter == 35) {

            echo "</tr><tr>";

        }

        $d++;

        $counter++;

    }

    echo "</tr>";

    echo "</table>";


    $start = mktime(0, 0, 0, 4, 1, $year);//timestamp за първо число от месеца

    $dayMonth = cal_days_in_month(0, 4, $year); //дни в месеца

    $dayweek = date("w", $start); //ден от седмицата за първо число на месеца в цифров формат от 0/неделя/до 6

    if ($dayweek == '0') {

        $dayweek = 7;

    } //ако първи е неделя, правим нулата на седмица, защото в таблицата неделята ни е последната колона

    $d = 1; //брояч на дните в месеца

    echo "<table border='1'";

    echo "<tr><td colspan='7' align='center' bgcolor='aqua'>АПРИЛ</td></tr>";

    echo "<tr>";

    echo "<td width='20' height='20'> п </td>";

    echo "<td width='20' height='20'> в </td>";

    echo "<td width='20' height='20'> с </td>";

    echo "<td width='20' height='20'> ч </td>";

    echo "<td width='20' height='20'> п </td>";

    echo "<td width='20' height='20'> с </td>";

    echo "<td width='20' height='20' bgcolor='red'> н </td>";

    echo "</tr>";

    echo "<tr>";

    $x = 1; //брояч на първата седмица в цикала, който изкарва празните клетки до първо число

    $counter = 1;//брояч на итерациите на първия цикъл, който после продължава и във втория, служи за да прехвърляме на нови редове

    $color = 'white';//бял цвят, който само за неделите става червен

    while ($x <= 6) {

        if ($x < "$dayweek") {

            echo "<td width='20' height='20' bgcolor='$color'></td>";

            $counter++;

        } else {

            break;

        }

        $x++;

    }//този цикъл завършва докато цикълът не прескочи празните дни, ако 1-ви е петък, този цикъл ще върти пет пъти

    if ($x == 7) { //ако първи е неделя и цикълът е стигнал до там, задаваме цвят червен, защото иначе ще излезе бял

        $color = 'red';

    }

    while ($d <= $dayMonth) { //започваме да изреждаме дните от месеца

        echo "<td width='20' height='20' bgcolor='$color'> $d</td>";

        if ($counter == 6 or $counter == 13 or $counter == 20 or $counter == 27 or $counter == 34) {

            $color = 'red';

        } else {

            $color = 'white';

        }

        //прехвърляне на нов ред

        if ($counter == 7 or $counter == 14 or $counter == 21 or $counter == 28 or $counter == 35) {

            echo "</tr><tr>";

        }

        $d++;

        $counter++;

    }

    echo "</tr>";

    echo "</table>";


    $start = mktime(0, 0, 0, 5, 1, $year);//timestamp за първо число от месеца

    $dayMonth = cal_days_in_month(0, 5, $year); //дни в месеца

    $dayweek = date("w", $start); //ден от седмицата за първо число на месеца в цифров формат от 0/неделя/до 6

    if ($dayweek == '0') {

        $dayweek = 7;

    } //ако първи е неделя, правим нулата на седмица, защото в таблицата неделята ни е последната колона

    $d = 1; //брояч на дните в месеца

    echo "<table border='1'";

    echo "<tr><td colspan='7' align='center' bgcolor='aqua'>МАЙ</td></tr>";

    echo "<tr>";

    echo "<td width='20' height='20'> п </td>";

    echo "<td width='20' height='20'> в </td>";

    echo "<td width='20' height='20'> с </td>";

    echo "<td width='20' height='20'> ч </td>";

    echo "<td width='20' height='20'> п </td>";

    echo "<td width='20' height='20'> с </td>";

    echo "<td width='20' height='20' bgcolor='red'> н </td>";

    echo "</tr>";

    echo "<tr>";

    $x = 1; //брояч на първата седмица в цикала, който изкарва празните клетки до първо число

    $counter = 1;//брояч на итерациите на първия цикъл, който после продължава и във втория, служи за да прехвърляме на нови редове

    $color = 'white';//бял цвят, който само за неделите става червен

    while ($x <= 6) {

        if ($x < "$dayweek") {

            echo "<td width='20' height='20' bgcolor='$color'></td>";

            $counter++;

        } else {

            break;

        }

        $x++;

    }//този цикъл завършва докато цикълът не прескочи празните дни, ако 1-ви е петък, този цикъл ще върти пет пъти

    if ($x == 7) { //ако първи е неделя и цикълът е стигнал до там, задаваме цвят червен, защото иначе ще излезе бял

        $color = 'red';

    }

    while ($d <= $dayMonth) { //започваме да изреждаме дните от месеца

        echo "<td width='20' height='20' bgcolor='$color'> $d</td>";

        if ($counter == 6 or $counter == 13 or $counter == 20 or $counter == 27 or $counter == 34) {

            $color = 'red';

        } else {

            $color = 'white';

        }

        //прехвърляне на нов ред

        if ($counter == 7 or $counter == 14 or $counter == 21 or $counter == 28 or $counter == 35) {

            echo "</tr><tr>";

        }

        $d++;

        $counter++;

    }

    echo "</tr>";

    echo "</table>";


    $start = mktime(0, 0, 0, 6, 1, $year);//timestamp за първо число от месеца

    $dayMonth = cal_days_in_month(0, 6, $year); //дни в месеца

    $dayweek = date("w", $start); //ден от седмицата за първо число на месеца в цифров формат от 0/неделя/до 6

    if ($dayweek == '0') {

        $dayweek = 7;

    } //ако първи е неделя, правим нулата на седмица, защото в таблицата неделята ни е последната колона

    $d = 1; //брояч на дните в месеца

    echo "<table border='1'";

    echo "<tr><td colspan='7' align='center' bgcolor='aqua'>ЮНИ</td></tr>";

    echo "<tr>";

    echo "<td width='20' height='20'> п </td>";

    echo "<td width='20' height='20'> в </td>";

    echo "<td width='20' height='20'> с </td>";

    echo "<td width='20' height='20'> ч </td>";

    echo "<td width='20' height='20'> п </td>";

    echo "<td width='20' height='20'> с </td>";

    echo "<td width='20' height='20' bgcolor='red'> н </td>";

    echo "</tr>";

    echo "<tr>";

    $x = 1; //брояч на първата седмица в цикала, който изкарва празните клетки до първо число

    $counter = 1;//брояч на итерациите на първия цикъл, който после продължава и във втория, служи за да прехвърляме на нови редове

    $color = 'white';//бял цвят, който само за неделите става червен

    while ($x <= 6) {

        if ($x < "$dayweek") {

            echo "<td width='20' height='20' bgcolor='$color'></td>";

            $counter++;

        } else {

            break;

        }

        $x++;

    }//този цикъл завършва докато цикълът не прескочи празните дни, ако 1-ви е петък, този цикъл ще върти пет пъти

    if ($x == 7) { //ако първи е неделя и цикълът е стигнал до там, задаваме цвят червен, защото иначе ще излезе бял

        $color = 'red';

    }

    while ($d <= $dayMonth) { //започваме да изреждаме дните от месеца

        echo "<td width='20' height='20' bgcolor='$color'> $d</td>";

        if ($counter == 6 or $counter == 13 or $counter == 20 or $counter == 27 or $counter == 34) {

            $color = 'red';

        } else {

            $color = 'white';

        }

        //прехвърляне на нов ред

        if ($counter == 7 or $counter == 14 or $counter == 21 or $counter == 28 or $counter == 35) {

            echo "</tr><tr>";

        }

        $d++;

        $counter++;

    }

    echo "</tr>";

    echo "</table>";

} else {

    echo "няма въведена година";

}