<?php
declare(strict_types = 1);


class App
{
    private $soldierFactory;
    private $toolsFactory;
    /**
     * @var $soldiersById SoldierInterface[]
     */
    private $soldiersById = [];
    /**
     * @var $allSoldiers SoldierInterface[]
     */
    private $allSoldiers = [];
    public function __construct(SoldierFactory $soldierFactory, ToolsFactory $toolsFactory)
    {
        $this->soldierFactory = $soldierFactory;
        $this->toolsFactory = $toolsFactory;
    }
    public function run()
    {
        $this->readInput();
        $this->printSoldiers();
    }
    private function readInput()
    {
        while (true) {
            $data = explode(" ", $this->readLine());
            if ($data[0] === "End") {
                break;
            }
            try {
                $this->processCommand($data);
            } catch (\Exception $exception) {
                // todo
            }
        }
    }
    private function processCommand($args)
    {
        switch ($args[0]) {
            case "Private":
                $private = $this->soldierFactory->create($args);
                $this->addSoldier($private->getId(), $private);
                break;
            case "LeutenantGeneral":
                $general = $this->soldierFactory->create($args);
                $privateIds = array_map("intval", array_splice($args, 5));
                foreach ($privateIds as $privateId) {
                    $private = $this->getSoldierById($privateId);
                    $this->addPrivateToLieutenant($general, $private);
                }
                $this->addSoldier($general->getId(), $general);
                break;
            case "Engineer":
                $engineer = $this->soldierFactory->create($args);
                $repairData = array_splice($args, 6);
                for ($i = 0; $i < count($repairData); $i += 2) {
                    $repair = $this->toolsFactory->create("Repair", array_slice($repairData, $i, 2));
                    $this->addRepairToEngineer($engineer, $repair);
                }
                $this->addSoldier($engineer->getId(), $engineer);
                break;
            case "Commando":
                $commando = $this->soldierFactory->create($args);
                $missionsData = array_splice($args, 6);
                for ($i = 0; $i < count($missionsData); $i += 2) {
                    try {
                        $mission = $this->toolsFactory->create("Mission", array_slice($missionsData, $i, 2));
                        $this->addMissionToCommando($commando, $mission);
                    } catch (\Exception $exception) {
                    }
                }
                $this->addSoldier($commando->getId(), $commando);
                break;
            case "Spy":
                $spy = $this->soldierFactory->create($args);
                $this->addSoldier($spy->getId(), $spy);
                break;
        }
    }
    private function addRepairToEngineer(EngineerInterface $engineer, RepairInterface $repair)
    {
        $engineer->addRepair($repair);
    }
    private function addMissionToCommando(CommandoInterface $commando, MissionInterface $mission)
    {
        $commando->addMission($mission);
    }
    private function addPrivateToLieutenant(LeutenantGeneralInterface $general, SoldierInterface $soldier)
    {
        $general->addPrivate($soldier);
    }
    private function addSoldier(int $id, SoldierInterface $soldier)
    {
        $this->soldiersById[$id] = $soldier;
        $this->allSoldiers[] = $soldier;
    }
    private function getSoldierById(int $id)
    {
        return $this->soldiersById[$id];
    }
    private function printSoldiers()
    {
        foreach ($this->allSoldiers as $soldier) {
            $this->writeLine($soldier);
        }
    }
    private function readLine(): string
    {
        return trim(fgets(STDIN));
    }
    /**
     * @param $content mixed
     * @return void
     */
    private function writeLine($content)
    {
        echo $content . PHP_EOL;
    }
}
interface CommandoInterface
{
    public function addMission(MissionInterface $mission);
    public function getMissions(): array;
}

interface EngineerInterface
{
    public function addRepair(RepairInterface $repair);
    public function getRepairs(): array;
}

interface LeutenantGeneralInterface
{
    public function addPrivate(SoldierInterface $soldier);
    /**
     * @return PrivateSoldierInterface[]
     */
    public function getPrivates(): array ;
}

