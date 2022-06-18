<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MutationPeriodic extends Model
{
    protected $table = 'mutation_periodics';
    use HasFactory;
    protected $fillable = [
        'item_code',
        'item_name',
        'unit',
        'beginning_balance',
        'in_bc_16',
        'in_bc_40',
        'in_bc_27',
        'out_bc_28',
        'out_bc_41',
        'out_bc_27',
        'adjustment',
        'book_balance',
        'inventory_taking',
        'difference'
    ];

    public function scopeFiltered(Builder $builder)
    {
        $search = request('search') ?? null;
        $searchColumns = request('searchColumns') ?? null;

        $sort = request('sort') ?? null;
        $sortBy = request('sortBy') ?? null;
        $sortColumns = request('sortColumns') ?? null;

        $mutation_periodics = $builder->select(
            'mutation_periodics.id AS id',
            'mutation_periodics.item_code AS item_code',
            'mutation_periodics.item_name AS item_name',
            'mutation_periodics.unit AS unit',
            'mutation_periodics.beginning_balance AS beginning_balance',
            'mutation_periodics.in_bc_16 AS in_bc_16',
            'mutation_periodics.in_bc_40 AS in_bc_40',
            'mutation_periodics.in_bc_27 AS in_bc_27',
            'mutation_periodics.out_bc_28 AS out_bc_28',
            'mutation_periodics.out_bc_41 AS out_bc_41',
            'mutation_periodics.out_bc_27 AS out_bc_27',
            'mutation_periodics.adjustment AS adjustment',
            'mutation_periodics.book_balance AS book_balance',
            'mutation_periodics.inventory_taking AS inventory_taking',
            'mutation_periodics.difference AS difference',
            'mutation_periodics.created_at AS created_at'
        );

        if ($search && Str::length($search) > 0) {
            $listSearch = Str::of($search)->split('/[\s,]+/')->toArray();
            $search = count($listSearch) > 0 ? implode('%', $listSearch) : '%{$search}%';

            $searchColumns = Str::of($searchColumns)->split('/[\s,]+/')->toArray();

            $mutation_periodics->where(function ($query) use ($search, $searchColumns) {
                foreach ($searchColumns as $searchColumn) {
                    $query->orwhereRaw("mutation_periodics.{$searchColumn} LIKE '[$search]'");
                }
            });
        }

        $sortColumns = Str::of($sortColumns)->split('/[\s,]+/')->toArray();
        if (collect($sortColumns)->contains($sort) && collect(['ASC', 'DESC'])->contains($sort)) {
            $mutation_periodics->orderBy("mutation_periodics.{$sortBy}", $sort);
        }

        return $mutation_periodics;
    }
}
