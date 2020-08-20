<?php


namespace App\Breadcrumbs;


use App\Breadcrumbs\DTO\Breadcrumb;
use App\News;
use App\Source;

/**
 * Строитель breadcrumbs.
 */
class BreadcrumbsBuilder
{
    /** @var Breadcrumb[] */
    private array $items;

    /**
     * Главная страница.
     *
     * @return $this
     */
    public function addMain(): self
    {
        $this->add(new Breadcrumb(route('index'), 'Главная'));

        return $this;
    }

    /**
     * Источники.
     *
     * @return $this
     */
    public function addSources(): self
    {
        $this->add(new Breadcrumb(route('sources'), 'Источники'));

        return $this;
    }

    /**
     * Источник.
     *
     * @param Source $source
     * @return $this
     */
    public function addSource(Source $source): self
    {
        $this->add(new Breadcrumb(route('source.id', ['id' => $source->identifier]), $source->name));

        return $this;
    }

    /**
     * Авторы.
     *
     * @return $this
     */
    public function addAuthors(): self
    {
        $this->add(new Breadcrumb(route('authors'), 'Авторы'));

        return $this;
    }

    /**
     * Автор.
     *
     * @param string $author
     * @return $this
     */
    public function addAuthor(string $author): self
    {
        $this->add(new Breadcrumb(route('author.id', ['id' => $author]), $author));

        return $this;
    }

    /**
     * Новость.
     *
     * @param News $news
     * @return $this
     */
    public function addNews(News $news): self
    {
        $this->add(new Breadcrumb(route('view', ['id' => $news->id]), $news->title));

        return $this;
    }

    /**
     * Дата.
     *
     * @param string $dateStart
     * @param string $dateEnd
     * @param string $date
     * @return $this
     */
    public function addDate(string $dateStart, string $dateEnd, string $date): self
    {
        $this->add(new Breadcrumb(route('date', [
            'dateStart' => $dateStart,
            'dateEnd' => $dateEnd
        ]), $date));

        return $this;
    }

    /**
     * Язык.
     *
     * @param string $language
     * @return $this
     */
    public function addLanguage(string $language): self
    {
        $this->add(new Breadcrumb(route('language', [
            'language' => $language
        ]), $language));

        return $this;
    }

    /**
     * Категория.
     *
     * @param string $category
     * @return $this
     */
    public function addCategory(string $category): self
    {
        $this->add(new Breadcrumb(route('category', ['category' => $category]), ucfirst($category)));

        return $this;
    }

    /**
     * Поиск.
     *
     * @param string $search
     * @return $this
     */
    public function addSearch(string $search): self
    {
        $this->add(new Breadcrumb(route('category', ['category' => $search]), $search));

        return $this;
    }

    /**
     * Добавить.
     *
     * @param Breadcrumb $breadcrumb
     */
    private function add(Breadcrumb $breadcrumb): void
    {
        $this->items[] = $breadcrumb;
    }

    /**
     * Список.
     *
     * @return Breadcrumb[]
     */
    public function get(): array
    {
        return $this->items;
    }
}
