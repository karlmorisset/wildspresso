<?php
require __DIR__ . '/../vendor/autoload.php';

use App\CoffeeMachine;
use PHPUnit\Framework\TestCase;

class CoffeeMachineTest extends TestCase{

    protected $coffee;

    function __construct() {
        parent::__construct();
        $this->coffee = new CoffeeMachine;
    }


    /** @test */
    public function il_y_a_45ml_deau_qui_coule_avec_un_appui_court()
    {
        $this->coffee->initMachine(["waterLoad" => 50, "lightColor"=>"white"]);

        $this->assertEquals(45, $this->coffee->appuiCourt());
    }


    /** @test */
    public function le_temps_decoulement_est_mis_a_jour_apres_un_appui_long()
    {
        $this->coffee->initMachine(["waterLoad" => 50, "lightColor"=>"white"]);

        $this->assertEquals(15, $this->coffee->flowDuration);

        $this->assertEquals(30, $this->coffee->appuiLong(30));

        $this->assertEquals(30, $this->coffee->flowDuration);
        $this->assertEquals(90, $this->coffee->appuiCourt());
    }

    /** @test */
    public function moins_de_20ml_dans_le_reservoir()
    {
        $this->coffee->initMachine(["waterLoad" => 15, "lightColor" =>"white"]);

        $this->assertEquals(0, $this->coffee->appuiCourt());
        $this->assertEquals('red', $this->coffee->lightColor);
    }
}