interface MissionInterface
{
    public function getCodeName(): string;
    public function setCodeName(string $name);
    public function getState(): string;
    public function setState(string $state);
    public function completeMission();
}

interface PrivateSoldierInterface
{
    public function setSalary(float $salary);
    public function getSalary(): float;
}

interface RepairInterface
{
    public function getName(): string;
    public function setName(string $name);
    public function getWorkHours(): int;
    public function setWorkHours(int $hours);
}



interface SpyInterface
{
    public function getCodeNumber(): string;
    public function setCodeNumber(string $codeNumber);
}
interface SpecialisedSoldierInterface
{
    public function setCorps(string $corps);
    public function getCorps(): string;
}
abstract class Soldier implements SoldierInterface
{
    private $id;
    private $firstName;
    private $lastName;
    public function __construct(int $id, string $firstName, string $lastName)
    {
        $this->setId($id);
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
    }
    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function setFirstName(string $name)
    {
        $this->firstName = $name;
    }
    public function getFirstName(): string
    {
        return $this->firstName;
    }
    public function setLastName(string $name)
    {
        $this->lastName = $name;
    }
    public function getLastName(): string
    {
        return $this->lastName;
    }
    function __toString()
    {
        return "Name: {$this->getFirstName()} {$this->getLastName()} Id: {$this->getId()}";
    }
}

class SoldierFactory
{
    public function create(array $params)
    {
        $type = array_shift($params);
        switch ($type) {
            case "Private":
                return new PrivateSoldier(intval($params[0]), $params[1], $params[2], floatval($params[3]));
            case "LeutenantGeneral":
                return new LeutenantGeneral(intval($params[0]), $params[1], $params[2], floatval($params[3]));
            case "Engineer":
                return new Engineer(intval($params[0]), $params[1], $params[2], floatval($params[3]), $params[4]);
            case "Commando":
                return new Commando(intval($params[0]), $params[1], $params[2], floatval($params[3]), $params[4]);
            case "Spy":
                return new Spy(intval($params[0]), $params[1], $params[2], $params[3], $params[4]);
            default:
                throw new \Exception("Invalid soldier type.");
        }
    }
}
class ToolsFactory
{
    public function create(string $type, array $params)
    {
        switch ($type) {
            case "Repair":
                return new Repair($params[0], intval($params[1]));
            case "Mission":
                return new Mission(...$params);
            default:
                throw new \Exception("Invalid type supplied");
        }
    }
}


interface SoldierInterface
{
    public function setId(int $id);
    public function getId(): int;
    public function setFirstName(string $name);
    public function getFirstName(): string;
    public function setLastName(string $name);
    public function getLastName(): string;
}

class Spy extends Soldier implements SpyInterface
{
    private $codeNumber;
    public function __construct(int $id, string $firstName, string $lastName, string $codeNumber)
    {
        parent::__construct($id, $firstName, $lastName);
        $this->setCodeNumber($codeNumber);
    }
    public function getCodeNumber(): string
    {
        return $this->codeNumber;
    }
    public function setCodeNumber(string $codeNumber)
    {
        $this->codeNumber = $codeNumber;
    }
    function __toString()
    {
        return parent::__toString() . PHP_EOL
            . "Code Number: {$this->getCodeNumber()}";
    }
}
class PrivateSoldier extends Soldier implements PrivateSoldierInterface
{
    private $salary;
    public function __construct(int $id, string $firstName, string $lastName, float $salary)
    {
        parent::__construct($id, $firstName, $lastName);
        $this->setSalary($salary);
    }
    public function setSalary(float $salary)
    {
        $this->salary = $salary;
    }
    public function getSalary(): float
    {
        return $this->salary;
    }
    function __toString()
    {
        $salary = number_format($this->getSalary(), 2, ".", "");
        return parent::__toString() . " Salary: {$salary}";
    }
}

