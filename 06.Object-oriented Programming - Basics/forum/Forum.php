<?php


use Author\User;
use Content\Answer;
use Content\Question;

class Forum
{
    /**
     * @var User[]
     */
    private $usersById = [];

    /**
     * @var User[]
     */
    private $usersByUsername = [];

    /**
     * @var Question[]
     */
    private $questions = [];
    /**
     * @var Answer[]
     */
    private $answers = [];
    /**
     * @var Answer[]
     */
    private $comments = [];

    /**
     * @var Author\User
     */
    private $currentUser;

    public function start()
    {
        while(true)
        {
            $line = trim(fgets(STDIN));
            $commandArgs = explode(" ", $line);
            $commandName = $commandArgs[0];
            try {
                switch ($commandName) {
                    case "register":
                        $this->register(
                            $commandArgs[1],
                            $commandArgs[2]
                        );
                        break;
                    case "login":
                        $this->login(
                            $commandArgs[1],
                            $commandArgs[2]
                        );
                        break;
                    case "ask":
                        $this->ask(
                            $commandArgs[1],
                            $commandArgs[2]
                        );
                        break;
                    case "answer":
                        $this->answer(
                            intval($commandArgs[1]),
                            $commandArgs[2]
                        );
                        break;
                    case "comment":
                        $this->comment(
                            intval($commandArgs[1]),
                            $commandArgs[2]
                        );
                        break;
                    case "show":
                        $this->show();
                        break;
                    default:
                        break;
                }
            } catch (Exception $e) {
                echo $e->getMessage() . PHP_EOL;
            }
        }
    }

    public function register(string $username, string $password)
    {
        if(array_key_exists($username, $this->usersByUsername)) {
            throw new Exception("Username already exists");
        }

        $user = new User($username, $password);
        $this->usersById[$user->getId()] = $user;
        $this->usersByUsername[$username] = $user;
    }

    public function login(string $username, string $password)
    {
        if(!array_key_exists($username, $this->usersByUsername)) {
            throw new Exception("Username does not exist");
        }

        $user = $this->usersByUsername[$username];
        $userPassword = $user->getPassword();
        if ($userPassword != $password) {
            throw new Exception("Passwords missmatch");
        }

        $this->currentUser = $user;
    }

    public function ask(string $title, string $body)
    {
        if (!$this->currentUser) {
            throw new Exception("Anonymous question asking is not allowed");
        }

        $question = new Question($title, $body, $this->currentUser);
        $this->questions[$question->getId()] = $question;
        $this->currentUser->askQuestion($question);
    }

    public function answer(int $questionId, string $body)
    {
        if (!$this->currentUser) {
            throw new Exception("Anonymous answering is not allowed");
        }

        if (!array_key_exists($questionId, $this->questions)) {
            throw new Exception("Invalid question to answer");
        }

        $answer = new Answer($body, $this->currentUser, $this->questions[$questionId]);
        $this->answers[$answer->getId()] = $answer;
        $this->currentUser->answer($this->questions[$questionId], $answer);
    }

    public function comment(int $answerId, string $body)
    {
        if (!$this->currentUser) {
            throw new Exception("Anonymous commenting is not allowed");
        }

        if (!array_key_exists($answerId, $this->answers)) {
            throw new Exception("Answer does not exist");
        }

        $answer = $this->answers[$answerId];
        $question = $answer->getQuestion();

        $comment = new Answer($body,
            $this->currentUser,
            $question,
            $answer);
        $this->comments[$comment->getId()] = $comment;
        $this->currentUser->comment($comment, $answer);
    }

    public function show()
    {
        foreach ($this->questions as $question) {
            echo "  -- Question Title: " . $question->getTitle() . " Body: " . $question->getBody() . " Author: " . $question->getAuthor()->getUsername() . PHP_EOL;
            foreach ($question->getAnswers() as $answer) {
                echo "      --- Answer Body: " . $answer->getBody() . " Author: " . $answer->getAuthor()->getUsername() . PHP_EOL;
                foreach ($answer->getComments() as $comment) {
                    echo "           --- Comment Body: " . $answer->getBody() . " Author: " . $answer->getAuthor()->getUsername() . PHP_EOL;
                }
            }
        }
    }
}