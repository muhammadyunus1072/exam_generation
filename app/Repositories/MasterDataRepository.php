<?php

namespace App\Repositories;

abstract class MasterDataRepository
{
    abstract protected static function className(): string;

    public static function find($id)
    {
        return app(static::className())->find($id);
    }

    public static function create($data)
    {
        return app(static::className())::create($data);
    }

    public static function update($id, $data)
    {
        $obj = self::find($id);
        return $obj->update($data);
    }

    public static function delete($id)
    {
        $obj = self::find($id);
        if ($obj) {
            return $obj->delete();
        }
        return false;
    }

    public static function all()
    {
        return app(static::className())::all();
    }
}