abstract class SpecialisedSoldier extends PrivateSoldier implements SpecialisedSoldierInterface
{
    const VALID_CORPS_NAMES = ["Airforces", "Marines"];
    private $corps;
    public function __construct(int $id,
                                string $firstName,
                                string $lastName,
                                float $salary,
                                string $corps)
    {
        parent::__construct($id, $firstName, $lastName, $salary);
        $this->setCorps($corps);
    }
    public function setCorps(string $corps)
    {
        if (!in_array($corps, self::VALID_CORPS_NAMES)) {
            throw new \Exception("Invalid corps supplied");
        }
        $this->corps = $corps;
    }
    public function getCorps(): string
    {
        return $this->corps;
    }
    function __toString()
    {
        return parent::__toString() . PHP_EOL
            . "Corps: {$this->getCorps()}";
    }
}





class Repair implements RepairInterface
{
    private $name;
    private $workHours;
    public function __construct(string $name, int $workHours)
    {
        $this->setName($name);
        $this->setWorkHours($workHours);
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function getWorkHours(): int
    {
        return $this->workHours;
    }
    public function setWorkHours(int $hours)
    {
        $this->workHours = $hours;
    }
    function __toString()
    {
        return "Part Name: {$this->getName()} Hours Worked: {$this->getWorkHours()}";
    }
}





class Mission implements MissionInterface
{
    const VALID_STATES = ["finished", "inprogress"];
    private $codeName;
    private $state;
    public function __construct(string $codeName, string $state)
    {
        $this->setCodeName($codeName);
        $this->setState($state);
    }
    public function getCodeName(): string
    {
        return $this->codeName;
    }
    public function setCodeName(string $name)
    {
        $this->codeName = $name;
    }
    public function getState(): string
    {
        return $this->state;
    }
    public function setState(string $state)
    {
        if (!in_array(strtolower($state), self::VALID_STATES)) {
            throw new \Exception("Invalid mission state supplied");
        }
        $this->state = $state;
    }
    public function completeMission()
    {
        $this->setState("Finished");
    }
    function __toString()
    {
        return "Code Name: {$this->getCodeName()} State: {$this->getState()}";
    }
}

class LeutenantGeneral extends PrivateSoldier implements LeutenantGeneralInterface
{
    /**
     * @var $privates ProjectileInterface[]
     */
    private $privates = [];
    /**
     * @return PrivateSoldierInterface[]
     */
    public function getPrivates(): array
    {
        return $this->privates;
    }
    function __toString()
    {
        $output = parent::__toString() . PHP_EOL
            . "Privates:" . PHP_EOL;
        foreach ($this->getPrivates() as $private) {
            $output .= "  {$private}" . PHP_EOL;
        }
        return trim($output);
    }
    public function addPrivate(SoldierInterface $soldier)
    {
        $this->privates[] = $soldier;
    }
}
class Engineer extends SpecialisedSoldier implements EngineerInterface
{
    /**
     * @var $repairs RepairInterface[]
     */
    private $repairs = [];
    public function addRepair(RepairInterface $repair)
    {
        $this->repairs[] = $repair;
    }
    public function getRepairs(): array
    {
        return $this->repairs;
    }
    function __toString()
    {
        $output = parent::__toString() . PHP_EOL
            . "Repairs:" . PHP_EOL;
        foreach ($this->getRepairs() as $repair) {
            $output .= "  {$repair}" . PHP_EOL;
        }
        return trim($output);
    }
}

class Commando extends SpecialisedSoldier implements CommandoInterface
{
    /**
     * @var $missions MissionInterface[]
     */
    private $missions = [];
    public function addMission(MissionInterface $mission)
    {
        $this->missions[] = $mission;
    }
    public function getMissions(): array
    {
        return $this->missions;
    }
    function __toString()
    {
        $output = parent::__toString() . PHP_EOL
            . "Missions:" . PHP_EOL;
        foreach ($this->getMissions() as $mission) {
            $output .= "  {$mission}" . PHP_EOL;
        }
        return trim($output);
    }
}





spl_autoload_register(function ($className) {
    require_once "{$className}.php";
});
$soldiersFactory = new SoldierFactory();
$toolsFactory = new ToolsFactory();
$app = new App($soldiersFactory, $toolsFactory);
$app->run();





