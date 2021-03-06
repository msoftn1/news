<?php

use App\Repository\UserRepository;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApiControllerTest extends TestCase
{
    private UserRepository $userRepository;
    private ?User $user;
    private bool $newUser = false;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = $this->app->get(UserRepository::class);
        $this->user = $this->userRepository->getFirstUserWithApiToken();

        if(!$this->user) {
            $this->user = $this->userRepository->create(
                [
                    'name' => 'test',
                    'email' => 'test@test.com',
                    'password' => Hash::make('123456'),
                    'api_token' => Str::random(60),
                ]
            );

            $this->newUser = true;
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown(); // TODO: Change the autogenerated stub

        if($this->newUser) {
            $this->user->delete();
        }
    }

    public function testSources()
    {
        $this->execute('/api/sources');
        $this->assertEquals(200, $this->response->status());
    }

    public function testNewsBySource()
    {
        $this->execute(sprintf('/api/newsBySource?source=%s', 'abc-news'));
        $this->assertEquals(200, $this->response->status());
    }

    public function testNewsByLanguage()
    {
        $this->execute(sprintf('/api/newsByLanguage?language=%s', 'ru'));
        $this->assertEquals(200, $this->response->status());
    }

    public function testNewsByCategory()
    {
        $this->execute(sprintf('/api/newsByCategory?category=%s', 'general'));
        $this->assertEquals(200, $this->response->status());
    }

    public function testNewsByCountry()
    {
        $this->execute(sprintf('/api/newsByCategory?country=%s', 'ru'));
        $this->assertEquals(200, $this->response->status());
    }

    public function testNewsSearch()
    {
        $this->execute(sprintf('/api/newsSearch?search=%s', 'trump'));
        $this->assertEquals(200, $this->response->status());
    }

    private function execute(string $uri)
    {
        $this->get($uri, ['Authorization' => sprintf('Bearer %s', $this->user->api_token)]);
    }
}
