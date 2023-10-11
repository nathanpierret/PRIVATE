<?php

namespace App\Tests\unitaires;

use PHPUnit\Framework\TestCase;
use function App\Fonctions\CalculComplexiteMdp;

class FonctionsTest extends TestCase
{
    /**
     * @test
     */
    public function CalculComplexiteMDP_TailleComplexite_DoitDonner24()
    {
        $mdp = "aubry";
        $this->assertEquals(24,CalculComplexiteMdp($mdp));
    }

    /**
     * @test
     */
    public function CalculComplexiteMDP_TailleComplexite_DoitDonner59()
    {
        $mdp = "super@ubry";
        $this->assertEquals(59,CalculComplexiteMdp($mdp));
    }

    /**
     * @test
     */
    public function CalculComplexiteMDP_TailleComplexite_DoitDonner92()
    {
        $mdp = "Super@ubry2022";
        $this->assertEquals(92,CalculComplexiteMdp($mdp));
    }

    /**
     * @test
     */
    public function CalculComplexiteMDP_TailleComplexite_DoitDonner152()
    {
        $mdp = "Giroud-Président||2027";
        $this->assertEquals(152,CalculComplexiteMdp($mdp));
    }
}