<?php
namespace App;

class CoffeeMachine{

    /** Quantité d'eau dans le réservoir en ml */
    public $waterLoad;

    /** Couleur de la lumière */
    public $lightColor;

    /** Débit d'eau de la machine en ml/seconde */
    protected $rateOfFlow;

    /** Durée d'écoulement par défaut en secondes */
    protected $defaultFlowDuration;

    /** Quantité d'eau minimum dans le réservoir pour fonctionner en ml */
    protected $minimumWaterLoad;

    /** Durée courante d'écoulement en secondes */
    public $flowDuration;

    public $waterFlow;


    public function __construct(){
        $this->rateOfFlow = 3;
        $this->defaultFlowDuration = 15; // en secondes
        $this->minimumWaterLoad = 20;
        $this->flowDuration = $this->defaultFlowDuration;
    }

    public function appuiCourt()
    {
        if ($this->waterLoad < $this->minimumWaterLoad){
            $this->lightColor = "red";
            return $this->runsWater(0);
        }

        return $this->runsWater($this->flowDuration);
    }


    public function appuiLong($tempsappui)
    {
        $this->flowDuration = $tempsappui;

        return $this->flowDuration;
    }

    /**
     * Calcule la quantité d'eau écoulée en fonction
     * de la durée d'écoulement et le débit de la machine
     *
     * @param Integer $duration : Durée d'écoulement
     *
     * @return Integer : la quantité d'eau écoulée
     */
    public function runsWater($duration)
    {
        return $this->rateOfFlow * $duration;
    }


    public function initMachine(Array $data)
    {
        $this->waterLoad = $data["waterLoad"];
        $this->lightColor = $data["lightColor"];
    }
}