<?php
namespace tests\DevBoard\Github\Commit\CalculateState;

use DevBoard\Github\Commit\CalculateState\CalculateGithubCommitState;
use DevBoard\Github\Commit\Entity\GithubCommit;
use DevBoard\Github\Commit\InternalStatus;
use DevBoard\Github\CommitStatus\Entity\GithubCommitStatus;
use DevBoard\Github\CommitStatus\GithubCommitStatusState;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class CalculateGithubCommitStateTest.
 */
class CalculateGithubCommitStateTest extends \PHPUnit_Framework_TestCase
{
    private $calculator;

    public function setUp()
    {
        $this->calculator = new CalculateGithubCommitState();
    }

    /**
     * @dataProvider provideAllVariations
     *
     * @param $statuses
     */
    public function testNoUnknown($statuses)
    {
        $commit = new GithubCommit();
        $commit->setCommitStatuses($statuses);

        $this->calculator->calculate($commit);

        $this->assertNotSame(InternalStatus::UNKNOWN, $commit->getInternalStatus());
    }

    /**
     * @return array
     */
    public function provideAllVariations()
    {
        $statuses = [
            GithubCommitStatusState::PENDING,
            GithubCommitStatusState::FAILED,
            GithubCommitStatusState::ERROR,
            GithubCommitStatusState::PASSED,
        ];

        $pe = permutations($statuses, 5);

        $returnList = [];

        foreach ($pe as $permutation) {
            $resultSet = new ArrayCollection();
            foreach ($permutation as $value) {
                $result = new GithubCommitStatus();
                $result->setState($value);
                $resultSet->add($result);
            }
            $returnList[] = [$resultSet];
        }

        return $returnList;
    }

    public function testSinglePermutations()
    {
        $input          = [1, 2, 3, 4];
        $expectedOutput = [
            [1],
            [2],
            [3],
            [4],
        ];

        $this->assertSame($expectedOutput, permutations($input, 1));
    }

    public function testDoublePermutations()
    {
        $input          = [1];
        $expectedOutput = [
            [1, 1],
        ];

        $this->assertSame($expectedOutput, permutations($input, 2));
    }

    public function testDoublePermutationsWithDoubleInput()
    {
        $input          = [1, 2];
        $expectedOutput = [
            [1, 1],
            [1, 2],
            [2, 1],
            [2, 2],
        ];

        $this->assertSame($expectedOutput, permutations($input, 2));
    }

    public function testDoublePermutationsWithTripleInput()
    {
        $input          = [1, 2, 3];
        $expectedOutput = [
            [1, 1],
            [1, 2],
            [1, 3],
            [2, 1],
            [2, 2],
            [2, 3],
            [3, 1],
            [3, 2],
            [3, 3],
        ];

        $this->assertSame($expectedOutput, permutations($input, 2));
    }

    public function testTriplePermutationsWithDoubleInput()
    {
        $input          = [1, 2];
        $expectedOutput = [
            [1, 1, 1],
            [1, 1, 2],
            [1, 2, 1],
            [1, 2, 2],
            [2, 1, 1],
            [2, 1, 2],
            [2, 2, 1],
            [2, 2, 2],
        ];

        $this->assertSame($expectedOutput, permutations($input, 3));
    }
}

/**
 * @param $arr
 * @param $cnt
 *
 * @return array
 */
function permutations($arr, $cnt)
{
    $res = [];

    foreach ($arr as $w) {
        if ($cnt == 1) {
            $res[] = [$w];
        } else {
            $perms = permutations($arr, $cnt - 1);

            foreach ($perms as $p) {
                array_unshift($p, $w);
                $res[] = $p;
            }
        }
    }

    return $res;
}
