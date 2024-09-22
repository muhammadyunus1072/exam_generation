<?php

namespace App\Repositories;

abstract class MasterDataRepository
{
    abstract protected static function className(): string;

    public static function create($data)
    {
        return app(static::className())::create($data);
    }

    public static function getBy($whereClause)
    {
        $query = app(static::className())->query();
        foreach ($whereClause as $clause) {
            $query->where($clause['column'], $clause['operator'], $clause['value']);
        }

        return $query->get();
    }

    public static function find($id)
    {
        return app(static::className())->find($id);
    }

    public static function findBy($whereClause)
    {
        $query = app(static::className())->query();
        foreach ($whereClause as $clause) {
            $query->where($clause['column'], $clause['operator'], $clause['value']);
        }

        return $query->first();
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
