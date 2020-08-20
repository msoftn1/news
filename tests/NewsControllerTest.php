<?php

class NewsControllerTest extends TestCase
{
    public function testIndex()
    {
        $this->get('/');
        $this->assertEquals(200, $this->response->status());
    }

    public function testSources()
    {
        $this->get('/sources');
        $this->assertEquals(200, $this->response->status());
    }

    public function testSourceById()
    {
        $this->get(sprintf('/source/%s', 'abc-news'));
        $this->assertEquals(200, $this->response->status());
    }

    public function testAuthors()
    {
        $this->get('/authors');
        $this->assertEquals(200, $this->response->status());
    }

    public function testAuthorById()
    {
        $this->get(sprintf('/author/%s', 'Aaron Holmes'));
        $this->assertEquals(200, $this->response->status());
    }

    public function testView()
    {
        $this->get(sprintf('/view/%s', 163));
        $this->assertEquals(200, $this->response->status());
    }

    public function testDate()
    {
        $this->get(sprintf('/search/date/%s/%s', '2020-08-01', '2020-09-01'));
        $this->assertEquals(200, $this->response->status());
    }

    public function testLanguage()
    {
        $this->get(sprintf('/language/%s', 'ru'));
        $this->assertEquals(200, $this->response->status());
    }

    public function testCategory()
    {
        $this->get(sprintf('/category/%s', 'general'));
        $this->assertEquals(200, $this->response->status());
    }

    public function testSearchAjax()
    {
        $this->get(sprintf('/search/ajax?term=%s', 'trump'));
        $this->assertEquals(200, $this->response->status());
    }

    public function testSearch()
    {
        $this->get(sprintf('/search/?search=%s', 'trump'));
        $this->assertEquals(200, $this->response->status());
    }
}
