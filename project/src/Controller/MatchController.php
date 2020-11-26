<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Player;
use App\Entity\Match;

class MatchController extends AbstractController
{

    /**
    * @Route("")
    */
    public function number(): Response
    {
        
        $playerA = new Player("Player A");
        $playerA->_points = 1399;
        $playerB = new Player("Player B");
        $playerB->_points = 1801;
        $playerB->_level->_levelNumber = 4;
        $pointsBeforeA = $playerA->_points;
        $pointsBeforeB = $playerB->_points;
        $levelBeforeA = $playerA->_level->_levelNumber;
        $levelBeforeB = $playerB->_level->_levelNumber;


        $match1 = new Match($playerA, $playerB);
        $match1ResultForPlayerA = $match1->playMatch();
        $pointsM1A = $playerA->_points;
        $pointsM1B = $playerB->_points;
        $levelM1A = $playerA->_level->_levelNumber;
        $levelM1B = $playerB->_level->_levelNumber;

        $match1 = new Match($playerA, $playerB);
        $match2ResultForPlayerA = $match1->playMatch();
        $pointsM2A = $playerA->_points;
        $pointsM2B = $playerB->_points;
        $levelM2A = $playerA->_level->_levelNumber;
        $levelM2B = $playerB->_level->_levelNumber;

        $match1 = new Match($playerA, $playerB);
        $match3ResultForPlayerA = $match1->playMatch();
        $pointsM3A = $playerA->_points;
        $pointsM3B = $playerB->_points;
        $levelM3A = $playerA->_level->_levelNumber;
        $levelM3B = $playerB->_level->_levelNumber;

        return $this->render('match.html.twig', [
            'playerA' => $playerA->_name,
            'playerB' => $playerB->_name,
            'pointsBeforePlayerA' => $pointsBeforeA,
            'pointsBeforePlayerB' => $pointsBeforeB,
            'levelBeforePlayerA' => $levelBeforeA,
            'levelBeforePlayerB' => $levelBeforeB,
            'm1Result' => $match1ResultForPlayerA,
            'pointsM1PlayerA' => $pointsM1A,
            'pointsM1PlayerB' => $pointsM1B,
            'levelM1PlayerA' => $levelM1A,
            'levelM1PlayerB' => $levelM1B,
            'm2Result' => $match2ResultForPlayerA,
            'pointsM2PlayerA' => $pointsM2A,
            'pointsM2PlayerB' => $pointsM2B,
            'levelM2PlayerA' => $levelM2A,
            'levelM2PlayerB' => $levelM2B,
            'm3Result' => $match3ResultForPlayerA,
            'pointsM3PlayerA' => $pointsM3A,
            'pointsM3PlayerB' => $pointsM3B,
            'levelM3PlayerA' => $levelM3A,
            'levelM3PlayerB' => $levelM3B
        ]);
    }
}
?>