<?php


namespace App\Models\Traits;


use Illuminate\Database\Eloquent\Builder;

trait FullTextSearch
{

    /**
     * Замена пробелов полнотекстовыми подстановочными знаками
     *
     * @param string $term
     * @return string
     */
    protected function fullTextWildcards($term)
    {
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);

        $words = explode(' ', $term);

        foreach ($words as $key => $word) {
            /**
             * применяем оператор + только к большим словам,
             * т.к. слова с меньшим количеством символов не индексируется mysql
             */
            if (strlen($word) >= 3) {
                $words[$key] = '+' . $word . '*';
            }
        }

        $searchTerm = implode(' ', $words);

        return $searchTerm;
    }

    /**
     *
     * @param Builder $query
     * @param string $term
     * @return Builder
     */
    public function scopeSearch($query, $term)
    {
        $columns = implode(',', $this->searchable);

        $query->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)", $this->fullTextWildcards($term));

        return $query;
    }
}
