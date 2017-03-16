<?php
class GameException extends Exception
{
}

class CommandFactory
{
    /**
     * CommandFactory constructor.
     */
    private function __construct()
    {
    }
    /**
     * @param $commandName
     * @return CommandInterface
     * @throws GameException
     */
    public static function produce($commandName): CommandInterface
    {
        switch ($commandName) {
            case "create":
                return new CreateCommand();
            case "attack":
                return new AttackCommand();
            case "plot-jump":
                return new PlotJumpCommand();
            case "status-report":
                return new StatusReportCommand();
            case "system-report":
                return new SystemReportCommand();
            default:
                throw new GameException(Messages::INVALID_COMMAND_NAME);
        }
    }
}

class EnhancementFactory
{
    /**
     * EnhancementFactory constructor.
     */
    private function __construct()
    {
    }
    /**
     * @param $type
     * @return EnhancementInterface
     * @throws GameException
     */
    public static function produce($type): EnhancementInterface
    {
        switch ($type) {
            case "ThanixCannon":
                return new ThanixCannonEnhancement();
            case "KineticBarrier":
                return new KineticBarrierEnhancement();
            case "ExtendedFuelCells":
                return new ExtendedFuelCellsEnhancement();
            default:
                throw new GameException(Messages::INVALID_ENHANCEMENT_TYPE);
        }
    }
}

class ProjectileFactory
{
    /**
     * ProjectileFactory constructor.
     */
    private function __construct()
    {
    }
    /**
     * @param string $type
     * @param int $damage
     * @return ProjectileInterface
     * @throws GameException
     */
    public static function produce(string $type, int $damage): ProjectileInterface
    {
        switch ($type) {
            case "PenetrationShell":
                return new PenetrationShell($damage);
            case "ShieldReaver":
                return new ShieldReaver($damage);
            case "Laser":
                return new Laser($damage);
            default:
                throw new GameException(Messages::INVALID_PROJECTILE_TYPE);
        }
    }
}

class ShipFactory
{
    /**
     * ShipFactory constructor.
     */
    private function __construct()
    {
    }
    /**
     * @param $shipType
     * @param $name
     * @return ShipInterface
     * @throws GameException
     */
    public static function produce($shipType, $name): ShipInterface
    {
        switch ($shipType) {
            case "Frigate":
                return new FrigateShip($name);
            case "Cruiser":
                return new CruiserShip($name);
            case "Dreadnought":
                return new DreadnoughtShip($name);
            default:
                throw new GameException(Messages::INVALID_SHIP_TYPE);
        }
    }
}

class StarSystemFactory
{
    /**
     * StarSystemFactory constructor.
     */
    private function __construct()
    {
    }
    /**
     * @param string $name
     * @return StarSystemInterface
     * @throws GameException
     */
    public static function produce(string $name): StarSystemInterface
    {
        switch ($name) {
            case "Artemis-Tau":
                return new StarSystem($name, ["Serpent-Nebula" => 50, "Kepler-Verge" => 120]);
            case "Serpent-Nebula":
                return new StarSystem($name, ["Artemis-Tau" => 50, "Hades-Gamma" => 360]);
            case "Hades-Gamma":
                return new StarSystem($name, ["Serpent-Nebula" => 360, "Kepler-Verge" => 145]);
            case "Kepler-Verge":
                return new StarSystem($name, ["Hades-Gamma" => 145, "Artemis-Tau" => 120]);
            default:
                throw new GameException(Messages::INVALID_STAR_SYSTEM_NAME);
        }
    }
}

class AttackCommand implements CommandInterface
{
    /**
     * @param GameEngineInterface $engine
     * @param array $params
     * @return string[]
     * @throws GameException
     */
    public function execute(GameEngineInterface $engine, array $params)
    {
        $attacker = $engine->getGalaxy()->getShipByName($params[0]);
        $target = $engine->getGalaxy()->getShipByName($params[1]);
        if ($attacker->isDestroyed() || $target->isDestroyed()) {
            throw new GameException(Messages::SHIP_IS_DESTROYED);
        }
        if ($attacker->getStarSystem() !== $target->getStarSystem()) {
            throw new GameException(Messages::SHIP_NOT_IN_SAME_SYSTEM);
        }
        $projectile = ProjectileFactory::produce($attacker->getProjectileType(), $attacker->getProjectileDamage());
        $attacker->increaseProjectilesFired();
        $target->takeDamage($projectile);
        $output = ["{$attacker->getName()} attacked {$target->getName()}"];
        if ($target->isDestroyed()) {
            $output[] = "{$target->getName()} has been destroyed";
        }
        return $output;
    }
}

