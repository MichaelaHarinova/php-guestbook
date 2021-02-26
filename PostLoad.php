<?php
declare(strict_types=1);

class PostLoad
{
    private array $posts;
    private string $filename;
    const MAX_POSTS_SHOWN = 20;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
        $this->posts = $this->unserializeFile($filename);
    }

    public static function sortPosts($a, $b): int
    {
        if ($a->getUnixTimeStamp() === $b->getUnixTimeStamp()) {
            return 0;
        }
        return ($a->getUnixTimeStamp() > $b->getUnixTimeStamp()) ? -1 : 1;
    }

    public function getPosts(): array
    {
        usort($this->posts, "PostLoad::sortPosts");
        array_splice($this->posts, self::MAX_POSTS_SHOWN);
        return $this->posts;
    }

    public function setPosts(array $posts): void
    {
        $this->posts = $posts;
    }

    public function addPost(Post $post): void
    {
        $this->posts[] = $post;
        $this->saveSerializedPost($this->serializePost($post));
    }

    public function serializePost(Post $post): string
    {
        return serialize($post);
    }

    public function saveSerializedPost(string $post): void
    {
        $file = fopen($this->filename, 'ab');
        //serialize converts the object data into string
        //write the serialized data to the file
        fwrite($file, $post . "\n");
        //all opened files have to be closed
        fclose($file);
    }

    public function unserializeFile(string $fileName): array
    {
        $posts = [];
        //create the file array
        $postsArray = file($fileName);
        foreach ($postsArray as $iValue) {
            $posts[] = unserialize($iValue, ["allowed_classes" => ["Post"]]);
        }
        return $posts;
    }
}



























/*  public function readFile(string $nameOfFile): ?array
  {
      try {
          return json_decode(file_get_contents($nameOfFile), true, 512, JSON_THROW_ON_ERROR);
      } catch (JsonException $e) {
          if ($e) {
              var_dump($e);
          }
          return null;
      }
  }
      public function writefile($nameOfFile, Post $post): void
      {
          try {
              file_put_contents($nameOfFile, json_encode($post, JSON_THROW_ON_ERROR), FILE_APPEND);
          } catch (JsonException $e) {
              if ($e) {
                  var_dump($e);
              }
              return;
          }
      }*/
