<?php

declare(strict_types=1);

namespace Doska\Shared;

final class Html
{
    /**
     * @return array{int, int}|null Byte offsets immediately after the opening
     *                              body tag and at the start of </body>
     */
    public static function bodyOffsets(string $html): ?array
    {
        if (!preg_match(
            '/<body(?=[\s>])/i',
            $html,
            $match,
            PREG_OFFSET_CAPTURE,
        )) {
            return null;
        }

        $offset = $match[0][1] + strlen($match[0][0]);
        $openAt = self::openingTagEnd($html, $offset);

        if (null === $openAt) {
            return null;
        }

        $closeAt = strripos($html, '</body>');

        if (false === $closeAt || $closeAt < $openAt) {
            return null;
        }

        return [$openAt, $closeAt];
    }

    /**
     * Returns the byte offset immediately after the tag's closing >.
     * A > inside a quoted attribute does not close the tag.
     */
    private static function openingTagEnd(string $html, int $offset): ?int
    {
        $quote = null;
        $length = strlen($html);

        for ($i = $offset; $i < $length; ++$i) {
            $character = $html[$i];

            if (null !== $quote) {
                if ($character === $quote) {
                    $quote = null;
                }

                continue;
            }

            if ('"' === $character || "'" === $character) {
                $quote = $character;

                continue;
            }

            if ('>' === $character) {
                return $i + 1;
            }
        }

        return null;
    }
}