interface CommandInterface
{
    /**
     * @param GameEngineInterface $engine
     * @param array $params
     * @return mixed
     */
    public function execute(GameEngineInterface $engine, array $params);
}

class CreateCommand implements CommandInterface
{
    /**
     * @param GameEngineInterface $engine
     * @param array $params
     * @return string[]
     * @throws GameException
     */
    public function execute(GameEngineInterface $engine, array $params)
    {
        $shipType = array_shift($params);
        $shipName = array_shift($params);
        if ($engine->getGalaxy()->shipExists($shipName)) {
            throw new GameException(Messages::SHIP_ALREADY_EXISTS);
        }
        $starSystem = $engine->getGalaxy()->getStarSystemByName(array_shift($params));
        $enhancements = $params;
        $ship = ShipFactory::produce($shipType, $shipName);
        foreach ($enhancements as $enhancementType) {
            $enhancement = EnhancementFactory::produce($enhancementType);
            $ship->addEnhancement($enhancementType, $enhancement);
        }
        $engine->getGalaxy()->addShip($ship);
        $starSystem->addShip($ship);
        return ["Created {$shipType} {$shipName}"];
    }
}

class PlotJumpCommand implements CommandInterface
{
    /**
     * @param GameEngineInterface $engine
     * @param array $params
     * @return string[]
     * @throws GameException
     */
    public function execute(GameEngineInterface $engine, array $params)
    {
        $ship = $engine->getGalaxy()->getShipByName($params[0]);
        $destination = $engine->getGalaxy()->getStarSystemByName($params[1]);
        if ($ship->isDestroyed()) {
            throw new GameException(Messages::SHIP_IS_DESTROYED);
        }
        if ($ship->getStarSystem()->getName() === $destination->getName()) {
            throw new GameException(Messages::SHIP_ALREADY_IN_SAME_SYSTEM . $destination->getName());
        }
        if (!array_key_exists($destination->getName(), $ship->getStarSystem()->getNeighbours())) {
            throw new GameException("Cannot travel directly from {$ship->getStarSystem()->getName()} to {$destination->getName()}");
        }
        if ($ship->getFuel() < $ship->getStarSystem()->getNeighbours()[$destination->getName()]) {
            throw new GameException("Not enough fuel to travel to {$destination->getName()} - {$ship->getFuel()}/{$ship->getStarSystem()->getNeighbours()[$destination->getName()]}");
        }
        $prev = $ship->getStarSystem()->getName();
        $ship->plotJumpTo($destination);
        return ["{$ship->getName()} jumped from {$prev} to {$destination->getName()}"];
    }
}

class StatusReportCommand implements CommandInterface
{
    /**
     * @param GameEngineInterface $engine
     * @param array $params
     * @return string[]
     */
    public function execute(GameEngineInterface $engine, array $params)
    {
        $ship = $engine->getGalaxy()->getShipByName($params[0]);
        return $ship->getReport();
    }
}

class SystemReportCommand implements CommandInterface
{
    /**
     * @param GameEngineInterface $engine
     * @param array $params
     * @return string[]
     */
    public function execute(GameEngineInterface $engine, array $params)
    {
        $starName = $params[0];
        $starSystem = $engine->getGalaxy()->getStarSystemByName($starName);
        $aliveShips = array_filter($starSystem->getShips(), function (ShipInterface $ship) {
            return !$ship->isDestroyed();
        });
        usort($aliveShips, function (ShipInterface $shipA, ShipInterface $shipB) {
            $res = $shipB->getHealth() <=> $shipA->getHealth();
            if ($res === 0) {
                $res = $shipB->getShields() <=> $shipA->getShields();
            }
            return $res;
        });
        $deadShips = array_filter($starSystem->getShips(), function (ShipInterface $ship) {
            return $ship->isDestroyed();
        });
        usort($deadShips, function (ShipInterface $shipA, ShipInterface $shipB) {
            return $shipA->getName() <=> $shipB->getName();
        });
        $output = ["Intact ships:"];
        if (count($aliveShips) <= 0) {
            $output[] = "N/A";
        } else {
            /**
             * @var $ship ShipInterface
             */
            foreach ($aliveShips as $ship) {
                array_push($output, ...$ship->getReport());
            }
        }
        $output[] = "Destroyed ships:";
        if (count($deadShips) <= 0) {
            $output[] = "N/A";
        } else {
            /**
             * @var $ship ShipInterface
             */
            foreach ($deadShips as $ship) {
                array_push($output, ...$ship->getReport());
            }
        }
        return $output;
    }
}

