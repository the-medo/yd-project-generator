<?php

namespace Entities;

class StaticHelpers
{
    public static function combineArraysIntoNames(array $first, array $second, array $randomArrayToUse) {

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
}