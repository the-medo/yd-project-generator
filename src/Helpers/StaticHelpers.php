<?php

namespace Ydistri\Helpers;

use Ydistri\Enums\CardinalDirectionType;
use Ydistri\Enums\WrapType;

class StaticHelpers
{
    const CardinalDirections = [
        'cardinal4' => [
            'N' => 'North',
            'E' => 'East',
            'S' => 'South',
            'W' => 'West',
        ],
        'interCardinal8' => [
            'NW' => 'Northwest',
            'NE' => 'Northeast',
            'SW' => 'Southwest',
            'SE' => 'Southeast',
        ],
        'secondaryInterCardinal16' => [
            'WNW' => 'West-northwest',
            'NNW' => 'North-northwest',
            'NNE' => 'North-northeast',
            'ENE' => 'East-northeast',
            'ESE' => 'East-southeast',
            'SSE' => 'South-southeast',
            'SSW' => 'South-southwest',
            'WSW' => 'West-southwest',
        ],
    ];

    public static function combineArraysIntoNames(array $first, ?array $second, ?WrapType $wrapType): array {
        if ($second) {
            $resultingArray = [];
            foreach ($first as $f) {
                foreach ($second as $s) {
                    if ($wrapType === WrapType::Parentheses) {
                        $s = "($s)";
                    } else if ($wrapType === WrapType::Brackets) {
                        $s = "[$s]";
                    }

                    $resultingArray[] = $f . ' ' . $s;
                }
            }
            return $resultingArray;
        }
        return $first;
    }



    public static function seeminglyRandomArrayGenerator($min, $max, $count): string
    {

        $array = [];
        for ($i = 0; $i < $count; $i++) {
            $array[] = rand($min, $max);
        }

        return "MIN_{$min}_MAX_$max = [" . implode(',', $array) . "]";
    }

    public static function getWordTemplate(int $wordLength, int $randomizer): array
    {
        $template = [];
        $array = A::MIN_0_MAX_1000;
        $powerNumber = max(0, min($wordLength * $wordLength - $randomizer, count($array) - 1) - $wordLength);
        for ($i = 0; $i < $wordLength; $i++) {
            $powerNumber++;
            if($i === 0) {
                $charToAdd = (($array[$powerNumber] % 10) < 6 ? 'b' : 'a');
            } else {
                $charToAdd = (($array[$powerNumber] % 10) < ($template[$i - 1] === 'a' ? 8 : 1) ? 'b' : 'a');
            }
            $template[] = $charToAdd;
        }
        return $template;
    }

    public static function getWordFromTemplate(array $template, int $randomizer): string
    {
        $array = A::MIN_0_MAX_10000;
        $start = max(0, count($array) - count($template) - $randomizer);
        $word = [];
        for($i = 0; $i < count($template); $i++) {
            if ($template[$i] === 'a') {
                $word[] = A::VOWEL[$array[$start + $i] % count(A::VOWEL)];
            } else {
                $word[] = A::CONSONANT[$array[$start + $i] % count(A::CONSONANT)];
            }
        }

        return ucfirst(strtolower(join('', $word)));
    }

    public static function getCardinalDirectionArray(?CardinalDirectionType $type): array {
        if ($type === CardinalDirectionType::Cardinal4) {
            return self::CardinalDirections[CardinalDirectionType::Cardinal4->value];
        } else if($type === CardinalDirectionType::InterCardinal8) {
            return array_merge(self::CardinalDirections[CardinalDirectionType::Cardinal4->value], self::CardinalDirections[CardinalDirectionType::InterCardinal8->value]);
        } else if($type === CardinalDirectionType::SecondaryInterCardinal16) {
            return array_merge(self::CardinalDirections[CardinalDirectionType::Cardinal4->value], self::CardinalDirections[CardinalDirectionType::InterCardinal8->value], self::CardinalDirections[CardinalDirectionType::SecondaryInterCardinal16->value]);
        }
        return [];
    }
}