class GameEngine implements GameEngineInterface
{
    private $galaxy;
    /**
     * @var CommandInterface[]
     */
    private $commands;
    private $io;
    /**
     * GameEngine constructor.
     * @param GalaxyInterface $galaxy
     * @param IOInterface $io
     */
    public function __construct(GalaxyInterface $galaxy, IOInterface $io)
    {
        $this->galaxy = $galaxy;
        $this->io = $io;
    }
    public function run()
    {
        try {
            $this->produceCommands();
            $this->readInput();
        } catch (GameException $gameException) {
            $this->io->writeLine($gameException->getMessage());
        } catch (\Exception $exception) {
            $this->io->writeLine($exception->getMessage());
        }
    }
    /**
     * @return GalaxyInterface
     */
    public function getGalaxy(): GalaxyInterface
    {
        return $this->galaxy;
    }
    private function readInput()
    {
        while (true) {
            try {
                $input = $this->io->readLine();
                if ($input === Messages::END) {
                    break;
                }
                $result = $this->processCommand($input);
                foreach ($result as $row) {
                    $this->io->writeLine($row);
                }
            } catch (GameException $gameException) {
                $this->io->writeLine($gameException->getMessage());
            } catch (\Exception $exception) {
                $this->io->writeLine($exception->getMessage());
            }
        }
    }
    private function processCommand(string $input)
    {
        $args = explode(Messages::DELIMITER, $input);
        $name = array_shift($args);
        $command = $this->commands[$name];
        return $command->execute($this, $args);
    }
    private function produceCommands()
    {
        $commandNames = ["create", "attack", "plot-jump", "status-report", "system-report"];
        foreach ($commandNames as $commandName) {
            $this->commands[$commandName] = CommandFactory::produce($commandName);
        }
    }
}

interface GameEngineInterface
{
    /**
     * @return void
     */
    public function run();
    /**
     * @return GalaxyInterface
     */
    public function getGalaxy(): GalaxyInterface;
}

class Messages
{
    // Engine
    const END = "over";
    const DELIMITER = " ";
    // Factory
    const INVALID_COMMAND_NAME = "Command not implemented yet.";
    const INVALID_STAR_SYSTEM_NAME = "Star system with that name does not exists.";
    const INVALID_PROJECTILE_TYPE = "Projectile of that name does not exists.";
    const INVALID_SHIP_TYPE = "Ship of that type does not exists.";
    const INVALID_ENHANCEMENT_TYPE = "Enhancement of that type does not exists.";
    // Other
    const SHIP_IS_DESTROYED = "Ship is destroyed";
    const SHIP_ALREADY_EXISTS = "Ship with such name already exists";
    const SHIP_NOT_IN_SAME_SYSTEM = "No such ship in star system";
    const SHIP_ALREADY_IN_SAME_SYSTEM = "Ship is already in ";
    private function __construct()
    {
    }
}

class ConsoleIO implements IOInterface
{
    /**
     * @param $text mixed
     * @return void
     */
    public function write($text)
    {
        echo $text;
    }
    /**
     * @param $text mixed
     * @return void
     */
    public function writeLine($text)
    {
        echo $text . PHP_EOL;
    }
    /**
     * @return string
     */
    public function readLine(): string
    {
        return trim(fgets(STDIN));
    }
}

interface IOInterface
{
    /**
     * @param $text mixed
     * @return void
     */
    public function write($text);
    /**
     * @param $text mixed
     * @return void
     */
    public function writeLine($text);
    /**
     * @return string
     */
    public function readLine(): string;
}

interface EnhancementInterface
{
    /**
     * @param ShipInterface $ship
     * @return void
     */
    public function enhance(ShipInterface $ship);
}

class ExtendedFuelCellsEnhancement implements EnhancementInterface
{
    const BONUS_VALUE = 200.;
    /**
     * @param ShipInterface $ship
     */
    public function enhance(ShipInterface $ship)
    {
        $ship->setFuel($ship->getFuel() + self::BONUS_VALUE);
    }
}

class KineticBarrierEnhancement implements EnhancementInterface
{
    const BONUS_VALUE = 100;
    /**
     * @param ShipInterface $ship
     */
    public function enhance(ShipInterface $ship)
    {
        $ship->setShields($ship->getShields() + self::BONUS_VALUE);
    }
}

