<?php 

namespace Alura\Leilao\Tests\Services;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use PHPUnit\Framework\TestCase;
use Alura\Leilao\Service\Avaliador;

class AvaliadorTest extends TestCase
{
    private $leiloeiro;

    protected function setUp() : void
    {
        $this->leiloeiro = new Avaliador();
    }

    /**
     *  @dataProvider leilaoEmOrdemAleatoria
     *  @dataProvider leilaoEmOrdemDecresecente
     *  @dataProvider leilaoEmOrdemCresecente
     */
    public function testAvaliadorEncontraMaiorValor(Leilao $leilao)
    {
        $this->leiloeiro->avalia($leilao);
        $maiorValor = $this->leiloeiro->getMaiorValor();
        self::assertEquals(2500, $maiorValor);
    }
   
    /**
     *  @dataProvider leilaoEmOrdemAleatoria
     *  @dataProvider leilaoEmOrdemDecresecente
     *  @dataProvider leilaoEmOrdemCresecente
     */
    public function testAvaliadorEncontraMenorValor(Leilao $leilao)
    {
        $this->leiloeiro->avalia($leilao);
        $menorValor = $this->leiloeiro->getMenorValor();
        self::assertEquals(1500, $menorValor);
    }

     /**
     *  @dataProvider leilaoEmOrdemAleatoria
     *  @dataProvider leilaoEmOrdemDecresecente
     *  @dataProvider leilaoEmOrdemCresecente
     */
    public function testAvaliadorEncontraMenorValorDecrescente(Leilao $leilao)
    {
        $this->leiloeiro->avalia($leilao);
        $menorValor = $this->leiloeiro->getMenorValor();
        self::assertEquals(1500, $menorValor);
    }


    /**
     *  @dataProvider leilaoEmOrdemAleatoria
     *  @dataProvider leilaoEmOrdemDecresecente
     *  @dataProvider leilaoEmOrdemCresecente
     */
    public function testeAvaliadorDeveBuscar3MaioresValores(Leilao $leilao)
    {
        $this->leiloeiro->avalia($leilao);
        $maiores = $this->leiloeiro->getMaioresLances();
        static::assertCount(3, $maiores);
        static::assertEquals(2500, $maiores[0]->getValor());
        static::assertEquals(2000, $maiores[1]->getValor());
        static::assertEquals(1700, $maiores[2]->getValor());

    }

    public static function leilaoEmOrdemCresecente()
    {
        $leilao = new Leilao('Fiat 500');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        $ana = new Usuario('Ana');
        $jorge = new Usuario('Jorge');

        $leilao->recebeLance(new Lance($jorge, 1500));
        $leilao->recebeLance(new Lance($ana, 1700));
        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 2500));

        return [[$leilao]];
    }

    public static function leilaoEmOrdemDecresecente()
    {
        $leilao = new Leilao('Fiat 500');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        $ana = new Usuario('Ana');
        $jorge = new Usuario('Jorge');

        $leilao->recebeLance(new Lance($ana, 2500));
        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 1700));
        $leilao->recebeLance(new Lance($jorge, 1500));

        return [[$leilao]];
    }

    public static function leilaoEmOrdemAleatoria()
    {
        $leilao = new Leilao('Fiat 500');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        $ana = new Usuario('Ana');
        $jorge = new Usuario('Jorge');

        $leilao->recebeLance(new Lance($ana, 2000));
        $leilao->recebeLance(new Lance($joao, 1700));
        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($jorge, 1500));

        return [[$leilao]];
    }

  
}