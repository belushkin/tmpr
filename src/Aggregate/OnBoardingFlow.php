<?php declare(strict_types=1);

namespace App\Aggregate;

/**
 * OnBoardingFlow data aggregation class.
 */
class OnBoardingFlow implements IAggregate
{

    private $data;
    private $steps = [0,20,40,50,70,90,99,100];

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function aggregate(): array
    {
        $data = $this->divideByWeek($this->data);
        $data = $this->findStepsPercentage($data);

        $result = [];
        for ($i = 0; $i < count($data); $i++) {
            $result[$i]['name'] = ($i+1) ." weeks later";
            $result[$i]['data'] = $data[$i];
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
            if (in_array($percentage, $this->steps)) {
                $result[$weekNumber][] = $percentage;
            }
        }
        return $result;
    }

    private function findStepsPercentage(array $data): array
    {
        $result = [];
        foreach ($data as $key => $value) {
            $values = array_count_values($value);
            foreach ($this->steps as $step) {
                if (isset($values[$step])) {
                    $result[$key][] = round(($values[$step]*100)/count($value));
                } else {
                    $result[$key][] = 0;
                }
            }
            $result[$key][0] = 100;
        }
        return $result;
    }
}