class ThanixCannonEnhancement implements EnhancementInterface
{
    const BONUS_VALUE = 50;
    /**
     * @param ShipInterface $ship
     */
    public function enhance(ShipInterface $ship)
    {
        $ship->setDamage($ship->getDamage() + self::BONUS_VALUE);
    }
}

abstract class BaseProjectile implements ProjectileInterface
{
    private $damage;
    /**
     * BaseProjectile constructor.
     * @param int $damage
     */
    public function __construct(int $damage)
    {
        $this->damage = $damage;
    }
    /**
     * @return int
     */
    public function getDamage(): int
    {
        return $this->damage;
    }
}

class Laser extends BaseProjectile
{
    /**
     * @param ShipInterface $targetShip
     */
    public function doDamage(ShipInterface $targetShip)
    {
        $a = $this->getDamage() - $targetShip->getShields();
        $newShields = $targetShip->getShields() - $this->getDamage();
        $newShields = max(0, $newShields);
        $targetShip->setShields($newShields);
        $leftoverDamage = max(0, $a);
        $newHealth = $targetShip->getHealth() - $leftoverDamage;
        $newHealth = max(0, $newHealth);
        $targetShip->setHealth($newHealth);
    }
}

class PenetrationShell extends BaseProjectile
{
    /**
     * @param ShipInterface $targetShip
     */
    public function doDamage(ShipInterface $targetShip)
    {
        $newHealth = $targetShip->getHealth() - $this->getDamage();
        $newHealth = max(0, $newHealth);
        $targetShip->setHealth($newHealth);
    }
}

interface ProjectileInterface
{
    /**
     * @return int
     */
    public function getDamage(): int;
    /**
     * @param ShipInterface $targetShip
     * @return void
     */
    public function doDamage(ShipInterface $targetShip);
}

class ShieldReaver extends BaseProjectile
{
    /**
     * @param ShipInterface $targetShip
     */
    public function doDamage(ShipInterface $targetShip)
    {
        $newHealth = $targetShip->getHealth() - $this->getDamage();
        $newHealth = max(0, $newHealth);
        $targetShip->setHealth($newHealth);
        $newShields = $targetShip->getShields() - (2 * $this->getDamage());
        $newShields = max(0, $newShields);
        $targetShip->setShields($newShields);
    }
}

abstract class BaseShip implements ShipInterface
{
    /**
     * @var StarSystemInterface
     */
    private $starSystem;
    private $projectileType;
    private $projectilesFired = 0;
    private $type;
    private $name;
    private $health;
    private $shields;
    private $damage;
    private $fuel;
    private $enhancements = [];
    /**
     * BaseShip constructor.
     * @param string $type
     * @param string $name
     * @param int $health
     * @param int $shields
     * @param int $damage
     * @param float $fuel
     * @param string $projectileType
     */
    public function __construct(
        string $type,
        string $name,
        int $health,
        int $shields,
        int $damage,
        float $fuel,
        string $projectileType)
    {
        $this->type = $type;
        $this->name = $name;
        $this->health = $health;
        $this->shields = $shields;
        $this->damage = $damage;
        $this->fuel = $fuel;
        $this->projectileType = $projectileType;
    }
    /**
     * @return StarSystemInterface
     */
    public function getStarSystem(): StarSystemInterface
    {
        return $this->starSystem;
    }
    /**
     * @param StarSystemInterface $starSystem
     */
    public function setStarSystem(StarSystemInterface $starSystem)
    {
        $this->starSystem = $starSystem;
    }
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    /**
     * @return int
     */
    public function getDamage(): int
    {
        return $this->damage;
    }
    /**
     * @param int $value
     */
    public function setDamage(int $value)
    {
        $this->damage = $value;
    }
    /**
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }
    /**
     * @param int $value
     */
    public function setHealth(int $value)
    {
        $this->health = $value;
    }
    /**
     * @return int
     */
    public function getShields(): int
    {
        return $this->shields;
    }
    /**
     * @param int $value
     */
    public function setShields(int $value)
    {
        $this->shields = $value;
    }
    /**
     * @return float
     */
    public function getFuel(): float
    {
        return $this->fuel;
    }
    /**
     * @param int $value
     */
    public function setFuel(int $value)
    {
        $this->fuel = $value;
    }
    /**
     * @return string
     */
    public function getProjectileType(): string
    {
        return $this->projectileType;
    }
    public function increaseProjectilesFired()
    {
        $this->projectilesFired++;
    }
    /**
     * @param string $name
     * @param EnhancementInterface $enhancement
     */
    public function addEnhancement(string $name, EnhancementInterface $enhancement)
    {
        $this->enhancements[$name] = $enhancement;
        $enhancement->enhance($this);
    }
    /**
     * @param ProjectileInterface $projectile
     */
    public function takeDamage(ProjectileInterface $projectile)
    {
        $projectile->doDamage($this);
    }
    /**
     * @param StarSystemInterface $to
     */
    public function plotJumpTo(StarSystemInterface $to)
    {
        $this->setFuel($this->getFuel() - $this->getStarSystem()->getNeighbours()[$to->getName()]);
        $this->getStarSystem()->removeShip($this->getName());
        $to->addShip($this);
    }
    /**
     * @return bool
     */
    public function isDestroyed(): bool
    {
        return $this->health === 0;
    }
    /**
     * @return string[]
     */
    public function getReport(): array
    {
        $output = ["--{$this->getName()} - {$this->type}"];
        if ($this->isDestroyed()) {
            $output[] = "(Destroyed)";
        } else {
            $output[] = "-Location: {$this->getStarSystem()->getName()}";
            $output[] = "-Health: {$this->getHealth()}";
            $output[] = "-Shields: {$this->getShields()}";
            $output[] = "-Damage: {$this->getDamage()}";
            $output[] = "-Fuel: " . number_format($this->getFuel(), 1);
            if (count($this->enhancements) == 0) {
                $output[] = "-Enhancements: N/A";
            } else {
                $output[] = "-Enhancements: " . implode(", ", array_keys($this->enhancements));
            }
            if ($this->type === "Frigate") {
                $output[] = "-Projectiles fired: {$this->projectilesFired}";
            }
        }
        return $output;
    }
}

