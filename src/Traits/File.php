<?php

namespace Sentgine\Authzone\Traits;

trait File
{
    /**
     * Append code at the end of the file.
     * 
     * @param string $pathToFile
     * @param string $code
     * 
     * @return bool
     */
    protected function appendToFile(string $pathToFile, string $code): bool
    {
        $content = file_get_contents($pathToFile);

        if (strpos($content, $code) === false) {
            $result = file_put_contents($pathToFile, $code, FILE_APPEND);
            return $result !== false;
        }

        return false;
    }
}
