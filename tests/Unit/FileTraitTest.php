<?php

use Sentgine\Authzone\Tests\Unit\BaseClassUnitTest;
use Sentgine\Authzone\Traits\File;

class FileTraitTest extends BaseClassUnitTest
{
    use File;

    /**
     * Test if the function can append to file.
     * 
     * @return void
     */
    public function test_append_to_file_is_working_as_expected(): void
    {
        $pathToFile = __DIR__ . '/../file.txt';

        // Check if the file exists
        if (!file_exists($pathToFile)) {
            // Create the file if it doesn't exist
            touch($pathToFile);
        }

        $code = '/* New code to append */';

        // Create a temporary file for testing
        $tempFile = tmpfile();

        // Get the path of the temporary file
        $tempFilePath = stream_get_meta_data($tempFile)['uri'];

        // Write initial content to the temporary file
        file_put_contents($tempFilePath, 'Initial content');

        // Invoke the appendToFile method with the provided file path and code
        $result = $this->appendToFile($pathToFile, $code);

        // Assert that the code is successfully appended
        $this->assertTrue($result);

        // Assert that the file contains the appended code
        $fileContent = file_get_contents($pathToFile);
        $this->assertStringContainsString($code, $fileContent);

        sleep(1);

        // Remove the file
        unlink($pathToFile);
    }
}