class CruiserShip extends BaseShip
{
    const TYPE = "Cruiser";
    const HEALTH = 100;
    const SHIELDS = 100;
    const DAMAGE = 50;
    const FUEL = 300.;
    const PROJECTILE_TYPE = "PenetrationShell";
    public function __construct($name)
    {
        parent::__construct(
            self::TYPE,
            $name,
            self::HEALTH,
            self::SHIELDS,
            self::DAMAGE,
            self::FUEL,
            self::PROJECTILE_TYPE);
    }
    public function getProjectileDamage(): int
    {
        return $this->getDamage();
    }
}

class DreadnoughtShip extends BaseShip
{
    const TYPE = "Dreadnought";
    const HEALTH = 200;
    const SHIELDS = 300;
    const DAMAGE = 150;
    const FUEL = 700.;
    const PROJECTILE_TYPE = "Laser";
    public function __construct($name)
    {
        parent::__construct(
            self::TYPE,
            $name,
            self::HEALTH,
            self::SHIELDS,
            self::DAMAGE,
            self::FUEL,
            self::PROJECTILE_TYPE);
    }
    public function getProjectileDamage(): int
    {
        return $this->getDamage() + floor($this->getShields() / 2);
    }
    public function takeDamage(ProjectileInterface $projectile)
    {
        $this->setShields($this->getShields() + 50);
        $projectile->doDamage($this);
        $this->setShields(max($this->getShields() - 50, 0));
    }
}

class FrigateShip extends BaseShip
{
    const TYPE = "Frigate";
    const HEALTH = 60;
    const SHIELDS = 50;
    const DAMAGE = 30;
    const FUEL = 220.;
    const PROJECTILE_TYPE = "ShieldReaver";
    public function __construct($name)
    {
        parent::__construct(
            self::TYPE,
            $name,
            self::HEALTH,
            self::SHIELDS,
            self::DAMAGE,
            self::FUEL,
            self::PROJECTILE_TYPE);
    }
    public function getProjectileDamage(): int
    {
        return $this->getDamage();
    }
}

