<?php declare(strict_types=1);

namespace App\Aggregate;

/**
 * OnBoardingFlow data aggregation class.
 */
class OnBoardingFlow implements IAggregate
{

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function aggregate(): array
    {
        $data = $this->divideByWeek($this->data);
        $data = $this->mean($data);

        $result = [];
        for ($i = 0; $i < count($data); $i++) {
//            $result[$i]['name'] = ($i+1) ." weeks later";
            for ($j = 0; $j < count($data); $j++) {
                $result[$i][] = ($j<=$i) ? round($data[$j], 2) : null;
            }
        }
        return $result;
    }

    private function divideByWeek(array $data): array
    {
        $result = [];

        $nextWeekDay = null;
        $weekNumber = -1;
        foreach ($data as $key => [$id, $createdAt, $percentage]) {
            if ($nextWeekDay === null || (new \DateTime($createdAt)) >= $nextWeekDay) {
                $nextWeekDay = new \DateTime($createdAt);
                $nextWeekDay->modify('+7 day');
                $weekNumber++;
            }
            $result[$weekNumber][] = $percentage;
        }
        return $result;
    }

    private function mean(array $data): array
    {
        $result = [];
        foreach ($data as $key => $value) {
            $result[] = array_sum($data[$key])/count($data[$key]);
        }
        return $result;
    }
}
