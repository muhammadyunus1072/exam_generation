<?php

namespace App\Repositories;

abstract class MasterDataRepository
{
    abstract protected static function className(): string;

    public static function create($data)
    {
        return app(static::className())::create($data);
    }

    public static function whereClauseProcess($whereClause)
    {
        $query = app(static::className())->query();
        foreach ($whereClause as $clause) {
            if (isset($clause['conjunction']) || $clause['conjunction'] == 'OR') {
                $query->orWhere($clause['column'], $clause['operator'], $clause['value']);
                continue;
            }

            $query->where($clause['column'], $clause['operator'], $clause['value']);
        }

        return $query;
    }

    public static function getBy($whereClause)
    {
        return self::whereClauseProcess($whereClause)->get();
    }

    public static function find($id)
    {
        return app(static::className())->find($id);
    }

    public static function findBy($whereClause)
    {
        return self::whereClauseProcess($whereClause)->first();
    }

    public static function update($id, $data)
    {
        $obj = self::find($id);
        return empty($obj) ? false : $obj->update($data);
    }

    public static function updateBy($whereClause, $data)
    {
        $obj = self::findBy($whereClause);
        return empty($obj) ? false : $obj->update($data);
    }

    public static function delete($id)
    {
        $obj = self::find($id);
        return empty($obj) ? false : $obj->delete();
    }

    public static function deleteBy($whereClause)
    {
        $obj = self::findBy($whereClause);
        return empty($obj) ? false : $obj->delete();
    }

    public static function all()
    {
        return app(static::className())::all();
    }
}