interface ShipInterface
{
    /**
     * @return StarSystemInterface
     */
    public function getStarSystem(): StarSystemInterface;
    /**
     * @param StarSystemInterface $starSystem
     * @return void
     */
    public function setStarSystem(StarSystemInterface $starSystem);
    /**
     * @return string
     */
    public function getName(): string;
    /**
     * @return int
     */
    public function getDamage(): int;
    /**
     * @param int $value
     * @return void
     */
    public function setDamage(int $value);
    /**
     * @return int
     */
    public function getHealth(): int;
    /**
     * @param int $value
     * @return void
     */
    public function setHealth(int $value);
    /**
     * @return int
     */
    public function getShields(): int;
    /**
     * @param int $value
     * @return void
     */
    public function setShields(int $value);
    /**
     * @return float
     */
    public function getFuel(): float;
    /**
     * @param int $value
     * @return void
     */
    public function setFuel(int $value);
    /**
     * @return string
     */
    public function getProjectileType(): string;
    /**
     * @return int
     */
    public function getProjectileDamage(): int;
    /**
     * @return void
     */
    public function increaseProjectilesFired();
    /**
     * @return bool
     */
    public function isDestroyed(): bool;
    /**
     * @param string $name
     * @param EnhancementInterface $enhancement
     * @return void
     */
    public function addEnhancement(string $name, EnhancementInterface $enhancement);
    /**
     * @param ProjectileInterface $projectile
     * @return void
     */
    public function takeDamage(ProjectileInterface $projectile);
    /**
     * @param StarSystemInterface $to
     * @return void
     */
    public function plotJumpTo(StarSystemInterface $to);
    /**
     * @return string[]
     */
    public function getReport(): array;
}

class Galaxy implements GalaxyInterface
{
    /**
     * @var StarSystemInterface[]
     */
    private $starSystems;
    /**
     * @var ShipInterface[]
     */
    private $ships = [];
    public function __construct()
    {
        $this->createStarSystems();
    }
    /**
     * @param ShipInterface $ship
     */
    public function addShip(ShipInterface $ship)
    {
        $this->ships[$ship->getName()] = $ship;
    }
    /**
     * @param string $name
     * @return StarSystemInterface
     */
    public function getStarSystemByName(string $name): StarSystemInterface
    {
        return $this->starSystems[$name];
    }
    private function createStarSystems()
    {
        $starSystemNames = ["Artemis-Tau", "Serpent-Nebula", "Hades-Gamma", "Kepler-Verge"];
        foreach ($starSystemNames as $starSystemName) {
            $this->starSystems[$starSystemName] = StarSystemFactory::produce($starSystemName);
        }
    }
    /**
     * @param string $name
     * @return ShipInterface
     */
    public function getShipByName(string $name): ShipInterface
    {
        return $this->ships[$name];
    }
    /**
     * @param string $name
     * @return bool
     */
    public function shipExists(string $name): bool
    {
        return array_key_exists($name, $this->ships);
    }
}

interface GalaxyInterface
{
    /**
     * @param ShipInterface $ship
     * @return void
     */
    public function addShip(ShipInterface $ship);
    /**
     * @param string $name
     * @return bool
     */
    public function shipExists(string $name): bool;
    /**
     * @param string $name
     * @return ShipInterface
     */
    public function getShipByName(string $name): ShipInterface;
    /**
     * @param string $name
     * @return StarSystemInterface
     */
    public function getStarSystemByName(string $name): StarSystemInterface;
}

class StarSystem implements StarSystemInterface
{
    private $name;
    /**
     * @var string[]
     */
    private $neighbours;
    /**
     * @var ShipInterface[]
     */
    private $ships = [];
    /**
     * StarSystem constructor.
     * @param $name
     * @param string[] $neighbours
     */
    public function __construct($name, array $neighbours)
    {
        $this->name = $name;
        $this->neighbours = $neighbours;
    }
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    /**
     * @param ShipInterface $ship
     * @return void
     */
    public function addShip(ShipInterface $ship)
    {
        $this->ships[$ship->getName()] = $ship;
        $ship->setStarSystem($this);
    }
    /**
     * @param string $shipName
     * @return void
     */
    public function removeShip(string $shipName)
    {
        unset($this->ships[$shipName]);
    }
    /**
     * @return string[]
     */
    public function getNeighbours(): array
    {
        return $this->neighbours;
    }
    /**
     * @return ShipInterface[]
     */
    public function getShips(): array
    {
        return array_values($this->ships);
    }
}

interface StarSystemInterface
{
    /**
     * @return string
     */
    public function getName(): string;
    /**
     * @return array
     */
    public function getNeighbours(): array;
    /**
     * @return array
     */
    public function getShips(): array;
    /**
     * @param ShipInterface $ship
     * @return mixed
     */
    public function addShip(ShipInterface $ship);
    /**
     * @param string $shipName
     * @return mixed
     */
    public function removeShip(string $shipName);
}

$galaxy = new Galaxy();
$io = new ConsoleIO();
$game = new GameEngine($galaxy, $io);
$game->run();