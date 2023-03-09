<?php

namespace picture;

class Webp
{
    private string $src = '';
    private int $webpQuality = 80;

    public function setPictureQuality($quality)
    {
        $this->webpQuality = $quality;
    }

    public function convertOriginalPathToBase64($src): ?string
    {
        $this->src = $_SERVER['DOCUMENT_ROOT'] . $src;
        if (!file_exists($this->src)) {
            return null;
        }

        $filePath = $this->getWebpSrc();
        if (!file_exists($filePath)) {
            $this->createWebp($filePath);
        }

        return 'data:image/webp;base64,' . base64_encode(
                file_get_contents($filePath)
            );
    }

    private function getWebpSrc(): string
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/upload/webp/' . $this->getEncryptFileNameFromSrc() . '.webp';
    }

    private function createWebp($webpSrc): void
    {
        if ($this->getFileType() === 'png') {
            $fileCreated = imagecreatefrompng($this->src);
        } else {
            $fileCreated = imagecreatefromjpeg($this->src);
        }

        imagepalettetotruecolor($fileCreated);
        imagewebp($fileCreated, $webpSrc, $this->webpQuality);
        imagedestroy($fileCreated);
    }

    private function getEncryptFileNameFromSrc(): string
    {
        $arPath = $this->src . filesize($this->src);
        return md5($arPath);
    }

    private function getFileType(): string
    {
        $fileName = basename($this->src);
        return pathinfo($fileName, PATHINFO_EXTENSION);
    }
}

?>