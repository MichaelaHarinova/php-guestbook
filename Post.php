<?php
declare(strict_types=1);

class Post
{
    private string $title;
    private int $unixTimeStamp;
    private string $content;
    private string $authorName;

    //constructor is called when new object is created
public function __construct(string $title,string $content,string $name){
    $this->title=$title;
    $this->unixTimeStamp=time();
    $this->content=$content;
    $this->authorName=$name;

}
    public function getTitle(): string
    {
        
        return $this->title;
    }

    public function setTitle($Title): void
    {
        $this->title = $Title;
    }

    public function getUnixTimeStamp(): int
    {
        return $this->unixTimeStamp;
    }

    public function setUnixTimeStamp($Date): void
    {
        $this->unixTimeStamp = $Date;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent($Content): void
    {
        $this->content = $Content;
    }

    public function getAuthorName(): string
    {
        return $this->authorName;
    }

    public function setAuthorName($Name): void
    {
        $this->authorName = $Name;
    }

}