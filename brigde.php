<?php

/**
 * Bridge PHP design pattern example.
 *
 * @author Rafał Toborek (https://github.com/clash82)
 * @see http://en.wikipedia.org/wiki/Bridge_pattern
 */

interface Writer
{
    public function write($body);
}

class FileWriter implements Writer
{
    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function write($body)
    {
        file_put_contents($this->file, $body);
    }
}

class ScreenWriter implements Writer
{
    public function write($body)
    {
        echo $body;
    }
}

abstract class Messenger
{
    protected $writer;

    public function __construct(Writer $writer)
    {
        $this->writer = $writer;
    }
}

class Message extends Messenger
{
    public function __construct(Writer $writer)
    {
        parent::__construct($writer);
    }

    public function set($body)
    {
        $this->writer->write($body);
    }
}

class Logger
{
    private $messageWriter = [];

    public function __construct()
    {
        $this->messageWriter = [
            new Message(new ScreenWriter()),
            new Message(new FileWriter('dump.txt'))
        ];
    }

    public function write($body)
    {
        foreach ($this->messageWriter as $message) {
            $message->set($body);
        }
    }
}

$logger = new Logger();

// display message on screen and save it to local `dump.txt` file
$logger->write('Sample message');
