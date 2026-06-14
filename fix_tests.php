<?php

$dir = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('tests'));
foreach ($dir as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        
        // Let's replace '/** @test */\n    public function ' with 'public function test_'
        $content = preg_replace('/\\/\\*\\*\\s+@test\\s+\\*\\/\\s*public function /s', 'public function test_', $content);
        
        file_put_contents($file->getPathname(), $content);
    }
}
echo "Done replacing!\n";
