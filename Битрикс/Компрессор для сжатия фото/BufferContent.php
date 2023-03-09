<?php

class BufferContent
{
    private string $content = '';
    private array $whatReplace = [];
    private array $valueReplace = [];

    private function pagesWithOutCompressor(): array
    {
        return [

        ];
    }

    public function endBufferContent(&$content): void
    {
        if(!$this->checkPage()) {
            $this->content = $content;
            $pictureSrc = $this->getPictures();
            $this->createWebp($pictureSrc);

            $content = str_replace($this->whatReplace, $this->valueReplace, $content);
        }
    }

    private function checkPage()
    {
        global $APPLICATION;
        $pagesWithOutCompressor = $this->pagesWithOutCompressor();

        foreach ($pagesWithOutCompressor as $link) {
            if(strpos($APPLICATION->GetCurPage(), $link)) {
                return true;
            }
        }

        return false;
    }

    private function getPictures(): ?array
    {
        preg_match_all("/<img[^>]*?(src|srcset)=['\"](.*\.(jpg|png|jpeg))['\"]/iU", $this->content, $pictureSrcAr);
        preg_match_all("/<source[^>]*?srcset=['\"](.*\.(jpg|png|jpeg))['\"]/iU", $this->content, $pictureSourceSrcAr);
        preg_match_all("/url\(['\"](.*\.(jpg|png|jpeg))['\"]\)/iU", $this->content, $pictureBackgroundSrcAr);

        $pictureSrc = array_merge($pictureSrcAr[2], $pictureSourceSrcAr[1], $pictureBackgroundSrcAr[1]);

        return array_filter($pictureSrc);
    }

    private function createWebp($pictureSrc): void
    {
        $webpObj = new picture\Webp();
        foreach ($pictureSrc as $src) {
            $webpBase64 = $webpObj->convertOriginalPathToBase64($src);
            if ($webpBase64 !== null) {
                $this->replaceOriginalPathToBase64($src, $webpBase64);
            }
        }
    }

    private function replaceOriginalPathToBase64($whatReplace, $valueReplace): void
    {
        $this->whatReplace[] = $whatReplace;
        $this->valueReplace[] = $valueReplace;
    }
}

?>