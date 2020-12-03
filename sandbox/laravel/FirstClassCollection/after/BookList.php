<?php


class BookList implements \IteratorAggregate
{
    /** @var Book[] **/
    private $books;

    /**
     * コンストラクタ
     */
    public function __construct(array $books)
    {
        $this->books = $books;
    }

    /**
     * @return ArrayIterator|Traversable
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->books);
    }

    /**
     * 書籍リストを取得
     * @return array|Book[]
     */
    public function getBooks()
    {
        return $this->books;
    }

    /**
     * 合計金額を計算する
     * @return int
     */
    public function getSumPrice() :int
    {
        $sumPrice = 0;
        foreach ($this->books as $book) {
            $sumPrice += $book->getPrice();
        }
        return $sumPrice;
    }
}